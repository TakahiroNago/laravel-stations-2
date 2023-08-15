<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画一覧</title>
</head>
<body>
    <ul>
    @foreach ($movies as $movie)
        <li>タイトル: {{ $movie->title }}  イメージURL: {{ $movie->image_url }} </li>
    @endforeach
    </ul>
</body>
</html>
