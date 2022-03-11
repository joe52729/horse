<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply_company extends CI_Controller {

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
	}

	public function index($id='')
	{
		// $data['data']=$this->audit_model->get_all_data();
		$data['data']=$this->audit_model->get_all_data_company($id);
		$this->load->view('user/apply_company_view',$data);
	}

	// public function add_company()
	// {		
 	// 	$time = date('YmdHis');
	// 	$data = array(
	// 		'billing_time' => $time,
	// 		'type' => $this->input->post('type'), //登入類型
	// 		'status' => '0',//狀態 0 未開通				
	// 		'title' => $this->input->post('title'),
	// 		'phone' => $this->input->post('phone'),
	// 		'address' => $this->input->post('address'),
	// 		'company_profile' => $this->input->post('company_profile'),
	// 		'last_modified_time' => $time,
	// 	);

	// 	$response = $this->audit_model->add_company($data);

	// 	if ($response)
	// 	{
	// 		echo json_encode(array('status' => 'T'));
	// 		exit();
	// 	}
	// 	else
	// 	{
	// 		echo json_encode(array('msg' => 'Fail'));
	// 		exit();
	// 	}		
	// }

	public function update_company()
	{		
 		$time = date('YmdHis');
		$data = array(
			'title' => $this->input->post('title'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'company_profile' => $this->input->post('company_profile'),
			'last_modified_time' => $time,
			'user_id' => $this->session->userdata['user_id'],
			'user_display_name' => $this->session->userdata['user_display_name'],
		);

		// $response = $this->audit_model->add_company($data);
		$response = $this->audit_model->update_company(array('id' => $this->input->post('cid')), $data);

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
}
