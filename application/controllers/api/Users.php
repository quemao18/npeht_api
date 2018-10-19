<?php
//debemos colocar esta línea para extender de REST_Controller
require(APPPATH.'/libraries/REST_Controller.php');
header('Access-Control-Allow-Origin: *');
class users extends REST_Controller
{
    //con esto limitamos las consultas y los permisos a la api
    protected $methods = array(
        'users_get' => array('level' => 0),//devuelve todos los usuarios
        'users_backend_get' => array('level' => 0), //devuelve todos los usuarios backend
        'users_app_get' => array('level' => 0), //devuelve todos los usuarios app
        'user_id_get' => array('level' => 0),//devuelve usuario por id
        'user_post' => array('level' => 0),// usada para el login, recibe ITA y Password
        'new_user_post' => array('level' => 0),//crea un usuario nuevo
        'new_user_app_post' => array('level' => 0), //crea un usuario de app nuevo 
        'user_ita_get' => array('level' => 0), //devuelve el usuario por ITA
<<<<<<< HEAD
        'forget_post' => array('level' => 0), // para restableser el password colocando uno temp y enviandolo por email
        'forget_2_post' => array('level' => 0), // para restableser el password verificando pregunta, ita y respuesta
        'users_positions_get' => array('level' => 0), //devuelve posiciones 
        'users_questions_get' => array('level' => 0), //devuelve las preguntas de la tabla question
        'users_rols_get' => array('level' => 0), //devuelve los roles de la tabla rols
=======
        'forget_post' => array('level' => 0), // para restableser el password
        'positions_get' => array('level' => 0), //devuelve posiciones 
        'questions_get' => array('level' => 0), //devuelve las preguntas de la tabla question
        'rols_get' => array('level' => 0), //devuelve los roles de la tabla rols
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        'user_status_get' => array('level' => 0), //deveuelve el estado de del usuario 0 inactivo, 1 activo
        'update_status_post' => array('level' => 0), //cambia el estado del usuario
        'update_user_post' => array('level' => 0), //actualiza usuario backend
        'update_user_app_post' => array('level' => 0),//actualiza usuario app
<<<<<<< HEAD
        'update_user_app_back_post' => array('level' => 0),//actualiza usuario app por el backend
        'change_password_post' => array('level' => 0), //cambia el password del usuario
        'delete_user_post' => array('level' => 0), //elimina usuario
        'upload_avatar_post' => array('level' => 0), //sube foto
        'statistics_get' => array('level' => 0) //estadisticas
    );

    public function statistics_get()
    {
        $this->load->model("users_model");
        $users = $this->users_model->statistics();
        if($users){
            $this->response($users, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
                'status' => FALSE,
                'message' => 'Nada encontrado'
        ), REST_Controller::HTTP_NOT_FOUND);
        }
    }
