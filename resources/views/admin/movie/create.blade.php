<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画新規登録（管理者）</title>
</head>
<body>
    <form action="{{route('admin.store')}}" method="post">
        @csrf
        <label for="title">映画タイトル</label><br>
        <input type="text" id="title" name="title" required><br><br>
        <label for="image_url">画像URL</label><br>
        <input type="url" id="image_url" name="image_url" pattern="https://.*" required><br><br>
        <label for="published_year">公開年</label><br>
        <input type="number" id="published_year" name="published_year" required><br><br>
        <label for="genre">ジャンル</label><br>
        <input type="text" id="genre" name="genre" required><br><br>
        <label for="is_showing">公開中かどうか</label><br>
        <input type="checkbox" id="is_showing" name="is_showing"><br><br>
        <label for="description">概要</label><br>
        <textarea name="description" id="description" cols="30" rows="10" required></textarea><br><br>

        <input type="submit" value="新規登録">
        <div style="color:red;">
            @error('title')
                {{ $message }}
            @enderror
            @error('image_url')
                {{ $message }}
            @enderror
            @error('published_year')
                {{ $message }}
            @enderror
            @error('is_showing')
                {{ $message }}
            @enderror
            @error('description')
                {{ $message }}
            @enderror
        </div>
    </form>
</body>
</html>
