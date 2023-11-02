<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="bg-slate-100">
    @include('partials.navbar')


    <div class="m-4">
        @yield('content')
    </div>

</body>
</html>