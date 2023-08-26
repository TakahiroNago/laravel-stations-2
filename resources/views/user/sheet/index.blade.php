<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席表</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>・</th>
                <th>・</th>
                <th>スクリーン</th>
                <th>・</th>
                <th>・</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($sheets as $sheet)
                @if ($i === 0)
            <tr>
                @endif
                <td>{{$sheet->row}}-{{$sheet->column}}</td>
                @if ($i === 4)
            </tr>
                    @php
                        $i=0;
                    @endphp
                @elseif ($sheet === end($sheet))
            </tr>
                @else
                    @php
                        ++$i;
                    @endphp
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
