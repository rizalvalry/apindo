@extends('admin.layouts.app')
@section('title')
    @lang('Product Enquiry Replies')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7">
                <div class="card shadow border-right">
                    <div class="card-body">
                        <div class="inbox_right_side__profile__info__phone d-flex">

                            <i class="fas fa-question mr-2 mt-1"></i>
                            <p class="ms-2"> @lang($singleProductQuery->message)</p>
                        </div>

                        <div class="inbox-wrapper">
                            <!-- top bar -->
                            <div class="top-bar">
                                <div>
                                    <div class="massenger_active">
                                        <img class="user img-fluid"
                                             src="{{getFile($admin->driver, $admin->image)}}"/>
                                        <p class="active-icon-messenger"></p>
                                        <span
                                            class="name text-white">@lang($admin->name)</span>
                                    </div>
                                </div>
                            </div>
                            <!-- chats -->
                            <div class="chats">
                                @foreach($singleProductQuery->replies as $productReply)
                                    <div>
                                        @if($singleProductQuery->user_id == $productReply->user_id)
                                            <div class="chat-box this-side">
                                                <div class="text-wrapper">
                                                    <div class="text">
                                                        <p>@lang($productReply->reply)</p>
                                                    </div>
                                                    <div class="fileimg">
                                                        <a href="{{getFile($productReply->driver, $productReply->file)}}" data-fancybox="gallery">
                                                            <img src="{{getFile($productReply->driver, $productReply->file)}}" width="50px" height="50px">
                                                        </a>
                                                    </div>

                                                    <span class="time" >{{ dateTime($productReply->created_at) }}</span>
                                                </div>
                                                <div class="img">
                                                    <img class="img-fluid" src="{{getFile(optional($singleProductQuery->get_user)->driver, optional($singleProductQuery->get_user)->image)}}"/>
                                                </div>
                                            </div>
                                        @else
                                            <div class="chat-box opposite-side">
                                                <div class="img">
                                                    <img class="img-fluid"
                                                         src="{{ asset(getFile(optional($singleProductQuery->get_client)->driver, optional($singleProductQuery->get_client)->image)) }}"
                                                    />
                                                </div>
                                                <div class="text-wrapper">
                                                    <div class="text">
                                                        <p>@lang($productReply->reply)</p>
                                                    </div>
                                                    <div class="fileimg" v-if="message.fileImage">
                                                        <a href="src="{{ asset(getFile($productReply->driver, $productReply->file)) }}"" data-fancybox="gallery">
                                                        <img src="{{ asset(getFile($productReply->driver, $productReply->file)) }}" width="50px" height="50px">
                                                        </a>
                                                    </div>
                                                    <span class="time">{{ dateTime($productReply->created_at) }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <form action="{{ route('admin.productMessageSend') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="typing-area">
                                        <div class="input-group">
                                        <textarea
                                            rows="3"
                                            name="message"
                                            class="form-control type-message"
                                            @error('message') is-invalid @enderror
                                            placeholder="@lang('Type your message...')" disabled></textarea>

                                            <button type="submit" class="submit-btn">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">
                        <div class="card shadow border-right">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h5>@lang('Owner Information')</h5>
                                </div>

                                <div class="inbox_right_side bg-white rounded m-0">

                                    <div class="inbox_right_side__profile  p-3">
                                        <div class="inbox_right_side__profile__header text-center mb-4">
                                            <img
                                                src="{{ asset(getFile(optional(optional($singleProductQuery->get_listing)->get_user)->driver, optional(optional($singleProductQuery->get_listing)->get_user)->image)) }}"
                                                class="productClientImage">
                                            <h6 class="mt-2 mb-0">
                                                <b>@lang(optional(optional($singleProductQuery->get_listing)->get_user)->firstname) @lang(optional(optional($singleProductQuery->get_listing)->get_user)->lastname)</b>
                                            </h6>
                                        </div>

                                        <div class="inbox_right_side__profile__info">

                                            <div
                                                class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                <p>{{ __('Email') }}:</p>
                                                <p>@if(optional(optional($singleProductQuery->get_listing)->get_user)->email)
                                                        {{ optional(optional($singleProductQuery->get_listing)->get_user)->email }}
                                                    @else
                                                        @lang('N/A')
                                                    @endif</p>
                                            </div>

                                            <div
                                                class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                <p>{{ __('Website') }}: </p>
                                                <p>
                                                    @if(optional(optional($singleProductQuery->get_listing)->get_user)->website)
                                                        <a href="{{ optional(optional($singleProductQuery->get_listing)->get_user)->website }}" target="_blank">
                                                            {{ optional(optional($singleProductQuery->get_listing)->get_user)->website }}
                                                        </a>
                                                    @else
                                                        @lang('N/A')
                                                    @endif</p>
                                            </div>

                                            <div
                                                class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                <p>{{ __('Address') }}:</p>
                                                <p>@if(optional(optional($singleProductQuery->get_listing)->get_user)->address)
                                                        {{ optional(optional($singleProductQuery->get_listing)->get_user)->address }}
                                                    @else
                                                        @lang('N/A')
                                                    @endif</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="right_side_bottom p-3">
                                        <a href="{{ route('profile', [slug(optional(optional($singleProductQuery->get_listing)->get_user)->firstname), optional(optional($singleProductQuery->get_listing)->get_user)->id]) }}" class="btn btn-primary btn-custom__product__reply d-flex justify-content-center" target="_blank">@lang('Visit Profile')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12">
                        <div class="card shadow border-right">
                            <div class="card-body">
                                <div class="inbox_right_side bg-white rounded">
                                    <div class="d-flex justify-content-center">
                                        <h5>@lang('Product Information')</h5>
                                    </div>
                                    <div class="inbox_right_side__profile  p-3">
                                        <div class="inbox_right_side__profile__header text-center mb-4">
                                            <img
                                                src="{{ asset(getFile(optional($singleProductQuery->get_product)->driver, optional($singleProductQuery->get_product)->product_thumbnail)) }}"
                                                class="productInfoThumbnail">
                                        </div>

                                        <div class="inbox_right_side__profile__info">

                                            <div
                                                class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                <p>{{ __('Listing') }} : </p>
                                                <p>@if(optional($singleProductQuery->get_listing)->title)
                                                        <a href="{{ route('listing-details',[slug(optional($singleProductQuery->get_listing)->title), optional($singleProductQuery->get_listing)->id]) }}" target="_blank">
                                                            {{ optional($singleProductQuery->get_listing)->title }}
                                                        </a>
                                                    @else
                                                        @lang('N/A')
                                                    @endif</p>
                                            </div>
                                            <div
                                                class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                <p>{{ __('Product') }} : </p>
                                                <p>@if(optional($singleProductQuery->get_product)->product_title)
                                                        {{ optional($singleProductQuery->get_product)->product_title }}
                                                    @else
                                                        @lang('N/A')
                                                    @endif</p>
                                            </div>
                                            <div
                                                class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                <p>{{ __('Price') }} :</p>
                                                <p>@if(optional($singleProductQuery->get_product)->product_price)
                                                        ${{ optional($singleProductQuery->get_product)->product_price }}
                                                    @else
                                                        @lang('N/A')
                                                    @endif</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

