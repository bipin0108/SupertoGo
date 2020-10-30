<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ProductController extends MY_Controller{
 	public function __construct(){
		parent::__construct();
		$this->adminmodel->not_logged_in();
		$site_lang = 'english';
		if(!empty($this->session->userdata('site_lang'))){
			$site_lang = $this->session->userdata('site_lang');
		}
		$this->lang->load('product',$site_lang); 
    }

 	public function index(){
 		$this->adminmodel->CSRFVerify();
 		$data['page'] = 'product/list';
 		$data['product'] = $this->m_general->getRows("SELECT * FROM tbl_product WHERE 1 ORDER BY product_id DESC");  
		$this->load->view('admin/template',$data);
	}

	public function create_product(){
		$this->adminmodel->CSRFVerify();
		$data['page'] = 'product/add';
		$data['category'] = $this->m_general->getRows("SELECT * FROM tbl_category WHERE 1");
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");
		$this->load->view('admin/template',$data);
	}

 	public function add_product(){
 		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$this->form_validation->set_rules('name',lang('Name'),'required|trim|is_unique[tbl_product.name]');
		$this->form_validation->set_rules('cat_id',lang('Category'),'required');
		$this->form_validation->set_rules('store_ids[]',lang('Store'),'required');
	 	$this->form_validation->set_rules('image', '', 'callback_file_check');
	 	$this->form_validation->set_rules('description', lang('Description'), 'required|trim');

	 	$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');
		if($this->form_validation->run() == false){  
			//Error
		}else{	
			$params['name'] = ucwords($_REQUEST['name']);
			$params['cat_id'] = $_REQUEST['cat_id'];
			$params['store_ids'] = implode(",", $_REQUEST['store_ids']);
			$params['description'] = $_REQUEST['description'];
			// $params['brand_id'] = !empty($_REQUEST['brand_id'])?ucwords($_REQUEST['brand_id']):0;
			if (!empty($_FILES['image']['name'])) {
	            $path = './uploads/product/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["image"]['name']);
	            $this->fileUpload($path, 'image', $new_file_name);
	            $params['image'] = $new_file_name;
	        }
			$id = $this->m_general->insertRow('tbl_product',$params);
			if($id){
				$store = $_REQUEST['store_id'];
		 		$city = $_REQUEST['city_id'];
		 		$brand = $_REQUEST['brand_id'];
		 		$weight = $_REQUEST['weight'];
		 		$unit = $_REQUEST['unit'];
		 		$qty = $_REQUEST['qty'];
		 		$price = $_REQUEST['price'];
		 		foreach ($store as $idx => $val) {
		 			if(!empty($price[$idx])){
			 			$prms = array(
			 				'product_id' => $id,
			 				'store_id' => $store[$idx],
			 				'city_id' => $city[$idx],
			 				'brand_id' => $brand[$idx],
			 				'weight' => $weight[$idx],
			 				'unit' => $unit[$idx],
			 				'qty' => $qty[$idx],
			 				'price' => $price[$idx],
			 			);
		 			}
		 			$this->m_general->insertRow('tbl_product_item',$prms);
		 		}
				$this->session->set_flashdata('success', lang('add_success'));
				redirect('admin/product-list');
			}
		}
		$data['page'] = 'product/add';
		$data['category'] = $this->m_general->getRows("SELECT * FROM tbl_category WHERE 1");
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");
		$this->load->view('admin/template',$data);
  	}

  	public function file_check($str){
        $allowed_mime_type_arr = array('image/jpeg','image/jpg','image/png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', lang('image_type'));
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', lang('image_required'));
            return false;
        }
    }

    public function edit_product()
	{
		$this->adminmodel->CSRFVerify();
		$product_id = $this->uri->segment(3);
		$data['page'] = 'product/edit';
		$data['category'] = $this->m_general->getRows("SELECT * FROM tbl_category WHERE 1");
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1"); 
		$data['product'] = $this->m_general->getRow("SELECT * FROM tbl_product WHERE product_id=?",array($product_id));
		$this->load->view('admin/template',$data);
  	}

  	public function update_product()
  	{
		$this->adminmodel->CSRFVerify();
		$this->load->helper('file');
		$product_id = $_REQUEST['id'];
		$data['product'] = $this->m_general->getRow("SELECT * FROM tbl_product WHERE product_id=?",array($product_id));
		$is_unique = '';
	   	if($_REQUEST['name'] != $data['product']['name']) {
		   $is_unique = '|is_unique[tbl_product.name]';
		}
		$this->form_validation->set_rules('name',lang('Name'),'required'.$is_unique);
		$this->form_validation->set_rules('cat_id',lang('Category'),'required');
		$this->form_validation->set_rules('store_ids[]',lang('City'),'required');
		$this->form_validation->set_rules('description', lang('Description'), 'required|trim');

		$this->form_validation->set_message('required', lang('form_validation_required'));
 		$this->form_validation->set_message('is_unique', lang('form_validation_is_unique'));

		$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">','</span>');

		if($this->form_validation->run() == false){  
			//error
		}else{	
			$params['name'] = ucwords($_REQUEST['name']);
			$params['cat_id'] = $_REQUEST['cat_id'];
			$params['store_ids'] = implode(",", $_REQUEST['store_ids']);
			$params['description'] = $_REQUEST['description']; 
			if (!empty($_FILES['image']['name'])) {
				$img = $this->m_general->getRow('SELECT * FROM tbl_product WHERE product_id=?',array($product_id));
				if(!empty($img['image'])){
					@unlink('./uploads/product/'.$img['image']);
				}
	            $path = './uploads/product/';
	            $new_file_name = rand().'_'.str_replace(' ', '',$_FILES["image"]['name']);
	            $this->fileUpload($path, 'image', $new_file_name);
	            $params['image'] = $new_file_name;
	        }
		 	$this->m_general->updateRow('tbl_product',$params,array("product_id"=>$product_id)); 
			$store = $_REQUEST['store_id'];
	 		$city = $_REQUEST['city_id'];
	 		$brand = $_REQUEST['brand_id'];
	 		$weight = $_REQUEST['weight'];
	 		$unit = $_REQUEST['unit'];
	 		$qty = $_REQUEST['qty'];
	 		$price = $_REQUEST['price'];
	 		$item_id = $_REQUEST['item_id'];
	 		foreach ($store as $idx => $val) {
	 			if(!empty($price[$idx])){
		 			$prms = array(
		 				'product_id' => $product_id,
		 				'store_id' => $store[$idx],
		 				'city_id' => $city[$idx],
		 				'brand_id' => $brand[$idx],
		 				'weight' => $weight[$idx],
		 				'unit' => $unit[$idx],
		 				'qty' => $qty[$idx],
		 				'price' => $price[$idx],
		 			);
		 			if(!empty($item_id[$idx])){
		 				$this->m_general->updateRow('tbl_product_item',$prms,array("item_id"=>$item_id[$idx]));
		 			}else{
	 					$this->m_general->insertRow('tbl_product_item',$prms);
		 			}
	 			}
	 		}
			$this->session->set_flashdata('success', lang('edit_success'));
			redirect('admin/product-list');
		}
		$data['page'] = 'product/edit';
		$data['category'] = $this->m_general->getRows("SELECT * FROM tbl_category WHERE 1");
		$data['store'] = $this->m_general->getRows("SELECT * FROM tbl_store WHERE 1");  
		$this->load->view('admin/template',$data);
  	}

	public function trash_product(){
		$this->adminmodel->CSRFVerify();
		if(!empty($_REQUEST['id'])){
			$product_id = $_REQUEST['id'];
			$product = $this->m_general->getRow('SELECT * FROM tbl_product WHERE product_id=?',array($product_id));
			if(!empty($product['image'])){
				@unlink('./uploads/product/'.$product['image']);
			}
			$this->m_general->deleteRows('tbl_product',array('product_id'=>$product_id));
			$this->session->set_flashdata('success', lang('del_success'));
			redirect('admin/product-list');
		}
	}

	public function demo_excel(){
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex();
	    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1, lang('Name'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1, lang('Description'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1, lang('Image'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1, lang('Category'));
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1, lang('Brand'));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1, lang('Store')); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,1, lang('City'));  
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,1, lang('Weight'));  
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,1, lang('Unit')); 
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,1, lang('Qty'));        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,1, lang('Price'));        
        $objPHPExcel->getActiveSheet()->getStyle('A1:k1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:k1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:k1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF808080');
		$col = 'A';
		while(true){
		    $tempCol = $col++;
		    $objPHPExcel->getActiveSheet()->getColumnDimension($tempCol)->setAutoSize(true);
		    if($tempCol == $objPHPExcel->getActiveSheet()->getHighestDataColumn()){
		        break;
		    }
		}

		$category = $this->m_general->getRow("SELECT GROUP_CONCAT(name) name FROM tbl_category");
		$brand = $this->m_general->getRow("SELECT GROUP_CONCAT(name) name FROM tbl_brand");
		$store = $this->m_general->getRow("SELECT GROUP_CONCAT(name) name FROM tbl_store");
		$city = $this->m_general->getRow("SELECT GROUP_CONCAT(name) name FROM tbl_city");
		for ($i=2; $i <= 250; $i++) { 
			// Category
	        $objValidation = $objPHPExcel->getActiveSheet()->getCell("D$i")->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick from list');
			$objValidation->setPrompt('Please pick a value from the drop-down list.');
			$objValidation->setFormula1('"'.$category['name'].'"');

			// Brand
	        $objValidation = $objPHPExcel->getActiveSheet()->getCell("E$i")->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick from list');
			$objValidation->setPrompt('Please pick a value from the drop-down list.');
			$objValidation->setFormula1('"'.$brand['name'].'"');

			// Store
	        $objValidation = $objPHPExcel->getActiveSheet()->getCell("F$i")->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick from list');
			$objValidation->setPrompt('Please pick a value from the drop-down list.');
			$objValidation->setFormula1('"'.$store['name'].'"');

			// city
	        $objValidation = $objPHPExcel->getActiveSheet()->getCell("G$i")->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick from list');
			$objValidation->setPrompt('Please pick a value from the drop-down list.');
			$objValidation->setFormula1('"'.$city['name'].'"');

			// Unit
	        $objValidation = $objPHPExcel->getActiveSheet()->getCell("I$i")->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick Brand');
			$objValidation->setPrompt('Please pick a value from the drop-down list.');
			$objValidation->setFormula1('"Lbs,Ltr,Pcs,gms,Kg,oz,ml,Packet"');
		}
       
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $file='product_excel.xls';
	  	header('Content-Type: application/vnd.ms-excel');
	  	header("Content-Disposition: attachment; filename=\"$file\"");		
		header('Cache-Control: max-age=0');
	  	$object_writer->save('php://output');
	}

	public function bulk_product(){
		$this->adminmodel->CSRFVerify(); 
		if(!empty($_FILES)){ 
			$this->load->library('excel');
			$image_arr = $_FILES['image']['name'];
			if(isset($_FILES['product_excel']['name'])){
				$path = $_FILES["product_excel"]["tmp_name"];
            	$objPHPExcel = PHPExcel_IOFactory::load($path);
            	foreach($objPHPExcel->getWorksheetIterator() as $worksheet){
            		$highestRow = $worksheet->getHighestRow();
                	$highestColumn = $worksheet->getHighestColumn();
                	for($row=2; $row<=$highestRow; $row++){

                		$data = array();
                		$name 		 = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
                		$description = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
						$img         = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
						$category    = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
						$brand       = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
						$store       = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
						$city        = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
						$weight      = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
						$unit        = $worksheet->getCellByColumnAndRow(8,$row)->getValue();
						$qty         = $worksheet->getCellByColumnAndRow(9,$row)->getValue();
						$price       = $worksheet->getCellByColumnAndRow(10,$row)->getValue();

						if(!empty($name)){
							$data['name'] = $name;
							$data['description'] = !empty($description)?$description:'';
							$image = $_FILES['image'];
							if (in_array($img, $image_arr)){
							    $i = array_search($img, $image_arr);
							    if(!empty($image_arr[$i])){   
							    	$this->load->helper('file');
							        $path = './uploads/product/';
	                                $_FILES['product']['name']= $image['name'][$i];
	                                $_FILES['product']['type']= $image['type'][$i];
	                                $_FILES['product']['tmp_name']= $image['tmp_name'][$i];
	                                $_FILES['product']['error']= $image['error'][$i];
	                                $_FILES['product']['size']= $image['size'][$i];   
							        $new_file_name = rand().'_'.str_replace(' ', '',$image['name'][$i]);
							        $this->fileUpload($path, 'product', $new_file_name);
							        $data['image'] = $new_file_name;
							    }
							}

							$category = $this->m_general->getRow("SELECT * FROM tbl_category WHERE name=?",array($category));
							$data['cat_id'] = !empty($category)?$category['cat_id']:0;

							$store = $this->m_general->getRow("SELECT * FROM tbl_store WHERE name=?",array($store));
							$city = $this->m_general->getRow("SELECT * FROM tbl_city WHERE name=?",array($city));
							$brand = $this->m_general->getRow("SELECT * FROM tbl_brand WHERE name=?",array($brand));
							$store_id = !empty($store)?$store['store_id']:0;
							$city_id = !empty($city)?$city['city_id']:0;
							$brand_id = !empty($brand)?$brand['brand_id']:0;
							$params = array( 
								'store_id'=>$store_id,
								'city_id'=>$city_id,
								'brand_id'=>$brand_id,
								'weight'=>$qty,
								'unit'=>$unit,
								'price'=>$price,
							);
							
							if(!empty($name)){
								$check = $this->m_general->getRow("SELECT * FROM tbl_product WHERE name=? AND cat_id=?",array($name, $category['cat_id']));
								if($check){
									if(!empty($store_id)){
										if(!in_array($store_id, explode(',', $check['store_ids']))){
											$data['store_ids'] = $check['store_ids'].','.$store_id;
										}
										$product_id = $this->m_general->updateRow("tbl_product",$data,array("product_id"=>$check['product_id']));
									}
									$params['product_id'] = $check['product_id'];
									$item_id = $this->m_general->insertRow("tbl_product_item",$params);
								}else{
									$product_id = $this->m_general->insertRow("tbl_product",$data);
									$params['product_id'] = $product_id;
									$item_id = $this->m_general->insertRow("tbl_product_item",$params);
								}
							}
						}

                	}
            	}
        	}
        	$this->session->set_flashdata('success', lang('add_success'));
			redirect('admin/product-list');
		}

 		$data['page'] = 'product/bulk_product';
		$this->load->view('admin/template',$data);
	}

}



