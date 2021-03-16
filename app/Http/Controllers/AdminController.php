<?php

namespace App\Http\Controllers;

use App\Category;
use App\Sale;
use App\Product;
use App\Store;
use App\User;
use App\Notification;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
    	$stores=Store::count();
    	$products=Product::count();
    	$sales=Sale::count();
    	$categories=Category::count();
    	$actives=User::where('state', 1)->count();
    	$inactives=User::where('state', 2)->count();

        return view('admin.home', compact('stores', 'products', 'sales', 'categories', 'actives', 'inactives'));
    }

    public function addNotifications() {
        $countNotifications=Notification::where('user_id', Auth::user()->id)->count();
        if ($countNotifications>0) {
            $countNotificationsActive=Notification::where([['user_id', Auth::user()->id], ['state', 0]])->count();
            if ($countNotificationsActive>3) {
                $notifications=Notification::where([['user_id', Auth::user()->id], ['state', 0]])->orderBy('id', 'DESC')->get();
            } else {
                $notifications=Notification::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->limit(3)->get();
            }
            return response()->json(['status' => true, 'data' => $notifications]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function openNotifications() {
        $notifications=Notification::where('user_id', Auth::user()->id)->where('state', "0")->get();
        foreach ($notifications as $notification) {
            $notification->fill(['state' => "1"])->save();
        }

        return response()->json(['status' => true]);
    }
}
