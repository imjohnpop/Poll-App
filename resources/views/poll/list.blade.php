@extends('wrapper')

@section('page_title')
    Poll List | PollApp
@endsection

@section('content') 
<main>
    <h1>Poll list</h1>
    <section class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <button>Add</button>
            </div>
            <div class="col-2"></div>        
        </div>
        @foreach($polls as $poll)
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 public_poll">
                <h2>{{ $poll->poll_name}}</h2>
                <form action="" method="post">
                <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                @if($poll->nr_choice === 1)
                    @foreach($choices as $choice)
                        <input type="checkbox">{{ $choice->choice_text }}<br>
                    @endforeach
                @endif
                @if($poll->nr_choice === 0)
                    @foreach($choices as $choice)
                        <input type="radio">{{ $choice->choice_text }}<br>
                    @endforeach
                @endif
                    <input type="submit" value="Vote">
                </form>
            </div>
            <div class="col-2"></div>        
        </div>
        @endforeach
    </section>
</main>
@endsection
