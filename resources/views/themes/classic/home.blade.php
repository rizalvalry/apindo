@extends($theme.'layouts.app')
@section('title',trans('Home'))

@section('content')

      @include($theme.'partials.heroBanner')

     <!-- categroy section -->
     @include($theme.'sections.category')

     <!-- popular listings -->
     @include($theme.'sections.listing')

     <!-- how it works section -->
     @include($theme.'sections.how-it-work')

     <!-- testimonial section -->
     @include($theme.'sections.testimonial')

     <!-- blog section -->
     @include($theme.'sections.blog')

     <!-- newsletter -->
     @include($theme.'sections.news-letter')

@endsection
