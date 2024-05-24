<!-- popular listings -->
@if(count($popularListings) > 0)
    <section class="popular-listings">
        <div class="overlay">
            <div class="container">
                @if(isset($templates['popular-listing'][0]) && $popularListing = $templates['popular-listing'][0])

                    <div class="row">
                        <div class="col-12">
                            <div class="header-text text-center mb-5">
                                <h3>@lang(optional($popularListing->description)->title)</h3>
                                <p class="mx-auto">
                                    @lang(optional($popularListing->description)->sub_title)
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row g-4">
                    @forelse($popularListings as $key => $listing)
                        @php
                            $total = $listing->reviews()[0]->total;
                            $average_review = $listing->reviews()[0]->average;
                        @endphp
                        <div class="col-lg-3 col-md-6">
                            <div class="listing-box">
                                <div class="img-box">
                                    <img class="img-fluid" src="{{ getFile($listing->driver, $listing->thumbnail) }}" alt="{{config('basic.site_title')}}"/>
                                    <button class="save wishList" type="button" id="{{$key}}" data-user="{{ optional($listing->get_user)->id }}" data-purchase="{{ $listing->purchase_package_id }}" data-listing="{{ $listing->id }}">
                                        @if($listing->get_favourite_count > 0)
                                            <i class="fas fa-heart save{{$key}}"></i>
                                        @else
                                            <i class="fal fa-heart save{{$key}}"></i>
                                        @endif
                                    </button>
                                </div>
                                <div class="text-box">
                                    <div class="review">
                                        @php
                                            $isCheck = 0;
                                            $j = 0;
                                        @endphp
                                        @if($average_review != intval($average_review))
                                            @php
                                                $isCheck = 1;
                                            @endphp
                                        @endif

                                        @for($i = $average_review; $i > $isCheck; $i--)
                                            <i class="fas fa-star" aria-hidden="true"></i>
                                            @php
                                                $j = $j + 1;
                                            @endphp
                                        @endfor

                                        @if($average_review != intval($average_review))
                                            <i class="fas fa-star-half-alt"></i>
                                            @php
                                                $j = $j + 1;
                                            @endphp
                                        @endif

                                        @if($average_review == 0 || $average_review != null)
                                            @for($j; $j < 5; $j++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        @endif
                                        <span>(@lang($total.' reviews'))</span>
                                    </div>
                                    <a class="title"
                                       href="{{ route('listing-details',[slug($listing->title), $listing->id]) }}">
                                        @lang(Str::limit($listing->title, 20))
                                    </a>
                                    <p class="mb-2 mt-2">
                                        <span class="">@lang('Category'): </span> {{ optional($listing)->getCategoriesName() }}
                                    </p>
                                    <a class="author" href="{{ route('profile', [slug(optional($listing->get_user)->firstname), optional($listing->get_user)->id]) }}"> @lang(optional($listing->get_user)->firstname) @lang(optional($listing->get_user)->lastname) </a>
                                    <p class="address">
                                        <i class="fal fa-map-marker-alt"></i>
                                        @lang($listing->address), @lang(optional(optional($listing->get_place)->details)->place)
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse

                </div>
                <div class="row text-center mt-5">
                    <div class="col">
                        <a href="{{ route('listing').'?popular' }}" class="btn-custom">
                            @lang('View More')
                            <i class="fal fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@push('script')
    <script>
        'use strict'
        var isAuthenticate = '{{\Illuminate\Support\Facades\Auth::check()}}';

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



