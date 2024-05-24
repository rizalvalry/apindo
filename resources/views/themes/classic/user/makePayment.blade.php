@extends($theme.'layouts.app')
@section('title')
    @lang('Make payment')
@endsection

@section('banner_heading')
    @lang('Payment option')
@endsection

@section('content')
    <div class="container" id="listing-payment">
        <div class="row mt-5 mb-5">
            <div class="container-fluid">
                <div class="main row g-4">

                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="card method-card-header">
                            <div class="card-body">
                                <h5> @lang('Select Payment Method')</h5>
                                <div class="payment-methods">
                                    @csrf
                                    <div class="row gy-4 gx-3">
                                        <div class="col-12">
                                            <form action="{{route('user.purchase-plan')}}" method="post">
                                                @csrf
                                                <div class="payment-box mb-4">
                                                    <div class="payment-options">
                                                        <div class="row g-2">
                                                            @forelse($gateways as $key => $item)
                                                                <div class="col-4 col-md-3 col-xl-2">
                                                                    <div class="paymentGatewaysOptions">
                                                                        <input type="radio" class="btn-check" name="payment_option" autocomplete="off"/>
                                                                        <div class="invalid-feedback">
                                                                            @error('payment_option') @lang($message) @enderror
                                                                        </div>

                                                                        <input type="hidden" name="gateway" value="">
                                                                        <input type="hidden" name="plan_id" value="{{$plan_id}}">
                                                                        <label class="btn paymentCheck" id="{{$key}}" data-gateway="{{$item->id}}" for="option4" data-payment="{{ $item->id }}" data-package="{{ $plan_id }}">
                                                                            @if($item->id > 999)
                                                                                <img class="img-fluid" src="{{getFile($item->driver, $item->image)}}"/>
                                                                            @else
                                                                                <img class="img-fluid" src="{{getFile($item->driver, $item->image)}}"/>
                                                                            @endif

                                                                            <i class="tag" id="circle{{$key}}"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn-smm btn-custom w-100 disable_pay_now" disabled type="submit">@lang('Pay now')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card method-card-details">

                            <div class="card-body">
                                <h5>
                                    @lang(optional($package->details)->title)</h5>
                                <div class="estimation-box">
                                    <div class="details_list">

                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">@lang('Price')</div>
                                                <span>{{ config('basic.currency_symbol') }} {{ number_format((float)$package->price, 2, '.', '') }} </span>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">@lang('Convention Rate')</div> <span class="conversation_rate">{{ config('basic.currency_symbol') }} @lang('0.00') </span>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">@lang('Percentage Charge')</div> <span class="percentage_charge">@lang('0.00')%</span>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">@lang('Fixed Charge')</div> <span class="fixed_charge">{{ config('basic.currency_symbol') }} @lang('0.00')</span>
                                            </li>
                                            <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">@lang('Total Amount')</div> <span class="total_amount">{{ config('basic.currency_symbol') }} {{ number_format((float)$package->price, 2, '.', '') }}  </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict'
        $(document).ready(function () {
            $('.paymentCheck').on('click', function () {

                $('.disable_pay_now').removeAttr('disabled');
                $('.disable_pay_now').removeClass('disable_pay_now');
                var id = this.id;
                let paymentId = $(this).data('payment');
                let packageId = $(this).data('package');

                $("input[name='gateway']").val($(this).data('gateway'));

                $('.paymentCheck').not(this).removeClass('paymentActive');
                $(`#${id}`).addClass("paymentActive");

                $('.tag').not(this).removeClass('fa fa-check-circle');
                $(`#circle${id}`).addClass("fa fa-check-circle");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('user.makePaymentDetails') }}",
                    data: {
                        paymentId: paymentId,
                        packageId: packageId,
                    },
                    datatType: 'json',
                    type: "POST",
                    success: function (data) {
                        let conventionRate = parseFloat(data.data.paymentGatewayInfo.convention_rate).toFixed(2);
                        let percentageCharge = parseFloat(data.data.paymentGatewayInfo.percentage_charge).toFixed(2);
                        let planPrice = parseFloat(data.data.packageInfo.price).toFixed(2);
                        let fixedCharge = parseFloat(data.data.paymentGatewayInfo.fixed_charge).toFixed(2);
                        let finalPercentageCharge = (planPrice * percentageCharge / 100);
                        let tempTotalAmount = parseFloat(planPrice)  + parseFloat(finalPercentageCharge) + parseFloat(fixedCharge);
                        let totalAmount = parseFloat(tempTotalAmount) * conventionRate;
                        totalAmount = parseFloat(totalAmount).toFixed(2);

                        let symbol = "{{trans($basic->currency_symbol)}}";
                        $('.conversation_rate').text(`${symbol} ${conventionRate}`);
                        $('.percentage_charge').text(`${percentageCharge}%`);
                        $('.fixed_charge').text(`${symbol} ${fixedCharge}`);
                        $('.total_amount').text(`${symbol} ${totalAmount}`);
                    }
                });
            });
        });
    </script>
@endpush
