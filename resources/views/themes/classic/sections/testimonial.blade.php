@if(isset($templates['testimonial'][0]) && $testimonial = $templates['testimonial'][0])
    <!-- testimonial section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-text text-center mb-5">
                        <h3>
                            @lang(optional($testimonial->description)->title)
                        </h3>
                        <p class="mx-auto">
                            @lang(optional($testimonial->description)->sub_title)
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonials owl-carousel">
                        @if(isset($contentDetails['testimonial']))
                            @foreach($contentDetails['testimonial'] as $key=>$data)
                                <div class="review-box">
                                    <div class="upper">
                                        <div class="img-box">
                                            <img src="{{ getFile(optional(optional($data->content)->contentMedia)->driver, optional(optional(optional($data->content)->contentMedia)->description)->image) }}"/>
                                        </div>
                                        <div class="client-info">
                                            <h5>@lang(optional($data->description)->name)</h5>
                                            <span>{{ optional($data->description)->designation }}</span>
                                        </div>
                                    </div>
                                    <p class="mb-0">
                                        @lang(optional($data->description)->description)
                                    </p>
                                    <i class="fad fa-quote-right quote"></i>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
