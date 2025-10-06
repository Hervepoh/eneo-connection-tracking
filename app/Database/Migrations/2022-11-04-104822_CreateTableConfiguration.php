<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableConfiguration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'value' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'default'       => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'default'       => new RawSql('CURRENT_TIMESTAMP')
            ],
            'deleted_at' => [
                'type'       => 'TIMESTAMP',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('name', true);
        $this->forge->createTable('configuration');
    }

    public function down()
    {
        $this->forge->dropTable('configuration');
    }
}
