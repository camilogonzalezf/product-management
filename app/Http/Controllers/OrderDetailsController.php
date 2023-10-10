<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class Element {
            public $product;
    public $price;
    public $price_total;
    public $quantity;
    public $product_id;
    public $id;

    public function __construct($product, $price) {
        $this->id;
        $this->quantity = 0;
        $this->price_total = 0.0;
        $this->product = $product;
        $this->price = $price;
        }
    }

class OrderDetailsController extends Controller
{

    public function index($customer_id, $great_order_id, Request $request)
    {

        $thisOrder = Orders::find($great_order_id);
        $customer = Customers::find($customer_id);
        $orders = OrderDetails::where('order_id',$great_order_id)->get();
        $list = [];

        $totalInvoice = 0.0;
        foreach ($orders as $order){
                $element = new Element('product',0.0);
                $element->id = $order->id;
                $element-> product_id = $order->product_id;
                $element->product = Products::where('id',$order->product_id)->value('name_product');
                $element->quantity = $order->quantity;
                $element->price = Products::where('id',$order->product_id)->value('price');
                $element->price_total = $order->price_total;
                $list[]=$element;
                $totalInvoice = $totalInvoice + floatval($order->price_total);
        }
        $searchby = $request->get('searchby');
        $products = Products::where('name_product','like','%'.$searchby.'%')->get();
        return view('order-detail', [
            'totalInvoice' => $totalInvoice,
            'thisOrder'=>$thisOrder,
            'customer' => $customer,
            'products' => $products,
            'orders' => $list,
            'searchby'=>$searchby ,
            'great_order_id'=> $great_order_id]);
    }

    public function store($customer_id,$product_id,$great_order_id )
    {
        $order = new OrderDetails;
        $order->quantity= 0;
        $order->price_total=0.0;
        $order->order_id = $great_order_id;
        $order->product_id = $product_id;
        $order->save();
        return redirect()->route(
            'order-detail-show',
            ['customer_id'=>$customer_id,
            'great_order_id'=>$great_order_id])
            ->with('success', 'Detalle de orden creada correctamente');
    }

    public function update(Request $request, $customer_id,$order_id, $great_order_id, $product_id )
    {
        $order = OrderDetails::find($order_id);
        $product = Products::find($product_id);
        $thisOrder = Orders::find($order_id);
        $order->quantity= intval($request->quantity);
        $order->price_total=intval($request->quantity)*$product->price;
        $order->save();
        return redirect()->route(
            'order-detail-show',
            ['customer_id'=>$customer_id,
            'thisOrder'=> $thisOrder,
            'great_order_id'=>$great_order_id])
            ->with('success', 'Detalle de orden actualizada correctamente');
    }

    public function destroy( $order_id,$customer_id, $great_order_id){
        $order = OrderDetails::find($order_id);
        $order->delete();
        return redirect()->route('order-detail-show' ,['customer_id'=> $customer_id, 'great_order_id' => $great_order_id])->with('success', 'Orden borrada');
    }
}
