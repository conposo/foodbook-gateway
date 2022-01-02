
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-lg-8 pt-lg-5 px-lg-5 mx-auto">
                <h5 class="d-flex justify-content-between btn-sm rounded-0 pl-0 text-black-50  border-bottom text-uppercase font-weight-normal"  style="margin-left:-15px; margin-right:-15px;">
                    <span class="_font-weight-bold">
                        За контакти
                    </span>                 
                </h5>
                <style>
                    div.footer > a {
                        position: relative;
                        white-space: nowrap;
                        overflow: hidden;
                    }
                    div.footer > .a:after {
                        content: '';
                        position: absolute;
                        z-index: 0;
                        top: 0;
                        right: 0;
                        bottom: 0;
                        display: block;
                        width: 10px;
                        background: -moz-linear-gradient(left, rgba(255,250,239,0) 0%, rgba(255,250,239,1) 100%);
                        background: -webkit-linear-gradient(left, rgba(255,250,239,0) 0%,rgba(255,250,239,1) 100%);
                        background: linear-gradient(to right, rgba(255,250,239,0) 0%,rgba(255,250,239,1) 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00fffaef', endColorstr='#fffaef',GradientType=1 );
                    }
                    div.footer i {
                        font-size: 18px;
                    }

                    @media (min-width: 1024px) {
                        div.footer > a {
                            max-width: 25%;
                        }
                    }
                </style>
                <span itemscope itemtype="https://schema.org/Organization">
                <div class="footer d-block d-md-flex justify-content-between "  style="margin-left:-15px; margin-right:-15px;">
                    @php
                    $items = explode(';', $restaurant['phone']);
                    @endphp
                    @if( count($items) > 1 )
                        <a class="_w-100 d-block d-md-flex align-items-center text-dark mr-1" href="tel:{{ $items[0] }}" target="_blank">
                            <span itemprop="telephone">
                                <i class="fas fa-phone-square mr-2 mr-md-1" style="color:#34a853;"></i>
                                {{ trim( $items[0] ) }}
                            </span>
                        </a>
                    @elseif( $restaurant['phone'] )
                        <a class="_w-100 d-block d-md-flex align-items-center text-dark mr-1" href="tel:{{ $restaurant['phone'] }}" target="_blank">
                            <span itemprop="telephone">
                                <i class="fas fa-phone-square mr-2 mr-md-1" style="color:#34a853;"></i>
                                {{ $restaurant['phone'] }}
                            </span>
                        </a>
                    @endif
                    @if($restaurant['email'])
                        <a class="_w-100 d-block d-md-flex align-items-center text-dark mr-1" href="mailto:{{ $restaurant['email'] }}" target="_blank">
                            <span itemprop="email">
                                <i class="fas fa-envelope mr-1" style="color:#166a8f;"></i>
                                {{ $restaurant['email'] }}
                            </span>
                        </a>
                    @endif
                    @if($restaurant['website'])
                        <a itemprop="url" class="_w-100 d-block d-md-flex align-items-center text-dark mr-1" href="//{{ $restaurant['website'] }}" target="_blank">
                            <i class="fas fa-globe mr-1" style="color:#8a7967;"></i>
                            {{ $restaurant['website'] }}
                        </a>
                    @endif
                    @if( $restaurant['fb_page'] != 'fb.com' && $restaurant['fb_page'] != '' )
                        <a itemprop="sameAs" class="_w-100 d-block d-md-flex align-items-center text-dark mr-1" href="//fb.com/{{ $restaurant['fb_page'] }}" target="_blank">
                            <i class="d-none fab fa-facebook-square mr-1" style="color:#3b5998;"></i>
                            <i class="fas fa-comment mr-1" style="color:#3b5998;"></i>
                            {{ $restaurant['fb_page'] }}
                        </a>
                    @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
