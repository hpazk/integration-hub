<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'category_slug' => 'array',
    ];

    protected $fillable = ['name', 'description', 'slug'];

    public function services()
    {
        return $this->hasMany(related: Service::class);
    }
}
