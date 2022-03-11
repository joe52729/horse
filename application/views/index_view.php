<?php
    $this->load->view('public/navbar_top');
?> 
   
<div class="d-flex">
    <?php {
    
            $this->load->view('public/sidebar'); //未登入狀態  
        }
    ?>

    <div class="main-panel" id="seed-container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php
                            if(isset($this->session->userdata['user_id']) && isset($this->session->userdata['token']))
                            {
                                echo $this->lang->line('sys_title_2');
                                echo '<br><br>';
                                echo 'Hi！ '.$this->session->userdata['user_display_name'];
                            }else{
                        ?>        
                        <?php 
                        echo '';
                        
                        ?>
                        <br><br>

                        <?php        
                            }
                        ?>
                    </h4>  
                </div>
            </div>
            <?php 
                $this->load->view('public/footer');
            ?>
        </div>
    </div>
</div>