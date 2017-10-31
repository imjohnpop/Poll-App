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
                                <h1 class="ml-5 pl-3 display-5">{{ $poll->poll_name }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </header>
        <main class="mb-5">
            <section class="container">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8 public_poll">
                        <div class="card  border border-primary mt-3 poll-shadow p-3">
                            <form method="post" action="">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="question">Name of the question</label>
                                    <input name="question" type="text" class="form-control" id="question" aria-describedby="emailHelp" placeholder="Enter a question" value="{{ $poll->poll_name }}">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="public" type="checkbox" class="form-check-input" checked>
                                        Make it public?
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="multiple" type="checkbox" class="form-check-input">
                                        Can user select more than one choice?
                                    </label>
                                </div>


                                <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                                @foreach($choices as $choice)
                                    <div class="form-group">
                                        @if($choice->choice_id==1)
                                            <?php $number = 'one';?>
                                        @elseif($choice->choice_id==2)
                                            <?php $number = 'two';?>
                                        @elseif($choice->choice_id==3)
                                            <?php $number = 'three';?>
                                        @endif
                                        <label for="o{{$choice->choice_id}}">Option <?= $number;?></label>
                                        <input name="option_<?= $number;?>" type="text" class="form-control" id="o{{$choice->choice_id}}" placeholder="Add an option" value="{{$choice->choice_text}}">
                                    </div>
                                @endforeach
                                @if(empty($choices[2]))
                                    <div class="form-group">
                                        <label for="o3">Option three</label>
                                        <input name="option_three" type="text" class="form-control" id="o3" placeholder="Add an option" value="">
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            </section>
        </main>
    @endforeach
@endsection