@if( false )
<script>
    $(document).ready(function() {

    })
</script>
@endif

<div class="modal fade" id="showLocations" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="_modal-header">
                <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-5 pb-5">
                <?php $i=0; ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <!-- <a href="?location_switcher=manual&city=sofia&lat=42.698334&long=23.319941"> -->
                        <a class="d-block text-dark" href="?location_switcher=manual&city=sofia">
                            <span class="text-uppercase">София
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <!-- <a href="?location_switcher=manual&city=plovdiv&lat=42.136097&long=24.742168"> -->
                        <a class="d-block text-dark" href="?location_switcher=manual&city=plovdiv">
                            <span class="text-uppercase">Пловдив
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <!-- <a href="?location_switcher=manual&city=varna&lat=43.204666&long=27.910543"> -->
                        <a class="d-block text-dark" href="?location_switcher=manual&city=varna">
                            <span class="text-uppercase">Варна
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <!-- <a href="?location_switcher=manual&city=burgas&lat=42.510578&long=27.461014"> -->
                        <a class="d-block text-dark" href="?location_switcher=manual&city=burgas">
                            <span class="text-uppercase">Бургас
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <!-- <a href="?location_switcher=manual&city=ruse&lat=43.835571&long=25.965654"> -->
                        <a class="d-block text-dark" href="?location_switcher=manual&city=ruse">
                            <span class="text-uppercase">Русе
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Blagoevgrad">
                            <span class="text-uppercase">Благоевград
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Stara Zagora">
                            <span class="text-uppercase">Стара загора
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Veliko Tarnovo">
                            <span class="text-uppercase">Велико Търново
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Gabrovo">
                            <span class="text-uppercase">Габрово
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Botevgrad">
                            <span class="text-uppercase">Ботевград
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Pleven">
                            <span class="text-uppercase">Плевен
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="d-block text-dark" href="?location_switcher=manual&city=Sinemorets">
                            <span class="text-uppercase">Синеморец
                                <i class="far fa-hand-point-right"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
