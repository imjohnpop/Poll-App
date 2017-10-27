@extends('wrapper')

@section('page_title')
    {{ Auth::user()->name }} | Poll App
@endsection

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="row border border-info rounded py-2 bg-light mt-2">
                        <div class="col-4 text-right">
                            <img class="img-fluid" width="150px"  height="150px" src="img/user-picture.png" alt="profile_picture" style="border-radius: 50%;">
                            <h2 class="mr-4">{{ Auth::user()->name }}</h2>
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
    <main>
        <div class="container">
            <div class="row mt-2">
                <div class="col-8 public_pol mx-auto">
                    <div class="card border border-primary rounded">
                        <a type="button" class="poll-plus-sign" data-toggle="modal" data-target="#exampleModal">
                            <div class="card-body text-center bg-primary">
                                <i class="fa fa-plus text-white" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @foreach($polls as $poll)
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card mt-3 poll-shadow">
                            <h4 class="card-header text-center">{{ $poll->poll_name }}</h4>
                            <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                            @foreach($choices as $choice)
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <li class="card-text">{{ $choice->choice_text }}</li>
                                        <div class="progress w-50 poll-align">
                                            <!-- $number = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->where('choice_id', '=', $choice->choice_id)->get();-->
                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="ml-auto p-2">
                                <button type="button" class="btn btn-primary">Edit</button>
                                <a type="button" href="{{action('profileController@destroy', ["idcko" => "$poll->poll_id"])}}" class="btn btn-primary">Delete</a>
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
    </main>
@endsection
