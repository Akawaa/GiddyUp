<?php

use Illuminate\Database\Seeder;

class FormationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formation')->insert([
            'formation_nom' => 'Faculté des arts, lettre, langues, sciences humaines',
            'formation_abb' => 'FALLSH'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Centre de formation des musiciens intervenants',
            'formation_abb' => 'CFMI'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Maison méditerranéenne des sciences de l\'homme',
            'formation_abb' => 'MMSH'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté de droit',
            'formation_abb' => 'FD'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Institut de management public et gouvernance territoriale',
            'formation_abb' => 'IMPGT'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté économie et gestion',
            'formation_abb' => 'FEG'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Institut d\'administration des entreprises' ,
            'formation_abb' => 'IAE'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Ecole de journalisme et de communication d\'Aix-Marseille' ,
            'formation_abb' => 'EJCAM'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Institut régional du travail',
            'formation_abb' => 'IRT'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté de médecine',
            'formation_abb' => 'FM'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté d\'odonlogie',
            'formation_abb' => 'FO'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté de pharmacie',
            'formation_abb' => 'FP'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Ecole universitaire de maïeutique Marseille Méditerranée',
            'formation_abb' => 'EU3M'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté des sciences',
            'formation_abb' => 'FS'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Faculté des sciences du sport',
            'formation_abb' => 'FSS'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Institut Pythéas - Observatoire des sciences de l\'univers',
            'formation_abb' => 'IPOSU'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Polytech Marseille',
            'formation_abb' => 'PM'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Ecole supérieur de professorat et de l\'éducation',
            'formation_abb' => 'ESPE'
        ]);

        DB::table('formation')->insert([
            'formation_nom' => 'Institut universitaire de technologie d\'Aix-Marseille',
            'formation_abb' => 'IUT'
        ]);
    }
}
