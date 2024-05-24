<!DOCTYPE html>
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
    <head>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>@yield('title')</title>
        <!-- bootstrap 5 -->
        <link rel="stylesheet" href="{{ asset($themeTrue.'css/bootstrap5.min.css') }}" />
        <!-- font awesome 5 -->
        <script src="{{ asset('assets/global/js/fontawesomepro.js') }}"></script>
        <!-- custom css -->
        <link rel="stylesheet" href="{{ asset($themeTrue.'css/style.css') }}" />
    </head>
    <body>

        @include($theme.'partials.header')

        @yield('content')

        @include($theme.'partials.footer')


        <!-- bootstrap -->
        <script src="{{ asset($themeTrue.'js/bootstrap.bundle.min.js') }}"></script>
        <!-- jquery cdn -->
        <script src="{{asset('assets/global/js/jquery.min.js') }}"></script>

        <!-- custom script -->
        <script src="{{ asset($themeTrue.'js/script.js') }}"></script>
    </body>
</html>
