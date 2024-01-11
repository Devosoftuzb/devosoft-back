<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_uz', 'name_en', 'name_ru', 'info_uz', 'info_en', 'info_ru'];

    public function services() {
        return $this->hasMany(Service::class);
    }
}
