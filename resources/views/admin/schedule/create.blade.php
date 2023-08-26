<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール新規登録（管理者）</title>
</head>
<body>
    <form action="{{route('admin.schedule.store', $movie_id)}}" method="post">
        @csrf
        <label for="start_time_date">開始日付</label><br>
        <input type="date" id="start_time_date" name="start_time_date" value="{{ old('start_time_date')}}" required><br><br>
        <label for="start_time_time">開始時間</label><br>
        <input type="time" id="start_time_time" name="start_time_time" value="{{ old('start_time_time')}}" required><br><br>
        <label for="end_time_date">終了日付</label><br>
        <input type="date" id="end_time_date" name="end_time_date" value="{{ old('end_time_date')}}" required><br><br>
        <label for="end_time_time">終了時間</label><br>
        <input type="time" id="end_time_time" name="end_time_time" value="{{ old('end_time_time')}}" required><br><br>
        <input type="hidden" name="movie_id" value="{{$movie_id}}">

        <input type="submit" value="新規登録">
        <div style="color:red;">
            @error('start_time_date')
                {{ $message }}
            @enderror
            @error('start_time_time')
                {{ $message }}
            @enderror
            @error('end_time_date')
                {{ $message }}
            @enderror
            @error('end_time_time')
                {{ $message }}
            @enderror
            @error('movie_id')
                {{ $message }}
            @enderror
        </div>
    </form>
</body>
</html>
