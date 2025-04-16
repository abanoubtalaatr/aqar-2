<?php

namespace App\Providers;

use App\Models\ConstructionOrder;
use App\Models\Contact;
use App\Models\Info;
use App\Models\MortgageOrder;
use App\Models\Rate;
use App\Models\Report;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    // private $info;
    public function register()
    {
        //
    }

    public $info;

    public $contact_count;

    public $reports_count;

    public $rates_count;

    public $ConstructionOrderCount;

    public $MortgageOrderCount;

    public function boot()
    {
        $this->info = Info::first();
        $this->ConstructionOrderCount = ConstructionOrder::where('seen', 0)->count();

        $this->MortgageOrderCount = MortgageOrder::where('seen', 0)->count();
        // $this->contact_count = Contact_count::where('read', 0)->count();
        $this->reports_count = Report::where('seen', 0)->count();
        $this->rates_count = Rate::where('seen', 0)->count();

        view()->composer('admin.*', function ($view) {
            $view->with([
                'info' => $this->info,
                'contact_count' => $this->contact_count,
                'reports_count' => $this->reports_count,
                'rates_count' => $this->rates_count,
                'ConstructionOrderCount' => $this->ConstructionOrderCount,
                'MortgageOrderCount' => $this->MortgageOrderCount,

            ]);
        });
    }
}
