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
            $request->validate([
                'name_product' => 'required|min:3',
                'descripcion' => 'required|min:3',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
            ]);
            $products = new Products;
            $products->name_product = $request->name_product;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->category_id = $request->category_id;
            $products->save();
            return redirect()->route('products')->with('success', 'Producto registrado correctamente');
        }

        public function destroy($id){
            $products = Products::find($id);
            $products->delete();
            return redirect()->route('products')->with('success', 'Producto  eliminado');
        }
}
