<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

// use Request;
use Illuminate\Http\Request;
use App\Mail\VerifyEmail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Auth;



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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(50),
        ]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));
        // $this->SendMail($user);

        try {
            
            event(new Registered($user = $this->create($request->all())));

            Mail::to($user->email)->send(new VerifyEmail($user));
            flash('Please check your email to confirm user account.', 'success');
            return back();
            
        } catch (Exception $e) {
            flash('Unable to send email verification', 'danger');
            return back();
        }

    }

    public function SendMail($email)
    {
     
        $user = User::whereEmail($email)->firstorfail();
        try {
            Mail::to($user->email)->send(new VerifyEmail($user));
            flash('Please check your email to confirm user account.', 'success');
        } catch (Exception $e) {
            flash('Unable to send email verification', 'danger');
        }

        return redirect('/');

    }





    public function verifylink($token){

        // check if token is valid
        // if valid update the user account to token null and verified = true
        // direct to the dashboard with toast messagge

        // $user = User::whereToken($token)->firstorfail();
        $user = User::whereToken($token)->firstorfail();
        $user->verified = true;
        $user->token = null;
        $user->save();

        Auth::login($user);
        return redirect('/dashboard')->with('success',"Congratulation! Your account was successfully verified!");

    }




}
