<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workout</title>
</head>
<body>
    <h1>Manajemen Workout</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workouts as $workout)
                <tr>
                    <td>{{$workout->Title}}</td>
                    <td>
                        <a href="{{ route('workouts.edit', $workout->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
