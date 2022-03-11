<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{

	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('common/CRUD');
	}
    public function product_list($id){  //需用result() 結果陣列
        $query = $this->CRUD->read('product','member_id',$id);
        return $query;
    }
    public function product_add($data){
        $res = $this->CRUD->create('product',$data);
        if ($res != 0 ){
            return $res = 1 ; 
        }else{
            return $res = 0 ; 
        }    
     }
     public function get_pSN($member_id){
         $query = $this->CRUD->read('product','member_id',$member_id);
         return $query;
     }
     public function get_prod_bySN($p_sn){
         $query = $this->CRUD->read('product','p_sn',$p_sn);
            //return $query->row() ;}

             return $query->row_array();
     }
     public function alter_product($data){
         $p_sn = $data['p_sn'];
        $res = $this->CRUD->correction('product','p_sn',$p_sn,$data);
        return $res!=0? 'T' : 'F' ;
      
     }
    public function remove_product($data){
        $column = $data['column'];
        $table = $data['table'];
        $condition = $data['p_sn'];
        $res = $this->CRUD->remove($table,$column,$condition);
        return $res;
    }
    public function get_all_product(){
        $items = $this->CRUD->read_all('product');
        return $items;
    }
}
?>
