<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_data extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('api/api_model');
		$this->load->view("public/layout");
	}

	public function order_spec()
	{
		$response = $this->api_model->order_spec($this->input->get('order_num'));	
		if ($response)
		{
			$data['sys_status'] = TRUE;
			$data['sys_code'] = '200';
			$data['sys_msg'] = '資料處理完成';
			$data['datalist'] = $response ;
			echo json_encode($data);			
			exit();
		}
		else
		{
			$data['sys_status'] = FALSE;
			$data['sys_code'] = '404';
			$data['sys_msg'] = '資料請求失敗';
			echo json_encode($data);			
			exit();
		}	
	}

	public function sel_dist()
	{
		$response = $this->api_model->get_all_dist_data();

		if ($response)
		{
			$data['sys_status'] = TRUE;
			$data['sys_code'] = '200';
			$data['sys_msg'] = '資料處理完成';
			$data['datalist'] = $response;
			echo json_encode($data);			
			exit();
		}
		else
		{
			$data['sys_status'] = FALSE;
			$data['sys_code'] = '500';
			$data['sys_msg'] = '資料未知錯誤';
			echo json_encode($data);			
			exit();
		}	
	}
}
