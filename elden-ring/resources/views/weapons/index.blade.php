@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>All Builds Made</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Builds made</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-primary" href="{{ route('weapons.create') }}"> Create Build</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{route('weapons.search')}}" method="post">
        @csrf
        <label for="search">Zoeken:</label>
        <input id="search" type="text" name="search">
        <input name="submit" type="submit" class="btn btn-primary"/>
    </form>
<div>
    <a href="{{route('weapons.index')}}" class="btn btn-primary btn-sm">Everything</a>

    @foreach($categories as $category)
        <a href="{{route('weapons.index', ['category' => $category->id])}}"
           class="btn btn-primary btn-sm">{{$category->name}}</a>
    @endforeach

</div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Weapon 1</th>
            <th>Weapon 2</th>
            <th>Type</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($weapons as $weapon)
            <tr>
                <td>{{ $weapon->id }}</td>
                <td>{{ $weapon->weapon_1 }}</td>
                <td>{{ $weapon->weapon_2 }}</td>
                <td>{{ $weapon->category->name }}</td>
                <td>{{ $weapon->description }}</td>
                <td>
                    <form action="{{ route('weapons.destroy',$weapon->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('weapons.edit',$weapon->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
@endsection
