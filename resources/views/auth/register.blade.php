@extends('layouts.app')

@section('content')

@include('auth.partials.css')

<div class="container register_wrapper">
    <div class="row justify-content-center" style="
    /* padding-bottom: 120px; */
">
        <div class="col-md-6">
            <div class="card" style="
    background-image: url(https://florafoods.com/wp-content/uploads/flora-foods_Layer_98.png);
    background-size: 100px;
    background-repeat: no-repeat;
    background-position: 400px 530px;
">
                <div class="card-header text-center">{{ __('auth.Register') }}</div>

                <div class="card-body">
                    <form class="mb-0 pt-3" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-12 col-lg-8 mx-auto">
                                <label for="first_name" class="pb-0 col-form-label text-md-right">{{ __('auth.Name') }}</label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @csrf

                        <div class="form-group row">

                            <div class="col-12 col-lg-8 mx-auto">
                                <label for="last_name" class="pb-0 col-form-label text-md-right">{{ __('auth.Surname') }}</label>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-12 col-lg-8 mx-auto">
                                <label for="email" class="pb-0 col-form-label text-md-right">{{ __('auth.Email') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-12 col-lg-8 mx-auto">
                                <label for="password" class="pb-0 col-form-label text-md-right">{{ __('auth.Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Трябва да бъде от поне 8 знака">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-12 col-lg-8 mx-auto">
                                <label for="password-confirm" class="pb-0 col-form-label text-md-right">{{ __('auth.ConfirmPassword') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="py-3 form-group row mb-0">
                            <div class="col text-center">
                                <button type="submit" class="btn _btn-outline-dark" style="
    /* background: #fffaef;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.26); */
">
                                    {{ __('auth.Register') }}
                                    <i class="ml-1 fas fa-chevron-right" style="
    opacity: 0.5;
"></i>
                                    <!-- <i class="fas fa-sign-in-alt"></i> -->
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-5 mt-md-0 mb-5 mt-md-0 col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('auth.WhyRegister') }}</div>

                <div class="card-body px-3 px-md-5">

                <div class="accordion" id="accordionExample">

                    <div>
                        <div class="d-none text-center mb-2" id="headingOne" onclick="$('#headingTwo > button').toggleClass('dbtn-outline-dark')">
                            <button class="w-100 btn btn-outline-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                За всички нас
                            </button>
                        </div>
                        <div id="collapseOne" class="pt-3 collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <h6 class="pt-1">Колекционирай и Създавай</h6>
                            <p>Свои рецепти и рецептурни книжки а също и от други автори във Foodbook</p>

                            <hr>

                            <h6>Организирай</h6>
                            <p>- своите ежедневни хранения - какво е менюто, къде ще обядваш например и не на последно място с кого</p>
                            <p>- своите списъци за пазаруване</p>

                            <hr>

                            <h6>Резервации</h6>
                            <p>Резервирай маса, покани гости, следи си сметката, и <b>поръчвай направо от приложението</b></p>

                            <hr>

                            <h6>Достъпвай</h6>
                            <p>всичката информация за теб по всяко време когато ти потрябва</p>
                            <hr>

                            <h6>Споделяй</h6>
                            <p class="pb-5">своите рецепти и направените от теб резервации</p>
                        </div>
                    </div>
                    
                    <div class="">
                        <div class="text-center mb-2" id="headingTwo" onclick="$('#headingTwo > button').toggleClass('dbtn-outline-dark')">
                            <button class="w-100 btn dbtn-outline-dark" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Решения за бизнеса
                                    <i class="ml-1 fas fa-chevron-right" style="
    opacity: 0.5;
"></i>
                            </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div>
                                <h6>Организирай резервации</h6>
                                <p>Предложи на своите клиенти, които са във Foodbook да правят резервации директно през приложението</p>

                                <hr>

                                <h6>Улеснени поръчки и плащания</h6>
                                <p>всеки гост може да прави <b>поръчки направо през приложението</b> и в същото време да си следи сметката</p>

                                <hr>

                                <h6>Достъпвай</h6>
                                <p>всичката информация за твоят бизнес по всяко време и когато ти потрябва</p>
                                <hr>

                                <h6>Споделяй</h6>
                                <p>своите уникални предложения и обедни менюта през платформата по един уникален начин! Виж повече в администраторския панел.</p>
                            </div>
                            
                            <button class="mt-3 btn btn-sm btn-outline-dark bg-light text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                    onclick="$('#headingTwo > button').toggleClass('_btn-outline-dark')">
                                <i class="fas fa-chevron-left"></i>
                                Назад
                            </button>
                        </div>
                    </div>

                </div>

                </div>

            </div>
        </div>
    </div>
</div>

@include('auth.partials.restaurants')

<style>
[aria-pressed="true"] {
  box-shadow: inset 0 0 0 0.15rem #000, inset 0.25em 0.25em 0 #fff;
}
</style>

<script>
function PasswordReveal(input) {
  // store input as a property of the instance
  // so that it can be referenced in methods
  // on the prototype
  this.input = input;
  this.createButton();
};

var passwordReveal1 = new PasswordReveal(document.getElementById('password'));
var passwordReveal2 = new PasswordReveal(document.getElementById('password-confirm'));

PasswordReveal.prototype.createButton = function() {
  // create a button
  this.button = $('<button type="button">Show password</button>');
  // inject button
  $(this.input).parent().append(this.button);
  // listen to the button’s click event
  this.button.on('click', $.proxy(this, 'onButtonClick'));
};

PasswordReveal.prototype.onButtonClick = function(e) {
  // Toggle input type and button text
  if(this.input.type === 'password') {
    this.input.type = 'text';
    this.button.text('Hide password');
  } else {
    this.input.type = 'password';
    this.button.text('Show password');
  }
};
</script>
@endsection
