<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type')->insert([
            'type_libelle' => 'Voiture',
        ]);

        DB::table('type')->insert([
            'type_libelle' => 'Moto',
        ]);
    }
}
