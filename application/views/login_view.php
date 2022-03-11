<head>
 <?php 
    $this->load->view('public/navbar_top'); 
    $this->load->view('public/login_layout');
    ?>
</head> 
<body>
                    <img src="https://download.logo.wine/logo/Pornhub/Pornhub-Logo.wine.png"  width="400" height="300" style="position: absolute;top: 8%;left: 35.5%;"><br>
                    <form id="check_acc" method="post" style="position: absolute;top: 40%;left: 40%;">
		                請輸入帳號<input type=text name=acc > <br><br>
                        請輸入密碼<input type=password name=pwd> <br><br>
                 
                    <button type="button" onclick="login()" class="btn btn-success" style="position: absolute;left: 10%;" >登入</button>	
                    <button type="button" onclick="javascript:location.href='http://localhost:8888/ulife/index/register'" class="btn btn-success" style="position: absolute;left: 50%;" >前往註冊</button>
                            
                    </form>
		            </body>  
<body>
 


<script type="text/javascript">
    
    function login() {
        var url = "<?php echo base_url('index/check_acc');?>";
       
        
        $.post(url, $('#check_acc').serialize(), function(response) {//response是變數名稱可以改變
            //swal(response.res);"
            if(response.res == 1){
                swal('登入成功！');
                document.location.href="http://localhost:8888/ulife/index"; 
            }else{
                swal('帳號或密碼錯誤');
            }
        }, 'json');
    }
</script>