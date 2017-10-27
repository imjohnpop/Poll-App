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
                @foreach($choices as $choice)
                    <input type="radio">{{ $choice->text }}<br>
                @endforeach
                    <input type="submit" value="Vote">
                </form>
            </div>
            <div class="col-2"></div>        
        </div>
        @endforeach
    </section>
</main>
@endsection