<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Devis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'total_devis' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => '0.00',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => null,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('devis');
    }

    public function down()
    {
        $this->forge->dropTable('devis');
    }
}
