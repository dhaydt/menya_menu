<?php

namespace App\CPU;

use App\Models\Cart;
use App\Models\CartGroup;
use App\Models\Config;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Outlet;
use App\Models\Price;
use App\Models\Table;
use Carbon\Carbon;

class Helpers
{
  public static function getTax($tax, $total){
    $hasil = $tax/100 * $total;
    return $hasil;
  }
  public static function getOutletPrice($id){
    $table_id = Helpers::getTableId();
    $table = Table::find($table_id);

    if($table){
      $outlet_id = $table['outlet_id'];

      $price = Price::where(['outlet_id' => $outlet_id, 'food_id' => $id])->orderBy('created_at', 'desc')->first();

      if($price){
        return $price['price'];
      }else{
        $food = Food::find($id);

        return $food['price'];
      }
    }else{
      return view('welcome');
    }

    
  }
  
  public static function getOutlet($id){
    $outlet = Outlet::find($id);

    if($outlet){
      $data = ['name' => $outlet['name'], 
            'address' => $outlet['address'], 
            'phone' => $outlet['phone']];

      return $data;
    }
    
    $data = ['name' => 'Solaria rest area KM 177', 
            'address' => 'Jl. Tol KM 97 Bandung Cikampek',
            'phone' => '0812345678'];

    return $data;
  }


  public static function dateFormat($date, $type){
    if($type == 'date'){
      $formatted = Carbon::parse($date)->format('d-m-Y');
    }else{
      $formatted = Carbon::parse($date)->format('d-m-Y H:i');
    }
    return $formatted;
  }
  public static function getTable()
  {

    return session()->get('table');
  }

  public static function getTableId(){

    $table_code = Helpers::getTable();

    $table = Table::where('token', $table_code)->first();

    if(!$table){
      return view('welcome');
    }

    return $table['id'];
  }

  public static function getBackendUrl($data)
  {
    $img = env('BACKEND_URL', 'https://dashboard.menyasakura.my.id') . '/storage/' . $data;

    return $img;
  }

  public static function token($length)
  {
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
  }

  public static function generateOrderId($initial, $date, $id)
  {
    $code = $initial . $date . str_pad($id, 6, "0", STR_PAD_LEFT);

    return $code;
  }

  public static function generateOrder()
  {
    $table_code = Helpers::getTable();

    $group = CartGroup::where('table_id', $table_code)->first();

    $table = Table::where('token', $table_code)->first();

    $user = session()->get('user_name');
    $phone = session()->get('phone');
    $paymeny_type = session()->get('payment');
    $order_type = session()->get('type');
    
    $payment_status = 'unpaid';

    $outlet = Outlet::find($table['outlet_id']);
    $date = date('dmY');

    if($outlet){
      $outlet_code = $outlet['code_order'] ?? 'LT';
      $order_counter = Order::where('outlet_id', $outlet['id'])->whereDate('created_at', date('Y-m-d'))->get()->count();

      $order_id = Helpers::generateOrderId($outlet_code, date('dmY'), $order_counter + 1);
    }else{
      $outlet_code = 'LT';
      $order_id = Helpers::generateOrderId('LT', $date, count(Order::all()) + 1);
    }



    if ($group && $table) {
      $order = new Order();
      $order->id = $order_id;
      $order->user_id = 0;
      $order->table_id = $table['id'];
      $order->payment_method = null;
      $order->payment_status = $payment_status;
      $order->payment_type = $paymeny_type;
      $order->order_status = 'waiting';
      $order->order_type = $order_type;
      $order->customer_name = $user;
      $order->customer_phone = $phone;
      $order->tax = $group['tax'];
      $order->service_charge = $group['service_charge'];
      $order->total = $group['total'];
      $order->outlet_id = $table['outlet_id'];
      $order->note = $group['note'];
      $order->on_going = 1;

      foreach ($group['cart'] as $c) {
        $item = new OrderDetail();
        $item->order_id = $order_id;
        $item->food_id = $c['food_id'];
        $item->qty = $c['qty'];
        $item->price = $c['price'];
        $item->total = $c['total'];
        $item->parent_id = $c['parent_id'];

        $item->save();
      }

      $order->save();
    }

    Helpers::emptyCart();

    return $order_id;
  }

  public static function emptyCart()
  {
    $table_code = Helpers::getTable();

    $group = CartGroup::where('table_id', $table_code)->get();

    foreach ($group as $g) {
      $group_id = $g['group_id'];
      $item = Cart::where('group_id', $group_id)->get();

      foreach ($item as $i) {
        $i->delete();
      }
      $g->delete();
    }
  }

  public static function getConfig($type){
    $config = Config::where('type', $type)->first();

    return $config;
  }
}
