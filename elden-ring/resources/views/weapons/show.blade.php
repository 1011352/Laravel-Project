@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center text-success">{{$weapon->title}}</h3>
                        <br/>
                        <h4>
                            Weapon 1:
                        </h4>
                        <p>
                            {{ $weapon->weapon_1 }}
                        </p>
                        <h4>
                            Weapon 2:
                        </h4>
                        <p>
                            {{ $weapon->weapon_2 }}
                        </p>
                        <h4>Description</h4>

                        <p>
                            {{ $weapon->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
@endsection
