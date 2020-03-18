<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @yield('styles')

</head>
<body class="c-app">

@include('sidebars.admin')

<div class="c-wrapper">

    @include('headers.admin')

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div id="ui-view">

                    @include('inc.messages')

                    @yield('content')

                </div>
            </div>
        </main>
    </div>

    @include('footers.admin')

</div>


<!-- Scripts -->
@yield('scripts')

</body>
</html>
