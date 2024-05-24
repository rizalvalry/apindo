@extends($theme.'layouts.app')
@section('title', trans('FAQ'))

@section('banner_heading')
    @lang('Faq')
@endsection

@section('content')
    <!-- faq section -->
    <section class="faq-section faq-page">
        <div class="container">
            @if(isset($contentDetails['faq']))
                <div class="row g-4 gy-5 justify-content-center ">
                    <div class="col-lg-8">
                        <div class="accordion" id="accordionExample">
                            @foreach($contentDetails['faq'] as $key=>$data)
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingOne{{ $data->id }}">
                                        <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{ $data->id }}" aria-expanded="true"
                                                aria-controls="collapseOne">@lang(optional($data->description)->title)
                                        </button>
                                    </h5>
                                    <div id="collapseOne{{ $data->id }}"
                                         class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                         aria-labelledby="headingOne{{ $data->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @lang(optional($data->description)->description)
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
