<!-- FOOTER -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-box">
                    <a class="navbar-brand" href="#">
                        <img src="{{ getFile(config('basic.default_file_driver'),config('basic.logo_image')) }}" alt="{{config('basic.site_title')}}">
                    </a>
                    @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                        <p>
                            @lang(strip_tags(optional($contact->description)->footer_short_details))
                        </p>
                    @endif
                    @if(isset($contentDetails['social']))
                        <div class="social-links">
                            @foreach($contentDetails['social'] as $data)
                                <a href="{{optional(optional(optional($data->content)->contentMedia)->description)->link}}" target="_blank">
                                    <i class="{{optional(optional(optional($data->content)->contentMedia)->description)->icon}}"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ps-lg-5">
                <div class="footer-box">
                    <h5>@lang('Quick Links')</h5>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}">@lang('About')</a>
                        </li>
                        <li>
                            <a href="{{ route('blog') }}">@lang('Blog')</a>
                        </li>
                        <li>
                            <a href="{{ route('listing') }}">@lang('Listing')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 ps-lg-5">
                <div class="footer-box">
                    <h5>@lang('OUR Services')</h5>
                    <ul>
                        @isset($contentDetails['support'])
                            @foreach($contentDetails['support'] as $data)
                                <li>
                                    <a href="{{route('getLink', [slug(optional($data->description)->title), $data->content_id])}}">@lang(optional($data->description)->title)</a>
                                </li>
                            @endforeach
                        @endisset
                        <li>
                            <a href="{{route('faq')}}">@lang('FAQ')</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">@lang('Contact')</a>
                        </li>
                    </ul>
                </div>
            </div>

            @if(isset($contactUs['contact-us'][0]) && $contact = $contactUs['contact-us'][0])
                <div class="col-md-6 col-lg-3">
                    <div class="footer-box">
                        <h5>@lang('get in touch')</h5>
                        <ul>
                            <li>
                                <i class="far fa-phone-alt"></i>
                                <span>@lang(optional($contact->description)->phone)</span>
                            </li>
                            <li>
                                <i class="far fa-envelope"></i>
                                <span>@lang(optional($contact->description)->email)</span>
                            </li>
                            <li>
                                <i class="far fa-map-marker-alt"></i>
                                <span>@lang(optional($contact->description)->address)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright">
                        @lang('Copyright') &copy; {{date('Y')}} <a href="{{ route('home') }}">@lang($basic->site_title)</a> @lang('All Rights Reserved')
                    </p>
                </div>

                @php
                    $languageArray = json_decode($languages, true);
                @endphp

                <div class="col-md-6 language">
                    @foreach ($languageArray as $key => $lang)
                        <a href="{{route('language',$key)}}"><span class="flag-icon flag-icon-{{strtolower($key)}}"></span>@lang($lang)</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /FOOTER -->


