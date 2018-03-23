<?php
class Ques_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }
	public function create_ques(){
	    $ques_db_data = array(
            'ques_text'  => $this->input->post('ques_text'),
            'ques_ans1'  => $this->input->post('ques_ans1'),
            'ques_ans2'  => $this->input->post('ques_ans2'),
            'ques_ans3'  => $this->input->post('ques_ans3'),
            'ques_ans4'  => $this->input->post('ques_ans4'),
            'ques_level' => $this->input->post('ques_level'),
            'c_ans'      => $this->input->post('c_ans'),
	    );
        $ques_id = $this->db->insert('questions', $ques_db_data);
	}
    public function get_ques_front($ques_id){
        $query = $this->db->get_where('questions', array('ques_id' => $ques_id));
        $row = $query->row_array();
        //$sql = "SELECT * FROM  questions WHERE 'ques_id' = ". $ques_id;
        //$query = $this->db->query($sql);
            $ques_data['ques_id']    = $row['ques_id'];
            $ques_data['ques_text']  = $row['ques_text'];
            $ques_data['ques_ans1']  = $row['ques_ans1'];
            $ques_data['ques_ans2']  = $row['ques_ans2'];
            $ques_data['ques_ans3']  = $row['ques_ans3'];
            $ques_data['ques_ans4']  = $row['ques_ans4'];
            $ques_data['ques_level'] = $row['ques_level'];

        return $ques_data;
    }
    public function get_ques_back($ques_id){
        $query = $this->db->get_where('questions', array('ques_id' => $ques_id));
        $row = $query->row_array();
        //$sql = "SELECT * FROM  questions WHERE 'ques_id' = ". $ques_id;
        //$query = $this->db->query($sql);
            $ques_data['ques_id']    = $row['ques_id'];
            $ques_data['ques_text']  = $row['ques_text'];
            $ques_data['ques_ans1']  = $row['ques_ans1'];
            $ques_data['ques_ans2']  = $row['ques_ans2'];
            $ques_data['ques_ans3']  = $row['ques_ans3'];
            $ques_data['ques_ans4']  = $row['ques_ans4'];
            $ques_data['ques_level'] = $row['ques_level'];
            $ques_data['c_ans']      = $row['c_ans'];

        return $ques_data;
    }

    public function get_ques_answer($ques_id){
        $query = $this->db->get_where('questions', array('ques_id' => $ques_id));
        $row = $query->row_array();

        $ques_ans['ques_id']    = $row['ques_id'];
        $ques_ans['c_ans']    = $row['c_ans'];        
       
        return $ques_ans;
    }
	public function get_ques_list(){
        $sql = "SELECT * FROM  questions";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $ques_list[$i]['ques_text']  = $row->ques_text;
                $ques_list[$i]['ques_id']    = $row->ques_id;
                $i++;
            }
            return $ques_list;
        }else{
            return false;
        }
    }
    public function update_ques($ques_id){

        $query = $this->db->get_where('questions', array('ques_id' => $ques_id));
        $ques_edite = $query->row_array();
        
        $ques_db_data = array(
            'ques_text'  => $this->input->post('ques_text'),
            'ques_ans1'  => $this->input->post('ques_ans1'),
            'ques_ans2'  => $this->input->post('ques_ans2'),
            'ques_ans3'  => $this->input->post('ques_ans3'),
            'ques_ans4'  => $this->input->post('ques_ans4'),
            'ques_level' => $this->input->post('ques_level'),
            'c_ans'      => $this->input->post('c_ans'),
        );

        $this->db->where('ques_id' , $ques_id);
        $this->db->update('questions', $ques_db_data);
    }
    public function check_ans($ques_id){
        $query = $this->db->get_where('questions', array('ques_id' => $ques_id));
        $user_ans = $this->input->post('c_ans');
        return $row = $query->first_row();
        // if ( $user_ans == $row->'c_ans') {
        //     return true;
        // }else{
        //     return false;
        // }
        // if ($query->num_rows() > 0) {
        //     if ( $user_ans == $row->c_ans) {
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }else{
        //     return true;
        // }
    }
    
}