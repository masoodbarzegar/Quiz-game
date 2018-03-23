<?php
class Users_model extends CI_Model {
    public function __construct(){
     
        $this->load->database();
    }
    public function get_user($user_field,$user_value){
    	//$this->db->select('id' , 'email' , 'username');
	    $query = $this->db->get_where('users' , array($user_field =>  $user_value ) );
	    
	    if ($query->num_rows() > 0) {
            $row = $query->row_array();
	        $user_data['id'] = $row['id'];
            $user_data['username'] =$row['username'];
            $user_data['disname'] =$row['disname'];
            $user_data['email'] = $row['email'];
            $user_data['role'] = $row['role'];
            return $user_data;
	    }else{
	        return false;
	    }
    }
    public function get_user_2($user_value){
        //$this->db->select('id' , 'email' , 'username');
        $query = $this->db->get_where('users' , array('id' =>  $user_value ) );
        
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $user_data['id'] = $row['id'];
            $user_data['username'] =$row['username'];
            $user_data['disname'] =$row['disname'];
            $user_data['email'] = $row['email'];
            return $user_data;
        }else{
            return false;
        }
    }
    public function get_user_list(){
        //$this->db->select('id' , 'email' , 'username');
        //$query = $this->db->get('users' ); 
        $sql = "SELECT * FROM users ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row)
            {
                    $user_list[$i]['id'] = $row->id;
                    $user_list[$i]['username'] = $row->username;
                    $user_list[$i]['email'] = $row->email;
                    $user_list[$i]['role'] = $row->role;
                $i++;
            }
            return $user_list;
        }else{
            return false;
        }
    }
    public function update_user(){
        $old_user_data = $this->get_user_all2('id',$this->input->post('id'));

        if( $this->input->post('password') == '' ){
            
            $password = $old_user_data['password'];
            $salt     = $old_user_data['salt'];
               
        }else{
            //$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $salt     = $old_user_data['salt'];
            $password = hash('sha256', $this->input->post('password') . $salt);
            /*for($round = 0; $round < 65536; $round++) { 
                    $password = hash('sha256', $password . $salt); 
            }*/
        }

        $data = array(
            'username' => $this->input->post('username'),
            'disname'  => $this->input->post('disname'),
            'password' => $password,
            'salt'     => $salt,
            'email'    => $this->input->post('email'),
            'admin'    => $this->input->post('admin'),
            'role'     => $this->input->post('role')
        );

        $this->db->where('id' , $this->input->post('id')); 
        return $this->db->update('users', $data);      
    }
    public function update_user_front(){
        $old_user_data = $this->get_user_all2('id',$this->input->post('id'));

        if( $this->input->post('password') == '' ){
            
            $password = $old_user_data['password'];
            $salt     = $old_user_data['salt'];
               
        }else{
            //$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $salt     = $old_user_data['salt'];
            $password = hash('sha256', $this->input->post('password') . $salt);
            /*for($round = 0; $round < 65536; $round++) { 
                    $password = hash('sha256', $password . $salt); 
            }*/
        }
        $data = array(
            'username' => $this->input->post('username'),
            'disname'  => $this->input->post('disname'),
            'password' => $password,
            'salt'     => $salt,
            'email'    => $this->input->post('email'),
        );

        $this->db->where('id' , $this->input->post('id')); 
        return $this->db->update('users', $data);      
    }
    public function set_user(){
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $this->input->post('password') . $salt);
        /*for($round = 0; $round < 65536; $round++) { 
                $password = hash('sha256', $password . $salt); 
        } */
        $data = array(
            'username' => $this->input->post('username'),
            'disname'  => $this->input->post('disname'),
            'password' => $password,
            'salt'     => $salt,
            'email'    => $this->input->post('email'),
            'admin'    => 0,
            'role'     => 0
        );
        $this->db->insert('users', $data);
    }
    
    public function get_user_all($user_field){
        //$this->db->select('id' , 'email' , 'username');
        $user_value = $this->input->post('username');
        $query = $this->db->get_where('users' , array($user_field =>  $user_value ) ); 
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }
    public function get_user_all2($user_field , $user_value){
        //$this->db->select('id' , 'email' , 'username');
        $query = $this->db->get_where('users' , array($user_field =>  $user_value ) ); 
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return false;
        }
    }
    public function user_exist($user_field){
    	$user_value = $this->input->post($user_field);
        $this->db->select('id');
	    $this->db->where($user_field , $user_value);
	    $query = $this->db->get('users');

	    if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
    public function user_exist2($user_field){
        $user_value = $this->input->post($user_field);
        $user_id = $this->input->post('id');
        $user_data = $this->get_user('id',$user_id);
        if($user_data[$user_field] == $user_value ){
            return false;
        }else{
            $this->db->select('id');
            $this->db->where($user_field , $user_value);
            $query = $this->db->get('users');

            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
	public function user_state(){
        $user_state = $this->session->userdata();
        if(isset($user_state['logged_user'])){
            return $user_state;
        }else{
            return false;
        }  
    }
    public function check_logged(){
		return ($this->session->userdata('logged_user'))?TRUE:FALSE;
	}
	public function logged_id(){
		return ($this->check_logged())?$this->session->userdata('logged_user'):'';
	}
}