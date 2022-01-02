
    <section class="py-5 mb-5 mx-auto col-12 col-md-10 col-lg-8 col-xl-6" style="height: ;">
        <header class="mb-5 text-center">
            <h2 class="mb-0 font-weight-normal"
                style="font-size: 1.4rem">Начин на приготвяне</h2>
                <small style="color: brown; font-size: 0.85rem;">и необходими продукти</small>
        </header>
        
        <?php $ingredients = $dish['recipe']['ingredients']; ?>
        @if($ingredients)
            <table class="table mb-5 border-bottom">
            @foreach($ingredients as $ingredient)
                <tr>
                    <td itemprop="recipeIngredient">
                        <span>{{ (isset($ingredient['bg_name'])) ? $ingredient['bg_name'] : $ingredient['id'] }}</span>
                        <small>
                        <i>
                            <span>{{$ingredient['quantity']}}</span>
                            <span>{{$ingredient['unit']}}</span>
                        </i>
                        </small>
                    </td>
                    <td class="text-right">
                        <a href="{{ isset($ingredient['bg_name']) ? '//www.google.com/search?q='.$ingredient['bg_name'] : '' }}" target="_blank">
                            <img src="/images/other/ingredients/{{$ingredient['ingredient_id']}}.png" alt="" style="width:35px;">
                        </a>
                    </td>
                </tr>
            @endforeach
            </table>
        @endif

        <?php $steps = $dish['recipe']['steps']; ?>
        <?php $i = 0; ?>
        @if($steps)
            @foreach($steps as $step)
                <div itemprop="recipeInstructions" class=" mb-2 font-weight-normal border-bottom">
                    <span class="d-inline-block pb-1" style="font-family: cheque;">Стъпка {{++$i}} @if($step['step'] == $i-1) ({{$step['step']}}) @endif</span>
                </div>
                <p class="mb-5">{{$step['text']}}</p>
            @endforeach
        @endif
    </section>
