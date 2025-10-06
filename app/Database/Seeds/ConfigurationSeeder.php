<?php

namespace App\Database\Seeds;

use App\Models\ConfigurationModel;
use CodeIgniter\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'nb_api_call_attempts',
            'description'    => 'Number of API call attempts',
            'value'    => '10',
        ];

        $model = new ConfigurationModel();
        $model->save($data);
    }
}
