<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_general extends CI_Model {

    public function __construct() {
        parent::__construct();
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

    function getNameByIds($table, $id, $_ids){
        $this->db->select("GROUP_CONCAT(' ', name) name");
        $this->db->where_in($id,explode(',', $_ids));
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            $row = $query->row();
            return $row->name;
        } else {
            return '';
        }
    }

    //setting
    function getSetting($key){
        $this->db->select("val");
        $this->db->from('tbl_setting');
        $this->db->where("key",$key);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->row();
            return $result->val;
        }else{
            return false;
        }
    }

    function setSetting($key,$val){
        $this->db->where("key",$key);
        $this->db->update('tbl_setting',array("val"=>$val));
        return true;
    }

    //encrypt/decrypt
    function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'SmartCropSecretKeyForResetPasswordkey';
        $secret_iv = 'SmartCropSecretKeyForResetPasswordiv';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
//end

}