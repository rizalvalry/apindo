@extends('admin.layouts.app')
@section('title')
    @lang("Claim List")
@endsection

@section('content')
    <style>
        .fa-ellipsis-v:before {
            content: "\f142";
        }
    </style>

    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="" method="get" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="name"> @lang('Listing')</label>
                                <input type="text" name="name" value="{{ old('name', request()->name) }}" class="form-control"
                                       placeholder="@lang('Search Listing..')">
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="from_date"> @lang('From Date')</label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="@lang('From date')" value="{{ old('from_date', request()->from_date) }}"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label for="to_date"> @lang('To Date')</label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="@lang('To date')" value="{{ old('to_date', request()->to_date) }}" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label></label>
                                <button type="submit" class="btn w-100 w-md-auto btn-primary listing-btn-search-custom mt-2"><i
                                        class="fas fa-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('#')</th>
                        <th scope="col">@lang('Owner')</th>
                        <th scope="col">@lang('Listing')</th>
                        <th scope="col">@lang('Claim')</th>
                        <th scope="col">@lang('Date-Time')</th>
                        @if(adminAccessRoute(config('role.claim_business.access.view')) == true || adminAccessRoute(config('role.claim_business.access.delete')) == true)
                            <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($allClaims as $claim)
                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($allClaims) + $loop->index}}</td>

                            <td data-label="@lang('Owner')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional(optional($claim->get_listing)->get_user)->id) }}" target="_blank">
                                        <img src="{{getFile(optional(optional($claim->get_listing)->get_user)->driver, optional(optional($claim->get_listing)->get_user)->image)}}" alt="{{config('basic.site_title')}}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional(optional($claim->get_listing)->get_user)->firstname) @lang(optional(optional($claim->get_listing)->get_user)->lastname) <br>
                                    @lang(optional(optional($claim->get_listing)->get_user)->email)
                                </div>
                            </td>
                            @php
                                $owner = optional(optional($claim->get_listing)->get_user)->firstname . ' ' . optional(optional($claim->get_listing)->get_user)->lastname;
                            @endphp

                            <td data-label="@lang('Listing')">
                                <a href="{{route('admin.viewListings', [slug(optional($claim->get_listing)->title), $claim->listing_id])}}">
                                    @lang(optional($claim->get_listing)->title)
                                </a>
                            </td>

                            <td data-label="@lang('Claim')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($claim->get_client)->id) }}" target="_blank">
                                        <img src="{{getFile(optional($claim->get_client)->driver, optional($claim->get_client)->image)}}" alt="{{config('basic.site_title')}}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional($claim->get_client)->firstname) @lang(optional($claim->get_client)->lastname) <br>
                                    @lang(optional($claim->get_client)->email)
                                </div>
                            </td>
                            @php
                                $claim_client = optional($claim->get_client)->firstname . ' ' . optional($claim->get_client)->lastname;
                            @endphp

                            <td data-label="@lang('Date-Time')">{{ dateTime($claim->created_at) }}</td>
                            @if(adminAccessRoute(config('role.claim_business.access.view')) == true || adminAccessRoute(config('role.claim_business.access.delete')) == true)
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded btn-icon edit_button notiflix-confirm showClaimMessage"
                                            data-toggle="modal" data-target="#myModal" data-from="{{ $owner }}" data-to="{{ $claim_client }}" data-message="{{ $claim->message }}" data-time="{{ dateTime($claim->created_at) }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <a href="{{ route('admin.viewListings', [slug(optional($claim->get_listing)->title), optional($claim->get_listing)->id])}}" class="btn btn-sm btn-outline-primary rounded btn-icon edit_button">
                                        <i class="fa fa-location-arrow"></i>
                                    </a>

                                    @if(adminAccessRoute(config('role.claim_business.access.delete')) == true)
                                        <button type="button" class="btn btn-outline-danger rounded btn-sm btn-icon edit_button notiflix-confirm"
                                                data-toggle="modal" data-target="#delete-modal"
                                                data-route="{{route('admin.claimMessageDelete',$claim->id)}}">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$allClaims->appends($_GET)->links('partials.pagination')}}
            </div>
        </div>
    </div>

    @push('adminModal')
        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel">@lang('Delete Confirmation')
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you sure to delete this?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal">@lang('Close')</button>
                        <form action="" method="post" class="deleteRoute">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary">@lang('Yes')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel">@lang('Claim Business Information')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item messageFrom"></li>
                                <li class="list-group-item messageTo"></li>
                                <li class="list-group-item contactMessage"></li>
                                <li class="list-group-item contactDateTime"></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')
                            </button>
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
        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })

        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled')
        });
    </script>

    <script>
        "use strict";
        (function ($) {
            $(document).on('click', '.showClaimMessage', function () {
                var showMessageModal = new bootstrap.Modal(document.getElementById('messageModal'))
                showMessageModal.show()

                let from = $(this).data('from');
                let to = $(this).data('to');
                let message = $(this).data('message');
                let dateTime = $(this).data('time');

                $('.messageFrom').text(`@lang('Listing Owner: ') ${from}`);
                $('.messageTo').text(`@lang('Claim: ') ${to}`);
                $('.contactMessage').text(`@lang('Claim Message: ') ${message}`);
                $('.contactDateTime').text(`@lang('Date-Time: ') ${dateTime}`);

            });
        })(jQuery);
    </script>
@endpush
