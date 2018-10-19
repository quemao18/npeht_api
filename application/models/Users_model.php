<?php

class Users_model extends CI_Model
{
<<<<<<< HEAD

    public function statistics(){
        $this->db->select("*,
        (SELECT count(*) from users where id_rol = 1) as total_rol_1
        ");
        $this->db->group_by('id_rol');
        $query = $this->db->get("rols");
        if($query->num_rows() > 0){
            return $query->result();
        }
    }

=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    public function user_id($id_user){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("users", array("users.id_user" => $id_user));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

    public function user($user){
<<<<<<< HEAD
        //$this->db->select("*");
        $this->db->select('
        users.id_user,
        users.name, 
        users.last, 
        users.address, 
        users.phone, 
        users.email, 
        users.ita, 
        users.ita_platinum, 
        users.ita_sponsor, 
        users.id_position,
        positions.position,
        users.id_rol, 
        rols.rol,
        users.id_question,
        questions.question, 
        users.answer, 
        users.status,
        users.photo,
        concat(sponsor.name, " " , sponsor.last) as name_sponsor,
        concat(platinum.name, " " , platinum.last) as name_platinum
        ');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        $this->db->join('questions', 'questions.id_question=users.id_question');
        $this->db->join('users as sponsor', 'sponsor.ita = users.ita_sponsor', 'left');
        $this->db->join('users as platinum', 'platinum.ita = users.ita_platinum', 'left');
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("users", array("users.ita" => $user->ita, "users.password"=>md5($user->password)));
=======
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("users", array("users.ita" => $user->username, "users.password"=>md5($user->password)));
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

<<<<<<< HEAD
    public function delete_user($user){
        if($this->db->delete('users', array('ita' => $user->ita)))
            return true;
            else
            return false;
    }

=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    public function users_rols()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
<<<<<<< HEAD
        $this->db->select('*, 
        (SELECT count(*) from users where users.id_rol = rols.id_rol) as total_users
        ');
=======
        $this->db->select('*');
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        $query = $this->db->get("rols");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function user_status($ita){
        $this->db->select("users.id_user, users.ita, users.name, users.status ");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("users", "users.ita=".$ita);
        if($query->num_rows() == 1){
            return $query->row();
        }
    }

     public function users_positions()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
<<<<<<< HEAD
        $this->db->select('*,
        (SELECT count(*) from users where users.id_position = positions.id_position) as total_users
        ');
=======
        $this->db->select('*');
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        $query = $this->db->get("positions");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function users_questions()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
        $this->db->select('*');
        $query = $this->db->get("questions");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    function get_enum_values( $table, $field )
    {
        $type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    public function new_user($user){
   //$this->db->select("*");
<<<<<<< HEAD
    if(empty($user->address)) $user->address = '';
    if(empty($user->email)) $user->email = '';
    if(empty($user->name)) $user->name = '';
    if(empty($user->last)) $user->last = '';
    if(empty($user->phone)) $user->phone = '';
    if(empty($user->status)) $user->status = 1; // por defecto inactivo
    if(empty($user->id_rol)) $user->id_rol = 3;
    if(empty($user->id_position)) $user->id_position = 5;

    
=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $user->name,
            "last" => $user->last,
            "ita" => $user->ita,
            "id_rol" => $user->id_rol,
            "id_position" => $user->id_position,
            "address" => $user->address,
            "phone" => $user->phone,
<<<<<<< HEAD
            "status" => $user->status, //activo
=======
            "status" => 1, //activo
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            "email" => $user->email,
            "password" => md5($user->password), 
            "date_create" => date('Y-m-d H:i:s')
        );
    
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('ita', $user->ita)->or_where('email', $user->email)->get('users');

        if($query->num_rows() == 0){
            $this->db->insert("users", $data);
            return true;
        }else{
            return false;
        }
    }

    public function new_user_app($user, $sponsor, $platinum){
   //$this->db->select("*");
<<<<<<< HEAD
    if(empty($user->address)) $user->address = '';
    if(empty($user->email)) $user->email = '';
    if(empty($user->id_question)) $user->id_question = '';
    if(empty($user->name)) $user->name = '';
    if(empty($user->last)) $user->last = '';
    if(empty($user->answer)) $user->answer = '';
    if(empty($user->phone)) $user->phone = '';
    if(empty($user->status)) $user->status = 0; // por defecto inactivo
    if(empty($user->id_rol)) $user->id_rol = 4;
    if(empty($user->id_position)) $user->id_position = 6;
    if(empty($sponsor->ita)) $sponsor->ita = '';
    if(empty($platinum->ita)) $platinum->ita = '';

=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $user->name,
            "last" => $user->last,
            "ita" => $user->ita,
            "ita_sponsor" => $sponsor->ita,
            "ita_platinum" => $platinum->ita,
            "id_rol" =>  $user->id_rol,
            "id_position" =>  $user->id_position,
            "address" => $user->address,
            "phone" => $user->phone,
<<<<<<< HEAD
            "status" => $user->status, 
            "id_question" => $user->id_question, 
            "answer"=> $user->answer,
=======
            "status" => 0, //inactivo
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            "email" => $user->email,
            "password" => md5($user->password), 
            "date_create" => date('Y-m-d H:i:s')
        );
    
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('ita', $user->ita)->or_where('email', $user->email)->get('users');

        if($query->num_rows() == 0){
            $this->db->insert("users", $data);
            return true;
        }else{
            return false;
        }
    }

   public function update_user_app($user, $sponsor, $platinum){
<<<<<<< HEAD
    if(empty($user->address)) $user->address = '';
    if(empty($user->email)) $user->email = '';
    if(empty($user->id_question)) $user->id_question = '';
    if(empty($user->name)) $user->name = '';
    if(empty($user->last)) $user->last = '';
    if(empty($user->answer)) $user->answer = '';
    if(empty($user->phone)) $user->phone = '';
    if(empty($user->avatar_url)) $user->avatar_url = '';
    //if(empty($user->id_rol)) $user->id_rol = 4;
    //if(empty($user->id_position)) $user->id_position = 6;
    if(empty($sponsor->ita)) $sponsor->ita = '';
    if(empty($platinum->ita)) $platinum->ita = '';
    //if(empty($user->status)) $user->status = 1; // por defecto inactivo

    //if(empty(($user->id_rol) || empty($user->id_position) || empty($user->status))) // caso app
    if(empty($user->password))
=======
        if(empty($user->password))
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        $data = array(
            //"id_user" => $user->id_user,
            "name" => $user->name,
            "last" => $user->last,
            "ita" => $user->ita,
            "ita_sponsor" => $sponsor->ita,
            "ita_platinum" => $platinum->ita,
<<<<<<< HEAD
            //"id_rol" => $user->id_rol,
            //"id_position" => $user->id_position,
            //"status" => $user->status,
=======
            "id_rol" => $user->id_rol,
            "id_position" => $user->id_position,
            //"status" => 1, //activo
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            "id_question" => $user->id_question,
            "answer" => $user->answer,
<<<<<<< HEAD
            "photo" => $user->avatar_url,
            //"password" => md5($user->password), 
            "date_update" => date('Y-m-d H:i:s')
        );
        else        
            $data = array(
=======
            //"password" => md5($user->password), 
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            //"id_user" => $user->id_user,
            "name" => $user->name,
            "last" => $user->last,
            "ita" => $user->ita,
            "ita_sponsor" => $sponsor->ita,
            "ita_platinum" => $platinum->ita,
<<<<<<< HEAD
            //"id_rol" => $user->id_rol,
            //"id_position" => $user->id_position,
            //"status" => $user->status,
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            "id_question" => $user->id_question,
            "answer" => $user->answer,
            "photo" => $user->avatar_url,
            "password" => md5($user->password), 
=======
            "id_rol" => $user->id_rol,
            "id_position" => $user->id_position,
            //"status" => 1, //activo
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            "password" => md5($user->password), 
            "id_question" => $user->id_question,
            "answer" => $user->answer,
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            "date_update" => date('Y-m-d H:i:s')
        );
        //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');

<<<<<<< HEAD
        if(!$this->check_email($user->email, $user->ita) && !$this->check_email($user->email, $user->ita)){
=======
        if($this->check_email($user->email, $user->ita)){
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            return false;
        }else{
            if($this->db->update('users', $data, array('ita' => $user->ita)))
            return true;
            else
            return false;
        }
       
    }

<<<<<<< HEAD

    public function update_user_app_back($user, $sponsor, $platinum){
        if(empty($user->address)) $user->address = '';
        if(empty($user->email)) $user->email = '';
        if(empty($user->id_question)) $user->id_question = '';
        if(empty($user->name)) $user->name = '';
        if(empty($user->last)) $user->last = '';
        if(empty($user->answer)) $user->answer = '';
        if(empty($user->phone)) $user->phone = '';
        if(empty($user->avatar_url)) $user->avatar_url = '';
        //if(empty($user->id_rol)) $user->id_rol = 4;
        //if(empty($user->id_position)) $user->id_position = 6;
        if(empty($sponsor->ita)) $sponsor->ita = '';
        if(empty($platinum->ita)) $platinum->ita = '';
        //if(empty($user->status)) $user->status = 1; // por defecto inactivo
            
        if(empty($user->password)) // backend
            $data = array(
                //"id_user" => $user->id_user,
                "name" => $user->name,
                "last" => $user->last,
                "ita" => $user->ita,
                "ita_sponsor" => $sponsor->ita,
                "ita_platinum" => $platinum->ita,
                "id_rol" => $user->id_rol,
                "id_position" => $user->id_position,
                "status" => $user->status,
                "email" => $user->email,
                "phone" => $user->phone,
                "address" => $user->address,
                "id_question" => $user->id_question,
                "answer" => $user->answer,
                "photo" => $user->avatar_url,
                //"password" => md5($user->password), 
                "date_update" => date('Y-m-d H:i:s')
            );
        else //backend
            $data = array(
                //"id_user" => $user->id_user,
                "name" => $user->name,
                "last" => $user->last,
                "ita" => $user->ita,
                "ita_sponsor" => $sponsor->ita,
                "ita_platinum" => $platinum->ita,
                "id_rol" => $user->id_rol,
                "id_position" => $user->id_position,
                "status" => $user->status,
                "email" => $user->email,
                "phone" => $user->phone,
                "address" => $user->address,
                "password" => md5($user->password), 
                "id_question" => $user->id_question,
                "answer" => $user->answer,
                "photo" => $user->avatar_url,
                "date_update" => date('Y-m-d H:i:s')
            );
            //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
            //$query = $this->db->where('email', $user->email)->get('users');
    
            if(!$this->check_email($user->email, $user->ita) && !$this->check_email($user->email, $user->ita)){
                return false;
            }else{
                if($this->db->update('users', $data, array('ita' => $user->ita)))
                return true;
                else
                return false;
            }
           
        }

=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    public function update_user($user){
        if(empty($user->password))
        $data = array(
            //"id_user" => $user->id_user,
            "name" => $user->name,
            "last" => $user->last,
            "ita" => $user->ita,
            "id_rol" => $user->id_rol,
            "id_position" => $user->id_position,
            //"status" => 1, //activo
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            //"password" => md5($user->password), 
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            //"id_user" => $user->id_user,
            "name" => $user->name,
            "last" => $user->last,
            "ita" => $user->ita,
            "id_rol" => $user->id_rol,
            "id_position" => $user->id_position,
            //"status" => 1, //activo
            "email" => $user->email,
            "phone" => $user->phone,
            "address" => $user->address,
            "password" => md5($user->password), 
            "date_update" => date('Y-m-d H:i:s')
        );
        //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');

<<<<<<< HEAD
        if(!$this->check_email($user->email, $user->ita) && !$this->check_email($user->email, $user->ita)){
=======
        if($this->check_email($user->email, $user->ita)){
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            return false;
        }else{
            if($this->db->update('users', $data, array('ita' => $user->ita)))
            return true;
            else
            return false;
<<<<<<< HEAD
           
=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        }
       
    }

    public function check_email($email, $ita)
	{
			$id = $this->db->query(
<<<<<<< HEAD
					"select email from users where email = '$email' and email != '' and ita != '$ita'"
			);

		if($id->num_rows() < 1)
			return true;
		else
			return false;
		 
	}

    
    public function check_email_ita($email, $ita)
	{
			$id = $this->db->query(
					"select email from users where email = '$email' and ita = '$ita'"
			);

		if($id->num_rows() == 1)
=======
					"select email from users where email = '$email' "
			);

		if($id->num_rows()>1)
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
			return true;
		else
			return false;
		 
	}	
	

    public function check_user_question($email, $ita, $id_question, $answer)
	{
			$id = $this->db->query(
					"select email, ita, id_question, answer from users where email = '$email' and ita ='$ita' and id_question ='$id_question' and answer ='$answer'"
			);

		if($id->num_rows() == 1)
			return true;
		else
			return false;
		 
	}	

    public function update_status($user){
        if($user->status == 1)
        $data = array(
            "status" => 0, //inactivo
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
<<<<<<< HEAD
        $query = $this->db->update('users', $data, array('ita' => $user->ita));
=======
        $query = $this->db->update('users', $data, array('id_user' => $user->id_user));
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        if($query){
            return true;
        }else{
            return false;
        }
       
    }

<<<<<<< HEAD
    public function users($q, $limit, $start, $id_rol)
    {
        
        if(!empty($start) || !empty($limit) || !is_null($start) || !is_null($limit))
        $this->db->limit($limit, $start);
        if($id_rol>0)
        $this->db->where('users.id_rol', $id_rol);
        
        if(!empty($q)){
        $this->db->like('users.email', $q);  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        $this->db->or_like('users.ita', $q);  
        $this->db->or_like('users.name', $q);  
        $this->db->or_like('users.last', $q);  
        }
 

        $this->db->select('
        users.id_user,
        users.name, 
        users.last, 
        users.address, 
        users.phone, 
        users.email, 
        users.ita, 
        users.ita_platinum, 
        users.ita_sponsor, 
        users.id_position,
        positions.position,
        users.id_rol, 
        rols.rol,
        users.id_question,
        questions.question, 
        users.answer, 
        users.status,
        users.photo,
        concat(sponsor.name, " " , sponsor.last) as name_sponsor,
        concat(platinum.name, " " , platinum.last) as name_platinum
        ');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        $this->db->join('questions', 'questions.id_question=users.id_question');
        $this->db->join('users as sponsor', 'sponsor.ita = users.ita_sponsor', 'left');
        $this->db->join('users as platinum', 'platinum.ita = users.ita_platinum', 'left');
        //$this->db->limit(1000, 0);
        $this->db->group_by('users.ita');
        $this->db->order_by('users.date_create DESC');
=======
    public function users()
    {
        $this->db->select('users.*, rols.*, positions.*');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        $query = $this->db->get("users");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

<<<<<<< HEAD
    public function users_backend($q, $limit, $start)
    {
        if(!empty($start) || !empty($limit) || !is_null($start) || !is_null($limit))
        $this->db->limit($limit, $start);
 
        if(!empty($q)){
        $this->db->like('users.email', $q);  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        $this->db->or_like('users.ita', $q);  
        $this->db->or_like('users.name', $q);  
        $this->db->or_like('users.last', $q);  
        }
        $this->db->select('
        users.id_user,
        users.name, 
        users.last, 
        users.address, 
        users.phone, 
        users.email, 
        users.ita, 
        users.ita_platinum, 
        users.ita_sponsor, 
        users.id_position,
        positions.position,
        users.id_rol, 
        rols.rol,
        users.id_question,
        questions.question, 
        users.answer, 
        users.status,
        users.photo,
        concat(sponsor.name, " " , sponsor.last) as name_sponsor,
        concat(platinum.name, " " , platinum.last) as name_platinum
        ');
        //$this->db->join('users as user_master', 'users_master.ita=users.ita_master');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        $this->db->join('questions', 'questions.id_question=users.id_question');
        $this->db->join('users as sponsor', 'sponsor.ita = users.ita_sponsor', 'left');
        $this->db->join('users as platinum', 'platinum.ita = users.ita_platinum', 'left');
        //$query = $this->db->get("users");
        $this->db->group_by('users.ita');
        $this->db->order_by('users.date_create DESC');
=======
    public function users_backend()
    {
        $this->db->select('users.*, rols.*, positions.*');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        //$query = $this->db->get("users");
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        $query = $this->db->get_where("users", "users.id_rol<'4'");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

<<<<<<< HEAD
    public function users_app($q, $limit, $start)
    {
        if(!empty($start) || !empty($limit) || !is_null($start) || !is_null($limit))
        $this->db->limit($limit, $start);
 
        if(!empty($q)){
        $this->db->like('users.email', $q);  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        $this->db->or_like('users.ita', $q);  
        $this->db->or_like('users.name', $q);  
        $this->db->or_like('users.last', $q);  
        }
        $this->db->select('
        users.id_user,
        users.name, 
        users.last, 
        users.address, 
        users.phone, 
        users.email, 
        users.ita, 
        users.ita_platinum, 
        users.ita_sponsor, 
        users.id_position,
        positions.position,
        users.id_rol, 
        rols.rol,
        users.id_question,
        questions.question, 
        users.answer, 
        users.status,
        users.photo,
        concat(sponsor.name, " " , sponsor.last) as name_sponsor,
        concat(platinum.name, " " , platinum.last) as name_platinum
        ');
        //$this->db->join('users as user_master', 'users_master.ita=users.ita_master');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        $this->db->join('questions', 'questions.id_question=users.id_question');
        $this->db->join('users as sponsor', 'sponsor.ita = users.ita_sponsor', 'left');
        $this->db->join('users as platinum', 'platinum.ita = users.ita_platinum', 'left');
        //$query = $this->db->get("users");
        $this->db->group_by('users.ita');
        $this->db->order_by('users.date_create DESC');
=======
    public function users_app()
    {
        $this->db->select('users.*, rols.*, positions.*');
        //$this->db->join('users as user_master', 'users_master.ita=users.ita_master');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        //$query = $this->db->get("users");
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        $query = $this->db->get_where("users", "users.id_rol = '4'");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }
    public function user_ita($ita)
    {
<<<<<<< HEAD
        $this->db->select('users.*');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
        $this->db->limit(1);
=======
        $this->db->select('users.*, rols.*, positions.*');
        $this->db->join('rols', 'rols.id_rol=users.id_rol');
        $this->db->join('positions', 'positions.id_position=users.id_position');
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        //print_r($ita);
        //$query = $this->db->get("users");
        $query = $this->db->get_where("users", "users.ita='$ita'");
       if($query->num_rows() == 1){
            return $query->row();
        }
    }

     public function set_last_login($user)
    {
    	$this->db->query(
    			"update users set last_login = now() " .
<<<<<<< HEAD
    			"where users.ita = '$user->ita'  "
=======
    			"where users.ita = '$user->username'  "
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    	);
    }

    public function set_password($ita, $pass)
    {
        //$ita = $user->ita;
    	//print_r($ita);
    	$id = $this->db->query(
    			"update users set password =  md5('$pass') " .
    			"where users.ita = '$ita'"
    	);
    	
    	$afftectedRows = $this->db->affected_rows();
		
<<<<<<< HEAD
		return $id;
=======
		return $afftectedRows;
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    }

     public function set_password_temp($user, $pass)
    {
        $ita = $user->ita;
        $email = $user->email;
    	
    	$id = $this->db->query(
    			"update users set password =  md5('$pass') " .
    			"where ita = '$ita' and email = '$email'  "
    	);
    	
    	$afftectedRows = $this->db->affected_rows();
		
		return $afftectedRows;
    }



}