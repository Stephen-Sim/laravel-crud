@extends('layouts.app')
@section('content')
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
    <th>Member Role</th>
    <th>Action</th>

    @foreach ($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->age }}</td>
            <td>{{ $member->role }}</td>
            <td>
                <a href="{{ route('member.edit', $member->id) }}">Edit</a>
                <a href="{{ route('member.show', $member->id) }}">Show</a>
                <form action="{{ route('member.destroy', $member->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $members->links() }}
<a href="{{route('member.create')}}"> create member</a>
@endsection