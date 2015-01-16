<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActionModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_actions(){
        $select_clause = "SELECT action.name as Место, action.ID as ID";
        $from_clause = " FROM action";
        $where_clause = "";
        $order_clause = "";

        $query = $select_clause.$from_clause.$where_clause.$order_clause.';';
        $res = 	$this->db->query($query);
        return $res;
    }

    function add_action($name){
        $query = 	"INSERT INTO action(name)
					VALUES ('$name');";
        $res = 	$this->db->query($query);
        return $res;
    }

    function update_action($id, $name){
        $query = 	"UPDATE action
                    SET name = '$name'
                    WHERE ID = $id;";
        $res = 	$this->db->query($query);
        return $res;
    }

    function delete_action($id){
        $query = 	"DELETE FROM action WHERE ID = $id;";
        $res = 	$this->db->query($query);
        return $res;
    }
}