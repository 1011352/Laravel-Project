@extends('layouts.app')

@section('content')

    <form action="{{route('home.search')}}" method="post">
        @csrf
        <label for="search">Search:</label>
        <input id="search" type="text" name="search">
        <input name="submit" type="submit" class="btn btn-primary"/>
    </form>

    <a href="{{route('home')}}" class="btn btn-primary btn-sm">Everything</a>
    @foreach($categories as $category)
        <a href="{{route('home', ['category' => $category->id])}}"
           class="btn btn-primary btn-sm">{{$category->name}}</a>
    @endforeach


    <div class="row justify-content-center g-2">

            @foreach($weapons as $weapon)
                <div class="col-sm-2">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://eldenring.wiki.fextralife.com/file/Elden-Ring/rivers_of_blood_katana_weapon_elden_ring_wiki_guide_200px.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$weapon->description}}</h5>
                        <span class="rounded-pill bg-opacity-50 bg-danger px-2">{{ $weapon->category->name }} </span>
                        <p class="card-text">{{$weapon->weapon_1}}</p>
                        <p class="card-text">{{$weapon->weapon_2}}</p>
                    </div>
                </div>
                </div>
            @endforeach
    </div>
    <div class="m-auto">

        {{$weapons->links()}}

    </div>

@endsection
