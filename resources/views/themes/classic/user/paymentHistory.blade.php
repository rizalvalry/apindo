@extends($theme.'layouts.user')
@section('title',trans('Payment History'))
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-datepicker.css') }}"/>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('Payment History For')
                        (@lang( optional(optional($packageName->getPlanInfo)->details)->title)) </h3>
                </div>

                <!-- search area -->
                <div class="search-bar my-search-bar">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" name="transaction_id" value="{{@request()->transaction_id}}" class="form-control" placeholder="@lang('Search for Transaction ID')">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <button class="search">
                                    </button>
                                    <input type="text" name="remark" value="{{@request()->remark}}" class="form-control" placeholder="@lang('Remark')">
                                </div>
                            </div>

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <input type="text" class="form-control datepicker from_date" name="datetrx" autofocus="off" readonly placeholder="@lang('choose date')" value="{{ old('datetrx',request()->datetrx) }}">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <button class="btn-custom" type="submit">@lang('search')</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- table -->
                <div class="table-parent table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('TRX')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Payment Method')</th>
                            <th>@lang('Payment Status')</th>
                            <th>@lang('Remark')</th>
                            <th>@lang('Date-Time')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($allTransaction as $key => $transaction)
                            <tr>
                                <td data-label="@lang('TRX')">
                                    @lang($transaction->transaction)
                                </td>

                                <td data-label="@lang('Amount')">
                                    {{ config('basic.currency_symbol') }}@lang(number_format($transaction->amount,2))
                                </td>
                                <td data-label="@lang('Payment Method')">
                                    {{ $transaction->gateway == null ? __('N/A') : __(optional($transaction->gateway)->name) }}
                                </td>
                                <td data-label="@lang('Payment Status')">
                                    @if ($transaction->status == 0 || $transaction->status == 2)
                                        <span class="badge rounded-pill bg-danger">@lang('Pending')</span>
                                    @elseif($transaction->status == 1)
                                        <span class="badge rounded-pill bg-info">@lang('Complete')</span>
                                    @else
                                        <span class="badge rounded-pill bg-warning">@lang('Cancel')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Remarks')">
                                    @lang($transaction->remarks)
                                </td>
                                <td data-label="@lang('Date-Time')">
                                    {{ dateTime($transaction->created_at) }}
                                </td>
                                @empty
                                    <td colspan="100%" class="text-center">@lang('No Data Found')</td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $allTransaction->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/bootstrap-datepicker.js') }}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $(".datepicker").datepicker({});

            $('.from_date').on('change', function () {
                $('.to_date').removeAttr('disabled');
            });
        });
    </script>
@endpush
