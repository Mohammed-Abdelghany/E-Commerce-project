<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  /** @use HasFactory<\Database\Factories\StockFactory> */
  use HasFactory;

  protected $fillable = ['name', 'description', 'phone', 'email'];
  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_stock')
      ->withPivot('quantity')
      ->withTimestamps();
  }
}
