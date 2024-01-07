<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       

        Province::truncate();
  
        $json = File::get("data/provinces.json");
        $provinces = json_decode($json);
  
        foreach ($provinces as $key => $value) {
            Province::updateOrCreate([
                "nom" => $value->nom,
                "id" => $value->id,
                "pays_id" =>42,// Republique Democratique du Congo,
            ]);
        }
    }
}
