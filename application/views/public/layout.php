<?php 
  defined('BASEPATH') OR exit('No direct script access allowed'); 
  date_default_timezone_set("Asia/Taipei");
  // unset($_SESSION['lang']);
  //語系轉換
  $browser_preset_lang = strtok($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',');
  $view_lang = $this->session->userdata('lang');
  if(isset($view_lang)){
    if($view_lang=='zh-TW'){
      $this->lang->load('general_tw_lang', 'tw');
      // $this->lang->load('general_cn_lang', 'cn');
    }else if($view_lang=='zh-CN'){
      $this->lang->load('general_cn_lang', 'cn');
    }
  }else{ 
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
  
  //前端使用判斷的session
  $data_auth_uri = [];
  $data_auth_uri['auth_uri_1'] = $this->uri->segment(1);
  $data_auth_uri['auth_uri_2'] = $this->uri->segment(2);
  $this->session->set_userdata($data_auth_uri);
  //$this->session->userdata['user_type']

  if(!isset($this->session->userdata['user_id']) && !isset($this->session->userdata['token']))
  {
    // redirect(base_url('index/login'));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
		<?= $this->lang->line('sys_title_1'); ?>
		-
		<?= $this->lang->line('sys_title_2'); ?>
	</title>
    <link rel="stylesheet" href="<?=base_url('assets_panel/plugins/bootstrap4/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets_panel/plugins/font-awesome/css/font-awesome.min.css');?>">    <!-- 側邊選單css -->
    <link rel="stylesheet" href="<?=base_url('assets_panel/plugins/sweetalert2/sweetalert2.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets_panel/seed/css/menu_seed.css');?>">
    <!-- framework css -->
    <link rel="stylesheet" href="<?=base_url('assets_panel/seed/css/style_seed.css');?>">
    <!-- framework 因應簡單農修正的 css -->
    <link rel="stylesheet" href="<?=base_url('assets_panel/seed/css/component_seed.css');?>">


    <script src="<?=base_url('assets_panel/plugins/jquery/jquery.min.js');?>"></script>
    <!-- 表格外掛 -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets_panel/js/datatables/jquery.dataTables.css');?>"/>
    <script type="text/javascript" src="<?=base_url('assets_panel/js/datatables/jquery.dataTables.min.js');?>"></script>
    <!-- bootstrap4用 -->
    <script src="<?=base_url('assets_panel/plugins/bootstrap4/popper.min.js');?>"></script>
    <script src="<?=base_url('assets_panel/plugins/bootstrap4/bootstrap.min.js');?>"></script>
    <!-- 時間外掛 -->
    <script src="<?=base_url('assets_panel/plugins/momentjs/moment.js');?>"></script>
    <script src="<?=base_url('assets_panel/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
    <script src="<?=base_url('assets_panel/js/common_seed.js');?>"></script>

    <!-- 下拉外掛 -->
    <link rel="stylesheet" href="<?=base_url('assets_panel/plugins/bootstrap-select/css/bootstrap-select.min.css');?>">
    <script src="<?=base_url('assets_panel/plugins/bootstrap-select/js/bootstrap-select.min.js');?>"></script>
</head>
<body>
  <?php 
  if($_SERVER['SERVER_NAME']=='localhost' OR $_SERVER['SERVER_NAME']=='tms.agritw.com'){
    $this->load->view('public/evncheck');
  }
  ?>      
  <script>
    $(document).ready(function() {  
      $('select:not(.ms)').selectpicker();
    });     
    $(function(){
        $('#materialTable').DataTable({          
            "pageLength": 25,
            "scrollY":  "550px",
            language: {
                url: "<?=base_url('assets_panel/json/Chinese-traditional.json');?>"  
            }
        });        
    });        
  </script>
</body>
</html>