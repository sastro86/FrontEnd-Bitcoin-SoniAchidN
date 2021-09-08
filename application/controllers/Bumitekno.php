<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bumitekno extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
    }

    public function pertama()
    {
        $this->parser->parse('bumitekno/home', [
            'page' => 'bumitekno/pertama',
        ]);
    }

    public function kedua()
    {
        $this->parser->parse('bumitekno/home', [
            'page' => 'bumitekno/kedua',
        ]);
    }

    public function ketiga()
    {
        $this->parser->parse('bumitekno/home', [
            'page' => 'bumitekno/ketiga',
        ]);
    }
}
