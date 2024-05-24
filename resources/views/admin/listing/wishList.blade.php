@extends('admin.layouts.app')
@section('title')
    @lang("Wish List")
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
                                <input type="text" name="name" value="{{ old('name',request()->name) }}" class="form-control"
                                       placeholder="@lang('Listing..')">
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-3 col-sm-12">
                            <div class="form-group">
                                <label for="title"> @lang('From Date')</label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="@lang('From date')" value="{{ old('from_date', request()->from_date) }}"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-12">
                            <div class="form-group">
                                <label for="title"> @lang('To Date')</label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="@lang('To date')" value="{{ old('to_date', request()->to_date) }}" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-12">
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
                    <th>@lang('#')</th>
                    <th>@lang('listing')</th>
                    <th>@lang('Category')</th>
                    <th>@lang('Owner')</th>
                    <th>@lang('WishList Added')</th>
                    <th>@lang('Added-At')</th>
                    <th class="text-end">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($wishLists as $key => $wishList)
                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($wishLists) + $key}}</td>

                            <td data-label="@lang('Listing')">
                                <a href="{{ route('listing-details',[slug(optional($wishList->get_listing)->title), optional($wishList->get_listing)->id]) }}" class="color-change-listing" target="_blank">@lang(\Illuminate\Support\Str::limit(optional($wishList->get_listing)->title, 50))</a>
                            </td>

                            <td data-label="Category">
                                {{ optional($wishList->get_listing)->getCategoriesName() }}
                            </td>

                            <td data-label="@lang('Owner')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional(optional($wishList->get_listing)->get_user)->id) }}" target="_blank">
                                        <img src="{{ asset(getFile(optional(optional($wishList->get_listing)->get_user)->driver, optional(optional($wishList->get_listing)->get_user)->image)) }}" alt="" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional(optional($wishList->get_listing)->get_user)->firstname) @lang(optional(optional($wishList->get_listing)->get_user)->lastname) <br>
                                    @lang(optional(optional($wishList->get_listing)->get_user)->email)
                                </div>
                            </td>
                            <td data-label="@lang('WishList Added')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($wishList->get_user)->id) }}" target="_blank">
                                        <img src="{{ asset(getFile(optional($wishList->get_user)->driver, optional($wishList->get_user)->image)) }}" alt="" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional($wishList->get_user)->firstname) @lang(optional($wishList->get_user)->lastname) <br>
                                    @lang(optional($wishList->get_user)->email)
                                </div>
                            </td>
                            <td data-label="@lang('Added-At')">{{ dateTime($wishList->created_at) }}</td>
                            <td data-label="@lang('Action')">
                                <button type="button" class="btn btn-outline-danger btn-sm btn-icon edit_button notiflix-confirm"
                                        data-toggle="modal" data-target="#deleteModal"
                                        data-route="{{route('admin.wishListDelete',$wishList->id)}}">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="9">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$wishLists->appends($_GET)->links('partials.pagination')}}
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
