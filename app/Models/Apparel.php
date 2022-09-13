<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Apparel extends Model
{
    use HasFactory, Loggable;

    protected $fillable = ['name', 'sku', 'orig_quantity', 'quantity', 'purchasePrice', 'retailPrice', 'style', 'type', 'color', 'image'];
}
