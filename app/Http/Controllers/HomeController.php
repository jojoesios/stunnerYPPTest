<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SongLyric;

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
        $lyrics = SongLyric::with('creator')->orderBy('created_at', 'ASC')->get();

        return view('home')->with(compact('lyrics'));
    }
}
