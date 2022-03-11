<?php
$this->load->view('public/navbar_top');
?>
<style>
  .image_list {
    list-style: none;
    display: inline-block;
    margin: 0;
    padding: 0;
  }

  .image_item {
    width: 50px;
    height: 50px;
    display: inline-block;
    list-style: none;
    margin-left: 3px;
    margin-right: 3px;
  }

  .image_item img,
  .image_item .image {
    width: 100%;
    height: 100%;
    display: table;
  }

  .image_add {
    border: 1px solid #efefef;
    cursor: pointer;
    display: none;
  }

  .image_add.active {
    display: inline-block;
  }

  .image_add i {
    width: 100%;
    display: table;
    text-align: center;
    line-height: 50px;
    cursor: pointer;
    color: #efefef;
  }

  #farm_description {
    line-height: 160%;
    text-align: justify;
  }
</style>
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
					<?= $this->lang->line('left_user_data'); ?>
				</li>
				<li class="breadcrumb-item">
					<?= $this->lang->line('set_company'); ?>
				</li>
				<!-- <li class="breadcrumb-item">
				</li> -->
			</ol>
			<h3 class="mb-4">
				<?= $this->lang->line('set_company'); ?>
			</h3>
			<div class="card">
				<div class="card-body">
					<!-- 新樣式start -->
					<form role="form" name="" id="form">
						<div class="row">
							<div class="form-group col-12 col-md-6">
								<label for="ac_name">公司名稱</label>
								<input type="text" value="costco" id="ac_name" class="form-control">
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="ac_telephone">公司電話</label>
								<input type="text" id="ac_telephone" class="form-control">
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="ac_adder">公司地址</label>
								<input type="text" id="ac_adder" class="form-control">
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="ac_email">E-mail</label>
								<input type="text" id="ac_email" class="form-control">
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="">形象照 or LOGO</label>
								<br>
									<input type="file" id="image_file" style="display: none;">
									<div class="image_item image_add" id="image_add">
										<i class="fa fa-plus" aria-hidden="true"></i>
									</div>
									<ul class="image_list">
										<!-- <li class="image_item image_data" data-image="">
										</li> -->
									</ul>
								<br>
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="ac_intro">公司簡介</label>
								<textarea name="" class="form-control" id="ac_intro" cols="30" rows="10"></textarea>
							</div>
						</div>
						<div class="mt-2 mb-5 text-center">
							<button type="button" onclick="save()" class="btn btn-success ">
								<?= $this->lang->line('sys_confirm'); ?>
							</button>
							<button type="reset" class="btn btn-light ">
								<?= $this->lang->line('sys_reset'); ?>
							</button>
						</div>
					</form>
					
					
					<!-- 新樣式end -->
					<form role="form" name="" id="form">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
						<input type="hidden" name="cid" value="<?=$data->id?>" />
						<div class="row clearfix">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group" style="line-height:34px">
											<label class="active" for="">
												<?= $this->lang->line('company_type'); ?>
											</label>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<div class="form-group">
												<?php
													// $type_arr = ['dist','farm'];
													// $sel='';
													// foreach($type_arr as $v){
													// 	if($v == $data->type){
													// 		$sel='selected';
													// 	}else{
													// 		$sel='';
													// 	}
													// }
													switch ($data->type)
													{
													case 'dist':
														$txt = $this->lang->line('distributors');
														break;  
													case 'farm':
														$txt = $this->lang->line('farm');
														break;
													default:
														$txt='';
													}
													echo $txt;
												?>
										</div>
									</div>
								</div> <!-- row clearfix -->
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group" style="line-height:34px">
											<label class="active" for="">
												<?= $this->lang->line('company_name'); ?>
											</label>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="" name="title" value="<?=$data->title?>" required>
											</div>
										</div>
									</div>
								</div> <!-- row clearfix -->
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group" style="line-height:34px">
											<label class="active" for="">
												<?= $this->lang->line('phone'); ?>
											</label>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="" name="phone" value="<?=$data->phone?>" required>
										</div>
									</div>
								</div> <!-- row clearfix -->
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group" style="line-height:34px">
											<label class="active" for="">
												<?= $this->lang->line('address'); ?>
											</label>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<div class="form-group">
											<div class="form-line">
												<textarea class="form-control" name="address" cols="30" rows="5" placeholder="">
													<?=$data->address?>
												</textarea>
											</div>
										</div>
									</div>
								</div> <!-- row clearfix -->
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="form-group" style="line-height:34px">
											<label class="active" for="">
												<?= $this->lang->line('company_profile'); ?>
											</label>
										</div>
									</div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
										<div class="form-group">
											<div class="form-line">
												<textarea class="form-control" name="company_profile" cols="30" rows="10" placeholder="">
													<?=$data->company_profile?>
												</textarea>
											</div>
										</div>
									</div>
								</div> <!-- row clearfix -->
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-group" style="line-height:34px">
											<button type="button" onclick="save()" class="btn btn-success ">
												<?= $this->lang->line('sys_confirm'); ?>
											</button>
											<button type="reset" class="btn btn-light ">
												<?= $this->lang->line('sys_reset'); ?>
											</button>
										</div>
									</div>
								</div> <!-- row clearfix -->
							</div><!-- col-lg-6 -->
						</div>
					</form>
				</div>
			</div>
			<?php
			$this->load->view('public/footer');
			?>
		</div>
	</div>
