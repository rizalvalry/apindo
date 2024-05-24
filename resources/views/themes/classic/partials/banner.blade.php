@if(!request()->routeIs('listing-details'))
    <style>
        .banner-section {
            background-image: url({{ getFile(config('basic.default_file_driver'),config('basic.partial_banner')) }});
        }
    </style>
@else
    @yield('listing_thumbnail')
@endif

@if (!request()->routeIs('home'))
    <section class="banner-section">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-text text-center">
                            <h3>@yield('banner_heading')</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
