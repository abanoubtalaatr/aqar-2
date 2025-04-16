@extends('admin.app')
@section('title', __('Update Mentor Data'))

@section('styles')
    <style>
        #pac-input {
            right: 60px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@yield('title')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.serviceProviders.index') }}" class="btn btn-tool btn-sm btn-info"
                           title="@lang('View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <form method="post" action="{{ route('admin.serviceProviders.update', ['serviceProvider' => $item->id]) }}" id="frm1"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            
                            @if ($item->user)
                                <div class="form-group col-6">
                                    <label for="country_id">@lang('Country')</label>
                                    <select class="form-control" name="country_id" id="country_id"
                                            required>
                                        <option value="">@lang('Choose Country')</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                    {{ $item->user->country_id == $country->id ? 'selected' : '' }}>
                                                {{ myLang() == 'ar' ? $country->name : $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="state_id">@lang('State')</label>
                                    <select class="form-control" name="state_id" id="state_id" required>
                                        <option value="">@lang('Choose State')</option>
                                        @foreach (loadStates($item->user->country_id) as $state)
                                            <option value="{{ $state->id }}"
                                                    {{ $item->user->state_id == $state->id ? 'selected' : '' }}>
                                                >{{ myLang() == 'ar' ? $state->name : $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="city_id">@lang('City')</label>
                                    <select class="form-control" name="city_id" id="city_id" required>
                                        <option value="">@lang('Choose City')</option>
                                        @foreach (loadCities($item->user->state_id) as $city)
                                            <option value="{{ $city->id }}"
                                                    {{ $item->user->city_id == $city->id ? 'selected' : '' }}>
                                                >{{ myLang() == 'ar' ? $city->name : $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">@lang('Update')</button>
                            <a href="{{ route('admin.serviceProviders.index') }}"
                                class="btn btn-default float-right">@lang('Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select-multiple').select2();
        });
    </script>

    @include('admin.ajax.load_states')
    @include('admin.ajax.load_cities')
    @include('admin.ajax.load_categories')

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
