@extends($theme.'layouts.user')
@section('title',trans('Analytics'))
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-datepicker.css') }}"/>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('My Analytics')</h3>
                </div>

                <div class="search-bar my-search-bar">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" name="listing" value="{{ old('listing',request()->listing) }}" class="form-control" placeholder="@lang('Search listing...')"/>
                                </div>
                            </div>

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" class="form-control datepicker from_date" name="from_date" autofocus="off" readonly placeholder="@lang('From date')" value="{{ old('purchase_date',request()->from_date) }}">
                                </div>
                            </div>

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" class="form-control datepicker to_date" name="to_date" autofocus="off" readonly placeholder="@lang('To date')" value="{{ old('expire_date',request()->to_date) }}" disabled="true">
                                </div>
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
                                <th scope="col">@lang('Listing')</th>
                                <th scope="col">@lang('Country')</th>
                                <th scope="col">@lang('Total Visit')</th>
                                <th scope="col">@lang('Last Visited At')</th>
                                <th scope="col" class="text-end">@lang('Action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($allAnalytics as $key => $analytic)
                                <tr>
                                    <td data-label="@lang('Listing')">
                                        <a href="{{ route('listing-details',[slug(optional($analytic->getListing)->title), optional($analytic->getListing)->id]) }}" class="color-change-listing" target="_blank">@lang(\Illuminate\Support\Str::limit(optional($analytic->getListing)->title, 50))</a>
                                    </td>

                                    <td data-label="@lang('Country')">
                                        {{ ($analytic->country) ? __($analytic->country) : __('N/A') }}
                                    </td>

                                    <td data-label="@lang('Total Visit')">{{$analytic->list_count_count}}</td>

                                    <td data-label="@lang('Last Visited At')">
                                        {{ dateTime(optional($analytic->lastVisited)->created_at) }}
                                    </td>

                                    <td class="action" data-label="@lang('Action')">
                                        <div class="d-flex justify-content-end">
                                            <a class="btn2 btn" href="{{ route('user.showListingAnalytics', $analytic->listing_id) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                    @empty
                                        <td colspan="100%" class="text-center">@lang('No Data Found')</td>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $allAnalytics->appends($_GET)->links() }}
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
            $(".datepicker").datepicker({
                autoclose: true,
                clearBtn: true
            });

            $('.from_date').on('change', function () {
                $('.to_date').removeAttr('disabled');
            });
        });
    </script>
@endpush
