<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Category(){
        $categories = category::latest()->get();
        return view('admin.category', compact('categories'));

    }

    public function AddCategory(){
        return view('admin.addcategory');
    }

    public function StoreCategory(request $request){
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','_', $request->category_name))
        ]);
        return redirect()->route('allcategory')->with('message', 'Category Added Successfully!');
    }

    public function EditCategory($id){
        $category_info = category::FindOrFail($id);

        return view('admin.editcategory', compact('category_info'));
    }

    public function UpdateCategory(Request $request){
        $category_id = $request->category_id;

        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','_', $request->category_name))
        ]);

        return redirect()->route('allcategory')->with('message','category Update Successfully');
    }

    public function DeleteCategory($id){
        category::FindOrFail($id)->delete();

        return redirect()->route('allcategory')->with('message', 'Category deleted Successfully!');
    }

}
