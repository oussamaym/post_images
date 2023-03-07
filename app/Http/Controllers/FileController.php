<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class FileController extends Controller
{
    public function upload(Request $request)
    {
        /*$this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);*/
        $post=new Post;
        if($request->hasFile('image'))
        {
        $completeFileName=$request->file('image')->getClientOriginalName();
        $fileNameOnly=pathinfo($completeFileName,PATHINFO_FILENAME);
        $extension=$request->file('image')->getClientOriginalExtension();
        $comppic=str_replace(' ','_',$fileNameOnly.'-'.rand().'_'.time().'.'.$extension);
        $path=$request->file('image')->storeAs('public/images',$comppic); 
        $post->image=$comppic;
        $post->Path=$path;
        $post->Text=$request->input('Text');
        $post->Title=$request->input('Title');
        } 
    if($post->save())
    {
        return response()->json(['success'=>'Image Uploaded Successfully',"image"=>$comppic]);
    }
    else{
        return response()->json(['error'=>'Image Upload Failed']);
    }
        //$file = $request->file('file');
        //$file->store('public');
    }
  /*  public function getImages()
    {
        $publicPath = public_path();

// Get the contents of the public directory
        $files = File::allFiles($publicPath);
          $images=[];
// Loop through each file and print its name
            foreach ($files as $file) {
                $images[]=base64_encode(file_get_contents($file));
              }        
        return response()->json(['images' => $images]);
    }*/
}
