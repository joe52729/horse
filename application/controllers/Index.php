<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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
	 * 
	 * 
	 * 會員等級仍然在開發中
	 * 
	 * 
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('curl');
		$this->load->library('session');
		$this->load->model('user/user_model');
		$this->load->model('api/api_model');
		$this->load->model('api/user_center_model');
		
	}

	public function index()
	{
		
		if( $this->user_model->check_session() ){
		$this->load->view('public/index_layout');
		$this->load->view('index_view');
		}else{
			echo '請先登入';
			echo "<br>";
			echo "<a href=http://localhost:8888/ulife/index/login>前往登入</a>";
		}
	}
	public function get_IP(){
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else{
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		if($ip == '::1'){
			return '127.0.0.1';
		}else{
			return $ip;	
		}			 
	}
	public function register(){
		$this->load->view('register_view');
		$this->load->view('public/layout');
		
	}
	public function change_password_view(){
		if( $this->user_model->check_session() != 0){
			$this->load->view('changepwd_view');
			}else{
				
				 echo '請先登入';
				 echo "<br>";
				 echo "<a href=http://localhost:8888/ulife/index/login>前往登入</a>";
			}
	}
	public function change_password(){
		$account =  $_SESSION['m_account'];
		$old_pwd = $this->input->post('old_pwd');
		$new_pwd = $this->input->post('new_pwd');
		$check_new = $this->input->post('check_new_pwd');
		if($new_pwd === $check_new){
			$res = $this->getacc($account,$old_pwd);
				switch ($res){
					case 1 : 
						$data = array(
							'member_pwd' => $new_pwd
						);
						$this->user_model->change_pwd($account,$data); 
						echo json_encode(array('res' => '0'));//正確

						break;
					case 0 : 
						echo json_encode(array('res'=>'2'));//錯誤
						break;
				}
		}else{
			echo json_encode(array('res'=>'1')); //新舊密碼不符
		}
	}
	public function add_member(){ 
		$account = $this->input->post('acc');
		$name = $this->input->post('m_name');		
		$password = $this->input->post('pwd');
		$mail = $this->input->post('email');
		$phone = $this->input->post('phone');
		if($this->verify($account)==1 and $this->verify($name) == 1  and $this->verify($phone) == 1 ){
		if($account !== null || $password !== null || $mail !== null ||  $phone !== null ){
		$data = array(
			'member_id' => $this->auto_encode(),
			'member_lv' =>'0',  //目前會員等開發中,預設為零
			'member_account' => $account,
			'member_name' => $name,
			'member_pwd' => $password,
			'email' => $mail,
			'phone' => $phone	
		);
		$result =  $this->user_model->register($data);
		switch($result){
			case 0:
				echo json_encode(array('res'=>'註冊成功'));
				exit;
			break;
			case 1:
				echo json_encode(array('res'=>'帳號重複'));
				exit;
			break;
			}
		}else{
			echo json_encode(array('res'=>'請輸入完整資訊'));
			exit;
		}
		}else{
			echo json_encode(array('res'=>'請勿輸入特殊字符'));
			exit;
		}
	}
	public function login(){
		$this->load->view('login_view');
	}
	public function login_log(){
		$data = array(
			'member_id' => $_SESSION['m_id'],
			'member_name' => $_SESSION['m_name'],
			'IP' => $this->get_IP(),
			'login_time' => date("Y-m-d H:i:s")
		);
		$this->user_model->login_log($data);
	}
	

	public function logout(){
		$this->session->sess_destroy();
	}
	public function check_acc(){
		$account = $this->input->post('acc');		
		$password = $this->input->post('pwd');
		if($this ->verify($password) AND $this->verify($account) == 1){
			$res = $this->user_model->check_account($account,$password);		
		switch($res){
			case 0:
				echo json_encode(array('res'=>0)); //false
			break;
			case 1:
				echo json_encode(array('res'=>1)); //true
				$this->user_info($account);
				$this->login_log();
				
			break;
		}		
		}else{
			echo json_encode(array('res'=>0)); //false
		}
		
	}
	public function getacc($id,$pwd){
		return $this->user_model->check_account($id,$pwd);  //載入資料庫
	}
	public function user_info($account){
		$query = $this->user_model->get_user_info($account);
		$user_info = array(                           //使用者資訊存入陣列中
			'm_id' => $query->row()->member_id,
			'm_lv' => $query->row()->member_lv,
			'm_account' => $query->row()->member_account,
			'm_name' =>$query->row()->member_name,
			'm_pwd' => $query->row()->member_pwd,
			'm_email' => $query->row()->email,
			'm_phone' => $query->row()->phone
		);
		$this->session->set_userdata($user_info); //陣列加入session
	}
	public function info(){
		if( $this->user_model->check_session() ){
			$this ->load->view('user/info_view');  //個人資訊
			}else{
				echo '請先登入';
				echo "<br>";
				echo "<a href=http://localhost:8888/ulife/index/login>前往登入</a>";
			}
	}      
	public function auto_encode(){
		$font = microtime("now");
		return $font ;
	}
	public function atler_info(){
		$data = array(
			'member_id' => $this->input->post('m_id'),
			'member_name' => $this->input->post('m_name'),
			'email' => $this->input->post('m_mail'),
			'phone' => $this->input->post('m_phone')
		);
		if($this->verify($data['member_name']) == 1 and $this->verify($data['phone'] == 1)  ){
			$res = $this->user_model->atler_info($data);
			$this->user_info($_SESSION['m_account']);
			echo json_encode(array( 'res'=> $res ));
			exit();
		}else{
			echo json_encode(array('res'=> 2));
			exit();
		}

	}
	public function verify($data){ //僅可傳入單一變數進行驗證

		if(preg_match('/[\[\]\'^£$%&*()}{@#~?><>,|=+¬-]/',$data) ){ // preg_match 傳出 1 & 只可允許 _
			return 0 ; 
		}else{
			return 1 ; //OK
		}
	
	}
}