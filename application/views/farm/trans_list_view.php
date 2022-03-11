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
                    <?= $this->lang->line('left_trans'); ?>                      
                </li>                    
                <li class="breadcrumb-item">
                    <?= $this->lang->line('trans_list'); ?>                      
                </li>
            </ol>
            <h3 class="mb-4">
                <?= $this->lang->line('trans_list'); ?>                    
            </h3>
            <div class="card">
                <div class="card-body">
                    <form method="get" class="filter row">
                        <div class="col-12 col-sm-6 col-md-3 text-center filter_start">
                            <label for="startDate">搜尋日期</label>
                            <input id="startDate" class="form-control" type="date" value="">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 text-center filter_end">
                            <label for="endDate">搜尋日期</label>
                            <input id="endDate" class="form-control" type="date" value="">
                        </div>
                        <div class="col-12 col-sm-6 text-center col-md-3" id="put_select">
                            <label for="mission_status"><?= $this->lang->line('distributors'); ?></label>
                            
                        </div>
                        <div class="col-12 text-center filter_item">
                            <button id="goSearch" class="btn btn-success mt-3 mb-3">搜尋</button>
                        </div>
                    </form>
                    <div class="table-responsive mb-5">
                        <table class="table table-striped table-bordered w-100" id="table_orderby">
                            <thead>
                                <tr>
                                    <!-- <th>訂單編號</th>
                                    <th>通路商</th>
                                    <th>產品名稱</th>
                                    <th>規格</th>
                                    <th>產品單位</th>
                                    <th>單價</th>
                                    <th>需求數量</th>
                                    <th>通路商備註</th>
                                    <th>備註</th> -->
                                    <th><?=$this->lang->line('order_num');?></th>                   
                                    <th><?=$this->lang->line('distributors');?></th>                      
                                    <th><?=$this->lang->line('product_name');?></th>
                                    <th><?=$this->lang->line('spec_format');?></th>
                                    <th><?=$this->lang->line('product_unit');?></th>
                                    <th><?=$this->lang->line('product_price'); ?></th>
                                    <th><?=$this->lang->line('product_need');?></th>
                                    <th><?=$this->lang->line('distributors');?><?=$this->lang->line('remark');?></th>
                                    <th><?=$this->lang->line('operating');?></th>                      
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
            <?php 
                $this->load->view('public/footer');
            ?>                
        </div>
    </div>
</div>         
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="noteModalLabel"><?=$this->lang->line('distributors');?><?=$this->lang->line('remark');?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      通路商備註內容文字
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <td><a href=""  data-toggle="modal" data-target="#orderModal">P12345678</a></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#noteModal">查看</button></td>
<td><button type="button" class="btn btn-success" onclick="link('ORD20190603152954971')">我要下標</button></td> -->
<?php $this->load->view('public/order_spec'); ?>   
<?php
//farm company_id 判斷 是否已下標
    $user_company_id = (isset($this->session->userdata['user_company_id']))?$this->session->userdata['user_company_id']:''; 
?>


<script type="text/javascript">
    $(function() {
        var table = ''
        var _needPage = 1;

        var $startDate = $("#startDate");
        var $endDate = $("#endDate");
        var $needDist = $("#needDist");

        // var _startDate = moment().subtract(7, 'days').format("YYYY-MM-DD");
        // var _endDate = moment().format("YYYY-MM-DD");
        var _startDate = "2019-05-06";
        var _endDate = "2019-05-30";
        var _neddDist = '';
        
        $startDate.val(_startDate);
        $endDate.val(_endDate)
        
        var helloAjax = {
            orderlist : function(callback){
                $(".page-loader-wrapper").fadeIn();
                // console.log(type)
                $.ajax({
                    url : "./trans_list/transload",
                    dataType : "json",
                    data : {
                        'page' : _needPage,
                        's_start_date' : _startDate,
                        's_end_date' : _endDate,
                        's_dist' : _neddDist
                    },
                }).done(function(data){
                    callback(data)
                })
            },
            company : function(callback){
                $.ajax({
                    url : "../dist/order_data/sel_dist",
                    dataType : "json"
                }).done(function(data){
                    callback(data)
                })
            }
        }

        // 廠商
        helloAjax.company(companyFunc);
        function companyFunc(data){
            var _html = '';
            _html += '<select class="form-control" id="needDist">';
                _html += '<option value="">全部</option>';
            $.each(data.datalist,function(k,v){
                _html += '<option value="' + v.company_id + '">'
                    _html += v.title;
                _html += '</option>'
            });
            _html += '</select>';
            console.log(_html)
            $("#put_select").append(_html);
        }
        helloAjax.orderlist(listDataFirstCome);

        function listDataFirstCome(data){
            $(".page-loader-wrapper").fadeIn();
            var _forTable = data.datalist;
            // console.log(_forTable)
            // dataTable
            table = $('#table_orderby').DataTable({
                data : _forTable ,
                columns : [
                    { data : "order_num"},
                    { data : "order_dist"},
                    { data : "product_name"},
                    { data : "spec_format"},
                    { data : "product_unit"},
                    { data : "product_price"},
                    { data : "shipping_total"},
                    {
                        data : null,
                        render:function(data, type, full, meta){
                            // console.log(data.remark)
                            if( data.remark == "" ){
                                return ""
                            }else{
                                return '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#noteModal" data-remark="' + data.remark + '"><?=$this->lang->line("sys_view");?></button>'
                            }
                        },
                        
                    },
                    {
                        data : null,
                        render:function(data, type, full, meta){
                            // console.log(data)
                            if( data.alert ){
                                return ''
                            }else{
                                return '<a href=./trans_add/index?oid=' + data.order_num + ' class="btn btn-success goTrans_add">下標</button>'
                            }
                        },
                        
                    }
                ],
                "drawCallback" : function( setting ){
                    $(".page-loader-wrapper").fadeOut();
                }
            })
        }
        // 搜尋
        $("#goSearch").click(function(e){
            e.preventDefault();
            $(".page-loader-wrapper").fadeIn()
            _needPage = 1;
            _startDate = $startDate.val();
            _endDate = $endDate.val()
            _neddDist = $("#needDist").val();

            helloAjax.orderlist(renewFunc);

            function renewFunc(data){
                // console.log(data)
                table.clear().draw();
                table.rows.add(data.datalist); // Add new data
                table.columns.adjust().draw(); // Redraw the DataTable
                $(".page-loader-wrapper").fadeOut()
            }
        })
     
    });
   
</script>