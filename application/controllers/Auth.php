<?php
class Auth extends CI_Controller {
    var $user_state;
    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');    
        $this->user_state = $this->users_model->user_state();
    }
	public function index(){
		$data['user_state'] = $this->user_state;
        if($data['user_state']){
            redirect(base_url());
        }else{  
            $data['title'] = "ورود به پنل";
            $this->form_validation->set_rules('username', 'User Name','required|callback_user_login');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run() === FALSE ){     
                
                $this->load->view('front/templates/header', $data);
                $this->load->view('front/templates/login',$data );
                $this->load->view('front/templates/footer');   

            }else{
                $user_data = $this->users_model->get_user_all('username');
                $this->session->set_userdata('logged_user', $user_data['id'] );
                $this->session->set_userdata('logged_disname', $user_data['disname'] );
                $this->session->set_userdata('logged_role', $user_data['role'] );
                //$this->session->mark_as_temp('logged_user', 3);

                if($user_data['admin'] == 1){
                    $this->session->set_userdata('admin_user', true );
                }
                //$this->user_state = $this->users_model->user_state();
                //$data['user_state'] = $this->user_state ;
                redirect(base_url('/_p123'));
            }
        }
	}
	public function login(){
	       	
            $this->index();   
	}
	public function logout(){
		$this->session->sess_destroy();
        redirect(base_url());
	}
    public function register(){
        $data['user_state'] = $this->user_state;
        if($data['user_state']){
            redirect(base_url()); 
        }else{
            $data['title'] = "ثبت نام";
            $this->form_validation->set_rules('username', 'User Name', 'required|callback_user_exist');
            $this->form_validation->set_rules('disname', 'Display Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|callback_email_exist');    
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passconf', 'Password', 'required|matches[password]');
            
            if ($this->form_validation->run() === FALSE){     
                
                $this->load->view('front/templates/header', $data);
                $this->load->view('front/templates/register',$data );
                $this->load->view('front/templates/footer');     
            }else{
                $this->users_model->set_user();
                $this->load->view('front/templates/header', $data);
                $this->load->view('front/templates/login',$data );
                $this->load->view('front/templates/footer');               
            }
        }
    }
    public function user_login(){
        if($this->users_model->user_exist('username')){
            $user_data = $this->users_model->get_user_all('username');
            $check_password = hash('sha256', $_POST['password'] . $user_data['salt']); 
            /*for($round = 0; $round < 65536; $round++) { 
                $check_password = hash('sha256', $check_password . $user_data['salt']); 
            } */    
            if($check_password === $user_data['password']) { 
                return true;
            }else{
                $this->form_validation->set_message('user_login', 'Wrong Data');
                return false;
            }
        }else{

            $this->form_validation->set_message('user_login', 'Wrong Data');
            return false;
        }   
    }
    public function user_exist(){
        if($this->users_model->user_exist('username')){
            $this->form_validation->set_message('user_exist', 'The username you choose are existed');
            return false;
        }else{
            return true;
        }
    }
    
    public function email_exist(){
        if($this->users_model->user_exist('email')){
            $this->form_validation->set_message('email_exist', 'The email you choose are existed');
            return false;
        }else{
            return true;
        }
    }

}