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
<main>
    <section class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 public_poll">
                <div class="card mt-3 poll-shadow">
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
    @endforeach
@endsection