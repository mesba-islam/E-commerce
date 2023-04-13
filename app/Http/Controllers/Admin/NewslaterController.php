<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\newslater;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NewslaterController extends Controller
{
    public function Newslater(){
        $newslaters = newslater::get();

        return view('admin.newslater',compact('newslaters'));
    }

    public function storeNewslater(Request $request){
        $request->validate([
            'email' => 'required|unique:newslaters'
        ]);
        Newslater::insert([
            'email' => $request->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
            $notification = array(
                'messege' => 'Thanks for subscribing',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
            
    }

    
}
