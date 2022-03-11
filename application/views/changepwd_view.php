<?php
    $this->load->view('public/navbar_top');
    $name = $_SESSION['m_account'];
     error_reporting(0);

?> 
     <title>
        簡單農
        -
		會員密碼修改
	</title>
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
                        <?php
                            $this->load->view('public/index_layout');  
                        ?>        
                        
                    <form id="change_password" method="post">
                    請輸入舊密碼：<input type=text name=old_pwd><br>
                    <br>
                    請輸入新密碼：<input type=text name=new_pwd><br>
                    <br>
                    請確認新密碼：<input type=text name=check_new_pwd><br>
                    <br>
                    <button type="button" onclick="checkpwd()" class="btn btn-success">送出</button>            
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
<script type="text/javascript">
    
    function checkpwd() {
        var url = "<?php echo base_url('index/change_password');?>";
        
       
        
        $.post(url, $('#change_password').serialize(), function(response) {//response是變數名稱可以改變
            //swal(response.res);"
            var res = response.res ;
            switch (res){
                case '0':
				     swal('修改成功');
			    break;
			    case '1':
				     swal('新舊密碼不符');
			    break;
                case '2':
                    swal('原密碼輸入錯誤');
                break;
                default :
                swal(response.res);
                break;
            }
        },'json');
    }
</script>