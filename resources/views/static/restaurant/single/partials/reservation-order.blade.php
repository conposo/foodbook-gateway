
    <div class="container mt-md-3">
        <div class="row">
            <div class="col">
                <a class="make_reservation shadow mx-auto {{ (false && !$isMenu) ? 'btn disabled' : '' }} mb-5 mb-lg-0 d-flex justify-content-center align-items-center text-dark"
                    style=" width: fit-content; background-color: #fffaf0;"
                    href="#reservation" data-toggle="modal" data-target="#reservation">
                    <span class="btn btn-lg btn-outline-dark d-md-none">
                        <i class="far fa-calendar-alt mr-2" style=""></i> Направи резервация
                    </span>
                    <span class="p-3 btn btn-lg _btn-outline-secondary d-none d-md-inline">
                        Направи резервация
                        <i class="far fa-calendar-alt ml-1" style=""></i>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <style>
        .make_reservation:hover {
            transform: scale(1.03); /* Equal to scaleX(0.7) scaleY(0.7) */
            background-color: #f7f7f7;

  transition: all 0.52s;
        }
    </style>
    @include('static.restaurant.modals.new-reservation')
