@extends('layouts.app')
@section('content')
<h1>New Member</h1>    
    @if($errors)
        @foreach($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('member.store') }}" method="post">
        <table class="center">
            @csrf
            <tr>
                <td><label for="">Member Name </label></td>
                <td> : </td>
                <td><input type="text" name="name"></td>
            </tr>
            <br>
            <tr>
                <td><label for="">Member Age </label></td>
                <td> : </td>
                <td><input type="number" name="age"></td>
            </tr>
            <br>
            <tr>
                <td><label for="">Member Role : </label></td>
                <td> : </td>
                <td><select name="role_id" id="role">
                        <option selected disabled>Select Member Role</option>
                        @foreach($roleName as $key => $value)
                            <option value="{{ $value->id }}" {{ ( $value->id == '') ? 'selected' : '' }}> {{ $value->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <br>
        </table>
        <div class="center2"><input class="btn-sub center2"" type="submit"></div>
    </form>
    <br>
    <div class="center2"><a class="center2" href="{{route('member.index')}}"> Home </a></div>
@endsection