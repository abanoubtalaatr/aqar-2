@extends('admin.app')
@section('title', __('dashboard.edit service type'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.edit service type')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.service-types.index') }}" 
                           class="btn btn-tool btn-sm btn-secondary"
                           title="@lang('dashboard.Back to List')">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.service-types.update', $service_type->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name_ar">@lang('dashboard.service type in arabic')</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control" 
                                   value="{{ old('name_ar', $service_type->name_ar) }}" required>
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name_en">@lang('dashboard.service type in english')</label>
                            <input type="text" name="name_en" id="name_en" class="form-control" 
                                   value="{{ old('name_en', $service_type->name_en) }}" required>
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">@lang('dashboard.service type')</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="engineering" {{ old('type', $service_type->type) == 'engineering' ? 'selected' : '' }}>
                                    @lang('dashboard.engineering')
                                </option>
                                <option value="decoration" {{ old('type', $service_type->type) == 'decoration' ? 'selected' : '' }}>
                                    @lang('dashboard.decoration')
                                </option>
                                <option value="construction" {{ old('type', $service_type->type) == 'construction' ? 'selected' : '' }}>
                                    @lang('dashboard.construction')
                                </option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> @lang('dashboard.Update')
                            </button>
                            <a href="{{ route('admin.service-types.index') }}" class="btn btn-secondary">
                                @lang('dashboard.Cancel')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection