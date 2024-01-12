<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ["category_id", "name_uz", "name_en", "name_ru", "info_uz", "info_en", "info_ru"];
}
