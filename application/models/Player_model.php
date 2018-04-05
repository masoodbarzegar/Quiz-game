<?php
class Player_model extends CI_Model {
    public function __construct(){
     
        $this->load->database();
    }
    public function set_player($player_mob,$player_email){
        
        $data = array(
            'player_state' => 0,
            'player_email' => $player_email,
            'player_mob'   => $player_mob,
            'player_code'  => ''
        );
        $this->db->insert('player', $data);
        return $this->db->insert_id();
    }

    public function get_bakend_player($player_id){
        $query = $this->db->get_where('player' , array('player_id' =>  $player_id ) );
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $player_data['player_id']    = $row['player_id'];
            $player_data['player_email'] = $row['player_email'];
            $player_data['player_mob']   = $row['player_mob'];
            
            return $player_data;
        }else{

            return false;
        }
    }
    public function get_front_player($player_id){
        $query = $this->db->get_where('player' , array('id' =>  $player_value ) );
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $player_data['player_id'] = $row['player_id'];
            
            return $player_data;
        }else{
            return false;
        }
    }
    public function get_player_data($player_field,$player_value){
	    $query = $this->db->get_where('player' , array($player_field =>  $player_value ) );
	    
	    if ($query->num_rows() > 0) {
            $row = $query->row_array();
	        $player_data['player_id'] = $row['player_id'];
            
            return $player_data;
	    }else{
	        return false;
	    }
    }
    public function get_player_code($player_id){
        $query = $this->db->get_where('player' , array('player_id' =>  $player_id ) );
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $player_data['player_code'] = $row['player_code'];
            
            return $player_data;
        }else{
            return false;
        }
    }
    public function get_player_mob($player_id){
        $query = $this->db->get_where('player' , array('player_id' =>  $player_id ) );
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $player_data['player_mob'] = $row['player_mob'];
            
            return $player_data;
        }else{
            return false;
        }
    }
    public function get_player_list(){
        $sql = "SELECT * FROM  player";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row)
            {
                
                $uplayer_list[$i]['palyer_mob']   = $row->player_mob;
                $uplayer_list[$i]['palyer_email'] = $row->player_email;
                $uplayer_list[$i]['player_id']    = $row->player_id;

                $i++;
            }
            return $uplayer_list;
        }else{
            return false;
        }
    }
    


    public function player_duplicate($player_mob){
       
        $this->db->select('player_id');
        $this->db->where( 'player_mob' , $player_mob);
        $query = $this->db->get('player');

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $player_id = $row['player_id'];
        } else {
            return false;
        }
    }
    public function player_limit($player_field = 'player_mob' ,$player_value){
	    if ($this->player_limit_function()) {
	        return true;
	    }else{
	        return false;
	    }
	}
	public function player_state(){
        $player_state = $this->session->userdata();
        if(isset($player_state['player_id'])){
            return $player_state;
        }else{
            return "false";
        }  
    }
    public function update_player($player_id , $state){

        $query = $this->db->get_where('player', array('player_id' => $player_id));
        $award_edite = $query->row_array();
        
        $player_db_data = array(
            'player_state'  => $state, 
        );

        $this->db->where('player_id' , $player_id);
        $this->db->update('player', $player_db_data);
    }
    public function update_player_code($player_mob , $code){

        $query = $this->db->get_where('player', array('player_mob' => $player_mob));
        $award_edite = $query->row_array();
        
        $playercode_db_data = array(
            'player_code'  => $code, 
        );

        $this->db->where('player_mob' , $player_mob);
        $this->db->update('player', $playercode_db_data);
    }
}