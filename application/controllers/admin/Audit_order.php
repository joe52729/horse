<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_order extends CI_Controller {

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
		$data['data']=$this->audit_model->get_all_order_data();
		$this->load->view('admin/audit_order_view',$data);
	}

	public function add()
	{		
 		$time = date('YmdHis');
		$data = array(
				'billing_time' => $time,
				'type' => $this->input->post('type'), //登入類型
				'status' => '0',//狀態 0 未開通帳號 				
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
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

	// 訂單的狀態：
	// 審核中、上架中、已得標（農場跟通路確認交易，不再對外開放）、取消交易、已下架(可重新審核上架)
	// 審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)
	// 、已下架(可重新審核上架)(4)、拒絕\退回(5)、取消交易(farm)(6)
	
	public function pass()
	{		
		// echo $this->input->post('id');
		// exit;
 		$time = date('YmdHis');
		$data = array(
				'order_status' => '1',//狀態 0未啟用 1啟用				
				'admin_acc' => $this->session->userdata['user_id'],
				'admin_name' => $this->session->userdata['user_display_name'],
				'last_modified_time' => $time
			);
        $response = $this->audit_model->audit_orders(array('order_num' => $this->input->post('id')), $data);
        
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

	public function audit_return()
	{		
 		$time = date('YmdHis');
		$data = array(
			'order_status' => '5',				
			'return_ps' => $this->input->post('audit_return_ps'),				
			'admin_acc' => $this->session->userdata['user_id'],
			'admin_name' => $this->session->userdata['user_display_name'],
			'last_modified_time' => $time
		);
		$response = $this->audit_model->audit_orders(array('order_num' => $this->input->post('id')), $data);
        
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
