@extends('admin.app')
@section('title', __('dashboard.FAQs'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @if (has_permission('admin.faqs.create'))
                            <a href="{{ route('admin.faqs.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">

                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" /> &nbsp;
                            <div class="col-md-3">
                                <select name="faq_type_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">@lang('dashboard.FAQs type')</option>
                                    @foreach ($faqTypes as $faq)
                                    <option value="{{$faq->id}}" {{ request('faq_type_id') == $faq->id ? 'selected' : '' }}>
                                        {{$faq->name}}</option>    
                                    @endforeach
                                    
                                    
                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;

                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                            &nbsp;


                            <div class="col-md-2 mt-3">
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
                                    {{-- <th>@lang('dashboard.FAQs type')</th> --}}
                                    <th>@lang('dashboard.question_ar')</th>
                                    <th>@lang('dashboard.question_en')</th>
                                    <th>@lang('dashboard.answer_ar')</th>
                                    <th>@lang('dashboard.answer_en')</th>
                                    <th style="width: 180px;">@lang('dashboard.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        {{-- <td>{{ $faq?->faqType?->name }}</td> --}}
                                        <td>{{ $faq->question_ar }}</td>
                                        <td>{{ $faq->question_en }}</td>
                                        <td>{{ Str::limit($faq->answer_ar, 50) }}</td>
                                        <td>{{ Str::limit($faq->answer_en, 50) }}</td>
                                        <td>
                                            <button
                                                class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                                title="{{ $faq->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                data-remote="{{ route('admin.status_change', ['model' => FAQ::class, 'item' => $faq->id]) }}">
                                                <i
                                                    class="{{ $faq->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                            </button>

                                            @can('faq-update')
                                                <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('faq-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.faqs.destroy', ['faq' => $faq->id]) }}">
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

