@extends('admin.app')
@section('title', __('dashboard.FAQs type'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">

                        @can('faq-type-create')
                            <a href="{{ route('admin.faq-types.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" /> &nbsp;

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;
                            <a href="{{ route('admin.faq-types.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            &nbsp;


                            <div class="col-md-2">
                                @include('admin.partials.per_page')
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
                                    <th>@lang('dashboard.name_ar')</th>
                                    <th>@lang('dashboard.name_en')</th>
                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>

                                        <td>{{ $faq->name_ar }}</td>
                                        <td>{{ $faq->name_en }}</td>
                                        <td>
                                            <button
                                                class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                                title="{{ $faq->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                data-remote="{{ route('admin.status_change', ['model' => FaqType::class, 'item' => $faq->id]) }}">
                                                <i
                                                    class="{{ $faq->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                            </button>

                                            @can('faq-type-update')
                                                <a href="{{ route('admin.faq-types.edit', $faq->id) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('faq-type-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.faq-types.destroy', ['faq_type' => $faq->id]) }}">
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
                    {{ $faqs->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
