<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/dist/css/normalize.min.css">
    <link rel="stylesheet" href="assets/dist/css/skeleton.min.css">
    <link rel="stylesheet" href="assets/dist/css/custom.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar center">
            <a href="{{ route('index') }}" {{ Request::is('/') ? 'class=active' : '' }}>Import</a>
            <a href="{{ route('search') }}" {{ Request::is('search') ? 'class=active' : '' }}>Search</a>
        </nav>
        @yield('content')
    </div>

    <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/dist/js/custom.min.js"></script>
</body>
</html>
