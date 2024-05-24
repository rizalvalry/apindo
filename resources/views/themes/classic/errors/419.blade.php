@extends($theme.'layouts.error')
@section('title','419')
@section('content')
    <section id="add-recipient-form" class="wow fadeInUp section__padding" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12 text-center">
                    <span class="display-1 d-block">@lang('419')</span>
                    <div class="mb-4 lead">@lang("Sorry, your session has expired")</div>
                    <a class="btn btn-primary btn-custom text-white" href="{{url('/')}}" >@lang('Back To Home')</a>
                </div>
            </div>
        </div>
    </section>
@endsection
