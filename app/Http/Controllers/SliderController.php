<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $sliders = Slider::all();
        $num = 1;
        return view('admin.sliders.index', compact('sliders', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request)
    {
        $count=Slider::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Slider::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $countActive=Slider::where('state', 1)->count();
                if ($countActive>=5 || request('state')==2) {
                    $state=2;
                } else {
                    $state=1;
                }
                $data=array('title' => request('title'), 'slug' => $slug, 'description' => request('description'), 'link' => request('link'), 'state' => $state);
                break;
            }
        }

        // Mover imagen a carpeta sliders y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/sliders/', $image);
            $data['image'] = $image;
        }

        $slider=Slider::create($data);

        if ($slider) {
            return redirect()->route('sliders.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El slider ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('sliders.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $slider=Slider::where('slug', $slug)->firstOrFail();
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, $slug) {

        $slider=Slider::where('slug', $slug)->firstOrFail();
        $countActive=Slider::where('state', 1)->count();
        if ($countActive>=5 || request('state')==2) {
            $state=2;
        } else {
            $state=1;
        }
        $data=array('title' => request('title'), 'description' => request('description'), 'link' => request('link'), 'state' => $state);

        // Mover imagen a carpeta sliders y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/sliders/', $image);
            $data['image'] = $image;
        }

        $slider->fill($data)->save();

        if ($slider) {
            return redirect()->route('sliders.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El slider ha sido editado exitosamente.']);
        } else {
            return redirect()->route('sliders.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function destroy($slug)
    {
        $slider=Slider::where('slug', $slug)->firstOrFail();
        $slider->delete();

        if ($slider) {
            return redirect()->route('sliders.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El slider ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('sliders.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
