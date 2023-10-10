<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $searchby = $request->get('searchby');
        $orders = Orders::all();
        $customers = Customers::where('name_customer','like','%'.$searchby.'%')->get();
        return view('orders', ['orders' => $orders , 'customers' => $customers,'searchby'=>$searchby]);
    }

    public function store($customer_id)
        {
            $order = new Orders;
            $order->total = 0.0;
            $order->customer_id = $customer_id;
            $order->save();
            return redirect()->route('order-detail-show', ['customer_id' => $customer_id, 'great_order_id' => $order->id])->with('success', 'Orden creada correctamente');
        }
}
