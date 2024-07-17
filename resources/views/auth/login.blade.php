<!doctype html>
<html>
    <head>
      <link rel="stylesheet" href="{{asset('style.css')}}"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
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
    </body>
</html>
