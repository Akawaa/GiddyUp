<?php

use Illuminate\Database\Seeder;

class UniversiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universite')->insert([
            'universite_nom' => 'Aix-Marseille université',
            'universite_adresse' => '58, bd Charles Livon',
            'universite_tel' => '+33 491 396 500',
            'universite_photo' => 'aix-marseille.png',
            'universite_logo' => 'aix-marseille-logo.png',
            'ville_insee' => '13055',
        ]);
    }
}
