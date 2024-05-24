@if(isset($templates['how-it-work'][0]) && $howItWork = $templates['how-it-work'][0])
    @push('style')
        <style>
            #banner-wrap::before {
                background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%), url({{getFile(config('location.content.path').optional($howItWork->templateMedia())->image)}});
            }
        </style>
    @endpush
    <!-- how it works section -->
    @if(isset($contentDetails['how-it-work']))
        <section class="how-it-works">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-text text-center mb-5">
                            <h5>@lang(optional($howItWork->description)->sub_title)</h5>
                            <h3>@lang(optional($howItWork->description)->title)</h3>
                        </div>
                    </div>
                </div>
                <div class="row gy-5 gy-lg-0">
                    @foreach($contentDetails['how-it-work'] as $k =>  $item)

                        <div class="col-lg-4 col-md-6 mx-auto">
                            <div class="box">
                                <div class="icon-box">
                                    <img src="{{ getFile(optional(optional($item->content)->contentMedia)->driver, optional(optional(optional($item->content)->contentMedia)->description)->image) }}" alt="{{config('basic.site_title')}}" width="64"/>
                                </div>
                                <div>
                                    <h5>@lang(optional($item->description)->title)</h5>
                                    <p>
                                        @lang(optional($item->description)->short_description)
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endif

