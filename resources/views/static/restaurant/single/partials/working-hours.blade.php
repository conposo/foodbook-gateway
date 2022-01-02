
    <h5 class="d-flex justify-content-between align-items-end align-items-md-center btn-sm rounded-0 px-0 text-black-50 border-bottom text-uppercase font-weight-normal" style="margin-left:-15px; margin-right:-15px;">
        <span class="">
            Работно време
        </span>
    </h5>
    <?php
    $worktime = json_decode($restaurant['worktime'], true);
    ?>
    <div class="" style="margin-left:-15px; margin-right:-15px;">
        <div class="d-flex flex-wrap justify-content-between align-items-center font-weight-bold text-black-50">
            <?php
            foreach($days as $day => $bg_day)
            {
                ($bg_day == mb_strtolower($GLOBALS['today_formatted'])) ? $today = 'font-weight-bold text-dark' : $today = '';

                // switch($bg_day)
                // {
                //     case 'понеделник':
                //         $bg_day = 'Пн.';
                //         break;
                //     case 'вторник':
                //         $bg_day = 'Вт.';
                //         break;
                //     case 'сряда':
                //         $bg_day = 'Ср.';
                //         break;
                //     case 'четвъртък':
                //         $bg_day = 'Чтв.';
                //         break;
                //     case 'петък':
                //         $bg_day = 'Пт.';
                //         break;
                //     case 'събота':
                //         $bg_day = 'Сб.';
                //         break;
                //     case 'неделя':
                //         $bg_day = 'Нд.';
                //         break;
                // }
                ?>


                <div itemprop="openingHoursSpecification" itemtype="http://schema.org/OpeningHoursSpecification" class="d-flex-column mb-3 mr-4 mr-md-0">
                    <link itemprop="dayOfWeek" href="http://schema.org/{{ucfirst($day)}}" />
                    <div style="font-size: 12px;" class="{{ $today }} text-capitalize">
                        {{$bg_day}}
                    </div>
                    <div style="font-size: 12px;" class="d-flex {{ $today }} ">
                        <span><time itemprop="opens" content="{{ $worktime[$day]['from']['hours'] }}:{{ $worktime[$day]['from']['minutes'] }}:00">{{ $worktime[$day]['from']['hours'] }}:{{ $worktime[$day]['from']['minutes'] }}</time></span>
                        - <span><time itemprop="closes" content="{{ $worktime[$day]['to']['hours'] }}:{{ $worktime[$day]['to']['minutes'] }}:00">{{ $worktime[$day]['to']['hours'] }}:{{ $worktime[$day]['to']['minutes'] }}</time></span>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="d-flex text-black-50">
            <?php
            foreach($days as $day => $bg_day)
            {
            }
            ?>
        </div>
    </div>
    