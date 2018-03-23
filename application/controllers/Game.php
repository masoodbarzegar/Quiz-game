<?php

class Game extends CI_Controller {
    var $player_state;
    var $point;
    var $game_step;

    function __construct(){
        parent::__construct();
        $this->load->helper('email');
        $this->load->library('form_validation');
        $this->load->model('Game_model');
        $this->load->model('Player_model');
        $this->load->model('Ques_model');

        $this->player_state = $this->Player_model->player_state();
    }
    public function index(){
        $game_state = $this->uri->segment(2);
        $player_state = $this->player_state;
        if($game_state == 'start'){
           
            $this->login_view();

        }elseif($game_state == 'check') {

            $this->number_check();  

        }elseif($game_state == 'login') {
            
            $this->game_login(); 
        }elseif($game_state == 'caprefreshajax') {

        	$this->caprefreshajax();

        }elseif($game_state == 'caprefresh') {

            $this->caprefresh();

        }elseif($game_state == 'finish' && isset($player_state['player_id']) ){

            $this->game_finish();
        }elseif(isset($player_state) ){
            if(isset($player_state['player_id'])){
                $this->game_play();    
            }else{
                redirect(base_url('/game/start')); 
            }
        }elseif($game_state == 'time_finish' && isset($player_state['player_id']) ){
            
            $this->time_finish();

        }else{

            $this->number_check();
        }                 
    }

