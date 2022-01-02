
    <div class="mb-5 px-3 px-md-5 py-2 border" style="background: #f5f6f7;">
        <h5 class="mb-3 pt-2 pb-3 pb-md-2 text-center border-bottom">Добави нов член</h5>
        <form class="w-100 mx-auto" action="{{route('household-member-add')}}" method="POST">
            @csrf

            <input type="hidden" name="household_id" value="{{$household['id']}}">

            <div class="d-md-flex flex-md-row">
                <div class="col px-0 form-group mr-md-2">
                    <input name="email" type="text" class="form-control" id="member" placeholder="Въведи имейл адрес">
                </div>
                <div class="col px-0 form-group ">
                    <select class="member_type custom-select form-control" name="user_type">
                        <option selected>Избери статус</option>
                        @if($current_user_type != 'GUEST' && $current_user_type == 'ORGANIZER')
                        <option value="MEMBER">Член на домакинството</option>
                        @endif
                        <option value="GUEST">Гост на домакинството</option>
                    </select>
                </div>
            </div>

            <script>
            $('.member_type').change(function(){
                if($('input#member').val().length != '') {
                    $('button.add_member:submit').prop('disabled', false);
                }
            })
            </script>

            <div class="w-100 form-group text-center _border-top mb-3 pt-2">
                <button type="submit" class="add_member btn btn-primary" style="background-color: #4267b2;border-color: #4267b2;" disabled>Добави</button>
            </div>
        </form>
    </div>