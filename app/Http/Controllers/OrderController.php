<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        $tables = Table::all();
        $dishes = Dish::orderBy('id', 'desc')->get();
        $orders = Order::whereIn('status', [3,4])->get();
        $status = array_flip(config('ap_res.order_status'));
        return view('order_form', compact('dishes', 'tables', 'orders', 'status'));
    }
    public function submit(Request $request)
    {
        //array_filter function remove array keys whose array values are null
        //$request->except('_token') remove _token of the form

        
        $data = (array_filter($request->except('_token', 'table')));
     
        foreach ($data as $key=>$value) {
            $orderId = rand(1000, 9999);
            if ($value > 1) {
                for ($i=0; $i < $value; $i++) {
                    $this->saveOrder($key, $orderId, $request);
                }
            } else {
                $this->saveOrder($key, $orderId, $request);
            }
        }
        return redirect('/')->with('message', 'Order Sumitted Successfylly');
    }
    public function saveOrder($dish_id, $order_id, $request)
    {
        $order = new Order;
        $order->dish_id = $dish_id;
        $order->order_id = $order_id;
        $order->table_id = $request->table;
        $order->status = config('ap_res.order_status.new');
        $order->save();
    }
    public function serve(Order $order)
    {
        $order->status = config('ap_res.order_status.done');
        $order->save();
        return redirect('/')->with('message', 'Your order has been served');
    }
    public function notifyCancel(Order $order)
    {
        $order->status = config('ap_res.order_status.done');
        $order->save();
        return redirect('/')->with('message', 'Your order has been notify cancelling');
    }
}
