<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new sessions controller instance.
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Perform the login.
     *
     * @param Request $request The request
     *
     * @return \Redirect
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password'=> 'required'
        ]);

        if ($this->signIn($request)) {
            return redirect()->back();
        }
        return redirect()->route('login')->withErrors(trans('frontend.auth.login_fails'));
    }

    /**
     * Destroy the user's current session.
     *
     * @return \Redirect
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

    /**
     * Attempt to sign in the user.
     *
     * @param Request $request The request.
     *
     * @return boolean
     */
    protected function signIn(Request $request)
    {
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }

    /**
     * Get the login credentials and requirements.
     *
     * @param Request $request The request
     *
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return [
            'email'    => $request->email,
            'password' => $request->password,
            'activated' => \Config::get('common.ACTIVATED')
        ];
    }
}
