@extends('user/app')

@section('bg-img',asset('user/img/contact-bg.jpg'))
@section('head')

@endsection
@section('title','Register Here')
@section('sub-heading','')

@section('main-content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-2 col-md-10 col-md-offset-1">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group col-xs-12{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label>

                        <div class="col-xs-12 floating-label form-group controls">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                               <strong>{{ $errors->first('name') }}</strong>
                           </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-xs-12{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-Mail Address</label>

                        <div class="">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                           </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-xs-12{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>

                        <div class="">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-group col-xs-12">
                        <label for="password-confirm">Confirm Password</label>

                        <div class="">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </article>

    <hr>
@endsection
@section('footer')
@endsection
