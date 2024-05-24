@extends('admin.layouts.app')
@section('title')
    @lang("Reviews For ") @lang($listing->title)
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
                                <label for="title"> @lang('Filter By User')</label>
                                <select name="user" class="form-control">
                                    <option selected disabled>@lang('Select User')</option>
                                    @foreach($allReviews as $reviewUser)
                                        <option value="{{ optional($reviewUser->review_user_info)->id }}" {{  request()->user == optional($reviewUser->review_user_info)->id ? 'selected' : '' }}>@lang(optional($reviewUser->review_user_info)->fullname)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="title"> @lang('Filter By Ratings')</label>
                                <select name="rating[]" class="form-control" multiple>
                                    <option disabled>@lang('Select Rating')</option>
                                    <option value="5"
                                            @if(isset(request()->rating))
                                                @foreach(request()->rating as $data)
                                                    @if($data == 5) selected @endif
                                                @endforeach
                                            @endif>
                                        @lang('5 Star')
                                    </option>

                                    <option value="4"
                                            @if(isset(request()->rating))
                                                @foreach(request()->rating as $data)
                                                    @if($data == 4) selected @endif
                                        @endforeach
                                        @endif>
                                        @lang('4 Star')
                                    </option>

                                    <option value="3"
                                            @if(isset(request()->rating))
                                                @foreach(request()->rating as $data)
                                                    @if($data == 3) selected @endif
                                        @endforeach
                                        @endif>
                                        @lang('3 Star')
                                    </option>

                                    <option value="2"
                                            @if(isset(request()->rating))
                                                @foreach(request()->rating as $data)
                                                    @if($data == 2) selected @endif
                                        @endforeach
                                        @endif>
                                        @lang('2 Star')
                                    </option>

                                    <option value="1"
                                            @if(isset(request()->rating))
                                                @foreach(request()->rating as $data)
                                                    @if($data == 1) selected @endif
                                        @endforeach
                                        @endif>
                                        @lang('1 Star')
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 col-xl-2 col-sm-12">
                            <div class="form-group">
                                <label for="title"> @lang('From Date')</label>
                                <input type="date" class="form-control from_date" name="from_date" id="datepicker" placeholder="@lang('From date')" value="{{ old('from_date', request()->from_date) }}"/>
                            </div>
                        </div>
                        <div class="col-md-2 col-xl-2 col-sm-12">
                            <div class="form-group">
                                <label for="title"> @lang('To Date')</label>
                                <input type="date" class="form-control to_date" name="to_date" id="datepicker" placeholder="@lang('To date')" value="{{ old('to_date', request()->to_date) }}" disabled="true"/>
                            </div>
                        </div>
                        <div class="col-md-2 col-xl-2 col-sm-12">
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
                        <th>@lang('User')</th>
                        <th>@lang('Rating')</th>
                        <th>@lang('Review')</th>
                        <th>@lang('Date-Time')</th>
                        <th class="text-end">@lang('Action')</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($allReviews as $key => $review)
                        <tr>
                            <td data-label="@lang('No.')">{{loopIndex($allReviews) + $key}}</td>
                            <td data-label="@lang('User')">
                                <div class="float-left">
                                    <a href="{{ route('admin.user-edit', optional($review->review_user_info)->id) }}" target="_blank">
                                        <img src="{{ asset(getFile(optional($review->review_user_info)->driver, optional($review->review_user_info)->image)) }}" alt="{{config('basic.site_title')}}" class="contactImageUser">
                                    </a>
                                </div>
                                <div class="float-left">
                                    @lang(optional($review->review_user_info)->firstname) @lang(optional($review->review_user_info)->lastname) <br>
                                    @lang(optional($review->review_user_info)->email)
                                </div>
                            </td>

                            <td data-label="@lang('Rating')">
                                @php
                                    $j = 0;
                                @endphp
                                @for ($i = $review->rating2; $i > 0; $i--)
                                    <i class="fas fa-star rating__gold"></i>
                                    @php
                                    $j = $j + 1;
                                    @endphp
                                @endfor

                                @for($j; $j < 5; $j++)
                                    <i class="far fa-star rating__gold"></i>
                                @endfor
                            </td>

                            <td data-label="@lang('Review')">
                                @lang(\Illuminate\Support\Str::limit($review->review, 100))
                            </td>
                            <td data-label="@lang('Date-Time')">
                                {{ dateTime($review->created_at) }}
                            </td>

                            <td>
                                <a  href="javascript:void(0)"
                                    data-route="{{ route('admin.listingReviewDelete', $review->id) }}"
                                    data-toggle="modal"
                                    data-target="#delete-modal"
                                    class="btn btn-outline-danger btn-sm btn-icon edit_button notiflix-confirm">
                                    <i class="fa fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-danger" colspan="100%">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$allReviews->appends($_GET)->links('partials.pagination')}}
            </div>
        </div>
    </div>

    @push('adminModal')
        <!-- Delete Modal -->
        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog">
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
                            <p class="font-weight-bold">@lang('Are you sure delete review?') </p>
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

            $('select').select2({
                selectOnClose: true
            });
        });
    </script>

@endpush
