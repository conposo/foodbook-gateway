    <div class="mb-3 mb-md-5 px-3 px-md-5 py-2 border" style="background: #f5f6f7;">
        <h1 class="h4 mt-4 mb-5 pb-3 border-bottom text-center text-uppercase">Управление на домакинството</h1>

        <h6 class="mb-3 text-center text-uppercase _border-bottom">Създай своето домакинство</h6>
        <!-- <h6 class="font-weight-normal mb-1 _text-center">Все още нямаш такова</h6> -->
        <div class="px-md-5 pb-md-3">
            <form class="w-100 " action="{{route('household-new')}}" method="POST">
                @csrf
                <!-- <h5 class="mb-3 pb-2 text-center border-bottom">Въведи име</h5> -->
                
                <div class="form-group m-0 _w-75 mx-auto">
                    <input name="name" type="text" class="form-control text-center" placeholder="Въведи име - напр. Семейство Петрови">
                </div>

                <div class="w-100 form-group text-center _border-top mb-3 pt-3">
                    <button type="submit" class="btn btn-primary" style="background-color: #4267b2;border-color: #4267b2;">Напред</button>
                </div>
            </form>
        </div>
    </div>