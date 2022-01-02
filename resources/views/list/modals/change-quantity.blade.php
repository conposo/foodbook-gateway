
<script>
  function build_form(shopping_list_id, ingredient_id, name, unit, quantity) {
      $('#shopping_list_id').val(shopping_list_id);
      $('#ingredient_id').val(ingredient_id);
      $('#name').val(name);
      $('#text_name').text(name);
      $('#unit').val(unit);
      $('#text_unit').text(unit);
      $('#quantity').val(quantity);
      if(user_type == 'household') $('#ishousehold').val('true');
  }
</script>

<div class="modal fade" id="updateIngredientModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form class="m-0 p-0" action="{{ route('list-update-item') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="shopping_list_id" id="shopping_list_id">
        <input type="hidden" name="ingredient_id" id="ingredient_id">
        <input type="hidden" name="name" id="name">
        <input type="hidden" name="unit" id="unit">
      <div class="modal-header">
        <h5 class="modal-title">Промени количеството</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group flex justify-content-between align-items-center">
            <div class="input-group-prepend">
                <span id="text_name" class="input-group-text"></span>
            </div>
            <input list="browsers" class="form-control" type="number" id="quantity" name="quantity">
            <datalist id="browsers">
              <option value="5">
              <option value="10">
              <option value="15">
              <option value="100">
              <option value="150">
              <option value="20">
              <option value="25">
              <option value="30">
              <option value="35">
              <option value="40">
              <option value="45">
              <option value="50">
              <option value="55">
              <option value="60">
              <option value="65">
              <option value="70">
              <option value="75">
              <option value="80">
              <option value="85">
              <option value="90">
              <option value="95">
            </datalist>
            <div class="input-group-append">
                <span id="text_unit" class="input-group-text"></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Отказ</button>
        <button type="submit" class="btn btn-success">Промени <i class="fas fa-check"></i></button>
      </div>
      
    </form>
    </div>
  </div>
</div>