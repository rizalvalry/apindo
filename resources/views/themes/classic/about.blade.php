@extends($theme.'layouts.app')
@section('title',trans('About Us'))

@section('banner_heading')
   @lang('About Us')
@endsection

@section('content')
     @if(isset($templates['about-us'][0]) && $about_us = $templates['about-us'][0])
         <section class="about-section">
            <div class="container">
               <div class="row g-lg-5 gy-5 align-items-center">
                  <div class="col-lg-5">
                     <div class="img-box">
                        <img src="{{getFile(optional($about_us->media)->driver, $about_us->templateMedia()->image)}}" class="img-fluid rounded" alt="{{config('basic.site_title')}}"/>
                     </div>
                  </div>

                  <div class="col-lg-1 d-none d-lg-block"></div>
                  <div class="col-lg-6">
                     <div class="text-box">
                        <div class="header-text">
                           <h5>@lang(optional($about_us->description)->title)</h5>
                           <h3>@lang(optional($about_us->description)->sub_title)</h3>
                        </div>
                        <div>
                           {!! optional($about_us->description)->description !!}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
     @endif

     @include($theme.'sections.testimonial')
     @include($theme.'sections.how-it-work')
@endsection
