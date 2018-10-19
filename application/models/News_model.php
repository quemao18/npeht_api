<?php

class News_model extends CI_Model
{
    public function new_id($id_new){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("news", array("news.id_new" => $id_new));
        if($query->num_rows() == 1){
            return $query->row();
        }
    }


    public function delete_new($new){
        if($this->db->delete('news', array('id_new' => $new->id_new)))
            return true;
            else
            return false;
    }



    public function new_status($id_new){
        $this->db->select("*");
        //$this->db->join('bancos', 'bancos.id_user=users.id_user');
        $query = $this->db->get_where("news", "news.id_new=".$id_new);
        if($query->num_rows() == 1){
            return $query->row();
        }
    }


    public function new_new($new){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $new->name,
            "id_event" => $new->id_event,
            "date_from" => $new->date_from,
            "date_finish" => $new->date_finish,
            "banner_url" => $new->banner_url,
            "status" => '1',
            "date_create" => date('Y-m-d H:i:s')
        );
    
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('name', $new->name);
    $query = $this->db->where('id_event', $new->id_event)->get('news');

        if($query->num_rows() == 0){
        //  if($this->db->insert("news", $data)){
            $this->db->insert("news", $data);
            return true;
        }else{
            return false;
        }
    }


       public function update_new($new){

        $data = array(
            //"id_user" => $user->id_user,
            "name" => $new->name,
            "id_event" => $new->id_event,
            "date_from" => $new->date_from,
            "date_finish" => $new->date_finish,
            "banner_url" => $new->banner_url,
            "date_update" => date('Y-m-d H:i:s')
        );
        //$query = $this->db->update('users', $data, array('id_user' => $user->id_user));
        //$query = $this->db->where('email', $user->email)->get('users');
        //$ignore = array($media->url);
        //$this->db->where_not_in('medias.url', $ignore);
        //if(!$this->check_url($media->url, $media->id_media) && !$this->check_url_id_media($media->url, $media->id_media) ){
        //    return false;
        //}else{
            $this->db->update('news', $data, array('id_new' => $new->id_new));
            return true;
        //}
       
    }

    public function update_status($new){
        if($new->status == 1)
        $data = array(
            "status" => 0, //inactivo
            "date_update" => date('Y-m-d H:i:s')
        );
        else
        $data = array(
            "status" => 1, //activo
            "date_update" => date('Y-m-d H:i:s')
        );
        $query = $this->db->update('news', $data, array('id_new' => $new->id_new));
        if($query){
            return true;
        }else{
            return false;
        }
       
    }

    public function news($q, $limit, $start)
    {
        if(!empty($start) || !empty($limit) || !is_null($start) || !is_null($limit))
        $this->db->limit($limit, $start);
 
        if(!empty($q)){
        $this->db->like('news.name', $q);  // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        $this->db->or_like('events.name', $q);  
        }

        $this->db->select('
        news.*,
        events.name as name_event
        ');
        $this->db->join('events', 'news.id_event=events.id_event');
        //$this->db->join('positions', 'positions.id_position=users.id_position');
        //$this->db->join('questions', 'questions.id_question=users.id_question');
        //$this->db->limit(1000, 0);
        //$this->db->group_by('users.ita');
        $this->db->order_by('date_create DESC');
        $query = $this->db->get("news");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

        public function events()
    {
        //$this->db->select('rols.id_rol, users.id_user, users.name');
        //$this->db->join('rols', 'rols.id_rol=users.id_user');
        $this->db->select('*');
        $query = $this->db->get("events");
       if($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function new_event($event){
   //$this->db->select("*");
     $data = array(
            //"id_user" => $user->id_user,
            "name" => $event->name,
        );
    //print_r($data);
    //$query = $this->db->or_where("users", array("ita" => $user->ita, "email" => $user->email));
    $query = $this->db->where('events.name',  $event->name)->get('events');

        if($query->num_rows() == 0){
            $this->db->insert("events", $data);
            return true;
        }else{
            return false;
        }
    }

}