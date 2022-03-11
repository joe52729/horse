<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_add extends CI_Controller {

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

	public function index()
	{
		$this->load->view('admin/company_add_view');
	}

	public function add()
	{		
		$company_id = 'co'.date('YmdHi').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5);
 		$time = date('YmdHis');
		$data = array(
			'billing_time' => $time,
			'company_id' => $company_id,
			'type' => $this->input->post('type'), //登入類型
			'status' => '0',//狀態 0 未開通				
			'title' => $this->input->post('title'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'company_profile' => $this->input->post('company_profile'),
			'last_modified_time' => $time,
		);

		$response = $this->audit_model->add_company($data);

		if ($response)
		{
			echo json_encode(array('status' => 'T','re_url' => base_url('admin/').'audit_'.$this->input->post('type')));
			exit();
		}
		else
		{
			echo json_encode(array('msg' => 'Fail'));
			exit();
		}		
	}
}
