<?php

namespace App\Console\Commands;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class PurgeSoftDeletedRecords extends Command
{
    protected $signature = 'records:purge-soft-deleted';
    protected $description = 'Permanently delete soft-deleted users and ads older than 30 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $thresholdDate = Carbon::now()->subDays(30);

        // Purge soft-deleted users
        $this->purgeUsers($thresholdDate);

        // Purge soft-deleted ads
        $this->purgeAds($thresholdDate);

        $this->info('Soft-deleted records purge completed.');
    }

    protected function purgeUsers($thresholdDate)
    {
        User::onlyTrashed()
            ->where('deleted_at', '<=', $thresholdDate)
            ->chunk(100, function ($users) {
                $count = 0;
                foreach ($users as $user) {
                    $user->ads()->onlyTrashed()->forceDelete();
                    $user->forceDelete();
                    $count++;
                    $this->info("Permanently deleted user ID: {$user->id}");
                }
                $this->info("Purged {$count} soft-deleted users in this batch.");
            });
    }

    protected function purgeAds($thresholdDate)
    {
        Ad::onlyTrashed()
            ->where('deleted_at', '<=', $thresholdDate)
            ->chunk(100, function ($ads) {
                $count = 0;
                foreach ($ads as $ad) {
                    // Delete related files (from your Ad model relationship)
                    $ad->files()->forceDelete();
                    $ad->forceDelete();
                    $count++;
                    $this->info("Permanently deleted ad ID: {$ad->id}");
                }
                $this->info("Purged {$count} soft-deleted ads in this batch.");
            });
    }
}
