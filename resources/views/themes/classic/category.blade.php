@extends($theme.'layouts.app')
@section('title',trans('Category'))

@section('banner_heading')
   @lang('Listing Category')
@endsection

@section('content')

<div class="container">
    <div class="header-text text-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
            <li class="breadcrumb-item"><a href="#">@lang('Listing Category')</a></li>
            @yield('breadcrumb_items')
        </ol>
    </nav>
</div>


@if($allListingsAndCategory->count() > 0)
    <section class="category-section">
        <div class="container">
            <div class="row g-3 g-lg-4">
                @forelse($allListingsAndCategory as $category)
                    <div class="col-xl-3 col-md-6 col-6">
                        <a href="{{ route('listing', [slug(optional($category->details)->name), $category->id]) }}">
                            <div class="category-box">
                                <div class="icon-box">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <div>
                                    <h5>@lang(optional($category->details)->name)</h5>
                                    <span>{{ $category->getCategoryCount() }} @lang('Listings')</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="listing-not-found">
                        <h5 class="text-center m-0">@lang("No Data Found")</h5>
                        <p class="text-center not-found-times">
                            <i class="fad fa-file-times not-found-times"></i>
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@else
    <div class="listing-not-found">
        <h5 class="text-center m-0">@lang("No Data Found")</h5>
        <p class="text-center not-found-times">
            <i class="fad fa-file-times not-found-times"></i>
        </p>
    </div>
@endif

@endsection

@push('script')

      <script>
         'use strict'
         $(document).ready(function(){
            $('.character').on('click', function(){
               let character = $(this).attr('data-character');
               let _this = this;
               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('categorySearch') }}",
                    type: "post",
                    data:{
                        character:character,
                    },
                    success: function(data)
                    {
                        $('.owl-item').removeClass('active');
                        $('.character').not(this).removeClass('active');
                        $(_this).addClass('active')
                        if ((data.count)*1 <  1) {
                                $('#renderCategory').html(`<div class="custom-not-found2">
                            <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="{{config('basic.site_title')}}"
                                 class="img-fluid">
                        </div>`);

                        } else {

                           console.log(this);
                           $('#renderCategory').html(data.data);
                           $(this).addClass('active');
                        }

                    }
                });

            });

         });
      </script>
@endpush


