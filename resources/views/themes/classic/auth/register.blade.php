@extends($theme.'layouts.app')
@section('title','Sign Up')
@section('banner_heading')
    @lang('Register')
@endsection
@section('content')
    <section class="login-section">
        <div class="overlay">
       <div class="container">
          <div class="row justify-content-center">
             <div class="col-lg-8">
                <div class="form-wrapper d-flex align-items-center">
                   <form action="{{ route('register') }}" method="post">
                     @csrf
                      <div class="row g-4">
                         <div class="col-12">
                            <h4>@lang('register here')</h4>
                         </div>
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="firstname"
                               value="{{old('firstname')}}"
                               class="form-control"
                               placeholder="@lang('First name')"
                            />
                         </div>
                         @error('firstname')
                          <span class="text-danger mt-1">@lang($message)</span>
                          @enderror
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="lastname"
                               value="{{old('lastname')}}"
                               class="form-control"
                               placeholder="@lang('Last name')"
                            />
                         </div>
                         @error('lastname')
                          <span class="text-danger mt-1">@lang($message)</span>
                         @enderror
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="username"
                               value="{{old('username')}}"
                               class="form-control"
                               placeholder="@lang('Username')"
                            />
                         </div>
                         @error('username')
                          <span class="text-danger mt-1">@lang($message)</span>
                         @enderror
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="email"
                               value="{{old('email')}}"
                               class="form-control"
                               placeholder="@lang('Email Address')"
                            />
                         </div>
                         @error('email')
                            <span class="text-danger mt-1">@lang($message)</span>
                          @enderror
                         <div class="input-box col-12">
                           @php
                              $country_code = (string) @getIpInfo()['code'] ?: null;
                              $myCollection = collect(config('country'))->map(function($row) {
                                 return collect($row);
                              });
                              $countries = $myCollection->sortBy('code');
                           @endphp
                          <div class="row">
                              <div class="col-4">
                                  <select name="phone_code" class="form-control country_code dialCode-change">
                                      @foreach(config('country') as $value)
                                          <option value="{{$value['phone_code']}}"
                                                  data-name="{{$value['name']}}"
                                                  data-code="{{$value['code']}}"
                                              {{$country_code == $value['code'] ? 'selected' : ''}}
                                          > {{$value['name']}} ({{$value['phone_code']}})
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-8">
                                  <input type="text" name="phone" class="form-control dialcode-set" value="{{old('phone')}}" placeholder="@lang('Phone Number')">
                                  <input type="hidden" name="country_code" value="{{old('country_code')}}" class="text-dark">
                              </div>
                          </div>
                         </div>
                         @error('phone')
                           <span class="text-danger mt-1">@lang($message)</span>
                         @enderror
                         <div class="input-box col-12">
                            <input
                               type="password"
                               name="password"
                               class="form-control"
                               placeholder="@lang('Password')"
                            />
                         </div>
                         @error('password')
                          <span class="text-danger mt-1">@lang($message)</span>
                         @enderror
                         <div class="input-box col-12">
                            <input
                               type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="@lang('Confirm Password')"
                            />
                         </div>

                          @if(basicControl()->reCaptcha_status_registration)
                              <div class="col-md-6 box mb-4 form-group">
                                  {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                  {!! NoCaptcha::display($basic->theme == 'original' ? ['data-theme' => 'light'] : []) !!}
                                  @error('g-recaptcha-response')
                                  <span class="text-danger mt-1">@lang($message)</span>
                                  @enderror
                              </div>
                          @endif

                         <div class="col-12">
                            <div class="links">

                            </div>
                         </div>
                      </div>
                      <button class="btn-custom w-100">@lang('sign up')</button>
                      <div class="bottom">
                         @lang('Already have an account?')
                         <a href="{{ route('login') }}">@lang('Login here')</a>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
    </section>
@endsection
@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            setDialCode();
            $(document).on('change', '.dialCode-change', function () {
                setDialCode();
            });
            function setDialCode() {
                let currency = $('.dialCode-change').val();
                $('.dialcode-set').val(currency);
            }

        });
    </script>
@endpush
