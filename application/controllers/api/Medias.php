<?php
//debemos colocar esta línea para extender de REST_Controller
require(APPPATH.'/libraries/REST_Controller.php');
require(APPPATH . '/libraries/MP3File.php');

header('Access-Control-Allow-Origin: *');

class medias extends REST_Controller
{
    //con esto limitamos las consultas y los permisos a la api
    protected $methods = array(
        'medias_get' => array('level' => 0),//devuelve todos los medias
        'audios_get' => array('level' => 0),//devuelve todos los audios
        'media_id_get' => array('level' => 0),//devuelve media por id
        'audio_id_get' => array('level' => 0),//devuelve media por id
        'new_media_post' => array('level' => 0),//crea un media nuevo
        'new_audio_post' => array('level' => 0),//crea un media nuevo
        'media_status_get' => array('level' => 0), //deveuelve el estado de del media 0 inactivo, 1 activo
        'audio_status_get' => array('level' => 0), //deveuelve el estado de del media 0 inactivo, 1 activo
        'update_status_post' => array('level' => 0), //cambia el estado del usuario
        'update_status_audio_post' => array('level' => 0), //cambia el estado del usuario
        'update_media_post' => array('level' => 0), //actualiza usuario backend
        'update_audio_post' => array('level' => 0), //actualiza usuario backend
        'new_category_post' => array('level' => 0), //crear categoria
        'new_module_post' => array('level' => 0), //crear categoria
        'new_sub_category_post' => array('level' => 0), //crear sub categoria
        'categories_get' => array('level' => 0), //devuelve las categorias
        'modules_get' => array('level' => 0), //devuelve las categorias
        'sub_categories_get' => array('level' => 0), //devuelve las sub categorias
        'delete_media_post' => array('level' => 0), //elimina media
        'delete_audio_post' => array('level' => 0), //elimina audio
        'upload_post' => array('level' => 0), //elimina audio
        'youtube_get' => array('level' => 0), //elimina audio   
        'youtube_duration_get' => array('level' => 0) //elimina audio        
    );
   
