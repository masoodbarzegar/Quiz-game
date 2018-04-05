<?php
class Award_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }
	public function create_award(){
	    $award_db_data = array(
            'award_text'  => $this->input->post('award_text'),            
	    );
        $award_id = $this->db->insert('awards', $award_db_data);
	}
    public function get_award($award_id){
        $query = $this->db->get_where('awards', array('award_id' => $award_id));
        return $query->row_array();
    }

    public function get_award_finish($award_id){
        $sql = "SELECT 
                        awards.award_id, awards.award_text , discounts.discont_code
                    FROM 
                        awards
                    JOIN 
                        discounts 
                    ON
                     awards.award_id = discounts.award_id 
                    WHERE 
                        awards.award_id = '$award_id'
                    ";


        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){
                    $awards['award_id']     = $row->award_id;
                    $awards['award_text']   = $row->award_text;
                    $awards['discont_code'] = $row->discont_code;
                   
            }
            return $awards;

        }else{
            return false;
        }

    }
    public function get_award_disc_finish($award_id){
        $query = $this->db->get_where('discounts', array('award_id' => $award_id , 'discont_state' => 0 ));
       
        if ($query->num_rows() > 0) {
            $row = $query->first_row();

            $code['award_id'] = 3;
            $code['award_text'] = '70 هزار تومان هدیه ثبت نام رایگان در دوره یکساله با کد';
            $code['discont_id'] = $row->discont_id;
            $code['discont_code'] = $row->discont_code;
            
            return $code;
        }else{
            return false;
        }

    }
    

	public function get_award_list(){
        $sql = "SELECT * FROM  awards";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $award_list[$i]['award_id']     = $row->award_id;
                $award_list[$i]['award_text']   = $row->award_text;
                $i++;
            }
            return $award_list;
        }else{
            return false;
        }
    }
    public function dropdown_award_list(){
        $sql = "SELECT * FROM  awards";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){
                $form_award_list[$row->award_id] = $row->award_text;
            }
            return $form_award_list;
        }else{
            return false;
        }
    }
    public function update_award($award_id){

        $query = $this->db->get_where('awards', array('award_id' => $award_id));
        $award_edite = $query->row_array();
        
        $award_db_data = array(
            'award_text'  => $this->input->post('award_text'), 
        );

        $this->db->where('award_id' , $award_id);
        $this->db->update('awards', $award_db_data);
    }
    public function update_game_award($game_id , $award_id){
        $query = $this->db->get_where('game', array('game_id' => $game_id));
        $game_edite = $query->row_array();
        
        $game_db_data = array(
            'award_id'  => $award_id, 
        );

        $this->db->where('game_id' , $game_id);
        $this->db->update('game', $game_db_data);
    }
    public function update_disc($discont_id , $player_id){
        $query = $this->db->get_where('discounts', array('discont_id' => $discont_id));
        $disc_edite = $query->row_array();
        
        $servertime = now();
        $gmtime = local_to_gmt($servertime);

        $discont_data = array(
            'discont_state' => 1, 
            'discont_utime' => $gmtime,
            'player_id'     => $player_id
        );

        $this->db->where('discont_id' , $discont_id);
        $this->db->update('discounts', $discont_data);
    }
}