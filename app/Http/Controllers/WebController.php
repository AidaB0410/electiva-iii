<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Size;
use App\Store;
use App\Distance;
use App\Sale;
use App\Order;
use App\User;
use App\Slider;
use App\Gallery;
use App\Page;
use App\Service;
use App\Notification;
use App\Http\Requests\SaleStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderNotification;
use Twilio\Rest\Client;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
    	$products=Product::where('category_id', '!=', 3)->where('state', 1)->limit(8)->get();
        $promotions=Product::where('category_id', 3)->where('state', 1)->limit(8)->get();
        $sliders=Slider::where('state', 1)->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.home', compact('products', 'promotions', 'sliders', 'cart'));
    }

    public function about(Request $request) {
        $pages=Page::where('state', 1)->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.about', compact('pages', 'cart'));
    }

    public function services(Request $request) {
        $services=Service::where('state', 1)->get();
        $num=1;
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.services', compact('services', 'num', 'cart'));
    }

    public function menu(Request $request) {
        $categories=Category::all();
        $products=Product::where('state', 1)->orderBy('category_id', 'ASC')->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.menu', compact('categories', 'products', 'cart'));
    }

    public function gallery(Request $request) {
        $galleries=Gallery::where('state', 1)->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.gallery', compact('galleries', 'cart'));
    }

    public function location(Request $request) {
        $stores=Store::where('state', 1)->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        return view('web.location', compact('stores', 'cart'));
    }

    public function product(Request $request, $slug) {
        $product=Product::where('slug', $slug)->firstOrFail();
        $products=Product::where('id', '!=', $product->id)->limit(4)->get();
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        
        return view('web.product', compact('product', 'products', 'cart'));
    }

    public function cart(Request $request) {
        $total=0;
        $products=[];
        if ($request->session()->has('cart')) {
            $cart=session('cart');
            $request->session()->forget('cart');
            $num=0;
            foreach ($cart as $cartProduct) {
                $size=Size::where('slug', $cartProduct['size_slug'])->first();
                $product=Product::join('product_size', 'products.id', '=', 'product_size.product_id')->where('products.slug', $cartProduct['product_slug'])->where('product_size.size_id', $size->id)->first();

                $products[$num]['product']=$product;
                $products[$num]['size']=$size;
                $products[$num]['qty']=$cartProduct['qty'];
                $products[$num]['code']=$cartProduct['code'];
                $total+=$product->price*$cartProduct['qty'];

                if ($num==0) {
                    $request->session()->put('cart', array(0 => ['name' => $product->name, 'qty' => $cartProduct['qty'], 'price' => $product->price, 'subtotal' => number_format($product->price*$cartProduct['qty'], 2, ',', '.'), 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'code' => $cartProduct['code']]));
                } else {
                    $request->session()->push('cart', array('name' => $product->name, 'qty' => $cartProduct['qty'], 'price' => $product->price, 'subtotal' => number_format($product->price*$cartProduct['qty'], 2, ',', '.'), 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'code' => $cartProduct['code']));
                }
                $num++;  
            }
        }
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;

        return view('web.cart', compact("products", "cart", "total"));
    }

    public function addProduct(Request $request) {
        $exists=Product::where('slug', request('slug'))->exists();
        if ($exists) {
            $product=Product::with(['stores', 'sizes'])->where('slug', request('slug'))->first();
            return response()->json(['status' => true, 'product' => $product]);
        }

        return response()->json(['status' => false]);
    }

    public function addCart(Request $request) {
    	if (request('qty')>0 && !empty(request('size'))) {
    		$exists=Product::where('slug', request('slug'))->exists();

    		if ($exists) {
                $size=Size::where('slug', request('size'))->first();
                $product=Product::join('product_size', 'products.id', '=', 'product_size.product_id')->where('products.slug', request('slug'))->where('product_size.size_id', $size->id)->first();
                $code=$product->id.$size->id;

                if ($request->session()->has('cart')) {
                    $cart=session('cart');

                    if (array_search($code, array_column($cart, 'code'))!==false) {

                        $key=array_search($code, array_column($cart, 'code'));
                        $cart[$key]['qty']=$cart[$key]['qty']+request('qty');
                        $subtotal=$product->price*$cart[$key]['qty'];
                        $cart[$key]['price']=$product->price;
                        $cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
                        $request->session()->put('cart', $cart);

                        return response()->json(['status' => true, 'cart' => session('cart')]);

                    } else {
                        $subtotal=$product->price*request('qty');
                        $request->session()->push('cart', array('name' => $product->name, 'qty' => request('qty'), 'price' => $product->price, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'code' => $code));

                        return response()->json(['status' => true, 'cart' => session('cart')]);
                    }
                } else {
                    $subtotal=$product->price*request('qty');
                    $request->session()->push('cart', array('name' => $product->name, 'qty' => request('qty'), 'price' => $product->price, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'product_slug' => $product->slug, 'size_slug' => $size->slug, 'size' => $size->name, 'code' => $code));

                    return response()->json(['status' => true, 'cart' => session('cart')]);
                }
            }
        }

        return response()->json(['status' => false]);
    }

    public function removeCart(Request $request) {

        if ($request->session()->has('cart')) {
            $cart=session('cart');

            if (array_search(request('code'), array_column($cart, 'code'))!==false) {
                $request->session()->forget('cart');
                $num=0;
                foreach ($cart as $product) {
                    if (request('code')!=$product['code']) {
                        if ($num==0) {
                            $request->session()->put('cart', array(0 => ['name' => $product['name'], 'qty' => $product['qty'], 'price' => $product['price'], 'subtotal' => $product['subtotal'], 'product_slug' => $product['product_slug'], 'size_slug' => $product['size_slug'], 'size' => $product['size'], 'code' => $product['code']]));
                        } else {
                            $request->session()->push('cart', array('name' => $product['name'], 'qty' => $product['qty'], 'price' => $product['price'], 'subtotal' => $product['subtotal'], 'product_slug' => $product['product_slug'], 'size_slug' => $product['size_slug'], 'size' => $product['size'], 'code' => $product['code']));
                        }
                        $num++;
                    }
                }
                return response()->json(['status' => true]);
            }
        }

        return response()->json(['status' => false]);
    }

    public function qtyCart(Request $request) {
        if (request('qty')>0 && !empty(request('size')) && !empty(request('slug')) && !empty(request('code'))) {
            $exists=Product::where('slug', request('slug'))->exists();
            if ($exists) {
                $size=Size::where('slug', request('size'))->first();
                $product=Product::join('product_size', 'products.id', '=', 'product_size.product_id')->where('products.slug', request('slug'))->where('product_size.size_id', $size->id)->first();

                $cart=session('cart');
                if (array_search(request('code'), array_column($cart, 'code'))!==false) {

                    $key=array_search(request('code'), array_column($cart, 'code'));
                    $cart[$key]['qty']=request('qty');
                    $subtotal=$product->price*$cart[$key]['qty'];
                    $cart[$key]['price']=$product->price;
                    $cart[$key]['subtotal']=number_format($subtotal, 2, ',', '.');
                    $request->session()->put('cart', $cart);

                    return response()->json(['status' => true, 'subtotal' => number_format($subtotal, 2, ',', '.'), 'cart' => session('cart')]);

                }
            }
        }

        return response()->json(['status' => false]);
    }

    public function checkout(Request $request)
    {
        $total=0;
        if ($request->session()->has('cart')) {
            $cart=session('cart');
            foreach ($cart as $cartProduct) {
                $total+=$cartProduct['price']*$cartProduct['qty'];
            }

            $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
           

            return view('web.checkout', compact('cart', 'total'));
        }

        return redirect()->route('web.cart');
    }

    public function saleStore(SaleStoreRequest $request) {
        $count=Sale::count();
        $slug=Str::slug('venta', '-');
        if ($count>0) {
            $slug="venta-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Sale::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="venta-".$num;
                $num++;
            } else {
                $subtotal=0;
                $cart=session('cart');
                foreach ($cart as $cartProduct) {
                    $subtotal+=$cartProduct['price']*$cartProduct['qty'];
                }
                $total=$subtotal;
                $data = array('slug' => $slug, 'user_id' => Auth::user()->id, 'phone' => request('phone'), 'reference' => request('reference'), 'type_pay' => request('type_pay'), 'address' => request('address'), 'subtotal' => $subtotal, 'total' => $total, 'user_id' => Auth::user()->id); 

                if (Auth::user()->phone==NULL) {
                    $user = User::find(Auth::user()->id);
                    $dataUser = array('phone' => $request->phone);
                    $user->fill($dataUser)->save();  
                }

                if (Auth::user()->dni==NULL) {
                    $user = User::find(Auth::user()->id);
                    $dataUser = array('dni' => $request->dni);
                    $user->fill($dataUser)->save();
                }
                break;
            }

        }

        $sale=Sale::create($data);

        $cart=session('cart');
        foreach ($cart as $order) {
            $product = Product::where('slug', $order['product_slug'])->firstOrFail();
            $size = Size::where('slug', $order['size_slug'])->firstOrFail();

            $data = array('sale_id' => $sale->id, 'product_id' => $product->id, 'size_id' => $size->id, 'price' => $order['price'], 'qty' => $order['qty']);
            Order::create($data)->save();
        }

        if ($sale) {
            // $client_data =new User;
            // $client_data->email = 'otters.c.01@gmail.com';
            // $client_data->user = User::find(Auth::user()->id);
            // $client_data->user->phone_customer = request('phone');
            // $client_data->user->address = request('address');
            // $client_data->sale = Sale::find($sale->id);
            // $client_data->type = 1;
            // $client_data->notify(new OrderNotification());

            // $client_data =new User;
            // $client_data->email = Auth::user()->email;
            // $client_data->user = User::find(Auth::user()->id);
            // $client_data->user->phone_customer = request('phone');
            // $client_data->user->address = request('address');
            // $client_data->sale = Sale::find($sale->id);
            // $client_data->type = 0;
            // $client_data->notify(new OrderNotification());

            // $account_sid = 'ACc4c85e83d34bf3e7869c968832f76af4';
            // $auth_token = 'd02f18c3c10e9c3f9bba9f292b28008c';
            // $twilio_number = "+12486483589";

            // $client = new Client($account_sid, $auth_token);
            // $client->messages->create(
            //     '+584124431725',
            //     array(
            //         'from' => $twilio_number,
            //         'body' => 'Ha sido realizado un nuevo pedido.'
            //     )
            // );

            // $users=User::where('type', '1')->where('state', 1)->get();
            // foreach ($users as $user) {
            //     $data=array('title' => "Nuevo Pedido", 'description' => "Ha sido realizado un nuevo pedido", 'type' => 1, 'user_id' => $user->id);
            //     Notification::create($data)->save();
            // }

            $request->session()->forget('cart');
            return redirect()->route('pago.index')->with(['type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La compra ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('pago.create')->with(['type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function shopping(Request $request) {
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        $sales = Sale::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $num = 1;

        return view('web.orders', compact('cart', 'sales', 'num'));
    }

    public function orderProduct(Request $request, $slug) {
        $cart=($request->session()->has('cart')) ? count(session('cart')) : 0 ;
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $num = 1;

        return view('web.order_product', compact('cart', 'sale', 'num'));
    }

}
