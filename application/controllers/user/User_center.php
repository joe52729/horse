<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_center extends CI_Controller {

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
		$this->load->library('session');
		$this->load->model('user/user_model');
		$this->load->view("public/layout");			
	}

	public function index()
	{
		$this->load->view('index_view');
	}

	public function login()
	{
        // $lang = $this->input->get('lang');
		// $_SESSION['lang'] = $lang;
        // $this->session->mark_as_temp('lang', 360);//86400 一天
		// redirect($_SERVER['HTTP_REFERER']);
        // $session_id = $this->session->session_id;		
        // echo $session_id.'<br>';
		// $this->session->set_userdata('item', 'value1111111');
		$account = $this->input->post('email');
		$password = $this->input->post('password');
		$time = date('YmdHis');

		$data = array(
			'status' =>'2',//0 停權 1開通 2登入中
			'login_from' =>'1',
			'last_modified_time' => $time,
			'expire_time' => '',
		);
		// $data = $this->input->post(NULL , TRUE);
		 
		// echo json_encode(array('msg' => $this->input->post('password')));
		// exit();

		$response = $this->user_model->login($account,$password,$data);
		// echo $this->session->userdata('login').'_1<br>';
		$this->session->unset_userdata('login');
		// echo $this->session->userdata('login').'_2';
		if ($response)
		{
			echo json_encode(array('status' => 'T'));
			$this->session->set_userdata('login',$account);
			$this->session->mark_as_temp('login', 300);//86400 一天			
			exit();
		}
		else
		{
			// echo json_encode(array('msg' => 'Fail'));
			echo json_encode(array('status' => 'F'));
			exit();
		}	
	}

	public function logout()
	{
        // $lang = $this->input->get('lang');
		// $_SESSION['lang'] = $lang;
        // $this->session->mark_as_temp('lang', 360);//86400 一天
		// redirect($_SERVER['HTTP_REFERER']);
        // $session_id = $this->session->session_id;		
        // echo $session_id.'<br>';
        // $this->session->set_userdata('item', 'value1111111');
	}
}
