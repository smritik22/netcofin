
@foreach ($spotlight as $area)
    <div class="col-md-2">
        <div class="property-areas-box">
            <a href="{{route('frontend.propertylist', ['id' => 'area']) . '?' . http_build_query(['area' => $area->slug])}}">
                @php
                    $area_name = $area->name;
                    if ($language_id > 1) {
                        $area_name = @$area->childdata[0]->name ?: $area->name;
                    }
                @endphp
                <img src="{{$area->image ? asset($image_url . $area->image) : asset('assets/dashboard/images/no_image.png')}}" alt="{{urldecode($area_name)}}" />
                <h4>{{urldecode($area_name)}}</h4>
            </a>
        </div>
    </div>
@endforeach

<div class="col-12">
    <div class="pagination-box">
        <ul>
            <li
                class="paginatiob-left {{ $pagination_data['current_page'] != 1 ? 'pagination-icon-active' : '' }}">
                <a href="#" onclick="gotoPage(this,event);"
                    style="{{ 1 >= $pagination_data['current_page'] ? 'pointer-events: none;' : '' }}"
                    data-page="{{ $pagination_data['current_page'] - 1 }}">
                    <img src="{{ asset('assets/img/pagination-ivon.svg') }}" alt="icon2" />
                </a>
            </li>
            {{--  {!! $properties->render() !!}  --}}
            @for ($i = 1; $i <= $pagination_data['last_page']; $i++)
                {{--  @if ($i == 3 && $pagination_data['last_page'] > $i + 2)
                    <li class="pagination-item">...</li>
                    @php
                        $i = $pagination_data['last_page'] - 1;
                    @endphp
                @else  --}}
                    <li class="pagination-item {{ $i == $pagination_data['current_page'] ? 'active' : '' }}"
                        data-page="{{ $i }}">
                        <a href="#"
                            style="{{ $i == $pagination_data['current_page'] ? 'pointer-events: none;' : '' }}"
                            onclick="gotoPage(this,event);"
                            data-page="{{ $i }}">{{ $i }}</a>
                    </li>
                {{--  @endif  --}}
            @endfor
            <li
                class="paginatiob-right {{ $pagination_data['current_page'] != $pagination_data['last_page'] ? 'pagination-icon-active' : '' }}">
                <a href="#" onclick="gotoPage(this,event);"
                    style="{{ $pagination_data['last_page'] <= $pagination_data['current_page'] ? 'pointer-events: none;' : '' }}"
                    data-page="{{ $pagination_data['last_page'] > $pagination_data['current_page']? $pagination_data['current_page'] + 1: $pagination_data['current_page'] }}">
                    <img src="{{ asset('assets/img/pagination-ivon.svg') }}" alt="icon" />
                </a>
            </li>
        </ul>
    </div>
</div>