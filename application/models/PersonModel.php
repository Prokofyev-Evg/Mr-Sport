<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_persons($count,$offset){
        $select_clause = "SELECT person.ID AS ID, person.fName AS Имя, person.lName AS Фамилия, person.birthDate AS 'Дата рождения', action.name AS Деятельность, genderMen as Пол, place.name as Город";
        $from_clause = " FROM person, place, action";
        $where_clause = " WHERE action.ID = person.actionID AND person.placeID = place.ID";
        $order_clause = " ORDER BY person.ID DESC";
        $limit_clause = " LIMIT ".$offset.",".$count;

        $query = $select_clause.$from_clause.$where_clause.$order_clause.$limit_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_persons_list(){
        $select_clause = "SELECT person.ID AS ID, CONCAT(person.lName,' ',person.fName) AS Спортсмен";
        $from_clause = " FROM person";
        $where_clause = " ";
        $order_clause = " ORDER BY person.lName";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function persons_count(){
        $this->load->database();
        $select_clause = "SELECT count(*) as count";
        $from_clause = " FROM person";
        $order_clause = "";
        $where_clause="";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function get_person_info($ID){
        $select_clause = "SELECT person.fName AS fName, person.lName AS lName, person.birthDate AS birthDate, person.actionID AS actionID, placeID as placeID, genderMen as genderMen, person.photo AS photo";
        $from_clause = " FROM person";
        $where_clause = " WHERE person.ID = $ID";
        $order_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function add_person($fName, $lName, $birthDate, $genderMen, $placeID, $actionID){
        $query = 	"INSERT INTO person(fName, lName, birthDate, genderMen, placeID, actionID)
					VALUES ('$fName', '$lName', '$birthDate', '$genderMen', '$placeID', '$actionID');";
        $res = 	$this->db->query($query);
        return $res;
    }

    function update_person($ID, $fName, $lName, $birthDate, $genderMen, $placeID, $actionID){
        $query = 	"UPDATE person
                    SET fName = '$fName', lName = '$lName', birthdate = '$birthDate', genderMen = '$genderMen', placeID = '$placeID', actionID = '$actionID'
                    WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }

    function delete_person($ID){
        $query = 	"DELETE FROM person WHERE ID = $ID;";
        $res = 	$this->db->query($query);
        return $res;
    }

}