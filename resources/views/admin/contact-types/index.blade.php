@extends('admin.app')
@section('title', __('dashboard.contact types'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @can('contact-type-create')
                            <a href="{{ route('admin.contact-types.create') }}" 
                               class="btn btn-tool btn-sm btn-primary"
                               title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4"
                                   placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" />  

                          
                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            <a href="{{ route('admin.contact-types.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>

                            <div class="col-md-2">
                                @include('admin.partials.per_page')
                            </div>

                            <div class="col-md-3">
                        
                                <select name="type" class="form-control w-100" onchange="this.form.submit()">
                                    <option value="">@lang('dashboard.All')</option>
                                    <option value="help" {{ request('type') == 'help' ? 'selected' : '' }}>
                                        @lang('dashboard.help')
                                    </option>
                                    <option value="support" {{ request('type') == 'support' ? 'selected' : '' }}>
                                        @lang('dashboard.support')
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0 text-center" id="tbl">
                            <thead>
                                <tr>
                                    <th>@lang('dashboard.id')</th>
                                    <th>@lang('dashboard.name in arabic')</th>
                                    <th>@lang('dashboard.name in english')</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th style="width: 180px;">@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact_types as $contact_type)
                                    <tr>
                                        <td>{{ $contact_type->id }}</td>
                                        <td>{{ $contact_type->name_ar }}</td>
                                        <td>{{ $contact_type->name_en }}</td>
                                        <td>@lang('dashboard.'.ucfirst($contact_type->type))</td>
                                        <td>
                                            @can('contact-type-update')
                                                <a href="{{ route('admin.contact-types.edit', $contact_type->id) }}"
                                                   class="btn btn-tool btn-sm btn-info" title="@lang('dashboard.Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('contact-type-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                    data-remote="{{ route('admin.contact-types.destroy', ['contact_type' => $contact_type->id]) }}">
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
                    {{ $contact_types->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.ajax.delete')
@endsection