@extends('wrapper')

@section('page_title')
    @foreach($polls as $poll)
        Poll {{ $poll->poll_id }} | PollApp
    @endforeach
@endsection

@section('content')
    @foreach($polls as $poll)
        <header>
            <div class="container mt-2 mb-3">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="row border border-info rounded py-2 bg-light mt-2">
                            <div class="col-4 text-right">
                                <img class="img-fluid" width="150px"  height="150px" src="/img/pollapp-icon.png" alt="logo_picture" style="border-radius: 50%;">
                                <h2 class="mr-3">Poll App</h2>
                            </div>
                            <div class="col-8 d-flex justify-content-left align-items-center">
                                <h1 class="ml-5 pl-3 display-3">Poll {{ $poll->poll_id }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </header>
        <?php
            $id = $poll->poll_id;
            $current=Auth::user()->id;
            $answered=\App\Votes::where('user_id', '=', $current)->get();
            foreach ($answered as $val)
            {
                if($val->vote_to_poll == $id)
                {
                    $answer = false;
                }else{
                    $answer = true;
                }
            }
        ?>
        @if($answer)
        <main>
            <section class="container">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card mt-3">
                            <h4 class="card-header text-center">{{ $poll->poll_name }}</h4>
                            <form action="" method="post">
                            {{ csrf_field() }}
                                <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        @if($poll->nr_choice === 1)
                                            @foreach($choices as $choice)
                                                <input class="ml-auto my-auto" type="checkbox" id="{{$choice->choice_id}}"><label class="mr-auto my-auto">{{ $choice->choice_text }}</label>
                                            @endforeach
                                        @endif
                                        @if($poll->nr_choice === 0)
                                            @foreach($choices as $choice)
                                                <input class="ml-auto my-auto" type="radio" id="{{$choice->choice_id}}"><label class="mr-auto my-auto">{{ $choice->choice_text }}</label>
                                            @endforeach
                                        @endif
                                            <button class="btn btn-primary" type="submit">Vote</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </section>
        </main>
        @else
        <main class="mb-5">
                <section class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            @foreach($polls as $poll)
                                <?php $choices = \App\Choices::where('choices.choice_to_poll', '=', $poll->poll_id)->get(); $votes = []?>
                                    @foreach($choices as $choice)
                                        <?php $votes[]= $choice->nr_votes?>
                                    @endforeach
                                    <?php $nr_votes = array_sum($votes);?>
                                    <div class="card mt-3 poll-shadow poll-card">
                                        <div class="card-header d-flex justify-content-between py-2">
                                            <h4 class=" py-1">{{ $poll->poll_name }}</h4>
                                            <span class="badge badge-primary"><h5 class="pt-1">{{ round($nr_votes) }} votes</h5></span>
                                        </div>
                                        @foreach($choices as $choice)
                                        <div class="card-body border border-grey">
                                            <div class="d-flex justify-content-between">
                                                <li class="card-text">{{ $choice->choice_text }}</li>
                                                <div class="progress w-50 poll-align">
                                                    @if($nr_votes==0)
                                                        <div class="progress-bar mr-1" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>0%
                                                    @else
                                                        <div class="progress-bar mr-1" role="progressbar" style="width: <?php $width= ($choice->nr_votes / $nr_votes)*100; echo number_format((float)$width, 2, '.', '');;?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div><?php $width= ($choice->nr_votes / $nr_votes)*100; echo number_format((float)$width, 2, '.', '');?>%
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                            @endforeach
                        </div>
                        <div class="col-2"></div>
                    </div>
                </section>
            </main>
        @endif
    @endforeach
@endsection