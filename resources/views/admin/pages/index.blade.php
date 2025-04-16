@extends('admin.app')
@section('title', isset($item) ? $item['title_' . myLang()] : '')

@section('content')
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-10">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">@yield('title')</h3>
                </div>

                <form method="post" action="{{ route('admin.page.update', $item->id) }}" id="frm1">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        @foreach ($cols as $col)
                            @if (!in_array($col, $skipped))
                                <div class="form-group">
                                    <label for="{{ $col }}">{{ __('dashboard.' . $col) }}</label>

                                    @if ($col == 'page_ar' || $col == 'page_en')
                                        <textarea name="{{ $col }}" id="{{ $col }}" class="form-control"
                                            @if (in_array($col, $required)) required @endif>
@if (isset($item))
{{ $item->$col }}
@endif
</textarea>
                                    @elseif($col == 'is_active')
                                        <div class="icheck-primary d-inline">
                                            @lang('Yes')
                                            <input type="radio" id="yes" name="{{ $col }}" value="1"
                                                checked>
                                            <label for="yes">
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            @lang('No')
                                            <input type="radio" id="no" name="{{ $col }}" value="0">
                                            <label for="no">
                                            </label>
                                        </div>
                                    @else
                                        <input type="text" class="form-control" id="{{ $col }}"
                                            @if (in_array($col, $required)) required @endif name="{{ $col }}"
                                            minlength="2" maxlength="100"
                                            value="@if (isset($item)) {{ $item->$col }} @endif">
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>


                    <div class="card-footer">
                        {{-- @if (has_permission('edit_pages')) --}}
                        <button type="submit" class="btn btn-primary">@lang('dashboard.save')</button>
                        {{-- @endif --}}
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default float-right">@lang('dashboard.Cancel')</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <script>
        $('#page_ar').summernote({
            tabsize: 2
        });
        $('#page_en').summernote({
            tabsize: 2
        });
    </script>

@endsection
