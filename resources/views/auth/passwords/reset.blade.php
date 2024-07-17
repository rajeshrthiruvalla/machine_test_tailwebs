@extends('layouts.app')

@section('content')
<div class="center-container">
    <h1 class="big-title red">tailwebs</h1>
    <div class="card">
        <h1>Reset Password</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label class="input-label">Email</label>
                <div class="input-group">
                    <span class="icon-container"><i class="fa-regular fa-user"></i></span>
                    <input name="email" id="email" type="email" class="input-item @error('email') red @enderror" value="{{ $email ?? old('email') }}" required/>
                </div>
                @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label class="input-label">Password</label>
                <div class="input-group">
                    <span class="icon-container"><i class="fa-solid fa-lock"></i></span>
                    <input name="password" id="password" type="password" class="input-item"/>
                </div>
                @error('password')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label class="input-label">Confirm Password</label>
                <div class="input-group">
                    <span class="icon-container"><i class="fa-solid fa-lock"></i></span>
                    <input name="password_confirmation" id="password-confirm" type="password" class="input-item"/>
                </div>
            </div>
            <div class="center margin-top-large">
                <button type="submit" class="black-white-button">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
