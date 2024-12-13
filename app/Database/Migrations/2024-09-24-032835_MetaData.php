<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MetaData extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'feature' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'meta_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'meta_description' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id', true); // Set id as primary key
        $this->forge->addUniqueKey('feature'); // Unique key for feature
        $this->forge->createTable('meta_data');
    }

    public function down()
    {
        $this->forge->dropTable('meta_data');
    }
}
