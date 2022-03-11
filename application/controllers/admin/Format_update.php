<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Format_update extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/admin_set_model');
		$this->load->view("public/layout");             
	}


	public function index($id)
	{
		$data['data'] = $this->admin_set_model->get_by_format($id);	
		$this->load->view('admin/format_update_view',$data);
	}
	
	public function s_enable()
	{		
		// echo $this->input->post('id');
		// exit;
 		$time = date('YmdHis');
		$data = array(
				'status' => '1',//狀態 0未啟用 1啟用				
				'admin_acc' => $this->session->userdata['user_id'],
				'admin_name' => $this->session->userdata['user_display_name'],
				'last_modified_time' => $time
			);
        $response = $this->admin_set_model->update_size(array('id' => $this->input->post('id')), $data);
        
		if ($response)
		{
            echo json_encode(array('status' => 'T'));
            exit();
		}
		else
		{
            echo json_encode(array('status' => 'F'));
            exit();
		}		
	}

	public function s_close()
	{		
 		$time = date('YmdHis');
		$data = array(
				'status' => '0',//狀態 0未啟用 1啟用				
				'admin_acc' => $this->session->userdata['user_id'],
				'admin_name' => $this->session->userdata['user_display_name'],
				'last_modified_time' => $time
			);
		$response = $this->admin_set_model->update_size(array('id' => $this->input->post('id')), $data);
        
		if ($response)
		{
            echo json_encode(array('status' => 'T'));
            exit();
		}
		else
		{
            echo json_encode(array('status' => 'F'));
            exit();
		}		
	}

	public function update()
	{		
		// var_dump($this->input->post());
		// exit();
 		$time = date('YmdHis');
		$data = array(
				'status' => $this->input->post('status'),//狀態 0未啟用 1啟用				
				'title' => $this->input->post('title'),
				'length' => $this->input->post('length'),
				'remark' => $this->input->post('remark'),
				'admin_acc' => 'admin_acc',
				'last_modified_time' => $time
			);
		// $data = $this->input->post(NULL , TRUE);
		 
        $response = $this->admin_set_model->update_size(array('id' => $this->input->post('id')), $data);
        
		if ($response)
		{
            echo json_encode(array('status' => 'T'));
            exit();
		}
		else
		{
            echo json_encode(array('status' => 'F'));
            exit();
		}		
		
		// $insert = $this->goods_model->book_add($data);
		// echo json_encode(array("status" => TRUE));
	}
}
