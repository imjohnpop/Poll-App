@extends('wrapper')

@section('page_title')
    Poll List | PollApp
@endsection

@section('content')
<header>
    <div class="container mt-2 mb-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="row border border-info rounded py-2 bg-light mt-2">
                    <div class="col-4 text-right">
                        <img class="img-fluid" width="150px"  height="150px" src="img/pollapp-icon.png" alt="logo_picture" style="border-radius: 50%;">
                        <h2 class="mr-3">Poll App</h2>
                    </div>
                    <div class="col-8 d-flex justify-content-left align-items-center">
                        <h1 class="ml-5 pl-3 display-3">List of Polls</h1>
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
            <div class="col-8 public_pol">
                <div id="add" class="card border border-grey rounded">
                    <a class="poll-plus-sign" data-toggle="modal" data-target="#exampleModal">
                        <div class="card-body text-center w-100 btn btn-primary">
                            <i class="fa fa-plus text-white" aria-hidden="true"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        @foreach($polls as $poll)
        <div class="row">

            <div class="col-8 public_poll mx-auto">
                <div class="card mt-3 poll-shadow">
                    <h4 class="card-header text-center">{{ $poll->poll_name }}</h4>
                    <form action="" method="post">
                    {!! csrf_field() !!}
                        <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                @if($poll->nr_choice === 1)
                                    @foreach($choices as $choice)
                                        <input class="ml-auto my-auto" type="checkbox" id="{{$choice->choice_to_poll.$choice->choice_id}}" name="choice_check{{$poll->poll_id}}"><label class="ml-1 mr-auto my-auto">{{ $choice->choice_text }}</label>
                                    @endforeach
                                @endif
                                @if($poll->nr_choice === 0)
                                    @foreach($choices as $choice)
                                        <input class="ml-auto my-auto" type="radio" id="{{$choice->choice_to_poll.$choice->choice_id}}" name="choice_radio{{$poll->poll_id}}"><label class="ml-1 mr-auto my-auto">{{ $choice->choice_text }}</label>
                                    @endforeach
                                @endif
                                <a href='{{action("listController@vote", ["id" => "$choice->choice_to_poll"])}}'><button type="submit" class="btn btn-primary">Submit</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        @endforeach
    </section>
</main>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="question">Name of the question</label>
                        <input name="question" type="text" class="form-control" id="question" aria-describedby="emailHelp" placeholder="Enter a question">
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="public" type="checkbox" class="form-check-input checked">
                            Make it public?
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="multiple" type="checkbox" class="form-check-input">
                            Can user select more than one choice?
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="o1">Option one</label>
                        <input name="option_one" type="text" class="form-control" id="o1" placeholder="Add an option">
                    </div>
                    <div class="form-group">
                        <label for="o2">Option two</label>
                        <input name="option_two" type="text" class="form-control" id="o2" placeholder="Add an option">
                    </div>
                    <div class="form-group">
                        <label for="o3">Option three</label>
                        <input name="option_three" type="text" class="form-control" id="o3" placeholder="Add an option">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
