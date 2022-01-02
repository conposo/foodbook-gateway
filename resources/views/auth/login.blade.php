@extends('layouts.app')

@section('content')

@include('auth.partials.css')

<div class="container login_wrapper">
    <div class="row justify-content-center" style="
    /* padding-bottom: 180px; */
">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Вписване') }}</div>

                <div class="card-body">
                    <form class="pt-2" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-8 mx-auto">
                                <label for="email" class="col-form-label text-md-right">{{ __('Имейл адрес') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-8 mx-auto">
                                <label for="password" class="col-form-label text-md-right">{{ __('Парола') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Запомни') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 mx-auto d-flex justify-content-between">
                                <button type="submit" class="_d-flex _align-items-end pl-0 btn _btn-outline-dark" style="
    /* background: #fffaef;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.26); */
">
                                    <span>{{ __('Вписване') }}</span>
                                    <i class="_ml-1 fas fa-chevron-right" style="
    opacity: 0.5;
    font-size: 14px;
"></i>
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="text-right pr-0 btn btn-link text-black-50" href="{{ route('password.request') }}">
                                        {{ __('Забравена парола?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>


            <div class="card mt-5 mb-5">

                <div class="card-body">
                        <div >
                            <h5 class="font-weight-normal text-center">Uh-oh! Не си регистриран! Нищо... не е късно :)</h5>  
                        </div>
                    <div class="border-top pt-2 text-center">
                        <div>
                            <small>Виж тук защо е добре да не отлагаш</small>
                        </div>
                        <a href="/register" class="mt-2 btn _btn-outline-dark" style="
                            /* background: #fffaef;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.26); */
                        ">
                            Виж повече<i class="ml-1 fas fa-chevron-right" style="
    opacity: 0.5;
"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('auth.partials.restaurants')

@endsection
