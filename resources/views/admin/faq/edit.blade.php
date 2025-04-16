@extends('admin.app')
@section('title', __('Edit FAQ'))

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@yield('title')</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.faq_categories.index', $item->category_id) }}" class="btn btn-tool btn-sm btn-info"
                            title="@lang('View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">

                    <form method="post" action="{{ route('admin.faq.update', $item->id) }}" id="frm1"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body row">
                            @foreach ($cols as $col)
                                @if (!in_array($col, $skipped))
                                    <div class="form-group col-6">
                                        <label for="{{ $col }}">{{ __($col) }}</label>

                                        @if ($col == 'description_ar' || $col == 'description_en')
                                            <textarea name="{{ $col }}" id="{{ $col }}" class="form-control"
                                                @if (in_array($col, $required)) required @endif>{{ $item->$col }}</textarea>
                                        @else
                                            <input type="text" class="form-control" id="{{ $col }}"
                                                @if (in_array($col, $required)) required @endif name="{{ $col }}"
                                                minlength="2" maxlength="100" value="{{ $item->$col }}">
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">@lang('Update')</button>
                            <a href="{{ route('admin.faq_categories.index',$item->category_id) }}"
                                class="btn btn-default float-right">@lang('Cancel')</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')


@endsection
