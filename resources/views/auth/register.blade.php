@extends('layouts.common')

@section('page')
<h3 class="mb-3">Register</h3>

<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">E-Mail Address</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="text-danger">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
        @if ($errors->has('password'))
            <span class="text-danger">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Register
        </button>
    </div>
</form>
@endsection
