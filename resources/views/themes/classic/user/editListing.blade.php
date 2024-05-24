@extends($theme.'layouts.user')
@section('title',trans('Edit Listing'))

@push('css-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/tagsinput.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/global/css/image-uploader.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrapicons-iconpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="switcher navigator">
            <button tab-id="tab1" class="tab active">
                @lang('Basic Info')
                @if ($errors->has('title') || $errors->has('category_id') || $errors->has('description') || $errors->has('place_id') || $errors->has('lat') || $errors->has('long'))
                    @php
                        $tabOne = ['title', 'category_id', 'email', 'phone', 'description', 'place_id', 'lat', 'long'];
                    @endphp
                    <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                          data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                        <div class='text-start px-3 text-white'>
                           <ul class=''>
                              @foreach ($errors->getMessages() as $key => $error)
                                @if(in_array($key, $tabOne))
                                    <li class='text-white'>{{ $error[0] }}</li>
                                @endif
                              @endforeach
                           </ul>
                        </div>">
                        <i class="fal fa-info-circle"></i>
                    </span>
                @endif
            </button>

            @if($single_package_infos->is_video == 1)
                <button tab-id="tab2" class="tab">
                    @lang('Video')
                    @if ($errors->has('youtube_video_id'))
                        @php
                            $tabTwo = ['youtube_video_id'];
                        @endphp

                        <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                              data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                            <div class='text-start px-3 text-white'>
                               <ul class=''>
                                  @foreach ($errors->getMessages() as $key => $error)
                                    @if(in_array($key, $tabTwo))
                                        <li class='text-white'>{{ $error[0] }}</li>
                                    @endif
                                  @endforeach
                               </ul>
                            </div>">
                            <i class="fal fa-info-circle"></i>
                        </span>
                    @endif
                </button>
            @endif

            <button tab-id="tab3" class="tab">
                @lang('Photos')
                @if ($errors->has('thumbnail'))
                    @php
                        $tabThree = ['thumbnail'];
                    @endphp
                    <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                          data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                        <div class='text-start px-3 text-white'>
                           <ul class=''>
                              @foreach ($errors->getMessages() as $key => $error)
                                @if(in_array($key, $tabThree))
                                    <li class='text-white'>{{ $error[0] }}</li>
                                @endif
                              @endforeach
                           </ul>
                        </div>">
                        <i class="fal fa-info-circle"></i>
                    </span>
                @endif
            </button>

            @if($single_package_infos->is_amenities == 1)
                <button tab-id="tab4" class="tab">
                    @lang('Amenities')
                    @if ($errors->has('amenity_id.*'))
                        @php
                            $tabFour = ['amenity_id'];
                        @endphp
                        <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                              data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                            <div class='text-start px-3 text-white'>
                               <ul class=''>
                                  @foreach ($errors->getMessages() as $key => $error)
                                    @if(in_array($key, $tabFour))
                                        <li class='text-white'>{{ $error[0] }}</li>
                                    @endif
                                  @endforeach
                               </ul>
                            </div>">
                            <i class="fal fa-info-circle"></i>
                        </span>
                    @endif
                </button>
            @endif

            @if($single_package_infos->is_product == 1)
                <button tab-id="tab5" class="tab">
                    @lang('Products')
                    @if ($errors->has('product_title.*') || $errors->has('product_price.*') || $errors->has('product_description.*') || $errors->has('product_thumbnail.*'))
                        @php
                            $tabFive = ['product_title', 'product_price', 'product_description', 'product_thumbnail'];
                        @endphp
                        <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                              data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                            <div class='text-start px-3 text-white'>
                               <ul class=''>
                                  @foreach ($errors->getMessages() as $key => $error)

                                    @if(in_array($key, $tabFive))
                                    @dd($error)
                                        <li class='text-white'>{{ $error[0] }}</li>
                                    @endif
                                  @endforeach
                               </ul>
                            </div>">
                            <i class="fal fa-info-circle"></i>
                        </span>
                    @endif
                </button>
            @endif

            @if($single_package_infos->seo == 1)
                <button tab-id="tab6" class="tab">
                    @lang('SEO')
                    @if ($errors->has('seo_image') || $errors->has('meta_title') || $errors->has('meta_keywords') || $errors->has('meta_description'))
                        @php
                            $tabSix = ['seo_image', 'meta_title', 'meta_keywords', 'meta_description'];
                        @endphp
                        <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                              data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                            <div class='text-start px-3 text-white'>
                               <ul class=''>
                                  @foreach ($errors->getMessages() as $key => $error)
                                    @if(in_array($key, $tabSix))
                                        <li class='text-white'>{{ $error[0] }}</li>
                                    @endif
                                  @endforeach
                               </ul>
                            </div>">
                            <i class="fal fa-info-circle"></i>
                        </span>
                    @endif
                </button>
            @endif

            @if($single_package_infos->is_whatsapp == 1 || $single_package_infos->is_messenger == 1)
                <button tab-id="tab7" class="tab">
                    @lang('Communication')
                    @if ($errors->has('whatsapp_number') || $errors->has('fb_app_id') || $errors->has('fb_page_id'))
                        @php
                            $tabSeven = ['whatsapp_number', 'fb_app_id', 'fb_page_id'];
                        @endphp

                        <span class="text-danger" type="button" data-bs-custom-class="custom-tooltip"
                              data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                            <div class='text-start px-3 text-white'>
                               <ul class=''>
                                  @foreach ($errors->getMessages() as $key => $error)
                                    @if(in_array($key, $tabSeven))
                                        <li class='text-white'>{{ $error[0] }}</li>
                                    @endif
                                  @endforeach
                               </ul>
                            </div>">
                            <i class="fal fa-info-circle"></i>
                        </span>
                    @endif
                </button>
            @endif
        </div>

        <form action="{{ route('user.listingUpdate', $id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="media mt-0 mb-2 d-flex justify-content-end">
                <a href="{{route('user.allListing')}}" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>
            <div id="tab1" class="add-listing-form content active">
                <div class="main row gy-4">
                    <div class="col-xl-12">
                        <h3 class="mb-3">@lang('Basic Info')</h3>
                        <div class="form">
                            <div class="basic-form">
                                <div class="row g-3">
                                    <div class="input-box col-md-6">
                                        <input class="form-control @error('title') is-invalid @enderror"
                                               placeholder="@lang('title')" type="text" name="title"
                                               value="{{ old('title', $single_listing_infos->title) }}"/>
                                        <div class="invalid-feedback">
                                            @error('title') @lang($message) @enderror
                                        </div>
                                    </div>
                                    @php
                                        $categoryIds = $single_listing_infos->getCategories();
                                    @endphp

                                    <div class="input-box col-md-6">
                                        <select
                                            class="listing__category__select2 form-control @error('category_id') is-invalid @enderror"
                                            name="category_id[]" multiple
                                            data-categories="{{ $single_package_infos->no_of_categories_per_listing }}">
                                            @foreach ($all_listings_category as $item)
                                                <option value="{{ $item->id }}"
                                                        @foreach($categoryIds as $category_id) @if($category_id->id == $item->id) selected @endif @endforeach>
                                                    @lang(optional($item->details)->name)
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('category_id') @lang($message) @enderror
                                        </div>
                                    </div>

                                    <div class="input-box col-md-6">
                                        <input class="form-control @error('email') is-invalid @enderror"
                                               placeholder="@lang('email')" type="email" name="email"
                                               value="{{ old('email', $single_listing_infos->email) }}"/>
                                        <div class="invalid-feedback">
                                            @error('email') @lang($message) @enderror
                                        </div>
                                    </div>
                                    <div class="input-box col-md-6">
                                        <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                               placeholder="@lang('phone')" name="phone"
                                               value="{{ old('phone',  $single_listing_infos->phone ) }}"/>
                                        <div class="invalid-feedback">
                                            @error('phone') @lang($message) @enderror
                                        </div>
                                    </div>

                                    <div class="input-box col-12 bg-white p-0">
                                        <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description" id="summernote" rows="15" value="{{ old('description', $single_listing_infos->description ) }}" placeholder="@lang('Description')">{{ old('description', $single_listing_infos->description ) }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('description') @lang($message) @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <h3 class="mb-3">@lang('Location')</h3>
                        <div class="map-box">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form">
                                        <div class="row g-3 location-form">
                                            <div class="input-box col-md-6">
                                                <select
                                                    class="js-example-basic-single place_id form-control @error('place_id') is-invalid @enderror"
                                                    id="place_id" name="place_id">
                                                    <option selected disabled>@lang('Select Place')</option>
                                                    @foreach ($all_places as $item)
                                                        <option value="{{ $item->id }}"
                                                                {{ old('place_id', $item->id) == $single_listing_infos->place_id ? 'selected' : '' }} data-name="{{ optional($item->details)->place }}"
                                                                data-lat="{{ $item->lat }}"
                                                                data-long="{{ $item->long }}">
                                                            {{ optional($item->details)->place }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    @error('place_id') @lang($message) @enderror
                                                </div>
                                            </div>
                                            <div class="input-box col-md-6">
                                                <input id="address-search"
                                                       class="form-control @error('address') is-invalid @enderror"
                                                       name="address"
                                                       value="{{ old('address', $single_listing_infos->address) }}"
                                                       type="text" autocomplete="off"/>
                                                <div class="invalid-feedback">
                                                    @error('address') @lang($message) @enderror
                                                </div>
                                            </div>
                                            <div class="input-box col-md-6">
                                                <input class="form-control @error('lat') is-invalid @enderror" id="lat"
                                                       name="lat" value="{{ old('lat', $single_listing_infos->lat) }}"/>
                                                <div class="invalid-feedback">
                                                    @error('lat') @lang($message) @enderror
                                                </div>
                                            </div>
                                            <div class="input-box col-md-6">
                                                <input class="form-control @error('long') is-invalid @enderror" id="lng"
                                                       name="long"
                                                       value="{{ old('long', $single_listing_infos->long) }}"
                                                       type="text"/>
                                                <div class="invalid-feedback">
                                                    @error('long') @lang($message) @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div id="map">
                                        <p>@lang('You can also set location moving marker')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($single_package_infos->is_business_hour == 1)
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <h3 class="mb-3">@lang('Business Hours')</h3>
                            <div class="form business-hour">
                                @php
                                    $oldWorkingDaysCount = max(old('working_day', $business_hours) ? count(old('working_day', $business_hours)) : 1, 1);
                                @endphp
                                @if($oldWorkingDaysCount > 0)
                                    @for($i = 0; $i < $oldWorkingDaysCount; $i++)
                                        <div
                                            class="d-sm-flex justify-content-between delete_this removeBusinessHourInputField @error("working_day.$i") is-invalid @enderror">
                                            <div class="input-box w-100 my-1 mx-sm-1">
                                                <select class="js-example-basic-single form-control"
                                                        name="working_day[]">
                                                    <option
                                                        value="Monday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Monday' ? 'selected' : '' }}>@lang('Monday')</option>
                                                    <option
                                                        value="Tuesday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Tuesday' ? 'selected' : '' }}>@lang('Tuesday')</option>
                                                    <option
                                                        value="Wednesday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Wednesday' ? 'selected' : '' }}>@lang('Wednesday')</option>
                                                    <option
                                                        value="Thursday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Thursday' ? 'selected' : '' }}>@lang('Thursday')</option>
                                                    <option
                                                        value="Friday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Friday' ? 'selected' : '' }}>@lang('Friday')</option>
                                                    <option
                                                        value="Saturday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Saturday' ? 'selected' : '' }}>@lang('Saturday')</option>
                                                    <option
                                                        value="Sunday" {{ old("working_day.$i", $business_hours[$i]->working_day ?? '') == 'Sunday' ? 'selected' : '' }}>@lang('Sunday')</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    @error("working_day.$i") @lang($message) @enderror
                                                </div>
                                            </div>

                                            <div class="d-flex">
                                                <div class="input-box w-100 my-1 me-1">
                                                    <input type="time" name="start_time[]"
                                                           value="{{ old("start_time.$i", $business_hours[$i]->start_time ?? '') }}"
                                                           class="form-control @error("start_time.$i") is-invalid @enderror"
                                                           placeholder="@lang('Start Hour')"/>
                                                    <div class="invalid-feedback">
                                                        @error("start_time.$i") @lang($message) @enderror
                                                    </div>
                                                </div>
                                                <div class="input-box w-100 my-1 me-1">
                                                    <input type="time" name="end_time[]"
                                                           value="{{ old("end_time.$i", $business_hours[$i]->end_time ?? '') }}"
                                                           class="form-control @error("end_time.$i") is-invalid @enderror"
                                                           placeholder="@lang('End Hour')"/>
                                                    <div class="invalid-feedback">
                                                        @error("end_time.$i") @lang($message) @enderror
                                                    </div>
                                                </div>
                                                <div class="input-box my-1 me-1">
                                                    @if($i == 0)
                                                        <button class="btn-custom add-new" type="button"
                                                                id="add_business_hour">
                                                            <i class="fal fa-plus"></i>
                                                        </button>
                                                    @else
                                                        <button
                                                            class="btn-custom add-new btn-custom-danger remove_business_hour_input_field_block"
                                                            type="button">
                                                            <i class="fa fa-times"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                                <div class="new_business_hour_form">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <h3 class="mb-3">@lang('Websites And Social Links')</h3>
                        <div class="form website_social_links">
                            @php
                                $oldSocialCounts = max(old('social_icon', $social_links) ? count(old('social_icon', $social_links)) : 1, 1);
                            @endphp

                            @if($oldSocialCounts > 0)
                                @for($i = 0; $i < $oldSocialCounts; $i++)
                                    <div
                                        class="d-flex justify-content-between append_new_social_form removeSocialLinksInput">
                                        <div class="input-group mt-1">
                                            <input type="text" name="social_icon[]"
                                                   value="{{ old("social_icon.$i", $social_links[$i]->social_icon ?? '') }}"
                                                   class="form-control demo__icon__picker iconpicker1 @error("social_icon.$i") is-invalid @enderror"
                                                   placeholder="Pick a icon" aria-label="Pick a icon"
                                                   aria-describedby="basic-addon1" readonly>

                                            <div class="invalid-feedback">
                                                @error("social_icon.$i") @lang($message) @enderror
                                            </div>
                                        </div>

                                        <div class="input-box w-100 my-1 me-1">
                                            <input type="url" name="social_url[]"
                                                   value="{{ old("social_url.$i", $social_links[$i]->social_url ?? '') }}"
                                                   class="form-control @error("social_url.$i") is-invalid @enderror"
                                                   placeholder="@lang('URL')"/>
                                            @error("social_url.$i")
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="my-1 me-1">
                                            @if($i == 0)
                                                <button class="btn-custom add-new" type="button" id="add_social_links">
                                                    <i class="fal fa-plus"></i>
                                                </button>
                                            @else
                                                <button
                                                    class="btn-custom add-new btn-custom-danger remove_social_link_input_field"
                                                    type="button">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="new_social_links_form append_new_social_form">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($single_package_infos->is_video == 1)
                <div id="tab2" class="add-listing-form content">
                    <div class="main row gy-4">
                        <div class="col-xl-6">
                            <h3 class="mb-3">
                                @lang('Video') <span class="optional">(@lang('Youtube Video Id'))</span>
                            </h3>
                            <div class="form">
                                <div class="row g-3">
                                    <div class="input-box col-md-12">
                                        <input class="form-control" type="text"
                                               value="{{ old('youtube_video_id', $single_listing_infos->youtube_video_id) }}"
                                               name="youtube_video_id"/>
                                        @error('youtube_video_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="youtube nk-plain-video">
                                            <span class="nk-video-plain-toggle">
                                               <span class="nk-video-icon">
                                                  <svg class="svg-inline--fa fa-play fa-w-14 pl-5" aria-hidden="true"
                                                       data-prefix="fa" data-icon="play" role="img"
                                                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                       data-fa-i2svg>
                                                     <path fill="#184af9"
                                                           d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/>
                                                  </svg>
                                               </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div id="tab3" class="add-listing-form content">
                <div class="main row gy-4">
                    <div class="col-xl-5">
                        <h3 class="mb-3">@lang('Thumbnail')</h3>
                        <div class="upload-img thumbnail">
                            <div class="form">
                                <div class="img-box">
                                    <input accept="image/*" type="file" onchange="previewImage('frame')"
                                           name="thumbnail"/>
                                    <span class="select-file">@lang('Select Image')</span>
                                    <img id="frame"
                                         src="{{ getFile($single_listing_infos->driver, $single_listing_infos->thumbnail) }}"
                                         class="img-fluid"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($single_package_infos->is_image == 1)
                        <div class="col-xl-7 custom-margin">
                            <h3 class="mb-3">@lang('Images')</h3>
                            <div class="listing-image no_of_listing_image"
                                 data-listingimage="{{ $single_package_infos->is_image == 1 && $single_package_infos->no_of_img_per_listing == null  ? 'unlimited' : $single_package_infos->no_of_img_per_listing }}"></div>
                            <span class="text-danger"> @error('listing_image.*') @lang($message) @enderror</span>
                        </div>
                    @endif
                </div>
            </div>

            @if($single_package_infos->is_amenities == 1)
                <div id="tab4" class="add-listing-form content">
                    <div class="main row gy-4">
                        <div class="col-xl-6">
                            <h3 class="mb-3">@lang('Amenities')</h3>
                            <div class="form">
                                <div class="row g-3">
                                    <div class="input-box col-md-12">
                                        <select class="amenities_select2 form-control" name="amenity_id[]" multiple
                                                data-amenities="{{ $single_package_infos->no_of_amenities_per_listing }}">
                                            @foreach ($all_amenities as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ in_array($item->id, $listing_aminities) ? 'selected' : '' }}>{{ $item->details->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            @if($single_package_infos->is_product == 1)
                <div id="tab5" class="add-listing-form content">
                    <div class="main row gy-4 new_product_form">
                        <div class="d-flex justify-content-start">
                            <h3 class="me-3">@lang('Product')</h3>
                            <button class="btn-custom-product add-new-product" type="button" id="add_products"
                                    data-products="{{ $single_package_infos->no_of_product == null ? 'unlimited' : $single_package_infos->no_of_product - 1 }}">
                                <i class="fal fa-plus"></i> @lang('Add More') (<span
                                    class="product_count">@if($single_package_infos->no_of_product == null)
                                        @lang('unlimited')
                                    @else
                                        {{ $single_package_infos->no_of_product - 1 }}
                                    @endif</span>)
                            </button>
                        </div>

                        @php
                            $productCounts = max(old('product_title', $listing_products) ? count(old('product_title', $listing_products)) : 1, 1);
                        @endphp

                        @if($productCounts > 0)
                            @for($i = 0; $i < $productCounts; $i++)
                                @php($productKey = $i + 1)
                                <div class="col-xl-6 removeProductForm">
                                    <div class="form new__product__form">
                                        @if($i > 0)
                                            <span class="product-form-close delete_desc"> <i
                                                    class="fa fa-times"></i> </span>
                                        @endif
                                        <div class="row g-3">
                                            <input type="hidden" name="product_id[]"
                                                   value="{{ old("product_id.$i", $listing_products[$i]->id ?? '') }}">
                                            <div class="input-box col-md-6">
                                                <input class="form-control" type="text" name="product_title[]"
                                                       value="{{ old("product_title.$i", $listing_products[$i]->product_title ?? '') }}"
                                                       placeholder="@lang('Title')"/>
                                            </div>
                                            <div class="input-box col-md-6">
                                                <input class="form-control" type="text" name="product_price[]"
                                                       value="{{ old("product_price.$i", $listing_products[$i]->product_price ?? '') }}"
                                                       placeholder="@lang('Price')"/>
                                            </div>


                                            <div class="input-box col-12">
                                                <textarea class="form-control" cols="30" rows="3" name="product_description[]" placeholder="@lang('Description')">{{ old("product_description.$i", $listing_products[$i]->product_description ?? '') }}</textarea>
                                            </div>


                                            <div class="pe-2">
                                                <div class="input-box col-12 no-of-img-per-product">
                                                    <div class="product-image no_of_product_image"
                                                         id="product-image{{ $productKey }}"
                                                         data-productid="{{ $listing_products[$i]->id ?? '' }}"
                                                         data-productimage="{{ $single_package_infos->is_product == 1 && $single_package_infos->no_of_img_per_product == null  ? 'unlimited' : $single_package_infos->no_of_img_per_product }}"
                                                         data-singleproductimage="{{ $listing_products[$i]->get_product_image->map(function ($image){
                                                $image->src = getFile($image->driver, $image->product_image);
                                                return $image;
                                            }) ?? '' }}"></div>
                                                    <span
                                                        class="text-danger"> @error("product_image.$productKey.*") @lang($message) @enderror </span>
                                                </div>
                                            </div>

                                            <div class="upload-img thumbnail">
                                                <div class="form">
                                                    <div class="img-box product-thumbnail">
                                                        <input accept="image/*" type="file"
                                                               onchange="previewImage('product_thumbnail')"
                                                               name="product_thumbnail[{{ $i }}]"/>
                                                        <span class="select-file">@lang('Product Thumbnail')</span>
                                                        <img id="product_thumbnail"
                                                             src="{{ getFile($listing_products[$i]->driver, @$listing_products[$i]->product_thumbnail ?? '') }}"
                                                             class="img-fluid"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            @endif

            @if($single_package_infos->seo == 1)
                <div id="tab6" class="add-listing-form content">
                    <div class="main row gy-4">
                        <div class="col-xl-4">
                            <div class="upload-img thumbnail">
                                <div class="form">
                                    <div class="img-box">
                                        <input accept="image/*" type="file" onchange="previewImage('meta_image')"
                                               name="seo_image"/>
                                        <span class="select-file">@lang('Select Image')</span>
                                        <img id="meta_image"
                                             src="{{ getFile(@$listing_seo->driver, @$listing_seo->seo_image ?? '') }}"
                                             class="img-fluid"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <h3 class="mb-3">@lang('SEO & META Keywords')</h3>
                            <div class="form">
                                <div class="row g-3">
                                    <div class="input-box col-md-12">
                                        <input class="form-control" type="text" name="meta_title"
                                               value="{{ old('meta_title', @$listing_seo->meta_title) }}"/>
                                    </div>

                                    <div class="input-box col-md-12">
                                        <input class="form-control mb-1 tags_input" type="text" name="meta_keywords"
                                               value="{{ old('meta_keywords', @$listing_seo->meta_keywords) }}"
                                               data-role="tagsinput"/>
                                    </div>

                                    <div class="input-box col-12">
                                        <textarea class="form-control" cols="30" rows="3"
                                                  name="meta_description">{{ old('meta_description', @$listing_seo->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($single_package_infos->is_whatsapp == 1 || $single_package_infos->is_messenger == 1)
                <div id="tab7" class="add-listing-form content">
                    @if($single_package_infos->is_messenger == 1)
                        <div class="main row gy-4">
                            <div class="col-xl-6">
                                <h3 class="mb-3">@lang('FB Messenger Control')</h3>
                                <div class="form">
                                    <div class="basic-form p-4">
                                        <div class="row g-3">
                                            <div class="input-box col-md-6">
                                                <input
                                                    class="form-control @error('fb_app_id') is-invalid @enderror"
                                                    type="text" name="fb_app_id"
                                                    value="{{ old('fb_app_id',  $single_listing_infos->fb_app_id ) }}"
                                                    placeholder="@lang('App Id')"/>
                                                <div class="invalid-feedback">
                                                    @error('fb_app_id') @lang($message) @enderror
                                                </div>
                                            </div>

                                            <div class="input-box col-md-6">
                                                <input
                                                    class="form-control @error('fb_page_id') is-invalid @enderror"
                                                    type="text" name="fb_page_id"
                                                    value="{{ old('fb_page_id',  $single_listing_infos->fb_page_id ) }}"
                                                    placeholder="@lang('Page Id')"/>
                                                <div class="invalid-feedback">
                                                    @error('fb_page_id') @lang($message) @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="opacity-0">@lang('test')</h3>
                                <div class="card card-primary shadow">
                                    <div
                                        class="card-header bg-primary text-white py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="m-0 font-weight-bold text-white">@lang('Instructions')</h5>

                                    </div>

                                    <div class="card-body">
                                        <strong class="text-dark">@lang("Step 1") : </strong> @lang("Get Your Facebook Page ID following this article.")
                                        <a href="https://www.facebook.com/help/1503421039731588" target="_blank">@lang("click here")</a>
                                        <br>
                                        <br>

                                        <strong class="text-dark">@lang("Step 2") : </strong> @lang("Get Your Facebook APP ID following this article.")
                                        <a href="https://www.wikihow.com/Get-an-App-ID-on-Facebook" target="_blank">@lang("click here")</a>
                                        <br>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($single_package_infos->is_whatsapp == 1)
                        <div class="main row gy-4">
                            <div class="col-xl-12">
                                <h3 class="mb-3">@lang('Whatsapp Chat Control')</h3>
                                <div class="form">
                                    <div class="basic-form p-4">
                                        <div class="row g-3">
                                            <div class="input-box col-md-6">
                                                <input
                                                    class="form-control @error('whatsapp_number') is-invalid @enderror"
                                                    type="text" name="whatsapp_number"
                                                    value="{{ old('whatsapp_number',  $single_listing_infos->whatsapp_number ) }}"
                                                    placeholder="@lang('whatsapp number')"/>
                                                <div class="invalid-feedback">
                                                    @error('whatsapp_number') @lang($message) @enderror
                                                </div>
                                            </div>

                                            <div class="input-box col-md-6">
                                                <input
                                                    class="form-control @error('replies_text') is-invalid @enderror"
                                                    type="text" name="replies_text"
                                                    value="{{ old('replies_text', $single_listing_infos->replies_text ) }}"
                                                    placeholder="@lang('Typically replies within a day')"/>
                                                <div class="invalid-feedback">
                                                    @error('replies_text') @lang($message) @enderror
                                                </div>
                                            </div>

                                            <div class="input-box col-md-12 bg-white p-0">
                                                <textarea
                                                    class="form-control summernote @error('body_text') is-invalid @enderror"
                                                    name="body_text" id="summernote" rows="15"
                                                    value="{{ old('body_text', $single_listing_infos->body_text ) }}">{{ old('body_text', $single_listing_infos->body_text) }}</textarea>

                                                <div class="invalid-feedback">
                                                    @error('body_text') @lang($message) @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <div class="col-12 mb-3 justify-content-strat d-flex mt-4 mb-4">
                <button type="submit" class="btn-custom">
                    <i class="fal fa-check-circle" aria-hidden="true"></i>@lang('Submit changes')
                </button>
            </div>
        </form>
    </div>

@endsection


@push('extra-js')
    <script src="{{ asset('assets/admin/js/summernote.min.js')}}"></script>
@endpush

@push('script')
    <script src="{{ asset('assets/global/js/map.js') }}"></script>
    <script src="{{ asset('assets/global/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/global/js/image-uploader.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrapicon-iconpicker.js') }}"></script>

    <script>
        'use strict'

        $('.summernote').summernote({
            height: 100,
            callbacks: {
                onBlurCodeview: function() {
                    let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                    $(this).val(codeviewHtml);
                }
            },
            placeholder: 'Enter your details here...',
        });

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        $(document).ready(function () {
            let maximum_no_of_image_per_listing = $('.no_of_listing_image').data('listingimage');
            var listing_images = {!! json_encode($listing_images->toArray()) !!};
            let preloaded = [];
            listing_images.forEach(function (value, index) {
                console.log(value);
                preloaded.push({
                    id: value.id,
                    product_id: value.product_id,
                    image_name: value.listing_image,
                    src: value.src
                });
            });

            let listingImageOptions = {
                preloaded: preloaded,
                imagesInputName: 'listing_image',
                preloadedInputName: 'old_listing_image',
                label: 'Drag & Drop files here or click to browse images',
                extensions: ['.jpg', '.jpeg', '.png'],
                mimes: ['image/jpeg', 'image/png'],
                maxSize: 5242880
            };

            if (maximum_no_of_image_per_listing != 'unlimited') {
                listingImageOptions.maxFiles = maximum_no_of_image_per_listing;
            }
            $('.listing-image').imageUploader(listingImageOptions);


            let maximum_no_of_image_per_product = $('.no_of_product_image').data('productimage');
            let totlaProductImage = $('.product-image').length;
            for (let i = 1; i <= totlaProductImage; i++) {
                let productPreloaded = [];
                let productId = $(`#product-image${i}`).data('productid');
                if ($(`#product-image${i}`).data('singleproductimage').length) {
                    let data = $(`#product-image${i}`).data('singleproductimage').forEach(function (value, index) {
                        productPreloaded.push({
                            id: value.id,
                            image_name: value.product_image,
                            src: value.src
                        });
                    });
                }

                let productImageOptions = {
                    preloaded: productPreloaded,
                    imagesInputName: `product_image[${i}]`,
                    preloadedInputName: `old_product_image[${productId}]`,
                    label: 'Drag & Drop files here or click to browse images',
                    extensions: ['.jpg', '.jpeg', '.png'],
                    mimes: ['image/jpeg', 'image/png'],
                    maxSize: 5242880
                };
                if (maximum_no_of_image_per_product != 'unlimited') {
                    productImageOptions.maxFiles = maximum_no_of_image_per_product;
                }
                $(`#product-image${i}`).imageUploader(productImageOptions);
            }

            $("#add_products").on('click', function () {
                let productLenght = $('.new__product__form').length + 1;
                var string = Math.random().toString(10).substring(2, 12);
                let dataProducts = $('#add_products').data('products');

                if (dataProducts >= 1 || dataProducts == 'unlimited') {
                    var form = `<div class="col-xl-6 removeProductForm">
                        <div class="form new__product__form">
                            <span class="product-form-close" data-id="` + string + `"> <i class="fa fa-times"></i> </span>
                            <div class="row g-3">
                                <div class="input-box col-md-6">
                                    <input class="form-control" name="product_title[]" type="text" placeholder="@lang('Title')"
                                    />
                                </div>
                                <div class="input-box col-md-6">
                                    <input class="form-control" name="product_price[]" type="text" placeholder="@lang('Price')"/>
                                </div>

                                <div class="input-box col-12">
                                     <textarea class="form-control" name="product_description[]" cols="30" rows="3" placeholder="@lang('Description')"
                                     ></textarea>
                                </div>
                                <div class="pe-2">
                                    <div class="input-box col-12 no-of-img-per-product">
                                        <div class="product-image no_of_product_image" id="product-image${productLenght}" data-productimage="{{ $single_package_infos->is_product == 1 && $single_package_infos->no_of_img_per_product == null  ? 500 : $single_package_infos->no_of_img_per_product }}"></div>
                                    </div>
                                </div>

                                <div class="upload-img thumbnail">
                                    <div class="form">
                                        <div class="img-box product-thumbnail">
                                            <input accept="image/*" type="file" onchange="previewImage('product_thumbnail` + string + `')" name="product_thumbnail[]"/>
                                            <span class="select-file">@lang('Product Thumbnail')</span>
                                            <img id="product_thumbnail` + string + `" src="{{ getFile(config('location.default')) }}" class="img-fluid"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                    $('.new_product_form').append(form)

                    if (dataProducts != 'unlimited') {
                        let newDataProducts = dataProducts - 1;
                        $('#add_products').data('products', newDataProducts);
                        $('.product_count').text(newDataProducts);
                    }

                    let maximum_no_of_image_per_product = $('.no_of_product_image').data('productimage');
                    let productImageOptions = {
                        imagesInputName: `product_image[${productLenght}]`,
                        label: 'Drag & Drop files here or click to browse images',
                        extensions: ['.jpg', '.jpeg', '.png'],
                        mimes: ['image/jpeg', 'image/png'],
                        maxSize: 5242880
                    };
                    if (maximum_no_of_image_per_product != 'unlimited') {
                        productImageOptions.maxFiles = maximum_no_of_image_per_product;
                    }
                    $(`#product-image${productLenght}`).imageUploader(productImageOptions);

                } else {
                    Notiflix.Notify.Warning("No more add products");
                }
            });

            $(document).on('click', '.product-form-close', function () {
                $(this).parents('.removeProductForm').remove();

                let dataProducts = $('#add_products').data('products');
                if (dataProducts != 'unlimited') {
                    let addNewDataProducts = $('#add_products').data('products') + 1
                    $('#add_products').data('products', addNewDataProducts);
                    $('.product_count').text(addNewDataProducts);
                }
            });

            $("#add_business_hour").on('click', function () {
                var form = `<div class="d-sm-flex justify-content-between removeBusinessHourInputField">
                                <div class="input-box w-100 my-1 mx-sm-1">
                                    <select class="js-example-basic-single form-control" name="working_day[]">
                                        <option value="Monday">@lang('Monday')</option>
                                        <option value="Tuesday">@lang('Tuesday')</option>
                                        <option value="Wednesday">@lang('Wednesday')</option>
                                        <option value="Thursday">@lang('Thursday')</option>
                                        <option value="Friday">@lang('Friday')</option>
                                        <option value="Saturday">@lang('Saturday')</option>
                                        <option value="Sunday">@lang('Sunday')</option>
                                    </select>
                                </div>
                                <div class="d-flex input-box-two">
                                    <div class="input-box w-100 my-1 me-1">
                                        <input type="time" name="start_time[]" class="form-control" placeholder="@lang('Start Hour')" />
                                    </div>
                                    <div class="input-box w-100 my-1 me-1">
                                        <input type="time" name="end_time[]" class="form-control" placeholder="@lang('End Hour')" />
                                    </div>
                                    <div class="input-box my-1 me-1">
                                        <button class="btn-custom add-new btn-custom-danger remove_business_hour_input_field_block" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;

                $('.new_business_hour_form').append(form)
            });

            $(document).on('click', '.remove_business_hour_input_field_block', function () {
                $(this).parents('.removeBusinessHourInputField').remove();
            });

            let maxSelectAmenities = $('.amenities_select2').data('amenities');
            $(".amenities_select2").select2({
                width: '100%',
                placeholder: '@lang("Select amenities")',
                maximumSelectionLength: maxSelectAmenities,
            });

            $('.tags_input').tagsinput({
                tagClass: function (item) {
                    return 'badge badge-info';
                },
                focusClass: 'focus',
            });

            $(document).on('change', '#place_id', function () {
                let place_name = $("#place_id").select2().find(":selected").data("name");
                let lat = $("#place_id").select2().find(":selected").data("lat");
                let long = $("#place_id").select2().find(":selected").data("long");
                $('#address-search').val(place_name);
                $('#lat').val(lat);
                $('#lng').val(long);
            });

            setIconpicker('.iconpicker1');

            function setIconpicker(selector = '.iconpicker1') {
                $(selector).iconpicker({
                    title: 'Search Social Icons',
                    selected: false,
                    defaultValue: false,
                    placement: "top",
                    collision: "none",
                    animation: true,
                    hideOnSelect: true,
                    showFooter: false,
                    searchInFooter: false,
                    mustAccept: false,
                    icons: [{
                        title: "bi bi-facebook",
                        searchTerms: ["facebook", "text"]
                    }, {
                        title: "bi bi-instagram",
                        searchTerms: ["instagram", "text"]
                    }, {
                        title: "bi bi-globe",
                        searchTerms: ["website", "text"]
                    }, {
                        title: "bi bi-linkedin",
                        searchTerms: ["linkedin", "text"]
                    }, {
                        title: "bi bi-discord",
                        searchTerms: ["discord", "text"]
                    }, {
                        title: "bi bi-youtube",
                        searchTerms: ["youtube", "text"]
                    }, {
                        title: "bi bi-whatsapp",
                        searchTerms: ["whatsapp", "text"]
                    }, {
                        title: "bi bi-twitter",
                        searchTerms: ["twitter", "text"]
                    }, {
                        title: "bi bi-google",
                        searchTerms: ["google", "text"]
                    }, {
                        title: "bi bi-camera-video",
                        searchTerms: ["vimeo", "text"]
                    }, {
                        title: "bi bi-skype",
                        searchTerms: ["skype", "text"]
                    }, {
                        title: "bi bi-camera-video-fill",
                        searchTerms: ["tiktalk", "text"]
                    }, {
                        title: "bi bi-badge-tm-fill",
                        searchTerms: ["tumbler", "text"]
                    }, {
                        title: "bi bi-blockquote-left",
                        searchTerms: ["blogger", "text"]
                    }, {
                        title: "bi bi-file-word-fill",
                        searchTerms: ["wordpress", "text"]
                    }, {
                        title: "bi bi-badge-wc",
                        searchTerms: ["weixin", "text"]
                    }, {
                        title: "bi bi-telegram",
                        searchTerms: ["telegram", "text"]
                    }, {
                        title: "bi bi-bell-fill",
                        searchTerms: ["snapchat", "text"]
                    }, {
                        title: "bi bi-three-dots",
                        searchTerms: ["flickr", "text"]
                    }, {
                        title: "bi bi-file-ppt",
                        searchTerms: ["pinterest", "text"]
                    }],
                    selectedCustomClass: "bg-primary",
                    fullClassFormatter: function (e) {
                        return e;
                    },
                    input: "input,.iconpicker-input",
                    inputSearch: false,
                    container: false,
                    component: ".input-group-addon,.iconpicker-component",
                })
            }

            let newSocialForm = $('.append_new_social_form').length + 1;
            for (let i = 2; i <= newSocialForm; i++) {
                setIconpicker(`#iconpicker${i}`);
            }

            $("#add_social_links").on('click', function () {
                let newSocialForm = $('.append_new_social_form').length + 2;
                var form = `<div class="d-flex justify-content-between append_new_social_form removeSocialLinksInput">
                                <div class="input-group mt-1">
                                   <input type="text" name="social_icon[]" class="form-control demo__icon__picker iconpicker${newSocialForm}" placeholder="Pick a icon" aria-label="Pick a icon"
                                   aria-describedby="basic-addon1" readonly>
                                </div>

                                <div class="input-box w-100 my-1 me-1">
                                    <input type="url" name="social_url[]" class="form-control" placeholder="@lang('URL')"/>
                                </div>
                                <div class="my-1 me-1">
                                    <button class="btn-custom add-new btn-custom-danger remove_social_link_input_field" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>`;

                $('.new_social_links_form').append(form)
                setIconpicker(`.iconpicker${newSocialForm}`);
            });

            $(document).on('click', '.remove_social_link_input_field', function () {
                $(this).parents('.removeSocialLinksInput').remove();
            });

            let maxSelectCategories = $('.listing__category__select2').data('categories');
            $(".listing__category__select2").select2({
                width: '100%',
                placeholder: '@lang("Select Categories")',
                maximumSelectionLength: maxSelectCategories,
            });

        });
    </script>
@endpush
