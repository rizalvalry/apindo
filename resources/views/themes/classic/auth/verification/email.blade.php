@extends($theme.'layouts.app')
@section('title',trans('Email Verification'))
@section('banner_heading')
    @lang('Email Verification')
@endsection

@section('content')

    <section class="login-section">
        <div class="overlay h-100">
            <div class="container h-100">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-wrapper d-flex align-items-center h-100">
                            <form action="{{route('user.mailVerify')}}"  method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4>@lang('Email Verification')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input
                                            type="text"
                                            class="form-control"
                                            autofocus="off"
                                            placeholder="@lang('Code')"
                                            name="code" value="{{old('code')}}"
                                            autocomplete="off" />
                                    </div>
                                    @error('code')<span class="text-danger  mt-1">{{ $message }}</span>@enderror
                                    @error('error')<span class="text-danger  mt-1">{{ $message }}</span>@enderror

                                <button class="btn-custom w-100">@lang('sign in')</button>
                                <div class="bottom">
                                    @lang("Didn't get Code? Click to")

                                    <a href="{{route('user.resendCode')}}?type=email">@lang('Resend code')</a>
                                    @error('resend')
                                    <p class="text-danger  mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
