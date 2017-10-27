@extends('wrapper')

@section('page_title')
    Poll List | PollApp
@endsection

@section('content') 
<main>
    <h1>Vote</h1>
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
                                <input type="submit" value="Vote">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-2"></div>        
        </div>
    </section>
</main>
@endsection