    public function login_view(){
        $data['title'] = 'ورود به بازی';

        $this->load->helper('captcha');
        $data['captchaImg'] = $this->create_catchaa();
        
        // $time['now'] = now();
        
        // $datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
        // $time['time']  = time();
        
        // $gmt = local_to_gmt(time());


        // $time['mdate'] = mdate($datestring, $time['time']);
        // $time['gmt'] = mdate($datestring, $gmt);

        //$data['time'] = $time;

        $data['player_state'] = $this->session->userdata();
        $this->load->view('front/templates/header' , $data);
        $this->load->view('front/start',$data);
        $this->load->view('front/templates/footer');
    }
    public function number_check(){

        $this->load->helper('captcha');
        $this->load->model('Player_model');
        if($this->input->post('ajax') == '1') {

            $this->form_validation->set_rules('player_mob', 'gamer mobile', 'required');
            $this->form_validation->set_rules('player_email', 'gamer email', 'required|valid_email');
            $this->form_validation->set_rules('captcha', 'Captcha', 'callback_validate_captcha');
            
            if ($this->form_validation->run() === FALSE ){
                $errors = validation_errors();
                $cap = $this->caprefresh();
                $userdata = $this->session->userdata();
                echo json_encode(array(
                    'ajaxState'=> false,
                    'ajaxdata' => $cap,
                    'ajaxmsg'  => $errors,
                    'ajaxuser' => $userdata
                ));
            }else{
                $cap = $this->caprefresh();
                $player_mob = $this->input->post('player_mob');
                $player_dub = $this->player_limit_dup($player_mob);

                //NewPlayer---------------------------------------------------------------------
                if(!$player_dub){
                    $player_mob   = $this->input->post('player_mob');
                    $player_email = $this->input->post('player_email');

                    $player_id = $this->Player_model->set_player($player_mob,$player_email); 

                    if($player_id != true){
                        $userdata = $this->session->userdata();
                        echo json_encode(array(
                            'ajaxState'=> false,
                            'ajaxdata' => $cap,
                            'ajaxmsg'=> 'مشکل سیستمی',
                            'ajaxuser'=> $userdata
                        ));
                    }else{
                        // ANY Thing is OK------------------------------------------------------
                        $messege = $this->send_messege($player_mob);
                        if($messege){
                            
                            $this->session->set_userdata('player_id' , $player_id);
                            $userdata = $this->session->userdata();
                            $confirmpage = $this->load->view('front/code', '', TRUE);
                            echo json_encode(array(
                                'ajaxState'=> true,
                                'ajaxdata' => $cap,
                                'ajaxmsg'  => $confirmpage,
                                'ajaxuser' => $userdata
                            ));
                        }else{
                            $userdata = $this->session->userdata();
                            echo json_encode(array(
                                'ajaxState'=> false,
                                'ajaxdata' => $cap,
                                'ajaxmsg'=> 'مشکل سیستمی',
                                'ajaxuser'=> $userdata
                            ));
                        }
                    } 
                //DupPlayer---------------------------------------------------------------------    
                }else{
                    $player_id = $player_dub;
                    $player_restime = $this->player_limit_rest($player_id);
                    // Rest time is fininsh ----------------------------------------------------
                    if($player_restime){
                        // ANY Thing is OK -----------------------------------------------------
                        $messege = $this->send_messege($player_mob);
                        if($messege){
                            $confirmpage = $this->load->view('front/code', '', TRUE);
                            $userdata = $this->session->userdata();
                            $this->session->set_userdata('player_id' , $player_id);
                            echo json_encode(array(
                                'ajaxState'=> true,
                                'ajaxdata' => $cap,
                                'ajaxmsg'  => $confirmpage,
                                'ajaxuser'=> $userdata
                            ));
                        }else{
                            $cap = $this->caprefresh();
                            $userdata = $this->session->userdata();
                            echo json_encode(array(
                                'ajaxState'=> false,
                                'ajaxdata' => $cap,
                                'ajaxmsg'=> 'مشکل سیستمی',
                                'ajaxuser'=> $userdata
                            ));
                        }
                    // Rest time is not fininsh ------------------------------------------------
                    }else{
                        $cap = $this->caprefresh();
                        $userdata = $this->session->userdata();
                        echo json_encode(array(
                            'ajaxState'=> false,
                            'ajaxdata' => $cap,
                            'ajaxmsg'=> 'شما به تازگی در مسابقه شرکت کرده اید لطفا 24 ساعت بعد دوباره تلاش کنید.',
                            'ajaxuser'=> $userdata
                        ));
                    }
                }  

            }
        }
    }
    public function game_login(){
        if($this->input->post('confirm_ajax') == '1') {

            $this->form_validation->set_rules('confirm_code', 'confirm_code', 'required|callback_confirm_code');
            if ($this->form_validation->run() === FALSE ){ 
                //$confirmpage = $this->load->view('front/code', '', TRUE);
                echo json_encode(array(
                    'confirmstate'=> false,
                    'confirmdata' => '',
                    'confirmmsg'=> 'دوباره تلاش کنید '
                ));
            }else{
            	
                $player_id  = $this->session->userdata('player_id');
                $game_qlist = $this->Game_model->create_qlist();
                
                
                $game_id    = $this->Game_model->create_game($player_id , $game_qlist); 
                
                
                if( $game_id != true){
                    echo json_encode(array(
                        'confirmstate'=> false,
                        'confirmdata' => '',
                        'confirmmsg'  => 'دوباره تلاش کید 2'
                    ));
                }else{
                    // ANY Thing is OK
                    //---------------------------------------------------------------------
                    $this->session->set_userdata('game_id' , $game_id);
                    $this->Player_model->update_player($player_id , 1 );
                    echo json_encode(array(
                        'confirmstate'=> true,
                        'confirmdata' => '',
                        'confirmmsg'  => 'کد را صحیح وارد کرده اید.'
                    ));

                } 
            }  
        }
    }
    public function game_play(){
    	$this->load->helper('form');
        $player_state  = $this->player_state;
	    $game_step     = $this->session->userdata('game_step');
	    $game_token    = $this->session->userdata('game_token');
	    $game_id       = $this->session->userdata('game_id');
        $game_data     = $this->Game_model->get_game($game_id);
        $game_lost     = $game_data['game_lost'];
    
        if($this->input->post('ajaxgame') == '1' && $game_step != 0) {
            
    	    //$this->form_validation->set_rules('c_ans', 'Please Select the answer', 'required'); 
            //Select question according to the game level
            //$ques_id = $this->question_select($game_step , $game_data['game_qlist']);
                
            $ques_id   = $this->input->post('ques_id');
            $game_id   = $this->input->post('game_id');
            $user_ans  = $this->input->post('c_ans');
            $time      = $this->input->post('ajaxtime');
            
            // Security check game_id & game_token
            if($game_token != $game_data['game_token']){
                $this->session->set_userdata('game_step', $game_step - 1 );
                echo json_encode(array(
                    'playstate'=> false,
                    'playdata' => $game_token,
                    'playmsg'  => $game_id
                ));
                exit;
            }

            $this->session->set_userdata('game_step', $game_step - 1 );

            $check_answer            = $this->check_answer( $ques_id , $user_ans );
            $check_game_expiration   = $this->check_game_expiration($game_id , $time);

            


            //Time cheacking
            if($check_game_expiration){
                //Cheack answer -->true
                if($check_answer){

                        // Calculate point ---------------------
                        $this->point   = $this->game_step_point($game_step , $game_lost);
                        $point = $this->point;
                        $award = $this->game_award($this->point);
                        
                        $this->Game_model->game_update($game_id , $game_lost , $this->point);
                       
                        // Game level ---------------------
                        $game_step += 1;
                        $this->session->set_userdata('game_step', $game_step );

                        // Select question ---------------------
                        $ques_id = $this->question_select($game_step , $game_data['game_qlist'],$game_lost);

                        if($ques_id == 0 ){
                            $this->session->set_userdata('game_step', $game_step - 1 );

                            // Calculate point ---------------------
                            $aa = $this->session->userdata('game_step');
                            $this->point = $this->game_step_point($aa , $game_lost);
                            $point = $this->point;
                           
                            $this->session->set_userdata('point' ,$point);
                            $this->Game_model->game_update($game_id , $game_lost , $this->point);                        

                            echo json_encode(array(
                                'playstate' => false,
                                'cheak_ans' => $check_answer,
                                'user_ans'  => $user_ans,
                                'ques_id'   => $ques_id,
                                'point'     => $point,
                                'award'     => '',
                                'question'  => '$ques_data',
                                'game_step' => $game_step,
                                'game_lost' => $game_lost,
                                'finish'    => true
                            )); 

                        }else{


                            $ques_data    = $this->Ques_model->get_ques_front($ques_id);
                            $player_state = $this->session->userdata();
                            
                            echo json_encode(array(
                                'user'      => $player_state,
                                'playstate' => true,
                                'cheak_ans' => $check_answer,
                                'user_ans'  => $user_ans,
                                'ques_id'   => $ques_id,
                                'point'     => $point,
                                'award'     => $award,
                                'question'  => $ques_data,
                                'game_step' => $game_step,
                                'game_lost' => $game_lost,
                                'finish'    => false
                            ));
                        }                          
                //cheack answer -->false
                }else{
                          
                    if($game_lost >= 2){

                        $this->session->set_userdata('game_step', $game_step - 1 );

                        // Calculate point ---------------------
                        $aa = $this->session->userdata('game_step');
                        $this->point = $this->game_step_point($aa , $game_lost);
                        $point = $this->point;
                       
                        $this->session->set_userdata('point' ,$point);
                        $this->Game_model->game_update($game_id , $game_lost , $this->point);                        

                        echo json_encode(array(
                            'playstate' => false,
                            'cheak_ans' => $check_answer,
                            'user_ans'  => $user_ans,
                            'ques_id'   => $ques_id,
                            'point'     => $point,
                            'award'     => '',
                            'question'  => '$ques_data',
                            'game_step' => $game_step,
                            'game_lost' => $game_lost,
                            'finish'    => true
                        ));   

                    }else{

                        $game_lost = $game_lost + 1;
                        $this->session->set_userdata('game_lost', $game_lost );
                            
                        // Calculate point ---------------------
                        $this->point   = $this->game_step_point($game_step , $game_lost);
                            
                        $point = $this->point;
                        $award = $this->game_award($this->point);

                        $this->Game_model->game_update($game_id , $game_lost , $point);

                        // Game level ---------------------
                        $game_step += 1;
                        $this->session->set_userdata('game_step', $game_step );

                        // Select question ---------------------
                        $ques_id = $this->question_select($game_step , $game_data['game_qlist'],$game_lost);

                        if($ques_id == 0){
                            $this->session->set_userdata('game_step', $game_step - 1 );

                            // Calculate point ---------------------
                            $aa = $this->session->userdata('game_step');
                            $this->point = $this->game_step_point($aa , $game_lost);
                            $point = $this->point;
                           
                            $this->session->set_userdata('point' ,$point);
                            $this->Game_model->game_update($game_id , $game_lost , $this->point);                        

                            echo json_encode(array(
                                'playstate' => false,
                                'cheak_ans' => $check_answer,
                                'user_ans'  => $user_ans,
                                'ques_id'   => $ques_id,
                                'point'     => $point,
                                'award'     => '',
                                'question'  => '$ques_data',
                                'game_step' => $game_step,
                                'game_lost' => $game_lost,
                                'finish'    => true
                            ));   
                        }else{   

                            $ques_data    = $this->Ques_model->get_ques_front($ques_id);
                            $player_state = $this->session->userdata();
                                    
                            echo json_encode(array(
                                'user'      => $player_state,
                                'playstate' => false,
                                'cheak_ans' => $check_answer,
                                'user_ans'  => $user_ans,
                                'ques_id'   => $ques_id,
                                'point'     => $point,
                                'award'     => $award,
                                'question'  => $ques_data,
                                'game_step' => $game_step,
                                'game_lost' => $game_lost,
                                'finish'    => false
                            ));
                        } 
                    }                   
                }
            //finish game 
            }else{
                $this->session->set_userdata('game_step', $game_step - 1 );

                // // Calculate point ---------------------
                $aa = $this->session->userdata('game_step');
                $this->point = $this->game_step_point($aa , $game_lost);
                $point = $this->point;
                           
                $this->session->set_userdata('point' ,$point);
                $this->Game_model->game_update($game_id , $game_lost , $this->point);                        

                echo json_encode(array(
                    'playstate' => false,
                    'cheak_ans' => $check_answer,
                    'user_ans'  => $user_ans,
                    'ques_id'   => $ques_id,
                    'point'     => $point,
                    'award'     => '',
                    'question'  => '$ques_data',
                    'game_step' => $game_step,
                    'game_lost' => $game_lost,
                    'finish'    => true
                ));   
            }             
	    }elseif($game_step == 0){

			$ques_id = $this->question_select($game_step , $game_data['game_qlist'],0);

			$data['title'] = 'بازی';
			$data['game_id']   = $game_id;
            $data['ques_data'] = $this->Ques_model->get_ques_front($ques_id);
            $data['ques_id']   = $ques_id;
            $data['user_ans']  = 'NOT Defined';
            $data['point']     = $this->game_award(0);
            $data['game_lost'] = 0;
                
            $this->session->set_userdata('game_step', 1 );

            $data['player_state'] = $this->session->userdata();

            $this->load->view('front/templates/header' , $data);
            $this->load->view('front/game-one' , $data);
            $this->load->view('front/templates/footer');
	    }else{

            $this->session->set_userdata('game_step', $game_step - 1 );
            // // Calculate point ---------------------
            $aa = $this->session->userdata('game_step');
            $this->point = $this->game_step_point($aa , $game_lost);
            $point = $this->point;
                           
            $this->session->set_userdata('point' ,$point);
            $this->Game_model->game_update($game_id , $game_lost , $this->point);
   
            $this->game_finish();    
        }        
    } 
    public function time_finish(){
        $this->load->model('Award_model');
        
        // Calculate point ---------------------
        $aa = $this->session->userdata('game_step') - 1;
        $game_lost = $this->session->userdata('game_lost');
        $point =  $this->game_step_point($aa , $game_lost);
       
        $this->Game_model->game_update($game_id , $game_lost , $point);                        

        $game_data = $this->session->userdata();
        $data['game_data'] = $game_data;
        $award_id = $this->game_award($game_data['point']);
        $data['aaaa'] = $award_id;
        if($award_id == 3){

            $data['award'] = $this->Award_model->get_award_disc_finish($award_id);
            $this->Award_model->update_disc($data['award']['discont_id'], $game_data['player_id']);

        }else{
            $data['award'] = $this->Award_model->get_award_finish($award_id); 
        }
        $this->Award_model->update_game_award($game_data['game_id'] , $award_id);
        //$this->Player_model->update_player($game_data['player_id'] , 1 );

        $data['title'] = 'اتمام بازی';
        
        $this->session->sess_destroy();

        $this->load->view('front/templates/header',$data);
        $this->load->view('front/finish',$data);
        $this->load->view('front/templates/footer');
    }
    public function game_finish(){
        $this->load->model('Award_model');
        $game_data = $this->session->userdata();
        $data['game_data'] = $game_data;
        $award_id = $this->game_award($game_data['point']);
        $data['aaaa'] = $award_id;
        if($award_id == 3){

            $data['award'] = $this->Award_model->get_award_disc_finish($award_id);
            $this->Award_model->update_disc($data['award']['discont_id'], $game_data['player_id']);

        }else{
            $data['award'] = $this->Award_model->get_award_finish($award_id); 
        }
        $this->Award_model->update_game_award($game_data['game_id'] , $award_id);
        //$this->Player_model->update_player($game_data['player_id'] , 1 );

        $data['title'] = 'اتمام بازی';
        
        $this->session->sess_destroy();

        $this->load->view('front/templates/header',$data);
        $this->load->view('front/finish',$data);
        $this->load->view('front/templates/footer');
    }

