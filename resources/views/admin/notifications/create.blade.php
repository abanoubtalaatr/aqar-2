@extends('admin.app')

@section('title', __('dashboard.create_notification'))
<style>
    .select2-selection select2-selection--single{
        padding: 2px !important;
    }
</style>
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.notifications.send') }}">
                @csrf
                <div class="form-group">
                    <label for="message">{{ __('dashboard.notification_message') }}</label>
                    <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="user_id">{{ __('dashboard.send_to_specific_user') }}</label>
                    <select name="user_id" id="user_id" class="form-control select2" style="width: 100%;">
                        <option value="">{{ __('dashboard.select_user') }}</option>
                        @foreach (\App\Models\User::whereNotNull('email')->doesntHave('roles')->get() as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name . ' - ' . $user->email . ' - ' . $user->phone }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.send_notification') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            console.log('this for you')
            $('.select2').select2({
                placeholder: "{{ __('dashboard.select_user') }}",
                allowClear: true,
                minimumResultsForSearch: 1, // Show search for 1 or more options
                width: '100%', // Ensure full width
                dropdownAutoWidth: true // Adjust dropdown width
            });
        });
    </script>
@endsection
