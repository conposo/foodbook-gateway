
    <nav class="mx-auto py-3 px-0 @guest flex-column @endguest flex-md-row navbar navbar-light"
        style="
            _background-color: #f2f2f2;
            _background-color: floralwhite;
        ">
        <script>
        function GoBackWithRefresh(event) {
            if ('referrer' in document) {
                window.location = document.referrer;
                /* OR */
                //location.replace(document.referrer);
            } else {
                window.history.back();
            }
        }
        </script>
        <!-- Left Side Of Navbar -->
        <ul class="custom_w-25 d-md-flex navbar-nav @guest d-none @endguest" >
            <li class="nav-item dropdown">
                <button class="btn btn-link text-dark px-2 py-0 border-0" type="button"
                    onclick="GoBackWithRefresh();return false;">
                    <i class="fas fa-chevron-left"></i>
                    <span class="d-none ml-1 text-capitalize">назад</span>
                </button>
                <!-- fas fa-crosshairs -->
            </li>
        </ul>

        <a class="m-0 d-block navbar-brand text-center" href="{{ url('/') }}{{ (isset($isHousehold) && $isHousehold)? '?household=true': ''}}" style="font-size:42px;line-height:42px;">
            <div class="mx-auto" style="overflow:hidden; width:205px;">
                <img class="d-block" src="/images/other/logo.png" alt="Foodbook Logo" style="max-width:100%; _margin-top:-25px; _margin-bottom:-20px;">
            </div>
            <span class="d-none">
                <span style="font-weight:300;">food</span><span style="font-weight:500;">book</span>
                <span>BETA</span>
            </span>
        </a>

        <!-- Right Side Of Navbar -->
        <ul class="custom_w-25 navbar-nav flex-row @guest justify-content-center @else justify-content-end @endguest">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item mr-3">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                    @endif
                </li>
            @else
                <li class="d-flex nav-item dropdown">
                    <button class="btn btn-link text-dark px-2 py-0 border-0 hamburger" type="button"
                        onclick="
                            $('body').toggleClass('stop-scrolling');
                            $('#mainNav').toggle();
                            ($('.hamburger i').attr('class') == 'fas fa-bars') ?
                                $('.hamburger i').attr('class', 'fas fa-times') :
                                $('.hamburger i').attr('class', 'fas fa-bars')"
                        style="
                            z-index: 1022;
                            position: relative;
                            opacity: 0.75;">
                        <span class="d-none mr-1 text-capitalize">Меню</span>
                        <i class="fas fa-bars"></i>
                    </button>
                    <div id="mainNav" class="pt-2 px-2 position-fixed"
                        style="
                            display: none;
                            overflow: auto;
                            z-index: 1021;
                            top: 0px;
                            right: 0px;
                            left: 0px;
                            bottom: 0px;
                            background-color: floralwhite;
                        ">
                        <div class="">
                            <div class="nav_container">
                                <label class="d-block mx-2 mb-0 border-bottom font-weight-bold mb-1"><i class="fas fa-book-open"></i> МЕНЮ</label>
                                <a class="btn-sm d-flex w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('home') }}">
                                    Дневно
                                </a>
                                <a class="disabled btn btn-sm border-0 d-flex w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('weekly') }}">
                                    Седмично
                                    <sup class="ml-1"><i class="fas fa-info-circle"></i></sup>
                                </a>
                                <a class="disabled btn btn-sm border-0 d-flex w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('monthly') }}">
                                    Месечно
                                    <sup class="ml-1"><i class="fas fa-info-circle"></i></sup>
                                </a>

                                <label class="d-block mx-2 mt-3 mb-0 border-bottom font-weight-bold mb-1"><i class="fas fa-clipboard-list"></i> СПИСЪК ЗА ПАЗАРУВАНЕ</label>
                                <a class="btn-sm d-flex w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('list-daily') }}">
                                    Дневен
                                </a>
                                <a class="btn-sm d-flex w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('list-weekly') }}">
                                    Седмичен
                                </a>
                                <a class="btn-sm d-flex w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('list-monthly') }}">
                                    Месечен
                                </a>

                                <!-- <label class="d-block mx-2 mt-3 mb-0 border-bottom font-weight-bold">СПИСЪК ЗА ПАЗАРУВАНЕ</label> -->
                                
                                <label class="d-block mx-2 mt-3 mb-0 border-bottom font-weight-bold mb-1">ДРУГИ</label>
                                <a class="btn-sm d-block w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('recipes') }}">
                                    <i class="mr-1 fas fa-book"></i>
                                    Моите рецепти
                                </a>
                                <a class="btn-sm d-block w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('reservations') }}">
                                    <i class="mr-1 far fa-calendar-alt mr-1"></i>
                                    Моите резервации
                                </a>
                                <a class="btn-sm d-block w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('household') }}">
                                    <i class="fas fa-users"></i>
                                    Домакинство
                                </a>
                                <a class="btn-sm d-block w-100 px-2 py-1 text-uppercase text-dark" href="{{ route('settings') }}">
                                    <i class="mr-1 fas fa-sliders-h"></i>
                                    Настройки
                                </a>
                                <a class="border-top mt-3 pt-3 btn-sm d-block w-100 px-2 pb-5 text-uppercase text-dark" href="{{ route('settings') }}?location=1#setlocation_position">
                                <i class="mr-1 fas fa-crosshairs"></i>
                                    Местоположение
                                </a>

                                <a class="mb-3 _d-flex float-right py-0 btn btn-outline-dark text-uppercase _position-fixed" href="{{ route('logout') }}"
                                    style="bottom:10px; right:10px;"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <!-- {{ __('Logout') }} -->
                                    Изход <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
