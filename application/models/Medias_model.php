<?php

class Medias_model extends CI_Model
{
    public function media_id($id_media){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("medias", array("medias.id_media" => $id_media));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }


    public function audio_id($id_audio){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("audios", array("audios.id_audio" => $id_audio));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }


    public function media_status($id_media){
        $this->db->select("medias.name, medias.status ");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("medias", "medias.id_media=".$id_media);
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

    public function audio_status($id_audio){
        $this->db->select("audios.name, audios.status ");
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

    public function new_media($media){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $media->name,
            "url" => $media->url,
            "ita_user_create" => $media->users->ita,
            "id_category" => $media->id_category,
            "id_sub_category" => $media->id_sub_category,
            "description" => $media->description,
            "status" => 1, //activo
            "duration" => $media->duration,
            "date_create" => date('Y-m-d H:i:s')
        );
    //print_r($data);
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('medias.url', $media->url)->get('medias');

        if($query->num_rows() == 0){
            $this->db->insert("medias", $data);
            return true;
        }else{
            return false;
        }
    }


    public function new_audio($media){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $media->name,
            "url" => $media->url,
            "ita_user_create" => $media->users->ita,
            "id_module" => $media->id_module,
            "is_audio" => $media->is_audio,
            "description" => $media->description,
            "status" => 1, //activo
            "file_name" => $media->file_name,
            "duration" => $media->duration,
            "date_create" => date('Y-m-d H:i:s')
        );
    //print_r($data);
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('audios.url', $media->url)->get('audios');

        if($query->num_rows() == 0){
            $this->db->insert("audios", $data);
            return true;
        }else{
            return false;
        }
    }

    public function delete_media($media){
        if($this->db->delete('medias', array('id_media' => $media->id_media)))
            return true;
            else
            return false;
    }

    public function delete_audio($media){
        if($this->db->delete('audios', array('id_audio' => $media->id_audio)))
            return true;
            else
            return false;
    }


    public function new_category($category){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $category->name,
        );
    //print_r($data);
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('categories.name',  $category->name)->get('categories');

