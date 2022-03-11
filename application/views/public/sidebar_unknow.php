<nav class="sidebar seed-sidebar"> 
    <ul class="list-unstyled">
        <li class="user-info pt-2 pb-2">
                <?php
                        
                	 $user_avator = (isset($this->session->has_userdata['user_avator']))?$this->session->has_userdata['user_avator']:'';
                     if($user_avator == ""){		
                          echo '<img class="mr-1" src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg" width="48" height="48" alt="User" />';											 
                      }else{
                          echo '<img class="mr-1" src="'.$user_avator.'" width="48" height="48" alt="User" />';											 
                      }
                ?>	
                
            </a>
        </li>
        <li class="menu_home">
            &nbsp;
        </li>    
        <li class="menu_home">
            <a href="<?= base_url('index') ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span class="menu-title"><?= $this->lang->line('left_home'); ?></span>
            </a>
        </li>
        <?php
            $user_type ='type';
            
                //echo $this->session->userdata['user_type'];
            $user_type = (isset($this->session->userdata['user_type']))?$this->session->userdata['user_type']:'';
            $company_only_update = (isset($this->session->userdata['company_only_update']))?$this->session->userdata['company_only_update']:'';
            $auth_uri_1 = (isset($this->session->userdata['auth_uri_1']))?$this->session->userdata['auth_uri_1']:'';
            $auth_uri_2 = (isset($this->session->userdata['auth_uri_2']))?$this->session->userdata['auth_uri_2']:'';
            $lang = (isset($this->session->userdata['lang']))?$this->session->userdata['lang']:''; //Language
            $lang_active_tw = '';
            $lang_active_cn = '';
            switch ($lang)
            {
                case 'zh-TW':
                    $lang_active_tw = 'active';
                break;
                case 'zh-CN':
                    $lang_active_cn = 'active';
                break;    
            }

            if(($user_type == 'admin')OR($user_type == 'dist')){
        ?>
        <li class="menu_dist">
            <a href="#left_sale_ul" data-toggle="collapse" class="menu_collapse">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                <span class="menu-title"><?= $this->lang->line('distributors'); ?><?= $this->lang->line('left_order'); ?></span>
            </a>
            <ul class="list-unstyled collapse " id="left_sale_ul">
                <li>
                    <a class="order_list" href="<?= base_url('dist/order_list') ?>">
                        <?= $this->lang->line('order_list'); ?>
                    </a>
                </li>
                <li>
                    <a class="subscript_list" href="<?= base_url('dist/subscript_list') ?>">
                        <?= $this->lang->line('subscript_list'); ?>
                    </a>
                </li>
            </ul>
        </li>
        <?php               
            }
            if(($user_type == 'admin')OR($user_type == 'farm')){
        ?>
        <li class="menu_farm">
            <a href="#left_trans_ul" data-toggle="collapse" class="menu_collapse">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                <span class="menu-title"><?= $this->lang->line('farm'); ?><?= $this->lang->line('left_order'); ?></span>
            </a>
            <ul class="list-unstyled collapse " id="left_trans_ul">
                <li>
                    <a class="trans_list" href="<?= base_url('farm/trans_list') ?>">
                        <?= $this->lang->line('order_list'); ?>
                    </a>
                </li>
                <li>
                    <a class="sub_list" href="<?= base_url('farm/sub_list') ?>">
                        <?= $this->lang->line('subscript_list'); ?>
                    </a>
                </li>                
            </ul>
        </li>
        <?php
            }
        ?>
        <?php
            if(($user_type == 'admin')){
        ?>
        <li class="menu_admin">
            <a href="#left_audit_ul" data-toggle="collapse" class="menu_collapse">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <span class="menu-title"><?= $this->lang->line('left_audit'); ?></span>
            </a>
            <ul class="list-unstyled collapse " id="left_audit_ul">    
                <li>
                    <a class="audit_order" href="<?= base_url('admin/audit_order') ?>">
                        <?= $this->lang->line('audit_order'); ?>
                    </a>
                </li>                                         
                <li>
                    <a class="audit_dist" href="<?= base_url('admin/audit_dist') ?>">
                        <?= $this->lang->line('dist_list'); ?>
                    </a>
                </li>
                <li>
                    <a class="audit_farm" href="<?= base_url('admin/audit_farm') ?>">
                        <?= $this->lang->line('farm_list'); ?>
                    </a>
                </li>                           
                <li>
                    <a class="audit_user" href="<?= base_url('admin/audit_user') ?>">
                    <?= $this->lang->line('account'); ?><?= $this->lang->line('audit'); ?>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?//= base_url('admin/audit_farm_acc') ?>">
                        <?//= $this->lang->line('audit_farm'); ?><?//= $this->lang->line('account'); ?>
                    </a>
                </li> -->
            </ul>
        </li>               
        <li class="menu_admin">
            <a href="#left_sys_set_ul" data-toggle="collapse" class="menu_collapse">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <span class="menu-title"><?= $this->lang->line('left_system'); ?></span>
            </a>
            <ul class="list-unstyled collapse " id="left_sys_set_ul">
                <li>
                    <a class="format_set" href="<?= base_url('admin/format_set') ?>">
                        <?= $this->lang->line('left_format_set'); ?>
                    </a>
                </li>                                        
            </ul>
        </li>
        <?php
            }
        ?>         
        <li class="menu_user">
            <a href="#left_setting_ul" data-toggle="collapse" class="menu_collapse">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <?= $this->lang->line('left_setting'); ?>
            </a>
            <ul id="left_setting_ul" class="list-unstyled collapse">
                <?php
                    if($company_only_update !==''){
                ?>                
                <li>
                    <a href="<?= base_url('user/apply_company/index/').$company_only_update ?>">
                        <?= $this->lang->line('set_company'); ?>
                    </a>
                </li> 
                <?php
                    }
                ?>
                <li>                  
                    <a href="<?=$this->session->userdata['user_id']?>" data-toggle="modal" data-target="#userEditModal">
                        <?= $this->lang->line('set_person'); ?>
                    </a>
                </li>                 
                <li>
                    <a href="<?=base_url('index/logout')?>">
                        <span> 
                            <?= $this->lang->line('left_logout'); ?>
                        </span>
                    </a>
                </li>                                 
                <li>
                    <div class="inside-used">
                        <a class="btn btn-sm btn-outline-dark <?=$lang_active_tw?>" href="<?= base_url('user/lang_set').'?lang=zh-TW' ?>" role="button">繁</a>
                        <a class="btn btn-sm btn-outline-dark <?=$lang_active_cn?>" href="<?= base_url('user/lang_set').'?lang=zh-CN' ?>" role="button">简</a>
                    </div>
                </li>
            </ul>
        </li>           
    </ul>
