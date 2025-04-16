<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PageResource;
use App\Models\Page;
use App\Traits\GeneralTrait;

class PageController extends Controller
{
    use GeneralTrait;

    public function terms()
    {
        $terms = Page::where('key', 'terms_and_conditions')->first();

        $data = new PageResource($terms);

        return $this->returnData('data', $data);
    }
}
