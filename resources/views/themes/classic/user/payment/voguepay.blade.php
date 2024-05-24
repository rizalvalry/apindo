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
                <div class="col-md-8 col-xl-8 col-sm-12">
                    <div class="card secbg br-4 custom-card-payment">
                        <div class="card-body br-4">
                            <div class="row  align-items-center">
                                <div class="col-md-3">
                                    <img
                                        src="{{getFile(optional($order->gateway)->driver, optional($order->gateway)->image)}}"
                                        class="card-img-top gateway-img br-4" alt="@lang('..')">
                                </div>
                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$basic->currency}}</h4>
                                    <button type="button"
                                            class="btn btn-primary h-fill"
                                            id="btn-confirm">@lang('Pay with VoguePay')
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

        <script src="//voguepay.com/js/voguepay.js"></script>
        <script>
            let closedFunction = function () {

            }
            let  successFunction = function (transaction_id) {
                let txref = "{{ $data->merchant_ref }}";
                window.location.href = '{{ url('payment/voguepay') }}/' + txref + '/' + transaction_id;
            }
            let  failedFunction = function (transaction_id) {
                window.location.href = '{{ route('failed') }}';
            }

            function pay(item, price) {
                //Initiate voguepay inline payment
                Voguepay.init({
                    v_merchant_id: "{{ $data->v_merchant_id}}",
                    total: price,
                    notify_url: "{{ $data->notify_url }}",
                    cur: "{{$data->cur}}",
                    merchant_ref: "{{ $data->merchant_ref }}",
                    memo: "{{$data->memo}}",
                    recurrent: true,
                    frequency: 10,
                    developer_code: '5cff7398d89d1',
                    store_id: "{{ $data->store_id }}",
                    custom: "{{ $data->custom }}",
                    closed: closedFunction,
                    success: successFunction,
                    failed: failedFunction
                });
            }


            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        </script>
    @endpush

@endsection

