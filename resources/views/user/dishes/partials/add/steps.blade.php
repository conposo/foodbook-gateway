
    <label class="_align_to_top w-100 pb-1 d-flex justify-content-between justify-items-center border-bottom"
            data-toggle="collapse" data-target="#collapseTextareas" aria-expanded="true" aria-controls="collapseTextareas"
        style="cursor: pointer;">
        <small>Добави стъпки за приготвянето на това ястие</small>
        <i class="fas fa-caret-down"></i>
    </label>
    <div id="collapseTextareas" class="collapse">
        <table id="_table_{{$category['slug']}}" class="steps w-100 mb-1">
            <tr id="step1">
                <td>
                <div class="form-group ">
                    <label class="d-flex justify-content-between" for="step_1 border-bottom">
                        Стъпка 1 <span onclick="removeStep(1)"><i class="fas fa-times"></i></span>
                    </label>
                    <textarea id="step_1" class="form-control steps" rows="3"></textarea>
                </div>
                </td>
            </tr>
        </table>
        <div class="form-group text-right">
            <button type="button" class="btn btn-outline-secondary btn-sm add_step" id="add_step_button" onclick="add_step()">Добави стъпка</button>
        </div>
    </div>
    

    <script>

        let steps = [];
        let step = 1;

        function add_step() {
            $('table#_table_{{$category['slug']}}').append(
                `<tr id="step${step+1}"><td>
                    <div class="form-group mt-2">
                        <label class="d-flex justify-content-between" for="step_${step+1}">
                            Стъпка ${step+1} <span onclick="removeStep(${step+1})"><i class="fas fa-times"></i></span>
                        </label>
                        <textarea id="step_${step+1}" class="form-control steps" rows="3"></textarea>
                    </div>
                </td></tr>`
            );
            step++;
        }

        function removeStep(stepId) {
            step--;
            $('table#_table_{{$category['slug']}} tr#step'+stepId).remove();
            $( "table#_table_{{$category['slug']}} tr" ).each(function( index ) {
                let next_index = index+1;
                $(this).attr('id', 'step'+next_index);
                $(this).find('label').attr('for', 'step_'+next_index).html(`Стъпка ${next_index} <span onclick="removeStep(${next_index})"><i class="fas fa-times"></i></span>`);
                $(this).find('label textarea').attr('id', 'step_'+next_index);
            });
            update_steps();
        }

        function update_steps() {
            steps = [];
            $('table#_table_{{$category['slug']}} tr textarea').each(function( index ) {
                console.log(index);
                item = JSON.parse(`{"step": "${step}", "text": "${$(this).val()}"}`.replace(/\r?\n|\r/g, ' '));
                steps.push(item);
            });
            $('[name=steps]').val( JSON.stringify(steps) )
        }

        $(document).on('blur', 'table.steps tr textarea', function () {
            console.log($(this));
            update_steps();
        });

    </script>
