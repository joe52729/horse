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
                    <?= $this->lang->line('left_trans'); ?>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= site_url('farm/trans_list'); ?>">
                        <?= $this->lang->line('trans_list'); ?>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    下標
                    <!-- <?= $this->lang->line('trans_add'); ?> -->
                </li>
            </ol>
            <h3 class="mb-4">
                <button type="buttom" onclick="history.back()" class="btn btn-outline-secondary btn-sm mr-2"><i class="fa fa-angle-left"></i></button>
                <!-- <?= $this->lang->line('trans_add'); ?>  -->
                下標
            </h3>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <!-- <?= $this->lang->line('order_num'); ?>：<?= $orders_data->order_num ?> -->
                            訂單編號：<a href=""  data-toggle="modal" data-target="#orderModal"><?= $orders_data->order_num ?></a>
                        </h4>

                        <!-- 新樣式區 start -->
                        <form action="" id="trans_add_form" class="row">
                            <input type="hidden" name="order_num" value="<?= $orders_data->order_num ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />                             
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="form_order_id">通路商</label></h3>
                                <p>好市多</p>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="">產品名稱</label></h3>
                                <p>小白菜</p>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="">產品規格</label></h3>
                                <p></p>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="">產品單位</label></h3>
                                <p>公斤</p>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="">產品單價（每一單位）</label></h3>
                                <p>5
                                    <span>元</span>
                                    <span class="text-danger">（A)</span>
                                </p>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="">需求數量（以產品單位計算）</label></h3>
                                <p>35 </p>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="bid_num">下標數量（以產品單位計算）<span class="text-danger">（B)</span></label></h3>
                                <input type="text" id='bid_num' name="order_subscript_num" class="form-control">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="bid_total">總價<span class="text-danger">（A)*（B)</span></label></h3>
                                <input type="text" id='bid_total' class="form-control">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <h3><label for="farm_note">農場備註</label></h3>
                                <textarea name="" id="farm_note" name="remark" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-12 text-center mt-2 mb-5">
                                <button type="button" onclick="save()" class="btn btn-success">
                                    <?= $this->lang->line('sys_confirm'); ?>
                                </button>
                                <button type="reset" class="btn btn-light ">
                                    <?= $this->lang->line('sys_reset'); ?>
                                </button>
                            </div>
                        </form>
                        <!-- 新樣式區 end -->






                        </div>
                    </div>
                </div>
            <?php
            $this->load->view('public/footer');
            ?>
        </div>
    </div>
</div>
<?php $this->load->view('public/order_spec'); ?>  
<script type="text/javascript">
    function save() {

        var url;
        url = "<?php echo base_url('farm/trans_add/add');?>";
        $.post(url, $('#trans_add_form').serialize(), function(response) {

        }, 'json');
    }
</script>