<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
    /**
     * Admin controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION)){
            session_start();
        }           
    }

    function isValidToken($table, $Authorization){
        $sql = "SELECT * FROM $table WHERE access_token = ? AND is_active = 1";
        $result = $this->m_general->getRow($sql,array($Authorization));
        return $result['access_token'];
    }

    function checkAuth($table){
        $Authorization = @$_SERVER['HTTP_AUTHORIZATION'];
        if(empty($Authorization)){
            $Authorization =  @$_SERVER['HTTP_AUTHORIZATIONA'];
        }
        if(!empty($Authorization)){
            $token = $this->isValidToken($table, $Authorization);
            if($Authorization == $token){
                return $Authorization;
            }else{
                $res = array(
                    'status' => FALSE,
                    'message' => 'You are not authorized to access api.'
                );
                echo json_encode($res);
                exit;
            }
        }else{
            $res = array(
                'status' => FALSE,
                'message' => 'You are not authorized to access api.'
            );
            echo json_encode($res);
            exit;
        }
    }

    // Function to generate OTP 
    function generateOTP() { 
        $n=6; 
 
        $generator = "1357902468"; 
      
        $result = ""; 
      
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
      
        // Return result 
        return $result; 
    } 

    function push_notification($fcm_ids, $fcmMsg){
    
        $fcm_api_key = $this->m_general->getSetting('fcm_api_key');

        $fcmFields = array(
            'registration_ids' => $fcm_ids,
            'priority' => 'high',
            'notification' => $fcmMsg
        );

        $headers = array(
            'Authorization: key=' . $fcm_api_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
        $result = curl_exec( $ch );
        curl_close( $ch );
        //return $result . "\n\n";
    }



    function randomPassword() {
        $alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 9; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function pin_generate(){
        $generated_pin = rand(100000,999999);
        $this->db->where("pin",$generated_pin);
        $query = $this->db->get('s_generate_pin');
        if($query->num_rows() > 0){
            $this->pin_generate();
        }else{
            return $generated_pin;
        }  
    }

    public function sendemail($to, $subject, $message)
    {
        $this->load->library('_phpmailer');
        $this->_phpmailer->_load();
        $emailusername = $this->m_general->getSetting('smtp_email');
        $emailpassword = $this->m_general->getSetting('smtp_pass');
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $this->m_general->getSetting('smtp_host');
        $mail->SMTPAuth = true;
        $mail->Username = $emailusername; 
        $mail->Password = $emailpassword; 
        $mail->SMTPSecure = $this->m_general->getSetting('smtp_secure');
        $mail->Port = $this->m_general->getSetting('smtp_port');
        $mail->SetFrom($this->m_general->getSetting('smtp_email'),$this->m_general->getSetting('mail_sender_name'));
        $mail->Subject = $subject;
        $data['message'] = $message;
        $mailContent = $this->load->view('frontend/email_template', $data, true);
        $mail->MsgHTML($mailContent);
        $mail->isHTML(true); 
        $mail->addAddress($to);
        $result = $mail->Send();
        return $message = $result ? true : false;
    }

    public  function upload_simple_file($original_path,$file_name,$new_file_name)
    {
        $this->load->library('upload');
        if (!is_dir($original_path)) {
            mkdir($original_path, 0777, TRUE);
        }
        $config['upload_path'] = $original_path;
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $new_file_name;
        $this->upload->initialize($config);
        if($this->upload->do_upload($file_name)){
            $this->upload->data();
        }    
    }

     public function fileUpload($path, $file_name, $new_file_name, $width=250, $height=250){
        $this->load->library('upload');
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
        }
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = $new_file_name;
        
        $this->upload->initialize($config);
        if($this->upload->do_upload($file_name)){
            $gbr = $this->upload->data();
            $file_name = $gbr['file_name'];

            $config = array(
                'image_library' => 'GD2',
                'source_image'  => $path.$new_file_name,
                'maintain_ratio'=> true,
                'width'         => $width,
                'height'        => $height,
                'new_image'     => $path.$new_file_name
            );

            $this->load->library('image_lib', $config);
                
            $this->image_lib->initialize($config);
            if(!$this->image_lib->resize()){
                return false;
            }
            $this->image_lib->clear();
        }   
     }

    public function upload_img_with_thumb($original_path,$thumb_path,$file_name,$new_file_name)
    {

        $this->load->library('upload');
        if (!is_dir($original_path)) {
            mkdir($original_path, 0777, TRUE);
        }
        if (!is_dir($thumb_path)) {
            mkdir($thumb_path, 0777, TRUE);
        }
        $config['upload_path'] = $original_path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = $new_file_name;
        
        $this->upload->initialize($config);
        if($this->upload->do_upload($file_name)){
            $gbr = $this->upload->data();
            $file_name = $gbr['file_name'];

            $config = array(
                'image_library' => 'GD2',
                'source_image'  => $original_path.$new_file_name,
                'maintain_ratio'=> true,
                'width'         => 250,
                'height'        => 250,
                'new_image'     => $thumb_path.$new_file_name
            );

            $this->load->library('image_lib', $config);
                
            $this->image_lib->initialize($config);
            if(!$this->image_lib->resize()){
                return false;
            }
            $this->image_lib->clear();
        }           
    }

	public function __destruct() {
    	$this->db->cache_delete_all();
        $this->db->close(); 
    }

}    

// End of Admin_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
