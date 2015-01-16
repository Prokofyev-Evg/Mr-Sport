<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompetitionModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_competitions($count,$offset){
        $select_clause = "SELECT competition.ID AS ID, competition.name AS Соревнование, competition.discription AS Описание, competition.date AS Дата, competition.durationDays AS Продолжительность, sport.name AS 'Вид спорта', place.name as Место";
        $from_clause = " FROM competition, sport, place";
        $where_clause = " WHERE competition.sportID = sport.ID AND competition.placeID = place.ID";
        $order_clause = " ORDER BY competition.ID DESC";
        $limit_clause = " LIMIT ".$offset.",".$count;

        $query = $select_clause.$from_clause.$where_clause.$order_clause.$limit_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function competitions_count(){
        $select_clause = "SELECT count(*) as count";
        $from_clause = " FROM competition";
        $order_clause = "";
        $where_clause="";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_last_id(){
        $select_clause = "SELECT ID";
        $from_clause = " FROM competition";
        $where_clause="";
        $order_clause = " LIMIT 1";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_competition_info($id){
        $select_clause = "SELECT competition.name AS competitionName, competition.discription AS competitionDiscription, competition.date AS date, competition.durationDays AS days, placeID as placeID, competition.image AS image";
        $from_clause = " FROM competition";
        $where_clause = " WHERE competition.ID = $id";
        $order_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function add_competition($name, $discription, $date, $days, $placeid){
        $query = 	"INSERT INTO competition(name, discription, date, durationdays, sportid, placeID)
					VALUES ('$name', '$discription', '$date', '$days', '1', '$placeid');";
        $res = 	$this->db->query($query);
        return $res;
    }
    function update_competition($id, $name, $discription, $date, $days, $placeid){
        $query = 	"UPDATE competition
					SET name = '$name', discription = '$discription', date = '$date', DurationDays = '$days', sportid = '1', placeID = '$placeid'
					WHERE ID = $id;";
        $res = 	$this->db->query($query);
        return $res;
    }
    function delete_competition($id){
        $query = 	"DELETE FROM competition WHERE ID = $id;";
        $res = 	$this->db->query($query);
        return $res;
    }



}