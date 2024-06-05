@extends($theme.'layouts.app')
@section('title', trans('Listing'))

@section('banner_heading')
    @lang('All Listings')
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/frontend_leaflet.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/global/css/frontendControl.FullScreen.css') }}"/>
    <style>
        .jumbotron {
            width: 100%;
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background-color: #e9ecef;
            border-radius: .3rem;
        }
        .jumbotron .img-box {
            display: none;
        }
        .filter-area {
            margin-bottom: 20px;
        }
        .filter-box {
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .filter-box h5 {
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .filter-box .input-group {
            margin-bottom: 15px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .btn-custom:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
@endpush

@section('content')
    <section class="listing-section">
        <div class="container-fluid">
            <div class="row">
                <!-- Search Section -->
                <div class="col-xl-12 my-8 d-flex justify-content-center">
                    <form action="{{ route('listing') }}" method="get" class="filter-area d-flex justify-content-center">
                    <div class="filter-box d-flex justify-content-between align-items-center">
                            <!-- <h5>@lang('Search')</h5> -->
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" value="{{ old('name', request()->name) }}" autocomplete="off" placeholder="@lang('Listing name')"/>
                            </div>
                            <div class="input-group mb-3">
                                <select class="js-example-basic-single form-control" name="location">
                                    <option selected disabled>@lang('Select Location')</option>
                                    <option value="all" @if(request()->location == 'all') selected @endif>@lang('All Location')</option>
                                    @foreach($all_places as $place)
                                        <option class="m-0" value="{{ $place->id }}" @if(request()->location == $place->id) selected @endif>@lang(optional($place->details)->place)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <select class="listing__category__select2 form-control" name="category[]" multiple>
                                    <option value="all" @if(request()->category && in_array('all', request()->category)) selected @endif>@lang('All Category')</option>
                                    @foreach($all_categories as $category)
                                        <option value="{{ $category->id }}" @if(request()->category && in_array($category->id, request()->category)) selected @endif> @lang(optional($category->details)->name)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 p-4 mb-3">
                            <button class="btn btn-primary ml-2" type="submit">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Search Section -->

                <!-- Listing Section -->
                <!-- <div class="col-xl-10 col-lg-10 col-sm-10"> -->
                    @if(count($all_listings) > 0)
                        <div class="row g-4">
                            @forelse($all_listings as $key => $listing)
                                @php
                                    $total = $listing->reviews()[0]->total;
                                    $average_review = $listing->reviews()[0]->average;
                                @endphp
                                <div class="col-12 m-2 d-flex justify-content-sm-center">
                                    <div class="jumbotron d-flex justify-content-center m-4" data-lat="{{ $listing->lat }}" data-long="{{ $listing->long }}" data-title="@lang(Str::limit($listing->title, 30))" data-location="@lang($listing->address)" data-route="{{ route('listing-details', [slug($listing->title), $listing->id]) }}">
                                        <div class="col-sm-2 m-4">
                                            <img class="img-fluid" style="border-radius:5px;" src="{{ getFile($listing->driver, $listing->listing_image) }}" alt="@lang(Str::limit($listing->title, 30))">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="text-box">
                                                <div class="review">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star{{ $i <= $average_review ? '' : ($i - 1 < $average_review ? '-half-alt' : '-empty') }}"></i>
                                                    @endfor
                                                </div>
                                                <a href="{{ route('listing-details', [slug($listing->title), $listing->id]) }}"><h5 class="title">@lang(Str::limit($listing->title, 30))</h5></a>
                                                <!-- <a class="author" href="{{ route('profile', [slug(optional($listing->get_user)->firstname), optional($listing->get_user)->id]) }}">
                                                    @lang(optional($listing->get_user)->firstname) @lang(optional($listing->get_user)->lastname)
                                                </a> -->
                                                
                                                <p class="address mt-1">
                                                    <i class="fal fa-map-marker-alt"></i>
                                                    @lang($listing->address), @lang(optional(optional($listing->get_place)->details)->place)
                                                </p>
                                                <span class="badge bg-secondary">
                                                    <!-- <span class="">@lang('Category'): </span>  -->
                                                    {{ optional($listing)->getCategoriesName() }}
                                                </span>
                                                <!-- <a href="{{ route('listing-details', [slug($listing->title), $listing->id]) }}" class="btn-custom">@lang('View details')</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="custom-not-found">
                                    <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="{{ config('basic.site_title') }}" class="img-fluid">
                                </div>
                            @endforelse

                            <div class="col-lg-12 d-flex justify-content-center mt-5">
                                <nav aria-label="Page navigation example mt-3">
                                    {{ $all_listings->appends($_GET)->links() }}
                                </nav>
                            </div>
                        </div>
                    @else
                        <div class="custom-not-found">
                            <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="{{ config('basic.site_title') }}" class="img-fluid">
                        </div>
                    @endif
                <!-- </div> -->
                <!-- End Listing Section -->

            </div>
        </div>
    </section>
@endsection

@push('script')
    <script src="{{ asset('assets/global/js/frontend_leaflet.js') }}"></script>
    <script src="{{ asset('assets/global/js/frontendControl.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/global/js/frontend_map.js') }}"></script>
    <script>
        'use strict'

        $(".listing__category__select2").select2({
            width: '100%',
            placeholder: '@lang("Select Categories")',
        });

        var isAuthenticate = '{{ Auth::check() }}';

        $(document).ready(function () {
            $('.wishList').on('click', function () {
                var _this = this.id;
                let user_id = $(this).data('user');
                let listing_id = $(this).data('listing');
                let purchase_package_id = $(this).data('purchase');
                if (isAuthenticate == 1) {
                    wishList(user_id, listing_id, purchase_package_id, _this);
                } else {
                    window.location.href = '{{route('login')}}';
                }
            });
        });

        function wishList(user_id = null, listing_id = null, purchase_package_id = null, id = null) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('user.wishList') }}",
                type: "POST",
                data: {
                    user_id: user_id,
                    listing_id: listing_id,
                    purchase_package_id: purchase_package_id
                },
                success: function (data) {
                    if (data.data == 'added') {
                        $(`.save${id}`).removeClass("fal fa-heart");
                        $(`.save${id}`).addClass("fas fa-heart");
                        Notiflix.Notify.Success("Wishlist added");
                    }
                    if (data.data == 'remove') {
                        $(`.save${id}`).removeClass("fas fa-heart");
                        $(`.save${id}`).addClass("fal fa-heart");
                        Notiflix.Notify.Success("Wishlist removed");
                    }
                },
            });
        }
    </script>
@endpush
