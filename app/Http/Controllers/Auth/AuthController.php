<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Exceptions\InvalidConfirmationCodeException;
use App\Repositories\Eloquent\UserRepositoryEloquent;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * The user repository eloquent instance.
     *
     * @var PostRepository
     */
    protected $user;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserRepositoryEloquent $user the user repository
     *
     * @return void
     */
    public function __construct(UserRepositoryEloquent $user)
    {
        $this->user = $user;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data request data to validate
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:2|max:128',
            'email' => 'required|email|max:128|unique:users',
            'password' => 'required|confirmed|min:6|max:32',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data the data to create user
     *
     * @return User
     */
    protected function create(array $data)
    {
        return $this->user->create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'validation_code' => $data['validationCode'],
        ]);
    }

    /**
     * Send the verification email.
     *
     * @param array                  $data parameters
     * @param UserRepositoryEloquent $user the user
     *
     * @return boolean
     */
    public function sendVerificationMail(array $data, $user)
    {
        try {
            Mail::send('frontend.auth.email.verify', $data, function ($message) use ($user) {
                $message->to($user->email, $user->username)
                        ->subject(trans('frontend.auth.verify_header'));
            });
            return count(Mail::failures()) > 0 ? false : true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request The registration request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->only([
            'username',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator);
        }

        $validationCode = str_random(\Config::get('common.VERIFICATION_TOKEN_LENGTH')) . time();

        $input['validationCode'] = $validationCode;

        try {
            $user = $this->create($input);

            $data = [
                'id' => $user->id,
                'validationCode' => $validationCode,
            ];

            if ($this->sendVerificationMail($data, $user)) {
                return redirect()->route('register')
                                 ->withEmail($user->email);
            } else {
                // Destroy the missing user (hard delete).
                $this->user->delete($data['id']);

                return redirect()->route('register')
                                 ->withErrors(trans('frontend.auth.failure_sending'));
            }
        } catch (Exception $e) {
            return redirect()->route('register')
                             ->withErrors(trans('frontend.auth.failure_creating'));
        }
    }

    /**
     * Confirm the registration.
     *
     * @param string $id             the user's email
     * @param string $validationCode the validation token
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm($id, $validationCode)
    {
        if ((!$id) || (!$validationCode)) {
            throw new InvalidConfirmationCodeException;
        } else {
            $user = $this->user->findWhere([
                'id' => $id,
                'validation_code' => $validationCode
            ])->first();
            if (!$user) {
                throw new InvalidConfirmationCodeException;
            } else {
                $user->activated = \Config::get('common.ACTIVATED');
                $user->validation_code = null;
                $user->save();
            }
        }

        return redirect()->route('login')
                         ->withMessage(trans('frontend.auth.activated'));
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @param string $provider the provider (facebook)
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @param string $provider the provider (facebook)
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $fbUser = Socialite::driver($provider)->user();

        $data = [
            'name' => $fbUser->name,
            'email' => $fbUser->email,
            'avatar' => $fbUser->avatar,
        ];

        $user = $this->firstOrCreate($data);

        if (!$user) {
            return redirect()->route('login')->withErrors(trans('frontend.auth.failure_creating'));
        }

        Auth::loginUsingId($user->id);

        return redirect()->route('home');
    }

    /**
     * Find the user by email or create account if user doesn't exist.
     *
     * @param array $data user's data
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    protected function firstOrCreate($data)
    {
        $user = $this->user->findByField('email', $data['email'])->first();
        if (!$user) {
            // Create a new account with random password.
            $defaultPassword = time();
            $user = $this->user->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($defaultPassword),
                'validation_code' => null,
                'activated' => \Config::get('common.ACTIVATED'),
            ]);

            // Download the avatar form facebook.
            $avatarPath = public_path() . \Config::get('common.AVATAR_PATH');

            if ($this->downloadAvatar($data['avatar'], $avatarPath, $user)) {
                $user->avatar = $user->id . '.jpg';
                $user->save();
            }

            // Send the default password to user's email.
            $accountInfo = [
                'email' => $data['email'],
                'password' => $defaultPassword,
            ];

            if ($this->sendPasswordToMail($accountInfo, $user)) {
                return $user;
            } else {
                // Undo creating user (hard delete).
                $this->user->delete($user['id']);
                return null;
            }
        }
        return $user;
    }

    /**
     * Send the default password to user's email.
     *
     * @param array                  $data parameters
     * @param UserRepositoryEloquent $user the user
     *
     * @return boolean
     */
    protected function sendPasswordToMail(array $data, $user)
    {
        try {
            Mail::send('frontend.auth.email.default_password', $data, function ($message) use ($user) {
                $message->to($user->email, $user->username)
                        ->subject(trans('frontend.auth.update_pass'));
            });
            return count(Mail::failures()) > 0 ? false : true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Download the avatar form facebook to server.
     *
     * @param string                             $from     from address
     * @param string                             $toFolder to folder
     * @param Illuminate\Database\Eloquent\Model $user     the owner
     *
     * @return boolean
     */
    protected function downloadAvatar($from, $toFolder, $user)
    {
        $filePath = $toFolder . '/' . $user->id . '.jpg';
        // Make the directory if there's no one.
        if (!file_exists($toFolder)) {
            mkdir($toFolder, \Config::get('common.FILE_MODE'), true);
        }
        // Download the avatar to `public/file/avatar/<user_id>.jpg`
        set_time_limit(\Config::get('common.NO_TIME_LIMIT'));
        $imageString = file_get_contents($from);
        file_put_contents($filePath, $imageString);

        return file_exists($filePath);
    }
}
