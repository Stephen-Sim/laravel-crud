@extends('layouts.app')
@section('content')
<h1>Member Crud</h1>
@if ($msg = Session::get('success'))
    <div class="valid">
        {{ $msg }}
    </div>
@endif
<table class="center">
    <th>#</th>
    <th>Member Name</th>
    <th>Age</th>
    <th>Member Role</th>
    <th colspan="3">Action</th>

    @foreach ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->age }}</td>
            <td>{{ $member->role }}</td>
            <td><a href="{{ route('member.edit', $member->id) }}">Edit</a></td>
            <td><a href="{{ route('member.show', $member->id) }}">Show</a></td>
            <td><form action="{{ route('member.destroy', $member->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn1">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<br>
<div style="float: right;">
    {{ $members->links() }}
    <a href="{{route('member.create')}}"> create member</a>
</div>
@endsection