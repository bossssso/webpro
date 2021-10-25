<!DOCTYPE html>
<html lang="en">

<head>
       
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <link rel="stylesheet" href="{{ asset('/css/user-style.css')}}">
        {!! NoCaptcha::renderJs() !!}
</head>

<body>
<main >
    <header>
        <h1>Login</h1>
    </header>

<main class="login">
    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <label>
            E-mail <strong>::</strong> <input type="text" name="email" required />
        </label><br /> <br />
        <label>
            Password <strong>::</strong> <input type="password" name="password" required />
        </label><br /> <br />
<<<<<<< HEAD
        <button class="submit" type="submit">Login</button>
=======
        {!! NoCaptcha::display() !!}
        @if ($errors->has('g-recaptcha-response'))
    <span class="help-block">
        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
    </span>
    @endif
    <br />
>>>>>>> bc7b5bac956cd389dfe99ba0abeb121212bc9992
        @error('credentials')
            <div class="warn">{{ $message }}</div>
        @enderror
        </form>


</main>

    <footer>
            &#xA9; Copyright isekei no pasta
    </footer>
</main>
</body>
</html>