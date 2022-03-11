<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
		<?= $this->lang->line('sys_title_1'); ?>
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
<div class="d-flex">
    <div class="main-panel" id="seed-container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
		        <body>		
                    <form id="add_member" method="post">
                    請輸入帳號<input type=text name=acc><br>
                    請輸入姓名<input type=text name=m_name>
                    請輸入密碼<input type=password name=pwd><br>
                    請輸入信箱<input type=text name=email><br>
                    請輸入手機<input type=text name=phone><br>
                    
                    <button type="button" onclick="register()" class="btn btn-success">確認註冊</button>		            
                    </form>
		            </body>  
                </div>
            </div>
            <?php 
                $this->load->view('public/footer');
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function register() {
        var url = "<?php echo base_url('index/add_member');?>";
      
        $.post(url, $('#add_member').serialize(), function(response) {//response是變數名稱可以改變
            swal(response.res);
        }, 'json');
    }
</script>