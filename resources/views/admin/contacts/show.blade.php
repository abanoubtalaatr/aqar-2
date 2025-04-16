@extends('admin.app')
@section('title', __('Contact No'). ' '  . $item->id)

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@lang('Review report information')</h3>
                </div>

                <div class="card-body p-0">

                    <div class="card-body row">
                        <div class="form-group col-6">
                            <label>@lang('contact date')</label>
                            <p type="text d-inline-block" style="display: inline-block" readonly class="border-0">{{ \Illuminate\Support\Carbon::parse($item->create_at)->format('Y-m-d h:m') }}</p>
                        </div>

                        <div class="form-group col-6">
                            <label>@lang('Full name')</label> :
                            <p style="display: inline-block">{{$item->name}}</p>
                        </div>
                        <div class="form-group col-6">
                            <label>@lang('Email')</label> :
                            <p style="display: inline-block">{{$item->email}}</p>
                        </div>

                        <div class="form-group col-6">
                            <label>@lang('Message')</label> :
                            <p style="display: inline-block">{{$item->message}}</p>
                        </div>
                        <div class="form-group col-6">
                            <label>@lang('Mobile')</label> :
                            <p style="display: inline-block">{{$item->mobile}}</p>
                        </div>

                        <div class=" col-6" id="tbl">
                            @if(!$item->is_read)
                                <button
                                        class="btn btn-tool btn-sm btn-{{ $item->is_read == 1 ? 'success' : 'warning' }} btnChangeStatus"
                                        title="{{ $item->is_read == 1 ? __('Read') : __('Unread') }}"
                                        data-remote="{{ route('admin.contacts.status_change', $item->id) }}">
                                    {{ $item->is_read == 1 ? __('Read') : __('Unread') }}
                                </button>
                            @else
                                <button class="btn btn-tool btn-sm btn-success" title="{{  __('Read')}}">
                                    {{  __('Read')  }}
                                </button>
                            @endif

                        </div>
                        <div class=" col-6">
                            <a href="mailto:{{$item->email}}" class="btn btn-tool btn-sm btn-success">@lang("Send Email")</a>
                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>
@endsection

@section('scripts')
    @include('admin.ajax.change_status')

@endsection