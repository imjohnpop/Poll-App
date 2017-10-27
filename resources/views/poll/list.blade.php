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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add new question</button>
            </div>
            <div class="col-2"></div>        
        </div>
        @foreach($polls as $poll)
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 public_poll">
                <div class="card mt-3 poll-shadow">
                    <h4 class="card-header text-center">{{ $poll->poll_name }}</h4>
                    <form action="" method="post">
                        <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                @if($poll->nr_choice === 1)
                                    @foreach($choices as $choice)
                                        <input class="ml-auto my-auto" type="checkbox" id="{{$choice->choice_to_poll.$choice->choice_id}}"><label class="mr-auto my-auto">{{ $choice->choice_text }}</label>
                                    @endforeach
                                @endif
                                @if($poll->nr_choice === 0)
                                    @foreach($choices as $choice)
                                        <input class="ml-auto my-auto" type="radio" id="{{$choice->choice_to_poll.$choice->choice_id}}"><label class="mr-auto my-auto">{{ $choice->choice_text }}</label>
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
