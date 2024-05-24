@if(isset($templates['about-us'][0]) && $aboutUs = $templates['about-us'][0])
    <!-- ABOUT-US -->
    <section id="about-us" class="section__padding">
        <div class="container">
            <div class="heading-container">
                <h6 class="topheading">@lang(optional($aboutUs->description)->title)</h6>
                <h3 class="heading">@lang(optional($aboutUs->description)->sub_title)</h3>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="wrapper d-flex justify-content-center justify-content-xl-start  wow fadeInLeft"
                         data-wow-duration="1s" data-wow-delay="0.35s">
                        <div class="d-flex position-relative">
                            <div class="about-fig">
                                <img class="w-100" src="{{getFile(optional($aboutUs->media)->driver, $aboutUs->templateMedia()->image)}}" alt="@lang('Image Missing')" class="w-100">
                            </div>
                            <div class="about-overlay-fig">
                                <img class="w-100" class="img-fill w-100" src="{{getFile(optional($aboutUs->media)->driver, $aboutUs->templateMedia()->image)}}" alt="@lang('Image Missing')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="d-flex align-items-center h-fill">
                        <div class="text-wrapper wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.35s">
                            <h6 class="h6 text-center text-xl-left">
                                @lang(optional($aboutUs->description)->short_title)
                            </h6>
                            <div class="about-feature mt-30 d-flex flex-column align-items-center align-items-l-start">
                                @lang(optional($aboutUs->description)->short_description)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ABOUT-US -->
@endif


