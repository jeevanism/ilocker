<?php

namespace App\Http\Controllers;

use App\Models\imageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class ImageUploadController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

       $user_id = Auth::id();
       $request->validate([

        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048 '
          ]);
       $directory = public_path('images').'/'.$user_id;
       $imageName = time().'.'.$request->image->extension();

       //move the uploaded file to a directory named as user_id
       $saved = $request->image->move($directory, $imageName);
       $imagePath= "$user_id/$imageName";

       $imageUpload = new imageUpload;
       $imageUpload->name=$imageName;
       $imageUpload->path = "images/$user_id/$imageName";
       $imageUpload->user_id= $user_id;
       $imageUpload->save();

       return redirect()->route('getajaxupdate',['id' => $user_id])
       ->with('success','You have successfully uploaded image.')
       ->with('image',$imageName)
       ->with('id',$user_id);



    }


}
