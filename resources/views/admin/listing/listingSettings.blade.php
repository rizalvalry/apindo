@extends('admin.layouts.app')
@section('title')
    @lang("Listing Settings")
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
                <form action="{{ route('admin.listingApprovalStore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-xl-4 col-sm-12 mb-3">
                            <div class="form-group">
                                <label class="d-block">@lang('Listing Approval')</label>
                                <div class="custom-switch-btn">
                                    <input type='hidden' value='1' name='listing_approval' {{ old('listing_approval',$listingApproval->listing_approval) == "1" ? 'checked' : '' }}>
                                    <input type="checkbox" name="listing_approval" class="custom-switch-checkbox"
                                           id="listing_approval"
                                           value="0" {{ old('listing_approval', $listingApproval->listing_approval) == "0" ? 'checked' : '' }}>
                                    <label class="custom-switch-checkbox-label" for="listing_approval">
                                        <span class="custom-switch-checkbox-for-package"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="before_expiry_date"> @lang('Package Expiry Notification')</label>
                                <select name="before_expiry_date[]" class="form-control" multiple>
                                        <option disabled>@lang('Choose Time')</option>
                                        <option value="30" @foreach($packageExpiryCrons as $cron) @if($cron->before_expiry_date == '30') selected @endif @endforeach>@lang('Before 30 Days')</option>
                                        <option value="15" @foreach($packageExpiryCrons as $cron) @if($cron->before_expiry_date == '15') selected @endif @endforeach>@lang('Before 15 Days')</option>
                                        <option value="10" @foreach($packageExpiryCrons as $cron) @if($cron->before_expiry_date == '10') selected @endif @endforeach>@lang('Before 10 Days')</option>
                                        <option value="7" @foreach($packageExpiryCrons as $cron) @if($cron->before_expiry_date == '7') selected @endif @endforeach>@lang('Before 7 Days')</option>
                                        <option value="3" @foreach($packageExpiryCrons as $cron) @if($cron->before_expiry_date == '3') selected @endif @endforeach>@lang('Before 3 Days')</option>
                                        <option value="1" @foreach($packageExpiryCrons as $cron) @if($cron->before_expiry_date == '1') selected @endif @endforeach>@lang('Before 1 Day')</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 col-sm-12">
                            <div class="form-group">
                                <button type="submit"
                                        class="btn btn-primary btn-block  btn-rounded mx-2 mt-4">
                                    <span>@lang('Save Changes')</span></button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        'use strict'
        $(document).ready(function () {
            $('select').select2({
                selectOnClose: true
            });
        });
    </script>
@endpush
