<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_audit_log extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
            'modulo' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ),
            'accion' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ),
            'entidad' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ),
            'entidad_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
            'payload_resumen' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ),
            'user_agent' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => false,
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('modulo');
        $this->dbforge->add_key('accion');
        $this->dbforge->add_key('entidad');
        $this->dbforge->add_key('entidad_id');
        $this->dbforge->add_key('created_at');
        $this->dbforge->create_table('audit_log', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('audit_log', true);
    }
}
