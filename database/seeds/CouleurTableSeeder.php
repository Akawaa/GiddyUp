<?php

use Illuminate\Database\Seeder;

class CouleurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('couleur')->insert([
            'couleur_libelle' => 'Noir'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Blanc'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Gris'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Gris foncé'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Rouge'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Rose'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Violet'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Vert'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Bleu'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Bleu clair'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Bleu foncé'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Vert clair'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Vert foncé'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Marron'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Bordeaux'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Mauve'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Jaune'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Beige'
        ]);

        DB::table('couleur')->insert([
            'couleur_libelle' => 'Doré'
        ]);
    }
}
