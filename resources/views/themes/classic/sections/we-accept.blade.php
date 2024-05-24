<!-- PAYMENT-METHOD -->
<section id="payment-method" class="section__padding">
    <div class="container">
        @if(isset($templates['we-accept'][0]) && $weAccept = $templates['we-accept'][0])
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="heading-container">
                        <h6 class="topheading">@lang(optional($weAccept->description)->title)</h6>
                        <h3 class="heading">@lang(optional($weAccept->description)->sub_title)</h3>
                        <p class="slogan">@lang(optional($weAccept->description)->short_details)</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="carousel-container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.15s">
            <div class="{{(session()->get('rtl') == 1) ? 'carousel-payment-rtl': 'carousel-payment'}}  owl-carousel owl-theme">
                @foreach($gateways as $gateway)
                    <div class="item-carousel">
                        <div class="payment-fig">
                            <img class="w-25" src="{{getFile($gateway->driver, $gateway->image)}}" alt="{{$gateway->name}}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- /PAYMENT-METHOD -->
