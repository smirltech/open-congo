<?php

namespace Database\Seeders;

use App\Models\Pays;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        Pays::truncate();

        $json = File::get("data/pays.json");
        $pays = json_decode($json);

        foreach ($pays as $key => $value) {
            Pays::updateOrCreate([
                "id" => $value->id,
                "nom" => $value->name,
            ],[
                "officiel_nom" => $value->official_name,
                "flag" => $value->flag,
                "maps" => $value->maps,
                "phone_code" => $value->phone_code,
                "code" => $value->code
            ]);
        }
    }
}
