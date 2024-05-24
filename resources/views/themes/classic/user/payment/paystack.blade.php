@extends($theme.'layouts.app')
@section('title')
    {{ 'Pay with '.optional($order->gateway)->name ?? '' }}
@endsection

@section('banner_heading')
    {{ 'Pay with', optional($order->gateway)->name ?? '' }}
@endsection


@section('content')
    <section id="dashboard" class="section__padding">
        <div class="container add-fund pb-50">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-8 col-sm-12">
                    <div class="card secbg br-4 custom-card-payment">
                        <div class="card-body br-4">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img
                                        src="{{getFile(optional($order->gateway)->driver, optional($order->gateway)->image)}}"
                                        class="card-img-top gateway-img br-4" alt="{{config('basic.site_title')}}">
                                </div>
                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$basic->currency}}</h4>
                                    <button type="button"
                                            class="btn btn-primary"
                                            id="btn-confirm">@lang('Pay Now')</button>
                                    <form
                                        action="{{ route('ipn', [optional($order->gateway)->code, $order->transaction]) }}"
                                        method="POST">
                                        @csrf
                                        <script
                                            src="//js.paystack.co/v1/inline.js"
                                            data-key="{{ $data->key }}"
                                            data-email="{{ $data->email }}"
                                            data-amount="{{$data->amount}}"
                                            data-currency="{{$data->currency}}"
                                            data-ref="{{ $data->ref }}"
                                            data-custom-button="btn-confirm">
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

