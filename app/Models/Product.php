<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_template_id',
        'name',
        'description',
        'price'
    ];

    //Relations
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function getSimilarProductsAttribute(): Collection
    {
        return Product::query()
            ->where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }
}
