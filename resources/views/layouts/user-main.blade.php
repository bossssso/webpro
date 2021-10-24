<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('/css/user-style.css')}}">
</head>

<body>
<main>
<header>
        <h1>@yield('title')</h1>

    @auth
        <nav class="user-panel">
        <span>{{ \Auth::user()->name }}</span>
        <a href="{{ route('logout') }}">Logout</a>
        </nav>
    @endauth

</header>

    <nav>
        <ul>
            <a href="{{route('maindish-list')}}"><strong>Maindish</strong></a>
            <a href="{{route('menut-list')}}"><strong>MenuType</strong></a>
            @can('delete', \App\Models\Maindish::class)
            <a href="{{route('user-list')}}"><strong>User</strong></a>
            @endcan
        </ul>
    </nav>

    <div>
        @if(session()->has('status'))
         <div class="status">{{session()->get('status')}}</div>
        @endif

        @error('error')
         <div class="status">{{ $message }}</div>
        @enderror
        @yield('content')
    </div>

    <footer>
            &#xA9; Copyright isekei no pasta
    </footer>
</main>
</body>
</html>