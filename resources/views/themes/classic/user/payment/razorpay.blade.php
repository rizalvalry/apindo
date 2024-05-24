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
                                        class="card-img-top gateway-img" alt="{{config('basic.site_title')}}">
                                </div>
                                <div class="col-md-9">
                                    <h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$basic->currency}}</h4>
                                    <form action="{{$data->url}}" method="{{$data->method}}">
                                        <script src="{{$data->checkout_js}}"
                                                @foreach($data->val as $key=>$value)
                                                data-{{$key}}="{{$value}}"
                                            @endforeach >
                                        </script>
                                        <input type="hidden" custom="{{$data->custom}}" name="hidden">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(document).ready(function () {
                $('input[type="submit"]').addClass(" btn-custom2 btn btn-primary");
            })
        </script>
    @endpush
@endsection




