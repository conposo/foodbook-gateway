@if( false )
<script>
    $(document).ready(function() {

    })
</script>
@endif

<div class="modal fade" id="listPositions" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="_modal-header">
                <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-5 pb-5">

                <form class="mb-0" action="{{route('save-position')}}" method="POST">
                    @csrf

                    <input type="hidden" name="foodbook_chef" value="foodbook_chef">

                    <div class="py-2 border-bottom">
                        <a class="d-flex w-100 justify-content-between align-items-center text-dark"
                            >
                            <!-- data-toggle="collapse" href="#collapse_p_i" role="button" aria-expanded="false" aria-controls="collapse_p_i" -->
                            <div style="opacity: 0.75">
                                <span class="label">Стани</span>
                                <b>CHEF</b>
                                <span class="label">във foodbook</span>
                            </div>
                            <i class="d-none fas fa-chevron-right"></i>
                        </a>
                        <div class="collapse show" id="collapse_p_i">
                            <p>
                                Можеш да се регистрираш като "CHEF" готвач в платформата и така потребителите на foodbook ще могат да виждат
                                твоите кулинарни предложения, като ги споделяш с тях.
                            </p>
                            <input class="d-none _form-control mt-1 py-0" type="text" name="position-description" value="" placeholder="">
                        </div>
                    </div>
                    <div id="more" class="collapse">
                        Необходимо е да регистрираш поне 3 свои ястия с рецепти и снимки. Можеш да го направиш в своята
                        <a href="{{route('recipes')}}">рецептурна книжка</a>.
                        <div class="text-right">
                        <button class="btn btn-outline-dark py-0" type="submit">Стани CHEF!</button>
                        </div>
                    </div>

                    <div id="blablachef" class="mt-3 py-2 d-flex justify-content-between align-items-center">
                        <button class="btn btn-outline-dark py-0" type="button"
                            href="#more" role="button" 
                            data-toggle="collapse" aria-expanded="false" aria-controls="collapse_p_i"
                            onclick="$('#blablachef').removeClass('d-flex').hide()"
                            >виж условията</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
