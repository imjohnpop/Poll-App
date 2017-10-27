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
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 public_poll">
                <h2>How much do you like cookies?</h2>
                <form action="" method="post">
                    <input type="radio">An f*ing lot. <br>
                    <input type="radio">Just a lot.<br>
                    <input type="radio">Eh, I'm a boring indiferent person.<br>
                    <input type="radio">What is a cookie?<br>
                    <input type="submit" value="Vote">
                </form>
            </div>
            <div class="col-2"></div>        
        </div>
    </section>
</main>
@endsection