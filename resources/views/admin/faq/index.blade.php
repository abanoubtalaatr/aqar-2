@extends('admin.app')
@section('title', __('FAQ Management'))

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('View all')</h3>

                    <div class="card-tools">

                        @if (has_permission('add_faq'))
                            <a href="{{ route('admin.faq.create',$category->id) }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </div>


                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="name" class="form-control col-md-4"
                                placeholder="@lang('The Search')" value="{{ request()->name }}" /> &nbsp;

                            <input type="submit" class="btn btn-primary" value="@lang('Search')" />
                            &nbsp;
                            <a href="{{ route('admin.faq.index', $category->id) }}"
                                class="btn btn-primary">@lang('All')</a>

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
                                    @foreach ($thead as $th)
                                        <th>{{ __($th) }}</th>
                                    @endforeach
                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($items) < 1)
                                    <tr>
                                        <td colspan="7">@lang('dashboard.There are no items found!')</td>
                                    </tr>
                                @endif
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $items->firstItem() + $key }}</td>
                                        <td>{{ $item->question_ar }} <br /> {{ $item->question_en }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $item->is_active == 1 ? 'success' : 'pending' }} float-right">
                                                {{ $item->is_active == 1 ? __('Active') : __('Deactive') }}
                                            </span>
                                        </td>

                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @if (has_permission('edit_faq'))
                                                <button
                                                    class="btn btn-tool btn-sm btn-{{ $item->is_active == 1 ? 'success' : 'warning' }} btnChangeStatus"
                                                    title="{{ $item->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                    data-remote="{{ route('admin.faq.status_change', $item->id) }}">
                                                    {{ $item->is_active == 1 ? __('Disable') : __('Activate') }}
                                                </button>

                                                <a href="{{ route('admin.faq.edit', $item->id) }}"
                                                    class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                            @if (has_permission('delete_faq'))
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.faq.delete', $item->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="card-footer clearfix">
                    {{ $items->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>

            </div>

        </div>
    </div>

@endsection

@section('popup')

@endsection


@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection
