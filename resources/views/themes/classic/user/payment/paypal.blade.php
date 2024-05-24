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
                        <div class="card-body text-center br-4">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="https://www.paypal.com/sdk/js?client-id={{ $data->cleint_id }}&currency={{$data->currency}}"></script>
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: "{{ $data->description }}",
                                custom_id: "{{ $data->custom_id }}",
                                amount: {
                                    currency_code: "{{ $data->currency }}",
                                    value: "{{ $data->amount }}",
                                    breakdown: {
                                        item_total: {
                                            currency_code: "{{ $data->currency }}",
                                            value: "{{ $data->amount }}"
                                        }
                                    }
                                }
                            }
                        ]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        var trx = "{{ $data->custom_id }}";
                        window.location = '{{ url('payment/paypal')}}/' + trx + '/' + details.id
                    });
                }
            }).render('#paypal-button-container');
        </script>
    @endpush
@endsection
