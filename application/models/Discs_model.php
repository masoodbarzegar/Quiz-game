<?php
class Discs_model extends CI_Model {
    public function __construct(){
        $this->load->database();

    }
	public function create_disc(){
	    $disc_db_data = array(
            'discont_code'  => $this->input->post('discont_code'),
            'award_id'      => $this->input->post('award_text'),
            'discont_state' => '',
            'discont_utime' => ''         
	    );
        $disc_id = $this->db->insert('discounts', $disc_db_data);
	}
    public function get_disc($disc_id){
        $query = $this->db->get_where('discounts', array('discont_id' => $disc_id));
        return $query->row_array();
    }
    public function get_player_disc($player_id){
        $query = $this->db->get_where('discounts', array('player_id' => $player_id));
        $datestring = '%Y - %m - %d - %h:%i %a';

        //return $query->row_array();
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $gmtime = $row->discont_utime;
                $mytime = gmt_to_local( $gmtime ,'UP35', false);

                $player_disc_list[$i]['discont_id']    = $row->discont_id;
                
                $player_disc_list[$i]['award_id']      = $row->award_id;
                $player_disc_list[$i]['discont_code']  = $row->discont_code;                
                $player_disc_list[$i]['discont_state'] = $row->discont_state;
                $player_disc_list[$i]['discont_utime'] = mdate($datestring, $mytime);
                $player_disc_list[$i]['player_id']     = $row->player_id;
                $i++;
            }
            return $player_disc_list;
        }else{
            return false;
        }
    }
	public function get_disc_list(){
        //$sql = "SELECT * FROM  discounts";
        $sql = "SELECT 
                        discounts.discont_id,discounts.award_id,discounts.discont_code,discounts.discont_state,discounts.discont_utime,awards.award_text
                    FROM 
                        discounts
                    INNER JOIN 
                        awards 
                    ON
                    discounts.award_id=awards.award_id ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $disc_list[$i]['discont_id']    = $row->discont_id;
                $disc_list[$i]['award_id']      = $row->award_id;
                $disc_list[$i]['award_text']    = $row->award_text;                
                $disc_list[$i]['discont_code']  = $row->discont_code;
                $disc_list[$i]['discont_state'] = $row->discont_state;
                $disc_list[$i]['discont_utime'] = $row->discont_utime;                
                $i++;
            }
            return $disc_list;
        }else{
            return false;
        }
    }
    public function update_disc($disc_id){

        $query = $this->db->get_where('discounts', array('discont_id' => $disc_id));
        $disc_edite = $query->row_array();
        
        $disc_db_data = array(
            'discont_code'  => $this->input->post('discont_code'),
            'award_id'      => $this->input->post('award_text'),
            'discont_state' => '',
            'discont_utime' => ''   
        );

        $this->db->where('discont_id' , $disc_id);
        $this->db->update('discounts', $disc_db_data);
    }
    
}