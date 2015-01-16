<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competition extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('FSCompetition');
    }

    public function index()
    {

        echo "Hello, world!";

    }

    public function details($id)
    {
        $this->load->model('FSCompetition');
        $this->load->library('table');

        $query = $this->FSCompetition->get_competition_info($id);

        echo $this->table->generate($query);
    }

    public function results($id)
    {
        $this->load->model('FSResultModel');
        $query = $this->FSCompetition->get_competition_results($id);

    }
}