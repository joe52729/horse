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
					<?= $this->lang->line('left_user_data'); ?>
				</li>
				<!-- <li class="breadcrumb-item">
				</li> -->
			</ol>
			<h3 class="mb-4">
				<?= $this->lang->line('left_apply'); ?><?= $this->lang->line('account'); ?>
			</h3>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                <i class="material-icons">shopping_cart</i><?//=$this->lang->line('top_breadcrumb_01');?>
                            </li>
                            <li>
                                <a href="./panel/order_list">
                                <?//=$this->lang->line('top_breadcrumb_02');?>
                                </a>
                            </li>
                            <li class="active">
                                <?//=$title?>
                            </li>
                        </ol> 
                    </div>					 -->
					<div class="card-body">
						<form role="form" name="" id="form">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
							<div class="row clearfix">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="form-group" style="line-height:34px">
												<label class="active" for="">
													<?= $this->lang->line('login_type'); ?>
												</label>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<div class="form-group">
												<select class="form-control input-square" id="squareSelect" name="type">
													<option value="dist"><?= $this->lang->line('distributors'); ?></option>
													<option value="farm"><?= $this->lang->line('farm'); ?></option>
													<option value="<?=MD5('admi_dEd21q12133w_n')?>"><?= $this->lang->line('admin'); ?></option>
												</select>
											</div>
										</div>
									</div> <!-- row clearfix -->									
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="form-group" style="line-height:34px">
												<label class="active" for="">
													<?= $this->lang->line('account'); ?>
												</label>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<div class="form-group">
												<div class="form-line">
													<input type="email" class="form-control" placeholder="" name="email" required>
													<!-- <textarea class="form-control" name="remark" id="remark" cols="30" rows="10" placeholder="<?
																																					?>"></textarea> -->
												</div>
											</div>
										</div>
									</div> <!-- row clearfix -->
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="form-group" style="line-height:34px">
												<label class="active" for="">
													<?= $this->lang->line('password'); ?>
												</label>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<div class="form-group">
												<input type="password" class="form-control" placeholder="" name="password" required>
												<!-- <select name="store_id" class="form-control" id="store_id" data-live-search="true" data-select="8"></select> -->
											</div>
										</div>
									</div> <!-- row clearfix -->
									<div class="row clearfix">
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<div class="form-group" style="line-height:34px">
												<label class="active" for="">
													<?= $this->lang->line('password_confirm'); ?>
												</label>
											</div>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
											<div class="form-group">
												<div class="form-line">
													<input type="password" class="form-control" placeholder="" name="password_confirm" required>
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
							</div>
						</form>
					</div>
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
		var url;
		url = "<?php echo base_url('apply/add') ?>";
		$.post(url, $('#form').serialize(), function(response) {
			if (response.status == 'T') {
				swal('<?=$this->lang->line('sys_add_ss'); ?>');				
				window.location.assign("<?php echo base_url('index') ?>");
				return false;
			} else {
				swal(response.msg);
				return false;
			}
		}, 'json');
	}
</script>