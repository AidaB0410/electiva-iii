<?php

namespace App\Http\Controllers;

use App\User;
use App\Store;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserRegister;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users=User::where('state', '1')->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.users.index', compact('users', 'num'));
    }

    public function inactive() {
        $users=User::where('state', '2')->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.users.inactive', compact('users', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $stores=Store::all();
        return view('admin.users.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $count=User::where('name', request('name'))->where('lastname', request('lastname'))->count();
        $slug=Str::slug(request('name')." ".request('lastname'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=User::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name')." ".request('lastname'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'lastname' => request('lastname'), 'dni' => request('dni'), 'phone' => request('phone'), 'slug' => $slug, 'email' => request('email'), 'type' => request('type'), 'password' => Hash::make(request('password')));
                break;
            }
        }

        if (request('type')==2 || request('type')==3) {
            $store=Store::where('slug', request('store_id'))->firstOrFail();
            $data['store_id']=$store->id;
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $photo=time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/users/', $photo);
            $data['photo']=$photo;
        }

        $user=User::create($data);

        if ($user) {
            // $client_data=new User;
            // $client_data->name = request('name');
            // $client_data->lastname = request('lastname');
            // $client_data->email = request('email');
            // $client_data->password_customer = request('password');
            // $client_data->notify(new UserRegister());
            return redirect()->route('usuario.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El usuario ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('usuario.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {

        $user = User::where('slug', $slug)->firstOrFail();
        return view('admin.users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $user=User::where('slug', $slug)->firstOrFail();
        $stores=Store::all();
        return view('admin.users.edit', compact("user", "stores"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug) {

        $user = User::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'dni' => request('dni'), 'phone' => request('phone'), 'type' => request('type'));

        if (request('type')==2 || request('type')==3) {
            $store=Store::where('slug', request('store_id'))->firstOrFail();
            $data['store_id']=$store->id;
        } else {
            $data['store_id']=NULL;
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $photo=time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/users/', $photo);
            $data['photo']=$photo;
        }

        $user->fill($data)->save();

        if ($user) {
            return redirect()->route('usuario.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El usuario ha sido editado exitosamente.']);
        } else {
            return redirect()->route('usuario.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $user = User::where('slug', $slug)->firstOrFail();
        $user->fill($request->all())->save();

        if ($user) {
            return redirect()->route('usuario.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El usuario ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('usuario.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $user = User::where('slug', $slug)->firstOrFail();
        $user->fill($request->all())->save();

        if ($user) {
            return redirect()->route('usuario.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El usuario ha sido activado exitosamente.']);
        } else {
            return redirect()->route('usuario.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function emailVerify(Request $request)
    {
        $count=User::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }
}
