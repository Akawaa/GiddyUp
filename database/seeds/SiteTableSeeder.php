<?php

use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site')->insert([
            'site_nom' => 'Site Schuman',
            'site_adresse' => '29, avenue Robert-Schuman',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Jas de Bouffan',
            'site_adresse' => '5, rue du Château de l\'horloge',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Montperrin',
            'site_adresse' => '6 Avenue du Pigonnet',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Gaston Berger',
            'site_adresse' => '413 Avenue Gaston Berger',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site IRT',
            'site_adresse' => '12 Traverse St Pierre',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site de l\'Arbois',
            'site_adresse' => 'Domaine du Petit Arbois, Avenue Louis Philibert',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site de l\'Arbois',
            'site_adresse' => 'Domaine du Petit Arbois, Avenue Louis Philibert',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Arles',
            'site_adresse' => 'Espace Van Gogh - place Félix Rey',
            'universite_id' => '1',
            'ville_insee' => '13004',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Arles',
            'site_adresse' => 'Rue Raoul Follereau',
            'universite_id' => '1',
            'ville_insee' => '13004',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Avignon',
            'site_adresse' => '136 avenue de Tarascon',
            'universite_id' => '1',
            'ville_insee' => '84007',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Aubagne',
            'site_adresse' => '9,bd Lakanal',
            'universite_id' => '1',
            'ville_insee' => '13005',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Digne-les-bains',
            'site_adresse' => '19 Boulevard Saint-Jean Chrysostome',
            'universite_id' => '1',
            'ville_insee' => '04070',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Gap',
            'site_adresse' => '2 Rue Bayard',
            'universite_id' => '1',
            'ville_insee' => '05061',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site La Ciotat',
            'site_adresse' => 'Avenue Maurice Sandral',
            'universite_id' => '1',
            'ville_insee' => '13028',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Puyricard',
            'site_adresse' => 'Chemin de la Quille',
            'universite_id' => '1',
            'ville_insee' => '13001',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Château Gombert',
            'site_adresse' => '69 rue Joliot Curie',
            'universite_id' => '1',
            'ville_insee' => '13055',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Virgile Marron',
            'site_adresse' => '21 Rue Virgile Marron',
            'universite_id' => '1',
            'ville_insee' => '13055',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Luminy',
            'site_adresse' => '163 Avenue de Luminy',
            'universite_id' => '1',
            'ville_insee' => '13055',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Saint Charles',
            'site_adresse' => '3 place Victor Hugo',
            'universite_id' => '1',
            'ville_insee' => '13055',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Saint Jérôme',
            'site_adresse' => '52 Avenue Escadrille Normandie Niemen',
            'universite_id' => '1',
            'ville_insee' => '13055',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Timone',
            'site_adresse' => '27, boulevard Jean Moulin',
            'universite_id' => '1',
            'ville_insee' => '13055',
        ]);

        DB::table('site')->insert([
            'site_nom' => 'Site Salon de Provence',
            'site_adresse' => '150 avenue du Maréchal Leclerc',
            'universite_id' => '1',
            'ville_insee' => '13103',
        ]);
    }
}
