
@extends($theme.'layouts.user')
@section('title',trans('My Transactions'))

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-datepicker.css') }}" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang('All Transactions')</h3>
                </div>

                <!-- search area -->
                <div class="search-bar my-search-bar">
                    <form action="{{route('user.transaction.search')}}" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" name="transaction_id"
                                       value="{{@request()->transaction_id}}"
                                       class="form-control"
                                       placeholder="@lang('Search for Transaction ID')">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <button class="search">
                                    </button>
                                    <input type="text" name="remark" value="{{@request()->remark}}"
                                       class="form-control"
                                       placeholder="@lang('Remark')">
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
                            <th scope="col">@lang('Transaction ID')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Payment Method')</th>
                            <th scope="col">@lang('Remarks')</th>
                            <th scope="col">@lang('Date-Time')</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($transactions as $key => $transaction)
                            <tr>
                                <td data-label="Transaction ID">
                                    @lang($transaction->trx_id)
                                </td>
                                <td data-label="Amount">
                                    <span class="font-weight-bold text-dark">
                                        {{ config('basic.currency_symbol') . getAmount($transaction->amount, config('basic.fraction_number')). ' '}}
                                    </span>
                                </td>

                                <td data-label="Payment Method">
                                    @lang($transaction->remarks)
                                </td>
                                <td data-label="Remarks">
                                    @lang($transaction->type)
                                </td>

                                <td data-label="Date-Time">
                                    {{ dateTime($transaction->created_at) }}
                                </td>

                            </tr>
                        @empty
                            <td class="text-center" colspan="100%"> @lang('No Data Found')</td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $transactions->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('loadModal')
        <div
            class="modal fade"
            id="delete-modal"
            tabindex="-1"
            aria-labelledby="editModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-top modal-md">
                <div class="modal-content">
                    <div class="modal-header modal-primary modal-header-custom">
                        <h4 class="modal-title" id="editModalLabel">@lang('Delete Confirmation')</h4>
                        <button
                            type="button"
                            class="close-btn"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('Are you sure delete?')
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn-custom btn2"
                            data-bs-dismiss="modal"
                        >
                            @lang('No')
                        </button>
                        <form action="" method="post" class="deleteRoute">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-custom btn-custom-listing-modal">@lang('Yes')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

@endsection

@push('script')
    <script src="{{ asset('assets/global/js/bootstrap-datepicker.js') }}"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $( ".datepicker" ).datepicker({
                autoclose: true,
                clearBtn: true
            });

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled');
            });

            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })
        });
    </script>
@endpush

