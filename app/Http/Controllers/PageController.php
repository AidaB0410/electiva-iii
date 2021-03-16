<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pages = Page::all();
        $num = 1;
        return view('admin.pages.index', compact('pages', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        $count=Page::where('title', request('title'))->count();
        $slug=Str::slug(request('title'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Page::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('title'), '-')."-".$num;
                $num++;
            } else {
                $data=array('title' => request('title'), 'slug' => $slug, 'description' => request('description'), 'link' => request('link'), 'state' => request('state'));
                break;
            }
        }

        // Mover imagen a carpeta pages y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/pages/', $image);
            $data['image'] = $image;
        }

        $page=Page::create($data);

        if ($page) {
            return redirect()->route('paginas.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La página ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('paginas.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $page=Page::where('slug', $slug)->firstOrFail();
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $slug) {

        $page=Page::where('slug', $slug)->firstOrFail();
        $data=array('title' => request('title'), 'description' => request('description'), 'link' => request('link'), 'state' => request('state'));

        // Mover imagen a carpeta pages y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/pages/', $image);
            $data['image'] = $image;
        }

        $page->fill($data)->save();

        if ($page) {
            return redirect()->route('paginas.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La página ha sido editada exitosamente.']);
        } else {
            return redirect()->route('paginas.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function destroy($slug)
    {
        $page=Page::where('slug', $slug)->firstOrFail();
        $page->delete();

        if ($page) {
            return redirect()->route('paginas.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La página ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('paginas.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
