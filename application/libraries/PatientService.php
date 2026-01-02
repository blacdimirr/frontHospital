<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PatientService
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('patient_model');
    }

    public function findPossibleDuplicates($payload)
    {
        return $this->ci->patient_model->findPossibleDuplicates($payload);
    }
}
