@extends('app')

@section('content')

    <div id="wrapper">


        @include('pages.partials.side-nav')

                <!-- Button to toggle side-nav -->
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
        <a href="{{ url(route('user.profile.index')) }}" class="btn btn-danger">Back</a>

        <div class="container-fluid">

            <h4 class="text-center">Edit Profile</h4><br><br>

            <div class="col-md-12">

                <form role="form" method="POST" action="{{ route('user.profile.postProfile',$user->id) }}">

                    {!! csrf_field() !!}


                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label>User name</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username')? : $user->username }}"
                                   placeholder="username" readonly="readonly">
                            @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email')? : $user->email }}"
                                   placeholder="email" readonly="readonly">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <!--****************************************************New part*****************************************************-->
                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label>First name</label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name')? : $user->first_name }}"
                                   placeholder="first name">
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label>Last name</label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name')? : $user->last_name }}"
                                   placeholder="last name">
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address')? : $user->address }}"
                                   placeholder="address">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label>city</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city')? : $user->city }}"
                                   placeholder="city">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3" id="Product-Input-Field">
                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label>Post code</label>
                            <input type="text" class="form-control" name="zip" value="{{ old('zip')? : $user->zip }}"
                                   placeholder="post code">
                            @if ($errors->has('zip'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('zip') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <!--****************************************************New part*****************************************************-->

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Register
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>  <!-- close container-fluid -->

    </div>  <!-- close wrapper -->


@endsection