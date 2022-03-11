<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Audit_user extends CI_Controller {

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
		// $this->load->model('api/user_center_model');
		$this->load->model('api/api_model');
		$this->load->model('user/user_model');
		$this->load->view("public/layout");
		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';
		// exit();
	}

	public function index()
	{
		$data['data']=$this->audit_model->get_all_data();
		$this->load->view('admin/audit_user_view',$data);
	}
	
	public function edit($id)
	{
		$data['data'] = $this->audit_model->get_by_audit_user_id($id);	
		$data['data_company'] = $this->audit_model->get_all_company_data();	
		$this->load->view('admin/audit_user_update_view',$data);
	}

	public function add()
	{	
		$time = date('YmdHis');

		$data['user'] = $this->user_model->get_by_id($this->input->post('user_id'));	
		if(isset($data['user']->user_id)){
			//formal update
			$data = array(
				// 'type' => $this->input->post('type'), //登入類型
				'status' => $this->input->post('status'),//狀態 0 未開通帳號 
				'admin_acc' => $this->session->userdata['user_id'],
				'admin_name' => $this->session->userdata['user_display_name'],	
				'last_modified_time' => $time,		
			);
		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';
		// exit();			
			$response = $this->audit_model->update_formal_user(array('user_id' => $this->input->post('user_id')), $data);
			$response_audit = $this->audit_model->update_user(array('user_id' => $this->input->post('user_id')), $data);
		}else{
			if($this->input->post('type') =='bb13f23549128d7ca4a4dd4645893dd5'){
				$type = 'admin';
			}else{
				$type = $this->input->post('type');
				if($this->input->post('type') =='admin'){
					$type = 'admin';
				}
			}
			// echo $type.'_ttt' ;
			// exit();
			$input = [];
			$input = $this->input->post();
			unset($input['type']);
			//audit update
			$data = array(
				'type' => $type, //登入類型
				'status' => $this->input->post('status'),//狀態 0 未開通帳號 
				'admin_acc' => $this->session->userdata['user_id'],
				'admin_name' => $this->session->userdata['user_display_name'],		
			);

			//formal insert
			$add_formal_data = array(
				'user_id' => $this->input->post('user_id'),
				'user_display_name' => $this->input->post('user_display_name'),
				'user_email' => $this->input->post('email'),
				'user_phone' => $this->input->post('phone'),
				'user_avator' => $this->input->post('user_avator'),
				'source_auth' => $this->input->post('source_auth'),
				'type' => $type, //登入類型
				'status' => $this->input->post('status'),//狀態 0 未開通帳號 				
				'company_id' => $this->input->post('company_id'),//狀態 0 未開通帳號				
				'billing_time' => $this->input->post('billing_time'),
				'last_modified_time' => $time,
			);

			$response_formal_api = $this->api_model->fields_exits_auto_input($input + $add_formal_data,'users');
			$response_formal = $this->audit_model->add_formal_user($response_formal_api);
			$response = $this->audit_model->update_user(array('user_id' => $this->input->post('user_id')), $data);
		}

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

	public function update()
	{		
 		$time = date('YmdHis');
		$data = array(
			'status' => $this->input->post('status'),//狀態 0未啟用 1啟用				
			'remark' => $this->input->post('remark'),
			'admin_acc' => $this->session->userdata['user_id'],
			'admin_name' => $this->session->userdata['user_display_name'],
			'last_modified_time' => $time
		);

        $response = $this->admin_set_model->update_user(array('id' => $this->input->post('id')), $data);
        
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
        $response = $this->audit_model->update_user(array('id' => $this->input->post('id')), $data);
        
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
		$response = $this->audit_model->update_user(array('id' => $this->input->post('id')), $data);
        
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
