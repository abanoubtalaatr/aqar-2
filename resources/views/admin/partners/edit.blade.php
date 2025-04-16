@extends('admin.app')
@section('title', __('dashboard.edit partner'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">@lang('dashboard.edit partner')</h3>
                    <div class="card-tools m-0">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-tool btn-sm btn-secondary" 
                           title="@lang('dashboard.Back to List')">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.partners.update', $partner->id) }}" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="image">@lang('dashboard.Image')</label>
                            <input type="file" name="image" id="image" class="form-control-file" 
                                   onchange="previewImage(event)">
                            <div class="mt-2">
                                <img id="imagePreview" 
                                     src="{{ $partner->image ? asset('storage/' . $partner->image) : '' }}" 
                                     alt="Partner Image" style="max-width: 200px; display: {{ $partner->image ? 'block' : 'none' }};">
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> @lang('dashboard.Update')
                            </button>
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                                @lang('dashboard.Cancel')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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