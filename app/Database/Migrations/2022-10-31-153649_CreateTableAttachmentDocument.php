<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableAttachmentDocument extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'INT',
                'auto_increment' => true
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'filename' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['publish', 'pending'],
                'default'    => 'pending',
                'null'       => false,
            ],
            'id_request' => [
                'type'       => 'INT',
            ],
            'operation_number_attempts' => [
                'type'       => 'INT',
                'null'       => true,
                'default'    => 0,
            ],
            'operation_sent_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
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
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_request', 'connection_request', 'id_request');
        $this->forge->createTable('request_attachment');
    }

    public function down()
    {
        $this->forge->dropTable('request_attachment');
    }
}
