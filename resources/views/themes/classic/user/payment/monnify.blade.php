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
            <div class="row">
                <div class="col-md-12">
                    <div class="card secbg br-4">
                        <div class="card-body br-4">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <img
                                        src="{{getFile(optional($order->gateway)->driver, optional($order->gateway)->image)}}"
                                        class="card-img-top gateway-img br-4" alt="{{config('basic.site_title')}}">
                                </div>
                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$basic->currency}}</h4>
                                    <button class="btn btn-primary  mt-5"
                                            onclick="payWithMonnify()">@lang('Pay via Monnify')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script type="text/javascript" src="//sdk.monnify.com/plugin/monnify.js"></script>
        <script type="text/javascript">
        function payWithMonnify() {
            MonnifySDK.initialize({
                amount: {{ $data->amount ?? '0' }},
                currency: "{{ $data->currency ?? 'NGN' }}",
                reference: "{{ $data->ref }}",
                customerName: "{{$data->customer_name ?? 'John Doe'}}",
                customerEmail: "{{$data->customer_email ?? 'example@example.com'}}",
                customerMobileNumber: "{{ $data->customer_phone ?? '0123' }}",
                apiKey: "{{ $data->api_key }}",
                contractCode: "{{ $data->contract_code }}",
                paymentDescription: "{{ $data->description }}",
                isTestMode: true,
                onComplete: function (response) {
                    if (response.paymentReference) {
                        window.location.href = '{{ route('ipn', ['monnify', $data->ref]) }}';
                    } else {
                        window.location.href = '{{ route('failed') }}';
                    }
                },
                onClose: function (data) {
                }
            });
        }
    </script>
    @endpush
@endsection