    //obtener user por id
    //users/user_id/id/id_user/X-API-KEY/miapikey
    public function media_id_get()
    {
        if(!$this->get("id_media")){
            $this->response(NULL, 400);
        }
        $this->load->model("medias_model");
        
        $media = $this->medias_model->media_id($this->get("id_media"));
        if($users){
            $this->response($media, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Media no encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function audio_id_get()
    {
        if(!$this->get("id_audio")){
            $this->response(NULL, 400);
        }
        $this->load->model("medias_model");
        
        $media = $this->medias_model->audio_id($this->get("id_audio"));
        if($users){
            $this->response($media, REST_Controller::HTTP_OK);
        }else{
            $this->response(array(
                "status" => FALSE,
                "message" => "Media no encontrado..."
            ),REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //obtener 
    //users/users/X-API-KEY/miapikey
    public function medias_get()
    {
        $id_category = $this->get("id_category");
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;

        $this->load->model("medias_model");
        $medias = $this->medias_model->medias($id_category, $q, $limit, $start);
        if($medias){
            $this->response($medias, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
                'status' => FALSE,
                'message' => 'Nada encontrado'
        ), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //obtener 
    //users/users/X-API-KEY/miapikey
    public function audios_get()
    {
        $id_module = $this->get("id_module");
        $q = urldecode($this->get("q"));
        $limit = $this->get("limit") !='' ? $this->get("limit") : $this->config->item('LIMIT');
        $start = $this->get("start") !='' ? (int) $this->get("start") : 0;

        $this->load->model("medias_model");
        $medias = $this->medias_model->audios($id_module, $q, $limit, $start);
        if($medias){
            $this->response($medias, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
                'status' => FALSE,
                'message' => 'Nada encontrado'
        ), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function media_status_get()
    {
        $this->load->model("medias_model");
        $res = $this->medias_model->media_status($this->get("id_media"));
        if($res){
            $this->response($res, REST_Controller::HTTP_OK); 
        }else{
            $this->response(array(
						'status' => FALSE,
						'message' => 'Error consultando estado.'
				), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function audio_status_get()
    {
        $this->load->model("medias_model");
        $res = $this->medias_model->media_status($this->get("id_audio"));
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
    public function new_media_post()
    {   

        if($this->post("media")){
            $this->load->model("medias_model");
            $new = $this->medias_model->new_media(json_decode($this->post("media")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe el multimedia'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Multimedia creado'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    //crear nueva media
    //users/nuevo/X-API-KEY/miapikey
    public function new_audio_post()
    {   

        if($this->post("media")){
            $this->load->model("medias_model");
            $new = $this->medias_model->new_audio(json_decode($this->post("media")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe el audio'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Audio creado'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    public function delete_media_post()
    {   

        if($this->post("media")){
            $this->load->model("medias_model");
            $new = $this->medias_model->delete_media(json_decode($this->post("media")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Error'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Multimedia eliminado'
				), REST_Controller::HTTP_OK);
            }
        }
    }



    public function delete_audio_post()
    {   

        if($this->post("media")){
            $this->load->model("medias_model");
            $new = $this->medias_model->delete_audio(json_decode($this->post("media")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Error'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Audio eliminado'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    public function new_category_post()
    {   

        if($this->post("category")){
            $this->load->model("medias_model");
            $new = $this->medias_model->new_category(json_decode($this->post("category")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe una categoría con ese nombre'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Categoría creada'
				), REST_Controller::HTTP_OK);
            }
        }
    }


    public function new_module_post()
    {   

        if($this->post("module")){
            $this->load->model("medias_model");
            $new = $this->medias_model->new_module(json_decode($this->post("module")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe un módulo con ese nombre'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Módulo creado'
				), REST_Controller::HTTP_OK);
            }
        }
    }

    public function new_sub_category_post()
    {   

        if($this->post("sub_category")){
            $this->load->model("medias_model");
            $new = $this->medias_model->new_sub_category(json_decode($this->post("sub_category")));
            if($new === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe una sub categoría con ese nombre'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Sub Categoría creada'
				), REST_Controller::HTTP_OK);
            }
        }
    }

    //actualizar 
    //users/actualizar/X-API-KEY/miapikey
    public function update_media_post()
    {
        $this->load->model("medias_model");
        $result = $this->medias_model->update_media(json_decode($this->post("media")));

        if($result === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe URL en otro multimedia'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Multimedia actualizada'
				), REST_Controller::HTTP_OK);
            }
    }


    public function update_audio_post()
    {
        $this->load->model("medias_model");
        $result = $this->medias_model->update_audio(json_decode($this->post("media")));

        if($result === false){
                $this->response(array(
						'status' => FALSE,
						'message' => 'Ya existe URL/MP3 en otro audio'
				), REST_Controller::HTTP_NOT_FOUND);
            }else{
                $this->response(array(
						'status' => TRUE,
						'message' => 'Audio actualizado'
				), REST_Controller::HTTP_OK);
            }
    }

  

    public function update_status_post()
    {
        $this->load->model("medias_model");
        $result = $this->medias_model->update_status(json_decode($this->post("media")));

        if($result === false){
            $this->response(array('status' => FALSE, "message" => "Error Actualizando Estado"));
        }else{
            $this->response(array('status' => FALSE, "message" => "Estado cambiado"));
        }
    }

    public function update_status_audio_post()
    {
        $this->load->model("medias_model");
        $result = $this->medias_model->update_status_audio(json_decode($this->post("media")));

        if($result === false){
            $this->response(array('status' => FALSE, "message" => "Error Actualizando Estado"));
        }else{
            $this->response(array('status' => FALSE, "message" => "Estado cambiado"));
        }
    }


    public function categories_get()
    {
        $this->load->model("medias_model");
        $res = $this->medias_model->categories();
        if($res){
            $this->response($res, 200);
        }else{
            $this->response(NULL, 400);
        }
    }


    public function modules_get()
    {
        $this->load->model("medias_model");
        $res = $this->medias_model->modules();
        if($res){
            $this->response($res, 200);
        }else{
            $this->response(NULL, 400);
        }
    }

    public function sub_categories_get()
    {
        $this->load->model("medias_model");
        $res = $this->medias_model->sub_categories($this->get("id_category"));
        if($res){
            $this->response($res, 200);
        }else{
            $this->response(NULL, 400);
        }
    }

    public function upload_post()
    {
    
    //echo "duration: $duration1 seconds"."\n";
    //echo "estimate: $duration2 seconds"."\n";
    //echo MP3File::formatTime($duration2)."\n";
    $uploaddir = 'd:/img/';
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/assets/audios/';
    // $this->response($this->post("file"), 200);
    //var_dump($_FILES);
    $file_name = underscore($_FILES['audio']['name']);
    $uploadfile = $uploaddir.$file_name;
    
    //$duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
    //$duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
    
       // var_dump($_FILES);
       


    if (!file_exists($uploadfile) ) {


        if (move_uploaded_file($_FILES['audio']['tmp_name'], $uploadfile)) {
            
            $mp3file = new MP3File($uploadfile);
            $duration1 = $mp3file->getDurationEstimate();

            $dataDB['status'] = TRUE;   
            $dataDB['message'] = 'Audio cargado...';       
            $dataDB['filename'] = $file_name;
            $dataDB['audio_url'] = $this->config->item('base_url'). 'assets/audios/' .$file_name;
            $dataDB['duration'] = $duration1;
        } else {
            $dataDB['status'] = FALSE;   
            $dataDB['message'] =  'Error subiendo audio';       
        }

    }else{

        $mp3file = new MP3File($uploadfile);
        $duration1 = $mp3file->getDurationEstimate();
        $dataDB['status'] = TRUE; 
        $dataDB['message'] = 'Audio cargado...';       
        $dataDB['filename'] = $file_name;
        $dataDB['audio_url'] = $this->config->item('base_url'). 'assets/audios/' .$file_name;
        $dataDB['duration'] = $duration1;

    }

     $this->response($dataDB, 200);
     
    }


    public function youtube_get(){

         $url = $this->get('url');
         parse_str(parse_url($url,PHP_URL_QUERY),$arr);
         $video_id=$arr['v']; 
         //$youtube = "https://www.googleapis.com/youtube/v3/videos?id=9bZkp7q19f0&part=contentDetails&key=AIzaSyAcezfuGMu27smQgGcno2JzUDyCvECRV78";
         $youtube = "https://www.googleapis.com/youtube/v3/videos?id=".$video_id."&part=contentDetails&key=AIzaSyAcezfuGMu27smQgGcno2JzUDyCvECRV78";
         $data=file_get_contents($youtube);
         $obj=json_decode($data);

         if(!$data)
         $this->response(array('status' => FALSE, "message" => "Error"));  
         else
         //$this->ISO8601ToSeconds($obj->items[0]->contentDetails->duration
         $this->response($obj, REST_Controller::HTTP_OK);
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