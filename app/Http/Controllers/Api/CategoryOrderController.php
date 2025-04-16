<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryOrderController extends Controller
{
    public function index(Request $request)
    {

        $keys = [
            [
                'name' => 'villa',
                'type' => 'sell',
            ],
            [
                'name' => 'land',
                'type' => 'sell',
            ],
            [
                'name' => 'apartment',
                'type' => 'sell',
            ],
            [
                'name' => 'floor',
                'type' => 'sell',
            ],
            [
                'name' => 'shop',
                'type' => 'kissing',
            ],
            [
                'name' => 'building',
                'type' => 'sell'
            ],
            [
                'name' => 'rest',
                'type' => 'sell'
            ],
            [
                'name' => 'exhibition',
                'type' => ''
            ]
        ];
        // $categories = CategoryOrder::where()->get();

        // $categories = CategoryResource::collection($categories);
    }
}
