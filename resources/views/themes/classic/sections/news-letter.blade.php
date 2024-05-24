@if(isset($templates['news-letter'][0]) && $news_letter = $templates['news-letter'][0])
    <section class="newsletter-section" id="subscribe">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h3>@lang(optional($news_letter->description)->title)</h3>
                        <p>
                            @lang(optional($news_letter->description)->sub_title)
                        </p>
                        <form action="{{route('subscribe')}}" method="post">
                            @csrf
                            <div class="input-group mt-5">
                                <input type="email" name="email" class="form-control" placeholder="@lang('Enter Email Address')" aria-label="Subscribe Newsletter" aria-describedby="basic-addon"/>
                                <button type="submit" class="btn-custom">@lang('subscribe')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
