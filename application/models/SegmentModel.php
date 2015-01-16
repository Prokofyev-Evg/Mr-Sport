<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SegmentModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_segments_of_competition($ID){
        $select_clause = "SELECT segments.ID AS ID, category.name AS 'Разряд', segments.groupNum AS 'Группа', programType.name AS 'Программа', segments.gender AS 'Пол' ";
        $from_clause = "FROM segments, category, programType ";
        $where_clause = "WHERE segments.categoryID = category.ID AND segments.programTypeID = programType.ID AND segments.competitionID = $ID ";
        $order_clause = "ORDER BY segments.gender, programType.name, category.name";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_categories_list(){
        $select_clause = "SELECT category.name AS 'Разряд', category.ID AS 'ID' ";
        $from_clause = "FROM category ";
        $where_clause = "";
        $order_clause = "ORDER BY category.ID";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_programs_list(){
        $select_clause = "SELECT programType.name AS 'Программа', programType.ID AS 'ID' ";
        $from_clause = "FROM programType ";
        $where_clause = "";
        $order_clause = "ORDER BY programType.ID";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_segment_info($ID){
        $select_clause = "SELECT segments.categoryID, segments.groupNum, segments.programTypeID, segments.gender ";
        $from_clause = "FROM segments ";
        $where_clause = "WHERE segments.ID = $ID";
        $order_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function add_segment($competitionID, $categoryID, $groupNum, $programTypeID, $gender){
        $query = 	"INSERT INTO segments(competitionID, categoryID, groupNum, programTypeID, gender)
					VALUES ('$competitionID', '$categoryID', '$groupNum', '$programTypeID', '$gender');";
        $res = 	$this->db->query($query);
        return $res;
    }

    function update_segment($ID, $competitionID, $categoryID, $groupNum, $programTypeID, $gender){
        $query = 	"UPDATE segments
					SET competitionID = '$competitionID', categoryID = '$categoryID', groupNum = '$groupNum', programTypeID = '$programTypeID', gender = '$gender'
					WHERE ID = $ID";
        $res = 	$this->db->query($query);
        return $res;
    }

    function delete_segment($ID){
        $query = 	"DELETE FROM segments WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }

}