<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_dist extends CI_Controller {

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
		$this->load->model('admin/audit_model');
		$this->load->view("public/layout");
		$this->load->model('user/user_model');
		// $this->user_model->user_uri_auth();				 
	}

	public function index()
	{
		// echo '<pre>';
		// print_r($this->session->all_userdata());
		// print_r($user_uri_auth);
		// echo '</pre>';
		$data['data']=$this->audit_model->get_all_dist_data();
		$data['type'] = 'dist';
		$this->load->view('admin/audit_company_view',$data);
	}

	public function add()
	{		
 		$time = date('YmdHis');
		 $data = array(
			'billing_time' => $time,
			'type' => $this->input->post('type'), //登入類型
			'status' => '0',//狀態 0 未開通				
			'title' => $this->input->post('title'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'company_profile' => $this->input->post('company_profile'),
			'last_modified_time' => $time,
		);

		$response = $this->audit_model->add($data);

		if ($response)
		{
			echo json_encode(array('status' => 'T'));
			exit();
		}
		else
		{
			echo json_encode(array('msg' => 'Fail'));
			exit();
		}		
	}

	public function user_enable()
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
        $response = $this->audit_model->update_company(array('id' => $this->input->post('id')), $data);
        
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

	public function user_close()
	{		
 		$time = date('YmdHis');
		$data = array(
				'status' => '0',//狀態 0未啟用 1啟用				
				'admin_acc' => $this->session->userdata['user_id'],
				'admin_name' => $this->session->userdata['user_display_name'],
				'last_modified_time' => $time
			);
		$response = $this->audit_model->update_company(array('id' => $this->input->post('id')), $data);
        
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
}
