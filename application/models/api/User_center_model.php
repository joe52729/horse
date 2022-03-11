<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_center_model extends CI_Model {
    function lang(){
        date_default_timezone_set("Asia/Taipei");
        unset($_SESSION['lang']);
        //語系轉換
        $browser_preset_lang = strtok($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',');
        $view_lang = $this->session->userdata('lang');
        if(isset($view_lang)){
          if($view_lang=='zh-TW'){
                $this->lang->load('general_tw_lang', 'tw');
                // $this->lang->load('general_cn_lang', 'cn');
            }else if($view_lang=='zh-CN'){
                $this->lang->load('general_cn_lang', 'cn');
                $this->session->set_userdata('lang',$browser_preset_lang);
            }
        }else{ 
            $this->session->set_userdata('lang','zh-TW');
            $this->lang->load('general_tw_lang', 'tw');
            if($browser_preset_lang=='zh-TW'){
                $this->session->set_userdata('lang',$browser_preset_lang);
                $this->lang->load('general_tw_lang', 'tw');
                // $this->lang->load('general_cn_lang', 'cn');//暫時用
                $view_lang = $browser_preset_lang;
                $this->session->mark_as_temp('lang', 86400);//86400 一天
            }
            if($browser_preset_lang=='zh-CN'){
                $this->session->set_userdata('lang',$browser_preset_lang);
                $this->lang->load('general_cn_lang', 'cn');
                $view_lang = $browser_preset_lang;
                $this->session->mark_as_temp('lang', 86400);//86400 一天
            }  
        }
    }

    function third_key(){
        $tp_id = $this->config->item('api_key')[$this->session->userdata('lang')]['tp_id'];
        $tp_pw = $this->config->item('api_key')[$this->session->userdata('lang')]['tp_pw'];
        $sk = date("Y").$tp_id.date("d").$tp_pw;
        return md5($sk);
    }
    
    // 確認目前狀況是否為登入
    function chk_status(){
        $this->load->library('curl');
        if($this->input->get('user_id') != "" && $this->input->get('token') != ""){
            $array = array(
				'user_id' => $_GET['user_id'],
				'token' => $_GET['token'],
			);
			$this->session->set_userdata($array);
        }

        if(isset($this->session->userdata['user_id']) && isset($this->session->userdata['token'])){
            $api = $this->config->item('api_url')[$this->session->userdata('lang')]['user_center'];
            $data['tp_id'] = $this->config->item('api_key')[$this->session->userdata('lang')]['tp_id'];
            $data['tp_key'] = $this->third_key();
            $data['user_id'] = $this->session->userdata['user_id'];
            $data['token'] = $this->session->userdata['token'];
            $res = $this->curl->api_curl($api.'api/chk_user_status','POST',$data);
            if(json_decode($res,TRUE)['sys_code'] == '200'){
                return TRUE;
            }else{
                redirect($this->config->item('api_url')[$this->session->userdata('lang')]['user_center'].'login?return_url='.base_url());
            }
        }else{
            redirect($this->config->item('api_url')[$this->session->userdata('lang')]['user_center'].'login?return_url='.base_url());
        }
    }

    function get_user_info(){
        $this->load->library('curl');
        $this->lang();
        $api = $this->config->item('api_url')[$this->session->userdata('lang')]['user_center'];
        $data['tp_id'] = $this->config->item('api_key')[$this->session->userdata('lang')]['tp_id'];
        $data['tp_key'] = $this->third_key();
        $data['user_id'] = $this->input->get('user_id');
        $data['token'] = $this->input->get('token');

        $res = $this->curl->api_curl($api.'api/get_user_info','POST',$data);
        $res = json_decode($res,TRUE);

        if($res['sys_code'] == '200'){
            return $res['data'];
        }else{
            return FALSE;
        }
    }
    
    

}