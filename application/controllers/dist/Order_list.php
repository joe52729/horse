<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_list extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('dist/orders_model');
		$this->load->model('admin/admin_set_model');

		$this->load->view("public/layout");
	}

	public function index()
	{
		// $data['data'] = $this->orders_model->get_all_data();
		// $data_sub['data'] = $this->orders_model->get_all_sub_data();
		// // $data['size_data'] = $this->admin_set_model->get_all_size_on();
		// // $data['weight_data'] = $this->admin_set_model->get_all_weight_on();	
			
		// //比對資料，農場若已下標出現提示，已下標，並不可修改訂單，訂單狀態3，可修改訂單
		// foreach ($data['data'] as $key => $value)
		// {
		// 	$data['data'][$key]->alert = '';
		// 	$data['data'][$key]->trans_num = '';
		// 	foreach ($data_sub['data'] as $k => $v)
		// 	{
		// 		// if(($data_sub['data'][$k]->order_num == $data['data'][$key]->order_num)
		// 		// 	AND ($data_sub['data'][$k]->order_status !== '3')){
		// 		// 	$data['data'][$key]->alert = $this->lang->line('farm_subscripted');
		// 		// 	$data['data'][$key]->trans_num = $data_sub['data'][$k]->trans_num;
		// 		// }
		// 		if($data_sub['data'][$k]->order_num == $data['data'][$key]->order_num)
		// 		{
		// 			switch ($data_sub['data'][$k]->order_status)
		// 			{
		// 				case '1':
		// 					$data['data'][$key]->alert = $this->lang->line('subscripted');
		// 				case '2':
		// 					$data['data'][$key]->alert = $this->lang->line('subscripted');
		// 				case '3':
		// 					$data['data'][$key]->alert = $this->lang->line('sys_not_editable');
		// 				break;  
		// 				default:
		// 					$data['data'][$key]->trans_num = $data_sub['data'][$k]->trans_num;
		// 			}
		// 		} 				
		// 	}
		// 	// if($data['data'][$key]->order_status == '1')
		// 	// {
		// 	// 	$data['data'][$key]->alert = '';
		// 	// }			
		// }
		$data['data'] = [];
		$this->load->view('dist/order_list_view', $data);
	}

	public function order_del()
	{
		$response = $this->orders_model->delete_by_id($this->input->post('oid'));

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

	// status
	//審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)、
	//已下架(可重新審核上架)(4)、拒絕(5)、取消交易(farm)(6)
	public function orderload($record=0)
	{
		//一頁資料筆數
		$recordPerPage = 2;	

		//當前頁數
		$record = $this->input->get('page');
		$current_page = $this->input->get('page');
		$data_order['current_page'] = $record;

		//增加日期 通路商搜尋
		$start_date = $this->input->get('s_start_date');
		$end_date = $this->input->get('s_end_date');
		$product_name = $this->input->get('product_name');

		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  

		$sel_array = [];
		$sel_array['record'] = $record;
		$sel_array['current_page'] = $record;
		$sel_array['recordPerPage'] = $recordPerPage;
		$sel_array['start_date'] = $start_date;
		$sel_array['end_date'] = $end_date;
		$sel_array['product_name'] = $product_name;
		$sel_array['dist_acc'] = $this->session->userdata['user_id'];

		$data_order['total_count'] = $this->orders_model->get_all_data_order_count($sel_array);

		if($current_page =='' OR $sel_array['start_date'] =='' OR $sel_array['end_date'] =='')
		{
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}
		$data_order['datalist'] = $this->orders_model->get_all_data($sel_array);
		$data_sub['datalist'] = $this->orders_model->get_all_sub_data();

		// $data_order['datalist'] = $this->trans_model->get_all_data_orders($sel_array);
		// $data_sub['datalist'] = $this->trans_model->get_by_id_subacc($farm_acc);

		if(count($data_order['datalist']) == 0){
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}

		//比對資料，農場若已下標出現提示，已下標，並不可修改訂單，訂單狀態3，可修改訂單
		foreach ($data_order['datalist'] as $key => $value)
		{
			$data_order['datalist'][$key]->alert = '';
			$data_order['datalist'][$key]->trans_num = '';

			$data_order['datalist'][$key]->shipping_total = (isset($data_order['datalist'][$key]->shipping_total))?$data_order['datalist'][$key]->shipping_total: 0 ;
			$data_order['datalist'][$key]->product_price = (isset($data_order['datalist'][$key]->product_price))?$data_order['datalist'][$key]->product_price: 0 ;

			// 總價 order_total = shipping_total * product_price
			$data_order['datalist'][$key]->order_total = $data_order['datalist'][$key]->shipping_total	* $data_order['datalist'][$key]->product_price;						
			foreach ($data_sub['datalist'] as $k => $v)
			{
				// if(($data_sub['data'][$k]->order_num == $data['data'][$key]->order_num)
				// 	AND ($data_sub['data'][$k]->order_status !== '3')){
				// 	$data['data'][$key]->alert = $this->lang->line('farm_subscripted');
				// 	$data['data'][$key]->trans_num = $data_sub['data'][$k]->trans_num;
				// }
				if($data_sub['datalist'][$k]->order_num == $data_order['datalist'][$key]->order_num)
				{
					switch ($data_sub['datalist'][$k]->order_status)
					{
						case '1':
							$data_order['datalist'][$key]->alert = $this->lang->line('subscripted');
						case '2':
							$data_order['datalist'][$key]->alert = $this->lang->line('subscripted');
						case '3':
							$data_order['datalist'][$key]->alert = $this->lang->line('sys_not_editable');
						break;  
						default:
							$data_order['datalist'][$key]->trans_num = $data_sub['datalist'][$k]->trans_num;
					}
				} 				
			}
			// if($data['data'][$key]->order_status == '1')
			// {
			// 	$data['data'][$key]->alert = '';
			// }			
		}

		if ($data_order)
		{
			$data_order['sys_status'] = TRUE;
			$data_order['sys_code'] = '200';
			$data_order['sys_msg'] = '資料處理完成';
			echo json_encode($data_order);			
			exit();
		}
		else
		{
			$data_order['sys_status'] = FALSE;
			$data_order['sys_code'] = '500';
			$data_order['sys_msg'] = '資料未知錯誤';
			echo json_encode($data_order);			
			exit();
		}	
  	}
}
