<div class="mb-0 mb-sm-3 mb-md-0">
<style>
th > span, td > span {
    white-space: nowrap;
}
</style>
    <table class="table table-responsive-md  border">
        <tr>
            <th><span>Дата/час</span></th>
            <th><span>Брой гости</span></th>
            <th><span>Статус</span></th>
            <th><span>Маса</span></th>
        </tr>
        <tr>            
            <td><span class="date">{{ $reservation['date'] }} / {{ $reservation['time'] }}</span></td>
            <td>
                {{ $reservation['total_guests'] }}
                @if($current_user_guest_data['guest_type'] == 'OWNER')<button class="btn btn-sm" data-toggle="modal" data-target="#showChangeTotalGuests"><i class="fas fa-edit"></i></button>@endif
            </td>
            <td>
                @if($reservation['status'] === 'pending')
                    <a href="#" class="py-0 btn btn-sm btn-outline-info disabled">непотвърдена</a>
                @else
                    @switch($reservation['status'])
                        @case('declined')
                            отхвърлена
                        @break
                        @case('approved')
                            <a href="#" class="py-0 btn btn-sm btn-outline-dark disabled">потвърдена</a>
                        @break
                        @case('canceled')
                            <a href="#" class="py-0 btn btn-sm btn-outline-warning disabled">анулирана</a>
                        @break
                        @default
                            неизвестен статус
                    @endswitch
                @endif
            </td>
            <td>
                @if( isset($reservation['table']) )
                    <a href="#" class="py-0 btn btn-sm btn-outline-dark disabled">маса {{$reservation['table']}}</a>
                @else
                    <a href="#" class="py-0 btn btn-sm btn-outline-info disabled">не е избрана</a>
                @endif
            </td>
        </tr>
    </table>

</div>