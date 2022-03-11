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
                    <?= $this->lang->line('left_system'); ?>
                </li>
                <li class="breadcrumb-item">
                    <?= $this->lang->line('left_format_set'); ?>
                </li>
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('format_list'); ?>
                <!-- <button type="button" class="btn btn-outline-danger btn-rounded addArea" onclick="link()"> -->

                <button type="button" class="btn btn-outline-danger btn-rounded addArea" data-toggle="modal" data-target="#newModal">
                
                    <?= $this->lang->line('format_add'); ?>
                </button>
            </h3>
            <div class="card">
                <div class="card-body">

                    <!-- 新的sample樣式 start -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <th>學名</th>
                                    <th>規格名稱</th>
                                    <th>規格內容</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td> 小白菜</td>
                                <td>30cm,250g</td>
                                <td>每件：長度30cm,重量250g</td>
                                <td>
                                    <button type="button" onclick="s_enable('1')" class="btn btn-success">啟用</button>
                                    <button type="button" onclick="" class="btn btn-secondary">關閉</button>
                                    <button type="button" onclick="" class="btn btn-outline-info" data-toggle="modal" data-target="#newModal">修改</button>
                                </td>
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                    <!-- 新的sample樣式 end -->
                    

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('format_title'); ?></th>
                                    <th><?= $this->lang->line('left_format'); ?></th>
                                    <th><?= $this->lang->line('sys_unit'); ?></th>
                                    <th><?= $this->lang->line('data_status'); ?></th>
                                    <th><?= $this->lang->line('save_time'); ?></th>
                                    <th><?= $this->lang->line('update_time'); ?></th>
                                    <th><?= $this->lang->line('remark'); ?></th>
                                    <th><?= $this->lang->line('operating'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $column) {
                                    ?>
                                    <tr>
                                        <td><a href="<?= site_url('admin/size_update/index/') . $column->id ?>"><?= $column->title; ?></a></td>
                                        <td><?= $column->length; ?></td>
                                        <td><?= $column->unit; ?></td>
                                        <td><?= $this->config->item('status')[$this->session->userdata('lang')][$column->status]; ?></td>
                                        <td><?= $column->save_time; ?></td>
                                        <td><?= $column->last_modified_time; ?></td>
                                        <td><?= $column->remark; ?></td>
                                        <td>
                                            <button type="button" onclick="s_enable('<?= $column->id ?>')" class="btn btn-success">
                                                <?= $this->lang->line('sys_enable'); ?>
                                            </button>
                                            <button type="button" onclick="s_close('<?= $column->id ?>')" class="btn btn-danger btn-right">
                                                <?= $this->lang->line('sys_close'); ?>
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
<!-- 新增尺寸設定 -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newModalLabel">新增產品規格</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="" id="addNewComForm">
                <div class="form-group">
                    <label for="size_sname">學名</label>
                    <select name="" id="size_sname" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="size_title">規格名稱</label>
                    <input type="text" id="size_title" class="form-control">
                </div>
                <h5>設定規格</h5>
                <hr>
                <div class="form-group">
                    <label for="size_unit">尺寸單位</label>
                    <input type="text" id="size_unit" class="form-control">
                </div>
                <div class="form-group">
                    <label for="size_length">單件尺寸</label>
                    <input type="text" id="size_length" class="form-control">
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="size_weight">單件重量</label>
                        <input type="text" id="size_weight" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="size_weight_unit">重量單位</label>
                        <input type="text" id="size_weight_unit" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="size_note">備註</label>
                    <input type="text" id="size_note" class="form-control">
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
<script type="text/javascript">
    $(function() {
        //#materialTable
        $('#table_orderby').DataTable({
            "pageLength": 25,
            "scrollY": "550px",
            "ordering": false,
            language: {
                url: "<?= base_url('assets_panel/json/Chinese-traditional.json'); ?>"
            }
        });
    });

    function link() {
        window.location = "<?= site_url('admin/size_add') ?>";
    }

    function s_enable(pid) {
        // if(confirm('Are you sure delete this data?'))
        // {
        $.ajax({
            url: "<?= site_url('admin/size_update/s_enable') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                id: pid,
                <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"
            },
            success: function(response) {
                if (response.status == 'T') {
                    swal('<?= $this->lang->line('sys_update_ss'); ?>');
                    window.location.assign("<?= base_url('admin/size_set'); ?>");
                    return false;
                } else {
                    swal(response.msg);
                    return false;
                }
            }
        });
        // }   
    }

    function s_close(pid) {
        $.ajax({
            url: "<?= site_url('admin/size_update/s_close') ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                id: pid,
                <?php echo $this->security->get_csrf_token_name()?>:"<?php echo $this->security->get_csrf_hash()?>"                
            },
            success: function(response) {
                if (response.status == 'T') {
                    swal('<?= $this->lang->line('sys_update_ss'); ?>');
                    window.location.assign("<?= base_url('admin/size_set'); ?>");
                    return false;
                } else {
                    swal(response.msg);
                    return false;
                }
            }
        });
    }
</script>