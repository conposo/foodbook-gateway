
    <!-- MODAL -->
    <div class="modal fade" id="showAddCategories" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user-new-category')}}" method="POST">
                @csrf

                <div class="modal-header">
                    <span class="d-flex align-items-center">
                        <i class="mr-2 far fa-calendar-alt"></i> Въведи категория
                    </span>
                    <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body px-5">
                    <input class="form-control" type="text" placeholder="моята категория" name="slug">
                    <button class="d-flex mx-auto mt-3 btn btn-outline-dark" type="submit">Добави</button>
                </div>
            </form>
        </div>
    </div>
    </div>