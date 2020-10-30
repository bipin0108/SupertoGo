<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NewsController extends CI_Controller
{
 	public function __construct()
    {
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$this->load->model('admin/NewsModel','newsmodel');
    }

 	public function index()
 	{
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'news/list_news';
		$this->load->view('admin/template',$data);
	}

	public function create_news()
	{
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'news/add_news';
		$this->load->view('admin/template',$data);
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
 		$this->adminmodel->CSRFVerify();
		$this->form_validation->set_rules('en_title','Title in English','required|trim|is_unique[s_news.en_title]');
		$this->form_validation->set_rules('hi_title','Title in Hindi','required|trim|is_unique[s_news.hi_title]');
		$this->form_validation->set_rules('mr_title','Title in Marathi','required|trim|is_unique[s_news.mr_title]');

		$this->form_validation->set_rules('news_en_description','News Description','required|trim');
		$this->form_validation->set_rules('news_hi_description','News Description','required|trim');
		$this->form_validation->set_rules('news_mr_description','News Description','required|trim');

		$this->form_validation->set_rules('en_link','URL Link in English','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('hi_link','URL Link in Hindi','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('mr_link','URL Link in Marathi','required|trim|callback_validnewsurl');
		
		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if (empty($_FILES['news_image']['name'])){
			$this->form_validation->set_rules('news_image','News Image','required');
		}
		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$user=$this->adminmodel->GetUserData();
			$params = array(
				'en_title' => ucfirst($_REQUEST['en_title']), 
				'hi_title' => $_REQUEST['hi_title'],
				'mr_title' => $_REQUEST['mr_title'],
				'news_en_description' => $_REQUEST['news_en_description'],
				'news_hi_description' => $_REQUEST['news_hi_description'],
				'news_mr_description' => $_REQUEST['news_mr_description'],
				'en_link' => $_REQUEST['en_link'],
				'hi_link' => $_REQUEST['hi_link'],
				'mr_link' => $_REQUEST['mr_link'],
			);

			if (!empty($_FILES['news_image']['name']))
			{

				if (!is_dir('./uploads/news/')) {
					mkdir('./uploads/news/', 0777, TRUE);
				}

			    $config['upload_path']   = './uploads/news/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$new_name = rand().'_'.str_replace(' ', '', $_FILES["news_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('news_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$img_file = $this->upload->data(); 
					$params['news_image'] = $new_name;

					$configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  $img_file['full_path'],
		              'maintain_ratio'  =>  false,
		              'width'           =>  250,
		              'height'          =>  250,
		            );
		            $this->load->library('image_lib', $configer); 
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();
				}
			}
			
			$check = $this->newsmodel->add_news($params);
			if($check)
			{
				$this->session->set_flashdata('success', 'News has been added Successfully..');
				redirect('admin/news-list');
			}
		}
		$data['page'] = 'news/add_news';
		$this->load->view('admin/template',$data);
  	}

  	public function edit_news()
	{
		$this->adminmodel->CSRFVerify();
		$id = $this->uri->segment(3);
		$data['page'] = 'news/edit_news';
		$data['news'] = $this->newsmodel->get_news_by_id($id); 
		$this->load->view('admin/template',$data);
  	}

  	public function update_news()
  	{
  		$this->adminmodel->CSRFVerify();
  		$id = $_REQUEST['id'];
		$data['news'] = $this->newsmodel->get_news_by_id($id); 

		if($_REQUEST['en_title'] != $data['news']['en_title']) {
	       $is_unique =  '|is_unique[s_news.en_title]';
	    } else {
	       $is_unique =  '';
	    }
		$this->form_validation->set_rules('en_title','Title in English','required|trim'.$is_unique);

		if($_REQUEST['hi_title'] != $data['news']['hi_title']) {
	       $is_unique1 =  '|is_unique[s_news.hi_title]';
	    } else {
	       $is_unique1 =  '';
	    }
		$this->form_validation->set_rules('hi_title','Title in Hindi','required|trim'.$is_unique1);

		if($_REQUEST['mr_title'] != $data['news']['mr_title']) {
	       $is_unique2 =  '|is_unique[s_news.mr_title]';
	    } else {
	       $is_unique2 =  '';
	    }
		$this->form_validation->set_rules('mr_title','Title in Marathi','required|trim'.$is_unique2);

		$this->form_validation->set_rules('news_en_description','News Description','required|trim');
		$this->form_validation->set_rules('news_hi_description','News Description','required|trim');
		$this->form_validation->set_rules('news_mr_description','News Description','required|trim');

		$this->form_validation->set_rules('en_link','URL Link in English','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('hi_link','URL Link in Hindi','required|trim|callback_validnewsurl');
		$this->form_validation->set_rules('mr_link','URL Link in Marathi','required|trim|callback_validnewsurl');
		
	    $this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false)  
		{  
			//Error
		}
		else
		{	
			$params = array(
				'en_title' => ucfirst($_REQUEST['en_title']), 
				'hi_title' => $_REQUEST['hi_title'],
				'mr_title' => $_REQUEST['mr_title'],
				'news_en_description' => $_REQUEST['news_en_description'],
				'news_hi_description' => $_REQUEST['news_hi_description'],
				'news_mr_description' => $_REQUEST['news_mr_description'],
				'en_link' => $_REQUEST['en_link'],
				'hi_link' => $_REQUEST['hi_link'],
				'mr_link' => $_REQUEST['mr_link'],
			);

				$config['upload_path']   = './uploads/news/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$new_name = rand().'_'.str_replace(' ', '', $_FILES["news_image"]['name']);
				$config['file_name'] = $new_name; 
				$this->load->library('upload', $config);

			if (!$this->upload->do_upload('news_image')) 
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('img_error',$error['error']);
				}
				else
				{ 
					$news = $this->newsmodel->get_news_by_id($id);
					if($news['news_image'] != '')
					{
						$path = './uploads/news/'.$news['news_image'];
						@unlink($path);
					}

					$img_file = $this->upload->data(); 
					$params['news_image'] = $new_name;

					$configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  $img_file['full_path'],
		              'maintain_ratio'  =>  false,
		              'width'           =>  250,
		              'height'          =>  250,
		            );
		            $this->load->library('image_lib', $configer); 
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();
				}
			
			$check = $this->newsmodel->update_news_by_id($id,$params);
			if($check)
			{
				$this->session->set_flashdata('success', 'News has been updated Successfully..');
				redirect('admin/news-list');
			}
		}
		$data['page'] = 'news/edit_news';
		$this->load->view('admin/template',$data);
  	}
  	
	public function trash_news()
	{ 
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];

			$news = $this->newsmodel->get_news_by_id($id);
			if($news['news_image'] != '')
			{
				$path = './uploads/news/'.$news['news_image'];
				@unlink($path);
			}

			$this->db->where('id', $id);
			$this->db->delete("s_news");
			$this->session->set_flashdata('success', 'News has been Successfully Deleted.');
			redirect('admin/news-list');
		}
	}

	

}

	