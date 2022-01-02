
    <!-- MODAL -->
    <div class="modal fade" id="deleteDish" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <span class="d-flex align-items-center">
                    <!-- <i class="mr-2 far fa-calendar-alt"></i> -->
                    <b>Изтриване на рецептата</b>
                </span>
                <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="ml-3 d-inline" action="{{route('recipe-delete', ['dish_type' => 'P', 'dish_id' => $dish['id']])}}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="modal-body px-5">
                    <button class="d-flex align-items-center mx-auto mt-3 btn btn-outline-dark" type="submit">
                        Изтрий
                        <i class="ml-1 far fa-trash-alt"></i>
                    </button>
                </div>
                
            </form>
            
        </div>
    </div>
    </div>