<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'phone' => 'required|max:255',
            'country' => 'required|max:255',
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

        $url = 'http://www.argentmac.com/mail/sendmail.php';

        $message = $data['fname'] . " " . $data['lname'] .  " has just signed up to use the application! Their phone number (if provided) is : " . $data['phone'] . " and their email address is : " . $data['email'] . "";

        $emaildata = array('email' => 'bces.burrowesandwallace@gmail.com', 'subject' => 'New Sign-Up at BCES', 'message' => $message);

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($emaildata)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }

        //var_dump($result);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'phone' => $data['phone'],
            'company_name' => $data['company_name'],
            'number_of_users' => $data['number_of_users'],
            'country' => $data['country'],
        ]);
    }
}
