<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct()
	{
        parent::__construct();  //待修改
		$this->load->helper('url');
		$this->load->model('product/Product_model');
		$this->load->model('admin/admin_set_model');
		$this->load->model('user/user_model');
        $this->load->view("public/layout");
        $this->load->library('cart');
	}

    public function index(){
        if( $this->user_model->check_session() != 0){
			$this->load->view('index/view');
			}else{				
				 echo '請先登入';
				 echo "<br>";
				 echo "<a href=http://localhost:8888/ulife/index/login>前往登入</a>";
			}	
    }
    public function goods(){
        $this->load->view('goods/goods_view');
    }
    public function show_goods(){
        $prod = $this->Product_model->get_all_product();
        $goods =$prod->result();
        echo json_encode($goods);
		exit();
    }
    public function good_detail($info){
        $this->load->view('goods/goods_detail',$info);
    }
    public function get_by_pSN(){
        $psn=$this->input->get('psn');
		$data = $this->Product_model->get_prod_bySN($psn);
        $this->good_detail($data); 
        // echo json_encode($data);
        // exit;
    }

    public function add_cart(){
        $psn = $this->input->post('p_sn');
        $amount = $this->input->post('quantity');
        if(empty($psn) && empty($psn)){
            $amount = $this->input->get('quantity');
            $psn = $this->input->get('p_sn');}
        $prod_info = $this->Product_model->get_prod_bySN($psn);
        $price = $prod_info['p_price'];
        $name = $prod_info['p_name'];
        $owner_id = $prod_info['member_id'];
        $owner_name = $prod_info['member_name'];
        $id = $prod_info['p_sn'];
        $datetime = date("Y-m-d H:i:s");
        $cartSN = mktime( date("Y"), date("n"), date("j"),  date("H") , date("i"), date("s"));
        $data = array(
            'cart_sn' => $cartSN ,
            'member_id' => $_SESSION['m_id'],
            'member_account' => $_SESSION['m_account'],
            'product_sn' => $id,
            'amount' => $amount,
            'product_price' =>$price,
            'product_name' => $name,
            'product_owner_id' => $owner_id,
            'product_owner_name' => $owner_name,
            'date' => $datetime 
        );
        $res = $this->user_model->add_cart($data) ;
        echo $res>0? 'success' : 'failed' ;
        exit;
    }
    public function show_basket(){
        $this->load->view("user/cart_view");
    }
    public function query_cart(){
        $verify = $this->input->get('verify');
        $id = $_SESSION['m_id'];
        $data = $this->user_model->query_cart($id);
        $res = $data->result();
        if(!empty($verify)){
            echo json_encode($res);
            exit;
        }else{
            return $res ;
        }

    }
    public function remove_cart(){
        $cart_sn = $this->input->get('cart_sn');
        $res = $this->user_model->remove_cart($cart_sn) ;
        if($res = 1){
            $this->show_basket();
        }else{
        echo '資料邏輯錯誤' ;
        exit;
        }
    }
    public function count(){
        $data = $this->query_cart();
        $cost =0; //總價
        $count =0; //物品總數
        foreach($data as $ko){
            foreach($ko as $ki => $v){
                if($ki == 'amount'){
                    $count += $v ;
                    $tmp = $v ;
                }
                if($ki == 'product_price'){
                    $cost += $v * $tmp ; 
                }
            }
        }
        $data = array(
            'sum_item' => $count ,
            'sum_cost' => $cost 
        );
        echo json_encode($data);
        exit;
    }

}
?>