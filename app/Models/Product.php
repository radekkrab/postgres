<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'article',
        'name',
        'status',
        'data',
    ];

    protected $casts = ['data' => 'array'];

    public function scopeAvailable(Builder $query): void
    {
        $query->where('status', '=', 'available');
    }
}
