<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio_Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function portfolios() {
        return $this->hasMany(Portfolio::class);
    }
}
