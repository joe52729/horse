<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Audit_model extends CI_Model
{

	var $table_user = 'audit_user';
	var $table_company = 'audit_company';
	var $table_order = 'orders';

	// echo $this->db->last_query();
	// echo '<pre>';
	// print_r($query->result());
	// echo '</pre>';
	// exit();

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_data()
	{
		$this->db->from('audit_user');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_data_company($id)
	{
		$this->db->from('audit_company');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_company_data()
	{
		$this->db->select('id ,title');
		$this->db->from('audit_company');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_dist_data()
	{
		$this->db->from('audit_company');
		$this->db->where('type', 'dist');
		$query = $this->db->get();
		return $query->result();
	}	

	public function get_all_farm_data()
	{
		$this->db->from('audit_company');
		$this->db->where('type', 'farm');
		$query = $this->db->get();
		return $query->result();
	}	

	//admin audit
	public function get_all_order_data()
	{
		$this->db->from('orders');
		$this->db->where('order_status', '0');
		$this->db->or_where('order_status', '3'); 
		$this->db->or_where('order_status', '5'); 
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_farm_acc_data()
	{
		$this->db->from('audit_user');
		$this->db->where('type', 'farm');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_dist_acc_data()
	{
		$this->db->from('audit_user');
		$this->db->where('type', 'dist');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->from('audit_user');
		$this->db->where('order_num', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_audit_user_id($id)
	{
		$this->db->from('audit_user');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function audit_orders($where, $data)
	{
		$this->db->update('orders', $data, $where);
		return $this->db->affected_rows();
	}

	public function add($data)
	{
		$this->db->insert('audit_user', $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update('audit_user', $data, $where);
		// echo $this->db->last_query();
		// exit();
		return $this->db->affected_rows();
	}

	public function add_company($data)
	{
		$this->db->insert('audit_company', $data);
		return $this->db->insert_id();
	}

	public function update_company($where, $data)
	{
		$this->db->update('audit_company', $data, $where);
		// echo $this->db->last_query();
		// exit();
		return $this->db->affected_rows();
	}

	public function get_by_audit_company_id($id)
	{
		$this->db->from('audit_company');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function add_formal_user($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update_formal_user($where, $data)
	{
		$this->db->update('users', $data, $where);
		// echo $this->db->last_query();
		// exit();
		return $this->db->affected_rows();
	}
}
