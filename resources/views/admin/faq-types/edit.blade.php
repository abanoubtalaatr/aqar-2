@extends('admin.app')
@section('title', __('dashboard.Edit FAQs type'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Edit FAQs type')</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.faq-types.update', $faq_type->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name_ar">@lang('dashboard.FAQs type (Arabic)')</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $faq_type->name_ar }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="name_en">@lang('dashboard.FAQs type (English)')</label>
                            <input type="text" name="name_en" id="type_name_enen" class="form-control" value="{{ $faq_type->name_en }}">
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.Update')</button>
                            <a href="{{ route('admin.faq-types.index') }}" class="btn btn-default">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection