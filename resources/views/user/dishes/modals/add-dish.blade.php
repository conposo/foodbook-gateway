
    <!-- MODAL -->
    <div class="modal fade" id="showAddDish" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

                <div class="modal-header">
                    <span class="d-flex align-items-center">
                        <i class="mr-2 far fa-calendar-alt"></i> Добави ново ястие
                    </span>
                    <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-5">
                    @include('user.dishes.partials.add')
                </div>
        </div>
    </div>
    </div>