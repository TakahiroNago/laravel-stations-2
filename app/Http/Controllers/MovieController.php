<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movie.index', ['movies' => $movies]);
    }

    public function admin()
    {
        $movies = Movie::all();
        return view('movie.admin', ['movies' => $movies]);
    }
}
