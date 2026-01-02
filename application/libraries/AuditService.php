<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AuditService
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('user_agent');
        $this->CI->load->library('Customlib');
        $this->CI->load->model('Audit_log_model');
    }

    public function log($modulo, $accion, $entidad, $entidad_id, $resumen = '')
    {
        $payload_resumen = $resumen;
        if (is_array($resumen) || is_object($resumen)) {
            $payload_resumen = json_encode($resumen);
        }

        $data = array(
            'user_id'         => $this->CI->customlib->getLoggedInUserID(),
            'modulo'          => $modulo,
            'accion'          => $accion,
            'entidad'         => $entidad,
            'entidad_id'      => $entidad_id,
            'payload_resumen' => $payload_resumen,
            'ip'              => $this->CI->input->ip_address(),
            'user_agent'      => $this->CI->agent->agent_string(),
            'created_at'      => date('Y-m-d H:i:s'),
        );

        return $this->CI->Audit_log_model->add($data);
    }
}
