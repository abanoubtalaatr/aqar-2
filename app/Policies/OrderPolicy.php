<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function show(User $user, Order $order)
    {
        if ($order->user_id !== $user->id) {
            return false;
        }

        return true;
    }
    public function delete(User $user, Order $order)
    {
        if ($order->user_id !== $user->id) {
            return false;
        }

        return true;
    }
}
