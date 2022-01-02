    <form class="border-bottom mb-3" action="{{ route('household-update', $household['id']) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="d-flex justify-content-start align-items-top mb-2 text-uppercase">
            <input style="height: auto; line-height: 1.2;font-size: 1.25rem;" id="household_name" name="name"
                class="text-capitalize p-0 m-0 bg-transparent border-0 form-control" type="text" value="{{$household['name']}}" disabled>
            
            <span onclick="$('#household_name').prop('disabled', false); $('#household_name').removeClass('p-0 m-0 bg-transparent border-0'); $('.household_name').hide(); $('.household_name_done').removeClass('d-none');"
                class="household_name ml-2 edit_name" style="font-size: 14px; cursor: pointer;"><i class="far fa-edit"></i></span>
            
            <button type="submit" class="ml-2 d-none btn btn-sm btn-primary household_name_done" style="">
                <i class="fas fa-check"></i>
            </button>
        </div>
    </form>