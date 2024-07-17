@extends('layouts.app')

@section('content')
        <div class="center-container">
            <h1 class="big-title red">tailwebs</h1>
            <div class="card">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label class="input-label">Username</label>
                        <div class="input-group">
                            <span class="icon-container"><i class="fa-regular fa-user"></i></span>
                            <input name="email" id="email" type="email" class="input-item"/>
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
                    <a class="link" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                    <div class="center margin-top-large">
                        <button type="submit" class="black-white-button">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
