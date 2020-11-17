@extends('layouts.app')

@section('content')
    <router-view></router-view>
@endsection

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Public holidays</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
        <link rel="stylesheet" href="css/app.css">

        <script src="js/app.js" defer></script>

    </head>
    <body class="antialiased">
        <div id="app">
            <public-holidays/>
        </div>
    </body>
</html> --}}
