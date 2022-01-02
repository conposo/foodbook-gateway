<?php
$is_today = '';
$is_tomorrow = '';
$is_this_week = ' text-black-50';

if( ( isset($_GET['date']) && $_GET['date'] == $GLOBALS['tomorrow']->format('Y-m-d') ) || ( !isset($_GET['date']) && Cookie::get('date') == $GLOBALS['tomorrow']->format('Y-m-d') ) )
{
    $is_tomorrow = 'text-dark font-weight-bold';
    $is_today = ' text-black-50';
}
else if( ( isset($_GET['date']) && $_GET['date'] == date('Y-m-d') ) || ( !isset($_GET['date']) && Cookie::get('date') == date('Y-m-d') ) )
{
    $is_today = ' text-dark font-weight-bold';
    $is_tomorrow = ' text-black-50';
}
else
{
    $dt_min = new DateTime("last saturday");
    $dates = [];
    for($i = 1; $i < 8; $i++)
    {
        $dt_min->modify('+1 day');
        $dates[] = $dt_min->format('Y-m-d');
        if(
            (
                isset($_GET['date']) && 
                $_GET['date'] == $dt_min->format('Y-m-d') &&
                $_GET['date'] != Cookie::get('date')
            )
            ||
            (
                !isset($_GET['date']) && 
                Cookie::get('date') == $dt_min->format('Y-m-d')
            )
        )
        {
            $is_today = ' text-black-50';
            $is_tomorrow = ' text-black-50';
            $is_this_week = ' text-dark font-weight-bold';
        }
    }
}
?>
<div class="sticky-top"  style="
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: floralwhite;
    ">
    <div class="@if(!\Request::is('restaurant/*')) mb-5 @endif @if(\Request::is('restaurant/*/*')) mb-5 @endif">

        <div class="d-flex justify-content-center align-items-center">

            <a style="font-size:0.8rem;" class="d-none w-md-25 _d-flex justify-content-start align-items-center btn btn-link btn-lg text-black-50 ml-0 pl-0 my-0 py-0" onclick="window.history.back();">
                <i class="d-none fas fa-chevron-left"></i>
                <span class="d-none _d-md-inline-block ml-1 text-capitalize" style="font-weight:500;">назад</span>
            </a>

            <div class="d-flex mx-auto justify-content-center align-items-center">
                <span onclick="$('qbody').toggleClass('stop-scrolling'); $('q#mainNavDate').toggle();">
                    <button type="button" class="btn btn-link btn-sm text-dark font-weight-bold text-capitalize" data-toggle="modal" data-target="#showMainNav">
                        {{$GLOBALS['date_formatted']}}
                        <i class="ml-1 fas fa-angle-down"></i>
                    </button>
                </span>
            </div>

            <div class="d-none w-md-25 _d-flex justify-content-end align-items-center font-weight-light">
                @guest
                @else
                @endguest
            </div>

        </div>

    </div>
</div>

<script>
$( "input[type='text']" ).change(function() {
    $( "#date" ).submit();
});

/* Bulgarian initialisation for the jQuery UI date picker plugin. */
/* Written by Stoyan Kyosev (http://svest.org). */
( function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		// AMD. Register as an anonymous module.
		define( [ "../widgets/datepicker" ], factory );
	} else {

		// Browser globals
		factory( jQuery.datepicker );
	}
}( function( datepicker ) {

datepicker.regional.bg = {
	closeText: "затвори",
	prevText: "&#x3C;назад",
	nextText: "напред&#x3E;",
	nextBigText: "&#x3E;&#x3E;",
	currentText: "днес",
	monthNames: [ "Януари","Февруари","Март","Април","Май","Юни",
	"Юли","Август","Септември","Октомври","Ноември","Декември" ],
	monthNamesShort: [ "Яну","Фев","Мар","Апр","Май","Юни",
	"Юли","Авг","Сеп","Окт","Нов","Дек" ],
	dayNames: [ "Неделя","Понеделник","Вторник","Сряда","Четвъртък","Петък","Събота" ],
	dayNamesShort: [ "Нед","Пон","Вто","Сря","Чет","Пет","Съб" ],
	dayNamesMin: [ "Не","По","Вт","Ср","Че","Пе","Съ" ],
	weekHeader: "Wk",
	dateFormat: "dd.mm.yy",
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: "" };
datepicker.setDefaults( datepicker.regional.bg );

return datepicker.regional.bg;

} ) );
</script>

<!-- Modal -->
<div class="modal fade" id="showMainNav" tabindex="-1" role="dialog" aria-labelledby="showMainNavLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showMainNavLabel">Основна навигация</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0 pb-3">

        <div class="border-bottom mb-3 px-1 pt-3 pb-2" style="background-color: cornsilk;">
            <span class="d-block text-center mb-1" style="font-size: 0.85rem;">
                    <a class="d-block" href="/" style="">
                        <span class="d-block text-black-50">Виж менюто за</span>
                        <i>
                            <span class="d-block text-center text-capitalize" style="margin-top: -5px; color:brown;">{{$GLOBALS['date_formatted']}}<sup><small><i class="ml-1 text-dark fas fa-external-link-alt"></i></small></sup></span>
                        </i>
                    </a>
            </span>
            <div class="d-flex justify-content-center">
                <a class="text-black-50" href="/breakfast">
                    <span class="meal_title" style="font-family: cheque-black; font-weight: bold;">Закуска</span>
                    <i class="far fa-hand-point-right"></i>
                </a>
                <a class="mx-4 text-black-50" href="/lunch">
                    <span class="meal_title" style="font-family: cheque-black; font-weight: bold;">Обяд</span>
                    <i class="far fa-hand-point-right"></i>
                </a>
                <a class="text-black-50" href="/dinner">
                    <span class="meal_title" style="font-family: cheque-black; font-weight: bold;">Вечеря</span>
                    <i class="far fa-hand-point-right"></i>
                </a>
            </div>
        </div>
        
        <span class="d-block text-center _font-weight-bold" style="color:brown;">Избери друг ден</span>
        <div class="mt-1 mb-3" id="main_calendar">
        </div>

      </div>

      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary-outline" data-dismiss="modal">Затвори</button>
      </div> -->
    </div>
  </div>
</div>
