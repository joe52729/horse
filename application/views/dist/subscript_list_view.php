<?php
    $this->load->view('public/navbar_top');
?>    
<style>
td.slline{
    border : 1px solid lightseagreen;
}
td.slclick{
    background :lightseagreen;
    cursor : pointer;
}
td.slcolor{
    background : #fbfbfb;
}
.dpn{display:none}
.orderPaginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    *cursor: hand;
    color: #333 !important;
    border: 1px solid transparent;
    border-radius: 2px;
}
.orderPaginate_button:hover {
    background: #e1fcb9;
    border: 1px solid #e1fcb9;
    color: #000 !important;
}
.orderPaginate_button.current {
    background: #dcdcdc !important;
    border: 0 !important;
}
.orderPaginate_button.disabled{
    cursor: default;
    color: #666 !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none;
}
</style>
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
                <li class="breadcrumb-item">
                    <?= $this->lang->line('subscript_list'); ?>                      
                </li>
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('subscript_list'); ?>                    
            </h3>
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">
                        <?//=$this->lang->line('materiel_list');?> 
                        <span class="ml-1">
                            <button type="button" class="btn btn-outline-danger btn-rounded addArea" data-toggle="modal" data-target="#newModal">
                        </span>
                        <a href="./panel/materiel_add" class="m-l-5 btn btn-default btn-xs "><?=$this->lang->line('insert_materiel');?></a>
                    </h4> -->

                    <!-- 一筆訂單的樣式 start -->
                        <?php 
                            foreach ($data as $key => $column) {
                                $order_num_txt = '';
                                $order_num_a_tag = '0';
                                foreach ($column as $key2 => $column2) {
                                    if($order_num_txt == ''){
                                        $order_num_txt = $column->$key2->order_num ;
                                    }
                                    if($column->$key2->order_subscript !==''){
                                        $order_num_a_tag = '1';
                                    }
                                }
                        ?>
                        <div class="table-responsive">
                            <table class="table outTable table-bordered w-100 mb-3">
                                <tr>
                                    <td class="slline" style="width:50%">
                                        <?=$this->lang->line('order_num');?>：
                                            <?php 
                                                if($order_num_a_tag =='1'){
                                                    echo $order_num_txt .'&nbsp;&nbsp;'; 
                                                }else{
                                            ?> 
                                            <a href="<?php echo site_url('dist/order_update/index/').$order_num_txt; ?>" class="mr-2" data-toggle="modal" data-target="#orderModal">
                                                <?= $order_num_txt; ?>
                                            </a>
                                            <?php 
                                                }
                                            ?>                                    
                                        <?php
                                            // 審核中(0)、上架中(1)、已得標(2)(農場跟通路確認交易，不再對外開放)、取消交易(3)
                                            // 、已下架(可重新審核上架)(4)、拒絕\退回(5)、取消交易(farm)(6)、下標中(7)                              
                                            switch ($column->$key2->order_status)
                                            {
                                                case '0':
                                                    $order_status = 'info';
                                                break;
                                                case '7':
                                                    $order_status = 'info';
                                                break;                                            
                                                case '1':
                                                    $order_status = 'success';
                                                break; 
                                                case '2':
                                                $order_status = 'success';
                                                break; 
                                                case '3':
                                                    $order_status = 'secondary';
                                                break;
                                                case '4':
                                                    $order_status = 'secondary';
                                                break;                                                                                                                                      
                                                case '6':
                                                    $order_status = 'secondary';
                                                break;
                                                case '5':
                                                    $order_status = 'danger';
                                                break;                                                                                
                                                // default:
                                                //     $order_status = 'success';
                                            }
                                        ?>
                                        <span class="badge badge-<?=$order_status?>">
                                            <?=$this->config->item('order_status')[$this->session->userdata('lang')][$column->$key2->order_status];?>
                                        </span>
                                    <!-- 
                                        <span class="badge badge-success">上架中</span>
                                        <span class="badge badge-info">審核中</span>
                                        <span class="badge badge-info">下標中</span>
                                        <span class="badge badge-success">已得標</span>
                                        <span class="badge badge-secondary">已下架</span>
                                        <span class="badge badge-danger">審核未通過</span>
                                        <span class="badge badge-secondary">通路商取消交易</span>
                                        <span class="badge badge-secondary">農場取消交易</span> 
                                    -->
                                    </td>
                                    <td class="slline" style="width:20%">目前總數：</td>
                                    <td class="slline" style="width:20%"><?=$this->lang->line('product_need');?>：<?= $column->$key2->shipping_total; ?></td>
                                    <td class="slline text-center slclick text-white"  style="width:10%" data-now="close">
                                        <i class="fa fa-chevron-up toClose dpn" aria-hidden="true"></i>
                                        <i class="fa fa-chevron-down toOpen" aria-hidden="true"></i>
                                    </td>
                                </tr>                          
                                <tr class="sl_colltr dpn">
                                    <td class="slline slcolor" colspan="4">
                                        <table class="table table-striped table-bordered table_orderby w-100">
                                            <thead>
                                                <tr>
                                                    <th><?=$this->lang->line('sub_farm');?></th>
                                                    <th><?=$this->lang->line('product_name');?></th>
                                                    <th><?=$this->lang->line('shipping_cycle');?></th>
                                                    <th><?=$this->lang->line('product_price');?></th>
                                                    <th><?=$this->lang->line('product_unit');?></th>
                                                    <th><?=$this->lang->line('sub_number');?></th>
                                                    <th><?=$this->lang->line('farm');?><?=$this->lang->line('remark');?></th>
                                                    <th><?=$this->lang->line('farm_status');?></th>
                                                    <th><?=$this->lang->line('operating');?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                foreach ($column as $key2 => $column2) {
                                            ?>                                              
                                                <tr>
                                                    <td><?= $column2->order_subscript; ?></td>
                                                    <td><?= $column2->product_name; ?></td>
                                                    <td><?= $column2->shipping_cycle; ?></td>
                                                    <td><?= $column2->product_price; ?></td>
                                                    <td><?= $column2->product_unit; ?></td>
                                                    <td><?= $column2->order_subscript_num; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#noteModal<?=$column2->trans_num?>"><?=$this->lang->line('sys_view');?></button>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?=$order_status?>">
                                                            <?=$this->config->item('order_status')[$this->session->userdata('lang')][$column->$key2->order_status];?>
                                                        </span>                                                    
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if($column2->order_status == '7'){
                                                        ?>
                                                        <button type="button" onclick="sub_enable('<?=$column2->trans_num?>','<?=$column2->order_num?>')" class="btn btn-success">
                                                            <?=$this->lang->line('trans_confirm');?>
                                                        </button>
                                                        <?php 
                                                            }
                                                            if($column2->order_status == '1' OR $column2->order_status == '2'){
                                                        ?>
                                                        <button type="button" onclick="sub_refuse('<?=$column2->trans_num?>','<?=$column2->order_num?>')" class="btn btn-danger">
                                                            <?=$this->lang->line('trans_cancel');?>
                                                        </button>   
                                                        <?php 
                                                            } 
                                                        ?>                                                    
                                                    </td>
                                                </tr>
                                                <!-- 農場備註內容 -->
                                                <div class="modal fade" id="noteModal<?=$column2->trans_num?>" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="noteModalLabel"><?=$this->lang->line('farm');?><?=$this->lang->line('remark');?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= $column2->remark; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('sys_close');?></button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            <?php
                                                }
                                            ?>    
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <?php
                                }
                            ?>
                    <!-- 一筆訂單的樣式 end -->
                    <!-- 跳頁按鈕 -->
                    <!-- .current 目前頁面 -->
                    <!-- .disabled 頁面到底了 -->
                    <div class="orderPagenate text-center">
                        <a class="orderPaginate_button previous disabled" id="orderListTable_previous">上一頁</a>
                        <span>
                            <a class="orderPaginate_button current">1</a>
                            <a class="orderPaginate_button ">2</a>
                            <a class="orderPaginate_button ">3</a>
                            <a class="orderPaginate_button ">4</a>
                        </span>
                        <a class="orderPaginate_button next" id="orderListTable_next">下一頁</a>
                    </div>
                    <!-- 跳頁按鈕 end -->
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
        // 表格寬度
        var tableOrderby = $(".table_orderby").DataTable({
            "columns": [
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
                { "width": "140px" },
            ]
        })
        // 
        $("body").on("click",".slclick",function(){
            var _now = $(this).attr("data-now");
            if( _now == "close" ){
                // 打開
                $(this).find(".toOpen").addClass("dpn")
                $(this).find(".toClose").removeClass("dpn")
                $(this).attr("data-now","open")
            }else{
                // 打開
                $(this).find(".toClose").addClass("dpn")
                $(this).find(".toOpen").removeClass("dpn")
                $(this).attr("data-now","close")
            }
            $(this).parents("tr").siblings(".sl_colltr").toggleClass("dpn")
            tableOrderby.columns.adjust().draw();
        })
    })

    function sub_enable(pid,oid)
    {
        // if(confirm('Are you sure delete this data?'))
        // {
            $.ajax({
                url : "<?=site_url('dist/subscript_list/sub_enable')?>",
                type: "POST",
                dataType: "JSON",
                data:{ 
                    trans_num : pid,
                    order_num : oid,
                    <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"
                },                     
                success: function(response) {  
                    if (response.status == 'T') {
                        swal('<?=$this->lang->line('trans_confirm');?> <?=$this->lang->line('sys_op_finish'); ?>').then(function(){
                            window.location.assign("<?php echo base_url('dist/subscript_list/'); ?>");
                        });
                    } else {
                        swal(response.msg);
                        return false;
                    }
                }                  
            });
        // }   
    } 

    function sub_refuse(pid,oid)
    {
        swal({
            title: "<?=$this->lang->line('cancel_confirm');?>",
            icon: "warning",
            buttons: true,
            showCancelButton : true
        })
        .then((willDelete) => {
            console.log(willDelete)
            if (willDelete.value) {
                $.ajax({
                    url : "<?=site_url('dist/subscript_list/sub_refuse')?>",
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
                                window.location.assign("<?php echo base_url('dist/subscript_list/'); ?>");
                            });
                            return false;
                        } else {
                            swal(response.msg)
                            return false;
                        }
                    }                  
                });  
            }
        }); 
    }     
</script>