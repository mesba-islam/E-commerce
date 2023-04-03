<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function CreateProduct(){
        $categories = Category::get();
        // dd($categories);
        return view('admin.createproduct', compact('categories'));
    }

    public function StoreProduct(request $request){
        $request->validate([
            'product_title' => 'required|unique:products'
        ]);
        Product::insert([
            'product_title' => $request->product_title,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory,
            'slug' => strtolower(str_replace(' ','_', $request->title)),
            'thumbnail'=> $request->thumbnail,
            'gallery' => $request->gallery,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'description' => $request->description,
            'quantity' => $request->quantity,
            // 'status' => $request->status,
            // 'featured' => $request->featured,
        ]);

        $input = $request->all();
        if($request->hasFile('thumbnail')){
            $destination_path = 'public/images/products';
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $thumbnail->getClientOriginalName();
            $path = $request->file('thumbnail')->storeAs($destination_path, $thumbnail_name);

            $input['thumbnail'] = $thumbnail_name;

        }

        if($request->hasFile('gallery')){
            $destination_path = 'public/images/products';
            $gallery = $request->file('gallery');
            $gallery_name = $gallery->getClientOriginalName();
            $path = $request->file('gallery')->storeAs($destination_path, $gallery_name);

            $input['gallery'] = $gallery_name;

        }
        return redirect()->route('allproduct')->with('message', 'product Added Successfully!');
    }

    public function ajaxSubcat(Request $request){
        $cat_id = $request->category_id;
        $subcategories = SubCategory::where('category_id', $cat_id)->get();
        // dd($subcategories);

        $response_string = '';
        foreach($subcategories as $subcategory) {
            $response_string .= '<option value="'. $subcategory->id .'">'. $subcategory->subcategory_name .'</option>';
        }



        // dd($response_string);
        // return Response::json($subcategories);

        echo json_encode(['status' => 'success', 'message' => $response_string]);
    }


    public function allProduct(){
        return view('admin.allproduct');
    }
}
