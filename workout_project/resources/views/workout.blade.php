<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workout</title>
</head>
<body>
    <h1>A</h1>
    @foreach ($workouts as $item)
        <tr>
            <td>{{$item->Title}}</td>
        </tr>
    @endforeach
</body>
</html>
