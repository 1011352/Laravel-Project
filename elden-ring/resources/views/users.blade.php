@extends('layouts.app')

@section('content')
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
    </head>
    <body>
    <p><a href="{{url('admin')}}">Users</a></p>
    <a href="{{url('weapons')}}">Builds</a>
    </body>


    </body>
@endsection
