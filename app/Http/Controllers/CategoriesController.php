<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Categories::all();
        return view('register-category', ['categories' => $categories]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_category' => 'required|min:3',
        ]);
        $category = new Categories;
        $category->name_category = $request->name_category;
        $category->save();
        return redirect()->route('categories')->with('success', 'Categoría registrada correctamente');
    }

    public function destroy($id){
            $category = Categories::find($id);
            $category->delete();
            return redirect()->route('categories')->with('success', 'Categoría eliminada');
    }
}
