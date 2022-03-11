<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_add extends CI_Controller {

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
		$this->load->model('dist/orders_model');
		$this->load->model('farm/trans_model');
		$this->load->model('api/api_model');
		$this->load->model('admin/admin_set_model');

		$this->load->view("public/layout");	 	
		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';
		// exit();
	}

	public function index()
	{
		$oid = $this->input->get('oid');
		$data['orders_data'] = $this->trans_model->get_by_oid($oid);
		$data['trans_data'] = $this->trans_model->get_all_data();
		$this->load->view('farm/trans_add_view',$data);
	}
	
	public function trans_add_load()
	{
		$oid = $this->input->get('oid');
		$data_trans['datalist'] = $this->trans_model->get_by_oid($oid);
		$data_format_list = $this->admin_set_model->get_all_format_on();
		
		foreach($data_format_list as $val){
			if($data_trans['datalist']->spec_format !=='' AND $data_trans['datalist']->spec_format == $val->id)
			{
				// $data_trans['datalist']->format_title = $val->title;
				// $data_trans['datalist']->format_length = $val->length;
				// $data_trans['datalist']->format_weight = $val->weight;
				// $data_trans['datalist']->format_unit_l = $val->unit_l;
				// $data_trans['datalist']->format_unit_w = $val->unit_w;
				// 每件：長度30cm,重量250g
				$data_trans['datalist']->alert='每件：'.'長度'.$val->length.$val->unit_l.','.'重量'.$val->weight.$val->unit_w;
			}else{
				// $data_trans['datalist']->format_title = '';
				// $data_trans['datalist']->format_length = '';
				// $data_trans['datalist']->format_weight = '';
				// $data_trans['datalist']->format_unit_l = '';
				// $data_trans['datalist']->format_unit_w = '';
				$data_trans['datalist']->alert = '';
			}
		}

		if ($data_trans)
		{
			$data_trans['sys_status'] = TRUE;
			$data_trans['sys_code'] = '200';
			$data_trans['sys_msg'] = '資料處理完成';
			echo json_encode($data_trans);			
			exit();
		}
		else
		{
			$data_trans['sys_status'] = FALSE;
			$data_trans['sys_code'] = '500';
			$data_trans['sys_msg'] = '資料未知錯誤';
			echo json_encode($data_trans);			
			exit();
		}	
	}

	// public function add()
	// {		
	// 	//審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)、
	// 	// 已下架(4)、拒絕(5)、取消交易(farm)(6)、下標中(7)
		
	// 	//ord php內置
	// 	$num = 'TNS'.date('YmdHi').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5);
	// 	// $sub_num = 'SUB'.date('YmdHi').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5);
	// 	$time = date('YmdHis');	

	// 	$data['orders_data'] = $this->orders_model->get_by_id($this->input->post('order_num'));	

	// 	//新增下標紀錄		
	// 	$data_sub = array(
	// 		'order_num' => $this->input->post('order_num'), //訂單號
	// 		'order_subscript_num' => $this->input->post('order_subscript_num'), //下標數量
	// 		'sub_cycle' => implode(",",$this->input->post('sub_cycle')), //下標週期
	// 		'order_sub_remark' => $this->input->post('remark'), //下標農場備註			
	// 		'trans_num' => $num,
	// 		'order_status' => $data['orders_data']->order_status,			
	// 		'order_dist' => $data['orders_data']->order_dist, 
	// 		'order_dist_acc' => $data['orders_data']->order_dist_acc,
	// 		'order_dist_name' => $data['orders_data']->order_dist_name,
	// 		'order_billing' => $data['orders_data']->order_billing,
	// 		'shipping_total' => $data['orders_data']->shipping_total,
	// 		'start_date' => $data['orders_data']->start_date,
	// 		'end_date' => $data['orders_data']->end_date,
	// 		'order_dist_remark' => $data['orders_data']->remark,
	// 		'order_subscript_acc' => $this->session->userdata['user_id'], //farm acc
	// 		'order_subscript_name' => $this->session->userdata['user_display_name'], //farm acc
	// 		'order_subscript' => $this->session->userdata['user_company_id'],
	// 		'trans_num' => $num,
	// 		'trans_status' => '7',			
	// 		'trans_billing' => $time,
	// 		'save_time' => $time,
	// 		'last_modified_time' => $time
	// 	);

	// 	$response_sub_api = $this->api_model->fields_exits_auto_input($this->input->post() + $data_sub,'subscript');
		
	// 	// echo '<pre>';
	// 	// print_r($response_sub_api).'_response_sub_api';
	// 	// print_r($response_sub);
	// 	// echo '</pre>';
	// 	// exit();
	// 	$response_sub = $this->trans_model->add_subscript($response_sub_api);	
		
	// 	//新增交易紀錄
	// 	$data_trans = array(
	// 		'order_num' => $this->input->post('order_num'),
	// 		'order_subscript_num' => $this->input->post('order_subscript_num'), //下標數量
	// 		'sub_cycle' => implode(",",$this->input->post('sub_cycle')), //下標週期
	// 		'order_sub_remark' => $this->input->post('remark'), //下標農場備註			
	// 		'order_status' => $data['orders_data']->order_status,			
	// 		'trans_num' => $num,
	// 		'trans_status' => '7',			
	// 		'trans_billing' => $time,
	// 		'order_dist' => $data['orders_data']->order_dist, //ex通路商帳號.Ａ.全聯Pxmart Ｂ.costco
	// 		'order_dist_acc' => $data['orders_data']->order_dist_acc,
	// 		'order_dist_name' => $data['orders_data']->order_dist_name,
	// 		'order_dist_remark' => $data['orders_data']->remark,
	// 		'order_subscript_acc' => $this->session->userdata['user_id'], //farm acc
	// 		'order_subscript_name' => $this->session->userdata['user_display_name'], //farm acc
	// 		'order_subscript' => $this->session->userdata['user_company_id'],
	// 		'shipping_total' => $data['orders_data']->shipping_total,
	// 		'start_date' => $data['orders_data']->start_date,
	// 		'end_date' => $data['orders_data']->end_date,			
	// 		'save_time' => $time,
	// 		'last_modified_time' => $time
	// 	);
	// 	$response_trans_api = $this->api_model->fields_exits_auto_input($this->input->post() + $data_trans,'trans_list');

	// 	$response_trans = $this->trans_model->add_trans_list($response_trans_api);

	// 	if ($response_sub)
	// 	{
	// 		echo json_encode(array('status' => 'T'));
	// 		exit();
	// 	}
	// 	else
	// 	{
	// 		echo json_encode(array('status' => 'F'));
	// 		exit();
	// 	}		
	// }

	public function add()
	{		
		//審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)、
		// 已下架(4)、拒絕(5)、取消交易(farm)(6)、下標中(7)
		// echo 'add';
		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';
		// exit();
		//ord php內置
		$num = 'TNS'.date('YmdHi').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5);
		// $sub_num = 'SUB'.date('YmdHi').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5);
		$time = date('YmdHis');	

		$data['orders_data'] = $this->orders_model->get_by_id($this->input->post('order_num'));	

		//新增下標紀錄		
		$data_sub = array(
			// 'order_num' => $this->input->post('order_num'), //訂單號
			// 'order_subscript_num' => $this->input->post('order_subscript_num'), //下標數量
			// 'sub_cycle' => implode(",",$this->input->post('sub_cycle')), //下標週期
			// 'order_sub_remark' => $this->input->post('remark'), //下標農場備註			
			'trans_num' => $num,
			'order_status' => $data['orders_data']->order_status,			
			'order_dist' => $data['orders_data']->order_dist, 
			'order_dist_acc' => $data['orders_data']->order_dist_acc,
			'order_dist_name' => $data['orders_data']->order_dist_name,
			'order_billing' => $data['orders_data']->order_billing,
			'shipping_total' => $data['orders_data']->shipping_total,
			'start_date' => $data['orders_data']->start_date,
			'end_date' => $data['orders_data']->end_date,
			'order_dist_remark' => $data['orders_data']->remark,
			'scientific_id' => $data['orders_data']->scientific_id,
			'variety' => $data['orders_data']->variety,
			'check_level' => $data['orders_data']->check_level,
			'product_name' => $data['orders_data']->product_name,
			'product_unit' => $data['orders_data']->product_price,
			'product_price' => $data['orders_data']->product_price, 
			'spec_format' => $data['orders_data']->spec_format,
			'shipping_cycle' => $data['orders_data']->shipping_cycle,
			'order_subscript_acc' => $this->session->userdata['user_id'], //farm acc
			'order_subscript_name' => $this->session->userdata['user_display_name'], //farm acc
			'order_subscript' => $this->session->userdata['user_company_id'],
			'trans_billing' => $time,
			'save_time' => $time,
			'last_modified_time' => $time
		);

		$response_sub_api = $this->api_model->fields_exits_auto_input($this->input->post() + $data_sub,'subscript');
		
		// echo '<pre>';
		// print_r($response_sub_api);
		// echo '</pre>';
		// echo '_response_sub_api_2122';
		// exit();
		$response_sub = $this->trans_model->add_subscript($response_sub_api);	
		
		//新增交易紀錄
		$data_trans = array(
			'order_num' => $this->input->post('order_num'), //訂單號
			'order_subscript_num' => $this->input->post('order_subscript_num'), //下標數量
			// 'sub_cycle' => implode(",",$this->input->post('sub_cycle')), //下標週期
			'order_sub_remark' => $this->input->post('remark'), //下標農場備註			
			'trans_num' => $num,
			'order_status' => $data['orders_data']->order_status,			
			'order_dist' => $data['orders_data']->order_dist, 
			'order_dist_acc' => $data['orders_data']->order_dist_acc,
			'order_dist_name' => $data['orders_data']->order_dist_name,
			'order_billing' => $data['orders_data']->order_billing,
			'shipping_total' => $data['orders_data']->shipping_total,
			'start_date' => $data['orders_data']->start_date,
			'end_date' => $data['orders_data']->end_date,
			'order_dist_remark' => $data['orders_data']->remark,
			'scientific_id' => $data['orders_data']->scientific_id,
			'variety' => $data['orders_data']->variety,
			'check_level' => $data['orders_data']->check_level,
			'product_name' => $data['orders_data']->product_name,
			'product_unit' => $data['orders_data']->product_price,
			'product_price' => $data['orders_data']->product_price, 
			'spec_format' => $data['orders_data']->spec_format,
			'shipping_cycle' => $data['orders_data']->shipping_cycle,
			'order_subscript_acc' => $this->session->userdata['user_id'], //farm acc
			'order_subscript_name' => $this->session->userdata['user_display_name'], //farm acc
			'order_subscript' => $this->session->userdata['user_company_id'],
			'trans_billing' => $time,
			'save_time' => $time,
			'last_modified_time' => $time
		);
		$response_trans_api = $this->api_model->fields_exits_auto_input($this->input->post() + $data_trans,'trans_list');

		$response_trans = $this->trans_model->add_trans_list($response_trans_api);


		if ($response_sub)
		{
			$response['sys_status'] = TRUE;
			$response['sys_code'] = '200';
			$response['sys_msg'] = '資料處理完成';
			echo json_encode($response);			
			exit();
		}
		else
		{
			$response['sys_status'] = FALSE;
			$response['sys_code'] = '500';
			$response['sys_msg'] = '資料未知錯誤';
			echo json_encode($response);			
			exit();
		}	

	}	
}
