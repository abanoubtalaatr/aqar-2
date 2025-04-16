@extends('admin.app')
@section('title', __('dashboard.ad_details'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h3 class="">@lang('dashboard.ad_details') #{{ $ad->id }}</h3>
                    {{-- <a href="{{ url()->previous() ?? route('admin.ads.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-arrow-left"></i> @lang('dashboard.back')
                    </a> --}}
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- Basic Information --}}
                        <div class="col-md-12">
                            <h4 class="mb-3 text-primary"><i class="fas fa-info-circle"></i> @lang('dashboard.basic_information')</h4>
                            <table class="table table-bordered">
                                @if (!is_null($ad->id))
                                    <tr>
                                        <th>@lang('dashboard.ad id')</th>
                                        <td>{{ $ad->id }}</td>
                                    </tr>
                                @endif
                                @if ($ad->category?->name)
                                    <tr>
                                        <th>@lang('dashboard.category')</th>
                                        <td>{{ $ad->category->name . ' ' . ($ad->for_rent == 0 ? __('dashboard.for_sale') : __('dashboard.for_rent_label')) }}
                                        </td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->for_rent))
                                    <tr>
                                        <th>@lang('dashboard.for_rent')</th>
                                        <td><span
                                                class="badge badge-{{ $ad->for_rent ? 'success' : 'secondary' }}">{{ $ad->for_rent ? __('dashboard.yes') : __('dashboard.no') }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->per_day_or_month))
                                    <tr>
                                        <th>@lang('dashboard.per_day_or_month')</th>
                                        <td>{{ $ad->per_day_or_month ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                    </tr>
                                @endif
                                @if ($ad->license_number)
                                    <tr>
                                        <th>@lang('dashboard.license_number')</th>
                                        <td>{{ $ad->license_number }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->views_count))
                                    <tr>
                                        <th>@lang('dashboard.views_count')</th>
                                        <td>{{ $ad->views_count }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->favoriteCount()))
                                    <tr>
                                        <th>@lang('dashboard.saved_count')</th>
                                        <td>{{ $ad->favoriteCount() }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->is_golden))
                                    <tr>
                                        <th>@lang('dashboard.is_golden')</th>
                                        <td>{{ $ad->is_golden ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                    </tr>
                                @endif

                                @if ($ad->price)
                                    <tr>
                                        <th>@lang('dashboard.price')</th>
                                        <td>{{ number_format($ad->price) }} {{ config('general.currency_symbol') }}</td>
                                    </tr>
                                @endif
                                @if ($ad->area)
                                    <tr>
                                        <th>@lang('dashboard.area')</th>
                                        <td>{{ $ad->area }} @lang('dashboard.square_meters')</td>
                                    </tr>
                                @endif
                                @if ($ad->length)
                                    <tr>
                                        <th>@lang('dashboard.length')</th>
                                        <td>{{ $ad->length }}</td>
                                    </tr>
                                @endif
                                @if ($ad->width)
                                    <tr>
                                        <th>@lang('dashboard.width')</th>
                                        <td>{{ $ad->width }}</td>
                                    </tr>
                                @endif
                                @if ($ad->property_age)
                                    <tr>
                                        <th>@lang('dashboard.property_age')</th>
                                        <td>{{ $ad->property_age }}</td>
                                    </tr>
                                @endif
                                @if ($ad->face_building_id && $ad->faceBuilding)
                                    <tr>
                                        <th>@lang('dashboard.face_building')</th>
                                        <td>{{ $ad->faceBuilding->{'name_' . app()->getLocale()} }}</td>
                                    </tr>
                                @endif
                                @if ($ad->published_at)
                                    <tr>
                                        <th>@lang('dashboard.published_at')</th>
                                        <td>{{ \Carbon\Carbon::parse($ad->published_at)->diffForHumans() }}</td>
                                    </tr>
                                @endif
                                @if ($ad->created_at)
                                    <tr>
                                        <th>@lang('dashboard.created_at')</th>
                                        <td>{{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</td>
                                    </tr>
                                @endif
                                @if ($ad->updated_at)
                                    <tr>
                                        <th>@lang('dashboard.last_updated_at')</th>
                                        <td>{{ \Carbon\Carbon::parse($ad->updated_at)->diffForHumans() }}</td>
                                    </tr>
                                @endif
                                @if ($ad->user)
                                    <tr>
                                        <th>@lang('dashboard.user')</th>
                                        <td>{{ $ad->user->name }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->bound_for_sale))
                                    <tr>
                                        <th>@lang('dashboard.bound_for_sale')</th>
                                        <td>{{ $ad->bound_for_sale ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->advertiser_owner))
                                    <tr>
                                        <th>@lang('dashboard.advertiser_owner')</th>
                                        <td>{{ $ad->advertiser_owner ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->is_debt))
                                    <tr>
                                        <th>@lang('dashboard.is_debt')</th>
                                        <td>{{ $ad->is_debt ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                    </tr>
                                @endif
                                @if (!is_null($ad->is_updated))
                                    <tr>
                                        <th>@lang('dashboard.is_updated')</th>
                                        <td>{{ $ad->is_updated ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                    </tr>
                                @endif
                                @if ($ad->renting_duration)
                                    <tr>
                                        <th>@lang('dashboard.renting_duration')</th>
                                        <td>{{ \App\Http\Services\NameContestantService::getRentDurationName($ad->renting_duration) }}
                                        </td>
                                    </tr>
                                @endif
                                @if ($ad->face_building_id)
                                    <tr>
                                        <th>@lang('dashboard.face_building')</th>
                                        <td>{{ $ad->faceBuilding->{'name_' . app()->getLocale()} }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        {{-- Location Information --}}
                        @if ($ad->map_latitude || $ad->map_longitude || $ad->map_address || $ad->city)

                            <div class="col-md-12">
                                <h4 class="mb-3 text-primary"><i class="fas fa-map-marker-alt"></i> @lang('dashboard.location_details')</h4>
                                <table class="table table-bordered">
                                    @if ($ad->map_address)
                                        <tr>
                                            <th>@lang('dashboard.address')</th>
                                            <td>{{ $ad->map_address }}</td>
                                        </tr>
                                    @endif
                                    @if ($ad->map_latitude)
                                        <tr>
                                            <th>@lang('dashboard.latitude')</th>
                                            <td>{{ $ad->map_latitude }}</td>
                                        </tr>
                                    @endif
                                    @if ($ad->map_longitude)
                                        <tr>
                                            <th>@lang('dashboard.longitude')</th>
                                            <td>{{ $ad->map_longitude }}</td>
                                        </tr>
                                    @endif
                                    @if ($ad->city)
                                        <tr>
                                            <th>@lang('dashboard.city')</th>
                                            <td>{{ $ad->city->name }}</td>
                                        </tr>
                                    @endif
                                </table>
                                @if ($ad->map_latitude && $ad->map_longitude)
                                    <div class="border p-2 rounded" id="map" style="width: 100%; height: 300px;">
                                    </div>
                                @endif
                            </div>

                        @endif

                        {{-- Adable Specific Details --}}
                        @if ($ad->adable)
                            <div class="row mt-4 col-12">
                                <div class="col-12">
                                    <h4 class="text-primary"><i class="fas fa-list"></i> @lang('dashboard.specific_details')</h4>
                                    <table class="table table-bordered">
                                        @if (!is_null($ad->adable->car_entrance))
                                            <tr>
                                                <th>@lang('dashboard.car_entrance')</th>
                                                <td>{{ $ad->adable->car_entrance ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->has_elevator))
                                            <tr>
                                                <th>@lang('dashboard.has_elevator')</th>
                                                <td>{{ $ad->adable->has_elevator ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->has_interior_staircase))
                                            <tr>
                                                <th>@lang('dashboard.has_interior_staircase')</th>
                                                <td>{{ $ad->adable->has_interior_staircase ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->furnished))
                                            <tr>
                                                <th>@lang('dashboard.furnished')</th>
                                                <td>{{ $ad->adable->furnished ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->sewerage_supply))
                                            <tr>
                                                <th>@lang('dashboard.sewerage_supply')</th>
                                                <td>{{ $ad->adable->sewerage_supply ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->electricity_supply))
                                            <tr>
                                                <th>@lang('dashboard.electricity_supply')</th>
                                                <td>{{ $ad->adable->electricity_supply ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->water_supply))
                                            <tr>
                                                <th>@lang('dashboard.water_supply')</th>
                                                <td>{{ $ad->adable->water_supply ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->kitchen))
                                            <tr>
                                                <th>@lang('dashboard.kitchen')</th>
                                                <td>{{ $ad->adable->kitchen ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->driver_room))
                                            <tr>
                                                <th>@lang('dashboard.driver_room')</th>
                                                <td>{{ $ad->adable->driver_room ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->air_conditioner))
                                            <tr>
                                                <th>@lang('dashboard.air_conditioner')</th>
                                                <td>{{ $ad->adable->air_conditioner ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->maid_room))
                                            <tr>
                                                <th>@lang('dashboard.maid_room')</th>
                                                <td>{{ $ad->adable->maid_room ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->swimming_pool))
                                            <tr>
                                                <th>@lang('dashboard.swimming_pool')</th>
                                                <td>{{ $ad->adable->swimming_pool ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->elevator))
                                            <tr>
                                                <th>@lang('dashboard.elevator')</th>
                                                <td>{{ $ad->adable->elevator ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->has_cellar))
                                            <tr>
                                                <th>@lang('dashboard.has_cellar')</th>
                                                <td>{{ $ad->adable->has_cellar ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->has_attached))
                                            <tr>
                                                <th>@lang('dashboard.has_attached')</th>
                                                <td>{{ $ad->adable->has_attached ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->pool))
                                            <tr>
                                                <th>@lang('dashboard.pool')</th>
                                                <td>{{ $ad->adable->pool ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->is_offices))
                                            <tr>
                                                <th>@lang('dashboard.is_offices')</th>
                                                <td>{{ $ad->adable->is_offices ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->has_offices))
                                            <tr>
                                                <th>@lang('dashboard.has_offices')</th>
                                                <td>{{ $ad->adable->has_offices ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->is_cellar))
                                            <tr>
                                                <th>@lang('dashboard.is_cellar')</th>
                                                <td>{{ $ad->adable->is_cellar ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->is_equipped))
                                            <tr>
                                                <th>@lang('dashboard.is_equipped')</th>
                                                <td>{{ $ad->adable->is_equipped ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!is_null($ad->adable->is_rented))
                                            <tr>
                                                <th>@lang('dashboard.is_rented')</th>
                                                <td>{{ $ad->adable->is_rented ? __('dashboard.yes') : __('dashboard.no') }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_shops)
                                            <tr>
                                                <th>@lang('dashboard.number_of_shops')</th>
                                                <td>{{ $ad->adable->number_of_shops }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_floors)
                                            <tr>
                                                <th>@lang('dashboard.number_of_floors')</th>
                                                <td>{{ $ad->adable->number_of_floors }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_elevators)
                                            <tr>
                                                <th>@lang('dashboard.number_of_elevators')</th>
                                                <td>{{ $ad->adable->number_of_elevators }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_trees)
                                            <tr>
                                                <th>@lang('dashboard.number_of_trees')</th>
                                                <td>{{ $ad->adable->number_of_trees }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_wells)
                                            <tr>
                                                <th>@lang('dashboard.number_of_wells')</th>
                                                <td>{{ $ad->adable->number_of_wells }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_rooms)
                                            <tr>
                                                <th>@lang('dashboard.number_of_rooms')</th>
                                                <td>{{ $ad->adable->number_of_rooms }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_units)
                                            <tr>
                                                <th>@lang('dashboard.number_of_units')</th>
                                                <td>{{ $ad->adable->number_of_units }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->price_meter)
                                            <tr>
                                                <th>@lang('dashboard.meter_price')</th>
                                                <td>{{ $ad->adable->price_meter }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->age_property)
                                            <tr>
                                                <th>@lang('dashboard.age_property')</th>
                                                <td>{{ $ad->adable->age_property }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_living_rooms)
                                            <tr>
                                                <th>@lang('dashboard.number_of_living_rooms')</th>
                                                <td>{{ $ad->adable->number_of_living_rooms }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->height)
                                            <tr>
                                                <th>@lang('dashboard.height')</th>
                                                <td>{{ $ad->adable->height }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_apartments)
                                            <tr>
                                                <th>@lang('dashboard.number_of_apartments')</th>
                                                <td>{{ $ad->adable->number_of_apartments }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_halls)
                                            <tr>
                                                <th>@lang('dashboard.number_of_halls')</th>
                                                <td>{{ $ad->adable->number_of_halls }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->number_of_bathrooms)
                                            <tr>
                                                <th>@lang('dashboard.number_of_bathrooms')</th>
                                                <td>{{ $ad->adable->number_of_bathrooms }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->floor_number)
                                            <tr>
                                                <th>@lang('dashboard.floor_number')</th>
                                                <td>{{ $ad->adable->floor_number }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->street_width)
                                            <tr>
                                                <th>@lang('dashboard.street_width')</th>
                                                <td>{{ $ad->adable->street_width }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->adable->purpose)
                                            <tr>
                                                <th>@lang('dashboard.purpose')</th>
                                                <td>{{ \App\Http\Services\NameContestantService::getPurposeTitle($ad->adable->purpose) }}
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        @endif

                        {{-- Description --}}
                        @if ($ad->description)
                            <div class="row col-12 mt-4">
                                <div class="">
                                    <h4 class="text-primary"><i class="fas fa-align-left"></i> @lang('dashboard.description')</h4>
                                    <div class="border p-3 rounded bg-light">
                                        {!! nl2br(e($ad->description)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($ad->map_latitude && $ad->map_longitude)
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDILA7Oj1pjycVqnFH21aUiBQVwJYVGYQs&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            var lat = parseFloat("{{ $ad->map_latitude }}") || 0;
            var lng = parseFloat("{{ $ad->map_longitude }}") || 0;

            if (lat === 0 || lng === 0) {
                console.error("Invalid coordinates:", lat, lng);
                return;
            }

            var adLocation = {
                lat: lat,
                lng: lng
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: adLocation
            });
            new google.maps.Marker({
                position: adLocation,
                map: map
            });
        }
    </script>
@endif
