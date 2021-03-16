<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $services = Service::all();
        $num = 1;
        return view('admin.services.index', compact('services', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        $count=Service::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Service::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $data=array('title' => request('title'), 'slug' => $slug, 'description' => request('description'), 'state' => request('state'));
                break;
            }
        }

        // Mover imagen a carpeta services y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/services/', $image);
            $data['image'] = $image;
        }

        $service=Service::create($data);

        if ($service) {
            return redirect()->route('servicios.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El servicio ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('servicios.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $service=Service::where('slug', $slug)->firstOrFail();
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $slug) {

        $service=Service::where('slug', $slug)->firstOrFail();
        $data=array('title' => request('title'), 'description' => request('description'), 'state' => request('state'));

        // Mover imagen a carpeta services y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/services/', $image);
            $data['image'] = $image;
        }

        $service->fill($data)->save();

        if ($service) {
            return redirect()->route('servicios.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El servicio ha sido editado exitosamente.']);
        } else {
            return redirect()->route('servicios.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function destroy($slug)
    {
        $service=Service::where('slug', $slug)->firstOrFail();
        $service->delete();

        if ($service) {
            return redirect()->route('servicios.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El servicio ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('servicios.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
