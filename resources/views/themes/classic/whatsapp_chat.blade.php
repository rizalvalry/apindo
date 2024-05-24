@if($single_listing_details->whatsapp_number)
<div>
    <div class="whatsapp_icon">
        <a id="bubble-btn" type="button" target="_blank">
            <img src="{{ asset($themeTrue.'img/whatsapp.png') }}">
            <div class="notification-dot"><i class="fas fa-exclamation text-white"></i></div>
        </a>
    </div>
    <div class="pasa opacity-0">
        <div class="whatsapp-bubble ">
            <div class="card">
                <div class="card-header">
                    <div class="close-btn"><i class="fal fa-times"></i></div>
                    <div class="profile">
                        <div class="profile-thum">
                            <img src="{{ getFile(optional($single_listing_details->get_user)->driver, optional($single_listing_details->get_user)->image) }}" alt="">
                            <div class="active-dot"></div>
                        </div>

                        <div class="profile-content">
                            <div class="profile-title font-weight-bold text-dark">@lang(optional($single_listing_details->get_user)->firstname) @lang(optional($single_listing_details->get_user)->lastname)</div>
                            <p>
                                @lang($single_listing_details->replies_text)
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="whatsapp-chat-text">
                        <p class="card-text">@lang($single_listing_details->body_text)</p>
                    </div>


                </div>
                <div class="card-footer text-body-secondary">
                    <a href="https://wa.me/{{ $single_listing_details->whatsapp_number}}" target="_blank" class="btn-custom"><i class="fab fa-whatsapp"></i> start chat</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .whatsapp_icon {
        right: 100px !important;
        bottom: 23px !important;
        z-index: 1 !important;
    }
    .whatsapp_icon img {
        width: 60px !important;
    }
</style>
@endif
