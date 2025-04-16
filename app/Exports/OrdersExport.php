<?php

namespace App\Exports;

use App\Filters\OrderFilters;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Order::with(['category', 'user']);

        $filters = new OrderFilters($this->request);
        $query = $filters->apply($query);

        return $query->select('id', 'category_id', 'user_id', 'price_from', 'price_to', 'area_from', 'area_to', 'status', 'published_at')->get();
    }

    public function map($ad): array
    {
        return [
            $ad->id,
            $ad->category->name ?? 'N/A',
            $ad->user->name ?? 'N/A',
            number_format($ad->price_from, 2),
            number_format($ad->price_to, 2),
            $ad->area_from,
            $ad->area_to,
            $ad->is_active == 1 ? __("dashboard.active") : __('dashboard.inactive'),
            $ad->published_at ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            __('dashboard.order id'),
            __('dashboard.category'),
            __('dashboard.user'),
            __('dashboard.price from'),
            __('dashboard.price to'),
            __('dashboard.area from'),
            __('dashboard.area to'),
            __('dashboard.status'),
            __('dashboard.published at')
        ];
    }
}
