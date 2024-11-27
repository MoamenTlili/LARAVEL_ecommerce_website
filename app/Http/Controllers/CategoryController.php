<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{      
    public function index()
    {
        $categories = DB::table('productslist')->get();
        return view('admincategory', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|unique:productslist,id',
            'name' => 'required|unique:productslist,name|max:255',
            'description' => 'required', 
        ]);
    
        DB::table('productslist')->insert([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            
        ]);
    
        return redirect()->back()->with('message', 'Category added successfully');
    }

 
    public function delete_category($id)
    {
        $category = DB::table('productslist')->where('id', $id)->first();

        if ($category) {
            DB::table('productslist')->where('id', $id)->delete(); // Delete the category

            return redirect()->back()->with('message', 'Category Deleted Successfully');
        }

        return redirect()->back()->with('error', 'Category Not Found');
    }
}