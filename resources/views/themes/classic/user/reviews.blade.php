@extends($theme.'layouts.user')
@section('title')
    @lang("Reviews")
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-datepicker.css') }}"/>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">@lang('Reviews of ') (@lang($listing->title))</h3>
                </div>
                <div class="search-bar my-search-bar">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <select name="user" id="user" class="form-control js-example-basic-single">
                                    <option selected disabled>@lang('Filter By User')</option>
                                    @foreach($allReviews as $reviewUser)
                                        <option value="{{ optional($reviewUser->review_user_info)->id }}" {{  request()->user == optional($reviewUser->review_user_info)->id ? 'selected' : '' }}>@lang(optional($reviewUser->review_user_info)->fullname)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-box col-lg-3 col-md-3 col-sm-12">
                                <select name="rating[]" class="form-control js-example-basic-single">
                                    <option disabled selected> @lang('Select Rating')</option>
                                    <option value="5" @if(isset(request()->rating)) @foreach(request()->rating as $data) @if($data == 5) selected @endif @endforeach @endif>
                                        @lang('5 Star')
                                    </option>

                                    <option value="4" @if(isset(request()->rating)) @foreach(request()->rating as $data) @if($data == 4) selected @endif @endforeach @endif>
                                        @lang('4 Star')
                                    </option>

                                    <option value="3" @if(isset(request()->rating)) @foreach(request()->rating as $data) @if($data == 3) selected @endif @endforeach @endif>
                                        @lang('3 Star')
                                    </option>

                                    <option value="2" @if(isset(request()->rating)) @foreach(request()->rating as $data) @if($data == 2) selected @endif @endforeach @endif>
                                        @lang('2 Star')
                                    </option>

                                    <option value="1" @if(isset(request()->rating)) @foreach(request()->rating as $data) @if($data == 1) selected @endif @endforeach @endif>
                                        @lang('1 Star')
                                    </option>
                                </select>
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" class="form-control datepicker from_date" name="from_date" autofocus="off" readonly placeholder="@lang('From date')" value="{{ old('purchase_date',request()->from_date) }}">
                                </div>
                            </div>

                            <div class="input-box col-lg-2 col-md-2 col-sm-12">
                                <div class="input-box input-group">
                                    <input type="text" class="form-control datepicker to_date" name="to_date" autofocus="off" readonly placeholder="@lang('To date')" value="{{ old('expire_date',request()->to_date) }}" disabled="true">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12">
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
                            <th>@lang('#')</th>
                            <th>@lang('User')</th>
                            <th>@lang('Rating')</th>
                            <th>@lang('Review')</th>
                            <th>@lang('Date-Time')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($allReviews as $key => $review)
                            <tr>
                                <td>{{++$key}}</td>
                                <td class="company-logo" data-label="@lang('User')">
                                    <div>
                                        <a href="{{ route('profile', [slug(optional($review->review_user_info)->firstname), optional($review->review_user_info)->id]) }}"
                                           target="_blank">
                                            <img src="{{ getFile(optional($review->review_user_info)->driver, optional($review->review_user_info)->image) }}">
                                        </a>
                                    </div>
                                    <div>
                                        @lang(optional($review->review_user_info)->fullname) <br>
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
                                    @lang(Str::limit($review->review, 100))
                                </td>

                                <td data-label="@lang('Date-Time')">
                                    {{ dateTime($review->created_at) }}
                                </td>
                                @empty
                                    <td colspan="100%" class="text-center">@lang('No Data Found')</td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $allReviews->appends($_GET)->links() }}
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

