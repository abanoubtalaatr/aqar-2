@extends('admin.app')
@section('title', __('dashboard.cities'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @can('article-create')
                            <a href="{{ route('admin.cities-articles.create') }}" 
                               class="btn btn-tool btn-sm btn-primary"
                               title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                    </div>

                </div>


                <div class="card-header border-transparent">
                    <form method="GET" action="{{ route('admin.cities-articles.index') }}" class="row g-2 align-items-center">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <!-- Keyword Search -->
                                <div class="col-md-4">
                                    <input type="text" name="keyword" class="form-control" 
                                           placeholder="@lang('dashboard.Search')" 
                                           value="{{ request()->keyword }}" />
                                </div>
                                <!-- Search Button -->
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary w-100" 
                                           value="@lang('dashboard.Search')" />
                                </div>
                                <!-- All Button -->
                                <div class="col-md-2">
                                    <a href="{{ route('admin.cities-articles.index') }}" class="btn btn-primary w-100">
                                        @lang('dashboard.All')
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Per Page -->
                        <div class="col-md-2">
                            @include('admin.partials.per_page')
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 text-center" id="tbl">
                            <thead>
                                <tr>
                                    <th>@lang('dashboard.id')</th>
                                    <th>@lang('dashboard.name_ar')</th>
                                    <th>@lang('dashboard.name_en')</th>
                                    <th style="width: 150px;">@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                    <tr>
                                        <td>{{ $city->id }}</td>
                                        <td>{{ $city->name_ar }}</td>
                                        <td>{{ $city->name_en }}</td>
                                        <td>
                                            @can('city-update')
                                                <button class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2"
                                                        title="{{ $city->is_active == 1 ? __('dashboard.Disable') : __('dashboard.Activate') }}"
                                                        data-remote="{{ route('admin.status_change', ['model' => City::class, 'item' => $city->id]) }}">
                                                    <i class="{{ $city->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                                </button>
                                            @endcan
                                            @can('city-update')
                                                <a href="{{ route('admin.cities-articles.edit', $city) }}" class="btn btn-tool btn-sm btn-info" 
                                                   title="@lang('dashboard.Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('city-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                        data-remote="{{ route('admin.cities-articles.destroy', $city->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    {{ $cities->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection