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
        @if(Auth::check())
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
            <?php
                $current=Illuminate\Support\Facades\Auth::user()->id;
            ?>
            @foreach($polls as $poll)
                @if($poll->voted($current))
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="card border border-primary mt-3">
                                <h4 class="card-header text-center"><a class="text-dark" href="{{action('listController@view', ["idcko" => "$poll->poll_id"])}}">{{ $poll->poll_name }}</a></h4>
                                <form action="{{action('listController@vote', ['id' => $poll->poll_id])}}" method="post">
                                {!! csrf_field() !!}
                                    <?php $choices = \App\Choices::where('choice_to_poll', '=', $poll->poll_id)->get();?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            @if($poll->nr_choice === 1)
                                                @foreach($choices as $choice)
                                                    <input class="ml-auto my-auto" type="checkbox" value="{{$choice->choice_id}}" name="choice_check{{$poll->poll_id}}"><label class="ml-1 mr-auto my-auto">{{ $choice->choice_text }}</label>
                                                @endforeach
                                            @endif
                                            @if($poll->nr_choice === 0)
                                                @foreach($choices as $choice)
                                                    <input class="ml-auto my-auto" type="radio" value="{{$choice->choice_id}}" name="choice_radio{{$poll->poll_id}}"><label class="ml-1 mr-auto my-auto">{{ $choice->choice_text }}</label>
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
                @else
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <?php $choices = \App\Choices::where('choices.choice_to_poll', '=', $poll->poll_id)->get(); $votes = []?>
                            @foreach($choices as $choice)
                                <?php $votes[]= $choice->nr_votes?>
                            @endforeach
                            <?php $nr_votes = array_sum($votes);?>
                            <div class="card border border-primary mt-3">
                                <div class="card-header d-flex justify-content-between py-2">
                                    <h4 class="text-center"><a class="text-dark" href="{{action('listController@view', ["idcko" => "$poll->poll_id"])}}">{{ $poll->poll_name }}</a></h4>
                                    <span class="badge badge-primary"><h5 class="pt-1">{{ round($nr_votes) }} votes</h5></span>
                                </div>
                                @foreach($choices as $choice)
                                    <div class="card-body border border-grey">
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
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                @endif
            @endforeach
        @else
            @foreach($polls as $poll)
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <?php $choices = \App\Choices::where('choices.choice_to_poll', '=', $poll->poll_id)->get(); $votes = []?>
                        @foreach($choices as $choice)
                            <?php $votes[]= $choice->nr_votes?>
                        @endforeach
                        <?php $nr_votes = array_sum($votes);?>
                        <div class="card border border-primary mt-3 poll-shadow poll-card">
                            <div class="card-header d-flex justify-content-between py-2">
                                <h4 class=" py-1">{{ $poll->poll_name }}</h4>
                                <span class="badge badge-primary"><h5 class="pt-1">{{ round($nr_votes) }} votes</h5></span>
                            </div>
                            @foreach($choices as $choice)
                                <div class="card-body border border-grey">
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
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
            @endforeach
        @endif
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

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ********************************** -->
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-12">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
                <!-- ********************************** -->
            </div>
        </div>
    </div>
</div>
<!-- End of Modal ******************************* -->

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ********************************** -->
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-12">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-+2">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
                <!-- ********************************** -->
            </div>
        </div>
    </div>
</div>
<!-- End of Modal ******************************* -->
@endsection
