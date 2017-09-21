@extends('layouts.common')

@section('page')
<h3 class="mb-3">Reset Password</h3>

<form method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Send Password Reset Link
        </button>
    </div>
</form>
@endsection
