
<?php
// dd($dishes);
?>
@foreach($dishes as $dish)
    @if(is_array($dish))
        <div class="position-relative" style="height:150px; overflow:hidden;
            border-left: 2px solid transparent;
            border-right: 2px solid transparent;
            ">
            <img class="w-100 position-absolute top-0 start-0" data-lazy="/storage/images/dishes/{{ $dish['slug'] }}/main.jpeg"/>
            <a style="z-index: 1; text-shadow: 0 0 12px #000;" class="d-flex justify-content-center align-items-center text-decoration-none position-absolute top-0 start-0 w-100 h-100 text-white text-center" href="{{ route('dish', $dish['slug']) }}">
                <span class="position-absolute top-0 end-0 pe-1 small"><i class="fas fa-external-link-alt"></i></span>
                <span style="font-size: 20px;">{{ $dish['bg_name'] }}</span>
            </a>
        </div>
    @endif
@endforeach
