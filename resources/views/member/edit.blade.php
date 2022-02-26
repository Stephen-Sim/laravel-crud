@extends('layouts.app')
@section('content')
<h1>Edit Member</h1>
    @if($errors)
        @foreach($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('member.update', $member->id) }}" method="post">
        <table class="center">
            @csrf
            @method('PUT') 
            <tr>
                <td><label for="">Member ID </label></td>
                <td> : </td>
                <td><input type="text" name="id" value="{{ $member->id }}" disabled></td>
            </tr>
            <br>

            <tr>
                <td><label for="">Member Name </label></td>
                <td> : </td>
                <td><input type="text" name="name" value="{{ $member->name }}"></td>
            </tr>
            <br>

            <tr>
                <td><label for="">Member Age </label></td>
                <td> : </td>
                <td><input type="number" name="age" value="{{ $member->age }}"></td>
            </tr>
            <br>

            <tr>
                <td><label for="">Member Role : </label></td>
                <td> : </td>
                <td><input type="text" name="role" value="{{ $member->role}}" disabled></td>
            </tr>
            
        </table>
        <div class="center2"><input class="btn-sub" type="submit"></div>
        <br>
        
    </form>

    <br>
    <div class="center2"><a href="{{route('member.index')}}"> Home </a></div>
@endsection