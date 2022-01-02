
<div class="modal fade" id="showChangeTotalGuests" tabindex="-1" role="dialog" style="background-color: floralwhite;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px; background-color: rgb(253, 245, 235);">

      <div class="_modal-header">
        <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body px-5 pb-5">
            <h1 class="mb-5 text-center" style="font-size:1.6rem;">Промени броят присъстващи на резервацията</h1>
            <h2 class="mb-5 pb-2 btn-sm rounded-0 px-0 text-black-50 border-bottom text-uppercase font-weight-normal text-center"></h2>

            <form class="" action="{{ route('reservation-update', ['id' => $reservation['id']]) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <input class="form-control mb-2" type="number" name="total_guests" value="{{$reservation['total_guests']}}">

                <button class="d-block mx-auto btn btn-outline-dark" type="submit">Промени</button>
            </form>
      </div>

    </div>
  </div>
</div>
