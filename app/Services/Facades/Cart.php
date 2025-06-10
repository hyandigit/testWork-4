<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static update(\App\Models\Product $product, int $count)
 * @method static addUser(\App\Models\User $user)
 * @method static \Illuminate\Database\Eloquent\Collection|mixed items()
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
