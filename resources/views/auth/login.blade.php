@extends('layouts.common')

@section('page')
<h3 class="mb-3">Login</h3>

<form class="panel-body" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    @if (session()->has('registered'))
        <div class="form-group">
            <div class="alert alert-success">{{ session('registered') }}</div>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="form-group">
            <div class="alert alert-warning">{{ session('warning') }}</div>
        </div>
    @endif

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="text-danger">
                {{ $errors->first('email') }}
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
        @if ($errors->has('password'))
            <span class="text-danger">
                {{ $errors->first('password') }}
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" id="remember" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">Remember Me</label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Login
        </button>

        <a class="btn btn-link" href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    </div>
</form>
@endsection
