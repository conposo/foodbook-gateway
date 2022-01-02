
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 pt-lg-5 px-lg-5 mx-auto">
                <h5 class="d-flex justify-content-between mb-2 btn-sm rounded-0 pl-0 text-black-50 text-uppercase font-weight-normal"  style="margin-left:-15px; margin-right:-15px;">
                    <span>
                        Местоположение <span style="color:#ff9a60;">{{$restaurant['city']}}</span>
                    </span>
                    <a style="color:#ff9a60;" href="https://www.google.com/maps/dir/?api=1&destination={{$restaurant['lat']}}%2C{{$restaurant['lng']}}" target="_blank">
                        упътвания
                        <i class="ml-1 fas fa-directions"></i><i class="d-none ml-2 fas fa-map-signs"></i>
                    </a>                    
                </h5>
            </div>
        </div>
    </div>
    <div class="map mb-0 5 py-2 position-relative" id="resizable">
        <div id="map" class="h-100"></div>
        <div id="handle" class="d-block w-100"></div>
    </div>
    <script>
    function initMap() {
        var uluru = {lat: {{$restaurant['lat']}}, lng: {{$restaurant['lng']}}};
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 17, center: uluru}
        );
        var marker = new google.maps.Marker({position: uluru, map: map});
    }
    $(function() {
        $("#resizable").resizable({
            handles: {'s': '#handle'},
            containment: "body",
            minWidth: $('html').width()
        });
    });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('MAPS_API_KEY')}}&callback=initMap">
    </script>
