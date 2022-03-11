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
                        <a href="<?= site_url('admin/size_set'); ?>">
                            <?= $this->lang->line('left_size_set'); ?>
                        <a>                    
                    </li>
                </ol>                
                <h3 class="mb-4"><?= $this->lang->line('size_add'); ?></h3>
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">TEST</h4> -->
                        <div class="card forcard">
                            <ol class="breadcrumb breadcrumb-arrow">
                                <!-- <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">cloud</i>
                                    </a>
                                </li> -->
                                <!-- <li>
                                    <i class="material-icons">shopping_cart</i><?//=$this->lang->line('top_breadcrumb_01');?>
                                </li> -->
                                <li>
                                    <a href="./panel/order_list">
                                        <?=$this->lang->line('top_breadcrumb_02');?>
                                    </a>
                                </li>
                                <li class="active">
                                    <?//=$title?>
                                </li>
                            </ol>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header header-width">
                                        <h2 class="header-left">
                                        </h2>
                                        <span class="header-right"></span>
                                    </div>
                                    <div class="body">
                                        <form role="form" name="" id="form">
                                            <input class="form-control" style="display:none" name="id" value="<?=$data->id?>">			
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />                                            
                                            <span id="order_id"></span>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <div class="form-group" style="line-height:34px">
                                                        <label class="active" for="size_add_title">
                                                            <?=$this->lang->line('size_add_title');?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text"  class="form-control" placeholder=""  name="title" value="<?=$data->title?>" required>
                                                            <!-- <textarea class="form-control" name="remark" id="remark" cols="30" rows="10" placeholder="<?//=$this->lang->line('order_remark_addon');?>"></textarea> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- row clearfix -->                                        
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <div class="form-group" style="line-height:34px">
                                                        <label class="active" for="size_add_cm">
                                                            <?=$this->lang->line('size_add_cm');?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="number"  class="form-control" placeholder=""  name="length" value="<?=$data->length?>" required>
                                                        <!-- <select name="store_id" class="form-control" id="store_id" data-live-search="true" data-select="8"></select> -->
                                                    </div>                                                        
                                                </div>
                                            </div> <!-- row clearfix -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <div class="form-group" style="line-height:34px">
                                                        <label class="active" for="sys_unit">
                                                            <?=$this->lang->line('sys_unit');?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text"  class="form-control" placeholder=""  name="unit" value="<?=$data->unit?>" required>
                                                        <!-- <select name="store_id" class="form-control" id="store_id" data-live-search="true" data-select="8"></select> -->
                                                    </div>                                                        
                                                </div>
                                            </div> <!-- row clearfix -->                                            
                                            <!-- <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <div class="form-group" style="line-height:34px">
                                                        <label class="active" for="product_id">
                                                            <?//=$this->lang->line('product_name');?>
                                                        </label>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select name="product_id" class="form-control" id="product_id" data-live-search="true" data-select="8">
                                                                <?php //foreach ($products as $keyProduct => $valueProduct) { ?>
                                                                <option data-tokens="<?//=$valueProduct['product_name'];?>" value="<?//=$valueProduct['product_id'];?>"><?//=$valueProduct['product_name'];?></option>
                                                                <?php //} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  -->
                                            <!-- row clearfix -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                    <div class="form-group" style="line-height:34px">
                                                        <label class="active" for="remark">
                                                            <?=$this->lang->line('remark');?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea class="form-control" name="remark" cols="30" rows="10" placeholder="">
                                                                <?=$data->remark?>
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
                                        </form>
                                    </div>
                                </div>
                            </div><!-- col-lg-12 -->
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
			url = "<?php echo base_url('admin/size_update/update') ?>";
			$.post(url, $('#form').serialize(), function(response) {
				if (response.status == 'T') {
					swal('<?=$this->lang->line('sys_update_ss'); ?>');
					// location.reload();
					window.location.assign("<?php echo base_url('admin/size_set') ?>");
					return false;
				} else {
					swal(response.msg);
					return false;
				}
			}, 'json');
		}
	</script>    