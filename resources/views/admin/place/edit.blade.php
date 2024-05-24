@extends('admin.layouts.app')

@section('title')
    @lang('Edit Place')
@endsection

@push('style')
    <!-- leaflet -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/esri-leaflet-geocoder.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/global/css/leaflet-search.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/global/css/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/global/css/Control.FullScreen.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/global/css/leaflet-search-two.css') }}" />
@endpush

@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="{{route('admin.place')}}" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>




            <div class="tab-content mt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="lang-tab1" role="tabpanel">
                            <form method="post" action="{{ route('admin.placeUpdate', $id) }}" class="mt-4" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="map-box">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="input-box col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="place"> @lang('Search Place') </label>
                                                    <input
                                                    id="address-search"
                                                    class="form-control @error('place') is-invalid @enderror"
                                                    name="place"
                                                    value="{{ old('place', $placeDetails->place) }}"
                                                    type="text"
                                                    placeholder="@lang('Search Location')"
                                                    autocomplete="off"
                                                    />
                                                    <div class="invalid-feedback">
                                                        @error('place') @lang($message) @enderror
                                                    </div>
                                                </div>

                                                <div class="input-box col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="lat"> @lang('Latitude ') </label>
                                                    <input
                                                        class="form-control @error('lat') is-invalid @enderror"
                                                        id="lat"
                                                        name="lat"
                                                        type="text"
                                                        value="{{ old('lat', optional($placeDetails->places)->lat) }}"
                                                        placeholder="@lang('Latitude')"
                                                    />
                                                    <div class="invalid-feedback">
                                                        @error('lat') @lang($message) @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="input-box col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="long"> @lang('Longitude ') </label>
                                                    <input
                                                        class="form-control @error('long') is-invalid @enderror"
                                                        id="lng"
                                                        name="long"
                                                        value="{{ old('long', optional($placeDetails->places)->long) }}"
                                                        placeholder="@lang('Longitude')"
                                                        type="text"
                                                    />
                                                    <div class="invalid-feedback">
                                                        @error('long') @lang($message) @enderror
                                                    </div>
                                                    <div class="valid-feedback"></div>
                                                </div>

                                                <div class="input-box col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group ">
                                                        <label>@lang('Status')</label>
                                                        <div class="custom-switch-btn">
                                                            <input type='hidden' value='1' name='status'>
                                                            <input type="checkbox" name="status" class="custom-switch-checkbox"
                                                                id="status"
                                                                value="0" <?php if( optional($placeDetails->places)->status == 0):echo 'checked'; endif ?>>
                                                            <label class="custom-switch-checkbox-label" for="status">
                                                                <span class="custom-switch-checkbox-inner"></span>
                                                                <span class="custom-switch-checkbox-switch"></span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div id="map">
                                                <p>
                                                @lang('You can also set location moving
                                                marker')
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">@lang('Save')</button>
                            </form>
                    </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- leaflet -->
    <script src="{{ asset('assets/global/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/global/js/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/global/js/esri-leaflet.js') }}"></script>
    <script src="{{ asset('assets/global/js/leaflet-search.js') }}"></script>
    <script src="{{ asset('assets/global/js/esri-leaflet-geocoder.js') }}"></script>
    <script src="{{ asset($themeTrue.'js/bootstrap-geocoder.js') }}"></script>
    <!-- Map script -->
    <script src="{{ asset('assets/global/js/map.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('js-lib')
    <script src="{{ asset('assets/admin/js/summernote.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush

