<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table, tr, td{
            border: 1px solid black;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <h1>Member Crud</h1>
    @if ($msg = Session::get('success'))
        <div>
            {{ $msg }}
        </div>
    @endif
    <table>
        <th>#</th>
        <th>Member Name</th>
        <th>Age</th>

        @foreach ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->age }}</td>
            </tr>
        @endforeach
    </table>
    <a href="{{route('member.create')}}"> create member</a>
</body>
</html>