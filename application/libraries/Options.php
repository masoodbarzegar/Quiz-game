<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options{

    public function image_list(){
        $data['user_login'] = $this->user_login;
        if($data['user_login']){
            //logged_id = $this->users_model->logged_id();
            //$user_data = $this->users_model->get_user('id',$logged_id);
            //$data['user_admin'] = $this->session->userdata('admin_user');
            $data['images'] = $this->media_model->get_images();
            $this->load->view('admin/media-list' , $data);
        }
    }
}