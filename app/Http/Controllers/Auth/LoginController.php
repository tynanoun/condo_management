<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/usage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
//    public function login(Request $request)
//    {
//        echo "testing login";die();
//        $this->validateLogin($request);
//
//        // If the class is using the ThrottlesLogins trait, we can automatically throttle
//        // the login attempts for this application. We'll key this by the username and
//        // the IP address of the client making these requests into this application.
//        if ($this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//
//            return $this->sendLockoutResponse($request);
//        }
//
//        if ($this->attemptLogin($request)) {
//            return $this->sendLoginResponse($request);
//        }
//
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
//        $this->incrementLoginAttempts($request);
//
//        return $this->sendFailedLoginResponse($request);
//    }

    protected function attemptLogin(Request $request)
    {
        $creUser = $this->credentials($request);
        $user = User::All()->where('email', $creUser['email'])->where('is_active', true);
        $errors = [$this->username() => trans('auth.failed')];
        if ($user == null) {
            //echo "testin";die();
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }
}
