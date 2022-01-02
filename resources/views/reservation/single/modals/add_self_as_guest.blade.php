
<div class="modal fade" id="addselfasguest" tabindex="-1" role="dialog" style="background-color: floralwhite;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px; background-color: rgb(253, 245, 235);">

      <div class="_modal-header">
        <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body px-5 pb-5">
            <h1 class="mb-5 text-center" style="font-size:1.6rem;">Присъедини се към резервацията</h1>
            <h2 class="mb-5 pb-2 btn-sm rounded-0 px-0 text-black-50 border-bottom text-uppercase font-weight-normal text-center"></h2>

            <form class="" action="{{ route('reservation-guest-new', ['reservation_id' => $reservation['id']]) }}" method="POST">
                @csrf
                
                <input type="hidden" name="user_email" value="{{$user->email}}">
                <input type="hidden" name="guest_type" value="OWNER">
                <input type="hidden" name="guest_order" value="{{ count($other_guests_data)+1 }}">

                <button class="d-block mx-auto btn btn-outline-dark" type="submit">
                    Присъедини се
                </button>
            </form>
      </div>

    </div>
  </div>
</div>
