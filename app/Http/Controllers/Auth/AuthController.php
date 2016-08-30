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
            if (count(Mail::failures())) {
                return false;
            } else {
                return true;
            }
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
}
