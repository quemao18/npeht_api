<?php
//debemos colocar esta línea para extender de REST_Controller
require(APPPATH.'/libraries/REST_Controller.php');
header('Access-Control-Allow-Origin: *');
class audios extends REST_Controller
{
    //con esto limitamos las consultas y los permisos a la api
    protected $methods = array(
        'audios_get' => array('level' => 0),//para acceder a users_get debe tener level 1 y no hay limite de consultas por hora
        'audio_id_get' => array('level' => 0),//para acceder a users_get debe tener level 1 y no hay limite de consultas por hora
        'new_audio_post' => array('level' => 0),//para acceder a users_get debe tener level 1 y no hay limite de consultas por hora
        'modules_get' => array('level' => 0), 
        'audio_status_get' => array('level' => 0),
        'update_status_post' => array('level' => 0),
        'update_audio_post' => array('level' => 0)
    );
   
    //obtener user por id
    //users/user_id/id/id_user/X-API-KEY/miapikey
    public function audio_id_get()
    {
        if(!$this->get("id_audio")){
            $this->response(NULL, 400);
        }
        $this->load->model("audios_model");
        
        $audio = $this->users_model->user_id($this->get("id_audio"));
        if($audio){
            $this->response($audio, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Audio no encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }

   

    //obtener 
    //users/users/X-API-KEY/miapikey
    public function audios_get()
    {
        $this->load->model("audios_model");
        $audios = $this->audios_model->audios();
        if($audios){
            $this->response($audios, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Nada encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }



    public function audios_modules_get()
    {
        $this->load->model("audios_model");
        $users = $this->audios_model->audios_modules();
        if($users){
            $this->response($users, 200);
        }else{
            $this->response(NULL, 400);
        }
    }

    public function audio_status_get()
    {
        $this->load->model("audios_model");
        $status = $this->audios_model->audio_status($this->get("id_audio"));
        if($status){
            $this->response($status, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
						'status' => FALSE,
						'message' => 'Error consultando estado.'
				), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //crear un nueva pica
    //users/nuevo/X-API-KEY/miapikey
    public function new_audio_post()
    {   

        if($this->post("audio")){
            $this->load->model("audios_model");
            $new = $this->audios_model->new_audio(json_decode($this->post("audio")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe un audio con esas características'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Audio creado'
				), REST_Controller::HTTP_OK);
            }
        }
    }

    //actualizar pica
    //users/actualizar/X-API-KEY/miapikey
    public function update_audio_post()
    {
        $this->load->model("audios_model");
        $result = $this->audios_model->update_audio(json_decode($this->post("audio")));

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

    public function update_status_post()
    {
        $this->load->model("audios_model");
        $result = $this->audios_model->update_status(json_decode($this->post("audio")));

        if($result === false){
            $this->response(array('status' => FALSE, "message" => "Error Actualizando Estado"), REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response(array('status' => FALSE, "message" => "Estado cambiado"), REST_Controller::HTTP_OK);
        }
    }

}