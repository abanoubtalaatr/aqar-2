@extends('site.app')
@section('title', __('Register'))
@section('styles')
    <style>
        #pac-input {
            right: 60px;
        }

        .toggle-password {
            float: left;
            margin-top: -27px;
            margin-left: 10px;
        }

        .custom-file-upload {
            background: #f7f7f7;
            padding: 8px;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>

@endsection
@section('content')

    <section class="services" style="margin-top: 90px;">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-5">
                    <div class="img_box">
                        <img src="{{ asset('front/images/4.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="hero_info">
                        @include('admin.partials.messages')

                        <h2>@lang('Register')</h2>
                        <h6>@lang('Enter the following data')</h6>

                        <form method="post" action="{{ route('register.submit') }}" id="frm1" class="reg_frm"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card-body row">

                                @foreach ($cols as $col)
                                    @if (!in_array($col, $skipped))
                                        @if ($col == 'location')
                                            <div class="form-group col-12">
                                            @else
                                                <div class="form-group col-6">
                                        @endif
                                        <label for="{{ $col }}">
                                            @if ($col == 'name')
                                                {{ __('Salon Name') }}
                                            @elseif ($col == 'photo')
                                                {{ __('Salon Photo') }}
                                            @else
                                                {{ __($col) }}
                                            @endif
                                        </label>

                                        @if ($col == 'location')
                                            {{-- <input id="pac-input" class="form-control" name="location" type="text"
                                                placeholder="@lang('Search Map')" required
                                                value="{{ isset($item) ? $item->location : old('location') }}" /> --}}

                                            <input type="hidden" name="lat" id="latitude"
                                                value="{{ isset($item) ? $item->lat : 24.723744185384465 }}" />
                                            <input type="hidden" name="lng" id="longitude"
                                                value="{{ isset($item) ? $item->lng : 46.698524679509525 }}" />

                                            <div id="map" style="height: 300px; width:100%"></div>
                                        @elseif($col == 'email')
                                            <input type="email" class="form-control" id="{{ $col }}"
                                                @if (in_array($col, $required)) required @endif
                                                name="{{ $col }}" minlength="5" maxlength="100"
                                                value="{{ old($col) }}">
                                        @elseif($col == 'password')
                                            <input type="password" class="form-control" id="{{ $col }}"
                                                @if (in_array($col, $required)) required @endif
                                                name="{{ $col }}" minlength="6" maxlength="100">

                                            <span toggle="#password-field"
                                                class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                        @elseif($col == 'mobile')
                                            <input type="tel" class="form-control" id="{{ $col }}"
                                                @if (in_array($col, $required)) required @endif
                                                name="{{ $col }}" minlength="{{ myConst::MOBILE_LENGTH }}"
                                                maxlength="{{ myConst::MOBILE_LENGTH }}" value="{{ old($col) }}">
                                        @elseif($col == 'photo')
                                            {{-- <input type="file" class="form-control" id="{{ $col }}"
                                                @if (in_array($col, $required)) required @endif
                                                name="{{ $col }}" data-input="false"> --}}

                                            <label for="choose-file" class="custom-file-upload" id="choose-file-label">
                                                @lang('Upload Photo')
                                            </label>
                                            <input name="uploadDocument" type="file" id="choose-file"
                                                accept=".jpg,.jpeg,.pdf,doc,docx,application/msword,.png"
                                                style="display: none;" />
                                        @elseif($col == 'gender')
                                            <div class="icheck-primary d-inline">
                                                @lang('male')
                                                <input type="radio" id="male" name="gender" value="male" checked>
                                                <label for="male">
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                @lang('female')
                                                <input type="radio" id="female" name="gender" value="female">
                                                <label for="female">
                                                </label>
                                            </div>
                                        @else
                                            <input type="text" class="form-control" id="{{ $col }}"
                                                @if (in_array($col, $required)) required @endif
                                                name="{{ $col }}" minlength="2" maxlength="100"
                                                value="{{ old($col) }}">
                                        @endif
                            </div>
                            @endif
                            @endforeach
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-1"> @lang('Register') </button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })
        ({
            key: "AIzaSyAAB1njEGNX12F5XEQAgf-bjeNSkfjmJ78",
            v: "beta"
        });
    </script>

    <script>
        var myLat = document.getElementById("latitude").value;
        var myLng = document.getElementById("longitude").value;

        var latitude = parseFloat(myLat);
        var longitude = parseFloat(myLng);

        async function initMap() {
            // Request needed libraries.
            const {
                Map,
                InfoWindow
            } = await google.maps.importLibrary("maps");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");
            const map = new Map(document.getElementById("map"), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 14,
                mapId: "4504f8b37365c3d0",
            });
            const infoWindow = new InfoWindow();
            const draggableMarker = new AdvancedMarkerElement({
                map,
                position: {
                    lat: latitude,
                    lng: longitude
                },
                gmpDraggable: true,
                title: "This marker is draggable.",
            });

            draggableMarker.addListener("dragend", (event) => {
                const position = draggableMarker.position;
                $("#latitude").val(position.lat);
                $("#longitude").val(position.lng);

                // infoWindow.close();
                // infoWindow.setContent(
                //     `Pin dropped at: ${position.lat}, ${position.lng}`,
                // );
                // infoWindow.open(draggableMarker.map, draggableMarker);
            });
        }

        initMap();
    </script>

    <script>
        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });

        $(document).ready(function() {
            $('#choose-file').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#choose-file')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>

@endsection
