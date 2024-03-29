@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>All Builds Made</title>
    <meta charset="utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Builds made</h2>
            </div>
            @if((\Carbon\Carbon::now()->timestamp - auth()->user()->created_at->timestamp) >= 84000)

                <div class="pull-right mb-2">
                    <a class="btn btn-primary" href="{{ route('weapons.create') }}"> Create Build</a>
                </div>
            @else
                <div class="pull-right mb-2">
                    <button class="btn-secondary" onclick="myFunction()">Create Build</button>
                </div>

                <script>
                    function myFunction() {
                        alert("Account is Younger than 1 day");
                    }
                </script>

            @endif


        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{route('weapons.search')}}" method="post">
        @csrf
        <label for="search">Search:</label>
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
            <th>Title</th>
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
                <td>{{ $weapon->title }}</td>
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
                        <input data-id="{{$weapon->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                               data-offstyle="danger" data-toggle="toggle" data-on="Active"
                               data-off="InActive" {{ $weapon->visibility ? 'checked' : '' }}>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
<script>
    $(function() {
        $('.toggle-class').change(function() {
            const visibility = $(this).prop('checked') === true ? 1 : 0;
            const weapon_id = $(this).data('id');
            $.ajax({

                type: "GET",
                dataType: "json",
                url: '/changeVisibility',
                data: {'visibility': visibility, 'weapon_id': weapon_id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
    });
</script>
@endsection
