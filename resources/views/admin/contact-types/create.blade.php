@extends('admin.app')
@section('title', __('dashboard.Create Contact Type'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.Create Contact Type')</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contact-types.index') }}" 
                           class="btn btn-tool btn-sm btn-secondary"
                           title="@lang('dashboard.Back to List')">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.contact-types.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name_ar">@lang('dashboard.name in arabic')</label>
                            <input type="text" class="form-control" name="name_ar" id="name_ar" 
                                   value="{{ old('name_ar') }}" required>
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name_en">@lang('dashboard.name in english')</label>
                            <input type="text" class="form-control" name="name_en" id="name_en" 
                                   value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">@lang('dashboard.type')</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="support" {{ old('type') == 'support' ? 'selected' : '' }}>
                                    @lang('dashboard.support')
                                </option>
                                <option value="help" {{ old('type') == 'help' ? 'selected' : '' }}>
                                    @lang('dashboard.help')
                                </option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> @lang('dashboard.Save')
                            </button>
                            <a href="{{ route('admin.contact-types.index') }}" class="btn btn-secondary">
                                @lang('dashboard.Cancel')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection