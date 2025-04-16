@extends('admin.app')
@section('title', __('dashboard.notifications'))

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">

                        @can('notification-create')
                            <a href="{{ route('admin.notifications.create') }}" class="btn btn-tool btn-sm btn-primary"
                                title="@lang('dashboard.Add')">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </div>

                    <form class="row col-md-12">
                        <div class="col-md-10 row">
                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" /> &nbsp;

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;
                            <a href="{{ route('admin.notifications.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
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
                                    <th>@lang("dashboard.id")</th>
                                    <!-- <th><i class="fa fa-camera"></i></th> -->
                                    <th>@lang('dashboard.user')</th>
                                    <th>@lang('dashboard.message')</th>
                                    
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
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item?->user_name }}</td>
                                        <td>{{ json_decode($item->data)->message }}</td>
                                    
                                        
                                        <td>
                                        
                                        

                                                @can('notification-delete')
                                                <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                    data-remote="{{ route('admin.notifications.destroy', ['notification'=>$item->id]) }}">
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
