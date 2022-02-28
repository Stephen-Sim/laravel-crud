@extends('layouts.app')
@section('content')
<h1>Member Crud</h1>
@if ($msg = Session::get('success'))
    <div class="valid">
        {{ $msg }}
    </div>
@endif
<table id="memberTable" class="center">
    <thead>
        <th>#</th>
        <th>Member Name</th>
        <th>Age</th>
        <th>Member Role</th>
        <th>Action</th>
    </thead>

</table>
<br>
<div style="float: right;">
    <a href="{{route('member.create')}}"> create member</a>
</div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {
            fetch_data();

            function fetch_data(){
                console.log("test");
                $('#memberTable').DataTable({
                    ajax:{
                        url : "{{ route('member.table') }}",
                        type: 'get',
                        dataType : 'json'
                    },
                    searching : false,
                    columns : [{
                        data : "id",
                        name : "id"
                    },
                    {
                        data : "name",
                        name : "name",
                    },
                    {
                        data : "age",
                        name : "age"
                    },
                    {
                        data : "role",
                        name : "role"
                    },
                    {
                        data : "action",
                        name : "action"
                    }]
                });
            }
        });
    </script>
@show