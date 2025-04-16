@extends('admin.app')
@section('title', __('dashboard.contacts'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('dashboard.View all')</h3>
                    
                    <form class="row col-md-12">
                        <div class="col-md-3">
                            <input type="text" name="keyword" class="form-control"
                                placeholder="@lang('dashboard.Search')" value="{{ request()->keyword }}" />
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary" value="@lang('dashboard.Search')" />
                            &nbsp;
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">@lang('dashboard.All')</a>
                        </div>
                        <div class="col-md-3">
                        
                            <select name="filter_type" class="form-control w-100">
                                <option value="">@lang('dashboard.All')</option>
                                <option value="help" {{ request('filter_type') == 'help' ? 'selected' : '' }}>
                                    @lang('dashboard.help')
                                </option>
                                <option value="support" {{ request('filter_type') == 'support' ? 'selected' : '' }}>
                                    @lang('dashboard.support')
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-2">
                            <button type="submit" class="btn btn-primary w-100">@lang('dashboard.filter')</button>
                        </div>
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
                                    <th>@lang("dashboard.id")</th>
                                    <th>@lang('dashboard.user')</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th>@lang('dashboard.message')</th>
                                    <th>@lang('dashboard.response')</th>
                                    <th style="width: 180px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($contacts) < 1)
                                    <tr>
                                        <td colspan="6">@lang('dashboard.There are no items found!')</td>
                                    </tr>
                                @endif
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->user->name ?? __('dashboard.Unknown') }}</td>
                                        <td>{{ $contact->contactType->name ?? __('dashboard.Unknown') }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <td>{{ $contact->response_message ?? __('dashboard.No response yet') }}</td>
                                        <td>
                                            @if (!$contact->response_message)
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#responseModal{{ $contact->id }}">
                                                    @lang('dashboard.response')
                                                </button>
                                            @endif
                                            
                                            <button class="btn btn-tool btn-sm btn-danger" title="@lang('dashboard.Delete')"
                                                data-remote="{{ route('admin.contacts.destroy', ['contact'=>$contact->id]) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Response Modal -->
                                    <div class="modal fade" id="responseModal{{ $contact->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">@lang('dashboard.response')</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('admin.contacts.respond', $contact->id) }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="response_message" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">@lang('dashboard.save')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    {{ $contacts->onEachSide(1)->links('vendor.pagination.simple-bootstrap-4') }}
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
