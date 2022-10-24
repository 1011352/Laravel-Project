@extends('layouts.app')

@section('content')

    <a href="{{route('home')}}" class="btn btn-primary btn-sm">Everything</a>
    @foreach($categories as $category)
        <a href="{{route('home', ['category' => $category->id])}}"
           class="btn btn-primary btn-sm">{{$category->name}}</a>
    @endforeach

    <div class="row justify-content-center">
            @foreach($weapons as $weapon)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://eldenring.wiki.fextralife.com/file/Elden-Ring/rivers_of_blood_katana_weapon_elden_ring_wiki_guide_200px.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$weapon->description}}</h5>
                        <p class="card-text">{{$weapon->weapon_1}}</p>
                        <p class="card-text">{{$weapon->weapon_2}}</p>

                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
    </div>

@endsection
