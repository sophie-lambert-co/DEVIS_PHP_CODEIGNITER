<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{ public function up()
    {
        // Création de la table users
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'n_siret' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'adresse_entrprise' => [
                'type' => 'TEXT',
            ],
            'tel' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'is_admin' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Suppression de la table users
        $this->forge->dropTable('users');
    }
}
