<?php

class Api_model extends CI_Model
{
    public function get($id){
        $this->db->select("id, username, password, register_date");
        $query = $this->db->get_where("users_api", array("id" => $id));
        if($query->num_rows() == 1){
            return $query->result();
        }
    }

    public function get_all(){
        $query = $this->db->get("users_api");
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function posts($id){
        $this->db->where("user_id", $id);
        $query = $this->db->get("messages_api");
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

     public function posts_all(){
        $this->db->select("*");
        $query = $this->db->get("messages_api");
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function create_user($username,$password){
        $data = array(
            "username" => $username,
            "password" => $password
        );
        return $this->db->insert("users_api", $data);
    }
}