<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		// echo $this->db->last_query();    
		// exit();
		
		// echo '<pre>';
		// print_r($sel_array);
		// echo '</pre>';
		// exit();
	}

	public function get_all_data()
	{
		$this->db->from('orders');
		$this->db->where('order_status !=','0');
		$this->db->order_by('last_modified_time desc');
		$query=$this->db->get();
		return $query->result();
	}

	public function get_by_oid($oid)
	{
		$this->db->from('orders');
		$this->db->select('order_num,order_dist,product_name,spec_format,product_unit,product_price,shipping_total');
		$this->db->where('order_num',$oid);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_data_orders($sel_array)
	{
		$this->db->from('orders');
		$this->db->select('order_num,order_dist,product_name,order_status,product_price,product_unit,
		shipping_total,remark,spec_format,shipping_cycle,start_date,end_date,last_modified_time');
		$order_status = array('1', '2', '7');
		$this->db->where_in('order_status', $order_status);
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if ($sel_array['dist'] !== ""){
			$this->db->like('order_dist', $sel_array['dist']); 
		}
		$this->db->limit($sel_array['recordPerPage'],$sel_array['record']); 
		$this->db->order_by('last_modified_time desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_sub_data_level_one($sel_array)
	{
		$this->db->from('subscript');
		$this->db->select('order_num,product_name,start_date,end_date,shipping_cycle,last_modified_time');
		$this->db->where('order_subscript_acc',$sel_array['farm_acc']);
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if ($sel_array['product_name'] !== ""){
			$this->db->like('product_name', $sel_array['product_name']); 
		}
		$this->db->limit($sel_array['recordPerPage'],$sel_array['record']); 
		$this->db->order_by('last_modified_time desc');
		$query = $this->db->get();	
		return $query->result();
	}

	public function get_all_sub_data_level_two($sel_array)
	{
		$this->db->from('subscript');
		$this->db->select('order_num,trans_num,product_name,product_price,order_subscript,order_status,order_subscript_num,
		shipping_total,shipping_cycle,sub_cycle,start_date,end_date,last_modified_time');
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_subscript_acc',$sel_array['farm_acc']);
		}
		$this->db->where('order_num',$sel_array['order_num']);
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if ($sel_array['product_name'] !== ""){
			$this->db->like('product_name', $sel_array['product_name']); 
		}
		$this->db->limit($sel_array['recordPerPage'],$sel_array['record']); 
		$this->db->order_by('last_modified_time desc');
		$query = $this->db->get();	
		return $query->result();
	}

	public function get_all_data_trans_count($sel_array) {
		$this->db->from('subscript');
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_subscript_acc',$sel_array['farm_acc']);
		}		
		if (isset($sel_array['order_num'])  AND $sel_array['order_num'] !== ""){
			$this->db->where('order_num',$sel_array['order_num']);
		} 
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if (isset($sel_array['product_name']) AND $sel_array['product_name'] !== ""){
			$this->db->like('product_name', $sel_array['product_name']); 
		} 
		$query = $this->db->get();	
		// echo $this->db->last_query();    
		// exit();
		return $query->num_rows();
		// return $this->db->count_all('trans_list');
  	}

	public function get_all_data_sub_count($sel_array) {   

		$this->db->from('subscript');
		$this->db->where('order_subscript_acc',$sel_array['farm_acc']);
		if (isset($sel_array['order_num'])  AND $sel_array['order_num'] !== ""){
			$this->db->where('order_num',$sel_array['order_num']);
		} 
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if ($sel_array['product_name'] !== ""){
			$this->db->like('product_name', $sel_array['product_name']); 
		} 
		$query = $this->db->get();	
		return $query->num_rows();
  	}

	  
	public function get_all_data_sub()
	{
		$this->db->from('orders');
		$this->db->where('order_status !=','0');
		$this->db->order_by('last_modified_time desc');
		$query=$this->db->get();
		return $query->result();
	}
		
	public function get_by_id_subacc($order_subscript_acc)
	{
		$this->db->from('subscript');
		$this->db->select('order_num,trans_num,product_name,order_subscript,order_status,order_subscript_num,shipping_total,shipping_cycle,start_date,end_date,last_modified_time');
		// $this->db->select_max('last_modified_time'); 
		$this->db->where('order_subscript_acc = ',$order_subscript_acc);
		$this->db->order_by('last_modified_time', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function add_subscript($data)
	{
		$this->db->insert('subscript', $data);
		return $this->db->insert_id();
	}

	public function add_trans_list($data)
	{
		$this->db->insert('trans_list', $data);
		return $this->db->insert_id();
	}

	// public function get_all_data_trans()
	// {
	// 	$this->db->from('trans_list');
	// 	// $this->db->where('order_status !=','0');
	// 	$this->db->order_by('last_modified_time desc');
	// 	$query=$this->db->get();
	// 	return $query->result();
	// }

	// public function get_by_oid_farmid($oid,$farmid)
	// {
	// 	$this->db->from('trans_list');
	// 	$this->db->where('order_num',$oid);
	// 	$this->db->where('order_subscript',$farmid);
	// 	$query = $this->db->get();
	// 	return $query->row();
	// }

	// public function update($where, $data)
	// {
	// 	$this->db->update('trans_list', $data, $where);
	// 	return $this->db->affected_rows();
	// }
	
	//    $allcount = $this->db->count_all('posts');
    //     $this->db->limit($rowperpage, $rowno);
    //     $users_record = $this->db->get('posts')->result_array();
}
