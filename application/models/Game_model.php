<?php
class Game_model extends CI_Model {
    public function __construct(){
        
        $this->load->database();

    }
	public function create_game($player_id,$game_qlist){
        $this->load->helper('string');
        $game_token = random_string('alnum', 16);

        $servertime = now();
        $gmtime = local_to_gmt($servertime);

	    $game_db_data = array(
            'player_id'  => $player_id,
            'game_qlist' => $game_qlist,
            'game_token' => $game_token,
            'game_stime' => $gmtime,
            'award_id'   => '1',
            'game_lost'  => '0',
            'game_point' => '0'
	    );
        $game_insert = $this->db->insert('game', $game_db_data);
        if($game_insert){

            $game_id = $this->db->insert_id();
            $game_session_arg = array('game_id'=>$game_id,'game_step'=>0,'game_lost'=>0,'game_token'=>$game_token);
            $this->session->set_userdata($game_session_arg);
            return $game_id;

	    }else{
            return false;
        }
    }
    public function get_game($game_id){
        $query = $this->db->get_where('game', array('game_id' => $game_id));
        return $query->row_array();
    }
	public function get_game_list(){
        $sql = "SELECT * FROM game";
        $query = $this->db->query($sql);
        $datestring = '%Y - %m - %d - %h:%i %a';
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $gmtime = $row->game_stime;
                $mytime = gmt_to_local( $gmtime ,'UP35', false);


                $game_list[$i]['game_id']    = $row->game_id;
                $game_list[$i]['player_id']  = $row->player_id;                
                $game_list[$i]['game_token'] = $row->game_token; 
                $game_list[$i]['game_stime'] = mdate($datestring, $mytime);
                if($row->award_id == 3){
                    $game_list[$i]['award_id']   =  $row->award_id.'/'.$row->player_id;
                }else{
                    $game_list[$i]['award_id']   = $row->award_id;
                }
                $i++;
            }
            return $game_list;
        }else{
            return false;
        }
    }
    public function get_player_game_list($player_id){

        $query = $this->db->get_where('game', array('player_id' => $player_id));
        $datestring = '%Y - %m - %d - %h:%i %a';


        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $gmtime = $row->game_stime;
                $mytime = gmt_to_local( $gmtime ,'UP35', false);
                
                $uplayer_list[$i]['game_stime'] = mdate($datestring, $mytime);    
                $uplayer_list[$i]['award_id']   = $row->award_id.'/'.$row->player_id;    

                $i++;
            }
            return $uplayer_list;
        }else{
            return false;
        }
    }


    public function game_rest($player_id){
        $this->db->select()->order_by('game_id','desc');
        $this->db->where( 'player_id' , $player_id);
        $query = $this->db->get('game');
        if($query->num_rows() > 0){
            $row = $query->first_row();
            $uplay_list['game_id']    = $row->game_id;
            $uplay_list['game_token'] = $row->game_token;  
            $uplay_list['game_stime'] = $row->game_stime;
            
            $time = $uplay_list['game_stime'];
            $now_time = now();
            $gtmnow_time = local_to_gmt($now_time);

            $rest = 60 * 60 * 24;
            //$rest = 60 ;

            if($gtmnow_time - $time > $rest ){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
    public function game_update($game_id , $game_lost , $point){
        $game_db_data = array(
            'game_point'  => $point,
            'game_lost'   => $game_lost,
        );
        $this->db->where('game_id' , $game_id);
        $this->db->update('game', $game_db_data);
    }
    public function create_qlist(){
        $qlist = array();
        for ($level=1; $level < 6 ; $level++) { 
            if($level == 5 ){
                $level_qdata = $this->level_qs($level);

                $bbb = $level_qdata[$level];

                $max = count($level_qdata);
                $q = $this->randomGen(0,$max,7);

                array_push($qlist,$level_qdata[$q[0]]['ques_id'],$level_qdata[$q[1]]['ques_id'],$level_qdata[$q[2]]['ques_id'],$level_qdata[$q[3]]['ques_id'],$level_qdata[$q[4]]['ques_id'],$level_qdata[$q[5]]['ques_id'],$level_qdata[$q[6]]['ques_id']);
            }else{
                $level_qdata = $this->level_qs($level);

                $bbb = $level_qdata[$level];

                $max = count($level_qdata);
                $q = $this->randomGen(0,$max,4);

                array_push($qlist,$level_qdata[$q[0]]['ques_id'],$level_qdata[$q[1]]['ques_id'],$level_qdata[$q[2]]['ques_id'],$level_qdata[$q[3]]['ques_id']);
            }
        }

        //return $qlist;

        //$qlist_string = json_encode($qlist);
        $qlist_string = serialize($qlist);
        $servertimes = now();
        $gmtimes = local_to_gmt($servertimes);

        $qlist_db_data = array(
            'qlist_time' => $gmtimes,
            'qlist_qids' => $qlist_string  
        );
        $qlist_insert = $this->db->insert('qlist', $qlist_db_data);
        if($qlist_insert){
            $qlist_id = $this->db->insert_id();
            return $qlist_id;
        }else{
            return false;
        }
    }
    public function get_qlist($qlist_id){
        $query = $this->db->get_where('qlist', array('qlist_id' => $qlist_id));
        return $query->row_array();
    }
    public function level_qs($qlevel){
        $query = $this->db->get_where('questions', array('ques_level' => $qlevel));
        
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row){
                $level_qlist[$i]['ques_id'] = $row->ques_id;
                $i++;
            }
            return $level_qlist;
        }else{
            return false;
        }     
    }
    public function randomGen($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }




    public function record_count() {
        return $this->db->count_all("game");
    }

    public function fetch_countries($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("game");
         $datestring = '%Y - %m - %d - %h:%i %a';

        if ($query->num_rows() > 0) {
             $i=0;
            foreach ($query->result() as $row) {
                $gmtime = $row->game_stime;
                $mytime = gmt_to_local( $gmtime ,'UP35', false);


                $game_list[$i]['game_id']    = $row->game_id;
                $game_list[$i]['player_id']  = $row->player_id;                
                $game_list[$i]['game_token'] = $row->game_token; 
                $game_list[$i]['game_stime'] = mdate($datestring, $mytime);
                if($row->award_id == 3){
                    $game_list[$i]['award_id']   =  $row->award_id.'/'.$row->player_id;
                }else{
                    $game_list[$i]['award_id']   = $row->award_id;
                }
                $i++;
            }
            return $game_list;
        }
        return false;
   }

}