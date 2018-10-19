<?php
//debemos colocar esta línea para extender de REST_Controller
require(APPPATH.'/libraries/REST_Controller.php');
header('Access-Control-Allow-Origin: *');
class news extends REST_Controller
{
    //con esto limitamos las consultas y los permisos a la api
    protected $methods = array(
        'news_get' => array('level' => 0),//devuelve todos los medias
        'new_id_get' => array('level' => 0),//devuelve media por id
        'new_new_post' => array('level' => 0),//crea un media nuevo
        'new_status_get' => array('level' => 0), //deveuelve el estado de del media 0 inactivo, 1 activo
        'update_status_post' => array('level' => 0), //cambia el estado del usuario
        'update_new_post' => array('level' => 0), //actualiza usuario backend
        'new_event_post' => array('level' => 0), //crear categoria
        'events_get' => array('level' => 0), //devuelve las categorias
        'delete_new_post' => array('level' => 0), //elimina media,
        'upload_post' => array('level' => 0)
        
    );
   
    //obtener user por id
    //users/user_id/id/id_user/X-API-KEY/miapikey
    public function new_id_get()
    {
        if(!$this->get("id_new")){
            $this->response(NULL, 400);
        }
        $this->load->model("news_model");
        
        $new = $this->news_model->new_id($this->get("id_new"));
        if($new){
            $this->response($new, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Noticia no encontrada..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //obtener 
    //users/users/X-API-KEY/miapikey
    public function news_get()
    {
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;
        $this->load->model("news_model");
        $news = $this->news_model->news($q, $limit, $start);
        if($news){
            $this->response($news, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
						'status' => FALSE,
						'message' => 'Nada encontrado.'
				), REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function new_status_get()
    {
        $this->load->model("news_model");
        $res = $this->news_model->new_status($this->get("id_new"));
        if($res){
            $this->response($res, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
						'status' => FALSE,
						'message' => 'Error consultando estado.'
				), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //crear nueva media
    //users/nuevo/X-API-KEY/miapikey
    public function new_new_post()
    {   

        if($this->post("new")){
            $this->load->model("news_model");
            $new = $this->news_model->new_new(json_decode($this->post("new")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe la noticia'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Noticia creada'
				), REST_Controller::HTTP_OK);
            }
        }
    }

    public function delete_new_post()
    {   

        if($this->post("new")){
            $this->load->model("news_model");
            $new = $this->news_model->delete_new(json_decode($this->post("new")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Error'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Noticia eliminada'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    public function new_event_post()
    {   

        if($this->post("event")){
            $this->load->model("news_model");
            $new = $this->news_model->new_event(json_decode($this->post("event")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe un evento con ese nombre'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Evento creado'
				), REST_Controller::HTTP_OK);
            }
        }
    }

    //actualizar 
    //users/actualizar/X-API-KEY/miapikey
    public function update_new_post()
    {
        $this->load->model("news_model");
        $result = $this->news_model->update_new(json_decode($this->post("new")));

        if($result === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Noticia actualizada'
				), REST_Controller::HTTP_OK);
            }
    }

  

    public function update_status_post()
    {
        $this->load->model("news_model");
        $result = $this->news_model->update_status(json_decode($this->post("new")));

        if($result === false){
            $this->response(array('status' => FALSE, "message" => "Error Actualizando Estado"));
        }else{
            $this->response(array('status' => FALSE, "message" => "Estado cambiado"));
        }
    }

    public function events_get()
    {
        $this->load->model("news_model");
        $res = $this->news_model->events();
        if($res){
            $this->response($res, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
						'status' => FALSE,
						'message' => 'No hay eventos.'
				), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function upload_post()
    {
    $uploaddir = 'd:/img/';
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/assets/banners/';
    // $this->response($this->post("file"), 200);
    
    $file_name = underscore($_FILES['image']['name']);
    $uploadfile = $uploaddir.$file_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
        $dataDB['status'] = TRUE;   
        $dataDB['message'] = 'Imagen subida';       
        $dataDB['filename'] = $file_name;
        $dataDB['banner_url'] = $this->config->item('base_url'). 'assets/banners/' .$file_name;
     } else {
        $dataDB['status'] = FALSE;   
        $dataDB['message'] =  'Error subiendo imagen';       
     }
     $this->response($dataDB, 200);
     
    }


}