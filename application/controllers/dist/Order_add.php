<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_add extends CI_Controller {

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
		$this->load->model('admin/admin_set_model');
		$this->load->view("public/layout");	 	
	}

	public function index()
	{
		$data['spec_format_list']=$this->admin_set_model->get_all_format_on();
		$this->load->view('dist/order_add_view',$data);
	}
		
	public function add()
	{		
		//ord php內置
		$num = 'ORD'.date('YmdHi').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 5);

		$check = $this->input->post('shipping_cycle');
		// $checks_value = implode(",",$this->input->post('shipping_cycle'));
		// $checks_value = "";
		// foreach($check as $key => $value){
		// 	if($key == 0 ){
		// 		$checks_value =  $value ;
		// 	}else{
		// 		$checks_value = $checks_value. "," .$value;				
		// 	}
 		// }
 		// // echo $checks_value.'_test';
 		// exit;
 		$time = date('YmdHis');
		$data = array(
			'order_num' => $num,
			'order_billing' => $time,
			'order_dist' => $this->session->userdata['user_company'],
			'order_dist_acc' => $this->session->userdata['user_id'], //ex通路商帳號.Ａ.全聯Pxmart Ｂ.costco
			'order_dist_name' => $this->session->userdata['user_display_name'], //farm acc
			'order_status' => '0',//狀態 0新單 				
			'product_name' => $this->input->post('product_name'),
			'spec_size' => $this->input->post('spec_size'),
			'spec_weight' => $this->input->post('spec_weight'),
			// 'spec_g_pack' => $this->input->post('spec_g_pack'),
			'shipping_total' => $this->input->post('shipping_total'),
			'shipping_cycle' => implode(",",$this->input->post('shipping_cycle')),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'save_time' => $time,
			'last_modified_time' => $time
		);
		// $data = $this->input->post(NULL , TRUE);
		 
		$response = $this->orders_model->add($data);

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
		// $insert = $this->goods_model->book_add($data);
		// echo json_encode(array("status" => TRUE));
	}
}
