<?php

namespace App\Console\Commands;

use App\Models\UserVisit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanOldVisits extends Command
{
    protected $signature = 'visits:clean';
    protected $description = 'Remove user visit records older than one month';

    public function handle()
    {
        Log::info('enter clean old visits');

        $threshold = now()->subMonth();
        $deleted = UserVisit::where('last_visited_at', '<', $threshold)->delete();

        $this->info("Deleted {$deleted} old visit records.");
    }
}
