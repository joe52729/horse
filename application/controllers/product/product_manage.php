<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_manage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('product/Product_model');
		$this->load->model('admin/admin_set_model');
		$this->load->model('user/user_model');
		$this->load->view("public/layout");
	}

	public function index()
	{
		
		if( $this->user_model->check_session() != 0){
			$this->load->view('product/porductManage_view');
					
			}else{				
				 echo '請先登入';
				 echo "<br>";
				 echo "<a href=http://localhost:8888/ulife/index/login>前往登入</a>";
			}	
	}
	public function add_prod(){
		$this->load->view('product/product_add_view');
	}
	public function alter_product(){
		$p_SN = $this->input->get('p_sn');
		$data = $this->get_by_pSN($p_SN);
		$this->load->view('product/alter_product_view',$data);
	}
	public function order_del()
	{
		$response = $this->orders_model->delete_by_id($this->input->post('oid'));

		if ($response){
			echo json_encode(array('status' => 'T'));
			exit();
		}else{
			echo json_encode(array('status' => 'F'));
			exit();
		}	
	}
	public function product_add(){
		$ext = substr($_FILES['userImage']['type'],6,4);
		$name = $this->pic_namecode();
		$f_name = $name.'.'.$ext;
		$path = '/Applications/MAMP/htdocs/ulife/application/views/pics/'.$f_name; 
		//$name = empty($_FILES['userImage']['name'])?'null':$this->pic_namecode(); //測試內容
		move_uploaded_file($_FILES['userImage']['tmp_name'],$path);//$_FILE[表單名稱][需求內容]
		$type = $_FILES['userImage']['type'] ;
		$p_name = $this->input->post('prod_name');
		$p_price = $this->input->post('prod_price');
		$p_amount = $this->input->post('prod_amount');
		$p_descript = $this->input->post('prod_descript');
		$m_id = $_SESSION['m_id'];
		$m_name = $_SESSION['m_name'];
		$product_data = array(
			'p_name' => $p_name ,
			'p_price' => $p_price,
			'p_amount'=> $p_amount,
			'member_id' => $m_id,
			'member_name' => $m_name,
			'descript' => $p_descript,
			'pic_id' => $f_name,
			'pic_type' => $ext 
		);
		echo json_encode(print_r($product_data));
		exit;
	// 	 $res = $this ->Product_model->Product_add($product_data);
	//move_uploaded_file($_FILES['userImage']['tmp_name'],$path);//$_FILE[表單名稱][需求內容]
	// 	 if($res == 0){
	// 		echo json_encode(array('res'=>'失敗'));
	// 		 exit();
	// 	 }else{
	// 		 echo json_encode(array('res'=>'成功'));
	// 		 exit();
	// 	 }	
	}
	public function upload_pic(){
			$f_name= $_FILES['userImage']['name'];

			$path = '/Applications/MAMP/htdocs/ulife/application/views/pics/'.$_FILES['userImage']['type'] ; //必須在生命週期結束以前移動檔案
			move_uploaded_file($_FILES['userImage']['tmp_name'],$path);
			
		
			

			echo json_encode(array('res'=>$f_name));
			exit();
	}
	public function uptest(){
		$this->load->view('syst/systemTest_view');
	}

	
	public function get_prod($id){
		$prod = $this->Product_model->product_list($id) ;
		return $prod->result();
	}
	public function showProduct(){
		$data = $this->get_prod($_SESSION['m_id']);
		echo json_encode($data);
		exit();
	}
	public function get_by_pSN($p_SN){
		$data = $this->Product_model->get_prod_bySN($p_SN);
		return $data ; 
	}
	public function alter(){
		$ext = substr($_FILES['userImage']['type'],6,4);
		$name = $this->pic_namecode();
		$f_name = $name.'.'.$ext;
		$path = '/Applications/MAMP/htdocs/ulife/application/views/pics/'.$f_name; 
		move_uploaded_file($_FILES['userImage']['tmp_name'],$path);//$_FILE[表單名稱][需求內容]
		$data = array(
			'p_sn' => $this->input->post('prod_sn'),
			'p_name' =>$this->input->post('prod_name'),
			'p_price' =>$this->input->post('prod_price'),
			'descript' =>$this->input->post('prod_descript'),
			'p_amount' =>$this->input->post('prod_amount'),
			'member_id' => $_SESSION['m_id'],
			'member_name' => $_SESSION['m_name'],
			'pic_id' => $name,
			'pic_type' => $ext  
		);
	$res = $this->Product_model->alter_product($data);

	echo json_encode(array(
		'res' => $res ));
		exit();
	
	}
	public function remove_product(){
		$data = array(
			'p_sn' => $this->input->get('p_sn'),
			'table' => 'product' ,
			'column' => 'p_sn',
		);
		//echo print_r($data) ;
		$res = $this->Product_model->remove_product($data);  
		echo "<script> history.go(-1); </script>";
	}
	//避免圖片名稱碰撞所產生之unicode
	public function pic_namecode(){
		$newName = mktime( date("Y"), date("n"), date("j"),  date("H") , date("i"), date("s"));
		$a = rand(100,10000);
		return $newName.$a ;
	}
}