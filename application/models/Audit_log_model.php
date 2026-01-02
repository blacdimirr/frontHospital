<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Audit_log_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add($data)
    {
        $this->db->insert('audit_log', $data);
        return $this->db->insert_id();
    }
}
