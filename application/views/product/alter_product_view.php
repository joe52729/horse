<?php
$this->load->view('public/navbar_top');
$member_id = $_SESSION['m_id'];
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
					修改商品
				</li>
			</ol>
			<h3 class="mb-4"><button type="buttom" onclick="history.back()" class="btn btn-outline-secondary btn-sm mr-2"><i class="fa fa-angle-left"></i></button>修改產品</h3>
			<div class="card">
				<div class="card-body">
				<body>
				<form id="alter_product" method="post" enctype='multipart/form-data'>
					產品編號：<input type=text name=prod_sn value="<?php echo $p_sn ;?>" readonly="readonly"  ><br>
					產品圖片：<img src="/ulife/application/views/pics/<?= $pic_id?>.<?= $pic_type  ?>">
					<input name="userImage" type="file" id="img" /><br>
					產品名稱：<input type=text name=prod_name value="<?php echo $p_name; ?>"><br>
					產品數量：<input type=text name=prod_amount value="<?php echo $p_amount;?>"><br>
					產品價格：<input type=text name=prod_price value="<?php echo $p_price;?>"><br>
					產品描述：<input type=text name=prod_descript value="<?= $descript;?>"><br>
					<button type="button" onclick="test()" class="btn btn-success">送出</button>
				</form>	
				</body>			
				</div>
		</div>
		<?php
			$this->load->view('public/footer'); 
			
		?>		
	</div>
</div>
<script type="text/javascript">
	function alter(){
		var url = "<?php echo base_url('product/product_manage/alter');?>";      
		$.post(url,$('#alter_product').serialize(),function(response){
			if(response.res == 'T'){
				swal({
					title:"修改成功",
					type:"success",
					confirmButtonColor: '#3085d6',
					confirmButtonText: "返回商品頁面",
					closeOnConfirm: false,
				}).then(
					function(){
					history.go(-1);
					}
				)
			}
		},'json');
	}
	function test(){
	var formData = new FormData($("#alter_product")[0]);  
            $.ajax({
                url: 'http://localhost:8888/ulife/product/product_manage/alter',
                type:'POST',
                data:formData,
                dataType:'json',
                async: false, 
                cache: false, 
                contentType: false, 
                processData: false,
               success:function(response){
				if(response.res == 'T'){
				swal({
					title:"修改成功",
					type:"success",
					confirmButtonColor: '#3085d6',
					confirmButtonText: "返回商品頁面",
					closeOnConfirm: false,
				}).then(
					function(){
					history.go(-1);
					}
				)
			}
               }
			});
		}

</script>


