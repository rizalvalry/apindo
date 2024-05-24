@extends($theme.'layouts.app')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection
@section('banner_heading')
    {{ 'Pay with', optional($order->gateway)->name ?? '' }}
@endsection


@section('content')
    <section id="feature" class="about-page secbg-1 py-5 section__padding">
        <div class="feature-wrapper add-fund">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card secbg">
                            <div class="card-body ">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <img
                                            src="{{getFile(optional($order->gateway)->driver, optional($order->gateway)->image)}}"
                                            class="card-img-top gateway-img" alt="{{config('basic.site_title')}}">
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="my-3  text-center">@lang('Please Pay') {{getAmount($order->final_amount)}} {{$basic->currency}}</h3>
                                        <form
                                            action="{{ route('ipn', [optional($order->gateway)->code ?? 'mercadopago', $order->transaction]) }}"
                                            method="POST">
                                            <script
                                                src="https://www.mercadopago.com.co/integrations/v1/web-payment-checkout.js"
                                                data-preference-id="{{ $data->preference }}">
                                            </script>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
