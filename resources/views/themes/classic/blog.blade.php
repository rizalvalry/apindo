@extends($theme.'layouts.app')
@section('title', trans($title))

@section('banner_heading')
    @lang('Our Blogs')
@endsection

@section('content')
    <!-- BLOG -->
    @if (count($allBlogs) > 0)
        <section class="blog-section blog-page">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-lg-8">
                        @forelse ($allBlogs as $blog)
                            <div class="blog-box">
                                <div class="img-box">
                                    <img class="img-fluid"
                                         src="{{ getFile($blog->driver, $blog->image) }}" alt=".."/>
                                    <span
                                        class="category"> @lang(optional(optional($blog->blogCategory)->details)->name)</span>
                                </div>
                                <div class="text-box">
                                    <div class="date-author mb-3">
                                         <span class="author">
                                            <i class="fad fa-pencil"></i>@lang(optional($blog->details)->author)
                                         </span>
                                        <span class="float-end">
                                            <i class="fad fa-calendar-alt" aria-hidden="true"></i>{{ dateTime($blog->created_at, 'M d, Y') }}
                                         </span>
                                    </div>

                                    <a href="{{route('blogDetails',[slug($blog->details->title), $blog->id])}}"
                                       class="title">{{Str::limit(optional($blog->details)->title, 100) }}
                                    </a>

                                    <p>
                                        {{ Str::limit(strip_tags(optional($blog->details)->details),500)}}
                                    </p>

                                    <a href="{{route('blogDetails',[slug(optional($blog->details)->title), $blog->id])}}"
                                       class="btn-custom">@lang('Read more')</a>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="col-lg-4">
                        <div class="right-bar">
                            <div class="side-box">
                                <form action="{{ route('blogSearch') }}" method="get">
                                    <h4>@lang('Search')</h4>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="search"
                                               placeholder="@lang('search')"/>
                                        <button type="submit"><i class="fal fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="side-box">
                                <h4>@lang('Categories')</h4>
                                <ul class="links">
                                    @foreach ($blogCategory as $category)
                                        <li>
                                            <a href="{{ route('CategoryWiseBlog', [slug(optional($category->details)->name), $category->id]) }}">

                                                @lang(optional($category->details)->name)
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="side-box">
                                <h4>@lang('Recent Blogs')</h4>
                                @foreach ($allBlogs as $blog)
                                    <div class="blog-box">
                                        <div class="img-box">
                                            <img class="img-fluid"
                                                 src="{{ getFile($blog->driver, $blog->image) }}" alt="..."/>
                                            <span
                                                class="category">@lang(optional($blog->blogCategory->details)->name)</span>
                                        </div>
                                        <div class="text-box">
                                            <a href="{{route('blogDetails',[slug(optional($blog->details)->title), $blog->id])}}"
                                               class="title">{{ Str::limit(optional($blog->details)->title, 40) }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 d-flex justify-content-center">
                        <nav aria-label="Page navigation example mt-3">
                            {{ $allBlogs->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="custom-not-found2">
            <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="{{config('basic.site_title')}}"
                 class="img-fluid">
        </div>
    @endif
@endsection



