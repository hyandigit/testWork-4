<?php

namespace App\Services\Cart;

use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class Cart
{
    private \App\Models\Cart|null $cart;

    public function __construct()
    {
        $id = Cookie::get('cart');
        if (($id && !($this->cart = \App\Models\Cart::find($id))) || !$id) {
            $this->cart = new \App\Models\Cart();
            $this->cart->save();
            Cookie::queue(Cookie::make('cart', $this->cart->id, 360));
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function items()
    {
        return $this->cart->products()->get()->map(function ($item) {
            $item->count = $item->pivot->count;
            unset($item->pivot);
            return $item;
        });
    }

    /**
     * @param Product $product
     * @param int $count Плюсовое значение добавить, отрицательное уменьшить. Меньше нуля удалить
     * @return bool|null
     */
    public function update(Product $product, int $count): bool|null
    {
        $cartProduct = $this->cart->cartProducts()->where('product_id', $product->id)->first();

        if (!$cartProduct) {
            $cartProduct = new CartProduct();
        }

        $cartProduct->count = $count;
        $cartProduct->setProduct($product);

        if ($cartProduct->count <= 0) {
            return $cartProduct->delete();
        } else {
            $cartProduct->setCart($this->cart);
            return $cartProduct->save();
        }
    }

    /**
     * Закрепить корзину на авторизованным пользователем
     *
     * @param User $user
     * @return bool
     */
    public function addUser(User $user): bool
    {
        $this->cart->setUser($user);
        return $this->cart->save();
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->$method(...$parameters);
    }
}
