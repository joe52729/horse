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
                    <?= $this->lang->line('product_manage'); ?>                      
                </li>                   
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('product_manage'); ?>     
                <span class="ml-1">
                    <a class="btn btn-outline-danger btn-rounded"  href="<?=site_url('product/product_manage/add_prod')?>"><?= $this->lang->line('product_add'); ?></a>
                </span>                
            </h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="">
                            <thead>
                                <tr>
                                    <th>產品名稱</th>
                                    <th>售價</th>
                                    <th>數量</th>
                                    <th>賣家</th>
                                    <th>上架日期</th>
                                    <th>加入購物車</th>
                                </tr>
                            </thead>
                            <tbody id="showprod">
                        
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
        function prd_list_load(){
            $.ajax({
                url : "<?= base_url('member/home/show_goods');?>",
                type: 'get',
                dataType: 'JSON',
                success: function(response){
                    res_data(response);
                }
            });
        }
        function res_data(response)
        {
            var click = "onclick" ;
            var eq = "=";
            var js = "javascript:";
            var loc = "location.href=";
            var url = "'http://localhost:8888/ulife/member/home/add_cart?quantity=1&p_sn=" ;
            var ove = "'";
            var cls = "btn btn-outline-danger btn-rounded";
            var url2 = 'http://localhost:8888/ulife/member/home/get_by_pSN?psn=';
            
            $.each(response, function(i, v){

                var tr_str ='';
                tr_str = "<tr>" +
                    "<td align='center'><a href="+url2+v.p_sn+">"+ v.p_name + "</a></td>" +
                    "<td align='center'>" + v.p_price + "</td>" +
                    "<td align='center'>" + v.p_amount + "</td>" +
                    "<td align='center'>" + v.member_name + "</td>" +
                    "<td align='center'>" + v.p_date + "</td>" +
                    "<td align='center'><button class="+cls+" name=p_sn id=alter value="+v.p_sn+" "+click+eq+js+loc+url+v.p_sn+ove+" >加入</button></td>" +
                    "</tr>";
                $("#showprod").append(tr_str);

            }); 
        }
        prd_list_load();
    });
</script>
