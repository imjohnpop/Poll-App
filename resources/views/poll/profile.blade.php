@extends('wrapper')

@section('page_title')
    {{ Auth::user()->name }} | Poll App
@endsection

@section('content')
    <header>
        <div class="container mt-2 mb-3">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="row border border-info rounded py-2 bg-light mt-2">
                        <div class="col-4 text-right">
                            <img class="img-fluid" width="150px"  height="150px" src="img/user-picture.png" alt="profile_picture" style="border-radius: 50%;">
                            <h2 class="mr-3 pr-3">{{ Auth::user()->name }}</h2>
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
    <main class="mb-5">
        <div class="container">
            <div class="row mt-2">
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
                    <div class="col-2"></div>
                    <div class="col-8">
                        <?php $choices = \App\Choices::where('choices.choice_to_poll', '=', $poll->poll_id)->get(); $votes = []?>
                        @foreach($choices as $choice)
                            <?php $votes[]= $choice->nr_votes?>
                        @endforeach
                        <?php $nr_votes = array_sum($votes);?>
                        <div class="card mt-3 poll-shadow">
                            <h4 class="card-header text-center"><a class="text-dark" href="{{action('listController@view', ["idcko" => "$poll->poll_id"])}}">{{ $poll->poll_name }}</a></h4>
                            <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                            @foreach($choices as $choice)
                                <div class="card-body  border border-grey">
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
                            <div class="d-flex flex-row justify-content-between">
                                <div class="p-2">
                                    <h4><span class="badge badge-primary">{{ round($nr_votes) }} votes</span></h4>
                                </div>
                                <div class="p-2">
                                    <a href="{{action('profileController@edit_view', ["idcko" => "$poll->poll_id"])}}" class="btn btn-primary text-white">Edit</a>
                                    <a href="{{action('profileController@destroy', ["idcko" => "$poll->poll_id"])}}" class="btn btn-primary">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            @endforeach
        </div>
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
    </main>
@endsection
