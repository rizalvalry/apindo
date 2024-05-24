<!-- Cookie Alert -->
@if(getCookieInfo() != false)
    <!-- Cookie-content -->
    <div id="cookieAlert" class="cookie-content d-none">
        <div class="content">
            <img class="cookie-img" src="{{ asset($themeTrue.'img/cookie.png') }}" alt="{{config('basic.site_title')}}">
            <h5 class="title cookie-title">@lang(optional(getCookieInfo()->description)->title)</h5>
            <p>
                @lang(Str::limit(optional(getCookieInfo()->description)->popup_short_description, 180))
                <a href="{{ route('getTemplate', ['cookie-consent']) }}" class="text--base">@lang('Privacy Policy')</a>
            </p>
            <div class="cookie-btns">
                <a href="javascript:void(0)" class="close-btn" id="cookie-deny">@lang('Decline')</a>
                <a href="javascript:void(0)" class="cmn--btn btn-sm btn--success btn-custom"
                   id="cookie-accept">@lang('Accept')</a>
            </div>
        </div>
    </div>
@endif

@push('script')
    <script>
        'use strict'
        if (localStorage.getItem('cookie-value') == 1 || sessionStorage.getItem('cookie-value') == 1) {
            $('.cookie-content').remove();
        } else {
            $('.cookie-content').removeClass('d-none');
        }

        $('#cookie-accept').on("click", function () {
            localStorage.setItem('cookie-value', 1);
            sessionStorage.removeItem('cookie-value');
            $('.cookie-content').remove();
        });

        $('#cookie-deny').on("click", function () {
            sessionStorage.setItem('cookie-value', 1);
            localStorage.removeItem('cookie-value');
            $('.cookie-content').remove();
        });
    </script>
@endpush