        if($query->num_rows() == 0){
            $this->db->insert("categories", $data);
            return true;
        }else{
            return false;
        }
    }


    public function new_module($module){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $module->name,
        );
    //print_r($data);
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('modules.name',  $module->name)->get('modules');

        if($query->num_rows() == 0){
            $this->db->insert("modules", $data);
            return true;
        }else{
            return false;
        }
    }


   public function update_media($media){

        $data = array(
            //"id_user" => $user->id_user,
            "name" => $media->name,
            "url" => $media->url,
            "ita_user_create" => $media->users->ita,
            "id_category" => $media->id_category,
            "id_sub_category" => $media->id_sub_category,
            "description" => $media->description,
            "duration" => $media->duration,
            "date_update" => date('Y-m-d H:i:s')
        );
        //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');
        //$ignore = array($media->url);
        //$this->db->where_not_in('medias.url', $ignore);
        if(!$this->check_url($media->url, $media->id_media) && !$this->check_url_id_media($media->url, $media->id_media) ){
            return false;
        }else{
            $this->db->update('medias', $data, array('id_media' => $media->id_media));
            return true;
        }
       
    }

   public function update_audio($media){

        $data = array(
            //"id_user" => $user->id_user,
            "name" => $media->name,
            "url" => $media->url,
            "ita_user_create" => $media->users->ita,
            "id_module" => $media->id_module,
            "is_audio" => $media->is_audio,
            "description" => $media->description,
            "file_name" => $media->file_name,
            "duration" => $media->duration,
            "date_update" => date('Y-m-d H:i:s')
        );
        //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');
        //$ignore = array($media->url);
        //$this->db->where_not_in('medias.url', $ignore);
        if(!$this->check_url_audio($media->url, $media->id_audio) && !$this->check_url_id_audio($media->url, $media->id_audio) ){
            return false;
        }else{
            $this->db->update('audios', $data, array('id_audio' => $media->id_audio));
            return true;
        }
       
    }


    public function check_url($url, $id_media)
	{
			$id = $this->db->query(
					"select url from medias where url = '$url' and id_media != '$id_media' "
			);

		if($id->num_rows() < 1)
			return true;
		else
			return false;
		 
	}	

    public function check_url_audio($url, $id_audio)
	{
			$id = $this->db->query(
					"select url from audios where url = '$url' and id_audio != '$id_audio' "
			);

		if($id->num_rows() < 1)
			return true;
		else
			return false;
		 
	}	

    public function check_url_id_media($url, $id_media)
	{
			$id = $this->db->query(
					"select url from medias where url = '$url' and id_media = '$id_media' "
			);

		if($id->num_rows() == 1)
			return true;
		else
			return false;
		 
	}	


    public function check_url_id_audio($url, $id_audio)
	{
			$id = $this->db->query(
					"select url from audios where url = '$url' and id_audio = '$id_audio' "
			);

		if($id->num_rows() == 1)
			return true;
		else
			return false;
		 
	}	
	
    public function update_status($media){
        if($media->status == 1)
        $data = array(
            "status" => 0, //inactivo
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
        $query = $this->db->update('medias', $data, array('id_media' => $media->id_media));
        if($query){
            return true;
        }else{
            return false;
        }
       
    }

	
    public function update_status_audio($media){
        if($media->status == 1)
        $data = array(
            "status" => 0, //inactivo
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
        $query = $this->db->update('audios', $data, array('id_audio' => $media->id_audio));
        if($query){
            return true;
        }else{
            return false;
        }
       
    }

    public function medias($id_category, $q, $limit, $start)
    {

        if(!empty($start) || !empty($limit) || !is_null($start) || !is_null($limit))
        $this->db->limit($limit, $start);
 
        if(!empty($id_category))
        $this->db->where ('medias.id_category', $id_category);
        if(!empty($q)){
        $this->db->like('medias.name', $q);  
        $this->db->or_like('medias.ita_user_create', $q);  
        $this->db->or_like('users.name', $q);  
        $this->db->or_like('users.last', $q);  
        }

        $this->db->select('
        medias.id_media, 
        medias.name,
        medias.description,
        medias.url,
        medias.date_create,
        medias.ita_user_create,
        users.name as name_user_create,
        users.last as last_user_create, 
        medias.ita_user_update,
        users.name as name_user_update,
        users.last as last_user_update, 
        medias.id_category,
        categories.name as name_category,
        medias.id_sub_category,
        sub_categories.name as name_sub_category,
        medias.status,
        medias.duration, 
        users.photo as avatar_url

        ');
        $this->db->join('categories', 'categories.id_category=medias.id_category');
        $this->db->join('sub_categories', 'sub_categories.id_sub_category=medias.id_sub_category');
        $this->db->join('users', 'users.ita=medias.ita_user_create');
        //$this->db->limit(1000, 0);
        $this->db->group_by('medias.id_media');
        $this->db->order_by('medias.date_create DESC');
        $query = $this->db->get("medias");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function audios($id_module, $q, $limit, $start)
    {
        if(!empty($start) || !empty($limit))
        $this->db->limit($limit, $start);
        if(!empty($id_module))
        $this->db->where ('audios.id_module', $id_module);
        if(!empty($q)){
        $this->db->like('audios.name', $q);  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        $this->db->or_like('audios.ita_user_create', $q);  
        $this->db->or_like('users.name', $q);  
        $this->db->or_like('users.last', $q);  
        }

        $this->db->select('
        audios.id_audio, 
        audios.name,
        audios.description,
        audios.url,
        audios.date_create,
        audios.ita_user_create,
        users.name as name_user_create,
        users.last as last_user_create, 
        audios.ita_user_update,
        users.name as name_user_update,
        users.last as last_user_update, 
        audios.id_module,
        modules.name as name_module,
        audios.status, 
        audios.is_audio,
        audios.file_name,
        audios.duration,
        users.photo as avatar_url
        ');
        $this->db->join('modules', 'modules.id_module=audios.id_module');
        $this->db->join('users', 'users.ita=audios.ita_user_create');

        //$this->db->limit(1000, 0);
        $this->db->group_by('audios.id_audio');
        $this->db->order_by('audios.date_create DESC');
        $query = $this->db->get("audios");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }


    public function media_url($url)
    {
        $this->db->select('medias.*');
        //$this->db->join('rols', 'rols.id_rol=users.id_rol');
        //$this->db->join('positions', 'positions.id_position=users.id_position');
        //print_r($ita);
        //$query = $this->db->get("users");
        $query = $this->db->get_where("medias", "medias.url='$url'");
       if($query->num_rows() == 1){
            return $query->row();
        }
    }

    public function categories()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
        $this->db->select('*, 
        (SELECT count(*) from medias where medias.id_category = categories.id_category) as videos
        ');
        $query = $this->db->get("categories");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function modules()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
        $this->db->select('*,
        (SELECT count(*) from audios where audios.id_module = modules.id_module) as audios
        ');
        $query = $this->db->get("modules");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }


    public function sub_categories($id_category)
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
        $this->db->select('*');
        //$query = $this->db->get("sub_categories");
        if($id_category>0)
        $query = $this->db->get_where("sub_categories", "sub_categories.id_category='$id_category'");
        else
        $query = $this->db->get("sub_categories");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("medias");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
     
    public function get_total() 
    {
        return $this->db->count_all("medias");
    }



}