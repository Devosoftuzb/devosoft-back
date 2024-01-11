<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Category::create([
            "name_uz" => "Uz Biznesni avtomatlashtirish",
            "name_en" => "En Biznesni avtomatlashtirish",
            "name_ru" => "Ru Biznesni avtomatlashtirish",
            "info_uz" => "Uz Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
            "info_en" => "En Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
            "info_ru" => "Ru Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
        ]);

        Category::create([
            "name_uz" => "Uz Web-saytlar",
            "name_en" => "En Web-saytlar",
            "name_ru" => "Ru Web-saytlar",
            "info_uz" => "Uz Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
            "info_en" => "En Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
            "info_ru" => "Ru Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
        ]);

        Category::create([
            "name_uz" => "Uz Mobile-ilovalar",
            "name_en" => "En Mobile-ilovalar",
            "name_ru" => "Ru Mobile-ilovalar",
            "info_uz" => "Uz Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
            "info_en" => "En Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
            "info_ru" => "Ru Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, ",
        ]);
    }
}
