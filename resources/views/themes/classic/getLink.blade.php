@extends($theme.'layouts.app')
@section('title')
    @lang($title)
@endsection

@section('banner_heading')
    @lang($title)
@endsection

@section('content')
    <section class="blog-section blog-page">
        <div class="container">
            <div class="row g-lg-5">
                <div class="col-lg-12">
                    <div class="blog-box">
                        <div class="text-box">
                            <p>
                                @lang($description)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
