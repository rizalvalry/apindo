@extends($theme.'layouts.error')
@section('title')
    @lang('403 Forbidden')
@endsection
@section('content')
    <section id="add-recipient-form" class="wow fadeInUp section__padding" data-wow-delay=".2s" data-wow-offset="300">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12 text-center">
                    <span class="display-1 d-block">{{trans('Forbidden')}}</span>
                    <div class="mb-4 lead">{{trans("You don't have permission to access ‘/’ on this server")}}</div>
                    <a class="btn btn-primary btn-custom text-white" href="{{url('/')}}" >@lang('Back To Home')</a>
                </div>
            </div>
        </div>
    </section>
@endsection
