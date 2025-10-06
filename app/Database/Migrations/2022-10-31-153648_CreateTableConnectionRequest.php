<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTableConnectionRequest extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_request' => [
                'type'       => 'INT',
                'auto_increment' => true
            ],
            'title' => [
                'type'       => 'TEXT',
            ],
            
            'person_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '1',
            ],
            'civility' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'social_reason' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'region' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone_dial_code' => [
                'type'       => 'INT',
                'default'    => '237',
            ],
            'phone_country_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'default'    => 'cm',
            ],
            'phone_2' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'phone_2_dial_code' => [
                'type'       => 'INT',
                'default'    => '237',
            ],
            'phone_2_country_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'default'    => 'cm',
            ],
            'is_whatsapp' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'null' => true,
            ],
            'is_whatsapp_2' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'null' => true,
            ],
            'identity_type_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'identity_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'identity_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'identity_delivered_at' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'identity_expires_on' => [
                'type'       => 'DATE',
            ],
            'identity_country' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'taxnum' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'connection_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'connection_type_label' => [
                'type'       => 'TEXT',
            ],
            'usage_description' => [
                'type'       => 'TEXT',
            ],
            'appliances' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'activity' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'premise_activity' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

            'requestor' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

            'contract_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'agency' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'type_compteur' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'requested_power' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'meter_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'meter_quantity' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'appliances' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

            'networkDis' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'existing_wire' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'construction_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'number_floor' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'premise_location' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sub_category'=>[
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sub_category_detail'=>[
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['close','publish and open','publish', 'pending'],
                'default'    => 'pending',
                'null'       => false,
            ],
            'ticket_public' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'ticket' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'operation_number_attempts' => [
                'type'       => 'INT',
                'default'    => 0,
                'null'       => true,
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
        $this->forge->addKey('id_request', true);
        $this->forge->createTable('connection_request');
    }

    public function down()
    {
        $this->forge->dropTable('connection_request');
    }
}
