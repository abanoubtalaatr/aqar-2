<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreOrderService
{
    /**
     * Create a new order and its associated orderable record.
     */
    public function createOrder(Request $request): Order
    {
        $category = $this->findCategory($request->category_id);

        $orderData = $this->prepareOrderData($request, $category);

        $order = Order::create($orderData);

        $this->createOrderable($order, $request, $category);

        return $order->refresh();
    }

    /**
     * Prepare the order data for creation.
     */
    private function prepareOrderData(Request $request, Category $category): array
    {
        return array_merge(
            $request->only([
                'for_rent',
                'category_id',
                'property_age',
                'meter_price',
                'price_from',
                'price_to',
                'currency_id',
                'area_from',
                'area_to',
                'description',
                'map_latitude',
                'map_longitude',
                'face_building_id',
                'renting_duration',
                'property_age_to',
                'property_age_from',
                'street_width_from',
                'street_width_to',
                'renting_duration',
            ]),
            [
                'user_id' => auth('api')->user()->id,
                'orderable_type' => $category->adable,
                'published_at' => now(),
            ]
        );
    }

    /**
     * Create the orderable record and associate it with the order.
     */
    private function createOrderable(Order $order, Request $request, Category $category): void
    {
        $orderableData = $request->except([
            'for_rent',
            'category_id',
            'user_id',
            'meter_price',
            'property_age',
            'price_from',
            'price_to',
            'area_from',
            'area_to',
            'description',
            'map_latitude',
            'map_longitude',
            'face_building_id',
            'property_age_to',
            'property_age_from',
            'street_width_from',
            'street_width_to',
            'renting_duration',

        ]);

        $orderable = $category->adable::create($orderableData);

        $order->update(['orderable_id' => $orderable->id]);
    }

    /**
     * Find the category by ID or throw an exception if not found.
     */
    private function findCategory($categoryId): Category
    {
        return Category::findOrFail($categoryId);
    }
}
