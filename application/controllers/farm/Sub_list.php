<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('farm/trans_model');
		$this->load->model('dist/orders_model');		
        $this->load->model('api/api_model');
		$this->load->view("public/layout");
		$this->load->view('login_view');	 	
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
	}
	
	public function login()
	{
		print_r($_POST);
		exit();
		// $time = date('YmdHis');
		// $response = $this->user_center_model->get_user_info();
		// $array = [];
		// $array = array(
		// 	'user_id' => $response['user_id'],
		// 	'token' => $response['token'],
		// 	'user_display_name' => $response['user_display_name'],
		// );	

		// $this->session->set_userdata($array);

		// $this->user_model->get_tms_user_info();
		// // echo $this->session->userdata['user_type'];
		// // exit();

		// // echo '<pre>';
		// // print_r($this->session->set_userdata($array));
		// // print_r($response_tms_user);
		// // echo '</pre>';	

		// //未註冊過用戶，先存入等待審核
		// $time = date('YmdHis');		
		// $data = array(
		// 	'billing_time' => $time,
		// 	'type' => 'unreviewed',
		// 	'source_auth' => $response['source_auth'],
		// 	'status' => '0',//狀態 0 未開通				
		// 	'user_id' => $response['user_id'],
		// 	'user_display_name' => $response['user_display_name'],
		// 	'user_avator' => $response['user_avator'],
		// 	'user_email' => $response['user_email'],
		// 	'user_phone' => $response['user_phone'],
		// );

		// $response = $this->user_model->add($data);
		$this->load->view('public/login_layout');
		$this->load->view('index_view');	
	}
	
	// status
	//審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)、
	//已下架(可重新審核上架)(4)、拒絕(5)、取消交易(farm)(6)
    public function index()
    {
		// $farm_acc = $this->session->userdata['user_id'];
		// $data['data'] = $this->trans_model->get_all_sub_data($farm_acc);

		// //比對資料，農場若已下標出現提示，已下標，並不可下標
		// foreach ($data['data'] as $key => $value)
		// {
		// 	$data['data'][$key]->btn = ''; 
		// 	//得標狀態，顯示取消交易btn
		// 	if($data['data'][$key]->order_status == '2')
		// 	{
		// 		$data['data'][$key]->btn = 'trans_cancel';
		// 	}				
		// }

		// echo '<pre>';
		// print_r($data_trans['data']);
		// print_r($data_sub['data']);
		// echo '</pre>';
		// exit();

        // $this->load->view('farm/sub_list_view', $data);
        $this->load->view('farm/sub_list_view');
	}
	
	public function sub_refuse()
	{		
 		$time = date('YmdHis');
		$data_sub = array(
			'order_status' => '6',				
			'admin_acc' => $this->session->userdata['user_id'],
			'order_dist_name' => $this->session->userdata['user_display_name'],
			'last_modified_time' => $time
		);
		$response_sub = $this->orders_model->update_sub(array('trans_num' => $this->input->post('id')), $data_sub);

		if ($response_sub)
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

	public function subload_level_one()
	{
		//一頁資料筆數
		$recordPerPage = 2;	

		//當前頁數
		$record = $this->input->get('page');
		$current_page = $this->input->get('page');

		//增加日期 通路商搜尋
		$start_date = $this->input->get('s_start_date');
		$end_date = $this->input->get('s_end_date');
		$product_name = $this->input->get('product_name');

		$datasub['current_page'] = $record;
		$datasub['s_start_date'] = $start_date;
		$datasub['s_end_date'] = $end_date;
		$datasub['product_name'] = $product_name;

		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  
				
		$sel_array = [];
		$sel_array['record'] = $record;
		$sel_array['current_page'] = $current_page;
		$sel_array['recordPerPage'] = $recordPerPage;
		$sel_array['start_date'] = $start_date;
		$sel_array['end_date'] = $end_date;
		$sel_array['product_name'] = $product_name;
		$sel_array['farm_acc'] = $this->session->userdata['user_id'];

		if($current_page =='' OR $sel_array['start_date'] =='' 
			OR $sel_array['end_date'] =='' OR $sel_array['farm_acc'] =='')
		{
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}
		$datasub['total_count'] = $this->trans_model->get_all_data_sub_count($sel_array);

		$datasub['datalist'] = $this->trans_model->get_all_sub_data_level_one($sel_array);

		//比對資料，農場若已下標出現提示，已下標，並不可下標
		foreach ($datasub['datalist'] as $key => $value)
		{
			$datasub['datalist'][$key]->shipping_cycle = mb_split(",",$datasub['datalist'][$key]->shipping_cycle); 
		}

		if ($datasub)
		{
			$datasub['sys_status'] = TRUE;
			$datasub['sys_code'] = '200';
			$datasub['sys_msg'] = '資料處理完成';
			echo json_encode($datasub);			
			exit();
		}else{
			$datasub['sys_status'] = FALSE;
			$datasub['sys_code'] = '500';
			$datasub['sys_msg'] = '資料未知錯誤';
			echo json_encode($datasub);			
			exit();
		}			
	}

	public function subload_level_two()
	{	
		//一頁資料筆數
		$recordPerPage = 2;	

		//當前頁數
		$record = $this->input->get('page');
		$current_page = $this->input->get('page');
		$datasub['current_page'] = $record;

		//增加日期 通路商搜尋
		$start_date = $this->input->get('s_start_date');
		$end_date = $this->input->get('s_end_date');
		$product_name = $this->input->get('product_name');
		$order_num = $this->input->get('order_num');

		$datasub['current_page'] = $record;
		$datasub['s_start_date'] = $start_date;
		$datasub['s_end_date'] = $end_date;
		$datasub['product_name'] = $product_name;
		$datasub['order_num'] = $order_num;

		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  		

		$sel_array = [];
		$sel_array['record'] = $record;
		$sel_array['current_page'] = $current_page;
		$sel_array['recordPerPage'] = $recordPerPage;
		$sel_array['start_date'] = $start_date;
		$sel_array['end_date'] = $end_date;
		$sel_array['product_name'] = $product_name;
		$sel_array['order_num'] = $order_num;

		$sel_array['farm_acc'] = $this->session->userdata['user_id'];

		if($order_num =='' OR $current_page =='' OR $sel_array['start_date'] =='' 
			OR $sel_array['end_date'] =='' OR $sel_array['farm_acc'] =='')
		{
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}
		
		// echo '<pre>';
		// print_r($sel_array);
		// echo '</pre>';
		// exit();

		$datasub['total_count'] = $this->trans_model->get_all_data_sub_count($sel_array);

		$datasub['datalist'] = $this->trans_model->get_all_sub_data_level_two($sel_array);

		//比對資料，農場若已下標出現提示，已下標，並不可下標
		foreach ($datasub['datalist'] as $key => $value)
		{
			$datasub['datalist'][$key]->alert = ''; 
			$datasub['datalist'][$key]->btn = ''; 
			$datasub['datalist'][$key]->order_subscript_num = (isset($datasub['datalist'][$key]->order_subscript_num))?$datasub['datalist'][$key]->order_subscript_num: 0 ;
			$datasub['datalist'][$key]->product_price = (isset($datasub['datalist'][$key]->product_price))?$datasub['datalist'][$key]->product_price: 0 ;

			//下標總價 = 下標數量 * 產品單價
			$datasub['datalist'][$key]->order_subscript_total = $datasub['datalist'][$key]->order_subscript_num	* $datasub['datalist'][$key]->product_price;			
			
			$datasub['datalist'][$key]->shipping_cycle = mb_split(",",$datasub['datalist'][$key]->shipping_cycle); 
			if($datasub['datalist'][$key]->sub_cycle !==''){
				$datasub['datalist'][$key]->sub_cycle = mb_split(",",$datasub['datalist'][$key]->sub_cycle); 
			}else{
				$datasub['datalist'][$key]->sub_cycle ='';
			}

			//得標狀態，顯示取消交易btn
			if($datasub['datalist'][$key]->order_status == '2')
			{
				$datasub['datalist'][$key]->alert = $this->lang->line('trans_cancel');
				$datasub['datalist'][$key]->btn = 'trans_cancel';
			}
			
			$datasub['datalist'][$key]->order_status = $this->config->item('order_status')[$this->session->userdata('lang')][$datasub['datalist'][$key]->order_status];				
		}

		if ($datasub)
		{
			$datasub['sys_status'] = TRUE;
			$datasub['sys_code'] = '200';
			$datasub['sys_msg'] = '資料處理完成';
			echo json_encode($datasub);			
			exit();
		}
		else
		{
			$datasub['sys_status'] = FALSE;
			$datasub['sys_code'] = '500';
			$datasub['sys_msg'] = '資料未知錯誤';
			echo json_encode($datasub);			
			exit();
		}	
	}
}
