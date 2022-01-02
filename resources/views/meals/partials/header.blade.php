    <?php
    $hour = 0;

    switch($meal_slug_title[0])
    {
        case 'breakfast':
            $hour = 5;
        break;
        case 'lunch':
            $hour = 11;
        break;
        case 'dinner':
            $hour = 17;
        break;
    }

    ?>

    <div class="mb-3 py-2 pt-3 border-bottom d-flex justify-content-between align-items-end">
        <span>
            @if( $GLOBALS['isHousehold'] )
                <a class="d-flex text-black-50" href="@if(!isset($_GET['user_type']))?user_type=user @elseif( Request::is('/') ) / @else /{{$meal_slug_title[0]}} @endif">
                    <span class="text-black-50 mx-1 meal_title">{{$meal_slug_title[1]}}</span>
                    <sup>
                        <span style="@if(isset($_GET['user_type'])) opacity: 0.5; @endif">
                            <i class="fas fa-users" style="font-size: 18px;"></i>
                        </span>
                    </sup>
                </a>
            @else
                <span class="d-flex text-black-50 mx-1 meal_title">{{$meal_slug_title[1]}}</span>
            @endif
        </span>

        @if( Request::is('/') )
            <a class="text-black-50" href="{{ route($meal_slug_title[0]) }}@if(isset($_GET['user_type']))?user_type=user @endif">
                <i class="far fa-hand-point-right"></i>
            </a>
        @elseif( !Request::is('/') )
            <a class="d-flex pl-1 btn btn-link btn-sm text-black-50" href="{{ route('list-daily') }}" style="font-size: 26px;">
                @if( $GLOBALS['is_list'] || Request::is('list/daily') )
                <i class="fas fa-clipboard-list"></i>
                @else
                <i class="far fa-clipboard"></i>
                @endif
            </a>
        @endif
    </div>
