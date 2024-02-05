<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
    @yield('css-style')
</head>
<body>
    {{-- @if (Route::currentRouteName() !=='login'||'register'||'welcome') --}}
        {{-- @yield('unAuthcontent') --}}
        {{-- @include('panels.navbar')
    @endif
    
        @yield('content')

    @if (Route::currentRouteName() !=='login'||'register'||'welcome')
        @include('panels.footer')
    @endif

    @yield('js-script') --}}
</body>
</html>