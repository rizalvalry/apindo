<!-- INVESTMENT-PLAN -->
<section id="investment-plan" class="section__padding">
    <div class="container">
        @if(isset($templates['why-chose-us'][0]) && $whyChoseUs = $templates['why-chose-us'][0])
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang(optional($whyChoseUs->description)->title)</h6>
                        <h3 class="heading">@lang(optional($whyChoseUs->description)->sub_title)</h3>
                        <p class="slogan">@lang(optional($whyChoseUs->description)->short_details)</p>
                    </div>
                </div>
            </div>
        @endif
        @if(isset($contentDetails['why-chose-us']))
            <div class="investment-plan-wrapper">
                <div class="row">
                    @foreach($contentDetails['why-chose-us'] as $item)
                        <div class="col-md-6">
                            <div class="card-type-1 card align-items-start wow fadeInLeft" data-wow-duration="1s"
                                 data-wow-delay="0.15s">
                                <div class="media">
                                    <div class="card-icon">
                                        <img
                                            src="{{getFile(optional(optional($item->content)->contentMedia)->driver, optional(optional(optional($item->content)->contentMedia)->description)->image)}}" class="w-50" alt="{{config('basic.site_title')}}">
                                    </div>
                                    <div class="media-body ml-20">
                                        <h5 class="mb-15">@lang(optional($item->description)->title)</h5>
                                        <p class="text">
                                            @lang(optional($item->description)->information)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
<!-- /INVESTMENT-PLAN -->
