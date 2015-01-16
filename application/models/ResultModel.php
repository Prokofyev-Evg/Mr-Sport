<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResultModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_results_of_segment($ID){
        $select_clause = "SELECT result.ID AS 'ID', person.fName AS 'Имя', person.lName AS 'Фамилия', ROUND(result.technicalScore,2) AS 'Сумма за элементы', ROUND(result.componentScore,2) AS 'Сумма за компоненты', ROUND(result.deduction,2) AS 'Снижения', ROUND(result.technicalScore + result.componentScore - result.deduction,2) AS 'Результат'";
        $from_clause = " FROM result, person";
        $where_clause = " WHERE result.segmentID = ".$ID." AND result.sportsmenID = person.ID";
        $order_clause = " ORDER BY (result.technicalScore + result.componentScore - result.deduction) DESC";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_result_info($ID){
        $select_clause = "SELECT *";
        $from_clause = " FROM result";
        $where_clause = " WHERE result.ID = $ID";
        $order_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function add_result($segmentID, $sportsmenID, $technicalScore, $componentScore, $deduction){
        $query = 	"INSERT INTO result(segmentID, sportsmenID, technicalScore, componentScore, deduction)
					VALUES ('$segmentID', '$sportsmenID', '$technicalScore', '$componentScore', '$deduction');";
        $res = 	$this->db->query($query);
        return $res;
    }

    function update_result($ID, $segmentID, $sportsmenID, $technicalScore, $componentScore, $deduction){
        $query = 	"UPDATE result
                    SET segmentID = '$segmentID', sportsmenID = '$sportsmenID', technicalScore = '$technicalScore', componentScore = '$componentScore', deduction = '$deduction'
                    WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }

    function delete_result($ID){
        $query = 	"DELETE FROM result WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }

}