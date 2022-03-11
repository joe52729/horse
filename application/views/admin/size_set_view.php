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
                    <?= $this->lang->line('left_size_set'); ?>
                </li>
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('size_list'); ?>
                <button type="button" class="btn btn-outline-danger btn-rounded addArea" onclick="link()">
                    <?= $this->lang->line('size_add'); ?>
                </button>
            </h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('size_add_title'); ?></th>
                                    <th><?= $this->lang->line('left_size'); ?></th>
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