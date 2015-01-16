<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPersons extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // Подключаем необходимые модели, классы и хелперы
        $this->load->helper('url');
        $this->load->library('table');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->model('PersonModel');
        $this->load->model('PlaceModel');
        $this->load->model('ActionModel');
        //$this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0){
        $data['config'] = $this->configure_pagination();
        $data['table'] = $this->generate_table_persons(10,$offset);
        $data['pageType'] = 'table';
        // Загружаем страницу
        $this->load_page($data);
    }

    public function personEdit($personID = null){
        // Обработка нажатия кнопок
        $data['pageType'] = 'personEdit';
        // Обработка нажатия кнопок
        if($this->input->post('add'))          $data['queryResult'] = $this->PersonModel->add_person($this->input->post('fName'), $this->input->post('lName'), $this->input->post('birthDate'), $this->input->post('genderMen'), $this->input->post('placeID'), $this->input->post('actionID'));
        elseif($this->input->post('refresh'))  $data['queryResult'] = $this->PersonModel->update_person($personID, $this->input->post('fName'), $this->input->post('lName'), $this->input->post('birthDate'), $this->input->post('genderMen'), $this->input->post('placeID'), $this->input->post('actionID'));
        elseif($this->input->post('delete'))   $data['queryResult'] = $this->PersonModel->delete_person($personID);

        // Получаем информацию о человеке
        if(!$this->input->post('delete'))
            if(isset($personID)){
                $query = $this->PersonModel->get_person_info($personID)->result_array();
                if ($query)
                    $data = array_merge($data, $query[0]);
            }

        $data['ID'] = $personID;
        $data['places'] = $this->PlaceModel->get_places_list()->result_array();
        $data['actions'] = $this->ActionModel->get_actions()->result_array();
        // Загружаем страницу
        $this->load_page($data);
    }

    private function generate_table_persons($count,$offset){
        $persons = $this->PersonModel->get_persons($count,$offset)->result_array();
        for($i = 0; $i < count($persons); $i++){
            $persons[$i]['Редактировать'] = anchor(site_url('adminpersons/personedit/'.$persons[$i]['ID']), '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array('class' => 'btn btn-primary btn-xs'));
            $persons[$i]['Пол'] = $persons[$i]['Пол'] ? 'М':'Ж';
        }

        return $persons;
    }

    private function configure_pagination(){
        $config['base_url'] = 'http://localhost/mr-sport/index.php/adminpersons/index';
        $config['total_rows'] = $this->PersonModel->persons_count()->result_array()[0]['count'];
        $config['per_page'] = '10';
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</nav></ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_link'] = '&raquo&raquo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '&laquo&laquo';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        return $config;
    }

    private function load_page($data = array()){
        $this->load->view('admin/header',$data);
        if(isset($data['queryResult']))
            if($data['queryResult'])
                $this->load->view('admin/b_success');
            else
                $this->load->view('admin/b_error');
        if($data['pageType'] == 'table')
            $this->load->view('admin/mn_table',$data);
        elseif($data['pageType'] == 'personEdit')
            $this->load->view('admin/b_personDetails',$data);
        elseif($data['pageType'] == 'error')
            $this->load->view('admin/b_error',$data);
        $this->load->view('admin/footer');
    }
}
?>