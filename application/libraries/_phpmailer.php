<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class _phpmailer
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function _load(){
        // Include PHPMailer library files
       include("email/class.phpmailer.php");
    }

}