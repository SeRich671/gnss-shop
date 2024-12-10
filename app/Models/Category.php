<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    // Check if this category is a leaf (has no children)
    public function isLeaf(): bool
    {
        return $this->children()->count() === 0;
    }

    // Recursive method to gather all leaf categories from the current category
    public function getAllLeafCategories()
    {
        if ($this->isLeaf()) {
            return collect([$this->id]);
        }

        $leafCategories = collect();

        foreach ($this->children as $child) {
            $leafCategories = $leafCategories->merge($child->getAllLeafCategories());
        }

        return $leafCategories;
    }
}
