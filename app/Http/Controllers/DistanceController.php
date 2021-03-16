<?php

namespace App\Http\Controllers;

use App\Distance;
use App\Http\Requests\DistanceStoreRequest;
use App\Http\Requests\DistanceUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $distances = Distance::all();
        $num = 1;
        return view('admin.distances.index', compact('distances', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.distances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistanceStoreRequest $request)
    {
        $count=Distance::where('km', request('km'))->count();
        $slug=Str::slug(request('km')." kilometros", '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Distance::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('km')." kilometros", '-')."-".$num;
                $num++;
            } else {
                $data=array('km' => request('km'), 'slug' => $slug, 'price' => request('price'));
                break;
            }
        }

        $distance=Distance::create($data);

        if ($distance) {
            return redirect()->route('distancias.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La distancia ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('distancias.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $distance=Distance::where('slug', $slug)->firstOrFail();
        return view('admin.distances.edit', compact('distance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(DistanceUpdateRequest $request, $slug) {

        $distance=Distance::where('slug', $slug)->firstOrFail();
        $distance->fill($request->all())->save();

        if ($distance) {
            return redirect()->route('distancias.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La distancia ha sido editada exitosamente.']);
        } else {
            return redirect()->route('distancias.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $distance=Distance::where('slug', $slug)->firstOrFail();
        $distance->delete();

        if ($distance) {
            return redirect()->route('distancias.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La distancia ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('distancias.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
