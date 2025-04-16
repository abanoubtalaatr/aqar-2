<select class="form-control" name="per_page" onchange="this.form.submit()">
    @foreach (perPages() as $perPage)
        <option value="{{ $perPage }}" {{ request()->get('per_page', config('general.admin_per_page')??25) == $perPage ? 'selected' : '' }}>
            {{ $perPage }}
        </option>
    @endforeach
</select>
