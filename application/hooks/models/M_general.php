<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_general extends CI_Model {

    public function __construct() {
        parent::__construct();
         // Load the database library
        $this->load->database();
    }

    function getRows($sql,$params=false){
        $query = $this->db->query($sql,$params);
        if($query->num_rows() > 0){
            $result = $query->result_array();
            return $result;
        }else{
            return false;
        }
    }

    function getRow($sql,$params=false){
        $query = $this->db->query($sql,$params);
        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result;
        }else{
            return false;
        }
    }

    function insertRow($table, $data){
        $this->db->insert($table, $data);
        return  $this->db->insert_id();
    }

    function updateRow($table,$data,$where=false){
        if($where){
            foreach($where as $k=>$v){
                $this->db->where($k,$v);
            }
        }
        $this->db->update($table,$data);
        return $this->db->affected_rows();
    }

    function deleteRows($table,$where=false){
        if($where){
            foreach($where as $k=>$v){
                $this->db->where($k,$v);
            }
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    function count($table,$params=array()){
        $this->db->select("*");
        $this->db->from($table);
        foreach($params as $k=>$v){
            $this->db->where($k,$v);
        }
        $query=$this->db->get();

        return $query->num_rows();
    }

    function getSetting($key){

        $this->db->select("s_val");
        $this->db->from("s_settings");
        $this->db->where("s_key",$key);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->row_array();
            return $result['s_val'];
        }else{
            return false;
        }
    }

    function setSetting($key,$val)
    {
        $sql = "UPDATE sc_settings SET
                            `s_val`=?
                            WHERE `s_key`=?";
        $this->db->query($sql,array($key,$val));
        return $this->db->affected_rows();
    }

}