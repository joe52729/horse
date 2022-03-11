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
                    <?= $this->lang->line('left_trans'); ?>                      
                </li>                    
                <li class="breadcrumb-item">下標紀錄
                    <!-- <?= $this->lang->line('subscript_list'); ?>                       -->
                </li>
            </ol>
            <h3 class="mb-4">
                下標紀錄
                <!-- <?= $this->lang->line('subscript_list'); ?>                     -->
            </h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <!-- <th>產品訂單編號</th>
                                    <th>產品名稱</th>
                                    <th>規格</th>
                                    <th>產品單位</th>
                                    <th>單價</th>
                                    <th>需求數量</th>
                                    <th>下標數量</th>
                                    <th>下標總價</th>
                                    <th>農場備註</th>
                                    <th>下標狀態</th>
                                    <th>操作</th> -->
                                    <th><?=$this->lang->line('order_num');?></th>
                                    <th><?=$this->lang->line('product_name');?></th>
                                    <th><?=$this->lang->line('product_need_di');?></th>
                                    <th><?=$this->lang->line('shipping_cycle');?></th>
                                    <th><?=$this->lang->line('product_need');?></th>
                                    <th><?=$this->lang->line('sub_farm');?></th>
                                    <th><?=$this->lang->line('sub_cycle');?></th>
                                    <th><?=$this->lang->line('product_price');?></th>
                                    <th><?=$this->lang->line('product_unit');?></th>
                                    <th><?=$this->lang->line('sub_number');?></th>
                                    <th><?=$this->lang->line('distributors');?><?=$this->lang->line('remark');?></th>
                                    <th><?=$this->lang->line('sub_status');?></th>
                                    <th><?=$this->lang->line('operating');?></th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href=""  data-toggle="modal" data-target="#orderModal">P12345678</a></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <p class="text-info">下標中</p>
                                        <p class="text-success">已得標</p>
                                    </td>
                                    <td>
                                        <button type="button" onclick="sub_refuse('')" class="btn btn-danger">
                                            <?=$this->lang->line('trans_cancel');?>
                                        </button> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('order_num');?></th>
                                    <th><?=$this->lang->line('trans_num');?></th>
                                    <th><?=$this->lang->line('product_name');?></th>
                                    <th><?=$this->lang->line('sub_farm');?></th>
                                    <th><?=$this->lang->line('sub_number');?></th>
                                    <th><?=$this->lang->line('sub_status');?></th>
                                    <th><?=$this->lang->line('package_number');?></th>
                                    <th><?=$this->lang->line('shipping_cycle');?></th>
                                    <th><?=$this->lang->line('start_date');?></th>
                                    <th><?=$this->lang->line('end_date');?></th>
                                    <th><?=$this->lang->line('last_time');?></th>
                                    <th><?=$this->lang->line('operating');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $column) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                                if($column->order_subscript !==''){
                                                    echo $column->order_num; 
                                                }else{
                                            ?>    
                                            <a href="<?php echo site_url('dist/order_update/index/') . $column->order_num ?>"><?= $column->order_num; ?></a>
                                            <?php 
                                                }
                                            ?>
                                        </td>
                                        <td><?= $column->trans_num; ?></td>
                                        <td><?= $column->product_name; ?></td>
                                        <td><?= $column->order_subscript; ?></td>
                                        <td><?= $column->order_subscript_num; ?></td>
                                        <td>
                                            <?=$this->config->item('order_status')[$this->session->userdata('lang')][$column->order_status];?>
                                        </td>
                                        <td><?= $column->shipping_total; ?></td>                                       
                                        <td><?= $column->shipping_cycle; ?></td>
                                        <td><?= $column->start_date; ?></td>
                                        <td><?= $column->end_date; ?></td>
                                        <td><?= $column->last_modified_time; ?></td>
                                        <td>
                                            <?php 
                                                if($column->btn !== ''){
                                            ?>
                                            <button type="button" onclick="sub_refuse('<?=$column->trans_num?>','<?=$column->order_num?>')" class="btn btn-light">
                                                <?=$this->lang->line('trans_cancel');?>
                                            </button>  
                                            <?php 
                                                } 
                                            ?>                                            
                                        </td>                                        
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>                            
                        </table>
                    </div><!-- table-responsive -->
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
    $(function(){
        $(".table_orderby").DataTable({
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info":     false,
            language: {
                url: "<?=base_url('assets_panel/json/Chinese-traditional.json');?>"  
            }, 
        })
    })

    function sub_refuse(pid,oid)
    {
        $.ajax({
            url : "<?=site_url('farm/sub_list/sub_refuse')?>",
            type: "POST",
            dataType: "JSON",
            data:{ 
                id : pid,
                oid : oid,
                <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"
            },                     
            success: function(response) {  
                if (response.status == 'T') {
                    swal('<?=$this->lang->line('trans_cancel');?> <?=$this->lang->line('sys_op_finish'); ?>').then(function(){
                        window.location.assign("<?php echo base_url('farm/sub_list/'); ?>");
                    });
                    return false;
                } else {
                    swal(response.msg);
                    return false;
                }
            }                  
        });   
    }     
</script>