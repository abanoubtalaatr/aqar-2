<?php

namespace App\Exports;

use App\Models\Ad;
use App\Filters\AdFilters;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Ad::with(['category', 'user']);

        $filters = new AdFilters($this->request);
        $query = $filters->apply($query);

        return $query->select('id', 'category_id', 'user_id', 'price', 'area', 'status', 'published_at')->get();
    }

    public function map($ad): array
    {
        return [
            $ad->id,
            $ad->category->name ?? 'N/A',
            $ad->user->name ?? 'N/A',
            number_format($ad->price, 2),
            $ad->area,
            $ad->is_active == 1 ? __("dashboard.active") : __('dashboard.inactive'),
            $ad->published_at ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            __('dashboard.ad id'),
            __('dashboard.category'),
            __('dashboard.user'),
            __('dashboard.price'),
            __('dashboard.area'),
            __('dashboard.status'),
            __('dashboard.published at')
        ];
    }
}
