@extends('admin.layouts.app')

@section('title')
    @lang('Edit Storage')
@endsection

@section('content')
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="media mb-4 justify-content-end">
                <a href="{{route('admin.fileStorage')}}" class="btn btn-sm  btn-primary mr-2">
                    <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
                </a>
            </div>

            <div class="tab-content mt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="lang-tab"
                     role="tabpanel">
                    <form method="post" action="{{route('admin.storage.edit',$storage->id)}}"
                          class="mt-4" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3 package_title">
                                <label for="name"> @lang('Name') </label>
                                <input type="text" name="name"
                                       placeholder="@lang('Enter name')"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $storage->name) }}">
                                <div class="invalid-feedback">
                                    @error('name') @lang($message) @enderror
                                </div>
                            </div>

                            @if($storage->parameters)
                                @foreach ($storage->parameters as $key => $parameter)
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3 package_title">
                                        <label for="{{ $key }}">{{ __(strtoupper(str_replace('_',' ', $key))) }}</label>
                                        <input type="text" name="{{ $key }}" class="form-control @error($key) is-invalid @enderror" id="{{ $key }}" value="{{ old($key, $parameter) }}">
                                        <div class="invalid-feedback">
                                            @error($key) @lang($message) @enderror
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 col-6">
                                <div class="form-group">
                                    <label for="image">{{ ('Choose Logo') }}</label>
                                    <div class="image-input ">
                                        <label for="image-upload" id="image-label"><i
                                                class="fas fa-upload"></i></label>
                                        <input type="file" name="logo" placeholder="@lang('Choose image')"
                                               id="image">
                                        <img id="image_preview_container" class="preview-image"
                                             src="{{ getFile($storage->driver,config('location.storage.path').$storage->logo )}}" alt="{{ __($storage->name) }}"
                                             alt="@lang('preview image')">
                                    </div>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
    <script defer>
        'use strict'
        $(document).ready(function () {
                $('#image').change("on", function () {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image_preview_container').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
        });
    </script>

@endpush
