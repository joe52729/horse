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
                    <?php 
                    if($type == 'dist'){
                        echo $this->lang->line('dist_list');
                    }else if($type == 'farm'){
                        echo $this->lang->line('farm_list');
                    }
                    ?>                   
                </li>
            </ol>
            <h3 class="mb-4">
                <?php 
                if($type == 'dist'){
                    echo $this->lang->line('dist_list');
                }else if($type == 'farm'){
                    echo $this->lang->line('farm_list');
                }
                ?>        
                <span class="ml-1">
                    <button type="button" class="btn btn-outline-danger btn-rounded" data-toggle="modal" data-target="#newModal">
                    <!-- <button type="button" class="btn btn-outline-danger btn-rounded addArea" onclick="link()" >                                     -->
                        <!-- <?=$this->lang->line('sys_company_add');?> -->
                        新增通路商
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-rounded" data-toggle="modal" data-target="#newFarmModal">
                        新增農場
                    </button>
                </span>         
            </h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="sizeTable">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('login_type');?></th>
                                    <th><?=$this->lang->line('login_status');?></th>
                                    <th><?=$this->lang->line('company_name');?></th>
                                    <th><?=$this->lang->line('set_time');?></th>
                                    <th><?=$this->lang->line('operating');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($data as $column) {
                                ?>
									<tr>
                                        <td><?=$this->config->item('status')[$this->session->userdata('lang')][$column->type];?></td>
                                        <td><?=$this->config->item('status')[$this->session->userdata('lang')][$column->status];?></td>
                                        <td><?=$column->title;?></td>
                                        <td><?=date("Y-m-d H:i:s",strtotime($column->billing_time));?></td>
                                        <td>
                                            <button type="button" onclick="user_enable('<?=$column->id?>')" class="btn btn-success">
                                                <?=$this->lang->line('sys_enable');?>
                                            </button>  
                                            <button type="button" onclick="user_close('<?=$column->id?>')" class="btn btn-danger btn-right">
                                                <?=$this->lang->line('sys_close');?>
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
<!-- 新增通路商 -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newModalLabel">新增通路商</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" id="addNewComForm">
                <div class="form-group">
                    <label for="addnc_name">公司名稱</label>
                    <input type="text" id="addnc_name" class="form-control">
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="addNewCom">新增</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- 新增農場 -->
<div class="modal fade" id="newFarmModal" tabindex="-1" role="dialog" aria-labelledby="newFarmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newFarmModalLabel">新增農場</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" id="addNewFarmForm">
                <div class="form-group">
                    <label for="addncf_name">農場名稱</label>
                    <input type="text" id="addncf_name" class="form-control">
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="addNewFarm">新增</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php 
//js url
    if($type == 'dist'){
        $url_enable = site_url('admin/audit_dist/user_enable');
        $url_close = site_url('admin/audit_dist/user_close');
        $re_url = site_url('admin/audit_dist');
    }else if($type == 'farm'){
        $url_enable = site_url('admin/audit_farm/user_enable');
        $url_close = site_url('admin/audit_farm/user_close');
        $re_url = site_url('admin/audit_farm');
    }
?>      
<script type="text/javascript">
$(function(){
    $("#sizeTable").DataTable({})
    // 新增新公司
    $("#addNewCom").click(function(){
        var _name = $("#addnc_name").val() //公司名稱
        console.log(_name)
    })
    // 新增新農場
    $("#addNewFarm").click(function(){
        var _name = $("#addncf_name").val() //公司名稱
        console.log(_name)
    })
})
    function link()
    {
        window.location = "<?=site_url('admin/company_add')?>";
    }   
 
    function user_enable(pid)
    {
        swal({
            title: "<?=$this->lang->line('audit_pass');?>",
            buttons: true,
            showCancelButton : true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url : "<?=$this->lang->line('sys_enable');?>？",
                    type: "POST",
                    dataType: "JSON",
                    data:{ 
                        id : pid
                    },                     
                    success: function(response) {  
                        if (response.status == 'T') {
                            swal('<?=$this->lang->line('sys_add_ss'); ?>');                
                            window.location.assign("<?= $re_url?>");
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

    function user_close(pid)
    {
        swal({
            title: "<?=$this->lang->line('sys_close');?>",
            buttons: true,
            showCancelButton : true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url : "<?=$url_close?>",
                    type: "POST",
                    dataType: "JSON",
                    data:{ 
                        id : pid
                    },                     
                    success: function(response) {  
                        if (response.status == 'T') {
                            swal('<?=$this->lang->line('sys_update_ss');?>');
                            window.location.assign("<?=$re_url?>");
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