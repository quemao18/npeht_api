<?php

class Audios_model extends CI_Model
{
    public function audio_id($id_audio){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("audios", array("audios.id_audio" => $id_audio));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

    public function user($user){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("users", array("users.ita" => $user->username, "users.password"=>md5($user->password)));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

    public function audios_modules()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
        $this->db->select('*');
        $query = $this->db->get("modules");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function audio_status($id_audio){
        $this->db->select("audios.id_audio, audios.status ");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("audios", "audios.id_audio=".$id_audio);
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

    function get_enum_values( $table, $field )
    {
        $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    public function new_audio($audio){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $audio->name,
            "description" => $audio->description,
            "rute" => $audio->rute,
            "id_module" => $audio->id_module,
            "id_user_create" => $audio->id_user,
            "status" => 1, //activo
            "date_create" => date('Y-m-d H:i:s')
        );
    
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    //$query = $this->db->where('ita', $user->ita)->or_where('email', $user->email)->get('users');

        if($query->num_rows() == 0){
            $this->db->insert("audios", $data);
            return true;
        }else{
            return false;
        }
    }

    public function update_audio($audio){
          $data = array(
            //"id_user" => $user->id_user,
            "name" => $audio->name,
            "description" => $audio->description,
            "rute" => $audio->rute,
            "id_module" => $audio->id_module,
            "id_user_update" => $audio->id_user,
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
        //query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');

            if($this->db->update('audios', $data, array('id_audio' => $audio->id_audio)))
            return true;
            else
            return false;
        
    }

    public function check_audio($id_audio, $id_user)
	{
			$id = $this->db->query(
					"select id_audio from audios where id_audio = '$id_audio' and id_user_create = '$id_user'"
			);

		if($id->num_rows() == 1)
			return true;
		else
			return false;
		 
	}	
	
    public function update_status($audio){
        if($audio->status == 1)
        $data = array(
            "status" => 0, //inactivo
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
        $query = $this->db->update('audios', $data, array('id_audio' => $audio->id_audio));
        if($query){
            return true;
        }else{
            return false;
        }
       
    }

    public function users()
    {
        $this->db->select('audios.*, modules.*');
        $this->db->join('modules', 'modules.id_module=audios.id_module');
        //$this->db->join('positions', 'positions.id_position=users.id_position');
        $query = $this->db->get("audios");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }




}