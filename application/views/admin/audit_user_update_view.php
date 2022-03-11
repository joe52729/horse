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
					<?= $this->lang->line('left_audit'); ?>
				</li>
				<li class="breadcrumb-item">
				<?= $this->lang->line('account'); ?><?= $this->lang->line('audit'); ?>
				</li>
			</ol>
			<h3 class="mb-4">
				<button type="buttom" onclick="history.back()" class="btn btn-outline-secondary btn-sm mr-2"><i class="fa fa-angle-left"></i></button>
				<?= $this->lang->line('account'); ?><?= $this->lang->line('audit'); ?>
			</h3>
			<div class="card">
				<div class="card-body">
					<!-- <h4 class="card-title">TEST</h4> -->
					<!-- <div class="card forcard">
						<ol class="breadcrumb breadcrumb-arrow">
						<li>
							<a href="javascript:void(0);">
								<i class="material-icons">cloud</i>
							</a>
						</li>
						<li>
							<i class="material-icons">shopping_cart</i><?
																		?>
						</li>
						<li>
							<a href="./panel/order_list">
							<?
							?>
							</a>
						</li>
						<li>
							<?
							?>
						</li>
					</ol> 
				</div>					 -->
					<form role="form" name="" id="form">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
						<input class="form-control" style="display:none" name="user_id" value="<?= $data->user_id ?>">
						<input class="form-control" style="display:none" name="email" value="<?= $data->user_email ?>">
						<input class="form-control" style="display:none" name="phone" value="<?= $data->user_phone?>">
						<input class="form-control" style="display:none" name="user_display_name" value="<?= $data->user_display_name ?>">
						<input class="form-control" style="display:none" name="billing_time" value="<?= $data->billing_time ?>">
						<input class="form-control" style="display:none" name="user_avator" value="<?= $data->user_avator ?>">
						<input class="form-control" style="display:none" name="source_auth" value="<?= $data->source_auth ?>">
						<div class="row">
							<!-- <div class="col-12 col-lg-6">	 -->
								<div class="form-group col-12 col-lg-6">
									<div class="form-line">
										<?php
											if($data->user_avator ==""){		
												echo '<img class="mr-1" src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg" width="48" height="48" alt="User" />';											 
											}else{
												echo '<img class="mr-1" src="'.$data->user_avator.'" width="48" height="48" alt="User" />';											 
											}
										?>														
										<span class="ml-1"><?= $data->user_display_name ?></span>
									</div>
								</div>
								<div class="form-group col-12 col-lg-6">
									<label for="">
										<?= $this->lang->line('login_status'); ?>
									</label>
									<?php
									$redio_chk='';
									if($data->status == '1'){
										$redio_chk = 'checked';
									}
									?>
									<div class="container">
										<div class="row">
											<div class="col-12 col-md-4 form-check form-check-flat">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="status" value="1" <?=$redio_chk?>>&nbsp;&nbsp;<?= $this->lang->line('sys_enable'); ?>
													<i class="input-helper"></i>
												</label>
											</div>
											<div class="col-12 col-md-4 form-check form-check-flat">
												<label class="form-check-label">
													<input class="form-check-input" type="radio" name="status" value="0">&nbsp;&nbsp;<?= $this->lang->line('sys_close'); ?>
													<i class="input-helper"></i>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-12 col-lg-6">
									<label for="">
										<?= $this->lang->line('login_status'); ?>									
									</label>
									<div class="form-line">
										<input type="text" value="<?= $data->source_auth ?>" class="form-control" disabled>
									</div>
								</div>
								<div class="form-group col-12 col-lg-6">
									<label for="">
										<?= $this->lang->line('phone'); ?>
									</label>
									<div class="form-line">
										<input type="phone" value="<?= $data->user_phone ?>" class="form-control" disabled>
									</div>
								</div>
								<div class="form-group col-12 col-lg-6">
									<label for="">Email</label>
									<div class="form-line">
										<input type="phone" value="<?= $data->user_email ?>" class="form-control" disabled>
									</div>
								</div>
								<div class="form-group col-12 col-lg-6">
									<label for="">
										<?= $this->lang->line('login_type'); ?>
									</label>
									<?php
									if($data->type!=='unreviewed'){
										switch ($data->type)
										{
											case 'dist':
												echo '<input type="text" value="'.$this->lang->line('distributors').'" class="form-control" disabled>';
											break;  
											case 'farm':
												echo '<input type="text" value="'.$this->lang->line('farm').'" class="form-control" disabled>';
											break;
											// case MD5('admi_dEd21q12133w_n'):
											case 'admin':
												echo '<input type="text" value="'.$this->lang->line('admin').'" class="form-control" disabled>';
											break;
											default:
											echo '<input type="text" value="" class="form-control" disabled>';
										}
									?>
									<input class="form-control" style="display:none" name="type" value="<?= $data->type ?>">
									<?php	
									}else{
									?>
									<select class="form-control input-square" id="squareSelect" name="type">
										<option><?=$this->lang->line('choiceWhat')?></option>
										<option value="dist"><?= $this->lang->line('distributors'); ?></option>
										<option value="farm"><?= $this->lang->line('farm'); ?></option>
										<option value="<?= MD5('admi_dEd21q12133w_n') ?>"><?= $this->lang->line('admin'); ?></option>
									</select>
									<?php
									}
									?>
								</div>
								<div class="form-group col-12 col-lg-6">
									<label for="">
										<?= $this->lang->line('company_name'); ?>
									</label>
									<select class="form-control input-square" id="squareSelect" name="company_id">
										<option><?=$this->lang->line('choiceWhat')?></option>
										<?php
											$sel='';
											foreach($data_company as $value){
												if(isset($data->company_id)){
													if($data->company_id == $value->id){
														$sel = 'selected';
													}
												}	
										?>
											<option value="<?=$value->id?>" <?=$sel?>><?=$value->title?></option>
										<?php		
											}
										?>
									</select>
								</div>
							<!-- </div>col-lg-6 -->
						</div>
						<div class="form-group text-center">
							<button type="button" onclick="save()" class="btn btn-success ">
								<?= $this->lang->line('sys_confirm'); ?>
							</button>
							<button type="reset" class="btn btn-light ">
								<?= $this->lang->line('sys_reset'); ?>
							</button>
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
<script type="text/javascript">
	function save() {
        swal({
            title: "<?= $this->lang->line('sys_confirm'); ?>？",
            buttons: true,
            showCancelButton : true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete.value) {
				var url;
				url = "<?php echo base_url('admin/audit_user/add') ?>";
				$.post(url, $('#form').serialize(), function(response) {
					if (response.status == 'T') {
						swal('<?=$this->lang->line('sys_add_ss'); ?>').then(function(){
							window.location.assign("<?php echo base_url('admin/audit_user') ?>");
						});
						return false;
					} else {
						swal(response.msg);
						return false;
					}
				}, 'json');
            }
        });
	}
</script>