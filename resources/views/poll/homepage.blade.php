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
                        <p class="mt-3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam dapibus fermentum ipsum. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Etiam neque. Vivamus ac leo pretium faucibus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Phasellus faucibus molestie nisl</p>
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
                    <img class="w-100" src="img/imac.png" alt="Imac page">
                </div>
            </div>
        </div>
    </main>

    <main>
        <div class="container-fluid">
            <div class="row bg-light">
                <div class="col-8 mx-auto">
                    @foreach($data as $poll)
                        <?php $choices = \App\Choices::where('choices.choice_to_poll', '=', $poll->poll_id)->get(); ?>

                            <div class="card mt-3 poll-shadow">
                                <h4 class="card-header text-center">{{ $poll->poll_name }}</h4>
                                @foreach($choices as $choice)
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <li class="card-text">{{ $choice->choice_text }}</li>
                                        <div class="progress w-50 poll-align">
                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
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