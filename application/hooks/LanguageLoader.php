<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LanguageLoader {
   function initialize() {
       $ci =& get_instance();
       $ci->load->helper('language');
       $siteLang = $ci->session->userdata('site_lang');
       if ($siteLang) {
           $ci->lang->load('default/form_validation',$siteLang); 
           $ci->lang->load('sidebar',$siteLang);
           $ci->lang->load('common',$siteLang); 
       } else {
           $ci->lang->load('default/form_validation','english'); 
           $ci->lang->load('sidebar','english');
           $ci->lang->load('common','english'); 
       }
   }
}