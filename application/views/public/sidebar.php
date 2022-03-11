
<?php
    $name = $_SESSION['m_name'];
    
?>
<body>
<nav class="sidebar seed-sidebar">
    <ul class="list-unstyled">
        <li class="user-info pt-2 pb-2">
            
            <a href="./pane1/expert_report" class="">
                <img class="mr-1" src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg" width="32" height="32" alt="User" />
                HI! <?php echo $name; ?>
            </a>
        </li>
        <li>
            <a href="<?=base_url('index')?>" class="active">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span class="menu-title"><?= $this->lang->line('left_home'); ?></span><br>
                
            </a>
        </li>
        <li>
            <a href="#left_setting_ul" data-toggle="collapse">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <?= $this->lang->line('left_setting'); ?>
                
            </a>
            <ul id="left_setting_ul" class="list-unstyled collapse">
                <li>
                    <div class="inside-used">
                        <a class="btn btn-sm btn-outline-dark" href="<?= base_url('user/lang_set').'?lang=zh-TW' ?>" role="button">繁</a>
                        <a class="btn btn-sm btn-outline-dark" href="<?= base_url('user/lang_set').'?lang=zh-CN' ?>" role="button">简</a>
                        <a class="btn btn-sm btn-outline-dark" href="<?= base_url('user/lang_set').'?lang=en' ?>" role="button">Eng</a>
                    </div>
                    
                </li>
            </ul><br>
                        <center><button type="button" onclick="changepwd()" class="btn btn-sm btn-outline-dark" > 修改密碼</button></center><br>
                        <p></p>
                        <center><butten type="button" onclick="location.href='http://localhost:8888/ulife/index/info'" class="btn btn-sm btn-outline-dark">檢視個人資訊</butten></center><br>
                        <p></p>
                        <center><butten type="button" onclick="location.href='http://localhost:8888/ulife/product/product_manage'" class="btn btn-sm btn-outline-dark">商品管理</butten></center><br>
                        <p></p>
                        <center><button type="button" onclick="location.href='<?= base_url('member/home/goods')?>'" class="btn btn-sm btn-outline-dark" > (會員)顯示商品</button></center><br>
                        <p></p>
                        <center><button type="button" onclick="location.href='<?= base_url('member/home/show_basket')?>'" class="btn btn-sm btn-outline-dark" > (會員)顯示購物車</button></center><br>
                        <p></p>
                        <center><button type="button" onclick="logout()" class="btn btn-sm btn-outline-dark">登出</button></center><br>
                        <p></p>
        </li>           
    </ul>
</nav>
</body>

<script type="text/javascript">
     
    function changepwd() {
        document.location.href="http://localhost:8888/ulife/index/change_password_view";
    }
    
    function logout(){
        var url = "<?php echo base_url('index/logout');?>";
        $.post(url);
        location.reload();
    }
    function product_list(){
        var url ="<?php echo base_url('product/product_manage/showProduct');?>"
        $.post(url);
    }
    
</script>