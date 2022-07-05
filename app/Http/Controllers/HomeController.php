<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Post::all()->sortByDesc('id');
        $profile = Profile::all();
        $filtered = User::all()->filter(function ($value, $key) {
             return $value->id != Auth::id();
        });  
        return view('home', compact('post','profile','filtered'));
    }
}
