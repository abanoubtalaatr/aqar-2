@extends('admin.app')
@section('title', isset($title) ? $title : '')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-transparent">
                <!-- Search Form -->
                <form class="mt-3" method="GET" action="{{ route($routeName) }}">
                    <div class="row">
                        {{-- Basic Search --}}
                        <div class="col-md-3 mb-3">
                            <input type="text" name="search" class="form-control" 
                                placeholder="@lang('dashboard.search in description, address')" 
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <input type="text" name="phone" class="form-control" 
                                placeholder="@lang('dashboard.search by phone')" 
                                value="{{ request('phone') }}">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <input type="text" name="id" class="form-control" 
                                placeholder="@lang('dashboard.search by order no')" 
                                value="{{ request('id') }}">
                        </div>

                        {{-- Date Filters --}}
                        <div class="col-md-3 mb-3">
                            <select name="published_at" class="form-control">
                                <option value="">@lang('dashboard.filter by publish date')</option>
                                <option value="3" {{ request('published_at') == '3' ? 'selected' : '' }}>@lang('dashboard.last 3 days')</option>
                                <option value="7" {{ request('published_at') == '7' ? 'selected' : '' }}>@lang('dashboard.last 7 days')</option>
                                <option value="30" {{ request('published_at') == '30' ? 'selected' : '' }}>@lang('dashboard.last 30 days')</option>
                                <option value="all" {{ request('published_at') == 'all' ? 'selected' : '' }}>@lang('dashboard.all time')</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <select name="category_id" class="form-control">
                                <option value="">@lang('dashboard.all categories')</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price Range --}}
                        <div class="col-md-3 mb-3">
                            <input type="number" name="price_from" class="form-control" 
                                placeholder="@lang('dashboard.min price')" value="{{ request('price_from') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="number" name="price_to" class="form-control" 
                                placeholder="@lang('dashboard.max price')" value="{{ request('price_to') }}">
                        </div>

                        {{-- Area Range --}}
                        <div class="col-md-3 mb-3">
                            <input type="number" name="area_from" class="form-control" 
                                placeholder="@lang('dashboard.min area')" value="{{ request('area_from') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="number" name="area_to" class="form-control" 
                                placeholder="@lang('dashboard.max area')" value="{{ request('area_to') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            @include('admin.partials.per_page')
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.search')</button>
                            <a href="{{ $routeName ? route($routeName) : '#' }}" class="btn btn-secondary">@lang('dashboard.reset')</a>
                        </div>
                    </div>
                </form>

                <!-- Export Form -->
                <form method="GET" action="{{ route('admin.orders.export') }}" class="mt-3">
                    @foreach (request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="hidden" name="per_day_or_month" value="1">
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-success">@lang('dashboard.Export')</button>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0" id='tbl'>
                        <thead>
                            <tr>
                                @foreach($tableHeaders as $key => $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tableItems as $item)
                                <tr>
                                    @foreach($item as $key => $value)
                                        <td>{!! $value !!}</td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ count($tableHeaders) }}" class="text-center">@lang('No orders found')</td>
                                </tr>
                            @endforelse
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

@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection 
