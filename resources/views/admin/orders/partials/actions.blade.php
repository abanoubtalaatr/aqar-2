@can('order-update')
    <button
        class="btn btn-tool btn-sm btnChangeStatus flex items-center justify-center p-2 rounded-md "
        title="{{ $item->is_active == 1 ? __('Disable') : __('Activate') }}"
        data-remote="{{ route('admin.status_change', ['model' => Order::class, 'item' => $item->id]) }}">
        <i
            class="{{ $item->is_active == 1 ? 'fas fa-toggle-on text-success' : 'fas fa-toggle-off text-warning' }} text-xl"></i>
    </button>
@endcan
@can('order-show')
<a href="{{ route('admin.orders.show', ['order' => $item->id]) }}"
    class="btn btn-tool btn-sm btn-info" title="@lang('show')">
    <i class="fas fa-eye"></i>
</a>
@endcan

@can('order-delete')
    <button type="button" class="btn btn-sm btn-danger btnDelete"
        data-remote="{{ route('admin.orders.destroy', $item->id) }}">
        <i class="fas fa-trash"></i>
    </button>
@endcan
