<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Set_env
{
    function __construct()
    {
        $this->set_timezone('Asia/Bangkok');
    }

    private function set_timezone($zone)
    {
        date_default_timezone_set($zone);
    }
}
