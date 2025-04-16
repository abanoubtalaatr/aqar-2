@extends('admin.app')
@section('title', __('View Notification'))

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@yield('title')</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-tool btn-sm btn-info"
                            title="@lang('View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                        <div class="card-body row">
                            <div class="form-group col-12">
                                <label for="title">@lang('Notification Title')</label>
                                <div><span>{{$item->title}}</span></div>
                            </div>

                            <div class="form-group col-12">
                                <label for="body">@lang('Notification Body')</label>
                                <div><p>{{$item->body}}</p></div>
                            </div>

                            <div class="form-group col-12">
                                <label for="state_id">@lang('send_to')</label>
                                <div><span>{{ $item->type !='all' ? $item->userTo->name : __('All') }}</span></div>
                            </div>

                            <div class="form-group col-12">
                                <label for="state_id">@lang('Created at')</label>
                                <div><span dir="rtl">{{ date('H:i d-m-Y', strtotime($item->created_at))}}</span></div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('admin.notifications.index') }}"
                                class="btn btn-default float-right">@lang('Cancel')</a>
                        </div>


                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')


@endsection
