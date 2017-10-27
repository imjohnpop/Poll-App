@extends('wrapper')

@section('page_title')
    <title>Profile | Poll App</title>
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="" alt="profile_picture">
                    <h2>{{name}}</h2>
                </div>
                <div class="col-8">
                    <h1>{{title}}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <button></button>
                </div>
                <div class="col-2"></div>
            </div>
            @foreach()
                <div class="row"></div>
            @endforeach
        </div>
    </main>
@endsection