    public function create_catchaa(){
        //$original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
        $original_string = array_merge(range(0,9));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 4);
            // Captcha configuration
        $config = array(
                'word'        => $captcha,
                'img_path'    => 'captcha_images/',
                'img_url'     => base_url().'captcha_images/',
                'img_width'   => '150',
                'img_height'  => 45,
                'word_length' => 4,
                'font_size'   => 50,
                'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                )
        );
        $cap  = create_captcha($config); 
        //$this->session->set_userdata($cap);
        $this->session->set_userdata(array('captcha'=>$captcha, 'image' => $cap['time'].'.jpg'));
        if(file_exists(base_url()."captcha_images/".$this->session->userdata['image'])){
            unlink(base_url()."captcha_images/".$this->session->userdata['image']);
        }
       
        return $cap['image'];
    }
    public function caprefreshajax(){
        $cap = $this->caprefresh();
        
        if($cap){
            echo json_encode(array(
                'capstate'=> true,
                'capdata' => $cap,
            ));
        }else{
            echo json_encode(array(
                'capstate'=> false,
                'capdata' => '',
            ));
        }

    }
    public function caprefresh(){
        $this->load->helper('captcha');
        $original_string = array_merge(range(0,9));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 4);
        // Captcha configuration
        $config = array(
            'word'        => $captcha,
            'img_path'    => 'captcha_images/',
            'img_url'     => base_url().'captcha_images/',
            'img_width'   => '150',
            'img_height'  => 45,
            'word_length' => 4,
            'font_size'   => 16,
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
                    )
        );
        $cap  = create_captcha($config); 
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captcha');
        $this->session->unset_userdata('image');
        //$this->session->set_userdata($cap);
        $this->session->set_userdata(array('captcha'=>$captcha, 'image' => $cap['time'].'.jpg'));
        
        // Display captcha image
        return $cap['image'];
    }
    public function validate_captcha(){
        if($this->input->post('captcha') != $this->session->userdata['captcha']){
            $this->form_validation->set_message('validate_captcha', 'کد امنیتی درست وارد نشده است.');
            return false;
        }else{
            return true;
        }
    }
    
    public function confirm_code(){
        // $this->load->model('Player_model');

        // $player_id   = $this->session->userdata('player_id');
        // $player_code = $this->Player_model->get_player_code($player_id);

        // if($this->input->post('confirm_code') != $player_code['player_code'] ){
        //     $this->form_validation->set_message('confirm_code', 'کد تایید نادرست است.');
        //     return false;
        // }else{
        //     return true;
        // }
        return true;
    }

    public function send_messege($player_mob){
        $this->load->model('Player_model');

        
        
        $msg_string = array_merge(range(0,9));
        $msg_string = implode("", $msg_string);
        $msg = substr(str_shuffle($msg_string), 0, 4);

        $this->Player_model->update_player_code($player_mob,$msg);

        $num = $player_mob;
        $url = 'http://bornarabin.com/msg/index.php?code='.$msg.'&num='. $num ;
        $result = file_get_contents($url);
        return true;  
        

    }
    //Time checking in each answer and valid game id
    private function check_game_expiration($game_id , $time){
        $remain = 240 - $time;
        $game_data = $this->Game_model->get_game($game_id);
        $game_stime = $this->session->userdata('game_stime');
        $now_diff = now() - $game_data['game_stime'];
        if( $now_diff < 240 && $now_diff - $remain < 10 ){
            return true;
        }else{
            return false;
        }
    }
   
    private function game_award($point){
        if( $point < 4){
            return 1;
        }elseif($point >= 4 && $point < 8 ){
            return 2;
        }elseif($point >= 8 && $point < 12 ){
            return 3;
        }elseif($point >= 12 && $point < 16 ){
            return 4;
        }elseif($point >= 16 && $point < 20 ){
            return 5;
        }elseif ($point == 20) {
            return 6;
        }
    }
    private function game_step_point($game_step , $game_lost){
        return $game_step - $game_lost;
    }
    
    private function quesid_putopr($ques_id_pu){
        
        return $ques_id_pu;
    }
    private function quesid_prtopu($ques_id_pr){
        
        return $ques_id_pr;
    }
    private function game_lost_num($game_id){
    }
    //Check the answer Other Function
    private function check_answer($ques_id ,$user_ans){
        $ques_ans = $this->Ques_model->get_ques_answer($ques_id);

        if($ques_ans['c_ans'] == $user_ans){
            return true;    
        }else{
            $this->form_validation->set_message('check_answer', 'Wrong Answer');
            return false;
    
        }     
    }
    //Select question according to the game level
    private function question_select($game_step,$game_qlist,$game_lost){

        $game_ques_list = $this->Game_model->get_qlist($game_qlist);
        $gids = unserialize($game_ques_list['qlist_qids']) ;
        if($game_lost == 0 && $game_step == 21){
            return 0;
        }elseif($game_lost == 1 && $game_step == 22){
            return 0;
        }elseif($game_lost == 2 && $game_step == 23){
            return 0;
        }else{
            return $gids[$game_step];  
        }
        
        
    }
    //limit for player --- find duplicate player
    private function player_limit_dup($player_mob){
        $player_duplicate = $this->Player_model->player_duplicate($player_mob);
        if(!$player_duplicate){
            return false;
        }else{
            return $player_duplicate;
        }   
    }
    //limit for player --- calculating rest time
    private function player_limit_rest($player_duplicate){
        $game_rest = $this->Game_model->game_rest($player_duplicate);
        return $game_rest;
        if($game_rest){
            return true;
        }else{
            return false;
        }
    } 

}