<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_NewsModel extends CI_Model
{
  	public function __construct()
        {
                parent::__construct();
        } 
	
	private $News = 's_news';
	public function get_all_news()
	{	
		$this->db->from($this->News);
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
		if($query->num_rows() > 0){
			$result = $query->result();
			return $result;
		}else{
			return  array();
		}
	}

	public function add_news($params)
	{  
 		$res = $this->db->insert($this->News, $params); 
		if($res == 1)
			return true;
		else
			return false;
 	}
 	
 	public function get_news_by_id($id) 
	{  
 		$this->db->select('*');
		$this->db->from($this->News);
		$this->db->where("id",$id);
		$this->db->limit(1);
  		$query = $this->db->get();
 		if ($query) {
			 return $query->row_array();
		 } else {
			 return  array();
		 }
   	}

	public function update_news_by_id($id,$params)
	{
		$res = $this->db->update($this->News, $params ,['id' => $id ] ); 
		if($res == 1)
			return true;
		
			return false;
	}

}
