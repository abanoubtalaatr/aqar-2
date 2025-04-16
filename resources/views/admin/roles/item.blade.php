@extends('admin.app')
@section('title', isset($item) ? $item['name_' . myLang()] : __('New Role'))

@section('styles')

@endsection

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @yield('title')
                </h3>
            </div>


            <div class="card-body p-0">
                <form method="post" action="{{ route('admin.roles.store', isset($item) ? $item->id : '') }}" id="frm1"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="card-body row">

                        @foreach ($cols as $col)
                            @if (!in_array($col, $skiped))
                                <div class="form-group col-md-6">

                                    <label for="{{ $col }}"> {{ __($col) }} </label>
                                    {{-- @if ($col == 'is_active')
                                        <br />
                                        <label><input type="radio" name="{{ $col }}" value="1" required
                                                @if (isset($item)) {{ $item->$col == 1 ? 'checked' : '' }}
                                        @else {{ old($col) == 1 ? 'checked' : '' }} @endif />
                                            @lang('Active')</label>
                                        <label><input type="radio" name="{{ $col }}" value="0"
                                                @if (isset($item)) {{ $item->$col == 0 ? 'checked' : '' }}
                                        @else {{ old($col) == 0 ? 'checked' : '' }} @endif />
                                            @lang('Suspended')</label>
                                    @else --}}
                                    <input type="text" class="form-control" name="{{ $col }}" required
                                        minlength="3" maxlength="200" value="{{ isset($item) ? $item->$col : old($col) }}">
                                    {{-- @endif --}}
                                </div>
                            @endif
                        @endforeach

                        <div class="form-group col-md-12">
                            <label for="permissions">@lang('Permissions')</label>

                            @include('admin.roles.permissions')
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">@lang('Save')</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default float-right">@lang('Cancel')</a>
                    </div>
                </form>



            </div>

        </div>
    </div>

@endsection

@section('popup')

@endsection

@section('scripts')
    <script type="text/javascript">
         $("#index_all").click(function() {
            $(':checkbox.index_all').prop('checked', this.checked);
        });

        $("#show_all").click(function() {
            $(':checkbox.show_all').prop('checked', this.checked);
        });

        $("#add_all").click(function() {
            $(':checkbox.add_all').prop('checked', this.checked);
        });

        $("#edit_all").click(function() {
            $(':checkbox.edit_all').prop('checked', this.checked);
        });

        $("#delete_all").click(function() {
            $(':checkbox.delete_all').prop('checked', this.checked);
        });
    </script>

@endsection
