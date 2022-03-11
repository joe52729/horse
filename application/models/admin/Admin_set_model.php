<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_set_model extends CI_Model
{

	var $table = 'size_set';
	var $table2 = 'weight_set';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_size()
	{
		$this->db->from('size_set')->order_by("last_modified_time", "desc");
		$query = $this->db->get();
		// echo '<pre>';
		// print_r($where);
		// echo '</pre>';
		// exit;
		return $query->result();
	}

	public function get_all_weight()
	{
		$this->db->from('weight_set')->order_by("last_modified_time", "desc");
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all_format()
	{
		$this->db->from('format_set')->order_by("last_modified_time", "desc");
		$query = $this->db->get();	
		return $query->result();
	}

	public function get_all_format_on()
	{
		$this->db->from('format_set');
		$this->db->select('id,title,length,weight,unit_l,unit_w,remark');
		$this->db->where('status','1');
		$query = $this->db->get();	
		return $query->result();
	}

	public function get_all_size_on()
	{
		$this->db->from('size_set');
		$this->db->select('id,title,length,unit');
		$this->db->where('status','1');
		$query = $this->db->get();	
		return $query->result();
	}

	public function get_all_weight_on()
	{
		$this->db->from('weight_set');
		$this->db->select('id,title,weight,unit');
		$this->db->where('status','1');
		$query = $this->db->get();	
		return $query->result();
	}

	public function get_by_format($id)
	{
		$this->db->from('format_set');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_size($id)
	{
		$this->db->from('size_set');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_weight($id)
	{
		$this->db->from('weight_set');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function add_size($data)
	{
		$this->db->insert('size_set', $data);
		return $this->db->insert_id();
	}

	public function add_weight($data)
	{
		$this->db->insert('weight_set', $data);
		return $this->db->insert_id();
	}

	public function update_size($where, $data)
	{
		$this->db->update('size_set', $data, $where);
		return $this->db->affected_rows();
	}

	public function update_weight($where, $data)
	{
		$this->db->update('weight_set', $data, $where);
		return $this->db->affected_rows();
	}

	// public function delete_by_id($id)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->delete($this->table);
	// }
}
