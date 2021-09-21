<?php

namespace App\Http\Controllers;

use App\SongLyric;
use Illuminate\Http\Request;

use Auth;

class SongLyricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lyrics = SongLyric::with('creator')->orderBy('ASC')->get();

        return $lyrics;
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
        $validated = $this->validate($request, [
            'title'     => 'required',
            'artist'    => 'required',
            'lyrics'    => 'required',
        ]);

        $validated['user_id'] = Auth::user()->id;

        SongLyric::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SongLyric  $songLyric
     * @return \Illuminate\Http\Response
     */
    public function show(SongLyric $songLyric)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SongLyric  $songLyric
     * @return \Illuminate\Http\Response
     */
    public function edit(SongLyric $songLyric)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SongLyric  $songLyric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SongLyric $songLyric)
    {
        $validated = $this->validate($request, [
            'title'     => 'required',
            'artist'    => 'required',
            'lyrics'    => 'required',
        ]);

        $songLyric->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SongLyric  $songLyric
     * @return \Illuminate\Http\Response
     */
    public function destroy(SongLyric $songLyric)
    {
        $songLyric->delete();
    }
}
