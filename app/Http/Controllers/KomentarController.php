<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komentar ;
use Alert;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $komentar = Komentar::all();
        // return view('komentar.index', compact('komentar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('komentar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $komentar = new Komentar;
        if($request->komentar){
            $request->validate([
                    'komentar' => 'required'
                ]);
            $komentar->komentar = $request->komentar;
            $komentar->like = 0;
            $komentar->user_id = Auth::id();
            $komentar->post_id = $request->post_id;
            $komentar->save();
            Alert::success('Comment', 'Post Commented');
        } elseif ($request->like) {
            $komentar->like = $request->like;
            $komentar->komentar = '';
            $komentar->user_id = Auth::id();
            $komentar->post_id = $request->post_id;
            $komentar->save();
            Alert::success('Like', 'Post Liked');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $koment = Komentar::find($id);
        // return view('komentar.show', compact('komentar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $koment = Komentar::find($id);
        // return view('komentar.edit', compact('komentar'));
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
    public function destroy($id){
        
        Komentar::where('id', $id)->delete();
        Alert::success('Unlike', 'Post Unliked');
        return redirect()->back();
    }
}
