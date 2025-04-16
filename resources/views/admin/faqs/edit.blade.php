@extends('admin.app')
@section('title', __('dashboard.Edit FAQ'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('dashboard.Edit FAQ')</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="faq_type">@lang('dashboard.FAQ Type')</label>
                            <select name="faq_type_id" id="faq_type" class="form-control" required>
                                <option value="" disabled>@lang('dashboard.Select FAQ Type')</option>
                                @foreach ($faqTypes as $type)
                                    <option value="{{ $type->id }}" {{ $faq->faq_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="question_ar">@lang('dashboard.Question (Arabic)')</label>
                            <input type="text" name="question_ar" id="question_ar" class="form-control" value="{{ $faq->question_ar }}" required>
                        </div>

                        <div class="form-group">
                            <label for="question_en">@lang('dashboard.Question (English)')</label>
                            <input type="text" name="question_en" id="question_en" class="form-control" value="{{ $faq->question_en }}" required>
                        </div>

                        <div class="form-group">
                            <label for="answer_ar">@lang('dashboard.Answer (Arabic)')</label>
                            <textarea name="answer_ar" id="answer_ar" class="form-control" rows="5" required>{{ $faq->answer_ar }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="answer_en">@lang('dashboard.Answer (English)')</label>
                            <textarea name="answer_en" id="answer_en" class="form-control" rows="5" required>{{ $faq->answer_en }}</textarea>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('dashboard.Update')</button>
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-default">@lang('dashboard.Cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection