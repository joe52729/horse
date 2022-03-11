<head>
<base href="<?=base_url() . 'application/views/';?>"/>
</head>
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
                    顯示商品細節                      
                </li>                   
            </ol>
            <h3 class="mb-4">
                    顯示商品細節                
            </h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" >
                        
                        <h6>商品名稱：<?= $p_name ?></h6>
                        售價：<?= $p_price?><br>
                        賣家：<?= $member_name?><br>
                        商品描述：<?= $descript?><br>
                        <img src="./pics/<?= $pic_id?>.<?= $pic_type?>">                       
                        <form id="add" method="post/get">
                        <input type="hidden"  name="p_sn" value="<?= $p_sn?>">
                        數量：<input type='button' value='-' class='qtyminus' field='quantity' />
                             <input type='text' name='quantity' value='1' class='qty' /> 
                             <input type='button' value='+' class='qtyplus' field='quantity' /><br><br>
                        </form>
                        <button onclick="add_cart()" class="btn btn-success">加入購物車</button>
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
  $('.qtyplus').click(function(e) {
    e.preventDefault();
    fieldName = $(this).attr('field');
    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
    if (!isNaN(currentVal)) {
      $('input[name=' + fieldName + ']').val(currentVal + 1);
    } else {
      $('input[name=' + fieldName + ']').val(0);
    }
  });
  $(".qtyminus").click(function(e) {
    e.preventDefault();
    fieldName = $(this).attr('field');
    var currentVal = parseInt($('input[name=' + fieldName + ']').val());
    if (!isNaN(currentVal) && currentVal > 0) {
      $('input[name=' + fieldName + ']').val(currentVal - 1);
    } else {
      $('input[name=' + fieldName + ']').val(0);
    }
  });
});
  function add_cart(){
    var url = "<?php echo base_url('member/home/add_cart');?>";
      $.post(url, $('#add').serialize(), function(response) {
          swal(response.res);
      }, 'json');
      swal('成功','',"success");
  }
</script>