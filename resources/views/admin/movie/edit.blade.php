<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画登録情報編集（管理者）</title>
</head>
<body>
    <form action="{{route('admin.update', $movie->id)}}" method="post">
        @csrf
        @method('PATCH')
        <label for="title">映画タイトル</label><br>
        <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" required><br><br>
        <label for="image_url">画像URL</label><br>
        <input type="url" id="image_url" name="image_url" pattern="https://.*" value="{{ old('image_url', $movie->image_url) }}" required><br><br>
        <label for="published_year">公開年</label><br>
        <input type="number" id="published_year" name="published_year" value="{{ old('published_year', $movie->published_year) }}" required><br><br>
        <label for="genre">ジャンル</label><br>
        <input type="text" id="genre" name="genre" value="{{ old('genre', $movie->genre->name) }}" required><br><br>
        <label for="is_showing">公開中かどうか</label><br>
        @php
            if ($movie->is_showing) {
                $showing = 'on';
            }else{
                $showing = null;
            }
        @endphp
        <input type="checkbox" id="is_showing" name="is_showing" value="{{ old('is_showing', $movie->is_showing) }}"><br><br>
        <label for="description">概要</label><br>
        <textarea name="description" id="description" cols="30" rows="10" required>{{ old('description', $movie->description) }}</textarea><br><br>

        <input type="submit" value="更新">
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
