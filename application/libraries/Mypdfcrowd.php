<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mypdfcrowd {
    
    public function __construct()
    {
        require_once APPPATH.'third_party/pdfcrowd.php';
    }
}