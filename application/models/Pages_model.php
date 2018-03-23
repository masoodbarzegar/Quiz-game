<?php
class Pages_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }
    public function get_page($id){
        $query = $this->db->get_where('pages', array('id' => $id));
        return $query->row_array();
	}
    public function get_pmeta($page_id , $meta_field){
        $query = $this->db->get_where('pages_meta', array('page_id' => $page_id));
        $p_metas = $query->result_array();
        //return $p_metas;
        foreach ($p_metas as $key => $p_meta) {
            if($p_meta['pmeta_key'] == $meta_field){
                $a = $p_meta['pmeta_value'];
            }
        }
        return $a;
    }
	public function create_page(){
	    $slug = url_title($this->input->post('page_title'), 'dash', TRUE);
        $template = $this->input->post('page_template');
	    $page_db_data = array(
	        'page_title'  => $this->input->post('page_title'),
	        'page_slug'   => $slug,
            'page_template' => $template,
            'page_content'   => $this->input->post('page_content'),
            'page_element'   => '',
	        'page_date'   => date('Y-m-d H:i:s'),
            'page_date_c' => '',
            'author_id'   => '1' 
	    );
	    $this->db->insert('pages', $page_db_data);
        $page_id = $this->db->insert_id();
        
        $page_desc = array(
            'page_id' => $page_id,
            'pmeta_key' => 'page_desc',
            'pmeta_value' => $this->input->post('page_desc')
        );
        $this->db->insert('pages_meta',  $page_desc );

        if($template != "index"){
            $a = serialize($_POST['page_setting']);
            $meta = array(
                'page_id' => $page_id,
                'pmeta_key' => 'page_setting',
                'pmeta_value' => $a     
            );
            $this->db->insert('pages_meta',  $meta );
        }
	}
    public function update_page($id){

        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $query = $this->db->get_where('pages', array('id' => $id));
        $page_edite = $query->row_array();
        $template = $this->input->post('page_template');

        $page_db_data = array(
            'page_title'  => $this->input->post('page_title'),
            'page_slug'   => $slug,
            'page_template' => $template,
            'page_content'   => $this->input->post('page_content'),
            'page_element'   => '',
            'page_date'   => $page_edite['page_date'],
            'page_date_c' => '',
            'author_id'   => '1' 
        );
        $this->db->where('id' , $id);
        $this->db->update('pages', $page_db_data);

        if($template != "index"){
            $a = serialize($_POST['page_setting']);
            $meta = array(
                'page_id' => $id,
                'pmeta_key' => 'page_setting',
                'pmeta_value' => $a     
            );
            $this->db->where(array('page_id' => $id , 'pmeta_key' => 'page_setting'));
            $this->db->update('pages_meta',  $meta );
        }
        $page_desc = array(
            'page_id' => $id,
            'pmeta_key' => 'page_desc',
            'pmeta_value' => $this->input->post('page_desc')
        );
            $this->db->where(array('page_id' => $id , 'pmeta_key' => 'page_desc'));
            $this->db->update('pages_meta',  $page_desc );
    }
	public function get_pages_list(){
        $sql = "SELECT * FROM pages ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result() as $row)
            {
                    $page_list[$i]['id']    = $row->id;
                    $page_list[$i]['title'] = $row->page_title;
                    $page_list[$i]['slug']  = $row->page_slug;
                    $page_list[$i]['text']  = $row->page_content;
                $i++;
            }
            return $page_list;
        }else{
            return false;
        }
    }
}