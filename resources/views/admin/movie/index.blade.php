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
                <th>ジャンル</th>
                <th>上映中かどうか</th>
                <th>概要</th>
                <th>登録日時</th>
                <th>更新日時</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->id }} </td>
                    <td><a href="{{route('admin.show', $movie->id)}}">{{ $movie->title }}</a>  </td>
                    <td>{{ $movie->image_url }} </td>
                    <td>{{ $movie->published_year }} </td>
                    <td>{{ $movie->genre->name }} {{ $movie->genre_id }} </td>
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
                    <td><a href="{{ route('admin.edit', $movie->id) }}"><button>編集</button></a></td>
                    <td>
                        <form action="{{route('admin.destroy', $movie->id)}}" method="post" onclick="return confirm('削除しますか?')">
                            @csrf
                            @method('delete')
                            <button>削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('admin.create')}}"><button>新規登録</button></a>

    <!-- フラッシュメッセージ -->
    @if (session('flash_message'))
        <div style="color: red;">
            {{ session('flash_message') }}
        </div>
    @endif
</body>
</html>
