<?php
class Admin extends CI_Controller {
    var $user_state;
    function __construct(){
        parent::__construct();
        $this->user_state = $this->users_model->user_state();

        if(!$this->user_state['admin_user']){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->library('options');
        $this->load->library('pagination');
    }
    public function index(){
        
        $data['user_state'] = $this->user_state;
        $data['title'] = 'پنل ادمین';            
            
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/admin', $data);
        $this->load->view('admin/templates/footer', $data);            
    }

    public function page_create(){
        
        $this->load->model('pages_model');
        $page_front_path = realpath(APPPATH . '/views/front/pages');
        
        $data['user_state'] = $this->user_state;
        $data['page_edite'] = false;
        $data['title'] = 'Create a Page';
         
        $this->form_validation->set_rules('page_title', 'Title', 'required');
        $this->form_validation->set_rules('page_content', 'Text', 'required');

        $files = scandir($page_front_path);
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
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/success');
            $this->load->view('admin/templates/footer' );
        }
    }
    public function page_edite(){

        $this->load->model('pages_model');
        $page_front_path = realpath(APPPATH . '/views/front/pages');
        
        $data['user_state'] = $this->user_state;
        $data['page_edite'] = true;
        $data['title'] = 'Edite a Page';
         
        $page_id = $this->uri->segment(3);
        if($page_id == ''){
            $data['title'] = 'Page list';
            $data['pages_list'] = $this->page_list();
            
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/page_list', $data);
            $this->load->view('admin/templates/footer', $data);    
        }else{
            $this->form_validation->set_rules('page_title', 'Title', 'required');
            $this->form_validation->set_rules('page_content', 'Text', 'required');

            $files = scandir($page_front_path);
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
                    $this->load->view('admin/templates/header', $data);
                    $this->load->view('admin/success');
                    $this->load->view('admin/templates/footer' );
            }
        }
    }
    public function page_ex_opt(){
        $this->load->model('pages_model');
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
    }

    public function user(){      
    }
    public function user_edite(){
        
        $data['user_state'] = $this->user_state;
        $data['edite_id'] =  $this->uri->segment(3);

        if($data['edite_id'] == ''){
            $data['title'] = 'User list';
            $data['users_list'] = $this->user_list();
            
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/user_list', $data);
            $this->load->view('admin/templates/footer', $data);  
        }else{  
            $data['title'] = 'ویرایش اعضا';

            $data['user_data'] = $this->users_model->get_user_all2('id',$data['edite_id']);
            
            $this->form_validation->set_rules('username','User Name','callback_user_exist2');
            //$this->form_validation->set_rules('disname', 'Display Name', 'required');
            $this->form_validation->set_rules('email','Email','valid_email|callback_email_exist2'); 
            //$this->form_validation->set_rules('password', 'Password', '');

            if( $this->form_validation->run() === FALSE ){
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/edite/edite-profile', $data);
                $this->load->view('admin/templates/footer', $data);
            }else{
                $this->users_model->update_user();
                $this->load->view('admin/success', $data);
            }
        }
    }
    public function user_exist2(){
        if($this->users_model->user_exist2('username')){
            $this->form_validation->set_message('user_exist2', 'The username you choose are existed');
            return false;
        }else{
            return true;
        }
    }
    public function email_exist2(){
        if($this->users_model->user_exist2('email')){
            $this->form_validation->set_message('email_exist2', 'The email you choose are existed');
            return false;
        }else{
            return true;
        }
    }

    public function ques_create(){

        $this->load->model('Ques_model');
        $page_front_path = realpath(APPPATH . '/views/admin/edite/');
        
        $data['user_state'] = $this->user_state;
        $data['ques_edite'] = false;
        $data['title'] = 'Create a Question';
         
        $this->form_validation->set_rules('ques_text', 'Question', 'required');
        $this->form_validation->set_rules('ques_ans1', 'Question Answer', 'required');
        $this->form_validation->set_rules('ques_ans2', 'Question Answer', 'required');
        $this->form_validation->set_rules('ques_ans3', 'Question Answer', 'required');
        $this->form_validation->set_rules('ques_ans4', 'Question Answer', 'required');
        $this->form_validation->set_rules('ques_level','Question Level' , 'required');
        $this->form_validation->set_rules('c_ans'     ,'Question Answer' , 'required');

        if ($this->form_validation->run() === FALSE){     
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/edite-ques' ,$data);
            $this->load->view('admin/templates/footer' );
        }else{                   
            $this->Ques_model->create_ques();
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/success');
            $this->load->view('admin/templates/footer' );
        }
    }
    public function ques_edite(){

        $this->load->model('Ques_model');
        $ques_front_path = realpath(APPPATH . '/views/front/ques');
        
        $data['user_state'] = $this->user_state;
        $data['ques_edite'] = true;
        $data['title'] = 'Edite a Question';
         
        $ques_id = $this->uri->segment(3);
        
        if($ques_id == ''){
            $data['title'] = 'Question list';
            $data['queses_list'] = $this->ques_list();
            
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/ques_list', $data);
            $this->load->view('admin/templates/footer', $data);

        }else{

            $this->form_validation->set_rules('ques_text', 'Question', 'required');
            $this->form_validation->set_rules('ques_ans1', 'Question Answer', 'required');
            $this->form_validation->set_rules('ques_ans2', 'Question Answer', 'required');
            $this->form_validation->set_rules('ques_ans3', 'Question Answer', 'required');
            $this->form_validation->set_rules('ques_ans4', 'Question Answer', 'required');
            $this->form_validation->set_rules('ques_level','Question Level' , 'required');
                            
            $data['ques_data']  = $this->Ques_model->get_ques_back($ques_id);

            if ($this->form_validation->run() === FALSE){     
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/edite/edite-ques' ,$data);
                $this->load->view('admin/templates/footer' );
            }else{ 
                $this->Ques_model->update_ques($ques_id);
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/success');
                $this->load->view('admin/templates/footer' );            
            }
        }
    }

    public function discont_create(){

        $this->load->model('Discs_model');
        $this->load->model('Award_model');

        $page_front_path = realpath(APPPATH . '/views/admin/edite/');
        
        $data['user_state'] = $this->user_state;
        $data['discont_edite'] = false;
        $data['title'] = 'Create a Discount';
        $data['form_award_list'] = $this->Award_model->dropdown_award_list();

         
        $this->form_validation->set_rules('discont_code', 'Discount Code', 'required');    
        $this->form_validation->set_rules('award_text', 'Award Text', 'required'); 

        if ($this->form_validation->run() === FALSE){     
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/edite-discount' ,$data);
            $this->load->view('admin/templates/footer' );
        }else{                   
            $this->Discs_model->create_disc();
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/success');
            $this->load->view('admin/templates/footer' );
        }
    }
    public function discont_edite(){

        $this->load->model('Discs_model');
        $this->load->model('Award_model');
        $ques_front_path = realpath(APPPATH . '/views/front/ques');
        
        $data['user_state'] = $this->user_state;
        $data['discont_edite'] = true;
        $data['title'] = 'Edite a Discount';
        $data['form_award_list'] = $this->Award_model->dropdown_award_list();
 
        $discont_id = $this->uri->segment(3);
        
        if($discont_id == ''){
            $data['title'] = 'Discount Code list';
            $data['discs_list'] = $this->discount_list();
            
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/discount_list', $data);
            $this->load->view('admin/templates/footer', $data);

        }else{

            $this->form_validation->set_rules('discont_code', 'Discount Code', 'required');    
            $this->form_validation->set_rules('award_text', 'Award Text', 'required');    

            $data['disc_data']  = $this->Discs_model->get_disc($discont_id);

            if ($this->form_validation->run() === FALSE){     
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/edite/edite-discount' ,$data);
                $this->load->view('admin/templates/footer' );
            }else{ 
                $this->Discs_model->update_disc($discont_id);
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/success');
                $this->load->view('admin/templates/footer' );            
            }
        } 
    }

    public function award_create(){

        $this->load->model('Award_model');

        $page_front_path = realpath(APPPATH . '/views/admin/edite/');
        
        $data['user_state'] = $this->user_state;
        $data['award_edite'] = false;
        $data['title'] = 'Create a Award';

        $this->form_validation->set_rules('award_text', 'Award', 'required');


        if ($this->form_validation->run() === FALSE){     
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/edite-award' ,$data);
            $this->load->view('admin/templates/footer' );
        }else{                   
            $this->Award_model->create_award();
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/success');
            $this->load->view('admin/templates/footer' );
        }
    }
    public function award_edite(){

        $this->load->model('Award_model');
        $ques_front_path = realpath(APPPATH . '/views/front/ques');
        
        $data['user_state'] = $this->user_state;
        $data['award_edite'] = true;
        $data['title'] = 'Edite a Award';
         
        $award_id = $this->uri->segment(3);
        
        if($award_id == ''){
            $data['title'] = 'Award list';
            $data['awards_list'] = $this->award_list();

            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/edite/award_list', $data);
            $this->load->view('admin/templates/footer', $data);
        }else{

            $this->form_validation->set_rules('award_text', 'Award', 'required');
            $data['award_data']  = $this->Award_model->get_award($award_id);

            if ($this->form_validation->run() === FALSE){     
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/edite/edite-award' ,$data);
                $this->load->view('admin/templates/footer' );
            }else{ 
                $this->Award_model->update_award($award_id);
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/success');
                $this->load->view('admin/templates/footer' );            
            }
        } 
    }

    public function game_log(){
        
        $this->load->model('Game_model');
        $config = array();
        $config["base_url"] = base_url() . "_p123/lgame";
        $config["total_rows"] = $this->Game_model->record_count();
        $config["per_page"] = 1000;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["games_list"] = $this->Game_model->fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();


	$data['total_rows'] = $config["total_rows"] ;
	$data['a'] = $this->uri->segment(3);
        $data['user_state'] = $this->user_state;
        $data['title'] = 'Game Log';
        //$data['games_list'] = $this->game_list();
            
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/game_list', $data);
        $this->load->view('admin/templates/footer', $data);   
    
    }
    public function player_log(){
        
        $this->load->model('Player_model');
        
        $data['user_state'] = $this->user_state;
        $data['title'] = 'Player Log';
        $data['players_list'] = $this->player_list();
            
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/player_list', $data);
        $this->load->view('admin/templates/footer', $data);   
    }
    public function player_game_log(){

        $player_id = $this->uri->segment(3);
        $this->load->model('Game_model');
        $this->load->model('Player_model');
        
        $data['user_state'] = $this->user_state;
        $data['title'] = 'Player award';
        $data['player_games_list'] = $this->player_game_list($player_id);
        $data['player_data'] = $this->Player_model->get_bakend_player($player_id);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/player_game_list', $data);
        $this->load->view('admin/templates/footer', $data);   
    }

    public function show_award(){

        $this->load->model('Discs_model');
        $data['user_state'] = $this->user_state;
        $data['title'] = 'کده های تخفیف شرکت کننده';
        $player_id = $this->uri->segment(4);
        $data['player_disc_list'] = $this->Discs_model->get_player_disc($player_id);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/player_disc_list', $data);
        $this->load->view('admin/templates/footer', $data);  
    }
    
    private function user_list(){
        return $this->users_model->get_user_list();
    }
    private function page_list(){
        return $this->pages_model->get_pages_list();
    }
    private function ques_list(){
        return $this->Ques_model->get_ques_list();
    }
    private function award_list(){
        return $this->Award_model->get_award_list();
    }
    private function discount_list(){
        return $this->Discs_model->get_disc_list();
    }

    private function game_list(){
        return $this->Game_model->get_game_list();
    }
    private function player_game_list($player_id){
        return $this->Game_model->get_player_game_list($player_id);
    }
    private function player_list(){
        return $this->Player_model->get_player_list();
    }
}