@extends($theme.'layouts.error')
@section('title','404')
@section('banner_heading')
   @lang('404')
@endsection

@section('content')
    <section class="not-found">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col">
                    <div class="text-box text-center">
                        <img src="{{ asset($themeTrue.'img/icon/error-404.png') }}" alt="{{config('basic.site_title')}}" />
                        <h1>@lang('Oops!')</h1>
                        <p>@lang("We can't seem to find the page you are looking for")</p>
                        <a href="{{ route('home') }}" class="btn-custom text-white">@lang('Back To Home')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
