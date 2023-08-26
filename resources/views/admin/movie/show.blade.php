<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画作品詳細</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>映画タイトル</th>
                <th>画像</th>
                <th>公開年</th>
                <th>ジャンル</th>
                <th>上映中かどうか</th>
                <th>概要</th>
                <th>登録日時</th>
                <th>更新日時</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td><img src="{{ $movie->image_url }}" alt="" width="300px" height="240px"></td>
                <td>{{ $movie->published_year }}</td>
                <td>{{ $movie->genre->name }}</td>
                <td>
                    @if ($movie->is_showing)
                        上映中
                    @else
                        上映予定
                    @endif
                </td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->created_at }}</td>
                <td>{{ $movie->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    @php
        $schedules = $movie->schedules->sortBy('start_time');
    @endphp
    @foreach ($schedules as $schedule)
        <a href="{{route('admin.schedule.show', $schedule->id)}}" style="color:#000; text-decoration: none;">
            <table>
                <thead>
                    <tr>
                        <th>上映開始時刻</th>
                        <th>上映終了時刻</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$schedule->start_time}}</td>
                        <td>{{$schedule->end_time}}</td>
                    </tr>
                </tbody>
            </table>
        </a>
    @endforeach
    <a href="{{route('admin.schedule.create', $movie->id)}}"><button>スケジュール新規作成</button></a>

</body>
</html>
