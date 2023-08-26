<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'max:1024',
        ]);

        $keyword = $request->keyword;
        $is_showing = $request->is_showing;

        $movies = Movie::query();

        if(!empty($keyword)){
            if($is_showing === '0'){
                $movies->where('is_showing', '=', false)
                ->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%")
                ->get();
            }elseif($is_showing === '1'){
                $movies->where('is_showing', '=', true)
                ->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%")
                ->get();
            }else{
                $movies->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%")
                ->get();
            }
        }else{
            if($is_showing === '0'){
                $movies->where('is_showing', '=', false)->get();
            }elseif($is_showing === '1'){
                $movies->where('is_showing', '=', true)->get();
            }else{
                $movies->get();
            }
        }

        $movies = $movies->paginate(20);

        return view('user.movie.index', ['movies' => $movies]);
    }

    public function show($id)
    {
        $movie = Movie::with('schedules')->find($id);
        return view('user.movie.show', ['movie' => $movie]);
    }
}
