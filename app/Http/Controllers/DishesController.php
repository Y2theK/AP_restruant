<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\DishCreateRequest;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $dishes = Dish::all();
        // return($dishes);
        
        return view('Kitchen.dish', [
            'dishes' => $dishes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Kitchen.dish_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishCreateRequest $request)
    {
        // dd($request->all());
        $dish = new Dish;
        $dish->name = $request->name;
        $dish->category_id = $request->category;
        $imageName = date('YmdHis').".".$request->dish_image->getClientOriginalExtension();
        $request->dish_image->move(public_path('images'), $imageName);
        $dish->image = $imageName;
        $dish->save();
        return redirect('/dish')->with('message', 'Dish Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('Kitchen.dish_edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            
        ]);
        $dish->name = $request->name;
        $dish->category_id = $request->category;
        if ($request->dish_image) {
            $imageName = date('YmdHis').".".$request->dish_image->getClientOriginalExtension();
            $request->dish_image->move(public_path('images'), $imageName);
            $dish->image = $imageName;
        }
        $dish->save();
        return redirect('/dish')->with('message', 'Dish Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect('/dish')->with('message', 'Dish Delete Successfully.');
    }
    public function order()
    {
        $orders = Order::whereIn('status', [1,2])->get();
        $status = array_flip(config('ap_res.order_status'));
        return view('Kitchen.order', compact('orders', 'status'));
    }
    public function approve(Order $order)
    {
        $order->status = config('ap_res.order_status.processing');
        $order->save();
        return redirect('/order')->with('message', 'Your food is cooking now');
    }
    public function cancel(Order $order)
    {
        $order->status = config('ap_res.order_status.cancel');
        $order->save();
        return redirect('/order')->with('message', 'Sorry Your food has been cancel.');
    }
    public function ready(Order $order)
    {
        $order->status = config('ap_res.order_status.ready');
        $order->save();
        return redirect('/order')->with('message', 'Your food is ready to serve');
    }
}
