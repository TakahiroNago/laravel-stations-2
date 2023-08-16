<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画一覧（管理者）</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>映画タイトル</th>
                <th>画像URL</th>
                <th>公開年</th>
                <th>上映中かどうか</th>
                <th>概要</th>
                <th>登録日時</th>
                <th>更新日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }} </td>
                    <td>{{ $movie->title }} </td>
                    <td>{{ $movie->image_url }} </td>
                    <td>{{ $movie->published_year }} </td>
                    <td>
                        @if ($movie->is_showing)
                            上映中
                        @else
                            上映予定
                        @endif
                    </td>
                    <td>{{ $movie->description }} </td>
                    <td>{{ $movie->created_at }} </td>
                    <td>{{ $movie->updated_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
