<form id="uploadForm" method="post" enctype="multipart/form-data">
    <label>Upload Image File:</label><br/>
    <input name="userImage" type="file" id="img" />
    <input type="text" name="cht" value='&&&&77777'/><br>
    
    <button onclick="test()" >777777</button>
</form> 

<script type="text/javascript">

 function test(){
            var formData = new FormData($("#uploadForm")[0]);  
            $.ajax({
                url: 'http://localhost:8888/ulife/product/product_manage/upload_pic',
                type:'POST',
                data:formData,
                dataType:'json',
                async: false, 
                cache: false, 
                contentType: false, 
                processData: false,
               success:function(response){
                swal('^^^^^^');
               }
            });
}
</Script>