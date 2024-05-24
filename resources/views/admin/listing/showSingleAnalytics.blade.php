@extends('admin.layouts.app')
@section('title')
    @lang("Analytics Details For") (@lang($listing))
@endsection

@section('content')
    <style>
        .fa-ellipsis-v:before {
            content: "\f142";
        }
    </style>

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>@lang('#')</th>
                        <th>@lang('Country')</th>
                        <th>@lang('City')</th>
                        <th>@lang('Visitor Ip')</th>
                        <th>@lang('Browser')</th>
                        <th>@lang('Operating System')</th>
                        <th>@lang('Visited At')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($allSingleListingAnalytics as $key => $analytic)

                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($allSingleListingAnalytics) + $key}}</td>
                            <td data-label="@lang('Country')">
                                {{ ($analytic->country) ? __($analytic->country) : 'N/A' }}
                            </td>

                            <td data-label="@lang('City')">
                                {{ ($analytic->city) ? __($analytic->city) : 'N/A' }}
                            </td>

                            <td data-label="@lang('Visitor Ip')">
                                @lang($analytic->visitor_ip)
                            </td>

                            <td data-label="@lang('Browser')">
                                @lang($analytic->browser)
                            </td>

                            <td data-label="@lang('Operating System')">
                                @lang($analytic->os_platform)
                            </td>

                            <td data-label="@lang('Visited At')">
                                {{ dateTime($analytic->created_at) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="100%">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$allSingleListingAnalytics->appends($_GET)->links('partials.pagination')}}
            </div>
        </div>
    </div>

    @push('adminModal')
        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h5 class="modal-title"><span class="messageShow"></span> @lang('Confirmation')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" class="deleteRoute">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <p class="font-weight-bold">@lang('Are you sure delete message?') </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn waves-effect waves-light btn-dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn waves-effect waves-light btn-primary messageShow"> @lang('Delete')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
@endsection

@push('js')
    <script>
        'use strict'
        $(document).ready(function () {
            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })

            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled')
            });
        });
    </script>
@endpush
