<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'url', 'owner'];

    public function category()
    {
        return $this->belongsTo(related: ServiceCategory::class);
    }
}
