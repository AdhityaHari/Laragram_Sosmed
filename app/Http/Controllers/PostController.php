<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\Komentar;
use Illuminate\Support\Facades\Auth;
use Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'gambar' => 'required',
            'caption' => 'required'
        ]);

        $fileName = time(). '.'. $request->gambar->extension();
        $post = new Post;

        $post->gambar = $fileName;
        $post->caption = $request->caption;
        $post->user_id = Auth::id();

        $post->save();
        $request->gambar->move(public_path('imagepost'),$fileName);
        Alert::success('Post', 'Succesfully Posted');
        return redirect('/home');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('user_id',$id)->first();
        $post = Post::where('id',$id)->first();
        return view('post.show', compact(['profile','post',]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Komentar::where('post_id', $id)->delete();
        Post::find($id)->delete();
        Alert::success('Deleted', 'Post Deleted');
        // return redirect('/post/'.$request->post_id);
        return redirect('/home');
    }
}
