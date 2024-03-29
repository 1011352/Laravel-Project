@extends('layouts.app')

@section('content')
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Build</title>
</head>

<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Add Build</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('weapons.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('weapons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Weapon 1:</strong>
                    <input type="text" name="weapon 1" class="form-control" placeholder="Weapon 1">
                    @error('weapon_1')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Weapon 2:</strong>
                    <input type="text" name="weapon 2" class="form-control" placeholder="weapon 2">
                    @error('weapon_2')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <label for="category_id" class="form-label">Choose Arctype:</label>
            <select id="category_id"
                    name="category_id"
                    class="@error('category_id') is-invalid @enderror form-select">
                <option @if(old('category_id') == '')selected @endif disabled hidden style='display: none'
                        value=''></option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" class="dropdown-item">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
            <span class="">{{$message}}</span>
            @enderror
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" name="description" class="form-control" placeholder="Description">
                    @error('description')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>
    </form>
</div>
</body>

@endsection
