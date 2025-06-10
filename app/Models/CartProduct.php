<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id Порядковый номер
 * @property int $product_id Номер продукта
 * @property int $cart_id Номер корзины
 * @property int $count Количество
 */
class CartProduct extends Model
{
    public $timestamps = false;
    protected $hidden = ['id', 'product_id', 'cart_id'];

    /** RELATIONS */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    /** END RELATIONS */

    public function setCart(Cart $cart)
    {
        $this->cart_id = $cart->id;
    }

    public function setProduct(Product $product)
    {
        $this->product_id = $product->id;
    }
}
