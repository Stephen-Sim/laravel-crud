<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        label, input{
            margin-top: 10px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    @if($errors)
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('member.update', $member->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="">Member Name : </label>
        <input type="text" name="name" value="{{ $member->name }}">
        <br>
        <label for="">Member Age : </label>
        <input type="number" name="age" value="{{ $member->age }}">
        <br>
        <input type="submit">
    </form>
</body>
</html>