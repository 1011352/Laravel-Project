<!DOCTYPE html>
<html lang="en">
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
                <a class="btn btn-success" href="{{ route('weapons.create') }}"> Create Build</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Weapon 1</th>
            <th>Weapon 2</th>
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
    {!! $weapons->links() !!}
</div>
</body>
</html>
