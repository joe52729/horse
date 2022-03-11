<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model
{

	var $table = 'orders';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		// echo $this->db->last_query();
		// exit();
	}

	public function get_all_data($sel_array)
	{
		$this->db->from('orders');
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_dist_acc',$sel_array['dist_acc']);
		}	
		// 訂單編號 v
		// 產品名稱 v
		// 規格 v
		// 產品單位 v
		// 單價 v
		// 每日需求數量 v
		// 總價 shipping_total * product_price
		// 訂單狀態 v
		
		$this->db->select('order_num,order_dist,product_name,order_status,product_price,product_unit,
		shipping_total,remark,spec_format,shipping_cycle,start_date,end_date,last_modified_time');
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if ($sel_array['product_name'] !== ""){
			$this->db->like('product_name', $sel_array['product_name']); 
		} 
		$this->db->limit($sel_array['recordPerPage'],$sel_array['record']); 
		$this->db->order_by('last_modified_time desc');
		$query=$this->db->get();	
		// echo $this->db->last_query();
		// exit();
		return $query->result();
	}

	public function get_all_data_order_count($sel_array) {
		$this->db->from('orders');
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_dist_acc',$sel_array['dist_acc']);
		}			
		$condition = "start_date BETWEEN " . "'" . $sel_array['start_date'] . "'" . " AND " . "'" . $sel_array['end_date'] . "'";
		$this->db->where($condition);
		if ($sel_array['product_name'] !== ""){
			$this->db->like('product_name', $sel_array['product_name']); 
		} 
		$query = $this->db->get();	
		return $query->num_rows();
		// return $this->db->count_all('trans_list');
  	}

	public function get_all_sub_data()
	{
		$this->db->from('subscript');
		$this->db->select('order_num,trans_num,product_name,product_price,product_unit,
			order_subscript,order_status,order_subscript_num,shipping_total,shipping_cycle,
			start_date,end_date,last_modified_time,order_dist_remark');
		$order_status = array('2', '3', '6','7');
		$this->db->where_in('order_status', $order_status);	
		$this->db->order_by('last_modified_time desc');		
		$query = $this->db->get();	
		return $query->result();
	}


	public function get_all_sub_data_level_one($sel_array)
	{
		$this->db->from('subscript');
		// $this->db->where('order_dist_acc',$sel_array['dist_acc']);
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_dist_acc',$sel_array['dist_acc']);
		}
		$this->db->select('order_num,product_name,start_date,end_date,shipping_cycle,last_modified_time');
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
		$this->db->where('order_dist_acc',$sel_array['dist_acc']);
		$this->db->select('order_num,trans_num,product_name,order_subscript,order_status,order_subscript_num,
		shipping_total,shipping_cycle,sub_cycle,start_date,end_date,last_modified_time');
		// $this->db->where('order_subscript_acc',$sel_array['farm_acc']);
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_dist_acc',$sel_array['dist_acc']);
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

	public function get_all_data_sub_count($sel_array) {   

		$this->db->from('subscript');
		if ($this->session->userdata['user_type'] !== "admin"){
			$this->db->where('order_dist_acc',$sel_array['dist_acc']);
		}			
		// $this->db->where('order_subscript_acc',$sel_array['farm_acc']);
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

	public function update_sub($where, $data)
	{
		$this->db->update('subscript', $data, $where);
		return $this->db->affected_rows();
	}	

	public function get_by_id($id)
	{
		$this->db->from('orders');
		$this->db->where('order_num',$id);
		$query = $this->db->get();	
		return $query->row();
	}
	
	public function get_by_sub_id($id)
	{
		$this->db->from('subscript');
		$this->db->where('trans_num',$id);
		$query = $this->db->get();	
		return $query->row();
	}

	public function add($data)
	{
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// exit;
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update('orders', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($oid)
	{
		$this->db->where('order_num', $oid);
		$this->db->delete('orders');
		return $this->db->affected_rows();
	}
}
