<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SchedulesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.schedule.index', ['movies' => $movies]);
    }

    public function create($movie_id)
    {
        return view('admin.schedule.create', ['movie_id' => $movie_id]);
    }

    public function store(Request $request, $movie_id)
    {
        $request->validate([
            'start_time_date'  => 'required|date_format:Y-m-d|before_or_equal:end_time_date',
            'start_time_time' => 'required|date_format:H:i|before:end_time_time|five_min_difference:end_time_time',
            'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
            'end_time_time' => 'required|date_format:H:i|after:start_time_time|five_min_difference:start_time_time',
            'movie_id' => 'required',
        ]);

        $start_time = new Carbon($request->start_time_date . ' ' . $request->start_time_time);
        $end_time   = new Carbon($request->end_time_date . ' ' . $request->end_time_time);

        Schedule::create([
            'start_time' => $start_time,
            'end_time'   => $end_time,
            'movie_id'   => $request->movie_id,
        ]);

        return redirect()->route('admin.schedule.index');
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);
        return view('admin.schedule.show', ['schedule' => $schedule]);
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view('admin.schedule.edit', ['schedule' => $schedule]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_time_date'  => 'required|date_format:Y-m-d|before_or_equal:end_time_date',
            'start_time_time' => 'required|date_format:H:i|before:end_time_time',
            'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
            'end_time_time' => 'required|date_format:H:i|after:start_time_time',
            'movie_id' => 'required',
        ]);

        $start_time = new Carbon($request->start_time_date . ' ' . $request->start_time_time);
        $end_time   = new Carbon($request->end_time_date . ' ' . $request->end_time_time);

        $validator = Validator::make($request->all(), []);
        if ($start_time->diffInMinutes($end_time) < 5) {
            $validator->after(function ($validator) {
                $validator->errors()->add('end_time_time', '終了日時が開始から５分以内に設定されています。');
            });
        }

        if ($validator->fails()) {
            return redirect()
                ->route('admin.schedule.create', $request->movie_id)
                ->withErrors($validator)
                ->withInput();
        }

        Schedule::where('id', $id)->update([
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        return redirect()->route('admin.schedule.index');
    }

    public function destroy($id)
    {
        if($schedule = Schedule::find($id)){
            $schedule->delete();
            return redirect()->route('admin.schedule.index')->with('flash_message', '削除に成功しました');
        }else{
            return \App::abort(404);
        }
    }
}
