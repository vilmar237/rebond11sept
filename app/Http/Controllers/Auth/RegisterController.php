<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserRegisterEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Crypt;
use Mail;
use URL;

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
    protected $redirectTo = '/';

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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:25',
            'last_name' => 'required|max:25',
            'email' => 'required|email|max:255|unique:users',
            'gender' => 'required|in:male,female',
            'password' => 'required|min:8|confirmed',
        ], [
            'first_name.required' => __('Veuillez renseigner votre prénom !'),
            'first_name.max' => __('Votre prénom doit être d\'au plus 25 caractères.'),
            'last_name.required' => __('Veuillez renseigner votre nom !'),
            'last_name.max' => __('Votre nom doit être d\'au plus 25 caractères.'),
            'email.unique' => __('Cette adresse n\'est plus disponible.'),
            'email.required' => __('Votre adresse mail est requise.'),
            'email.email' => __('Veuillez entrer une adresse mail valide.'),
            'email.max' => __('Votre adresse est trop longue.'),
            'gender.required' => __('Veuillez indiquer votre genre.'),
            'gender.in' => __('Votre genre n\'est pas reconnu.'),
            'password.required' => __('Veuillez renseigner un mot de passe.'),
            'password.confirmed' => __('Les mots de passe ne correspondent pas.'),
            'password.min' => __('Les mots de passe doivent être minimum de 8 caractères.'),
        ]
        );

        $available_avatars = ['boy.png', 'boy-1.png', 'girl.png', 'girl-1.png', 'girl-2.png','man.png', 'man-1.png', 'man-2.png', 'man-3.png'];
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'gender' => $request['gender'],
            'role' => 'Customer',
            'avatar' => $available_avatars[array_rand($available_avatars)],
            'password' => bcrypt($request['password']),
        ]);

        $activateCode = $this->generateUserActivationToken($user->id);

        $this->sendConfirmEmail($user->first_name, $request->password, $user->email, $activateCode);

        notify()->success('Consultez votre boîte mail ', 'Activation de compte');
        return redirect('/')->with('success', 'Un mail vous a été envoyé pour confirmation. Veuillez consulter votre boîte mail.');
    }

    /**
     * @param $userId
     *
     * @return string
     */
    public function generateUserActivationToken($userId)
    {
        $activation_code = uniqid();

        /** @var User $user */
        $user = User::find($userId);
        $user->activation_code = $activation_code;
        $user->save();

        $key = $user->id.'|'.$activation_code;
        $code = Crypt::encrypt($key);

        return $code;
    }

    /**
     * @param  string  $username
     * @param  string  $email
     * @param  string  $activateCode
     * @param  string  $url
     *
     * @throws Exception
     */
    public function sendConfirmEmail($username, $pass, $email, $activateCode, $url = '')
    {
        $data['link'] = ($url != '') ? $url.'/activate?token='.$activateCode : URL::to('/activate?token='.$activateCode);
        $data['username'] = $username;
        $data['passw'] = $pass;
        $data['mail'] = $email;

        try {
            Mail::to($email)
                ->send(new UserRegisterEmail('users.send-user-register-notification', 'Activate your account', $data));

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    /*protected function create(array $data)
    {
        $available_avatars = ['boy.png', 'boy-1.png', 'girl.png', 'girl-1.png', 'girl-2.png','man.png', 'man-1.png', 'man-2.png', 'man-3.png'];
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'role' => 'Customer',
            'avatar' => $available_avatars[array_rand($available_avatars)],
            'password' => bcrypt($data['password']),
        ]);
    }*/
}
