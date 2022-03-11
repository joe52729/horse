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
                    <?=$this->lang->line('account')?><?=$this->lang->line('audit')?>                    
                </li>
            </ol>
            <h3 class="mb-4">
                <?=$this->lang->line('account')?><?=$this->lang->line('audit')?>      
            </h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="sizeTable">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('login_type');?></th>
                                    <th><?=$this->lang->line('account');?></th>
                                    <th><?=$this->lang->line('login_status');?></th>
                                    <th><?=$this->lang->line('apply_time');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($data as $column) {
                                ?>
									<tr>
                                        <td><?=$this->config->item('type')[$this->session->userdata('lang')][$column->type];?></td>
                                        <td><a href="<?=base_url('admin/audit_user/edit/').$column->user_id;?>"><?= $column->user_display_name; ?></a></td>
                                        <td><?=$this->config->item('status')[$this->session->userdata('lang')][$column->status];?></td>
                                        <td><?=date("Y-m-d H:i:s",strtotime($column->billing_time));?></td>
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


<?php 
//js url
    if($data[0]->type=='dist'){
        $url_enable = site_url('admin/audit_dist_acc/user_enable');
        $url_close = site_url('admin/audit_dist_acc/user_close');
        $re_url = site_url('admin/audit_dist_acc');
    }else if($data[0]->type=='farm'){
        $url_enable = site_url('admin/audit_farm_acc/user_enable');
        $url_close = site_url('admin/audit_farm_acc/user_close');
        $re_url = site_url('admin/audit_farm_acc');
    }
?>      
<script type="text/javascript">
$(function(){
    $("#sizeTable").DataTable()
    $("#addNewCom").click(function(){
        // 編輯帳號
    })
})
    function link(order_num)
    {
        window.location = "<?=site_url('farm/trans_add/index')?>?gid=" + order_num;
    }            
</script>