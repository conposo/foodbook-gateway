
<header class="restaurant_header position-relative d-flex justify-content-center align-items-end" style="
            z-index: 2;
    ">
    <div class="">
        <h1 class="display-inline-block text-uppercase text-center">
            @if( Auth::id() == 1 || Auth::id() == 2 )
            <a href="/restaurant/{{ $restaurant['slug'] }}/settings">
            @endif
                <span itemprop="name" class="d-block pt-4 pt-sm-5 restaurant_header_name">{!! $restaurant['business_name'] !!}</span>
            @if( Auth::id() == 1 || Auth::id() == 2 )
            </a>
            @endif
        </h1>
    </div>
</header>

<style>
    header.restaurant_header {
        margin-top: -50px;
    }
    header.restaurant_header > div {
        min-width: 75%;
    }
    h1 {
        padding-top: 3px;
        border-top: 1px solid rgba(255, 250, 238, 0.25);
        box-sizing: content-box;
        background-clip: content-box;
    }
    .restaurant_header_name {
        padding-left: 1.3rem!important;
        padding-right: 1.3rem!important;
        font-size: 28px;
        font-family: cheque;
        letter-spacing: 5px;
        color: rgba(0, 0, 0, 0.5);
        background-color: #fffaee;
        background-color: #fffcf4;
    }
    @media (min-width: 768px) {
        h1 {
            padding-top: 5px;
        }
        header.restaurant_header {
            margin-top: -100px;
        }
    }
    @media (min-width: 1024px) {
        header.restaurant_header {
            margin-top: -100px;
        }
        header.restaurant_header > div {
            max-width: 75%;
        }
    }
    @media (min-width: 768px) {
        .restaurant_header_name {
            padding-left: 3rem!important;
            padding-right: 3rem!important;
            font-size: 52px;
            letter-spacing: 10px;
        }
    }
    @media (min-width: 1024px) {
        .restaurant_header_name {
            padding-left: 100px !important;
            padding-right: 100px !important;
            font-size: 78px;
        }
    }
    }
    @media (min-width: 1280px) {
        .restaurant_header_name {
            font-size: 104px;
        }
    }
</style>