<?php

namespace App\Database\Seeds;

use App\Models\LanguageModel;
use CodeIgniter\Database\Seeder;

class ConnectionSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            [
                'phrase'    => 'home',
                'en'   => 'Home',
                'fr'    => 'Acceuil',
            ],
            [
                'phrase'    => 'claim',
                'en'   => 'Claim',
                'fr'    => 'Réglamantion',
            ],
            [
                'phrase'    => 'welcome',
                'en'   => 'Welcome',
                'fr'    => 'Bienvenue',
            ],
            [
                'phrase'    => 'finally',
                'en'   => 'Finally',
                'fr'    => 'Finalement',
            ],
        ];
        foreach ($datas as $data) {
            $model = new LanguageModel();
            $model->save($data);
        }
    }
}
