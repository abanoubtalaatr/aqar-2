@extends('admin.app')
@section('title', __('dashboard.order_details'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h3 class="">@lang('dashboard.order_details') #{{ $order->id }}</h3>
                {{-- <a href="{{ url()->previous() ?? route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-left"></i> @lang('dashboard.back')
                </a> --}}
            </div>

            <div class="card-body">
                <div class="row">
                    {{-- Basic Information --}}
                    <div class="col-md-12">
                        <h4 class="mb-3 text-primary"><i class="fas fa-info-circle"></i> @lang('dashboard.basic_information')</h4>
                        <table class="table table-bordered">
                            @if(!is_null($order->id))
                                <tr><th>@lang('dashboard.id')</th><td>{{ $order->id }}</td></tr>
                            @endif
                            @if($order->category?->name)
                                <tr><th>@lang('dashboard.name')</th><td>{{ __('dashboard.wanted') . ' ' . $order->category->name . ' ' . ($order->for_rent == 0 ? __('dashboard.for_sale') : __('dashboard.for_rent_label')) }}</td></tr>
                            @endif
                            @if(!is_null($order->for_rent))
                                <tr><th>@lang('dashboard.for_rent')</th><td><span class="badge badge-{{ $order->for_rent ? 'success' : 'secondary' }}">{{ $order->for_rent ? __('dashboard.yes') : __('dashboard.no') }}</span></td></tr>
                            @endif
                            @if(!is_null($order->views_count))
                                <tr><th>@lang('dashboard.views_count')</th><td>{{ $order->views_count }}</td></tr>
                            @endif
                            @if(!is_null($order->favoriteCount()))
                                <tr><th>@lang('dashboard.saved_count')</th><td>{{ $order->favoriteCount() }}</td></tr>
                            @endif
                            @if(!is_null($order->is_golden))
                                <tr><th>@lang('dashboard.is_golden')</th><td>{{ $order->is_golden ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                            @endif
                            @if($order->category?->id)
                                <tr><th>@lang('dashboard.category_id')</th><td>{{ $order->category->id }}</td></tr>
                            @endif
                            @if($order->category)
                                <tr><th>@lang('dashboard.category')</th><td>{{ $order->category->name }}</td></tr>
                            @endif
                            @if($order->price_from)
                                <tr><th>@lang('dashboard.price_from')</th><td>{{ number_format($order->price_from) }} {{ config('settings.currency_symbol') }}</td></tr>
                            @endif
                            @if($order->price_to)
                                <tr><th>@lang('dashboard.price_to')</th><td>{{ number_format($order->price_to) }} {{ config('settings.currency_symbol') }}</td></tr>
                            @endif
                            @if($order->area_from)
                                <tr><th>@lang('dashboard.area_from')</th><td>{{ $order->area_from }} @lang('dashboard.square_meters')</td></tr>
                            @endif
                            @if($order->area_to)
                                <tr><th>@lang('dashboard.area_to')</th><td>{{ $order->area_to }} @lang('dashboard.square_meters')</td></tr>
                            @endif
                            @if($order->length)
                                <tr><th>@lang('dashboard.length')</th><td>{{ $order->length }}</td></tr>
                            @endif
                            @if($order->width)
                                <tr><th>@lang('dashboard.width')</th><td>{{ $order->width }}</td></tr>
                            @endif
                            @if($order->property_age_from)
                                <tr><th>@lang('dashboard.property_age_from')</th><td>{{ $order->property_age_from }}</td></tr>
                            @endif
                            @if($order->property_age_to)
                                <tr><th>@lang('dashboard.property_age_to')</th><td>{{ $order->property_age_to }}</td></tr>
                            @endif
                            @if($order->street_width_from)
                                <tr><th>@lang('dashboard.street_width_from')</th><td>{{ $order->street_width_from }}</td></tr>
                            @endif
                            @if($order->street_width_to)
                                <tr><th>@lang('dashboard.street_width_to')</th><td>{{ $order->street_width_to }}</td></tr>
                            @endif
                            @if($order->face_building_id && $order->faceBuilding)
                                <tr><th>@lang('dashboard.face_building')</th><td>{{ $order->faceBuilding->{'name_' . app()->getLocale()} }}</td></tr>
                            @endif
                            @if($order->face_building_id)
                                <tr><th>@lang('dashboard.face_building_id')</th><td>{{ $order->face_building_id }}</td></tr>
                            @endif
                            @if($order->published_at)
                                <tr><th>@lang('dashboard.published_at')</th><td>{{ \Carbon\Carbon::parse($order->published_at)->diffForHumans() }}</td></tr>
                            @endif
                            @if($order->created_at)
                                <tr><th>@lang('dashboard.created_at')</th><td>{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td></tr>
                            @endif
                            @if($order->updated_at)
                                <tr><th>@lang('dashboard.last_updated_at')</th><td>{{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}</td></tr>
                            @endif
                            @if($order->user)
                                <tr><th>@lang('dashboard.user')</th><td>{{ $order->user->name }}</td></tr>
                            @endif
                            @if(!is_null($order->is_updated))
                                <tr><th>@lang('dashboard.is_updated')</th><td>{{ $order->is_updated ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                            @endif
                            @if($order->renting_duration)
                                <tr><th>@lang('dashboard.renting_duration')</th><td>{{ \App\Http\Services\NameContestantService::getRentDurationName($order->renting_duration) }}</td></tr>
                            @endif
                        </table>
                    </div>

                    {{-- Location Information --}}
                    @if($order->map_latitude || $order->map_longitude || $order->map_address)
                        <div class="col-md-8">
                            <h4 class="mb-3 text-primary"><i class="fas fa-map-marker-alt"></i> @lang('dashboard.location_details')</h4>
                            <table class="table table-bordered">
                                @if($order->map_address)
                                    <tr><th>@lang('dashboard.address')</th><td>{{ $order->map_address }}</td></tr>
                                @endif
                                @if($order->map_latitude)
                                    <tr><th>@lang('dashboard.latitude')</th><td>{{ $order->map_latitude }}</td></tr>
                                @endif
                                @if($order->map_longitude)
                                    <tr><th>@lang('dashboard.longitude')</th><td>{{ $order->map_longitude }}</td></tr>
                                @endif
                            </table>
                            @if($order->map_latitude && $order->map_longitude)
                                <div class="border p-2 rounded" id="map" style="width: 100%; height: 300px;"></div>
                            @endif
                        </div>
                    @endif

                    {{-- Orderable Specific Details --}}
                    @if($order->orderable)
                        
                            <div class="col-12">
                                <h4 class="text-primary"><i class="fas fa-list"></i> @lang('dashboard.specific_details')</h4>
                                <table class="table table-bordered">
                                    @if(!is_null($order->orderable->number_of_floors))
                                        <tr><th>@lang('dashboard.number_of_floors')</th><td>{{ $order->orderable->number_of_floors }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->number_of_elevators))
                                        <tr><th>@lang('dashboard.number_of_elevators')</th><td>{{ $order->orderable->number_of_elevators }}</td></tr>
                                    @endif
                                    @if($order->orderable->meter_price)
                                        <tr><th>@lang('dashboard.meter_price')</th><td>{{ $order->orderable->meter_price }}</td></tr>
                                    @endif
                                    @if($order->orderable->meter_price_from)
                                        <tr><th>@lang('dashboard.meter_price_from')</th><td>{{ $order->orderable->meter_price_from }}</td></tr>
                                    @endif
                                    @if($order->orderable->meter_price_to)
                                        <tr><th>@lang('dashboard.meter_price_to')</th><td>{{ $order->orderable->meter_price_to }}</td></tr>
                                    @endif
                                    @if($order->orderable->age_property)
                                        <tr><th>@lang('dashboard.age_property')</th><td>{{ $order->orderable->age_property }}</td></tr>
                                    @endif
                                    @if($order->orderable->height)
                                        <tr><th>@lang('dashboard.height')</th><td>{{ $order->orderable->height }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_living_rooms)
                                        <tr><th>@lang('dashboard.number_of_living_rooms')</th><td>{{ $order->orderable->number_of_living_rooms }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->in_villa))
                                        <tr><th>@lang('dashboard.in_villa')</th><td>{{ $order->orderable->in_villa ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->sewerage_supply))
                                        <tr><th>@lang('dashboard.sewerage_supply')</th><td>{{ $order->orderable->sewerage_supply ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    
                                    @if(!is_null($order->orderable->electricity_supply))
                                        <tr><th>@lang('dashboard.electricity_supply')</th><td>{{ $order->orderable->electricity_supply ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->water_supply))
                                        <tr><th>@lang('dashboard.water_supply')</th><td>{{ $order->orderable->water_supply ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->air_conditioner))
                                        <tr><th>@lang('dashboard.air_conditioner')</th><td>{{ $order->orderable->air_conditioner ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->car_entrance))
                                        <tr><th>@lang('dashboard.car_entrance')</th><td>{{ $order->orderable->car_entrance ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->elevator))
                                        <tr><th>@lang('dashboard.elevator')</th><td>{{ $order->orderable->elevator ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->has_elevator))
                                        <tr><th>@lang('dashboard.has_elevator')</th><td>{{ $order->orderable->has_elevator ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->private_entrance))
                                        <tr><th>@lang('dashboard.private_entrance')</th><td>{{ $order->orderable->private_entrance ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->kitchen))
                                        <tr><th>@lang('dashboard.kitchen')</th><td>{{ $order->orderable->kitchen ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->furnished))
                                        <tr><th>@lang('dashboard.furnished')</th><td>{{ $order->orderable->furnished ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->driver_room))
                                        <tr><th>@lang('dashboard.driver_room')</th><td>{{ $order->orderable->driver_room ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->maid_room))
                                        <tr><th>@lang('dashboard.maid_room')</th><td>{{ $order->orderable->maid_room ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->swimming_pool))
                                        <tr><th>@lang('dashboard.swimming_pool')</th><td>{{ $order->orderable->swimming_pool ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    
                                    @if(!is_null($order->orderable->basement))
                                        <tr><th>@lang('dashboard.basement')</th><td>{{ $order->orderable->basement ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->living_room_stairs))
                                        <tr><th>@lang('dashboard.living_room_stairs')</th><td>{{ $order->orderable->living_room_stairs ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->verse))
                                        <tr><th>@lang('dashboard.verse')</th><td>{{ $order->orderable->verse ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->is_cellar))
                                        <tr><th>@lang('dashboard.is_cellar')</th><td>{{ $order->orderable->is_cellar ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->has_cellar))
                                        <tr><th>@lang('dashboard.has_cellar')</th><td>{{ $order->orderable->has_cellar ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->has_interior_staircase))
                                        <tr><th>@lang('dashboard.has_interior_staircase')</th><td>{{ $order->orderable->has_interior_staircase ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->is_equipped))
                                        <tr><th>@lang('dashboard.is_equipped')</th><td>{{ $order->orderable->is_equipped ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->is_rented))
                                        <tr><th>@lang('dashboard.is_rented')</th><td>{{ $order->orderable->is_rented ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->is_offices))
                                        <tr><th>@lang('dashboard.is_offices')</th><td>{{ $order->orderable->is_offices ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if(!is_null($order->orderable->pool))
                                        <tr><th>@lang('dashboard.pool')</th><td>{{ $order->orderable->pool ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                    @if($order->orderable->length)
                                        <tr><th>@lang('dashboard.length_belongs_to_specific')</th><td>{{ $order->orderable->length }}</td></tr>
                                    @endif
                                    @if($order->orderable->width)
                                        <tr><th>@lang('dashboard.width')</th><td>{{ $order->orderable->width }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_shops_from)
                                        <tr><th>@lang('dashboard.number_of_shops_from')</th><td>{{ $order->orderable->number_of_shops_from }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_shops_to)
                                        <tr><th>@lang('dashboard.number_of_shops_to')</th><td>{{ $order->orderable->number_of_shops_to }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_apartments_from)
                                        <tr><th>@lang('dashboard.number_of_apartments_from')</th><td>{{ $order->orderable->number_of_apartments_from }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_apartments_to)
                                        <tr><th>@lang('dashboard.number_of_apartments_to')</th><td>{{ $order->orderable->number_of_apartments_to }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_trees)
                                        <tr><th>@lang('dashboard.number_of_trees')</th><td>{{ $order->orderable->number_of_trees }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_wells)
                                        <tr><th>@lang('dashboard.number_of_wells')</th><td>{{ $order->orderable->number_of_wells }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_rooms)
                                        <tr><th>@lang('dashboard.number_of_rooms')</th><td>{{ $order->orderable->number_of_rooms }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_rooms_to)
                                        <tr><th>@lang('dashboard.number_of_rooms_to')</th><td>{{ $order->orderable->number_of_rooms_to }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_units_from)
                                        <tr><th>@lang('dashboard.number_of_units_from')</th><td>{{ $order->orderable->number_of_units_from }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_units_to)
                                        <tr><th>@lang('dashboard.number_of_units_to')</th><td>{{ $order->orderable->number_of_units_to }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_halls)
                                        <tr><th>@lang('dashboard.number_of_halls')</th><td>{{ $order->orderable->number_of_halls }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_apartments)
                                        <tr><th>@lang('dashboard.number_of_apartments')</th><td>{{ $order->orderable->number_of_apartments }}</td></tr>
                                    @endif
                                    @if($order->orderable->number_of_bathrooms)
                                        <tr><th>@lang('dashboard.number_of_bathrooms')</th><td>{{ $order->orderable->number_of_bathrooms }}</td></tr>
                                    @endif
                                    @if($order->orderable->purpose)
                                        <tr><th>@lang('dashboard.purpose')</th><td>{{ \App\Http\Services\NameContestantService::getPurposeTitle($order->orderable->purpose) }}</td></tr>
                                    @endif
                                    @if($order->orderable->floor_number)
                                        <tr><th>@lang('dashboard.floor_number')</th><td>{{ $order->orderable->floor_number }}</td></tr>
                                    @endif
                                    
                                    @if(!is_null($order->orderable->has_attached))
                                        <tr><th>@lang('dashboard.has_attached')</th><td>{{ $order->orderable->has_attached ? __('dashboard.yes') : __('dashboard.no') }}</td></tr>
                                    @endif
                                </table>
                            </div>
                    
                    @endif

                    {{-- Description --}}
                    @if($order->description)
                        
                            <div class="row col-12">
                                <h4 class="text-primary"><i class="fas fa-align-left"></i> @lang('dashboard.description')</h4>
                                <div class="border p-3 rounded bg-light">
                                    {!! nl2br(e($order->description)) !!}
                                </div>
                            </div>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if($order->map_latitude && $order->map_longitude)
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDILA7Oj1pjycVqnFH21aUiBQVwJYVGYQs&callback=initMap" async defer></script>
        <script>
            function initMap() {
                var lat = parseFloat("{{ $order->map_latitude }}") || 0;
                var lng = parseFloat("{{ $order->map_longitude }}") || 0;

                if (lat === 0 || lng === 0) {
                    console.error("Invalid coordinates:", lat, lng);
                    return;
                }

                var adLocation = { lat: lat, lng: lng };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: adLocation
                });
                new google.maps.Marker({ position: adLocation, map: map });
            }
        </script>
    @endif
@endpush