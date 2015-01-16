<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaceModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_places($count,$offset){
        $select_clause = "SELECT place.ID as ID, place.name as Место";
        $from_clause = " FROM place";
        $where_clause = "";
        $order_clause = "";
        $limit_clause = " LIMIT ".$offset.",".$count;

        $query = $select_clause.$from_clause.$where_clause.$order_clause.$limit_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_places_list(){
        $select_clause = "SELECT place.ID as ID, place.name as Место";
        $from_clause = " FROM place";
        $where_clause = "";
        $order_clause = "";
        $limit_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.$limit_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function places_count(){
        $select_clause = "SELECT count(*) as count";
        $from_clause = " FROM place";
        $order_clause = "";
        $where_clause="";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_place_info($ID){
        $select_clause = "SELECT ID, name";
        $from_clause = " FROM place";
        $where_clause = " WHERE place.ID = $ID";
        $order_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function add_place($name){
        $query = 	"INSERT INTO place(name)
					VALUES ('$name');";
        $res = 	$this->db->query($query);
        return $res;
    }

    function update_place($ID, $name){
        $query = 	"UPDATE place
                    SET name = '$name'
                    WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }

    function delete_place($ID){
        $query = 	"DELETE FROM place WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }
}