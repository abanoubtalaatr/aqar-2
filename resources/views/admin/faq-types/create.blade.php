@extends('admin.app')
@section('title', __('dashboard.Create FAQs type'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Create FAQs type')</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.faq-types.store') }}" method="POST">
                        @csrf

                        
                        <div class="form-group">
                            <label for="name_ar">@lang('dashboard.FAQs type (Arabic)')</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="name_en">@lang('dashboard.FAQs type (English)')</label>
                            <input type="text" name="name_en" id="name_en" class="form-control" required>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.Save')</button>
                            <a href="{{ route('admin.faq-types.index') }}" class="btn btn-default">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection