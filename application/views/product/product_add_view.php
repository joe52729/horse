<?php
$this->load->view('public/navbar_top');

?>
<div class="d-flex">
	<?php
	$this->load->view('public/sidebar');
	?>
	
	<div class="main-panel" id="seed-container">
		<div class="content-wrapper">
			<ol class="breadcrumb breadcrumb-arrow">
				<li class="breadcrumb-item">
					<a href="<?= base_url('index'); ?>">
						<i class="fa fa-home" aria-hidden="true"></i>
					</a>
				</li>
				<li class="breadcrumb-item">
					<?= $this->lang->line('product_manage'); ?>
				</li>
				<li class="breadcrumb-item active">
					<?= $this->lang->line('product_add'); ?>
				</li>
			</ol>
			<h3 class="mb-4"><button type="buttom" onclick="history.back()" class="btn btn-outline-secondary btn-sm mr-2"><i class="fa fa-angle-left"></i></button><?= $this->lang->line('product_add'); ?></h3>
			<div class="card">
				<div class="card-body">
				<body>
				<form id="add_new_prod" name= "zero" method="post" enctype='multipart/form-data'>
				請輸入產品名稱：<input  type=text name=prod_name required><font color="red">＊</font><br>
				請輸入產品數量：<input  type=text name=prod_amount required><font color="red">＊</font><br>
				請輸入產品價格：<input 	type=text name=prod_price required><font color="red">＊</font><br>
				請加入產品描述：<input type=text name=prod_descript><br>
				請選擇商品圖片：<input name="userImage" type="file" id="img" /> <br>
				<button type="button" onclick="add_new()" class="btn btn-success">送出</button>
				</form>
				<font color="red">＊為必填欄位</font>
				</body>			
				</div>
		</div>
		<?php
			$this->load->view('public/footer');
		?>		
	</div>
</div>
<script type="text/javascript">
	function add_new(){
		var formData = new FormData($("#add_new_prod")[0]);  
            $.ajax({
                url: 'http://localhost:8888/ulife/product/product_manage/product_add',
                type:'POST',
                data:formData,
                dataType:'json',
                async: false, 
                cache: false, 
                contentType: false, 
                processData: false,
               success:function(response){
                swal('^^^^^^');
               }
            });
		}
	
</script>
