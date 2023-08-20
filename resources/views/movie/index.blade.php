<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画一覧</title>
</head>
<body>
    <form action="{{route('index')}}" method="get">
        @csrf
        <input type="text" name="keyword">
        <input type="radio" id="all" name="is_showing" value="all" checked>
        <label for="all">すべて</label>
        <input type="radio" id="false" name="is_showing" value="0">
        <label for="false">公開予定</label>
        <input type="radio" id="true" name="is_showing" value="1">
        <label for="true">公開中</label>
        <input type="submit" value="検索">
    </form>

    <ul>
    @foreach ($movies as $movie)
        <li>タイトル: {{ $movie->title }}  イメージURL: {{ $movie->image_url }} </li>
    @endforeach
    </ul>
    <div style="color:red;">
        @error('keyword')
            {{ $message }}
        @enderror
    </div>
    {{ $movies->links() }}
</body>
</html>
