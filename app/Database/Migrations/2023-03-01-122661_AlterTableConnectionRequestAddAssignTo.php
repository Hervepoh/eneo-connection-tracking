<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableConnectionRequestAddResolution extends Migration
{
    public string $table = "connection_request";
    public array $fields = [
        'assigned_user_id' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
            'null'       => true,
        ]
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

