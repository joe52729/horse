<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_update extends CI_Controller {

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
		// $this->load->library('CryptAES'); 
		$this->load->view("public/layout");	 	
	}

	public function index($id)
	{
		$data['orders_data'] = $this->orders_model->get_by_id($id);	
		$data['format_list'] = $this->admin_set_model->get_all_format_on();		
		$this->load->view('dist/order_update_view',$data);
	}

	public function update()
	{		
		$check = $this->input->post('shipping_cycle');
		$checks_value = "";
		foreach($check as $value){
  			$checks_value = $checks_value. "," .$value;
  			// echo $checks_value;
 		}
		$time = date('YmdHi');
		$data = array(
			'order_status' => '1',
			//狀態 0取消(網站) 1審核(網站) 2上架(網站) 2更新(通路商) 3下標(農場) 4出貨(農場)	
			'product_name' => $this->input->post('product_name'),
			// 'spec_g_pack' => $this->input->post('spec_g_pack'),
			'spec_size' => $this->input->post('spec_size'),
			'spec_weight' => $this->input->post('spec_weight'),
			'shipping_total' => $this->input->post('shipping_total'),
			'shipping_cycle' => $checks_value,
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date'),
			'remark' => $this->input->post('remark'),
			'last_modified_time' => $time
		);
		$response = $this->orders_model->update(array('order_num' => $this->input->post('order_num')), $data);
		
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
