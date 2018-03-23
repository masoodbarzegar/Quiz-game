<?php

class Ques extends CI_Controller {
    var $user_state;
    function __construct(){
        parent::__construct();
        $this->load->model('ques_model');
        $this->user_state = $this->users_model->user_state();
    }
    public function index(){
        $vote_id = $this->uri->segment(2);
        $this->view($vote_id);    
    }
    public function view($vote_id){    
    }
  
}