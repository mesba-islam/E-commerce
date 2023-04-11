<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function CreateProduct(){
        $categories = Category::get();
        // dd($categories);
        return view('admin.createproduct', compact('categories'));
    }

    public function storeProduct(request $request){

        $validator = Validator::make($request->all(), [
            'product_title' => 'required',
            'category_id' => 'required',
            'quantity' => 'required|integer',
            // 'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 400);
        }

        $slug = $request->slug ?? Str::slug($request->product_title);

        $product = new Product();
        $product->product_title = $request->product_title;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->thumbnail = $request->thumbnail;
        $product->gallery = $request->gallery;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->featured = $request->featured;
        $product->save();

        // $product = Product::create($validateData);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('public/thumbnails', $filename);
            $product->thumbnail = 'storage/thumbnails/' . $filename;
            $product->save();
        }

        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            $filename = time() . '_' . $gallery->getClientOriginalName();
            $gallery->storeAs('public/thumbnails', $filename);
            $product->gallery = 'storage/thumbnails/' . $filename;
            $product->save();
        }

        return redirect()->route('allproduct')->with('message', 'product Added Successfully!');
    }

    public function ajaxSubcat(Request $request){
        $cat_id = $request->category_id;
        $subcategories = SubCategory::where('category_id', $cat_id)->get();
        // dd($subcategories);

        $response_string = '';
        $response_string .= '<option >Choose subcategory</option>';

        foreach($subcategories as $subcategory) {

            $response_string .= '<option value="'. $subcategory->id .'" >'. $subcategory->subcategory_name .'</option>';
        }



        // dd($response_string);
        // return Response::json($subcategories);

        echo json_encode(['status' => 'success', 'message' => $response_string]);
    }


    public function allProduct(){

        $products = Product::with('category')->get();
        // dd($products->[(category->category_name)]);
        return view('admin.allproduct', compact('products'));
    }

    public function editProduct($id){
        $product_info = Product::FindOrFail($id);
        // dd($product_info);
        return view('admin.editproduct', compact('product_info'));
    }

    public function ajaxSubcategory(Request $request){
        // $cat_id = $request->category_id;

        // $subcategories = SubCategory::where('category_id', $cat_id )->get();
        $subcategory_id = $request->subcategory_id;
        $product = Product::with('category')->where('subcategory_id', $subcategory_id)->get();
        // dd($subcategories);

        $response_string = '';
        $response_string .= '<option >Choose subcategory</option>';

        foreach($product as $subcategory) {
            $selected = ($subcategory->id == $request->subcategory_id) ? 'selected' : '';
            $response_string .= '<option value="'. $subcategory->id .'" '. $selected .'>'. $subcategory->subcategory_name .'</option>';
        }



        // dd($response_string);
        // return Response::json($subcategories);

        echo json_encode(['status' => 'success', 'message' => $response_string]);
    }
            public function updateProduct(Request $request, $id)
        {
            // $product_id = $request->product_id;

            $validator = Validator::make($request->all(), [
                'product_title' => 'required',
                'category_id' => 'required',
                'quantity' => 'required|integer',
                // 'status' => 'required|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $slug = $request->slug ?? Str::slug($request->product_title);

            $product = Product::find($id);
            $product->product_title = $request->product_title;
            $product->slug = $slug;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->price = $request->price;
            $product->sale_price = $request->sale_price;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->status = $request->status;
            $product->featured = $request->featured;
            $product->save();

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $filename = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('public/thumbnails', $filename);
                $product->thumbnail = 'storage/thumbnails/' . $filename;
                $product->save();
            }

            if ($request->hasFile('gallery')) {
                $gallery = $request->file('gallery');
                $filename = time() . '_' . $gallery->getClientOriginalName();
                $gallery->storeAs('public/thumbnails', $filename);
                $product->gallery = 'storage/thumbnails/' . $filename;
                $product->save();
            }

            return redirect()->route('allproduct')->with('message', 'Product Updated Successfully!');
        }

        public function deleteProduct($id){
            Product::FindOrFail($id)->delete();

            return redirect()->route('allproduct')->with('message', 'Product deleted Successfully!');
        }


}
