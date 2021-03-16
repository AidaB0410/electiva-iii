<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\UserRegister;
use App\Notifications\NewUserRegister;

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
    protected function redirectTo()
    {
        return url()->previous();
    }

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'lastname' => ['required', 'string', 'min:2', 'max:255'],
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
        $count=User::where('name', $data['name'])->where('lastname', $data['lastname'])->count();
        $slug=Str::slug($data['name']." ".$data['lastname'], '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=User::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=$slug."-".$num;
                $num++;
            } else {
                break;
            }
        }

        $user=User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'slug' => $slug,
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        // if ($user) {
        //     $client_data=new User;
        //     $client_data->name = $data['name'];
        //     $client_data->lastname = $data['lastname'];
        //     $client_data->email = $data['email'];
        //     $client_data->password_customer = $data['password'];
        //     $client_data->notify(new UserRegister());

        //     $client_data=new User;
        //     $client_data->name = $data['name'];
        //     $client_data->lastname = $data['lastname'];
        //     $client_data->email = 'pedidosmaesma@gmail.com';
        //     $client_data->notify(new NewUserRegister());
        // }

        return $user;
    }
}
