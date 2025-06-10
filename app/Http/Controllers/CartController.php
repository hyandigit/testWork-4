<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequest;
use App\Models\Product;
use App\Services\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function list()
    {
        return Cart::items();
    }

    /**
     * Add/Delete/Change count
     */
    public function update(CartUpdateRequest $request, Product $product)
    {
        return Cart::update($product, $request->count);
    }

    /**
     * Assign to user
     */
    public function addUser()
    {
        return Cart::addUser(auth()->user());
    }
}
