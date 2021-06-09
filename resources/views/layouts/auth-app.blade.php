<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Hotel</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('templates/auth')}}/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('templates/auth')}}/css/style.css">
</head>
<body>

    <div class="main">

        @yield('content')

    </div>

    <!-- JS -->
    <script src="{{asset('templates/auth')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('templates/auth')}}/js/main.js"></script>
</body>
</html>