=======
        'change_password_post' => array('level' => 0), //cambia el password del usuario
    );
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
   
    //obtener user por id
    //users/user_id/id/id_user/X-API-KEY/miapikey
    public function user_id_get()
    {
        if(!$this->get("id")){
            $this->response(NULL, 400);
        }
        $this->load->model("users_model");
        
        $users = $this->users_model->user_id($this->get("id_user"));
        if($users){
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Usuario no encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //obtener user por id
    //users/user_id/id/id_user/X-API-KEY/miapikey
    public function user_ita_get()
    {
        if(!$this->get("ita")){
            $this->response(NULL, 400);
        }
        $this->load->model("users_model");
        
        $users = $this->users_model->user_ita($this->get("ita"));
        if($users){
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Usuario no encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function change_password_post() {
    //$this->response( $this->project_model->get_all ());
    //$username = $this->get('username');
    $this->load->model("users_model");
    $user = json_decode($this->post("user"));
<<<<<<< HEAD
    //var_dump($user);
=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    //$password = $this->get("password");
    //$clave = rand(123456, 999999);
   
                
    $temp = $this->users_model->set_password($user->ita, $user->password);
    $user2 = $this->users_model->user_ita($user->ita);
    //$this->set_response(array('message' => 'user'.$username), REST_Controller::HTTP_NOT_FOUND);
    
<<<<<<< HEAD
    if (($temp)){
=======
    if (!empty($temp)){
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        //enviar email
        //$this->send_email_pass_temp($user, $pass);

        $this->response(array(
                'status' => TRUE,
<<<<<<< HEAD
                'message' => 'Password cambiado...'
                //'password_new' => $user->password, 
                //'user' => $user2
=======
                'message' => 'Password cambiado...',
                'password_new' => $user->password, 
                'user' => $user2
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        ), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code			
    }else{				
    $this->response(array(
                'status' => FALSE,
                'message' => 'Usuario no encontrado'
        ), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code	
    }	
    }

    //obtener 
    //users/users/X-API-KEY/miapikey
    public function users_get()
    {
<<<<<<< HEAD
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;
        $id_rol = $this->get("id_rol") !='' ? (int) $this->get("id_rol") : 0;

        $this->load->model("users_model");
        $users = $this->users_model->users($q, $limit, $start, $id_rol);
        if($users){
            $this->response($users, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
                'status' => FALSE,
                'message' => 'Nada encontrado'
        ), REST_Controller::HTTP_NOT_FOUND);
=======
        $this->load->model("users_model");
        $users = $this->users_model->users();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        }
    }

    public function users_backend_get()
    {
<<<<<<< HEAD
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;

        $this->load->model("users_model");
        $users = $this->users_model->users_backend($q, $limit, $start);
       if($users){
            $this->response($users, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
                'status' => FALSE,
                'message' => 'Nada encontrado'
        ), REST_Controller::HTTP_NOT_FOUND);
=======
        $this->load->model("users_model");
        $users = $this->users_model->users_backend();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        }
    }

     public function users_app_get()
    {
<<<<<<< HEAD
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;

        $this->load->model("users_model");
        $users = $this->users_model->users_app($q, $limit, $start);
        if($users){
            $this->response($users, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
                'status' => FALSE,
                'message' => 'Nada encontrado'
        ), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //actual en uso
=======
        $this->load->model("users_model");
        $users = $this->users_model->users_app();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
        }
    }


>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
    public function forget_2_post() {
    //$this->response( $this->project_model->get_all ());
    //$username = $this->get('username');
    $this->load->model("users_model");
    $user = json_decode($this->post("user"));
    //$password = $this->get("password");
    //$clave = rand(123456, 999999);
    //$pass = substr(md5(time()), 0, 6);
                
    //$temp = $this->users_model->set_password_temp($user, $pass);
    $check = $this->users_model->check_user_question($user->email, $user->ita, $user->id_question, $user->answer);
    $user = $this->users_model->user_ita($user->ita);
    //$this->set_response(array('message' => 'user'.$username), REST_Controller::HTTP_NOT_FOUND);
    
    if ( $check === true ){
        //enviar email
        //$this->send_email_pass_temp($user, $pass);

        $this->response(array(
                'status' => TRUE,
                'message' => 'Datos correctos',
                //'password_temp' => $pass, 
                'user' => $user
        ), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code			
    }else{				
    $this->response(array(
                'status' => FALSE,
                'message' => 'Verifique los datos'
        ), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code	
    }	
    }

    public function forget_post() {
    //$this->response( $this->project_model->get_all ());
    //$username = $this->get('username');
    $this->load->model("users_model");
    $user = json_decode($this->post("user"));
    //$password = $this->get("password");
    //$clave = rand(123456, 999999);
    $pass = substr(md5(time()), 0, 6);
                
    $temp = $this->users_model->set_password_temp($user, $pass);
    $user = $this->users_model->user_ita($user->ita);
    //$this->set_response(array('message' => 'user'.$username), REST_Controller::HTTP_NOT_FOUND);
    
    if (!empty($temp)){
        //enviar email
        //$this->send_email_pass_temp($user, $pass);

        $this->response(array(
                'status' => TRUE,
                'message' => 'Password cambiado...',
                'password_temp' => $pass, 
                'user' => $user
        ), REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code			
    }else{				
    $this->response(array(
                'status' => FALSE,
                'message' => 'Usuario no encontrado'
        ), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code	
    }	
    }

    private function send_email_pass_temp($user, $pass){
		
        $this->load->library('email');
		$this->email->set_newline("\r\n");	

		$subject = 'Cambio de Password en '.$this->config->item('APP_NAME').'';
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			    <title>'.htmlspecialchars($subject, ENT_QUOTES, $this->email->charset).'</title>
			    <style type="text/css">
							body{
			    		 	font-family: Arial, Verdana, Helvetica, sans-serif;
            				font-size: 14px;
							}
			    </style>
				</head>
    			<body>
			     <p>Hola <strong>' . ucwords(strtolower($user['name'])) . '</strong>, ' .
	     			'<br><br>'.
	     			' Su password temporal es : '.$pass.'<br><br>' .
	     			''.
	     			'<br><br>'.	     			
					  ' </strong><br><br>Graciar por su interes.<br><br>'.
					  '<a href=http://'.$this->config->item('APP_WEB').' >'.$this->config->item('APP_WEB').'</a></p>
    
				</body>
				</html>
						';
		 
		//echo $body;
		try {
	
		$result = $this->email
		->from($this->config->item('APP_EMAIL'))
		->reply_to($this->config->item('APP_EMAIL'))    // Optional, an account where a human being reads.
		->to($user['email'])
		->subject($subject)
		->message($body)
		->send();
		
		if($result)
		$this->response ( array (
				'status' => true,
				'message' => 'Su password temporal fue enviado a su email...' 
		), REST_Controller::HTTP_OK );
		
		//var_dump($result);
		//echo '<br />';
		//echo $this->email->print_debugger();	
		//print_r($result);
		$this->response ( array (
				'status' => false,
				'message' => 'Error enviando email...'
		), REST_Controller::HTTP_NOT_FOUND );
			
		}catch (phpmailerException $e) {
		  echo $e->errorMessage(); //Pretty error messages from PHPMailer
		  $this->response ( array (
		  		'status' => false,
		  		'message' => 'Error: '.$e->errorMessage()
		  ), REST_Controller::HTTP_NOT_FOUND );
		} catch (Exception $e) {
		  echo $e->getMessage(); //Boring error messages from anything else!
			$this->response ( array (
					'status' => false,
					'message' => 'Error: '.$e->getMessage()
			), REST_Controller::HTTP_NOT_FOUND );
			
		}
		/*
			if(!$result) {
			//return false;
			$this->response ( array (
					'status' => false,
					'message' => 'Error.'
			), REST_Controller::HTTP_NOT_FOUND );
		}else{
			//return true;
			$this->response ( array (
					'status' => true,
					'message' => 'Email enviado con exito...'
			), REST_Controller::HTTP_OK );
		}
		*/
	}


    public function users_rols_get()
    {
        $this->load->model("users_model");
        $users = $this->users_model->users_rols();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
        }
    }

    public function users_positions_get()
    {
        $this->load->model("users_model");
        $users = $this->users_model->users_positions();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
        }
    }

     public function users_questions_get()
    {
        $this->load->model("users_model");
        $users = $this->users_model->users_questions();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
        }
    }

    public function user_status_get()
    {
        $this->load->model("users_model");
        $user = $this->users_model->user_status($this->get("ita"));
        if($user){
            $this->response($user, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
						'status' => FALSE,
						'message' => 'Error consultando estado.'
				), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function user_post()
    {   

        if($this->post("user")){
            $this->load->model("users_model");
            $user = $this->users_model->user(json_decode($this->post("user")));
            if (empty($user)){
			$this->response(array(
					'status' => FALSE,
					'message' => 'Usuario o password incorrectos'
			), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code			
		}
		if ( $user->status == 0 ){
				$this->response(array(
						'status' => FALSE,
						'message' => 'Cuenta no activa.'
				), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}	
        }
        $this->users_model->set_last_login(json_decode($this->post("user")));
		$this->response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code				
    }
    //crear un nueva pica
    //users/nuevo/X-API-KEY/miapikey
    public function new_user_post()
    {   

        if($this->post("user")){
            $this->load->model("users_model");
            $new = $this->users_model->new_user(json_decode($this->post("user")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe el ITA o Email'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Usuario creado'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    public function new_user_app_post()
    {   

        if($this->post("user")){
            $this->load->model("users_model");
            $new = $this->users_model->new_user_app(json_decode($this->post("user")), json_decode($this->post("sponsor")), json_decode($this->post("platinum")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe el ITA o Email'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
<<<<<<< HEAD
						'message' => 'Proceso exitoso, espere autorización'
=======
						'message' => 'Usuario creado'
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
				), REST_Controller::HTTP_OK);
            }
        }
    }

    //actualizar pica
    //users/actualizar/X-API-KEY/miapikey
    public function update_user_post()
    {
        $this->load->model("users_model");
        $result = $this->users_model->update_user(json_decode($this->post("user")));

        if($result === false){
            $this->response(array(
                'status' => FALSE, 
                "message" => "Email ya existe en otro usuario"
            ), REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response(array(
                'status' => TRUE, 
                "message" => "Usuario actualizado"
            ), REST_Controller::HTTP_OK);
        }
    }

<<<<<<< HEAD
    public function delete_user_post()
    {   

        if($this->post("user")){
            $this->load->model("users_model");
            $new = $this->users_model->delete_user(json_decode($this->post("user")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Error'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Usuario eliminado'
				), REST_Controller::HTTP_OK);
            }
        }
    }


=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
        public function update_user_app_post()
    {
        $this->load->model("users_model");
        $result = $this->users_model->update_user_app(json_decode($this->post("user")), json_decode($this->post("sponsor")), json_decode($this->post("platinum")));

        if($result === false){
            $this->response(array(
                'status' => FALSE, 
                "message" => "Email ya existe en otro usuario"
            ), REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response(array(
                'status' => TRUE, 
<<<<<<< HEAD
                "message" => "Proceso exitoso"
            ), REST_Controller::HTTP_OK);
        }
    }

    public function update_user_app_back_post()
    {
        $this->load->model("users_model");
        $result = $this->users_model->update_user_app_back(json_decode($this->post("user")), json_decode($this->post("sponsor")), json_decode($this->post("platinum")));

        if($result === false){
            $this->response(array(
                'status' => FALSE, 
                "message" => "Email ya existe en otro usuario"
            ), REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response(array(
                'status' => TRUE, 
                "message" => "Proceso exitoso"
=======
                "message" => "Usuario actualizado"
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
            ), REST_Controller::HTTP_OK);
        }
    }

    public function update_status_post()
    {
        $this->load->model("users_model");
        $result = $this->users_model->update_status(json_decode($this->post("user")));

        if($result === false){
            $this->response(array('status' => FALSE, "message" => "Error Actualizando Estado"));
        }else{
            $this->response(array('status' => FALSE, "message" => "Estado cambiado"));
        }
    }

<<<<<<< HEAD
    public function upload_avatar_post()
    {
    $uploaddir = 'd:/img/';
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/assets/profiles/avatars/';
    // $this->response($this->post("file"), 200);
    
    $file_name = underscore($_FILES['image']['name']);
    $uploadfile = $uploaddir.$file_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
        $dataDB['status'] = TRUE;   
        $dataDB['message'] = 'Imagen subida';       
        $dataDB['filename'] = $file_name;
        $dataDB['avatar_url'] = $this->config->item('base_url'). 'assets/profiles/avatars/' .$file_name;
     } else {
        $dataDB['status'] = FALSE;   
        $dataDB['message'] =  'Error subiendo imagen';       
     }
     $this->response($dataDB, 200);
     
    }

=======
>>>>>>> f26e49a7e79576c095da5bd22f4db240a99f70a1
}