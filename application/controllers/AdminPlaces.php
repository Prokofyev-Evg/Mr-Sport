<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPlaces extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // Подключаем необходимые модели, классы и хелперы
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('PlaceModel');
        //$this->output->enable_profiler(TRUE);
    }

    public function index($offset = null){
        // Получаем необходимое количество городов
        $offset = $offset ? $offset : 0;
        $data['table'] = $this->generate_places_table(10,$offset);
        $data['pageType'] = 'table';
        $data['config'] = $this->configure_pagination();

        // Загружаем страницу
        $this->load_page($data);
    }

    public function placeEdit($placeID = null){
        $data['ID'] = $placeID;
        // Обработка нажатия кнопок
        if($this->input->post('add'))
            $data['queryResult'] = $this->PlaceModel->add_place($this->input->post('name'));
        elseif($this->input->post('refresh'))
            $data['queryResult'] = $this->PlaceModel->update_place($placeID, $this->input->post('name'));
        elseif($this->input->post('delete'))
            $data['queryResult'] = $this->PlaceModel->delete_place($placeID);

        // Получаем информацию о городе
        if(!$this->input->post('delete'))
            if(isset($placeID)){
                $query = $this->PlaceModel->get_place_info($placeID)->result_array();
                if($query)
                    $data = array_merge($data, $query[0]);
                else
                    $data['pageType'] == 'error';
            }
        $data['pageType'] = 'placeEdit';
        $this->load_page($data);
    }

    private function generate_places_table($count,$offset){
        $places = $this->PlaceModel->get_places($count,$offset)->result_array();
        for($i = 0; $i < count($places); $i++){
            // Добавляем ссылку на страницу редактирования места
            $places[$i]['Редактировать'] = anchor(site_url("adminplaces/placeEdit/".$places[$i]['ID']), '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array('class' => 'btn btn-primary btn-xs'));
        }
        return $places;
    }

    private function configure_pagination(){
        $config['base_url'] = 'http://localhost/mr-sport/index.php/adminplaces/index';
        $config['total_rows'] = $this->PlaceModel->places_count()->result_array()[0]['count'];
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
        elseif($data['pageType'] == 'placeEdit')
            $this->load->view('admin/b_placeDetails',$data);
        elseif($data['pageType'] == 'error')
            $this->load->view('admin/b_error',$data);
        $this->load->view('admin/footer');
    }
}
?>