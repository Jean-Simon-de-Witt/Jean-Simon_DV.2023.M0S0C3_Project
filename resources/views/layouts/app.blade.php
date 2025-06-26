<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}?t={{ time() }}">
        <script src="{{ asset('js/layout.js')}}?t={{ time() }}"></script>
        <script src="{{ asset('js/interact.js') }}?t={{ time() }}"></script>
        <script src="{{ asset('js/alert.js')}}" defer></script>
    </head>
    <body>
        <div id="header">
            <nav>
                <a href="{{ route('index') }}"><img id="logo" src="{{ asset('uploads/logo-with-slogan.png') }}"></a>
                
                @if(($view ?? '') === 'listings.index')
                    <form method="GET" action="{{route('listings.index')}}">
                        <input type="text" class="searchbar" id="search" name="search" value="{{ $oldValues['search'] ?? ''}}" placeholder="Search for products, categories, or merchants">
                        @if(!empty($oldValues['sort1']))
                            <input type="hidden" name="sort1" id="sort1" value="{{$oldValues['sort1']}}">
                            <input type="hidden" name="order1" id="order1" value="{{$oldValues['order1']}}">
                        @endif
                        @if(!empty($oldValues['sort2']))
                            <input type="hidden" name="sort2" id="sort2" value="{{$oldValues['sort2']}}">
                            <input type="hidden" name="order2" id="order2" value="{{$oldValues['order2']}}">
                        @endif

                        @if(!empty($oldValues['sort3']))
                            <input type="hidden" name="sort3" id="sort3" value="{{$oldValues['sort3']}}">
                            <input type="hidden" name="order3" id="order3" value="{{$oldValues['order3']}}">
                        @endif
                    </form>
                @else
                    <div></div>
                @endif
                
                <div id="profile">
                    @auth
                        <a class="nav-link">Welcome, {{ Auth::user()->name }}</a>
                        @if(Auth::user()->profile_picture)
                            <img id="profile-picture-link" src="{{ asset('storage/' . Auth::user()->profile_picture) }}">
                        @else
                            <img id="profile-picture-link" src="{{ asset('uploads/profile.png') }}">
                        @endif
                    @endauth
                    @guest
                        <a class="nav-link" href="{{route('auth.login')}}"><img class="icon" src="{{ asset('uploads/login-white.svg') }}">Login</a>
                        <a class="nav-link" href="{{route('auth.register')}}"><img class="icon" src="{{ asset('uploads/registration-white.svg') }}">Sign Up</a>
                        <img id="profile-picture" src="{{ asset('uploads/profile.png') }}">
                    @endguest
                </div>
            </nav>
            @auth
            <div id="options-menu">
                @if(Auth::user()->admin)
                <a class="options-link" href="{{route('admin.index')}}">Admin</a>
                @endif
                <a class="options-link" href="{{route('user.cart.show', ['id' => Auth::user()->id])}}">Cart</a>
                <a class="options-link" href="{{route('user.profile.show', ['id' => Auth::user()->id])}}">Profile</a>
                @if(Auth::user()->merchant)
                <a class="options-link" href="{{route('user.profile.merchant.show', ['id' => Auth::user()->id])}}">Merchant Profile</a>
                @endif
                <form action="{{route('auth.logout')}}" method="POST">@csrf <button class="options-link" type="submit" >Logout</button></form>
            </div>
            @endauth
        </div>
        <div id="main">
            @yield('content')
        </div>
        <div id="footer">
            <p>footer</p>
        </div>
    </body>
</html>