@if(!request()->routeIs('listing-details'))
    <style>
        .banner-section {
            background-image: url({{ getFile(config('basic.default_file_driver'), config('basic.partial_banner')) }});
        }
    </style>
@else
<style>
        .banner-section {
            display: none;
        }
    </style>
    <!-- @yield('listing_thumbnail') -->
@endif

@if (!request()->routeIs('home'))
    <section class="banner-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-text text-center">
                            <!-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                                    @yield('breadcrumb_items')
                                    <li class="breadcrumb-item active text-white" aria-current="page">@yield('banner_heading')</li>
                                </ol>
                            </nav> -->
                            <h3>@yield('banner_heading')</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
