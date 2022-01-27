<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
      'code',
      'name',
      'description',
      'price',
      'quantity',
      'state'
    ];

    public function scopeSearchProduct($query, ?string $filter) : Builder
    {
        if (!empty($filter)){
            $query->where('code', 'LIKE', '%'.$filter.'%')
                ->orWhere('price', 'LIKE', '%'.$filter.'%')
                ->orWhere('name', 'LIKE', '%'.$filter.'%')
                ->orWhere('description', 'LIKE', '%'.$filter.'%');
        }

        return $query;
    }
    
    public function images(): HasMany
    {
        return $this->hasMany(ProductImages::class);
    }

    public function toggleState() : Product
    {
        $this->state = !$this->state;
        return $this;
    }
}
