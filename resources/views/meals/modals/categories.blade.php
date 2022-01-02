@if( isset($_GET['modal']) && $_GET['modal'] == 'open' )
<script>
    $(document).ready(function() {
        $('#showCategories').modal('show')
    })
</script>
@endif

<div class="modal fade" id="showCategories" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="_modal-header">
                <button type="button" class="close pt-2 pr-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-5 pb-5">
                <?php $i = 0; ?>
                @foreach($GLOBALS['categories'] as $group => $val)
                    <div class="d-flex justify-content-between align-items-center
                                @if( $i++ < (count($GLOBALS['categories'])-1) )
                                    border-bottom
                                @endif">
                        <a class="w-100 py-2 text-center text-uppercase text-black-50"
                            href="{{ route('category', ['category_name' => $val['slug']]) }}">{{$val['bg_name']}}</a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
