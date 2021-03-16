<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryStoreRequest;
use App\Http\Requests\GalleryUpdateRequest;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $galleries = Gallery::all();
        $num = 1;
        return view('admin.galleries.index', compact('galleries', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryStoreRequest $request)
    {
        $count=Gallery::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Gallery::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $data=array('title' => request('title'), 'slug' => $slug, 'description' => request('description'), 'link' => request('link'), 'state' => request('state'));
                break;
            }
        }

        // Mover imagen a carpeta galleries y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/galleries/', $image);
            $data['image'] = $image;
        }

        $gallery=Gallery::create($data);

        if ($gallery) {
            return redirect()->route('galeria.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La galería ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('galeria.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, $slug) {

        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $data=array('title' => request('title'), 'description' => request('description'), 'link' => request('link'), 'state' => request('state'));

        // Mover imagen a carpeta galleries y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/galleries/', $image);
            $data['image'] = $image;
        }

        $gallery->fill($data)->save();

        if ($gallery) {
            return redirect()->route('galeria.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La galería ha sido editada exitosamente.']);
        } else {
            return redirect()->route('galeria.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function destroy($slug)
    {
        $gallery=Gallery::where('slug', $slug)->firstOrFail();
        $gallery->delete();

        if ($gallery) {
            return redirect()->route('galeria.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La galeria ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('galeria.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
