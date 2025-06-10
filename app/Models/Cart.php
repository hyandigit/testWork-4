<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property User $user
 */
class Cart extends Model
{
    protected $table = 'carts';
    protected $attributes = ['user_id' => User::USER_GUEST];

    protected $hidden = ['id', 'user_id'];

    /** RELATIONS */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id')->withPivot(['count']);
    }
    /** END RELATIONS */

    public function setUser(User $user): void
    {
        $this->user_id = $user->getId();
    }
}