</div>
<script src="./assets_panel/seed/js/canvasResize/canvasResize.js"></script>
<script src="./assets_panel/seed/js/canvasResize/jquery.canvasResize.js"></script>
<script src="./assets_panel/seed/js/canvasResize/binaryajax.js"></script>
<script src="./assets_panel/seed/js/canvasResize/exif.js"></script>
<script>
	$(function(){

		$('body').on('change', function() {
			if ($('.image_data').length == 0) {
				$('.image_add').addClass('active');
			} else {
				$('.image_add').removeClass('active');
			}
		});

		$('body').change();

		$('body').on('click', '#image_add', function() {
			if ($('.image_data').length == 0) {
				$('#image_file').click();
			}
		});


		$('body').on('change', '#image_file', function(e) {
			var that = $(this);
			var file = e.target.files[0];
			canvasResize(file, {
				width: 640,
				height: 0,
				crop: false,
				quality: 90,
				//rotate: 90,
				callback: function(data, width, height) {
				var formData = new FormData();
				formData.append('FILE_image', data);
				$.ajax({
					url: 'api/mobile/upload_image',
					type: 'POST',
					dataType: 'json',
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function(json) {
					console.log(json)
					if (json.sys_code == '200') {
						console.log("json")
						$('.image_list').append(
						'<li class="image_item image_data" data-image="' + json.response + '">' +
						'    <div class="image" style="background-image: url(\'' + json.response + '\'); background-size: cover;"></div>' +
						'</li>'
						);
						$('body').change();
						$('#editBtn').click();
					} else {
						swal({
						title: json.sys_msg
						});
					}
					}
				});
				}
			})
		});


		removeUploadImage();

		function removeUploadImage() {
		$('.image_data').off('click');
		$('body').on('click', '.image_data', function(e) {
			e.preventDefault();
				var that = $(this);
				swal({
				title: "<?= $this->lang->line('make_sure'); ?>",
				text: "<?= $this->lang->line('make_sure_remove'); ?>",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "<?= $this->lang->line('sure'); ?>",
				cancelButtonText: "<?= $this->lang->line('cancel'); ?>"
				}).then(function(isConfirm) {
					if (!isConfirm['dismiss']) {
						$.post('api/mobile/remove_image', {
						uri: that.attr('data-image')
						}, function(json) {
						that.remove();
						$('#editBtn').click();
						}, 'json');
					} else {
						swal({
						title: "<?= $this->lang->line('move_cancel'); ?>"
						});
					}
				});
			});
		}
	})
	function save() {
		var url;
		url = "<?php echo base_url('user/apply_company/update_company') ?>";
		$.post(url, $('#form').serialize(), function(response) {
			if (response.status == 'T') {
				swal('<?=$this->lang->line('sys_update_ss'); ?>').then(function(){
					window.location.assign("<?php echo base_url('user/apply_company/index/').$data->id; ?>");
				});  
				return false;
			} else {
				swal(response.msg);
				return false;
			}
		}, 'json');
	}
</script>