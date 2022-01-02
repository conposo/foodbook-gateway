
<div class="modal fade" id="reservation" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form action="{{ route('reservation-new') }}" method="POST">
            @csrf
            
            <input type="hidden" name="restaurant_id" id="restaurant_id" value="{{ $restaurant['id'] }}">

            <div class="modal-header">
                <span class="d-flex align-items-center">
                    <i class="far fa-calendar-alt"></i>
                    <span class="mx-2">Нова резервация</span>
                    <span class="new-reservation-date" style="color:brown;"></span>
                </span>
                <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-5">
                <div id="carouselReservation" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner pb-5">

<!-- carousel-item -->
                        <div class="carousel-item active">
                            <label class="d-block mx-2 mb-3 font-weight-bold">Избери дата</label>
                            <div class="" id="reservation_calendar">
                            </div>
                            <input type="hidden" name="date" id="date">
                        </div>

<!-- carousel-item -->
                        <div class="carousel-item">
                            <div class="w-75 w-md-50 h-100 d-flex align-items-center mx-auto">
                                <div class="w-50 form-group mr-3">
                                    <label for="set_hour"class="align-items-center d-flex font-weight-bold justify-content-start mx-1">
                                        Час
                                        <i class="ml-1 fas fa-hourglass-start"></i>
                                    </label>
                                    <select class="form-control" id="set_hour" name="hour">
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option selected>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                    </select>
                                </div>
                                <div class="w-50 form-group">
                                    <label for="set_minutes"class="align-items-center d-flex font-weight-bold justify-content-start mx-1">
                                        Минути
                                        <i class="ml-1 fas fa-hourglass-end"></i>
                                    </label>
                                    <select class="form-control" id="set_minutes" name="minutes">
                                        <option selected>00</option>
                                        <option>30</option>
                                    </select>
                                </div>
                            </div>
                        </div>

<!-- carousel-item -->
                        <div class="carousel-item">
                            <div class="w-50 h-100 d-flex align-items-center mx-auto">
                                <div class="w-100 form-group">
                                    <label for="number_of_people" class="align-items-center d-flex font-weight-bold justify-content-between mx-1">
                                        Брой души
                                        <i class="ml-2 fas fa-users"></i>
                                    </label>
                                    <select class="form-control" id="number_of_people" name="total_guests">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option selected>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                    </select>
                                </div>
                            </div>
                        </div>

<!-- carousel-item -->
                        <div class="carousel-item">
                            <div class="w-50 h-100 d-flex align-items-center mx-auto">
                                <div class="w-100 form-group">
                                    <label class="d-block mx-2 mb-3 font-weight-bold">Ти ще присъстваш ли</label>
                                    <label for="yes">
                                        <input type="radio" id="yes" name="user_id" value="1" checked> Да
                                    </label>
                                    <label for="no">
                                        <input type="radio" id="no" name="user_id" value="0"> Не
                                    </label>
                                </div>
                            </div>
                        </div>

<!-- carousel-item -->
                        <div class="carousel-item">
                            <div class="h-100 d-flex align-items-center">
                                <div class="d-flex-column mx-auto">
                                    <h6 class="pt-4 pb-1 mb-1 font-weight-normal">Твоята резервация:</h6>
                                    <table class="table mb-3">
                                        <tr>
                                            <td class="pl-0 pb-1 font-weight-bold">Организатор</td>
                                            <td class="pr-0" id="preview-organizer">Ти</td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 pb-1 font-weight-bold">Дата</td>
                                            <td class="pr-0" id="preview-date"></td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 pb-1 font-weight-bold">Брой души</td>
                                            <td class="pr-0" id="preview-people"></td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 pb-1 font-weight-bold">Час</td>
                                            <td class="pr-0" id="preview-hour"></td>
                                        </tr>
                                    </table>
                                    <button class="make-reservation btn btn-outline-dark d-block mx-auto" type="submit">
                                        Направи резервацията
                                        <i class="ml-1 far fa-thumbs-up"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

<!-- END carousel-items -->

                        <ol class="carousel-indicators py-3" style="
                                margin-bottom: 0px;
                            ">
                            <li style="cursor:default;" data-target="_carouselReservation" data-slide-to="0" class="active"></li>
                            <li style="cursor:default;" data-target="_carouselReservation" data-slide-to="1"></li>
                            <li style="cursor:default;" data-target="_carouselReservation" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>                

                <a class="carousel-control-prev d-none p-3" href="#carouselReservation" role="button" data-slide="prev" style="
                        top: auto;
                        bottom: 8px;
                        color: #000;
                        left: 20px;
                    ">
                    <span class="" aria-hidden="true">
                        <i class="far fa-hand-point-left"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>
                <a class="carousel-control-next p-3" href="#carouselReservation" role="button" data-slide="next" style="
                        top: auto;
                        bottom: 8px;
                        color: #000;
                        right: 20px;
                    ">
                    <span class="button" aria-hidden="true" style="
                            font-size: 20px;
                        ">
                        <!-- <i class="fas fa-arrow-right"></i> -->
                        <i class="far fa-hand-point-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </form>
    </div>
  </div>
</div>

<style>
.ui-datepicker {
    margin-left: auto;
    margin-right: auto;
    /* width: 100%; */
}

.carousel-item {
    height: 290px;
}

.carousel-indicators li {
    background-color: rgb(233, 233, 233);
}
.carousel-indicators .active {
    background-color: #777;
}
</style>
<script>
$(document).ready(function() {
    var today = new Date();
    var d = today.getDate();
    var m = today.getMonth()+1; //January is 0!
    var Y = today.getFullYear();
    var h = today.getHours();
    var min = today.getMinutes();
    
    $('#date').val(`${Y}-${m}-${d}`);

    (h > 23) ? minDate = 1 : minDate = 0;

    $('#carouselReservation').on('slide.bs.carousel', function (e) {
        // do something…
        console.log(e.to+1);
        if( (e.to+1) == 1 ) {
            $('.carousel-control-prev').addClass('d-none');
        }
        if( (e.to+1) == 2 ) {
            $('.carousel-control-prev').removeClass('d-none');
        }
        if( (e.to+1) == 5 ) {
            $('#preview-people').text( $('#number_of_people').val() );
            $('#preview-hour').text( $('#set_hour').val()+':'+$('#set_minutes').val() );
            $('.carousel-control-next').addClass('d-none');
        } else {
            $('.carousel-control-next').removeClass('d-none');
        }
    })

    $( "#reservation_calendar" ).datepicker({
        minDate: minDate,
        onSelect: function(dateText){
            console.log(dateText);
            $('#date').val(dateText);

            // var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            // $('.new-reservation-date').text(dateText.toLocaleString('bg-BG', options));

            var options1 = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var dateTimeFormat1 = new Intl.DateTimeFormat('bg-BG', options1);

            formated_date = dateTimeFormat1.format(new Date(dateText));
            $('.new-reservation-date').text(formated_date);
            $('#preview-date').text(formated_date);
        }
    });
})
$(function() {
});

function formatDate() {

}

</script>