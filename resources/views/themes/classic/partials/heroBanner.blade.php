<!-- HeroBanner section -->
@if(isset($templates['banner-heading'][0]) && $banner_heading = $templates['banner-heading'][0])
    @push('style')
        <style>
            .home-section {
                background: url({{getFile(optional($banner_heading->media)->driver, $banner_heading->templateMedia()->image)}});
            }
        </style>
    @endpush

    <section class="home-section">
        <div class="overlay h-100">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-12">
                        <div class="text-box text-center">
                            <h1>@lang(optional($banner_heading->description)->top_title)</h1>
                            <h5 class="text-white">
                                @lang(optional($banner_heading->description)->main_title)
                            </h5>
                            <div class="search-bar">
                                <form action="{{route('listing')}}" method="get">
                                    <div class="row g-0">
                                        <div class="input-box col-lg-3 col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-prepend">
                                                    <i class="fal fa-search"></i>
                                                 </span>
                                                <input type="text" name="name" {{ old('name', request()->name) }}class="form-control" placeholder="@lang('What are you looking for')?"/>
                                            </div>
                                        </div>

                                        <div class="input-box col-lg-3 col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-prepend">
                                                  <i class="far fa-chart-scatter"></i>
                                                 </span>
                                                <select class="listing__category__select2 form-control" name="category[]" >
                                                    <option value="all"
                                                            @if(request()->category && in_array('all', request()->category))
                                                                selected
                                                        @endif>@lang('All Category')</option>
                                                    @foreach($all_categories as $category)
                                                        <option value="{{ $category->id }}"
                                                                @if(request()->category && in_array($category->id, request()->category))
                                                                    selected
                                                            @endif> @lang(optional($category->details)->name)
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-box col-lg-3 col-md-6">
                                            <div class="input-group">
                                                 <span class="input-group-prepend">
                                                    <i class="fal fa-map-marker-alt"></i>
                                                 </span>
                                                <select class="js-example-basic-single form-control" name="location" autocomplete="off">
                                                    <option value="all" @if(request()->location == 'all') selected @endif>@lang('All Locations')</option>
                                                    @foreach($all_places as $place)
                                                        <option value="{{ $place->id }}" @if(request()->location == $place->id) selected @endif>@lang(optional($place->details)->place)</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="input-box col-lg-3 col-md-6">
                                            <button class="btn-custom w-100 h-100">
                                                <i class="fal fa-search"></i> @lang('search')
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@push('script')
    <script>
        'use strict'
        $(document).ready(function (){
            $(".listing__category__select2").select2({
                width: '100%',
                placeholder: '@lang("Select Categories")',
            });
        })
    </script>
@endpush
