<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CRUD extends CI_Model
{

	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }
    /**
     *傳入的Data為多個項目時所使用的Array
     *where 是 條件
     *取出Query後依需求變更為row 或 result
     */
    
    public function read($from,$column,$where){ // select
        $this->db->from($from);
        $this->db->where($column,$where);
        $query = $this->db->get();
        return $query;  //回傳查詢結果
        // return $this->db->last_query();
    }

    public function create($table,$data){ //insert
        $this->db->insert($table,$data);
        $res = $this->db->affected_rows();
        return $res ; 
    }

    public function correction($from,$column,$where,$data){ //update
        $this->db->where($column,$where);
        $this->db->update($from,$data);
        //return $this->db->last_query();<debug用>
        return $this->db->affected_rows(); //影響列數
    }

    public function remove($from,$column,$condition){ //delete
        $this->db->where($column, $condition);
        $this->db->delete($from);
        return $this->db->affected_rows();
        // 產生：
        // DELETE FROM mytable
        // WHERE id = $id
    }
    public function read_all($table){

        $contents = $this->db->get($table);
        return $contents ;
    }
	
}
