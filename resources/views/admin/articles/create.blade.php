@extends('admin.app')
@section('title', __('dashboard.Create Article'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">@lang('dashboard.Create Article')</h3>
                    <div class="card-tools m-0">
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-tool btn-sm btn-secondary" 
                           title="@lang('dashboard.Back to List')">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="city_id">@lang('dashboard.City')</label>
                            <select name="city_id" id="city_id" class="form-control" required>
                                <option value="">@lang('dashboard.Select City')</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name_en }} <!-- Adjust based on your City model -->
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title_ar">@lang('dashboard.Title (Arabic)')</label>
                            <input type="text" name="title_ar" id="title_ar" class="form-control" 
                                   value="{{ old('title_ar') }}" required>
                            @error('title_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title_en">@lang('dashboard.Title (English)')</label>
                            <input type="text" name="title_en" id="title_en" class="form-control" 
                                   value="{{ old('title_en') }}" required>
                            @error('title_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_ar">@lang('dashboard.Description (Arabic)')</label>
                            <textarea id="description_ar" name="description_ar" class="form-control" rows="5" required>
                                {{ old('description_ar') }}
                            </textarea>
                            @error('description_ar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_en">@lang('dashboard.Description (English)')</label>
                            <textarea id="description_en" name="description_en" class="form-control" rows="5" required>
                                {{ old('description_en') }}
                            </textarea>
                            @error('description_en')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">@lang('dashboard.Image')</label>
                            <input type="file" name="image" id="image" class="form-control-file" 
                                   onchange="previewImage(event)" required>
                            <div class="mt-2">
                                <img id="imagePreview" src="" alt="Image Preview" style="max-width: 200px; display: none;">
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_active">@lang('dashboard.Status')</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                                    @lang('dashboard.Active')
                                </option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                                    @lang('dashboard.Inactive')
                                </option>
                            </select>
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> @lang('dashboard.Save')
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                                @lang('dashboard.Cancel')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Summernote CSS is already in admin.app; override if needed -->
    <style>
        .note-editor {
            display: block !important;
            min-height: 200px;
            width: 100% !important;
        }
        .card-body .form-group .note-editor {
            width: 100% !important;
        }
        @media (min-width: 992px) { /* Large screens */
            .note-editor, .note-toolbar {
                visibility: visible !important;
                opacity: 1 !important;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            console.log('Summernote initializing...');
            // Initialize Summernote for both textareas
            $('#description_ar').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('#description_en').summernote({
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection