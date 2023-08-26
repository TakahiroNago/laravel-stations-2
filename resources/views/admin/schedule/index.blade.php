<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール一覧（管理者）</title>
</head>
<body>
    <h1>スケジュール一覧</h1>
    <a href="{{route('admin.index')}}" style="color:#000; text-decoration: none;"><button>映画一覧</button></a>
    @foreach ($movies as $movie)
        @if (!empty($movie->schedules[0]))
            <h2>{{ $movie->id }} {{ $movie->title }}</h2>
            @php
                $schedules = $movie->schedules->sortBy('start_time');
            @endphp
            @foreach ($schedules as $schedule)
                <a href="{{route('admin.schedule.show', $schedule->id)}}" style="color:#000; text-decoration: none;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>映画ID</th>
                                <th>上映開始時刻</th>
                                <th>上映終了時刻</th>
                                <th>作成日時</th>
                                <th>更新日時</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$schedule->id}}</td>
                                <td>{{$schedule->movie_id}}</td>
                                <td>{{$schedule->start_time->format('m-d H:i')}}</td>
                                <td>{{$schedule->end_time->format('m-d H:i')}}</td>
                                <td>{{$schedule->created_at}}</td>
                                <td>{{$schedule->updated_at}}</td>
                                <td>
                                    <a href="{{route('admin.schedule.edit', $schedule->id)}}"><button>編集</button></a>
                                </td>
                                <td>
                                    <form action="{{route('admin.schedule.destroy', $schedule->id)}}" method="post" onclick="return confirm('削除しますか?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </a>
            @endforeach
        @endif
    @endforeach
</body>
</html>
