<?php
    $this->load->view('public/navbar_top');
?> 
<head>
<meta charset="UTF-8">
<?php 
    require 'layout.php';
?>
    <title>
		<?= $this->lang->line('sys_title_1'); ?>
		個人資訊
		<?= $this->lang->line('sys_title_2'); ?>
	</title>


</head>
   
<div class="d-flex">
    <?php {
    
            $this->load->view('public/sidebar');  
        }
    ?>

    <div class="main-panel" id="seed-container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                    <form id="info" methood="post">
                    <input type="hidden" name="m_id" value="<?= $_SESSION['m_id']?>">
                    帳號：<input type="text" name="m_account" value="<?php echo $_SESSION['m_account']; ?>" readonly="readonly"><br>
                    姓名：<input type="text" name="m_name" value="<?php echo $_SESSION['m_name']; ?>"><br>
                    電話：<input type="text" name="m_phone" value="<?php echo $_SESSION['m_phone'];?>"><br>
                    信箱：<input type="text" name="m_mail" value="<?php echo $_SESSION['m_email'];?>"><br>
                    <button type="button" onclick="alter_info()" class="btn btn-success">確定修改</button>
                    </form>
                    </h4>  
                </div>
            </div>
            <?php 
                $this->load->view('public/footer');
            ?>
        </div>
    </div>
</div>
<script>
    function alter_info(){
        var url="<?php echo base_url('index/atler_info');?>";
        $.post(url,$('#info').serialize(),function(response){
            switch(response.res){
                case 0 :
                    swal('發生錯誤','',"error");
                    break;
                case 1 :
                    swal('修改成功','',"success");
                    location.reload()
                    break;
                case 2 :
                    swal('請勿添加特殊字元','',"error");
                    break;
            }
            // if(response.res == 1){
            //     swal('修改成功','',"success");
            //     location.reload()
            // }else{
            //     swal('發生錯誤','',"error");
            // }
           
        },'json');
    }
</script>