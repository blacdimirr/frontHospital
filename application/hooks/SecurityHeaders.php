<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SecurityHeaders
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function apply()
    {
        $this->CI->output->set_header('X-Frame-Options: SAMEORIGIN');
        $this->CI->output->set_header('X-Content-Type-Options: nosniff');
        $this->CI->output->set_header('Referrer-Policy: strict-origin-when-cross-origin');
        $this->CI->output->set_header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
        $this->CI->output->set_header('X-XSS-Protection: 1; mode=block');
    }
}
