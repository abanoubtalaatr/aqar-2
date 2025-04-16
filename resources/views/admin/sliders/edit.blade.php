@extends('admin.app')
@section('title', __('Edit Slider'))

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">@yield('title')</h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-tool btn-sm btn-info"
                            title="@lang('View all')">
                            <i class="fas fa-list"></i>
                        </a>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.sliders.update', $item->id) }}" id="frm1"
                      enctype="multipart/form-data">
                    @csrf

                    @method('PUT')
                <div class="card-body p-0">

                        <div class="card-body p-0">
                            <div class="card-body row">
                                {{-- <div class="col-6">
                                    <label class="">@lang("Link")</label>
                                    <input class="form-control" type="text" name="link" value="{{$item->link}}">
                                </div> --}}
                                <div class="col-6">
                                    <label class="">@lang("Image")</label>
                                    <input class="form-control" type="file" name="image">
{{--                                    @if($item->image)--}}
{{--                                        <img height="100" class="mt-2" src="{{$item->image}}">--}}
{{--                                    @endif--}}

                                </div>
                                <hr>
                                {{-- <div class="col-6 mt-3">
                                    <label class="">@lang("Description ar")</label>
                                    <textarea id="description_ar" class="form-control" name="description_ar">{!! $item->description_ar !!}</textarea>
                                </div>
                                <div class="col-6 mt-3">
                                    <label class="">@lang("Description en")</label>
                                    <textarea id="description_en"  class="form-control"  name="description_en">{!!  $item->description_en!!}</textarea>
                                </div> --}}
                            </div>
                        </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">@lang('Update')</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-default float-right">@lang('Cancel')</a>
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
        $('#description_ar').summernote({
            tabsize: 2
        });
        $('#description_en').summernote({
            tabsize: 2
        });
    </script>

@endsection