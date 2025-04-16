@can('ad-update')
    <button
        class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md "
        title="{{ $item->is_active == 1 ? __('Disable') : __('Activate') }}"
        data-remote="{{ route('admin.status_change', ['model' => Ad::class, 'item' => $item->id]) }}">
        <i
            class="{{ $item->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
    </button>
@endcan
@can('ad-show')
    <a href="{{ route('admin.ads.show', ['ad' => $item->id]) }}" class="btn btn-tool btn-sm btn-info"
        title="@lang('show')">
        <i class="fas fa-eye"></i>
    </a>
@endcan

@can('ad-delete')
    <button type="button" class="btn btn-sm btn-danger btnDelete" data-remote="{{ route('admin.ads.destroy', $item->id) }}">
        <i class="fas fa-trash"></i>
    </button>
@endcan
