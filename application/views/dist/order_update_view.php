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
                <li class="breadcrumb-item">
                    <a href="<?= site_url('dist/order_list'); ?>">
                        <?= $this->lang->line('order_list'); ?>
                    <a>
                </li>
            </ol>
            <h3 class="mb-4"><?= $this->lang->line('order_update'); ?></h3>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">TEST</h4> -->
                        <div class="card forcard">
                            <ol class="breadcrumb breadcrumb-arrow">
                                <li>
                                    <i><?= $this->lang->line('order_num'); ?>：</i>
                                </li>
                                <!-- <li>
                                <i class="material-icons">shopping_cart</i><? 
                                                                            ?>
                            </li> -->
                                <li>
                                    <a href="<?= site_url('dist/order_update/index/') . $orders_data->order_num ?>">
                                        <?= $orders_data->order_num ?>
                                    </a>
                                </li>
                                <li class="active">
                                    <? 
                                    ?>
                                </li>
                            </ol>
                        </div>
                        <div class="card-body">
                            <form role="form" name="" id="form">
                                <input class="form-control" style="display:none" name="order_num" value="<?= $orders_data->order_num ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('scientific_name'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                    <select class="form-control" name="scientific_name" id="scientific_name">
                                                        <?php foreach ($this->config->item("crop") as $k => $v) : ?>
                                                            <option value="<?=$k;?>"><?=$v;?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix --> 
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('variety'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="" name="variety" value="<?= $orders_data->variety ?>"  required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->  
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('order_status'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <?=$this->config->item('order_status')[$this->session->userdata('lang')][$orders_data->order_status];?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->                                                                                                                         
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('product_name'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="" name="product_name" value="<?= $orders_data->product_name ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('start_date'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="date" class="form-control" placeholder="" name="start_date" value="<?= $orders_data->start_date ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('end_date'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="date" class="form-control" placeholder="" name="end_date" value="<?= $orders_data->end_date ?>" required>
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
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->
                                    </div><!-- col-lg-6 -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:36px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('product_unit'); ?>  <?= $this->lang->line('product_unit_ps'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="product_unit" id="product_unit">
                                                            <?php 
                                                                $product_unit_list = [];
                                                                $product_unit_list = [
                                                                    'kg'=>$this->lang->line('sys_kg'),
                                                                    'g'=>$this->lang->line('sys_g'),
                                                                    'catty'=>$this->lang->line('sys_catty'),
                                                                    'piece'=>$this->lang->line('sys_piece')
                                                                ];
                                                                foreach ($product_unit_list as $k => $v) :
                                                                    if($orders_data->product_unit == $k){
                                                                        $sel = 'selected';
                                                                    }else{
                                                                        $sel='';
                                                                    } 
                                                            ?>
                                                                <option value="<?=$k;?>" <?=$sel?>><?=$v?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>										
                                        </div> <!-- row clearfix -->    
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:36px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('spec_format'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="spec_format" id="spec_format">
                                                            <?php 
                                                                foreach ($format_list as $k => $v) : 
                                                                    if($orders_data->spec_format == $v->id){
                                                                        $sel = 'selected';
                                                                    }else{
                                                                        $sel='';
                                                                    } 
                                                            ?>
                                                                <option value="<?=$v->id;?>" <?=$sel?>>
                                                                    (<?=$v->title;?>)&nbsp;&nbsp;<?=$v->length;?>&nbsp;<?=$v->unit_l;?>,<?=$v->weight;?>&nbsp;<?=$v->unit_w;?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>										
                                        </div> <!-- row clearfix -->     
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('product_price'); ?><?= $this->lang->line('product_price_ps'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="" name="product_price" value="<?= $orders_data->product_price ?>"  required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix --> 
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('product_need'); ?><?= $this->lang->line('product_need_ps'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="" name="shipping_total" value="<?= $orders_data->shipping_total ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->                                                                   
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('shipping_cycle'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <?php
                                                            $arr = ['日','一','二','三','四','五','六'];
                                                            $str_sec = explode(",",$orders_data->shipping_cycle);
                                                            for($i=0;$i<7;$i++){
                                                                if ($i == 5) {
                                                                    echo '<br>';
                                                                }
                                                                if($i !== 0 AND $i !== 5 ){
                                                                    echo '&nbsp;&nbsp;&nbsp;';
                                                                }
                                                                echo '<input type="checkbox" name="shipping_cycle[]" value="'.$arr[$i].'"';
                                                                if(in_array($arr[$i], $str_sec)){
                                                                    echo 'checked="checked"';
                                                                }
                                                                echo '>&nbsp;';
                                                                echo $arr[$i];
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="">
                                                        <?= $this->lang->line('check_level'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                    <?php
                                                        $chk_txt = array(
                                                            $this->config->item('check_level')[$this->session->userdata('lang')]['organic'],
                                                            $this->config->item('check_level')[$this->session->userdata('lang')]['no_medicine'],
                                                            $this->config->item('check_level')[$this->session->userdata('lang')]['safe'],
                                                            // $this->config->item('check_level')
                                                        );
                                                        $chk_arr = ['organic','no_medicine','safe'];
                                                        $str_sec = explode(",",$orders_data->check_level);
                                                        for ($i = 0; $i < 3; $i++) {
                                                            echo '<input type="checkbox" name="check_level[]" value="'.$arr[$i].'"';
                                                            if(in_array($chk_arr[$i], $str_sec)){
                                                                echo 'checked="checked"';
                                                            }
                                                            echo '>&nbsp;';
                                                            echo $this->config->item('check_level')[$this->session->userdata('lang')][$chk_arr[$i]];
                                                            echo '&nbsp;&nbsp;';
                                                        }
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->                                        
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group" style="line-height:34px">
                                                    <label class="active" for="remark">
                                                        <?= $this->lang->line('remark'); ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea class="form-control" name="remark" id="remark" cols="30" rows="10" placeholder="">
                                                            <?= $orders_data->remark ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- row clearfix -->
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
            url = "<?php echo base_url('dist/order_update/update') ?>";
            $.post(url, $('#form').serialize(), function(response) {
                if (response.status == 'T') {
                    swal('<?=$this->lang->line('sys_update_ss'); ?>').then(function(){
                        window.location.assign("<?php echo base_url('dist/order_list'); ?>");
                    });                      
                    return false;
                } else {
                    swal(response.msg);
                    return false;
                }
            }, 'json');
        }
    </script>