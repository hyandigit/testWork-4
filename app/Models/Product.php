<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id Порядковый номер
 * @property string $name Название
 * @property string $description Описание
 * @property float $price Цена
 * @property string $image Картинка
 */
class Product extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
}
