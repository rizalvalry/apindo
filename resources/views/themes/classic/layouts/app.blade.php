<!DOCTYPE html>
<html class="no-js" lang="en" @if(session()->get('rtl') == 1) dir="rtl" @endif >
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @if(in_array(request()->route()->getName(),['listing-details']))
        @stack('seo')
    @else
        @include('partials.seo')
    @endif

    <title>@yield('title')</title>
    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/bootstrap5.min.css') }}"/>
    <!-- Header Head -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/header-head.css') }}"/>
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/owl.theme.default.min.css') }}"/>
    <!-- range slider -->
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/range-slider.css') }}"/>
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/magnific-popup.css') }}"/>
    <!-- font awesome 5 -->
    <script src="{{ asset('assets/global/js/fontawesomepro.js') }}"></script>
    <!-- fancybox slider -->
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/fancybox.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrapicons-iconpicker.css') }}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset($themeTrue.'css/style.css') }}"/>
    @stack('css-lib')
    <!----  Push your custom css  ----->
    @stack('style')
</head>
<body @if(session()->get('rtl') == 1) class="rtl" @endif >
@include($theme.'partials.header')

@include($theme.'partials.banner')

@yield('content')

@include($theme.'partials.footer')

@stack('whatsapp_chat')
@stack('fb_messenger_chat')

@include($theme.'partials.cookie')

@stack('extra-content')

@stack('frontend_modal')

<!-- bootstrap -->
<script src="{{ asset($themeTrue.'js/bootstrap.bundle.min.js') }}"></script>

<!-- jquery cdn -->
<script src="{{asset('assets/global/js/jquery.min.js') }}"></script>

<!-- Header JS -->
<script src="{{asset('assets/global/js/header-head.js') }}"></script>


<!-- select 2 -->
<script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset($themeTrue.'js/owl.carousel.min.js') }}"></script>
<!-- range slider -->
<script src="{{ asset($themeTrue.'js/range-slider.min.js') }}"></script>
<!-- leaflet js -->
<script src="{{ asset('assets/global/js/leaflet.js') }}"></script>
<!-- social share -->
<script src="{{ asset($themeTrue.'js/socialSharing.js') }}"></script>
<!-- magnific popup -->
<script src="{{ asset($themeTrue.'js/magnific-popup.js') }}"></script>


@stack('extra-js')


<script src="{{asset('assets/global/js/notiflix-aio-2.7.0.min.js')}}"></script>
<script src="{{asset('assets/global/js/pusher.min.js')}}"></script>
<script src="{{asset('assets/global/js/vue.min.js')}}"></script>
<script src="{{asset('assets/global/js/axios.min.js')}}"></script>

<script src="{{ asset($themeTrue.'js/script.js') }}"></script>
@stack('script')

@include($theme.'partials.notification')

@if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp
    <script>
        "use strict";
        @foreach ($errors as $error)
        Notiflix.Notify.Failure("{{trans($error)}}");
        @endforeach
    </script>
@endif


@include('plugins')

</body>
</html>
