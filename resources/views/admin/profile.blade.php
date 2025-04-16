@extends('admin.app')
@section('title', __('Profile'))
@section('styles')
    <style>
        #pac-input {
            right: 60px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 d-none">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- <img class="profile-user-img img-fluid img-circle"
                            src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : dashboardAsset('images/logo.webp') }}"
                            alt="User profile picture"> --}}
                    </div>
                    <h3 class="profile-username text-center">
                        {{ auth()->user()->name }}
                    </h3>
                </div>
            </div>

            @if (auth()->user()->type == 'store')
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile text-center" id="pay-commission-div">
                        <h3 class="profile-username text-center">
                            @lang('Do you want to bear the commission instead of the client?')
                        </h3>
                        <hr />
                        <div class="row">
                            <div class="form-group col-6">
                                <label><input type="radio" name="pay_commission" value="1" class="pay_commission"
                                        {{ auth()->user()->store->pay_commission == 1 ? 'checked' : '' }}> @lang('Yes')
                                </label>
                            </div>
                            <div class="form-group col-6">
                                <label><input type="radio" name="pay_commission" value="0" class="pay_commission"
                                        {{ auth()->user()->store->pay_commission == 0 ? 'checked' : '' }}> @lang('No')
                                </label>
                            </div>
                            <div class="form-group col-12 text-center">
                                <button class="btn btn-primary" title="@lang('Confirm')" id="confirmPay"
                                    data-remote="{{ route('admin.pay_commission') }}">
                                    @lang('Confirm')
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">                   
                        <li class="nav-item col-3"><a class="nav-link {{ session('error') || $errors->any() ? '' : 'active' }}" href="#showsettings"
                                data-toggle="tab">@lang('Main Information')</a>
                        </li>
                        <li class="nav-item col-6">
                            <!-- <a class="nav-link" href="#change-password"
                                data-toggle="tab">@lang('Protection')</a> -->
                        </li>
                        <li class="nav-item col-3"><a class="nav-link {{ session('error') || $errors->any() ? 'active' : '' }}" href="#settings"
                                data-toggle="tab">@lang('Edit')</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane {{ session('error') || $errors->any() ? '' : 'active' }}" id="showsettings">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('name')</label>
                                    <input disabled type="text" name="name" id="name" value="{{ auth()->user()->name}}" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">@lang('email')</label>
                                    <input disabled type="text" name="email" id="email" value="{{ auth()->user()->email}}" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">@lang('whatsapp')</label>
                                    <input disabled type="text" name="mobile" id="mobile" value="{{ auth()->user()->mobile }}" class="form-control" required />
                                </div>
                                <div class="form-group col-6">
                                    <label class="custom-switch" >
                                        <input disabled type="file" hidden onchange="readURL(this,'photo');" name="photo" class="photo"> @lang('Image')
                                        <img   id="photo" width="400px" height="200px" src="{{auth()->user()->photo?asset(auth()->user()->photo):dashboardAsset('images/logo.webp')}}">
                                    </label>
                                </div>
                        </div>
                        <div class="tab-pane {{ session('error') || $errors->any() ? 'active' : '' }}" id="settings">
                            <form class="form-horizontal row" method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.profile.update') }}">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('name')</label>
                                    <input type="text" name="name" id="name" value="{{old('name', auth()->user()->name)}}" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">@lang('email')</label>
                                    <input type="text" name="email" id="email" value="{{old('email', auth()->user()->email)}}" class="form-control" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobile">@lang('whatsapp')</label>
                                    <input type="text" name="mobile" id="mobile" value="{{old('mobile', auth()->user()->mobile)}}" class="form-control" required />
                                </div>
                                <!-- <div class="form-group col-6"> 
                                    <label for="email">@lang('gender')</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">@lang('Choose Gender')</option>
                                        @foreach ($genders as $id => $gender)
                                            <option value="{{ $id }}" {{ old("gender", auth()->user()->gender) == $id ? 'selected' : '' }}>
                                                {{ $gender }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <div class="form-group col-6">
                                    <label class="custom-switch" >
                                        <input type="file" hidden onchange="readURL(this,'photo');" name="photo" class="photo"> @lang('Image')
                                        <img   id="photo" width="400px" height="200px" src="{{auth()->user()->photo?asset(auth()->user()->photo):dashboardAsset('images/logo.webp')}}">
                                    </label>
                                </div>
 
                                <div class="form-group col-md-6">
                                    <label for="old_password">@lang('Old Password')</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control"
                                         />
                                    <i class="far fa-eye" id="togglePasswordOld"></i>
                                </div>
                                <div class="form-group col-md-6">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password">@lang('New Password')</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                         />
                                    <i class="far fa-eye" id="togglePasswordNew"></i>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">@lang('Confirm Password')</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" />
                                    <i class="far fa-eye" id="togglePasswordOldConfirm"></i>
                                </div>


                                <div class="card-footer col-md-12">
                                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="btn btn-default float-right">@lang('Cancel')</a>
                                </div>
                            </form>
                        </div>

        <!-- old style that not used now  -->
        <div class="tab-pane" id="change-password">
            <form class="form-horizontal" method="POST" id="frm2"
                                action="{{ route('admin.profile.change_password', auth()->id()) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="old_password">@lang('Old Password')</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control"
                                        required />
                                    <i class="far fa-eye" id="togglePasswordOld"></i>
                                </div>

                                <div class="form-group">
                                    <label for="password">@lang('New Password')</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        required />
                                    <i class="far fa-eye" id="togglePasswordNew"></i>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">@lang('Confirm Password')</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required />
                                    <i class="far fa-eye" id="togglePasswordOldConfirm"></i>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">@lang('Update Password')</button>
                                    <a href="{{ route('admin.dashboard') }}"
                                    class="btn btn-default float-right">@lang('Cancel')</a>
                                </div>
                            </form>
        <!-- old style that not used now  -->


                        </div>



                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.ajax.confirm_pay')

    <script>
        $("#frm2").validate();
        $("#frm3").validate();
    </script>

    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAB1njEGNX12F5XEQAgf-bjeNSkfjmJ78&callback=initAutocomplete&libraries=places&v=weekly"
        defer></script>
    <script src="{{ dashboardAsset('maps/script.js') }}"></script> --}}

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
        const togglePasswordOld = document.querySelector('#togglePasswordOld');
        const passwordOld = document.querySelector('#old_password');

        togglePasswordOld.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = passwordOld.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordOld.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordNew = document.querySelector('#togglePasswordNew');
        const passwordNew = document.querySelector('#password');

        togglePasswordNew.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = passwordNew.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordNew.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirm = document.querySelector('#togglePasswordOldConfirm');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePasswordConfirm.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
        // -------------------------

        const toggleMoneyPasswordOld = document.querySelector('#toggleMoneyPasswordOld');
        const money_old_password = document.querySelector('#money_old_password');

        toggleMoneyPasswordOld.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = money_old_password.getAttribute('type') === 'password' ? 'text' : 'password';
            money_old_password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        const toggleMoneyPasswordNew = document.querySelector('#toggleMoneyPasswordNew');
        const money_new_password = document.querySelector('#money_new_password');

        toggleMoneyPasswordNew.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = money_new_password.getAttribute('type') === 'password' ? 'text' : 'password';
            money_new_password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        const toggleConfirmMoneyPassword = document.querySelector('#toggleConfirmMoneyPassword');
        const confirm_money_password = document.querySelector('#confirm_money_password');

        toggleConfirmMoneyPassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = confirm_money_password.getAttribute('type') === 'password' ? 'text' : 'password';
            confirm_money_password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
