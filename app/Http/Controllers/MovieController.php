<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('movie.index', ['movies' => $movies]);
    }

    public function admin()
    {
        $movies = Movie::all();
        return view('movie.admin', ['movies' => $movies]);
    }

    public function create()
    {
        return view('movie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|unique:movies',
            'image_url' => 'required|url|max:1023',
            'published_year' => 'required|numeric|min:1800|max:2027',
            'genre' => 'required|max:127',
            'is_showing' => 'required|nullable',
            'description' => 'required|max:1024',
        ]);

        DB::transaction(function () use($request) {
            // Genre が新規の時 create
            $genre_input = $request->genre;
            $genre = Genre::where('name', $genre_input)->first();
            if($genre === null){
                Genre::create([
                    'name' => $genre_input,
                ]);
                $genre_id = Genre::max('id');
            }else{
                $genre_id = $genre->id;
            }

            // Movie の create
            if($request->is_showing === NULL){
                $showing = false;
            }else{
                $showing = true;
            }
            Movie::create([
                'title'          => $request->title,
                'image_url'      => $request->image_url,
                'published_year' => $request->published_year,
                'genre_id'       => $genre_id,
                'is_showing'     => $showing,
                'description'    => $request->description,
            ]);
        });

        return redirect()->route('admin.index');
    }

    public function show($id)
    {
        $movie = Movie::with('schedules')->find($id);
        return view('movie.show', ['movie' => $movie]);
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movie.edit', ['movie' => $movie]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required',
            'image_url' => 'required|url|max:1023',
            'published_year' => 'required|numeric|min:1800|max:2027',
            'genre' => 'required|max:127',
            'is_showing' => 'required|nullable',
            'description' => 'required|max:1024',
        ]);

        if($request->is_showing === NULL){
            $showing = false;
        }else{
            $showing = true;
        }

        $movie = Movie::find($id);

        if($movie->title !== $request->title){
            $request->validate([
                'title'  => 'unique:movies',
            ]);
        }

        DB::transaction(function () use($request, $movie, $showing) {
            // Genre が新規の時 create
            $genre_input = $request->genre;
            $genre = Genre::where('name', $genre_input)->first();
            if($genre === null){
                Genre::create([
                    'name' => $genre_input,
                ]);
                $genre_id = Genre::max('id');
            }else{
                $genre_id = $genre->id;
            }

            // movie の update
            $movie->title          = $request->title;
            $movie->image_url      = $request->image_url;
            $movie->published_year = $request->published_year;
            $movie->genre_id       = $genre_id;
            $movie->is_showing     = $showing;
            $movie->description    = $request->description;
            $movie->save();
        });

        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        if($movie = Movie::find($id)){
            $movie->delete();
            return redirect()->route('admin.index')->with('flash_message', '削除に成功しました');
        }else{
            return \App::abort(404);
        }
    }
}
