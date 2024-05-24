<!-- blog section -->
@if (count($popularBlogs) > 0)
    <section class="blog-section">
        <div class="container">
            @if(isset($templates['blog'][0]) && $blog = $templates['blog'][0])
                <div class="row">
                    <div class="col-12">
                        <div class="header-text text-center mb-5">
                            <h5>@lang(optional($blog->description)->title)</h5>
                            <h3>@lang(optional($blog->description)->sub_title)</h3>
                            <p class="mx-auto">
                                @lang(optional($blog->description)->short_title)
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row gy-3 g-md-5">
                @foreach ($popularBlogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-box">
                            <div class="img-box">
                                <img class="img-fluid" src="{{ getFile($blog->driver, $blog->image) }}" alt="{{config('basic.site_title')}}"/>
                            </div>
                            <div class="text-box">
                                <span class="category">@lang(optional(optional($blog->blogCategory)->details)->name)</span>
                                <a href="{{route('blogDetails',[slug(optional($blog->details)->title), $blog->id])}}" class="title"
                                >{{ Str::limit(optional($blog->details)->title, 80) }}
                                </a>
                                <div class="date-author">
                                    <span class="author"> @lang(optional($blog->details)->author) </span>
                                    <span class="float-end">{{ dateTime($blog->created_at, 'M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row text-center mt-5">
                <div class="col">
                    <a href="{{ route('blog') }}" class="btn-custom">
                        @lang('Explore more')
                        <i class="fal fa-angle-double-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
