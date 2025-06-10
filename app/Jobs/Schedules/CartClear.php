<?php

namespace App\Jobs\Schedules;

use App\Models\Cart;
use App\Models\User;

class CartClear
{
    public function __invoke()
    {
        $carts = Cart::query()->where('user_id', User::USER_GUEST)
            ->whereRaw('DATEDIFF(now(), created_at) > 7');
        foreach ($carts as $cart) {
            $cart->cartProducts->delete();
            $cart->delete();
        }
    }
}
