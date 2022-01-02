
    <section id="intro" class="position-relative mx-auto col-12 col-md-10 col-lg-8 col-xl-6">
        <style>
            .bg_name {
                font-family: cheque-black;
            }

            .main-image {
                width: 100%;
            }

            #intro {
                min-height:calc( 100vh - 116px );
            }

            @media screen and (min-width: 1024px) {
                .main-image {
                    float: left;
                    width: 200px;
                }

                #intro {
                    height:calc( 100vh - 116px );
                }
            }

            .next-section {
                width: 30px;
                font-size: 28px;
                left: calc(50% - 15px);
                bottom: 200px;
            }
        </style>
        <h1 class="mt-0 mt-md-5 mb-5 text-uppercase text-center"
            style="
                margin-top: _80px;
                font-size: 38px;
                font-weight: 400;
                line-height: 1;
                color: #777;
                /* text-shadow: 0 0 5px rgba(0, 0, 0, 0.25); */
            ">
            <?php
            // dd($dish);
            ?>
            @if(Auth::id() == 1 || Auth::id() == 2)
            <a class="text-dark" href="{{ route('recipe-edit', ['dish_type' => ((isset($dish['owner_type'])) ? $dish['owner_type'] : 'S'), 'dish_slug' => $dish['slug']]) }}">
            @endif
                <span itemprop="name" class="bg_name">{{ $dish['bg_name'] }}</span>
            @if(Auth::id() == 1 || Auth::id() == 2)
            </a>
            @endif
        </h1>
        <p class="border p-3 text-justify">
            <img itemprop="image" src="{{ Storage::url('images/dishes/'.$dish['slug'].'/main.jpeg') }}" alt="" class="main-image mr-3 mb-1">
            @if($dish['description'])
            <span itemprop="description">{{ $dish['description'] }}</span>
            @else
            За {{ $dish['bg_name'] }} все още не сме нагласили подобаващо описание. Вероятно е това да се случи в идните дни
            но ако не ти се чака можеш да ни изпратиш <b>описание за {{ $dish['bg_name'] }}</b> на имейла. Благодарим ти!
            Не е изключено същото да се отнася и за <b>рецептата за {{ $dish['bg_name'] }}</b> и необходимите продукти за приготвянето.
            <br>Благодарим за разбирането!
            @endif
        </p>
        <a class="d-none d-md-block next-section position-absolute text-dark" href="#">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>