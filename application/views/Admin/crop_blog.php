<html>  
    <head>  

        <title>Image Crop and Save into Database using PHP with Ajax</title>  

        <style>
.modal-dialog {
    width: 55%;
    margin: 30px auto;
}
.croppie-container{
    height: auto !important;
}
        </style>
  
  <script src="<?php echo base_url() ?>assets/jquery.min.js"></script>  
  <script src="<?php echo base_url() ?>assets/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/croppie.js"></script>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/croppie.css" />
    </head>  
    <body>  

        <div class="container">
          <br />
      <h3 align="center">Upload Your Image</h3>
      <br />
      <br />
   <div class="panel panel-default">
      <div class="panel-heading">Select  Image</div>
      <div class="panel-body" align="center">
       <input type="file" name="insert_image" id="insert_image" accept="image/*" />
       <br />
       <div id="store_image">
       <a href="<?php echo base_url() ?>Admin/addedblog" class="btn btn-primary"> submit </a>
       </div>
      </div>
     </div>
    </div>
    </body>  
</html>

<div id="insertimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><br>
        <h4 class="modal-title">Crop & Insert Image</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <div id="image_demo" style="width:350px; margin-top:30px"></div>
          </div>
        </div>
        <br />
            <br />
            <br/>
        <div class="" style="padding-top:30px;">
            
            <button class="btn btn-success crop_image">Crop & Insert Image</button>
          </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    








<script>  
$(document).ready(function(){

 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:263,
      height:215,
      type:'square' //circle
    },
    boundary:{
      width:500,
      height:300
    }    
  });

  $('#insert_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#insertimageModal').modal('show');
  });

  $('.crop_image').click(function(event){

    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:'<?php echo base_url() ?>Admin/blog_crop_img',
        method:'POST',
        data:{"image":response},
        success:function(data){
          $('#insertimageModal').modal('hide');
          load_images();
          alert(data);
        }
      })
    });

  });

  load_images();
});  
</script>