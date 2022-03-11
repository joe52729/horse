<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('common/CRUD');
	}
	public function get_all_data()
	{
		$this->db->from('audit_user');
		$query = $this->db->get();
		return $query->result();
	}

	public function register($data){
		$status = 0 ;
		if($data !== null){
		$query = $this->CRUD->read('member','member_account',$data['member_account']);
			$check=$query->row(); 
			if($check === null ){
				$this->CRUD->create('member',$data);
				return $status;}
					else{
						return $status = 1;
				}
			}
		}
	public function atler_info($data){
		$id= $data['member_id'];
		$res = $this->CRUD->correction('member','member_id',$id,$data);
		 return $res === 1? 1 : 0 ; ;	
	}




	public function change_pwd($account, $data) //修改密碼
		{
			$this->CRUD->correction('member','member_account',$account,$data);
	}
	public function check_session(){
		$account = $this->session->userdata('m_account');
		$session_status = 0; // session 已死
		if($account === null){
			return $session_status ;
		}else{
			return $session_status = 1; //session依然存活
		}
	}
	public function check_account($account,$pwd){
		$query = $this->CRUD->read('member','member_account',$account);
		$status = 0;  //登入狀態
		if($query->row() !== null){
			if($query->row()->member_pwd === $pwd){
				$status = 1;//帳密正確,可登入
				return ($status);
			}
		}else{
			return ($status); //帳號錯誤
		}
	}
	function get_user_info($account){
		$query=$this->CRUD->read('member','member_account',$account);
		return $query;
	}
	

	function get_all_company_user_id($id)
	{
		$this->db->from('users');
		$this->db->where('company_id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function login_log($data){
		$res = $this->CRUD->create('login_log',$data);
		return $res ;
	}
	public function user_uri_auth(){
		if ($this->uri->segment(1) === FALSE)
		{
			$auth = 0;
		}else{
			$auth = $this->uri->segment(1);
		}
		if($auth == $this->session->userdata['user_type']){
			echo $this->session->userdata['user_type'];
		}else{
			echo 'xxxxxxx';
			// redirect('/index/login', 'location', 302);
		}
		return $auth;
	}
	public function add_cart($data){
		$res = $this->CRUD->create('cart',$data);
		return $res ;
	}
	public function query_cart($member_id){
		 $res =  $this->CRUD->read('cart','member_id',$member_id);
		 return $res;
	}
	public function remove_cart($cart_sn){
		return $this->CRUD->remove('cart','cart_sn',$cart_sn);
		
	}

}



