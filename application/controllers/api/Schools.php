<?php
//debemos colocar esta línea para extender de REST_Controller
require(APPPATH.'/libraries/REST_Controller.php');
header('Access-Control-Allow-Origin: *');
class schools extends REST_Controller
{
    //con esto limitamos las consultas y los permisos a la api
    protected $methods = array(
        'schools_get' => array('level' => 0),//devuelve todos los medias
        'school_id_get' => array('level' => 0),//devuelve media por id
        'new_school_post' => array('level' => 0),//crea un media nuevo
        'school_status_get' => array('level' => 0), //deveuelve el estado de del media 0 inactivo, 1 activo
        'update_status_post' => array('level' => 0), //cambia el estado del usuario
        'update_school_post' => array('level' => 0), //actualiza usuario backend
        'delete_school_post' => array('level' => 0) //elimina media,
        
    );
   
    //obtener user por id
    //users/user_id/id/id_user/X-API-KEY/miapikey
    public function school_id_get()
    {
        if(!$this->get("id_school")){
            $this->response(NULL, 400);
        }
        $this->load->model("schools_model");
        
        $res = $this->schools_model->school_id($this->get("id_shool"));
        if($new){
            $this->response($res, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Escuela de negocio no encontrada..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //obtener 
    //users/users/X-API-KEY/miapikey
    public function schools_get()
    {
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;
        $this->load->model("schools_model");
        $res = $this->schools_model->schools($q, $limit, $start);
        if($res){
            $this->response($res, 200);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Nada encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function school_status_get()
    {
        $this->load->model("schools_model");
        $res = $this->schools_model->school_status($this->get("id_school"));
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
    public function new_school_post()
    {   

        if($this->post("school")){
            $this->load->model("schools_model");
            $new = $this->schools_model->new_school(json_decode($this->post("school")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe la escuela de negocio'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Escuela de negocio creada'
				), REST_Controller::HTTP_OK);
            }
        }
    }

    public function delete_school_post()
    {   

        if($this->post("school")){
            $this->load->model("schools_model");
            $new = $this->schools_model->delete_school(json_decode($this->post("school")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Error'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Esuela de negocio eliminada'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    //actualizar 
    //users/actualizar/X-API-KEY/miapikey
    public function update_school_post()
    {
        $this->load->model("schools_model");
        $result = $this->schools_model->update_school(json_decode($this->post("school")));

        if($result === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe el video en otra escuela'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Escuela actualizada'
				), REST_Controller::HTTP_OK);
            }
    }

  

    public function update_status_post()
    {
        $this->load->model("schools_model");
        $result = $this->schools_model->update_status(json_decode($this->post("school")));

        if($result === false){
            $this->response(array('status' => FALSE, "message" => "Error Actualizando Estado"));
        }else{
            $this->response(array('status' => FALSE, "message" => "Estado cambiado"));
        }
    }

    public function youtube_duration_get(){
        
                 $url = $this->get('url');
                 parse_str(parse_url($url,PHP_URL_QUERY),$arr);
                 $video_id=$arr['v']; 
                 //$youtube = "https://www.googleapis.com/youtube/v3/videos?id=9bZkp7q19f0&part=contentDetails&key=AIzaSyAcezfuGMu27smQgGcno2JzUDyCvECRV78";
                 $youtube = "https://www.googleapis.com/youtube/v3/videos?id=".$video_id."&part=contentDetails&key=AIzaSyAcezfuGMu27smQgGcno2JzUDyCvECRV78";
                 $data=file_get_contents($youtube);
                 $obj=json_decode($data);
        
                 if(empty($obj->items[0]) )
                 $this->response(array('status' => FALSE, "message" => "Error"));  
                 else
                 //$this->ISO8601ToSeconds($obj->items[0]->contentDetails->duration
                 $this->response($this->ISO8601ToSeconds($obj->items[0]->contentDetails->duration, REST_Controller::HTTP_OK));
            }

    private function get_duration($url){
        parse_str(parse_url($url,PHP_URL_QUERY),$arr);
        $video_id=$arr['v']; 
        //$youtube = "https://www.googleapis.com/youtube/v3/videos?id=9bZkp7q19f0&part=contentDetails&key=AIzaSyAcezfuGMu27smQgGcno2JzUDyCvECRV78";
        $youtube = "https://www.googleapis.com/youtube/v3/videos?id=".$video_id."&part=contentDetails&key=AIzaSyAcezfuGMu27smQgGcno2JzUDyCvECRV78";
        $data=file_get_contents($youtube);
        $obj=json_decode($data);
        return $this->ISO8601ToSeconds($obj->items[0]->contentDetails->duration);
    }

    private function ISO8601ToSeconds($ISO8601){
        $interval = new DateInterval($ISO8601);
    
        return ($interval->d * 24 * 60 * 60) +
            ($interval->h * 60 * 60) +
            ($interval->i * 60) +
            $interval->s;
    }  



}