@extends('layouts.app')

@section('content')
<div class="center-container">
    <h1 class="big-title red">tailwebs</h1>
    <div class="card">
        <h1>Reset Password</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <label class="input-label">Email</label>
                <div class="input-group">
                    <span class="icon-container"><i class="fa-regular fa-user"></i></span>
                    <input name="email" id="email" type="email" class="input-item @error('email') red @enderror" value="{{ old('email') }}" required/>
                </div>
                @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="center margin-top-large">
                <button type="submit" class="black-white-button">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
