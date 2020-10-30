<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class V_NewsController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->v_vendormodel->not_logged_in();
		$this->load->model('vendor/V_NewsModel','v_newsmodel');
    }

 	public function index()
 	{
 		$this->v_vendormodel->CSRFVerify();
 		$data['page'] = 'v_news/list_v_news';
		$this->load->view('vendor/template',$data);
	}

	public function create_news()
	{
		$this->v_vendormodel->CSRFVerify();
		$data['page'] = 'v_news/add_v_news';
		$this->load->view('vendor/template',$data);
	}

	public function validnewsurl($url)
	{
		//$url = $_REQUEST['url'];
	    $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
	    if (!preg_match($pattern, $url))
	    {
			$this->form_validation->set_message('validnewsurl', 'The URL you entered is not correctly formatted.');
	        return FALSE;
	    }
		else 
		{
			return TRUE;
		}
	}

 	public function add_news()
 	{
 		$this->v_vendormodel->CSRFVerify();
		$this->form_validation->set_rules('title','News Title','required|trim|is_unique[s_news.title]');
		$this->form_validation->set_rules('url','News URL','required|trim|is_unique[s_news.url]|callback_validnewsurl');
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$user=$this->v_vendormodel->GetUserData();
			$params = array(
				'title' => ucfirst($_REQUEST['title']), 
				'url' => $_REQUEST['url'],
				'created_by' => $user['name'],
			);
			
			$check = $this->newsmodel->add_news($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'News has been added Successfully..');
				redirect('vendor/news-list');
			}
		}
		$data['page'] = 'vendor/add_v_news';
		$this->load->view('vendor/template',$data);
  	}

  	public function edit_news()
	{
		$this->v_vendormodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'vendor/edit_v_news';
		$data['news'] = $this->newsmodel->get_news_by_id($id); 
		$this->load->view('vendor/template',$data);
  	}

  	public function update_news()
  	{
  		$this->v_vendormodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['news'] = $this->newsmodel->get_news_by_id($id); 

	    if($_REQUEST['title'] != $data['news']['title']) {
	       $is_unique =  '|is_unique[s_news.title]';
	    } else {
	       $is_unique =  '';
	    }

	    if($_REQUEST['url'] != $data['news']['url']) {
	       $is_unique1 =  '|is_unique[s_news.url]';
	    } else {
	       $is_unique1 =  '';
	    }
		
		$this->form_validation->set_rules('title','News Title','required|trim'.$is_unique);
		$this->form_validation->set_rules('url','News URL','required|trim'.$is_unique1);
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'title' => ucfirst($_REQUEST['title']), 
				'url' => $_REQUEST['url'],
			);
			
			$check = $this->newsmodel->update_news_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'News has been updated Successfully..');
				redirect('vendor/news-list');
			}
		}
		$data['page'] = 'vendor/edit_v_news';
		$this->load->view('vendor/template',$data);
  	}
  	
	public function trash_news()
	{ 
		$this->v_vendormodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			$this->db->where('id', $id);
			$this->db->delete("s_news");
			$this->session->set_flashdata('success', 'News has been Successfully Deleted.');
			redirect('vendor/news-list');
		}
	}

	

}

	