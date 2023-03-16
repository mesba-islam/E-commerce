<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function AddSubCategory(){
        $categories = Category::get();
        return view('admin.addsubcategory', compact('categories'));
    }

    public function SubCategory(){
         $subcategories = SubCategory::latest()->get();

        // dd($subcategories->category->name);
        return view('admin.allsubcategory', compact('subcategories'));

    }

    public function StoreSubCategory(request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories'
        ]);
        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
            'slug' => strtolower(str_replace(' ','_', $request->subcategory_name))
        ]);


        return redirect()->route('allsubcategory')->with('message', 'SubCategory Added Successfully!');
    }

    public function EditSubCategory($id){
        $subcategory_info = SubCategory::FindOrFail($id);

        return view('admin.editsubcategory', compact('subcategory_info'));
    }

    public function UpdateSubCategory(Request $request){
        $subcategory_id = $request->subcategory_id;

        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories'
        ]);

        SubCategory::findOrFail($subcategory_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','_', $request->subcategory_name))
        ]);
        // dd($subcategory_id);
        return redirect()->route('allsubcategory')->with('message','Subcategory Update Successfully');
    }

    public function DeleteSubCategory($id){
        SubCategory::FindOrFail($id)->delete();

        return redirect()->route('allsubcategory')->with('message', 'SubCategory deleted Successfully!');
    }



}
