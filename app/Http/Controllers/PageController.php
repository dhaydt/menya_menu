<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome($table_token){

        session()->put('table', $table_token);

        return view('pages.home.welcome');
    }

    public function menu($type){
        $table = Helpers::getTable();

        if($table){
            session()->put('type', $type);
    
            return view('pages.home.index');
        }

        return view('welcome');
    }

    public function detail($id){
        $table = Helpers::getTable();

        if($table){
            $data['title'] = "Detail Product";
            $data['id'] = $id;

            return view('pages.details.index', $data);
        }

        return view('welcome');
    }
    
    public function bill_list(){
        $table = Helpers::getTable();

        if($table){
            $data['title'] = "Bill List";

            return view('pages.bill.index', $data);
        }

        return view('welcome');
    }

    public function cart_detail(){
        $table = Helpers::getTable();

        if($table){    
            $data['title'] = "My Cart";

            return view('pages.cart.index', $data);
        }

        return view('welcome');
    }

    public function payment_method(){
        $table = Helpers::getTable();

        if($table){
            $data['title'] = "Detail";
    
            return view('pages.payment.index', $data);
        }

        return view('welcome');
    }

    public function order_success(){
        $table = Helpers::getTable();

        if($table){
            $data['title'] = "Order Complete";

            $table = Helpers::getTableId();

            $order = Order::where(['table_id' => $table, 'on_going' => 1])->orderBy('created_at', 'desc')->first();
            $data['order_id'] = $order['id'];
    
            return view('pages.order.index', $data);
        }

        return view('welcome');
    }
    
    public function detail_order($id){
        $table = Helpers::getTableId();

        $order = Order::find($id);

        $table = Helpers::getTable();

        if($table && $order){
            $data['title'] = "My Order";
            $data['order_id'] = $id;
    
            return view('pages.order.detail', $data);
        }

        return view('welcome');
    }
}