</nav>
<!-- Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userEditModalLabel">帳號編輯</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form role="form" name="" id="form">
                <div class="form-group">
                    <label for="au_showname">顯示名稱</label>
                    <input type="text" class="form-control" id="au_showname">
                </div>
                <div class="form-group">
                    <label for="au_mail">郵件信箱</label>
                    <input type="text" class="form-control" id="au_mail" value="utingwu@gmail.com" disabled>
                </div>
                <h5>修改密碼</h5>
                <hr>
                <div class="form-group">
                    <label for="au_pw">新密碼</label>
                    <input type="text" class="form-control" id="au_pw">
                </div>
                <div class="form-group">
                    <label for="au_pw_again">再次輸入密碼</label>
                    <input type="text" class="form-control" id="au_pw_again">
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
<script>
$(function(){
    // // 選單active
    var menu_cata = '<?php echo $auth_uri_1; ?>';
    var menu_page = '<?php echo $auth_uri_2; ?>';
    // console.log(menu_cata)
    if( menu_cata == "admin" ){
        if( $("."+menu_page).length ){
            $("."+menu_page).parents(".list-unstyled").siblings(".menu_collapse").trigger('click').addClass("active")
            $("."+menu_page).addClass("active")
        }
    }else{
        // console.log(3)
        $(".menu_"+menu_cata).find(".menu_collapse").trigger('click').addClass("active")
        $("."+menu_page).addClass("active")
    }
})
</script>