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
					<?= $this->lang->line('left_order'); ?>
				</li>
				<li class="breadcrumb-item active">
					<?= $this->lang->line('order_add'); ?>
				</li>
			</ol>
			<h3 class="mb-4"><button type="buttom" onclick="history.back()" class="btn btn-outline-secondary btn-sm mr-2"><i class="fa fa-angle-left"></i></button><?= $this->lang->line('order_add'); ?></h3>
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
				<form role="form" name="" id="form">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="form-group">
								<h3><label class="" for="scientific_name">
									<?= $this->lang->line('scientific_name'); ?>
								</label></h3>
								<select class="form-control" name="scientific_name" id="scientific_name">
								<?php foreach ($this->config->item("crop") as $k => $v) : ?>
									<option value="<?=$k;?>"><?=$v;?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('product_name'); ?>
								</label></h3>
								<input type="text" class="form-control" placeholder="" name="product_name" required>
							</div>
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('variety'); ?>
								</label></h3>
								<input type="text" class="form-control" placeholder="" name="variety" required>
							</div>
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('start_date'); ?>
								</label></h3>
								<input type="date" class="form-control" placeholder="" name="start_date" required>
							</div>
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('end_date'); ?>
								</label></h3>
								<input type="date" class="form-control" placeholder="" name="end_date" required>
							</div>							
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('shipping_cycle'); ?>
								</label></h3>
								<div class="container">
									<div class="row">
										<?php
										$arr = ['日', '一', '二', '三', '四', '五', '六'];
										for ($i = 0; $i < 7; $i++) {
											echo '<div class="form-check form-check-flat col-3">';
											echo '<label class="form-check-label">';
												echo '<input type="checkbox" name="shipping_cycle[]" value="' . $arr[$i] . '">';
												echo $arr[$i];
											echo '<i class="input-helper"></i></label>';
											echo '</div>';
										}
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('check_level'); ?>
								</label></h3>
								<div class="container">
									<div class="row">
										<?php
											$chk_arr = array(
												$this->config->item('check_level')[$this->session->userdata('lang')]['organic'],
												$this->config->item('check_level')[$this->session->userdata('lang')]['no_medicine'],
												$this->config->item('check_level')[$this->session->userdata('lang')]['safe'],
												// $this->config->item('check_level')
											);
											for ($i = 0; $i < 3; $i++) {

												echo '<div class="form-check form-check-flat col-3">';
												echo '<label class="form-check-label">';
													echo '<input type="checkbox" name="check_level[]" value="' . $chk_arr[$i] . '">';
												echo $chk_arr[$i];
												echo '<i class="input-helper"></i></label>';
												echo '</div>';
											}
										?>		
									</div>
								</div>	
							</div>
						</div>
						<div class="col-12 col-lg-6">							
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('product_unit'); ?>  <?= $this->lang->line('product_unit_ps'); ?>
								</label></h3>
								<select class="form-control" name="product_unit" id="product_unit">
									<option><?= $this->lang->line('choiceWhat'); ?></option>
								<?php 
									$arr_list = [];
									$arr_list = [
										'kg'=>$this->lang->line('sys_kg'),
										'g'=>$this->lang->line('sys_g'),
										'catty'=>$this->lang->line('sys_catty'),
										'piece'=>$this->lang->line('sys_piece')
									];
									// print_r($arr_list);
									foreach ($arr_list as $k => $v) : 
								?>
									<option value="<?=$k?>"><?=$v?></option>
									<?php endforeach; ?>
								</select>							
							</div>	
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('spec_format'); ?>
								</label></h3>
								<select class="form-control" name="spec_format" id="spec_format">
									<option><?= $this->lang->line('choiceWhat'); ?></option>
								<?php foreach ($spec_format_list as $k => $v) : ?>
									<option value="<?=$v->id;?>">
										(<?=$v->title;?>)&nbsp;&nbsp;<?=$v->length;?>&nbsp;<?=$v->unit_l;?>,<?=$v->weight;?>&nbsp;<?=$v->unit_w;?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>								
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('product_price'); ?><?= $this->lang->line('product_price_ps'); ?>
								</label></h3>
								<input type="text" class="form-control" placeholder="" name="product_price" required>
							</div>											
							<div class="form-group">
								<h3><label class="" for="">
									<?= $this->lang->line('product_need'); ?><?= $this->lang->line('product_need_ps'); ?>
								</label></h3>
								<input type="text" class="form-control" placeholder="" name="shipping_total" required>
							</div>
							<div class="form-group">
								<h3><label class="" for="remark">
									<?= $this->lang->line('remark'); ?>
								</label></h3>
								<textarea class="form-control" name="remark" id="remark" cols="30" rows="10" placeholder=""></textarea>
							</div>
						</div>
					</div>
					<div class="form-group text-center">
						<button type="button" onclick="save()" class="btn btn-success">
							<?= $this->lang->line('sys_confirm'); ?>
						</button>
						<button type="reset" class="btn btn-light">
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
<script type="text/javascript">
	function save() {
		console.log($('#form').serialize())
		var url;
		url = "<?php echo base_url('dist/order_add/add') ?>";
		$.post(url, $('#form').serialize(), function(response) {
			if (response.status == 'T') {
				swal('<?=$this->lang->line('sys_add_ss'); ?>').then(function(){
                        window.location.assign("<?php echo base_url('dist/order_list'); ?>");
                    });   				
				return false;
			} else {
				swal(response.msg)
				return false;
			}
		}, 'json');
	}
</script>
