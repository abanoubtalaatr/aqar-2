@extends('admin.app')
@section('title', __('dashboard.articles'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    <div class="card-tools">
                        @can('article-create')
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-tool btn-sm btn-primary"
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
                             
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                             
                            <div class="col-md-2">
                                <select class="form-control" name="city_id" onchange="this.form.submit()">
                                    <option value="">@lang('dashboard.choose')</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request()->city_id == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                @include('admin.partials.per_page')
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table m-0 text-center" id="tbl">
                                <thead>
                                    <tr>
                                        <th>@lang('dashboard.id')</th>
                                        <th>@lang('dashboard.city')</th>
                                        <th>@lang('dashboard.title_ar')</th>
                                        <th>@lang('dashboard.title_en')</th>
                                        <th>@lang('dashboard.image')</th>
                                        <th>@lang('dashboard.is_active')</th>
                                        <th style="width: 180px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($articles) < 1)
                                        <tr>
                                            <td colspan="7">@lang('dashboard.There are no items found!')</td>
                                        </tr>
                                    @endif
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td>{{ $article->id }}</td>
                                            <td>{{ $article->city->name }}</td>
                                            <td>{{ $article->title_ar }}</td>
                                            <td>{{ $article->title_en }}</td>
                                            <td>
                                                @if ($article->image)
                                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image"
                                                        width="50">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $article->is_active ? __('dashboard.yes') : __('dashboard.no') }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md border border-gray-300 shadow-sm hover:bg-gray-100 transition"
                                                    title="{{ $article->is_active == 1 ? __('Disable') : __('Activate') }}"
                                                    data-remote="{{ route('admin.status_change', ['model' => Article::class, 'item' => $article->id]) }}">
                                                    <i
                                                        class="{{ $article->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
                                                </button>

                                                @can('article-update')
                                                    <a href="{{ route('admin.articles.edit', $article->id) }}"
                                                        class="btn btn-tool btn-sm btn-info" title="@lang('Edit')">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('article-delete')
                                                    <button class="btn btn-tool btn-sm btn-danger" title="@lang('Delete')"
                                                        data-remote="{{ route('admin.articles.destroy', ['article' => $article->id]) }}">
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
                </div>

                <div class="card-footer clearfix">
                    {{ $articles->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    @include('admin.ajax.delete')
    @include('admin.ajax.change_status')
@endsection