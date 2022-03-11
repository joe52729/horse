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
                    <?= $this->lang->line('left_order'); ?>                      
                </li>                   
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('left_order'); ?>     
                <span class="ml-1">
                    <a class="btn btn-outline-danger btn-rounded"  href="<?=site_url('dist/order_add')?>"><?= $this->lang->line('order_add'); ?></a>
                </span>                
            </h3>
            <!-- <div class="card">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text">Content</p>
                </div>
            </div>             -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('order_num'); ?></th>
                                    <th><?= $this->lang->line('product_name'); ?></th>
                                    <th><?= $this->lang->line('spec_format'); ?></th>
                                    <th><?= $this->lang->line('product_unit'); ?></th>
                                    <th><?= $this->lang->line('product_price'); ?></th>
                                    <th><?= $this->lang->line('product_need'); ?></th>
                                    <th><?= $this->lang->line('total_price'); //單價＊總數 ?></th> 
                                    <th><?= $this->lang->line('order_status'); ?></th>
                                    <th><?= $this->lang->line('shipping_cycle'); ?></th>
                                    <!-- <th><?= $this->lang->line('start_date'); ?></th> -->
                                    <!-- <th><?= $this->lang->line('end_date'); ?></th> -->
                                    <th><?= $this->lang->line('operating'); ?></th>
                                    <!--<th>上架日期</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($data as $key => $column) {
                                ?>
                                <tr>
                                    <td>
                                    <?php 
                                        if($column->alert !==''){
                                            echo $column->order_num;
                                            // echo '<br>'.'('.$column->alert.')';
                                        }else{
                                    ?>
                                        <a href="<?php echo site_url('dist/order_update/index/') . $column->order_num ?>"><?= $column->order_num; ?></a>
                                    <?php        
                                        }
                                    ?>                                        
                                    <td><?= $column->product_name; ?></td>
                                    <td>
                                        <?= $column->spec_format; ?>
                                    </td>  
                                    <td><?= $column->product_unit; ?></td>
                                    <td><?= $column->product_price; ?></td>
                                    <td><?= $column->shipping_total; ?></td>
                                    <td>
                                        <?php 
                                            $product_price = isset($column->product_price)?0:$column->product_price;
                                            $shipping_total = isset($column->shipping_total)?0:$column->shipping_total;
                                            echo $product_price * $shipping_total; 
                                        ?>
                                    </td>
                                    <td>
                                        <?=$this->config->item('order_status')[$this->session->userdata('lang')][$column->order_status];?>
                                    <?php    
                                        if($column->order_status == '5'){
                                    ?>        
                                            <br>
                                            <p class="text-danger" style="cursor:pointer" data-toggle="modal" data-target="#refuseReasonModal<?=$column->order_num?>">
                                                <u><?= $this->lang->line('audit_return_lable'); ?></u>
                                            </p>
                                            <!-- Modal -->
                                            <div class="modal fade" id="refuseReasonModal<?=$column->order_num?>" tabindex="-1" role="dialog" aria-labelledby="refuseReasonModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="refuseReasonModalLabel"><?= $this->lang->line('audit_return_lable'); ?><?= $this->lang->line('audit_return_ps'); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        <?=$column->return_ps?>                                                         
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>                                            
                                    <?php    
                                        }
                                    ?>
                                    </td>
                                    <!-- <td>
                                        <?php 
                                            // foreach($size_data as $size_value){
                                            //     if($size_value->id == $column->spec_size){
                                            //         echo $size_value->length.' ';
                                            //         echo $size_value->unit;
                                            //     }
                                            // }
                                        ?>
                                    </td>                                     -->
                                    <td><?= $column->shipping_cycle; ?></td>
                                    <!-- <td><?= $column->start_date; ?></td> -->
                                    <!-- <td><?= $column->end_date; ?></td> -->
                                    <td>
                                        <?php 
                                            if($column->alert =='' ){
                                        ?>
                                        <button type="button" onclick="order_del('<?=$column->order_num?>')" class="btn btn-danger">
                                            <?= $this->lang->line('common_delete') ?>
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



<script type="text/javascript"> 

    // $(function() {
    //     $('#table_orderby').DataTable({
    //     });
    // });
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
    function order_del(oid)
    {
        $.ajax({
            url : "<?=site_url('dist/order_list/order_del')?>",
            type: "POST",
            dataType: "JSON",
            data:{ 
                oid : oid,
                <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"
            },                     
            success: function(response) {  
                if (response.status == 'T') {
                    swal('<?=$this->lang->line('order_del');?> <?=$this->lang->line('sys_op_finish'); ?>').then(function(){
                        window.location.assign("<?php echo base_url('dist/order_list/'); ?>");
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