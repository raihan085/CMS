<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Facades\Storage;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request,[
        'title' => 'required|unique:posts',
        'description' => 'required',
        'content' => 'required',
        'image' => 'required|image',
        'published_at' => 'date',
      ]);

        Post::create([
          'title' => $request->title,
          'description' => $request->description,
          'content' => $request->content,
          'image' => $request->image->store('posts'),
          'published_at' => $request->published_at,
        ]);

        session()->flash('success','Posts created successfully.');

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('posts',$post);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if($post->trashed())
        {
          Storage::delete($post->image);

          $post->forceDelete();
        }
        else {
          $post->delete();
        }

        session()->flash('success','Posts deleted successfully.');

        return redirect(route('post.index'));
    }

    public function trash()
    {

       $trashed = Post::withTrashed()->get();

       return view('posts.index')->with('posts',$trashed);
    }
}
