<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Repositories\ActivationRepository;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationRepository $activationRepository)
    {
        $this->middleware('guest');
        $this->activationRepository = $activationRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $this->validator(request()->all())->validate();
        event(new Registered($user = $this->create(request()->all())));
        return redirect('/login')
            ->with(
                'registered',
                'We sent you an activation code. Check your email.'
            );
    }

    /**
     * Activate user account from email
     * @return redirect
     */
    protected function activateUser($token)
    {
        $activation = $this->activationRepository->getActivationByToken($token);
        if ($activation === null) {
            abort(404);
        }

        $user = User::find($activation->user_id);
        $user->activated_at = date('Y-m-d H:i:s');
        $user->save();
        $this->activationRepository->deleteActivation($token);

        // auth()->login($user);
        return redirect('/login')
            ->with(
                'registered',
                'Account activated. Now you can login.'
            );
    }
}
