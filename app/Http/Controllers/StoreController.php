<?php

namespace App\Http\Controllers;

use App\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\StoreUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        $num = 1;
        return view('admin.stores.index', compact('stores', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $count=Store::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Store::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'phone_one' => request('phone_one'), 'phone_two' => request('phone_two'), 'address' => request('address'));
                break;
            }
        }

        // Mover imagen a carpeta store y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/stores/', $image);
            $data['image'] = $image;
        }

        $store=Store::create($data);

        if ($store) {
            return redirect()->route('tienda.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La tienda ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('tienda.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $store=Store::where('slug', $slug)->firstOrFail();
        return view('admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $slug)
    {
        $store=Store::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'), 'phone_one' => request('phone_one'), 'phone_two' => request('phone_two'), 'address' => request('address'));

        // Mover imagen a carpeta stores y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/stores/', $image);
            $data['image'] = $image;
        }

        $store->fill($data)->save();

        if ($store) {
            return redirect()->route('tienda.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La tienda ha sido editada exitosamente.']);
        } else {
            return redirect()->route('tienda.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function desactivate(Request $request, $slug) {

        $store = Store::where('slug', $slug)->firstOrFail();
        $store->fill(['state' => 2])->save();

        if ($store) {
            return redirect()->route('tienda.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La tienda ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('tienda.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $store = Store::where('slug', $slug)->firstOrFail();
        $store->fill(['state' => 1])->save();

        if ($store) {
            return redirect()->route('tienda.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La tienda ha sido activada exitosamente.']);
        } else {
            return redirect()->route('tienda.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
