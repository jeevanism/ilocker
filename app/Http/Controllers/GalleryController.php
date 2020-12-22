<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Gallery;
use Illuminate\Http\Request;
use DB;


class GalleryController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Show the Public images 
        return view('welcome',[
         'gallery' => Gallery::where('status', 1)
         ->orderBy('created_at', 'DESC')
         ->get()
     ]);

    } 

    /**
    *  Display My Uploads as userid
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
*   */
    public function ajaxPersonalLocker($id){

     return view('ajaxupdate',[
     'gallery' => Gallery::where('user_id', $id)
     ->orderBy('created_at', 'DESC')
     ->get(),
     'user_id' => $id 
     ]);
    }


    /**
    * Update the specified resource using AJAX
    *  
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    
    public function ajaxPersonalLockerUpdate(Request $request)
    {

      $image_id = $request->input('imageid');
      $user_id = Auth::id();
      $status = $request->input('updatestatus');

      // toggle the visibility of the image 
      if($status==0){
        $toggle =1;
        $visible = 'public';
    }
    else {
        $toggle=0;
        $visible = 'private';
    }

    $update = new Gallery;
    $update->status = $toggle;
    $update->id =$image_id;
    $imageName = Gallery::where('id',$image_id)->value('name');

    $affected = Gallery::where('id', $image_id)
    ->update(['status' =>$toggle]);
    $imageStatus = Gallery::where('id',$image_id)->value('status');
    $imageGallery = Gallery::where('user_id', $user_id )
    ->orderBy('created_at', 'DESC')
    ->get();
    
    // prepare a partial view for AJAX on Success     
    $html = view('ajaxpartial',['ggallery' =>  $imageGallery ])->render();

    $res['status'] = "success";
    $res['image_id'] =$image_id;
    $res['image_status'] = $toggle;
    $res['imageName']=$imageName;
    $res['visible'] = $visible;
    $res['html'] =  $html ;


    // return json response
    return response()->json(['data'=>$res]);

    }

     /**
     * Remove the specified resource using AJAX
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function ajaxDelete(Request $request)
    {
       
     $user_id = Auth::id();
     $image_id = $request->input('imageid');
     $imageName = Gallery::where('id',$image_id)->value('name');
     
     $delete  = Gallery::find($image_id)->delete();
     $imageGallery = Gallery::where('user_id', $user_id )
     ->orderBy('created_at', 'DESC')
     ->get();
         // prepare a partial view for AJAX on Success 
     $html = view('ajaxpartial',['ggallery' =>  $imageGallery ])->render();

     $res['status'] = "successfully Deleted";
     $res['image_id'] =$image_id;
     $res['imageName'] = $imageName; 
     $res['html'] =  $html ;
         // return json response
     return response()->json(['data'=>$res]);

    }
}
