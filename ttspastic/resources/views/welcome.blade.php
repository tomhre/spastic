<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="shortcut icon" type="image/png" href="{{asset('favicon-32x32.png')}}"/>

        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
        <link href="{{ mix('css/app.css') }}?v=<?php echo(filemtime(public_path().'/css/app.css')); ?>" rel="stylesheet">
        
        <title>SPA tutorial by Voerro</title>
    </head>
    <body>
        <div id="app">
            <main-layout></main-layout>
        </div>

        <script src="{{ mix('js/app.js') }}?v=<?php echo(filemtime(public_path().'/js/app.js')); ?>"></script>
    </body>
</html>