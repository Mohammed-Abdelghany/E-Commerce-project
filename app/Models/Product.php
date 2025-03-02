<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /** @use HasFactory<\Database\Factories\ProductFactory> */
  use HasFactory;

  protected $fillable = ['name', 'description', 'price', 'quantity', 'image', 'status', 'user_id'];
  public function stocks()
  {
    return $this->belongsToMany(Stock::class, 'product_stock')
      ->withPivot('quantity')  // إضافة أي بيانات إضافية تريد حفظها مثل الكمية
      ->withTimestamps();
  }
}
