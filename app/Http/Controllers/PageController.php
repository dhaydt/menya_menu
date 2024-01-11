<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice;
use Xendit\Invoice\InvoiceApi;
use Xendit\Xendit;

class PageController extends Controller
{
    public function welcome($table_token)
    {

        session()->put('table', $table_token);

        $table = Table::with('outlet')->where('token', $table_token)->first();
        $outlet = $table['outlet'];

        $data['outlet'] = $outlet;

        return view('pages.home.welcome', $data);
    }

    public function menu($type)
    {
        $table = Helpers::getTable();

        if ($table) {
            session()->put('type', $type);

            return view('pages.home.index');
        }

        return view('welcome');
    }

    public function detail($id)
    {
        $table = Helpers::getTable();

        if ($table) {
            $data['title'] = "Detail Product";
            $data['id'] = $id;

            return view('pages.details.index', $data);
        }

        return view('welcome');
    }
    
    public function category($id)
    {
        $table = Helpers::getTable();
        $category = Category::find($id);

        if ($table) {
            $data['title'] = $category['category'];
            $data['id'] = $id;

            return view('pages.category.index', $data);
        }

        return view('welcome');
    }

    public function bill_list()
    {
        $table = Helpers::getTable();

        if ($table) {
            $data['title'] = "Bill List";

            return view('pages.bill.index', $data);
        }

        return view('welcome');
    }

    public function cart_detail()
    {
        $table = Helpers::getTable();

        if ($table) {
            $data['title'] = "My Cart";

            return view('pages.cart.index', $data);
        }

        return view('welcome');
    }

    public function payment_method()
    {
        $table = Helpers::getTable();

        if ($table) {
            $data['title'] = "Detail";

            return view('pages.payment.index', $data);
        }

        return view('welcome');
    }

    public function generateInvoice()
    {
        $table = Helpers::getTable();

        if ($table) {
            $data['title'] = "Detail";
            $order_id = session()->get('order_id');
            $type = session()->get('payment_method');
            if($type){
                // dd($type);
                $order = Order::find($order_id);
    
                Xendit::setApiKey(config('xendit.xendit_apikey'));
    
                $value = $order['total'];
                $tran = $order_id;
                $name = session()->get('user_name');
                $phone = session()->get('phone');
                $address = Helpers::getOutlet($order['outlet_id'])['address'];
                $email = 'no_email@mail.com';
    
                $user = [
                    'given_names' => $name ? $name : 'invalid name',
                    'email' => $email,
                    'mobile_number' => $phone ? $phone : '0000',
                    'address' => $address ? $address : 'Invalid address data',
                ];
    
                // dd($user);
                $redirect_url = env('APP_URL') ? env('APP_URL') : 'https://menyasakura.my.id';
    
                $params = [
                    'external_id' => $tran,
                    'amount' => round($value, 0),
                    'payer_email' => $email,
                    'description' => env('APP_NAME') ? env('APP_NAME') : 'Menya Sakura',
                    'payment_methods' => [$type],
                    'fixed_va' => true,
                    'should_send_email' => true,
                    'customer' => $user,
                    // 'items' => $products,
                    'success_redirect_url' => $redirect_url . '/xendit-payment/success/' . $type . '/' . $order_id,
                ];
    
                $checkout_session = Invoice::create($params);
                return redirect()->away($checkout_session['invoice_url']);
            }
        }

        return view('welcome');
    }

    public function pay_now()
    {
        $table = Helpers::getTable();

        if ($table) {

            $order_id = session()->get('order_id');

            if ($order_id) {
                $data['title'] = "Payment";

                $order = Order::find($order_id);

                if ($order['payment_status'] == 'paid') {

                    return redirect()->route('detail_order', ['id' => $order_id]);
                } else {

                    return view('pages.payment.pay_now', $data);
                }
            }
        }

        return view('welcome');
    }

    public function payment_success($type, $order_id){
        $order = Order::find($order_id);
        if($order){
            $order->payment_method = $type;
            $order->payment_status = 'paid';
            $order->save();

            return redirect()->route('detail_order', ['id' => $order_id]);
        }
        dd('order not found');
    }

    public function order_success()
    {
        $table = Helpers::getTable();

        if ($table) {
            $data['title'] = "Order Complete";

            $table = Helpers::getTableId();

            $order = Order::where(['table_id' => $table, 'on_going' => 1])->whereDate('created_at', date('Y-m-d'))->orderBy('updated_at', 'desc')->first();
            // dd($order);
            $data['order_id'] = $order['id'];

            return view('pages.order.index', $data);
        }

        return view('welcome');
    }

    public function detail_order($id)
    {
        $table = Helpers::getTableId();

        $order = Order::find($id);

        $table = Helpers::getTable();

        if ($table && $order) {
            $data['title'] = "My Order";
            $data['order_id'] = $id;

            return view('pages.order.detail', $data);
        }

        return view('welcome');
    }
    
    public function request_payment($id)
    {
        $table = Helpers::getTableId();

        $order = Order::find($id);

        $table = Helpers::getTable();

        if ($table && $order) {
            $data['title'] = "Request Payment";
            $data['order_id'] = $id;

            return view('pages.order.detail', $data);
        }

        return view('welcome');
    }
}
