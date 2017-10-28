@extends('wrapper')

@section('page_title')
    Homepage | PollApp
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-6 mt-5 d-flex justify-content-between flex-column">
                    <div>
                        <h3 class="">PollApp | Your real-time voting app</h3>
                        <p class="mt-3">Use PollApp to interact with people in real time. Create polls without a limit and ask for opinions of others or give your opinion and answer polls created by others. Fast to start, quick and easy to use and it's even free. There is nothing to download or install. Create an account now!</p>
                    </div>
                    <div class="row mb-5">
                        <div class="col-5">
                            <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#loginModal">Login</button>
                        </div>
                        <div class="col-5">
                            <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#registerModal">Create a free account</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-2">
                    <img class="w-100" src="/img/imac.png" alt="Imac page">
                </div>
            </div>
        </div>
    </main>

    <main class="mb-5">
        <div class="container-fluid border border-left-0 border-right-0 border-bottom-0 border-info">
            <div class="row bg-light">
                <div class="col-8 mx-auto">
                    @foreach($data as $poll)
                        <?php $choices = \App\Choices::where('choices.choice_to_poll', '=', $poll->poll_id)->get(); $votes = []?>
                            @foreach($choices as $choice)
                                <?php $votes[]= $choice->nr_votes?>
                            @endforeach
                            <?php $nr_votes = array_sum($votes);?>
                            <div class="card mt-3 poll-shadow poll-card">
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

                    @endforeach
                </div>
            </div>
        </div>
    </main>


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