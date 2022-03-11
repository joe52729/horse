<?php
defined('BASEPATH') or exit('No direct script access allowed');

class subscript_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('dist/orders_model');
        $this->load->model('api/api_model');
        $this->load->model('farm/trans_model');
		$this->load->view("public/layout");	 	
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
    }

    public function index()
    {
		$res = $this->orders_model->get_all_sub_data();

		//資料物件轉陣列
		$res_array = $this->api_model->object_to_array($res);
		
		//資料陣列分組 依照傳入key 分組
		$res_array_obj = $this->api_model->array_val_chunk($res_array,'order_num');

		////資料陣列轉物件
		$data['data'] = $this->api_model->array_to_object($res_array_obj);
		
		// echo '<pre>';    
		// print_r($data['data']);       
		// echo '</pre>';  
		// exit();  

        $this->load->view('dist/subscript_list_view', $data);
    }

    // order_status
	// 審核中(0)、上架中(1)、已得標(2)(農場跟通路確認交易，不再對外開放)、取消交易(3)
	// 已下架(可重新審核上架)(4)、拒絕\退回(5)、取消交易(farm)(6)、下標中(7)、結案(10)
    public function sub_enable()
	{		


		// echo '<pre>';
		// print_r($this->input->post());
		// echo '</pre>';
		// exit;

		//更新下標紀錄表狀態
 		$time = date('YmdHis');
		$data = array(
			'order_status' => '2',				
			'order_dist_acc' => $this->session->userdata['user_id'],
			'order_dist_name' => $this->session->userdata['user_display_name'],
			'last_modified_time' => $time
		);
		// $response_sub = $this->orders_model->update_sub(array('trans_num' => $this->input->post('trans_num')), $data);
		
		//下標紀錄表資料
		$response_sub_data = $this->orders_model->get_by_sub_id($this->input->post('trans_num'));

		//通路商確認後須依農場下標週期分拆出貨單 
		//ex 出貨週期0610-0710期間，有多少星期一、三、五，就要分拆幾張出貨單，存入出貨單 至 出貨表
		//下標週期 分拆 出貨單 存入
		// 貨物狀態：
		// 出貨單分拆狀態(0)、確認出貨(1)、無法出貨(2)、修改出貨量(3)
		// 確認收貨(4)、無法收貨(5)、有退貨(6)		
		$trans_num = $this->input->post('trans_num');

		$response_daterange = $this->api_model->dateRange($response_sub_data->start_date,$response_sub_data->end_date);
		echo '<pre>';
		// print_r($response_sub_data);
		print_r($response_daterange);
		echo '</pre>';
		exit;
		$sub_cycle_arr = mb_split(",",$response_sub_data->sub_cycle);
		$goods_arr = [];
		$i = 1;
		foreach ($sub_cycle_arr as $key => $val){
			$goods_arr[$key]['goods_num'] = $trans_num.'_'.$i;
			$goods_arr[$key]['goods_status'] = '0';
			$goods_arr[$key]['trans_num'] = $this->input->post('trans_num'); //訂單號
			$goods_arr[$key]['order_dist_acc'] = $this->session->userdata['user_id'];
			$goods_arr[$key]['order_dist_name'] = $this->session->userdata['user_display_name'];
			$goods_arr[$key]['order_status'] = '2';		
			$goods_arr[$key]['order_dist'] = $response_sub_data->order_dist;
			$goods_arr[$key]['order_num'] = $response_sub_data->order_num; //訂單號
			$goods_arr[$key]['order_status'] = $response_sub_data->order_status;
			$goods_arr[$key]['spec_format'] = $response_sub_data->spec_format;
			$goods_arr[$key]['order_billing'] = $response_sub_data->order_billing;
			$goods_arr[$key]['order_subscript'] = $response_sub_data->order_subscript;
			$goods_arr[$key]['order_subscript_num'] = $response_sub_data->order_subscript_num;
			$goods_arr[$key]['order_subscript_acc'] = $response_sub_data->order_subscript_acc;
			$goods_arr[$key]['order_subscript_name'] = $response_sub_data->order_subscript_name;
			$goods_arr[$key]['sub_cycle'] = $response_sub_data->sub_cycle;
			$goods_arr[$key]['order_sub_remark'] = $response_sub_data->order_sub_remark;
			$goods_arr[$key]['product_name'] = $response_sub_data->product_name;
			$goods_arr[$key]['product_unit'] = $response_sub_data->product_unit;
			$goods_arr[$key]['product_price'] = $response_sub_data->product_price;
			$goods_arr[$key]['start_date'] = $response_sub_data->start_date;
			$goods_arr[$key]['end_date'] = $response_sub_data->end_date;
			$goods_arr[$key]['admin_acc'] = $response_sub_data->admin_acc;
			$goods_arr[$key]['admin_name'] = $response_sub_data->admin_name;
			$goods_arr[$key]['save_time'] = $time;
			$goods_arr[$key]['last_modified_time'] = $time;		
			// $response_goods[$key] = $this->api_model->add_goods($goods_arr[$key]);
			$i ++;
		}


		// echo '<pre>';
		// print_r($response_sub_data);
		// print_r($sub_cycle_arr);
		// echo '</pre>';
		// exit;

		//新增交易紀錄
		$data_trans = array(
			'order_num' => $this->input->post('order_num'), //訂單號
			'trans_num' => $this->input->post('trans_num'),
			'order_status' => '2',			
			'order_dist_acc' => $this->session->userdata['user_id'],
			'order_dist_name' => $this->session->userdata['user_display_name'],			
			'trans_billing' => $time,
			'save_time' => $time,
			'last_modified_time' => $time,
			'order_subscript_num' => $response_sub_data->order_subscript_num, //下標數量(每日需求數量)
			'sub_cycle' => $response_sub_data->sub_cycle, //下標週期
			'order_sub_remark' => $response_sub_data->order_sub_remark, //下標農場備註			
			'order_dist' => $response_sub_data->order_dist, 
			'order_billing' => $response_sub_data->order_billing,
			'shipping_total' => $response_sub_data->shipping_total,
			'start_date' => $response_sub_data->start_date,
			'end_date' => $response_sub_data->end_date,
			'order_dist_remark' => $response_sub_data->order_dist_remark,
			'scientific_id' => $response_sub_data->scientific_id,
			'variety' => $response_sub_data->variety,
			'check_level' => $response_sub_data->check_level,
			'product_name' => $response_sub_data->product_name,
			'product_unit' => $response_sub_data->product_price,
			'product_price' => $response_sub_data->product_price, 
			'spec_format' => $response_sub_data->spec_format,
			'shipping_cycle' => $response_sub_data->shipping_cycle,
			'order_subscript_acc' => $response_sub_data->order_subscript_acc, //farm acc
			'order_subscript_name' => $response_sub_data->order_subscript_name, //farm acc
			'order_subscript' => $response_sub_data->order_subscript
		);
		$response_trans_api = $this->api_model->fields_exits_auto_input($this->input->post() + $data_trans,'subscript');
		echo '<pre>';
		print_r($goods_arr);
		// print_r($response_sub_data);
		// print_r($sub_cycle_arr);
		// print_r($response_trans_api);
		echo '</pre>';
		exit;

		$response_trans = $this->trans_model->add_trans_list($response_trans_api);

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

	public function sub_refuse()
	{		
 		$time = date('YmdHis');
		$data_sub = array(
			'order_status' => '3',				
			'admin_acc' => $this->session->userdata['user_id'],
			'order_dist_name' => $this->session->userdata['user_display_name'],
			'last_modified_time' => $time
		);
		$response_sub = $this->orders_model->update_sub(array('trans_num' => $this->input->post('id')), $data_sub);
		$data = array(
			'order_status' => '0',				
			'admin_acc' => $this->session->userdata['user_id'],
			'order_dist_name' => $this->session->userdata['user_display_name'],
			'last_modified_time' => $time
		);		
		//取消交易 修改訂單狀態 admin 需重新審核才可以上架訂單 
		$response = $this->orders_model->update(array('order_num' => $this->input->post('oid')), $data);

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
		$sel_array['dist_acc'] = $this->session->userdata['user_id'];

		if($current_page =='' OR $sel_array['start_date'] =='' 
			OR $sel_array['end_date'] =='' OR $sel_array['dist_acc'] =='')
		{
			$data_false['sys_status'] = FALSE;
			$data_false['sys_code'] = '404';
			$data_false['sys_msg'] = '無資料';
			echo json_encode($data_false);			
			exit();
		}
		$datasub['total_count'] = $this->orders_model->get_all_data_sub_count($sel_array);

		// $res = $this->orders_model->get_all_sub_data();

		$datasub['datalist'] = $this->orders_model->get_all_sub_data_level_one($sel_array);

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

		$sel_array['dist_acc'] = $this->session->userdata['user_id'];

		if($order_num =='' OR $current_page =='' OR $sel_array['start_date'] =='' 
			OR $sel_array['end_date'] =='' OR $sel_array['dist_acc'] =='')
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

		$datasub['total_count'] = $this->orders_model->get_all_data_sub_count($sel_array);

		$datasub['datalist'] = $this->orders_model->get_all_sub_data_level_two($sel_array);

		//比對資料，農場若已下標出現提示，已下標，並不可下標
		foreach ($datasub['datalist'] as $key => $value)
		{
			$datasub['datalist'][$key]->alert = ''; 
			$datasub['datalist'][$key]->btn = ''; 
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
