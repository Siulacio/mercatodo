<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function toggleState() : Product
    {
        $this->state = !$this->state;
        return $this;
    }
}
