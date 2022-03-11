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
                    <a href="<?=base_url('index'); ?>">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <?= $this->lang->line('left_system'); ?>               
                </li>                 
                <li class="breadcrumb-item">
                    <a href="<?= site_url('admin/audit_dist'); ?>">
						<?= $this->lang->line('dist_list'); ?>
					</a>                    
                </li>    
                <li class="breadcrumb-item">
				<?= $this->lang->line('sys_company_add'); ?>                  
                </li> 
            </ol>   
			<h3 class="mb-4">
				<button type="buttom" onclick="history.back()" class="btn btn-outline-secondary btn-sm mr-2"><i class="fa fa-angle-left"></i></button>
				<?= $this->lang->line('sys_company_add'); ?>
			</h3>
			<div class="card">
				<div class="card-body">
					<form role="form" name="" id="form">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
						<div class="row clearfix">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label for="">
										<?= $this->lang->line('company_type'); ?>
									</label>
									<select class="form-control input-square" id="squareSelect" name="type">
										<option value="dist"><?= $this->lang->line('distributors'); ?></option>
										<option value="farm"><?= $this->lang->line('farm'); ?></option>
									</select>
								</div>
								<div class="form-group">
									<label for="">
										<?= $this->lang->line('company_name'); ?>
									</label>
									<div class="form-line">
										<input type="text" class="form-control" placeholder="" name="title">
									</div>
								</div>
								<div class="form-group">
									<label for="">
										<?= $this->lang->line('phone'); ?>
									</label>
									<input type="text" class="form-control" placeholder="" name="phone">
								</div>
								<div class="form-group">
									<label for="">
										<?= $this->lang->line('address'); ?>
									</label>
									<div class="form-line">
										<textarea class="form-control" name="address" cols="30" rows="5" placeholder=""></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="">
										<?= $this->lang->line('company_profile'); ?>
									</label>
									<div class="form-line">
										<textarea class="form-control" name="company_profile" cols="30" rows="10" placeholder=""></textarea>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success">
										<?= $this->lang->line('sys_confirm'); ?>
									</button>
									<button type="reset" class="btn btn-light ">
										<?= $this->lang->line('sys_reset'); ?>
									</button>
								</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script type="text/javascript">
	$("#form").submit(function(e){
		e.preventDefault();
	}).validate({
		rules : {
			title : { required: true },
			phone : { required: true },
		},
		submitHandler: function(form) {
			var url;
			url = "<?php echo base_url('admin/company_add/add') ?>";
			$.post(url, $('#form').serialize(), function(response) {
				if (response.status == 'T') {
					swal('<?= $this->lang->line('sys_add_ss'); ?>');
					window.location.assign(response.re_url);
					return false;
				} else {
					swal(response.msg);
					return false;
				}
			}, 'json');
		}
	})
	function save() {
		var url;
		url = "<?php echo base_url('admin/company_add/add') ?>";
		$.post(url, $('#form').serialize(), function(response) {
			if (response.status == 'T') {
				swal('<?= $this->lang->line('sys_add_ss'); ?>');
				window.location.assign(response.re_url);
				return false;
			} else {
				swal(response.msg);
				return false;
			}
		}, 'json');
	}
</script>