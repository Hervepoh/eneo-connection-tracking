<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableLanguage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'phrase_id' => [
                'type'       => 'INT',
                'constraint' => '11',
                'auto_increment' => true,
                'null'        => false
            ],
            'phrase' => [
                'type'       => 'LONGTEXT',
                'default'    => NULL,
            ],
            'en' => [
                'type'       => 'LONGTEXT',
                'default'    => NULL,
            ],
            'fr' => [
                'type'       => 'LONGTEXT',
                'default'    => NULL,
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
        $this->forge->addKey('phrase_id', true);
        $this->forge->createTable('language');
    }

    public function down()
    {
        $this->forge->dropTable('language');
    }
}
