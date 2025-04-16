<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateOrderService
{
    /**
     * Update the given order and its associated orderable.
     */
    public function updateOrder(Order $order, Request $request): Order
    {
        // $this->authorizeOrder($order);

        $category = $this->findCategory($request->category_id);

        $this->updateOrderFields($order, $request);

        $this->updateOrCreateOrderable($order, $request, $category);

        return $order->refresh();
    }

    /**
     * Ensure the authenticated user owns the order.
     */
    private function authorizeOrder(Order $order): void
    {
        if ($order->user_id !== auth('api')->id()) {
            abort(403, __('mobile.Unauthorized action.'));
        }
    }

    /**
     * Find the category by ID or throw an exception if not found.
     */
    private function findCategory($categoryId): Category
    {
        return Category::findOrFail($categoryId);
    }

    /**
     * Update the order with relevant fields from the request.
     */
    private function updateOrderFields(Order $order, Request $request): void
    {
        $orderData = $request->only([
            'for_rent',
            'category_id',
            'property_age',
            'meter_price',
            'price_from',
            'price_to',
            'area_from',
            'area_to',
            'description',
            'map_latitude',
            'map_longitude',
            'has_files',
            'face_building_id',
            'renting_duration',
            'number_of_rooms_from',
            'number_of_rooms_to',
            'property_age_to',
            'property_age_from',
            'street_width_from',
            'street_width_to'
        ]);

        $order->update($orderData);
    }

    /**
     * Update or create the associated orderable record.
     */
    private function updateOrCreateOrderable(Order $order, Request $request, Category $category): void
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
            'renting_duration',
            'number_of_rooms_from',
            'number_of_rooms_to',
            'property_age_to',
            'property_age_from',
            'street_width_from',
            'street_width_to',
        ]);

        if ($order->orderable) {
            $order->orderable->update($orderableData);
        } else {
            $category->adable::create(array_merge($orderableData, [
                'user_id' => $order->user_id,
            ]));
        }
    }
}
