@extends('admin.app')
@section('title', __('Edit Region'))

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@yield('title')</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.states.index') }}" class="btn btn-tool btn-sm btn-info"
                            title="@lang('View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">

                    <form method="post" action="{{ route('admin.states.update', $item->id) }}" id="frm1"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body row">
                            <div class="form-group col-6">
                                <label for="country_id">@lang('country_id')</label>
                                <select class="form-control" name="country_id" required>
                                    <option value="">@lang('Select Country')</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ $item->country_id == $country->id ? 'selected' : '' }}>
                                            {{ myLang() == 'ar' ? $country->native : $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="name_ar">@lang('name_ar')</label>
                                <input type="text" class="form-control" id="name_ar" required name="name_ar"
                                    minlength="2" maxlength="100" value="{{ $item->name_ar }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="name">@lang('name_en')</label>
                                <input type="text" class="form-control" id="name" required name="name"
                                    minlength="2" maxlength="100" value="{{ $item->name }}">
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">@lang('Update')</button>
                            <a href="{{ route('admin.states.index') }}"
                                class="btn btn-default float-right">@lang('Cancel')</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')


@endsection
