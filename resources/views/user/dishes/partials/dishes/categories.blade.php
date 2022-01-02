
    <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            @php($i = 1)
            @foreach($GLOBALS['categories'] as $category)
                <a class="text-uppercase d-flex justify-content-between align-items-center nav-link @if($i++ == 1) active @endif" id="v-pills-{{$category['slug']}}-tab" data-toggle="pill" href="#v-pills-{{$category['slug']}}" role="tab" aria-controls="v-pills-{{$category['slug']}}" aria-selected="false"
                    onclick="steps = []">
                    {{$category['bg_name']}}<i class="fas fa-chevron-right"></i>
                </a>
            @endforeach
            <div class="pt-5 text-center">
                <h6 class="my-1 pb-2 text-black-50 border-bottom font-weigh-lighter">нова категория</h6>
                <a class="d-block mx-auto text-black-50 my-1 add_"
                    style="cursor:pointer;"
                    data-toggle="modal"
                    data-target="#showAddCategories">
                    <span style="font-size:3.6rem; font-weight:100;">+</span>
                </a>
            </div>
        </div>
    </div>

