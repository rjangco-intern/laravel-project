<?php

namespace App\Http\Controllers;
use Image;
use Input;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()  // fetch all products
        {
            //$categories = Category::with('name')->get();
            $products = Product::all();
            return view('products.index')->with(['products' => $products]);
        }

        public function showCreateForm(Product $products){
            $categories = DB::table('categories')->pluck('name', 'category_id'); 
        	return view('products.create', compact('categories'));
        }
 
        public function create(Request $request)  // creates a new product
        {
            try{
     			 $image = $request->file('image');
    			 $new_name = $image->getClientOriginalName();
                 $img = Image::make($image)->resize(200,200);
                 $path = storage_path('app/public/products/' . $new_name);
                 $img->save($path);
    			 


            $product = Product::create([
                'name' => $request->name,
                'brand' => $request->brand,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'image' => 	$new_name,
            ]);

             $product->save();
             } 
                         catch (Exception $exception) {
                        return back()->withError($exception->getMessage())->withInput();

             }

            return redirect()->route('admin.products.index')->with('success', 'You have Successfuly Added an Item.');

        }
 
 
        public function edit($id)  //Update the Product
        {
        	$product = Product::find($id);
            $categories = Category::pluck('name', 'category_id');
        	return view('products.edit', compact('product', 'categories'));
        }

        public function update(Request $request, Product $product, $id)  //Update the Product
        {
            /*$request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'brand'=>'required',
            'description'=>'required',
            'quantity'=>'required',
            'price'=>'required',
        ]);
            $product->update($request->all()); */
            try {
                 $product= Product::findOrFail($id);
                 $product->update($request->all());
                    if($request ->hasFile('image')){
                        $image = $request->file('image');
                        $new_name = $image->getClientOriginalName();
                        $img = Image::make($image)->resize(200,200);
                        $path = storage_path('app/public/products/' . $new_name);
                        $product->image = $new_name;
                        $product->save();

                    }
        
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->withError($exception->getMessage());
    }

           /* $product = Product::find($id);
            $categories = Category::pluck('name', 'category_id');
            $name = $request->input('name');
            $category_id = $request->input('category_id');
            $brand = $request->input('brand');
            $description = $request->input('description');
            $price = $request->input('price');*/
           /* $image = $request->file('image');
                 $new_name = $image->getClientOriginalName();
                 $img = Image::make($image)->resize(200,200);
                 $path = 'image/' . $new_name;
                 $img->save($path);*/
           // DB::update('update products set name = ?,category_id=?,brand=?,description=?, image=? where id = ?',[$name,$category_id,$brand,$description, $id]);


            return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfuly');
        }
 
 
        public function destroy($id)  //deletes the product
        {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfuly');

        }
}
