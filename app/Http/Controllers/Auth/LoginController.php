<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ActivateAccount;
use App\Repositories\ActivationRepository;
use Mail;

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
    protected $redirectTo = '/dashboard';

    protected $activationRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationRepository $activationRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->activationRepository = $activationRepository;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (is_null($user->activated_at)) {
            Mail::to($user->email)
                ->send(
                    new ActivateAccount(
                        $user,
                        $this->activationRepository->createActivation($user)
                    )
                );
            auth()->logout();
            return back()
                ->with(
                    'warning',
                    'You need to activate your account. We have sent you an activation code, please check your email.'
                );
        }
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        if (request()->ajax()) {
            return '/login';
        }

        return redirect('/login');
    }
}
