@extends('wrapper')

@section('page_title')
    <title>{{ Auth::user()->name }} | Poll App</title>
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="" alt="profile_picture">
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
                <div class="col-8">
                    <h1>Poll App</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <a href="#"><i class="fa fa-plus-square-o" aria-hidden="true"></i></a>
                </div>
                <div class="col-2"></div>
            </div>
            @foreach($polls as $poll)
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div>
                            <h3>{{ $poll->poll_name }}</h3>
                            <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                            @foreach($choices as $choice)
                                <p>{{$choice->choice_text}}</p>
                            @endforeach
                        </div>
                        <div>
                            <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-minus-square-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            @endforeach
        </div>
    </main>
@endsection