<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Store;
use App\Size;
use App\ProductSizes;
use App\ProductStore;
use Illuminate\Support\Str;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $num = 1;
        return view('admin.products.index', compact('products', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        $sizes = Size::all();
        return view('admin.products.create', compact('stores', 'categories', 'sizes', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $count=Product::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Product::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $category=Category::where('slug', request('category_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'description' => nl2br(request('description')), 'category_id' => $category->id);
                break;
            }
        }

        // Mover imagen a carpeta products y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/products/', $image);
            $data['image'] = $image;
        }

        $product=Product::create($data);

        if (request('size-question')=="0") {
            $size=Size::where('slug', 'normal')->firstOrFail();
            ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => request('price-unique')]);
        } else {
            $sizes=request('size');
            $prices=request('price');
            for ($i=0; $i < count($sizes); $i++) { 
                $size=Size::where('slug', $sizes[$i])->firstOrFail();
                ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => $prices[$i]]);
            }
        }

        $stores=request('store_id');
        foreach($stores as $store) {
            $shop=Store::where('slug', $store)->firstOrFail();
            ProductStore::create(['product_id' => $product->id, 'store_id' => $shop->id]);
        }

        if ($product) {
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El producto ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product=Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $stores = Store::all();
        $sizes = Size::all();
        return view('admin.products.edit', compact('product', 'categories', 'stores', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $slug)
    {
        $product=Product::where('slug', $slug)->firstOrFail();

        $category=Category::where('slug', request('category_id'))->firstOrFail();
        $data=array('name' => request('name'), 'description' => nl2br(request('description')), 'state' => request('state'), 'category_id' => $category->id);

        // Mover imagen a carpeta products y extraer nombre
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/admins/img/products/', $image);
            $data['image'] = $image;
        }

        $product->fill($data)->save();

        foreach ($product->sizes as $size) {
            $ProductSize=ProductSizes::where('product_id', $product->id)->where('size_id', $size->id)->firstOrFail();
            $ProductSize->delete();
        }

        foreach ($product->stores as $store) {
            $ProductStore=ProductStore::where('product_id', $product->id)->where('store_id', $store->id)->firstOrFail();
            $ProductStore->delete();
        }

        if (request('size-question')=="0") {
            $size=Size::where('slug', 'normal')->firstOrFail();
            ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => request('price-unique')]);
        } else {
            $sizes=request('size');
            $prices=request('price');
            for ($i=0; $i < count($sizes); $i++) {
                $size=Size::where('slug', $sizes[$i])->firstOrFail();
                ProductSizes::create(['product_id' => $product->id, 'size_id' => $size->id, 'price' => $prices[$i]]);
            }
        }

        $stores=request('store_id');
        foreach($stores as $store) {
            $shop=Store::where('slug', $store)->firstOrFail();
            ProductStore::create(['product_id' => $product->id, 'store_id' => $shop->id]);
        }

        if ($product) {
            return redirect()->route('productos.edit', ['slug' => $slug])->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El producto ha sido editado exitosamente.']);
        } else {
            return redirect()->route('productos.edit', ['slug' => $slug])->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product=Product::where('slug', $slug)->firstOrFail();
        $product->delete();

        if ($product) {
            return redirect()->route('productos.index')->with(['type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El producto ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('productos.index')->with(['type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
