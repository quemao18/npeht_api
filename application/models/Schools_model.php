<?php

class Schools_model extends CI_Model
{
    public function school_id($id){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("schools", array("schools.id_school" => $id));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }


    public function delete_school($school){
        if($this->db->delete('schools', array('id_school' => $school->id_school)))
            return true;
            else
            return false;
    }



    public function school_status($id){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("schools", "schools.id_school=".$id);
        if($query->num_rows() == 1){
            return $query->row();
        }
    }


    public function new_school($school){
   //$this->db->select("*");
    $data = array(
            //"id_user" => $user->id_user,
            "name" => $school->name,
            "url" => $school->url,
            "date_from" => $school->date_from->jsdate,
            //"date_finish" => $school->date_finish,
            "date_create" => date('Y-m-d H:i:s'),
            "ita_user_create" => $school->users->ita,
            "description" => $school->description,
            "duration" => $school->duration,
            "status" => '1'
        );
    //var_dump($data);
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('schools.url', $school->url)->get('schools');

        if($query->num_rows() == 0){
        //  if($this->db->insert("news", $data)){
            $this->db->insert("schools", $data);
            return true;
        }else{
            return false;
        }
    }


       public function update_school($school){

        $data = array(
            //"id_user" => $user->id_user,
            "name" => $school->name,
            "url" => $school->url,
            "date_from" => $school->date_from,
            "description" => $school->description,
            "ita_user_update" => $school->ita_login,
            "ita_user_create" => $school->users->ita,
            "duration" => $school->duration,
            //"date_finish" => $school->date_finish,
            "date_update" => date('Y-m-d H:i:s')
        );
        //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');
        //$ignore = array($media->url);
        //$this->db->where_not_in('medias.url', $ignore);
        if(!$this->check_url($school->url, $school->id_school) && !$this->check_url_id_school($school->url, $school->id_school) ){
            return false;
        }else{
            $this->db->update('schools', $data, array('id_school' => $school->id_school));
            return true;
        }
       
    }

    public function check_url($url, $id_school)
	{
			$id = $this->db->query(
					"select url from schools where url = '$url' and id_school != '$id_school' "
			);

		if($id->num_rows() < 1)
			return true;
		else
			return false;
		 
    }
    
    public function check_url_id_school($url, $id_school)
	{
			$id = $this->db->query(
					"select url from schools where url = '$url' and id_school = '$id_school' "
			);

		if($id->num_rows() == 1)
			return true;
		else
			return false;
		 
	}	

    public function update_status($school){
        if($school->status == 1)
        $data = array(
            "status" => 0, //inactivo
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
        $query = $this->db->update('schools', $data, array('id_school' => $school->id_school));
        if($query){
            return true;
        }else{
            return false;
        }
       
    }

    public function schools($q, $limit, $start)
    {
        if(!empty($start) || !empty($limit) || !is_null($start) || !is_null($limit))
        $this->db->limit($limit, $start);
 
        if(!empty($q)){
        $this->db->like('schools.name', $q);  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        $this->db->or_like('schools.ita_user_create', $q);  
        $this->db->or_like('users.name', $q);  
        $this->db->or_like('users.last', $q);  
        }

        $this->db->select('
        schools.id_school, 
        schools.name,
        schools.description,
        schools.url,
        schools.date_create,
        schools.date_from,
        schools.ita_user_create,
        users.name as name_user_create,
        users.last as last_user_create, 
        schools.ita_user_update,
        users.name as name_user_update,
        users.last as last_user_update, 
        schools.status,
        schools.duration, 
        users.photo as avatar_url
        ');
        $this->db->join('users', 'users.ita=schools.ita_user_create');
        //$this->db->join('positions', 'positions.id_position=users.id_position');
        //$this->db->join('questions', 'questions.id_question=users.id_question');
        //$this->db->limit(1000, 0);
        //$this->db->group_by('users.ita');
        $this->db->order_by('date_create DESC');
        $query = $this->db->get("schools");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }


}