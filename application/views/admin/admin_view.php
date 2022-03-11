    <?php
        $this->load->view('public/navbar_top');
    ?>    
    <div class="d-flex">
        <?php 
            $this->load->view('public/sidebar');
        ?>
        <div class="main-panel" id="seed-container">
            <div class="content-wrapper">
                <h3 class="mb-4">农场清单</h3>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">TEST</h4>
                    </div>
                </div>
                <?php 
                    $this->load->view('public/footer');
                ?>
            </div>
        </div>
    </div>