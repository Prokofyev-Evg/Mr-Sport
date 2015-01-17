<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCompetition extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // Подключаем необходимые модели, классы и хелперы
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->model('CompetitionModel');
        $this->load->model('SegmentModel');
        $this->load->model('PersonModel');
        $this->load->model('PlaceModel');
        $this->load->model('ResultModel');
        //$this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0){
        $data['config'] = $this->configure_pagination();
        $data['table'] = $this->generate_competitions_table(10,$offset);
        $data['pageType'] = 'table';
        // Загружаем страницу
        $this->load_page($data);
    }

    public function competition($competitionID = null){
        if(isset($competitionID))
        {
            $data['table'] = $this->generate_segments_table($competitionID);
            $data['pageType'] = 'table';
        }
        else
        {
            $data['config'] = $this->configure_pagination();
            $data['table'] = $this->generate_competitions_table(10,0);
            $data['pageType'] = 'table';
        }
        // Загружаем страницу
        $this->load_page($data);
    }

    public function segment($segmentID = null){
        if(isset($segmentID))
        {
            $data['table'] = $this->generate_results_table($segmentID);
            $data['pageType'] = 'resultTable';
            $data['segmentID'] = $segmentID;
        }
        else
        {
            $data['pageType'] = 'error';
        }
        // Загружаем страницу
        $this->load_page($data);
    }

    public function competitionEdit($competitionID = null){
        // Обработка нажатия кнопок
        $data['pageType'] = 'competitionEdit';
        if($this->input->post('add'))
            $data['queryResult'] = $this->CompetitionModel->add_competition($this->input->post('competitionName'), $this->input->post('competitionDiscription'), $this->input->post('date'), $this->input->post('days'), $this->input->post('placeID'));
        elseif($this->input->post('refresh'))
            $data['queryResult'] = $this->CompetitionModel->update_competition($competitionID, $this->input->post('competitionName'), $this->input->post('competitionDiscription'), $this->input->post('date'), $this->input->post('days'), $this->input->post('placeID'));
        elseif($this->input->post('delete'))
            $data['queryResult'] = $this->CompetitionModel->delete_competition($competitionID);

        if(!($this->input->post('delete')))
            if(isset($competitionID)){
                $query = $this->CompetitionModel->get_competition_info($competitionID)->result_array();
                if (isset($query[0]))
                    $data = array_merge($data, $query[0]);
            }

        $data['ID'] = $competitionID;
        $data['places'] = $this->PlaceModel->get_places_list()->result_array();
        // Загружаем страницу
        $this->load_page($data);
    }

    public function segmentEdit($competitionID = null,$segmentID = null){
        // Обработка нажатия кнопок
        $data['pageType'] = 'segmentEdit';
        if($this->input->post('add'))
            $data['queryResult'] = $this->SegmentModel->add_segment($competitionID, $this->input->post('categoryID'), $this->input->post('groupNum'), $this->input->post('programTypeID'), $this->input->post('gender'));
        elseif($this->input->post('refresh'))
            $data['queryResult'] = $this->SegmentModel->update_segment($segmentID, $competitionID, $this->input->post('categoryID'), $this->input->post('groupNum'), $this->input->post('programTypeID'), $this->input->post('gender'));
        elseif($this->input->post('delete'))
            $data['queryResult'] = $this->SegmentModel->delete_segment($segmentID);

        if(!($this->input->post('delete')))
            if(isset($segmentID)){
                $query = $this->SegmentModel->get_segment_info($segmentID)->result_array();
                if (isset($query[0]))
                    $data = array_merge($data, $query[0]);
            }

        $data['segmentID'] = $segmentID;
        $data['competitionID'] = $competitionID;
        $data['categories'] = $this->SegmentModel->get_categories_list()->result_array();
        $data['programs'] = $this->SegmentModel->get_programs_list()->result_array();
        // Загружаем страницу
        $this->load_page($data);
    }

    public function resultEdit($segmentID = null,$resultID = null){
        // Обработка нажатия кнопок
        if($segmentID)
            $data['pageType'] = 'resultEdit';
        else{
            $data['pageType'] = 'error';
            $_POST = array();
        }
        if($this->input->post('add'))
            $data['queryResult'] = $this->ResultModel->add_result($segmentID, $this->input->post('sportsmenID'), $this->input->post('technicalScore'), $this->input->post('componentScore'), $this->input->post('deduction'));
        elseif($this->input->post('refresh'))
            $data['queryResult'] = $this->ResultModel->update_result($resultID, $segmentID, $this->input->post('sportsmenID'), $this->input->post('technicalScore'), $this->input->post('componentScore'), $this->input->post('deduction'));
        elseif($this->input->post('delete'))
            $data['queryResult'] = $this->ResultModel->delete_result($resultID);

        if(!($this->input->post('delete')))
            if(isset($resultID)){
                $query = $this->ResultModel->get_result_info($resultID)->result_array();
                if (isset($query[0]))
                    $data = array_merge($data, $query[0]);
            }

        $data['segmentID'] = $segmentID;
        $data['resultID'] = $resultID;
        $data['sportsmens'] = $this->PersonModel->get_persons_list()->result_array();
        // Загружаем страницу
        $this->load_page($data);
    }

    private function generate_competitions_table($count,$paginationOffset){
        $competitions = $this->CompetitionModel->get_competitions($count,$paginationOffset)->result_array();
        for($i = 0; $i < count($competitions); $i++){
            // Добавляем ссылку на страницу редактирования соревнования
            $competitions[$i]['Редактировать'] = anchor(site_url("admincompetition/competitionEdit/".$competitions[$i]['ID']), '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array('class' => 'btn btn-primary btn-xs'));

            // Добавляем ссылку на страницу списка разрядов
            $competitions[$i]['Соревнование'] = anchor(site_url("admincompetition/competition/".$competitions[$i]['ID']), $competitions[$i]['Соревнование']);

            // Обрезаем описание до 30 символов
            $competitions[$i]['Описание'] = $this->cut_discription($competitions[$i]['Описание']);
        }
        return $competitions;
    }

    private function generate_segments_table($competitionID = null){
        $result = $this->SegmentModel->get_segments_of_competition($competitionID)->result_array();
        $segments = '';
        for($i = 0; $i < count($result); $i++){
            // Добавляем ссылку на страницу списка разрядов
            $gender = $result[$i]['Пол'] ? "Юноши" : "Девушки";
            $groupName = $result[$i]['Группа'] == 0 ? "" : ", Группа ".$result[$i]['Группа'];
            $segments[$i]['ID'] = $result[$i]['ID'];
            $segments[$i]['Разряд'] = anchor(site_url("admincompetition/segment/".$result[$i]['ID']), $result[$i]['Разряд'].", ".$gender.$groupName);
            $segments[$i]['Сегмент'] = $result[$i]['Программа'];

            // Добавляем ссылку на страницу редактирования сегмента
            $segments[$i]['Редактировать'] = anchor(site_url("admincompetition/segmentEdit/".$competitionID.'/'.$result[$i]['ID']), '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array('class' => 'btn btn-primary btn-xs'));
        }
        return $segments;
    }

    private function generate_results_table($segmentID){
        $temp = $this->ResultModel->get_results_of_segment($segmentID)->result_array();
        for($i = 0; $i < count($temp); $i++){
            $results[$i]['Место'] = $i + 1;
            foreach($temp[$i] AS $key => $value)
                if($key!='ID')
                    $results[$i][$key] = $value;
            // Добавляем ссылку на страницу редактирования соревнования
            $results[$i]['Редактировать'] = anchor(site_url("admincompetition/resultEdit/".$segmentID.'/'.$temp[$i]['ID']), '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array('class' => 'btn btn-primary btn-xs'));
        }
        return $results;
    }

    private function configure_pagination(){
        $config['base_url'] = 'http://localhost/mr-sport/index.php/admincompetition/index';
        $config['total_rows'] = $this->CompetitionModel->competitions_count()->result_array()[0]['count'];
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
        elseif($data['pageType'] == 'resultTable')
        {
            $this->load->view('admin/mn_table',$data);
            $this->load->view('admin/btn_add_result',$data);
        }
        elseif($data['pageType'] == 'competitionEdit')
            $this->load->view('admin/b_competitionDetails',$data);
        elseif($data['pageType'] == 'segmentEdit')
            $this->load->view('admin/b_segmentDetails',$data);
        elseif($data['pageType'] == 'resultEdit')
            $this->load->view('admin/b_resultDetails',$data);
        elseif($data['pageType'] == 'error')
            $this->load->view('admin/b_error',$data);
        $this->load->view('admin/footer');
    }

    private function cut_discription($string){
        $string = substr($string, 0, 30);
        $string = substr($string, 0, strrpos($string, ' '));
        $string = rtrim($string, "!,.-");
        $string = $string."…";
        return $string;
    }

}