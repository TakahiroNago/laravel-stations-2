<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール詳細</title>
</head>
<body>
        <table>
            <thead>
                <tr>
                    <th>上映開始時刻</th>
                    <th>上映終了時刻</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$schedule->start_time->format('H:i')}}</td>
                    <td>{{$schedule->end_time->format('H:i')}}</td>
                </tr>
            </tbody>
        </table>

</body>
</html>
