<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;


class CreateTableAssignUser extends Migration
{
    public $tableName  = 'workers';

    public function up()
    {
       $this->forge->addField([
            'worker_login' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'work_crm_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'        => true,
                'unique'     => true,
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'        => true

            ], 
            'active' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'default'    =>  1
            ],
            'number_of_assign_request' => [
                'type'       => 'INT',
                'default'    =>  0
            ],
             'dt_start' => [
                'type'       => 'DATE',
                'default'    =>  new RawSql('NOW()')
            ],
            'dt_end' => [
                'type'       => 'DATE',
                'default'    =>  new RawSql('DATE("4000-01-01")')
            ],
       
            'created_at' => [
                  'type'     => 'TIMESTAMP',
               'default'     => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                  'type'     => 'TIMESTAMP',
               'default'     => new RawSql('CURRENT_TIMESTAMP')
            ],
            'deleted_at' => [
                'type'       => 'TIMESTAMP',
                'null'        => true,
            ]
        ]);
        $this->forge->addKey('worker_login', true);
        $this->forge->createTable($this->tableName);

    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }
}

