<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
        {
            $products = Products::all();
            $categories = Categories::all();
            return view('register-product', ['products' => $products , 'categories' => $categories]);
        }

    public function store(Request $request)
        {
            // $request->validate([
            //     'name_customer' => 'required|min:3',
            //     'email' => 'required|email',
            // ]);
            $customer = new Products;
            $customer->name_product = $request->name_product;
            $customer->description = $request->description;
            $customer->price = $request->price;
            $customer->category_id = $request->category_id;
            $customer->save();
            return redirect()->route('products')->with('success', 'Producto registrado correctamente');
        }

        public function destroy($id){
            $customer = Products::find($id);
            $customer->delete();
            return redirect()->route('products')->with('success', 'Producto  eliminado');
        }
}
