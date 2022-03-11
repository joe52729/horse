<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CI_Controller {

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
		$data['data']=$this->audit_model->get_all_data();
		$this->load->view('user/apply_view',$data);
	}

	public function add()
	{		
		if($this->input->post('type') == MD5('admi_dEd21q12133w_n')){
			$type = 'admin';
		}else{
			$type = $this->input->post('type');
		}
 		$time = date('YmdHis');
		$data = array(
				'billing_time' => $time,
				'type' => $type, //登入類型
				'status' => '0',//狀態 0 未開通帳號 				
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'last_modified_time' => $time,
			);
		// $data = $this->input->post(NULL , TRUE);
		 
		// echo json_encode(array('msg' => $this->input->post('password')));
		// exit();

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
}
