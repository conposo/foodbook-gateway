
<div class="mb-5 @if(isset($_GET['location'])) set_location bg-light p-2 p-md-3 @else pb-2 _border-bottom @endif">
    <h5 class="mt-2 mb-1">Предпочитания за показване на резултати</h5>
    @if( $GLOBALS['set_to_auto'] )
        <small class="d-block">Текущото местоположение е зададено на <i>автоматично</i>. <b>Изключи</b> за ръчно настройване. </small>
    @elseif( $GLOBALS['city'] )
        <small class="d-block">Текущото местоположение е зададено на <i>ръчно</i>. <b>Включи</b> за автоматично. </small>
    @else
        <small class="d-block">Текущото местоположение не е зададено.</small>
    @endif
    <div class="mt-1 pt-2">
        <div class="d-flex flex-column flex-md-row justify-content-start align-items-center">
            <div class="d-flex flex-row my-md-3 justify-content-between justify-content-md-start align-items-center mr-md-3">
                <span class="@if( $GLOBALS['set_to_auto'] ) font-weight-bold @endif">
                    Автоматично
                </span>
                @if( $GLOBALS['set_to_auto'] )
                <span class="my-2" style="color: brown;">
                    <span class=" _label mr-1">Показва резултати за</span>
                    <span class="font-weight-bold text-uppercase">
                        {{ $GLOBALS['city'] }}
                    </span>
                </span>
                @endif
                <span class="mx-2">
                    <form id="form_location_switcher" action="" method="GET">
                        <label class="switch m-0">
                            <input type="hidden"  name="location_switcher" @if(!!!\Illuminate\Support\Facades\Cookie::get('location')) value="auto" @else value="manual" @endif>
                            <input id="location" type="checkbox" @if( $GLOBALS['set_to_auto'] ) checked @endif>
                            <span class="slider round"></span>
                        </label>
                    </form>
                </span>
                <span class="@if( ! $GLOBALS['set_to_auto'] ) font-weight-bold @endif">
                    @if( ! $GLOBALS['set_to_auto'] )
                        Ръчно
                    @elseif( $GLOBALS['set_to_auto'] )
                        Задай локация
                    @else
                        Няма зададена локация
                    @endif
                </span>
            </div>
            @if( !$GLOBALS['set_to_auto'] )
                <div class="my-2" style="color: brown;">
                    <span class=" _label mr-1">Показва резултати за</span>
                    <span class="font-weight-bold text-uppercase">
                        {{ $GLOBALS['city'] }}
                    </span>
                </div>
                <span class="ml-md-3 py-0 px-1 btn btn-sm btn-outline-dark" onclick="$('#showLocations').modal('show')">промени</span>
            @else
                <span class="ml-md-3 py-0 px-1 btn btn-sm btn-outline-dark" onclick="$('#showLocations').modal('show')">избери локация</span>
            @endif
        </div>
    </div>
    <h5 class="mt-2 mb-1">Предпочитания за обсег за показване на резултати</h5>
    <small class="d-block">Настройки на обсега за показване на предложения от заведенията</small>
    <div class="d-flex flex-column flex-md-row">
    <a href="?range=1" class="text-dark">1 километър</a>
    <a href="?range=2" class="text-dark mx-md-3">2 километра</a>
    <a href="?range=3" class="text-dark">3 километра</a>
    </div>
</div>

<script>
    $(document).mouseup(function(e) {
        var container = $('.set_location');

        // if the target of the click isn't the container nor a descendant of the container
        if ( !container.is(e.target) && container.has(e.target).length === 0)  
        {
            container.addClass('pb-2 _border-bottom').removeClass('set_location bg-light p-2 p-md-3');
            $('._mb-5').removeClass('_mb-5');
        }
    });

    jQuery(function ($) {
        $('#location').change(function (e) {

            if( $(this).is(':checked') ) {
                var options = {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                };
                navigator.geolocation.getCurrentPosition(function(position) {
                    console.log(position.coords.latitude, position.coords.longitude);
                    var latitude  = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    window.location='?lat='+latitude+'&long='+longitude;

                }, error, options);
                setTimeout(function() {
                    $('.my_loader').toggleClass('d-none')
                }, 400)
            } else {
                $('#showLocations').modal('show')
            }

            $('#showLocations').on('hidden.bs.modal', function (e) {
                $('#location').prop('checked', true)
            })
        })

    })
    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    }
</script>
<!-- 
<script>

    function addUserLocation() {
        jQuery('#set_position .loading').removeClass('d-none');
        if (navigator.geolocation) {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };
            navigator.geolocation.getCurrentPosition(function (pos) {
                console.log(pos.coords.latitude, pos.coords.longitude);
            }, error, options);
        }
        else {
            displayError("Трябва ви по-нова версия на браузъра за да използвате геолокация.");
        }
    }

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    }

    function displayError(msg) {
        alert(msg);
    }

</script> -->