@extends($theme.'layouts.app')
@section('title',trans('Sign In'))
@section('banner_heading')
    @lang('Sign In')
@endsection
@section('content')
    <section class="login-section">
        <div class="overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-wrapper d-flex align-items-center">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4>@lang('Login here')</h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input
                                            type="text"
                                            name="username"
                                            class="form-control"
                                            autocomplete="off"
                                            autofocus="off"
                                            placeholder="@lang('Email Or Username')"
                                        />
                                    </div>
                                    @error('username')<span
                                        class="text-danger float-left">@lang($message)</span>@enderror
                                    @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror

                                    <div class="input-box col-12">
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            placeholder="@lang('Password')"
                                            autocomplete="off"
                                        />
                                    </div>
                                    @error('password')
                                    <span class="text-danger mt-1">@lang($message)</span>
                                    @enderror

                                    @if(basicControl()->reCaptcha_status_login)
                                        <div class="box mb-4 form-group">
                                            {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                            {!! NoCaptcha::display($basic->theme == 'original' ? ['data-theme' => 'light'] : []) !!}
                                            @error('g-recaptcha-response')
                                            <span class="text-danger mt-1">@lang($message)</span>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="links">

                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="remember"
                                                    {{ old('remember') ? 'checked' : '' }}
                                                    id="flexCheckDefault"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="flexCheckDefault"
                                                >
                                                    @lang('Remember me')
                                                </label>
                                            </div>

                                            <a href="{{ route('password.request') }}"
                                            >@lang('Forgot password?')</a
                                            >
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-custom w-100">@lang('sign in')</button>
                                <div class="bottom">
                                    @lang("Don't have an account?")

                                    <a href="{{ route('register') }}">@lang('Create account')</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



