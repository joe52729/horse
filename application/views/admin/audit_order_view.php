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
                    <?= $this->lang->line('left_audit'); ?>                      
                </li>                    
                <li class="breadcrumb-item">
                    <?= $this->lang->line('audit_order'); ?>                  
                </li>
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('audit_order'); ?>                    
            </h3>
            <div class="card">
                <div class="card-body">
                    <!-- 新樣式 start -->

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <th>操作</th>
                                    <th>產品訂單編號</th>
                                    <th>通路商</th>
                                    <th>產品名稱</th>
                                    <th>學名</th>
                                    <th>品種</th>
                                    <th>規格</th>
                                    <th>產品單位</th>
                                    <th>單價</th>
                                    <th>需求數量</th>
                                    <th>開始日期</th>
                                    <th>結束日期</th>
                                    <th>出貨週期</th>
                                    <th>檢驗等級</th>
                                    <th>通路商備註</th>
                                    <th>推出時間</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <td>
                                        <button type="button" class="btn btn-success">通過</button>
                                        <button type="button" class="btn btn-danger refuseOrder">退回</button>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                            </tbody>
                        </table>
                    </div>
                    <!-- 新樣式 end -->




                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('order_num'); ?></th>                                    
                                    <th><?=$this->lang->line('distributors');?></th>                      
                                    <th><?= $this->lang->line('product_name'); ?></th>
                                    <th><?= $this->lang->line('order_status'); ?></th>
                                    <th><?= $this->lang->line('spec_format'); ?></th>
                                    <th><?= $this->lang->line('shipping_cycle'); ?></th>
                                    <th><?= $this->lang->line('start_date'); ?></th>
                                    <th><?= $this->lang->line('end_date'); ?></th>
                                    <th><?=$this->lang->line('operating');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $column) { ?>
                                    <tr>
                                        <td><a href="<?php echo site_url('dist/order_update/index/') . $column->order_num ?>"><?= $column->order_num; ?></a></td>
                                        <td><?=$column->order_dist;?></td>                                                                          
                                        <td><?= $column->product_name; ?></td>
                                        <td><?=$this->config->item('order_status')[$this->session->userdata('lang')][$column->order_status];?></td>
                                        <td><?= $column->spec_format; ?></td>
                                        <td><?= $column->shipping_cycle; ?></td>
                                        <td><?= $column->start_date; ?></td>
                                        <td><?= $column->end_date; ?></td>
                                        <td>
                                            <button type="button" onclick="audit_enable('<?=$column->order_num?>')" class="btn btn-success">
                                                <?=$this->lang->line('audit_pass');?>
                                            </button> 
                                            <button type="button" onclick="audit_return('<?=$column->order_num?>')" class="btn btn-success">
                                                <?=$this->lang->line('audit_return');?>
                                            </button>  
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

<script type="text/javascript">
$(function() {
    $('#table_orderby').DataTable({
    });
    // 退回訂單填寫原因
    $(".refuseOrder").click(function(){
        swal({
            title: "填寫退回原因",
            buttons: true,
            showCancelButton : true,
            input : "text",
            content: "input",
        })
        .then((value) => {
            console.log("使用者輸入的資料：" + value.value)
        });
    })
});

function audit_enable(id){
    swal({
        title: "退回原因",
        buttons: true,
        showCancelButton : true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete.value) {
            $.ajax({
                url : "<?=site_url('admin/audit_order/pass')?>？",
                type: "POST",
                dataType: "JSON",
                data:{ 
                    id : id,
                    <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"
                },                     
                success: function(response) {  
                    if (response.status == 'T') {
                        swal('<?=$this->lang->line('audit_pass');?> <?=$this->lang->line('sys_op_finish'); ?>').then(function(){
                            window.location.assign("<?php echo base_url('admin/audit_order/'); ?>");
                        });
                        return false;
                    } else {
                        swal(response.msg);
                        return false;
                    }
                }                  
            });
        }
    });               
}   

function audit_return(id){
    swal({
        title: '<?=$this->lang->line('audit_return');?><?=$this->lang->line('audit_return_ps');?>',
        html:'<input id="audit_return_ps" class="swal2-input">',
    })
    .then((willDelete) => {
        audit_return_ps = document.getElementById('audit_return_ps').value;
        if (willDelete.value) {
            if (audit_return_ps == "") {
                swal("<?=$this->lang->line('sys_enter');?> <?=$this->lang->line('audit_return');?><?=$this->lang->line('audit_return_ps');?>"); 
                return false; 
            }
            $.ajax({
                url : "<?=site_url('admin/audit_order/audit_return')?>",
                type: "POST",
                dataType: "JSON",
                data:{ 
                    id : id,
                    audit_return_ps: audit_return_ps,
                    <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"
                },                     
                success: function(response) {  
                    if (response.status == 'T') {
                        swal('<?=$this->lang->line('audit_return');?> <?=$this->lang->line('sys_op_finish'); ?>').then(function(){
                            window.location.assign("<?php echo base_url('admin/audit_order/'); ?>");
                        });
                        return false;
                    } else {
                        swal(response.msg);
                        return false;
                    }
                }                  
            });
        }
    });               
}   
</script>