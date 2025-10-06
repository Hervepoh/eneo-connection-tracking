<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableConnectionRequestForCRMInfo extends Migration
{
    public string $table = "connection_request";
    
    public array $fields = [
        'work_request_number' => [
            'type'       => 'TEXT',
           #'constraint' => '4000',
            'default'    => NULL,
            'null'       => true,
        ],
        'quotation_amount' => [
            'type'       => 'TEXT',
           #'constraint' => '4000',
            'default'    => NULL,
            'null'       => true,
        ],
        'quotation_date' => [
            'type'       => 'TIMESTAMP',
            'default'    => NULL,
            'null'       => true,
        ],
        'quotation_details' => [
            'type'       => 'TEXT',
           #'constraint' => '4000',
            'default'    => NULL,
            'null'       => true,
        ],
        'crm_case_number' => [
            'type'       => 'TEXT',
            'default'    => NULL,
            'null'       => true,
        ],
    ];
    
    public function up()
    {    
        $this->forge->addColumn($this->table, $this->fields);
    }

    public function down()
    {
        $fields = array_keys($this->fields);
        $this->forge->dropColumn($this->table, $fields);
    }

}
