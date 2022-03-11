
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
                    <?= $this->lang->line('left_weight_set'); ?>                      
                </li>
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('weight_list'); ?>                    
            </h3>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <?=$this->lang->line('materiel_list');?>
                        <span class="ml-1">
                            <!-- <button type="button" class="btn btn-outline-danger btn-rounded addArea" data-toggle="modal" data-target="#newModal"> -->
                            <button type="button" class="btn btn-outline-danger btn-rounded addArea" onclick="link()" >                                    
                                <?=$this->lang->line('weight_add');?>
                            </button>
                        </span>
                        <!-- <a href="./panel/materiel_add" class="m-l-5 btn btn-default btn-xs "><?=$this->lang->line('insert_materiel');?></a> -->
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table_orderby">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('weight_add_title');?></th>
                                    <th><?=$this->lang->line('left_weight');?></th>
                                    <th><?= $this->lang->line('sys_unit'); ?></th>
                                    <th><?=$this->lang->line('data_status');?></th>
                                    <th><?=$this->lang->line('save_time');?></th>
                                    <th><?=$this->lang->line('update_time');?></th>
                                    <th><?=$this->lang->line('remark');?></th>
                                    <th><?=$this->lang->line('operating');?></th> 
                                    <!--<th>上架日期</th>-->
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($data as $column){ 
                            ?>
                                <tr>
                                    <td><a href="<?=site_url('admin/weight_update/index/').$column->id?>"><?=$column->title;?></a></td>							
                                    <td><?=$column->weight;?></td>
                                    <td><?=$column->unit;?></td>
                                    <td><?=$this->config->item('status')[$this->session->userdata('lang')][$column->status];?></td>
                                    <td><?=$column->save_time;?></td>
                                    <td><?=$column->last_modified_time;?></td>
                                    <td><?=$column->remark;?></td>
                                    <td>
                                        <button type="button" onclick="w_enable('<?=$column->id?>')" class="btn btn-success">
                                            <?=$this->lang->line('sys_enable');?>
                                        </button>  
                                        <button type="button" onclick="w_close('<?=$column->id?>')" class="btn btn-danger btn-right">
                                            <?=$this->lang->line('sys_close');?>
                                        </button> 
                                        <!-- <a href="<?//=base_url('admin/weight_update/s_enable/').$column->id; ?>">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="<?//=base_url('admin/weight_update/s_close/').$column->id; ?>">
                                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                        </a>                                             -->
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
    $(function(){
        //#materialTable
        $('#table_orderby').DataTable({          
            "pageLength": 25,
            "scrollY":  "550px",
            "ordering": false,
            language: {
                url: "<?=base_url('assets_panel/json/Chinese-traditional.json');?>"  
            }
        });        
    });    

    function link()
    {
        window.location = "<?=site_url('admin/weight_add')?>";
    }  
            
    function w_enable(pid)
    {
        // if(confirm('Are you sure delete this data?'))
        // {
            $.ajax({
                url : "<?=site_url('admin/weight_update/w_enable')?>",
                type: "POST",
                dataType: "JSON",
                data:{ 
                    id : pid,
                    <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"                    
                },                     
                success: function(response) {  
                    if (response.status == 'T') {
                        swal('<?=$this->lang->line('sys_update_ss');?>');
                        window.location.assign("<?=base_url('admin/weight_set');?>");
                        return false;
                    } else {
                        swal(response.msg);
                        return false;
                    }
                }                  
            });
        // }   
    } 

    function w_close(pid)
    {
        $.ajax({
            url : "<?=site_url('admin/weight_update/w_close')?>",
            type: "POST",
            dataType: "JSON",
            data:{ 
                id : pid,
                <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"                
            },                     
            success: function(response) {  
                if (response.status == 'T') {
                    swal('<?=$this->lang->line('sys_update_ss');?>');
                    window.location.assign("<?=base_url('admin/weight_set');?>");
                    return false;
                } else {
                    swal(response.msg);
                    return false;
                }
            }                  
        });   
    }                                
</script>	       