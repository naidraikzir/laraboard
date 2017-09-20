<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <title>Laraboard</title>
        @if (env('APP_ENV') !== 'local')
            <link rel="stylesheet" href="/css/app.css">
        @endif
    </head>

    <body>
        <div id="dashboard"></div>
        @if (env('APP_ENV') === 'local')
            <script src="http://localhost:8080/js/vendor.js"></script>
            <script src="http://localhost:8080/js/dashboard.js"></script>
        @else
            <script src="/js/vendor.js"></script>
            <script src="/js/dashboard.js"></script>
        @endif
    </body>
</html>
