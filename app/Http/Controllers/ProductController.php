<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Response;
use App\ProductImages;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $product = Product::select('products.id','products.title','products.price','category.name')
                            ->leftJoin('category','products.category_id','category.id')
                            ->orderBy('products.order','ASC')->get();
        return view('product.index',compact('product'));
        
    }
    
    public function add(Request $request) {
        $category = Category::all();
        return view('product.add',compact('category'));
        
    }
    
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required||regex:/^\d+(\.\d{1,2})?$/',
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('/product/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        $product = new Product();
        $product->title = $request->product_title;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->order = 1;
        $product->save();
        
        if($request->hasfile('imageFile')) {
            foreach($request->file('imageFile') as $key => $file)
            {
                $name = time().$key.'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/', $name);  
                
                $fileModal = new ProductImages();
                $fileModal->image = $name;
                $fileModal->product_id = $product->id;
                $fileModal->save();
            }
        }
        return redirect('/')->with('success', 'Product create successfully!');
    }
    
    
    public function editView($id)
    {   
        $product = Product::with('productImages')->first();
        $category = Category::all();
        return view('product.edit', compact('product','category'));
    }
    
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'product_title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required||regex:/^\d+(\.\d{1,2})?$/',
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('/product/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $product = Product::find($id);
        $product->title = $request->product_title;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        
        if($request->hasfile('imageFile')) {
            foreach($request->file('imageFile') as $key => $file)
            {
                $name = time().$key.'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/', $name);  
                
                $fileModal = new ProductImages();
                $fileModal->image = $name;
                $fileModal->product_id = $product->id;
                $fileModal->save();
            }
        }
        return redirect('/')->with('success', 'Product update successfully!');
    }
    
    public function destroy(Request $request)
    {
        $status = Product::where('id',$request->productId)->delete();
        if($status){
            ProductImages::where('product_id',$request->productId)->delete();
        }
        return 1;
    }
    
    public function sortable(Request $request)
    {
        $product = Product::all();

        foreach ($product as $p) {
            foreach ($request->order as $order) {
                if ($order['id'] == $p->id) {
                    $p->update(array('order' => $order['position']));
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}