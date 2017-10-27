@extends('wrapper')

@section('page_title')
    <title>{{ Auth::user()->name }} | Poll App</title>
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="row border border-info rounded py-2 bg-light mt-2">
                        <div class="col-4 text-right">
                            <img class="img-fluid" width="150px"  height="150px" src="img/user-picture.png" alt="profile_picture" style="border-radius: 50%;">
                            <h2 class="mr-4">{{ Auth::user()->name }}</h2>
                        </div>
                        <div class="col-8 d-flex justify-content-left align-items-center">
                            <h1 class="ml-5 pl-3 display-2">Poll App</h1>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
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
                        <div class="card mt-3 poll-shadow">
                            <h4 class="card-header text-center">{{ $poll->poll_name }}</h4>
                            <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                            @foreach($choices as $choice)
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <li class="card-text">{{ $choice->choice_text }}</li>
                                        <div class="progress w-50 poll-align">


                                            <!-- $number = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->where('choice_id', '=', $choice->choice_id)->get();-->
                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                    </div>
                                </div>
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
