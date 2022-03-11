<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_list extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('farm/trans_model');
		$this->load->view("public/layout");	 
		// echo '<pre>';
		// print_r($data_trans['data']);
		// print_r($data_sub['data']);
		// echo '</pre>';
		// exit();	
	}
	
	public function index()
	{
		$this->load->view('farm/trans_list_view');
	}

	// status
	//審核中(0)、上架中(1)、已得標(2)（農場跟通路確認交易，不再對外開放）、取消交易(3)、
	//已下架(可重新審核上架)(4)、拒絕(5)、取消交易(farm)(6)
	public function transload($record=0)
	{
		//一頁資料筆數
		$recordPerPage = 2;	

		//當前頁數
		$record = $this->input->get('page');
		$current_page = $this->input->get('page');
		$data_trans['current_page'] = $record;

		//增加日期 通路商搜尋
		$start_date = $this->input->get('s_start_date');
		$end_date = $this->input->get('s_end_date');
		$dist = $this->input->get('s_dist');

		if($record != 0){
			$record = ($record-1) * $recordPerPage;
		}  

		$sel_array = [];
		$sel_array['record'] = $record;
		$sel_array['current_page'] = $record;
		$sel_array['recordPerPage'] = $recordPerPage;
		$sel_array['start_date'] = $start_date;
		$sel_array['end_date'] = $end_date;
		$sel_array['dist'] = $dist;
		$sel_array['farm_acc'] = $this->session->userdata['user_id'];

		$data_trans['total_count'] = $this->trans_model->get_all_data_trans_count($sel_array);

		if($current_page =='' OR $sel_array['start_date'] =='' OR $sel_array['end_date'] =='')
		{
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}

		$data_trans['datalist'] = $this->trans_model->get_all_data_orders($sel_array);
		$data_sub['datalist'] = $this->trans_model->get_by_id_subacc($sel_array['farm_acc']);

		if(count($data_trans['datalist']) == 0){
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}

		//比對資料，農場若已下標出現提示，已下標，並不可下標
		// 訂單狀態(代碼) ：審核中(0)、上架中(1)、已得標(2)(農場跟通路確認交易，不再對外開放)、取消交易(3)
		// 、已下架(可重新審核上架)(4)、拒絕\退回(5)、取消交易(farm)(6)、下標中(7)
		foreach ($data_trans['datalist'] as $key => $value)
		{
			$data_trans['datalist'][$key]->alert = '';
			$data_trans['datalist'][$key]->trans_num = '';
			$data_trans['datalist'][$key]->order_subscript_num = '';
			$data_trans['datalist'][$key]->sub_status = ''; 
			$data_trans['datalist'][$key]->shipping_cycle = mb_split(",",$data_trans['datalist'][$key]->shipping_cycle); 
			foreach ($data_sub['datalist'] as $k => $v)
			{
				if($data_sub['datalist'][$k]->order_num == $data_trans['datalist'][$key]->order_num)
				{
					switch ($data_sub['datalist'][$k]->order_status)
					{
						case '3':
							$data_trans['datalist'][$key]->alert = $this->lang->line('distributors').$this->lang->line('trans_cancel');
						break;  
					}
					$data_trans['datalist'][$key]->trans_num = $data_sub['datalist'][$k]->trans_num;
					$data_trans['datalist'][$key]->last_modified_time = $data_sub['datalist'][$k]->last_modified_time;
					$data_trans['datalist'][$key]->order_subscript_num = $data_sub['datalist'][$k]->order_subscript_num;
					$data_trans['datalist'][$key]->sub_status = $data_sub['datalist'][$k]->order_status;								
				} 	

				if($data_sub['datalist'][$k]->order_subscript !== $this->session->userdata['user_company_id'])
				{
					$data_trans['datalist'][$key]->alert = '';
				}else{
					$data_trans['datalist'][$key]->alert = '1';
				}			
			}		
			if(
				$data_trans['datalist'][$key]->order_status =='1' AND ($data_trans['datalist'][$key]->alert !=='')
			){
				$data_trans['datalist'][$key]->alert = FALSE;
			}else{
				$data_trans['datalist'][$key]->alert = TRUE;
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
}
