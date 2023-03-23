<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class FileController extends Controller
{
    public function index()
    {
        // all images
        $posts = Post::all();
        return view('welcome', compact('posts'));
    }

    public function upload(Request $request)
    {
        $post=new Post;
        if($request->hasFile('image'))
        {
            $post->image= $request->file('image')->store('images', 'public');
            $post->text = $request->input('text');
            $post->title = $request->input('title');
            $post->link = $request->input('link');
        }
        
        if($post->save())
        {
            return response()->json(['success'=>'Image Uploaded Successfully',"image"=>$post->image]);
        }
        else{
            return response()->json(['error'=>'Image Upload Failed']);
        }
    }
    public function getImages()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
}
