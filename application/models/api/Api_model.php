<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
	// exit();

	public function model_curl($api="", $data) 
	{
		$url = $this->config->item('api_url')[$this->session->userdata('lang')]['user_center'];
		// $ch = curl_init($url.$api);        
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url.$api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));

		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);

		return json_decode($output);
		// return $output;
	}

	public function login($email,$pass,$data)
	{
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('password', $pass);
		$query = $this->db->get();
		if(isset($query->row()->email)){
			$update = $this->db->update('users', $data, array('email' => $email,'password' => $pass));
			$update = $this->db->affected_rows();
			return $query->row();
		}else{
			return false;
		}	
	}

	//產品訂單規格
	/**
	 * 	@param String|Number $order_num
	 */
	public function order_spec($order_num)
	{
		$this->db->from('orders');
		$this->db->select('scientific_id,variety,shipping_cycle,start_date,end_date,check_level,remark,spec_format');
		$this->db->where('order_status !=','0');
		$this->db->where('order_num = ',$order_num);
		$this->db->order_by('last_modified_time desc');
		$query=$this->db->get();
		return $query->result();
	}

	//通路商資料
	public function get_all_dist_data()
	{
		$this->db->from('audit_company');
		$this->db->select('company_id,title');
		$this->db->where('type', 'dist');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result();
	}

	//列出table所有欄位，去除id，且全部轉為空值
	public function fields_select($table)
	{
		$fields = $this->db->list_fields($table);
		$fields = array_flip($fields);
		unset($fields['id']);
		foreach( $fields as $key => $value){
			if($value){
				$fields[$key] = '';
			}
		}
		return $fields;
	}

	//列出table現有欄位，並自動對應，餵入資料
	public function fields_exits_sort($data,$table)
	{		
		$save_data = [];
		foreach ($data as $field => $value)
		{
		//    echo $field.'  '.$value;
		//    echo '<br>';
		   if ($this->db->field_exists($field,$table)){
				$save_data[$field] = $value;
		   }
		}
		return $save_data;
	}

	// 列出table所有的現有欄位，自動對應，餵入資料
	public function fields_exits_auto_input($data,$table)
	{	
		# 1.列出table所有欄位，去除id，且全部轉為空值	
		$fields = $this->db->list_fields($table);
		$fields = array_flip($fields);
		unset($fields['id']);
		foreach( $fields as $key => $value){
			if($value){
				$fields[$key] = '';
			}
		}

		# 2.列出table現有欄位，並自動對應，餵入資料
		$save_data = [];
		foreach ($data as $field => $value)
		{
		//    echo $field.'  '.$value;
		//    echo '<br>';
		   if ($this->db->field_exists($field,$table)){
				$save_data[$field] = $value;
		   }
		}
		
		# 3.合併
		$ouput = $save_data + $fields;

		return $ouput;
	}


	//PHP stdClass Object轉array  
	public function object_array($array) {  
		if(is_object($array)) {  
			$array = (array)$array;  
		} 
		if(is_array($array)) {  
			foreach($array as $key=>$value) {  
				$array[$key] = $this->object_array($value);  
			}  
		}  
		return $array;  
	}    

	//PHP實現根據陣列的值進行分組的方法
	public function array_val_chunk($array,$data_key){
		$result = array();
		foreach ($array as $key => $value) {
			$result[$value[$data_key]][] = $value;
		}
		$ret = array();
		foreach ($result as $key => $value) {
			array_push($ret, $value);
		}
		return $ret;
	}

	/**
	 * 陣列 轉 物件
	 *
	 * param array $arr 陣列
	 * return object
	*/
	public function array_to_object($arr) {
		if (gettype($arr) != 'array') {
			return;
		}
		foreach ($arr as $k => $v) {
			if (gettype($v) == 'array' || getType($v) == 'object') {
				$arr[$k] = $this->array_to_object($v);
			}
		}
	
		return (object)$arr;
	}
	
	/**
	 * 物件 轉 陣列
	 *
	 * param object $obj 物件
	 * return array
	*/
	public function object_to_array($obj) {
		$obj = (array)$obj;
		foreach ($obj as $k => $v) {
			if (gettype($v) == 'resource') {
				return;
			}
			if (gettype($v) == 'object' || gettype($v) == 'array') {
				$obj[$k] = $this->object_to_array($v);
			}
		}	
		return $obj;
	}

	public function get_chinese_weekday($datetime)
	{
		$weekday = date('w', strtotime($datetime));
		return ['日', '一', '二', '三', '四', '五', '六'][$weekday];
	}

	public function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d,w' ) 
	{

		$dates = array();
		$current = strtotime( $first );
		$last = strtotime( $last );
	
		while( $current <= $last ) {
			$dates[] = date( $format, $current);
			$current = strtotime( $step, $current );
		}
	
		return $dates;
	}

	//貨物 共通表
	public function add_goods($data)
	{
		$this->db->insert('goods', $data);
		// echo $this->db->last_query();
		// exit();		
		return $this->db->insert_id();
	}
}
