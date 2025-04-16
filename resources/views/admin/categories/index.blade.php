@extends('admin.app')
@section('title', __('dashboard.categories'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    
                    <form class="row col-md-12">
                        <div class="col-md-10 row">

                            <input type="text" name="keyword" class="form-control col-md-4"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" /> &nbsp;
                            

                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;

                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
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
                                    <th>@lang('dashboard.name_ar')</th>
                                    <th>@lang('dashboard.name_en')</th>
                                    
                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($categories) < 1)
                                    <tr>
                                        <td colspan="7">@lang('dashboard.There are no items found!')</td>
                                    </tr>
                                @endif
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name_ar }}</td>
                                        <td>{{ $category->name_en }}</td>
                                        
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    {{ $categories->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('popup')
@endsection

@section('scripts')
    @include('admin.ajax.delete')
@endsection
