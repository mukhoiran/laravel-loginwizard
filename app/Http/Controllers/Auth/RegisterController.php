<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Step 1 (GET)
    public function showRegistrationForm(Request $request)
    {
        $registerStep1 = $request->session()->get('registerStep1');
        return view('auth.register', ['registerStep1' => $registerStep1]);
    }

    // Step 1 (POST)
    public function register(Request $request)
    {
      $validatedData = $request->validate([
        'first_name' => ['string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      if(empty($request->session()->get('registerStep1'))){
          $registerStep1 = new User();
          $registerStep1->fill($validatedData);
          $request->session()->put('registerStep1', $registerStep1);
      }else{
          $registerStep1 = $request->session()->get('registerStep1');
          $registerStep1->fill($validatedData);
          $request->session()->put('registerStep1', $registerStep1);
      }

      return redirect('/register2');

        // $this->validator($request->all())->validate();
        // event(new Registered($user = $this->create($request->all())));
        // return redirect('/login')->with('message', 'Registered successfully, please login...!');;
    }

    // Step 1 (GET)
    public function showRegistrationForm2(Request $request)
    {
        $registerStep2 = $request->session()->get('registerStep2');
        $memberships = Membership::all();
        return view('auth.register2',['registerStep2' => $registerStep2, 'memberships' => $memberships]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    //Step 1 (Validator)
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birth_date' => $data['birth_date'],
        ]);
    }
}
