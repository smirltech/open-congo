<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Ville::truncate();

        $json = File::get("data/villes.json");
        $villes = json_decode($json);

        foreach ($villes as $key => $value) {
            Ville::updateOrCreate([
                "nom" => $value->nom,
                "id" => $value->id,
                "province_id" => $value->province_id
            ]);
        }
    }
}
