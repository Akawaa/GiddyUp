<?php

use Illuminate\Database\Seeder;

class MarqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formation')->insert([
            'marque_libelle' => 'Abarth',
            'type_id' => "1",
        ]);


        DB::table('formation')->insert([
            'marque_libelle' => 'Acura',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Aleko',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Alfa Romeo',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Alpina',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Alpine Renault',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Alvis',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Amc',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Amphicar',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Aptera Motors',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Ariel',
            'type_id' => "1",
        ]);

        DB::table('formation')->insert([
            'marque_libelle' => 'Alpina',
            'type_id' => "1",
        ]);
    }
}
