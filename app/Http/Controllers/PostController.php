<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Auth;
use App\Image;
use File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts=Post::orderby('created_at', 'DESC')->paginate(2);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'category'=>'required|string',
            'description'=>'required|string',
           /* 'files'=>'required'*/
        ]);
        $title=$request->title;
        $category_id=$request->category;
        $description=$request->description;

        $post=new Post;
            $post->title=$title;
            $post->category_id=$category_id;
            $post->description=$description;
            $post->user_id=Auth::user()->id;
            $post->save();

            $lastid=$post->id;
            $images=array();
        if ($request->hasfile('files')) {
            $files = $request->file('files');
            
            foreach($files as $file) {
                $image=new Image;
                $name =time().'.'.$file->getClientOriginalName();
                $path =public_path('/storage/uploads/');
                $file->move($path, $name);
                $image->post_id=$lastid;
                $image->name=$name;
                $image->save();                
            }
         }
            return redirect('/posts')->with('success', 'Records inserted successfully!');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrfail($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();
        $post=Post::findOrfail($id);
        $image=Image::all();
        return view('post.edit', compact('categories', 'post', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|string',
            'category'=>'required|string',
            'description'=>'required|string',
           /* 'files'=>'required'*/
        ]);
        $title=$request->title;
        $category_id=$request->category;
        $description=$request->description;

        $post=Post::findOrfail($id);
            $post->title=$title;
            $post->category_id=$category_id;
            $post->description=$description;
            $post->user_id=Auth::user()->id;
            $post->save();

            $lastid=$post->id;

            
        if ($request->hasfile('files')) {
            $files = $request->file('files');           
            foreach($files as $file) {                
                $name =time().'.'.$file->getClientOriginalName();
                $path =public_path('/storage/uploads/');
                $file->move($path, $name);                
                $images=Image::all();
                if (isset($images->name)) {
                    foreach ($images as $image) {
                        $oldname=$image->name;
                    File::delete($path.''.$oldname);
                    }
                    
                    $images->name=$name;
                    $images->post_id=$lastid;  
                    $images->save();
                }
                

            }           
         }
            return redirect('/posts')->with('success', 'Records inserted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images=Image::where('post_id', $id)->get();
        foreach ($images as $image) {
                    $path=public_path('/storage/uploads/');
                    $name=$image->name;   
                    File::delete($path.''.$name);                    
                    }

                    if (Post::where('id', $id)->delete()) {
                        return redirect('/posts');
                    }else{
                        return redirect()->back();
                    }
        /*$post=Post::where('id', $id);
        $images=Image::all();
        if ($post->delete()) {
                    foreach ($images as $image) {
                    $path=public_path('/storage/uploads/');
                    $name=$image->name;   
                    File::delete($path.''.$name);                    
                    }
                    return redirect('/posts');
        }     */
}
}
 