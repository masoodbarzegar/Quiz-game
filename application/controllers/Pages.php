<?php

class Pages extends CI_Controller {
    var $user_state;
    var $page_front_path;
    var $page_back_path;  

    function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
        $this->user_state = $this->users_model->user_state();
        $this->page_front_path = realpath(APPPATH . '/views/front/pages');
        $this->page_back_path  = realpath(APPPATH . '/views/back/pages');
    }
    public function index(){
        $page_id = $this->uri->segment(2);
        $this->view($page_id);
    
    }
    public function view($page_id){
        //$this->output->cache(300);
        $data['user_state'] = $this->user_state;
        //$page_id = $this->uri->segment(3);
        if($page_id == ''){
            $page_id = 1;
        }
        $page_data = $this->pages_model->get_page($page_id);
        if(!$page_data){
            show_404();
        }
        
        $data['title'] = $page_data['page_title'];
        $data['page_content'] = $page_data['page_content'];
        $template = $page_data['page_template'];
        $data['page_desc'] = $this->pages_model->get_pmeta($page_id , 'page_desc');
        if($template == ''){
            $template = 'index';
        }else{
            $data['pmeta'] = $this->pages_model->get_pmeta($page_data['id'],'page_setting');
        }
        $this->load->view('front/templates/header', $data);
        $this->load->view('front/pages/'.$template , $data);
        $this->load->view('front/templates/footer', $data);
    }
    /*
    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['user_admin'] = $this->session->userdata('admin_user');
        $data['user_login'] = $this->user_login;
        if($data['user_login'] && $data['user_admin']){
           
            $data['page_edite'] = false;
            $data['title'] = 'Create a Page';
         
            $this->form_validation->set_rules('page_title', 'Title', 'required');
            $this->form_validation->set_rules('page_content', 'Text', 'required');

            $files = scandir($this->page_front_path);
            $files = array_diff($files, array('.', '..', 'index.php'));
             foreach ($files as $file) {
                $temp = substr($file, 0, strpos($file, '.'));        
                $tems[$temp]= $temp;
            }
            
            $data['templates'] = $tems;
            
            if ($this->form_validation->run() === FALSE){     
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/edite/edite-page' ,$data);
                $this->load->view('admin/templates/footer' );
            }else{                   
                $this->pages_model->create_page();
                $this->load->view('admin/success');
            }
        }else{
            $this->load->view('front/templates/header', $data);
            $this->load->view('per-denid', $data);
            $this->load->view('front/templates/footer', $data); 
        }
    }
    public function edite(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['user_admin'] = $this->session->userdata('admin_user');
        $data['user_login'] = $this->user_login;
        if($data['user_login'] && $data['user_admin']){
            $data['page_edite'] = true;
            $page_id = $this->uri->segment(3);
            $data['title'] = 'Edite a Page';
         
            $this->form_validation->set_rules('page_title', 'Title', 'required');
            $this->form_validation->set_rules('page_content', 'Text', 'required');

            $files = scandir($this->page_front_path);
            $files = array_diff($files, array('.', '..', 'index.php'));
            foreach ($files as $file) {
                $temp = substr($file, 0, strpos($file, '.'));        
                $tems[$temp]= $temp;
            }
            
            $data['templates'] = $tems;
            
            $data['page_data'] = $this->pages_model->get_page($page_id);
            $data['page_setting'] = $this->pages_model->get_pmeta($page_id , 'page_setting');
            $data['page_desc'] = $this->pages_model->get_pmeta($page_id , 'page_desc');

            if ($this->form_validation->run() === FALSE){     
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/edite/edite-page' ,$data);
                $this->load->view('admin/templates/footer' );
            }else{ 
                $this->pages_model->update_page($page_id);
                $this->load->view('admin/success');
            }

        }else{
            $this->load->view('front/templates/header', $data);
            $this->load->view('per-denid', $data);
            $this->load->view('front/templates/footer', $data); 
        }
    }
    public function ex_setting(){
        $pagetemp = $this->uri->segment(3);     
        if ( file_exists(APPPATH.'/views/admin/edite/template-setting/'. $pagetemp .'-setting.php')){
            if(isset($_POST['page_edite']) && $_POST['page_edite'] == true){
                $page_setting = $this->pages_model->get_pmeta($_POST['page_id'],'page_setting');
                $data['page_setting'] = unserialize($page_setting);
                $data['page_edite'] = true;
            }else{
                $data['page_edite'] = false;
            }
            $this->load->view('admin/edite/template-setting/'. $pagetemp .'-setting' ,$data);
        }else{
            return '';
        }
    }*/
}