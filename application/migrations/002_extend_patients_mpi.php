<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Extend_patients_mpi extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'documento_tipo' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ),
            'documento_numero' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'nacionalidad' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'sexo' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ),
            'fecha_nacimiento' => array(
                'type' => 'DATE',
                'null' => true,
            ),
            'direccion_detallada' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'municipio' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'provincia' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ),
            'contacto_emergencia' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ),
            'responsable_legal' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ),
            'consentimiento_datos' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ),
            'fecha_consentimiento' => array(
                'type' => 'DATE',
                'null' => true,
            ),
        );

        $this->dbforge->add_column('patients', $fields);
        $this->db->query('CREATE INDEX idx_patients_documento ON patients(documento_tipo, documento_numero)');
        $this->db->query('CREATE INDEX idx_patients_name_fecha_nacimiento ON patients(patient_name, fecha_nacimiento)');
    }

    public function down()
    {
        $this->db->query('DROP INDEX idx_patients_documento ON patients');
        $this->db->query('DROP INDEX idx_patients_name_fecha_nacimiento ON patients');

        $this->dbforge->drop_column('patients', 'documento_tipo');
        $this->dbforge->drop_column('patients', 'documento_numero');
        $this->dbforge->drop_column('patients', 'nacionalidad');
        $this->dbforge->drop_column('patients', 'sexo');
        $this->dbforge->drop_column('patients', 'fecha_nacimiento');
        $this->dbforge->drop_column('patients', 'direccion_detallada');
        $this->dbforge->drop_column('patients', 'municipio');
        $this->dbforge->drop_column('patients', 'provincia');
        $this->dbforge->drop_column('patients', 'contacto_emergencia');
        $this->dbforge->drop_column('patients', 'responsable_legal');
        $this->dbforge->drop_column('patients', 'consentimiento_datos');
        $this->dbforge->drop_column('patients', 'fecha_consentimiento');
    }
}
