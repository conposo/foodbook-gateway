
    <h5 class="mt-2 mb-1">Твоите работни места</h5>
    <table class="mb-5 table">
        <?php
        // dd($roles, $restaurants_data);
        $hasRole = false;
        foreach($restaurants_data as $restaurant_data)
        {
            $route = route('restaurant', $restaurant_data['slug']);
            // $route_tables = route('restaurant-tables', $restaurant_data['slug']);
            $business_name = $restaurant_data['business_name'];

            $current_user_roles = [];

            $isOwner = false;
            foreach($roles as $role)
            {
                if($restaurant_data['id'] == $role['restaurant_id'] && $role['type'] != "OWNER")
                {
                    $current_user_roles[] = $role['type'];
                }
                if($role['type'] == "OWNER") $isOwner = true;
            }
            ?>
            @if(!$isOwner)
            <tr>
                <td>
                    <a href="$route_tables }}">{{ $business_name }}</a>
                    <a href="{{ $route }}" class="ml-2 text-dark">
                        <sup>
                            <small>
                                <i class="fas fa-external-link-alt"></i>
                            </small>
                        </sup>
                    </a>
                </td>
                <td>
                    @foreach($current_user_roles as $role)
                    <span class="btn btn-outline-dark disabled">{{$role}}</span>
                    @endforeach
                </td>
            </tr>
            @php($hasRole = true)
            @else
            @endif
            <?php
        }

        if(!$hasRole):
            echo '<small class="d-block">Когато някое заведение те впише като част от персонала си, тук ще се покаже допълнителна информация за работната ти позиция</small>';
            echo 'все още няма въведени';
        endif;
        ?>
    </table>
