<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableConnectionRequestForNotication extends Migration
{
    public string $table = "connection_request";
    public array $fields = [
        'notify' => [
            'type'       => 'ENUM',
            'constraint' => ['send_close','send_notify','send', 'not available', 'pending'],
            'default'    => 'pending',
            'null'       => false,
        ],
        'notify_id' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
            'null'       => true,
        ],
        'notify_at' => [
            'type'       => 'TIMESTAMP',
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
