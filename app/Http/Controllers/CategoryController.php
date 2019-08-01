<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
     public function create(Request $request)  // creates a new product
        {

            $category = Category::create([
                'name' => $request->name
            ]);

            $category->save();

            return redirect()->route('admin.categories.index')->with('success', 'You have Successfuly Added a Category.');

        }

        public function showCreateForm(){
        	return view('categories.create');
        }
        public function index()  // fetch all products
        {
            $categories = Category::all();
            return view('categories.index')->with('categories', $categories);
        }
        public function edit($id)  //Update the Product
        {
        	$category = Category::find($id);
        	return view('categories.edit', compact('category'));
        }

        public function update(Request $request, Category $category)  //Update the Product
        {
            $request->validate([
            'name'=>'required'
        ]);
 
            $category->update($request->all()); 

            return redirect()->route('admin.categories.index')->with('success', 'Category Updated Successfuly');
        }
        public function destroy($id)  //deletes the product
        {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category Deleted Successfuly');

        }

}
