<?php

namespace App\Database\Seeds;

use App\Models\WorkerModel;
use CodeIgniter\Database\Seeder;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        
        $datas = [
            [
                'worker_login'    => 'myriam.manga',
            ],
            [
                'worker_login'    => 'interima.Asaidou',
            ],
            [
                'worker_login'    => 'diane.sella',
            ],
            [
                'worker_login'    => 'christophe.tcheuffa',
            ],
            [
                'worker_login'    => 'christine.bisseck',
            ],

        ];
        foreach ($datas as $data) {
            $model = new WorkerModel();
            $model->save($data);
        }
    }
}

