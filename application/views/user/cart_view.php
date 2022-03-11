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
                    <?= $this->lang->line('show_cart'); ?>                      
                </li>                   
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('show_cart'); ?>     
                <span class="ml-1">
                    <a class="btn btn-outline-danger btn-rounded"  href="<?=site_url('member/home/goods')?>"><?= $this->lang->line('return'); ?></a>
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
                                    <th>移除購物車</th>
                                </tr>
                            </thead>
                            <tbody  id="showlist">
                        
                            </tbody>
                            <thead>
                                <tr>
                                    <th>總物品數</th>
                                    <th>總價</th>
                                </tr>
                            </thead>
                            <tbody id="show_count">
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
        function cart_list_load(){
            $.ajax({
                url : "<?= base_url('member/home/query_cart');?>",
                type: 'get',
                data: {
                    verify:'true'
                } ,
                dataType: 'JSON',
                success: function(response){
                    res_data(response);
                }
            });
        }
        //************************************************** */
        function count(){
            $.ajax({
                url : "<?= base_url('member/home/count');?>",
                type: 'get',
                dataType: 'JSON',
                success: function(response){
                    load_count(response);
                }
            });
        }
        function load_count(response){
                var tr_str ='';
                tr_str = "<tr>" +
                    "<td align='center'>"+ response.sum_cost + "</a></td>" +
                    "<td align='center'>" + response.sum_item + "</td>" +
                    "</tr>";
                $("#show_count").append(tr_str);  
        }
         //**************************************************************** */  
        function res_data(response)
        {
            var click = "onclick" ;
            var eq = "=";
            var js = "javascript:";
            var loc = "location.href=";
            var url = "'http://localhost:8888/ulife/member/home/remove_cart?cart_sn=" ;
            var ove = "'";
            var cls = "btn btn-outline-danger btn-rounded";
            
            
            $.each(response, function(i, v){
                var tr_str ='';
                tr_str = "<tr>" +
                    "<td align='center'>"+ v.product_name + "</a></td>" +
                    "<td align='center'>" + v.product_price + "</td>" +
                    "<td align='center'>" + v.amount + "</td>" +
                    "<td align='center'>" + v.product_owner_name + "</td>" +
                    "<td align='center'><button class="+cls+" name=cart_sn id=cart_sn value="+v.cart_sn+" "+click+eq+js+loc+url+v.cart_sn+ove+" >移除</button></td>" +
                    "</tr>";
                $("#showlist").append(tr_str);

            }); 
        }
        cart_list_load();
        count();
    });
</script>
