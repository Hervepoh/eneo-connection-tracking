<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PreproductionSeeder extends Seeder
{
    public function run()
    {
        $this->call('LanguageSeeder');
        $this->call('ConfigurationSeeder');
    }
}
