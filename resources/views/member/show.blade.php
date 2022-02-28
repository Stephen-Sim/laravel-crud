@extends('layouts.app')
@section('content')

<h1>View Member</h1>
<div class="center">
    <br>
    <h3>Member Name : {{ $member->name }}</h3>
    <h3>Member Age : {{ $member->age }}</h3>
    <h3>Member Role : {{ $member->role }}</h3>
    <br>
</div>
<a href="{{route('member.index')}}"> Home </a>
@endsection