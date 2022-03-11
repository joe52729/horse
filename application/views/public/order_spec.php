
<!-- 產品訂單規格內容 -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">產品訂單規格</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered w-100">
            <tr>
                <th>學名</th>
                <td><span class="os_scientific"></span></td>
            </tr>
            <tr>
                <th>品種</th>
                <td><span class="os_variety"></span></td>
            </tr>
            <tr>
                <th>規格</th>
                <td><span class="os_specification"></span></td>
            </tr>
            <tr>
                <th>通路商名稱</th>
                <td><span class="os_retailer"></span></td>
            </tr>
            <tr>
                <th>出貨週期</th>
                <td><span class="os_delivery"></span></td>
            </tr>
            <tr>
                <th>需求區間</th>
                <td><span class="os_needtime"></span></td>
            </tr>
            <tr>
                <th>檢驗等級</th>
                <td><span class="os_level"></span></td>
            </tr>
            <tr>
                <th>備註</th>
                <td><span class="os_note"></span></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
    $(".os_scientific").text("here.os_scientific")
    $(".os_variety").text("here.os_variety")
    $(".os_specification").text("here.os_specification")
    $(".os_retailer").text("here.os_retailer")
    $(".os_delivery").text("here.os_delivery")
    $(".os_needtime").text("here.os_needtime")
    $(".os_level").text("here.os_level")
    $(".os_note").text("here.os_note")
})
</script>