@extends('admin.app')
@section('title', __('dashboard.General Settings'))

@section('content')
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-10">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">@yield('title')</h3>
                </div>

                <form method="post" action="{{ route('admin.settings.update') }}" id="frm1" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body row">
                        @foreach ($groups as $group)
                            <div class="form-group col-md-12">
                                <br />
                                <div class="row">
                                    @foreach (groupSettings($group->group) as $item)
                                        @if ($item->key != 'money_password')

                                            @php
                                                // Ensure $item->value is always a string
                                                $value = is_array($item->value) ? json_encode($item->value) : $item->value;
                                            @endphp

                                            @if ($item->type == 'textarea')
                                                <div class="form-group col-md-12">
                                                @else
                                                    <div class="form-group col-md-6">
                                            @endif
                                            
                                            @if(!is_array($item->key))
                                            <label for="{{ $item->key }}">@lang('dashboard.'. $item->key)</label>
                                            @endif

                                            @if ($item->type == 'textarea')
                                                <textarea class="form-control" name="{{ $item->key }}" placeholder="@lang('Value')">{{ $value }}</textarea>
                                            @elseif ($item->type == 'password')
                                                <input type="password" class="form-control" name="{{ $item->key }}">
                                            @elseif ($item->type == 'radio')
                                                <input type="radio" value="1" name="{{ $item->key }}" {{ $value == 1 ? 'checked' : '' }}> @lang('Yes')
                                                <input type="radio" value="0" name="{{ $item->key }}" {{ $value == 0 ? 'checked' : '' }}> @lang('No')
                                            @elseif ($item->type == 'file')
                                                <input type="file" class="form-control" name="{{ $item->key }}" id="{{ $item->key }}" onchange="previewFile(this)">
                                                <div id="preview-{{ $item->key }}" class="mt-2"></div>
                                                @if ($value)
                                                    <p> <a href="{{ asset('storage/' . $value) }}" target="_blank">@lang("dashboard.view_fal")</a></p>
                                                @endif
                                            @else
                                                <input type="{{ $item->type }}" class="form-control"
                                                    name="{{ $item->key }}" placeholder="@lang('Value')"
                                                    @if ($item->type == 'number') min="0" @endif
                                                    @if ($item->type == 'text') maxlength="255" @endif
                                                    value="{{ $value }}">
                                            @endif
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang('dashboard.save')</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default float-right">@lang('dashboard.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function previewFile(input) {
    const previewId = 'preview-' + input.name;
    const previewContainer = document.getElementById(previewId);
    previewContainer.innerHTML = '';

    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.width = 300; // Adjust width as necessary
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection