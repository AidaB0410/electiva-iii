<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use App\Order;
use App\Casher;
use App\DeliveryUser;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;
use Illuminate\Http\Request;
use App\Notifications\SendOrderNotification;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = Sale::orderBy('id', 'DESC')->get();
        $casher = User::where('type', 2)->where('state', 1)->get();
        $deliveryMan = User::where('type', 3)->where('state', 1)->get();
        $num = 1;
        return view('admin.sales.index', compact('sale', 'num', 'casher', 'deliveryMan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $order = Order::where('sale_id', '=', $sale->id)->get();
        $num = 1;
        return view('admin.sales.show', compact('sale', 'order', 'num'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $casher= User::where('slug', request('casher_id'))->firstOrFail();
        $deliveryMan= User::where('slug', request('delivery_man_id'))->firstOrFail();

        $delivery=DeliveryUser::create(['sale_id' => $sale->id, 'user_id' => $deliveryMan->id])->save();
        $casher=Casher::create(['sale_id' => $sale->id, 'user_id' => $casher->id])->save();
        
        if ($casher || $delivery) {
            return redirect()->route('venta.index')->with(['type' => 'success', 'title' => 'Asignación exitosa', 'msg' => 'Se ha asignado correctamente el cajero y repartidor correctamente.']);
        } else {
            return redirect()->route('venta.index')->with(['type' => 'error', 'title' => 'Asignación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function time(Request $request, $slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $today= date('Y-m-d H:i:s'); 
        $newDate = strtotime('+30 minute', strtotime($today)) ;  
        $newDate = date('Y-m-d H:i:s', $newDate);
        $sale->fill(['time_start' => date('Y-m-d H:i:s'), 'time_finish' => $newDate])->save();

        if ($sale) {
            // $client_data =new User;
            // $client_data->email = $sale->user->email;
            // $client_data->customer = User::find($sale->user_id);
            // $client_data->delivery = User::find($sale->deliveryUser->user_id);
            // $client_data->sale = Sale::find($sale->id);
            // $client_data->notify(new SendOrderNotification());

            return redirect()->route('venta.index')->with(['type' => 'success', 'title' => 'Asignación exitosa', 'msg' => 'Se ha iniciado el tiempo de entrega.']);
        } else {
            return redirect()->route('venta.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function state(Request $request, $slug)
    {
        $sale = Sale::where('slug', $slug)->firstOrFail();
        $sale->fill($request->all())->save();

        if ($sale) {
            return redirect()->route('venta.index')->with(['type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Se ha modificado correctamente el estado.']);
        } else {
            return redirect()->route('venta.index')->with(['type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
