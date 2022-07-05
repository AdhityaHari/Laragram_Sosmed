<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use File;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $profile = Profile::where('user_id',$id)->first();
        //$profile = User::find(1)->Profile;
        $post = Post::where('user_id',$id)->get();
        //dd($profile);
        return view('profile.index', compact(['profile','post']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $profile = Profile::where('user_id',$id)->first();
        //$profile = User::find(1)->Profile;
        $post = Post::where('user_id',$id)->get();
        //dd($profile);
        return view('profile.show', compact(['profile','post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $profile = Profile::where('user_id',$id)->first();
        //dd($profile);
        
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_profile' => 'mimes:jpg,png,jpeg',
        ]);

        //dd($request);
        //$id = Auth::id();
        $profile = Profile::where('user_id',$id)->first();

        if($request->has('foto_profile')){
            
            if($profile->foto_profile!="ava.png"){
                $path = "avatar/";
                File::delete($path.$profile->foto_profile);
            }

            $fileName = 'IMG'.'-'.time().'.'.$request->foto_profile->extension();
           // dd($fileName);
            $request->foto_profile->move(public_path('avatar'),$fileName);

            $profile_data = [
                'foto_profile'=>$fileName,
                'umur'=>$request->umur,
                'bio'=>$request->bio,
                'alamat'=>$request->alamat,
            ];

        } else {
            $profile_data = [
                'umur'=>$request->umur,
                'bio'=>$request->bio,
                'alamat'=>$request->alamat,
            ];
        }
        
        $profile->update($profile_data);

        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
