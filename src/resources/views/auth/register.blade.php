@extends('app')

@section('content')

    <div class="container-fluid" id="Login-Register-Container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="panel panel-default" id="Login-Register-Panel">
                    <div class="panel-body">
                        <h4 class="text-center" id="log-in">Register</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="username">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!--****************************************************New part*****************************************************-->

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="first name">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="last name">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"placeholder="address">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="city">
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="text" class="form-control" name="zip" value="{{ old('zip') }}" placeholder="post code">
                                    @if ($errors->has('zip'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <!--****************************************************New part*****************************************************-->

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="password" class="form-control" name="password" placeholder="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3 text-center">
                                    <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light btn-block">Register</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <p id="No-Account" class="center-block text-center">Already have an account? <a href="{{ url('/login') }}" id="Sign-up">Login</a></p>
                <p id="No-Account" class="center-block text-center">Login as Test Admin User <a href="{{ url('/login') }}" id="Sign-up">Login</a></p>
            </div>
        </div>
    </div>
@endsection