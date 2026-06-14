<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'description'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
