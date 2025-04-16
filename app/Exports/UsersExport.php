<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = User::whereDoesntHave('roles');

        // Apply filters if present
        if ($this->request->filled('keyword')) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $this->request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $this->request->keyword . '%');
            });
        }

        if ($this->request->filled('license_type') || $this->request->filled('license_status')) {
            $query->whereHas('licenses', function ($q) {
                if ($this->request->filled('license_type')) {
                    $q->where('type', $this->request->license_type);
                }
                if ($this->request->filled('license_status')) {
                    $q->where('status', $this->request->license_status);
                }
            });
        }

        return $query->select('id', 'name', 'email', 'phone', 'created_at')
            ->get()
            ->map(function ($user) {
                return [
                    'id'         => $user->id,
                    'name'       => $user->name,
                    'email'      => $user->email,
                    'phone'      => $user->phone,
                    'created_at' => $user->created_at->format('Y-m-d H:i:s'), // Format DateTime
                ];
            });
    }

    public function headings(): array
    {
        return [
            __("dashboard.id"),
            __('dashboard.name'),
            __("dashboard.email"),
            __("dashboard.phone"),
            __('dashboard.created at')
        ];
    }
}
