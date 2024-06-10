<?php
$id=$_GET['id'];
if(empty($id) || !isset($_GET['id']))
{
  echo "Sorry This is Wrong Page ID Missing";
  exit;
}
global $wpdb;

$table_name = $wpdb->prefix . 'encoderit_fenix_people_services'; 
$sql="SELECT * FROM " . $table_name . " WHERE id = $id";
$result=$wpdb->get_row($sql);
  
  

?>
<style type='text/css'>
/* form elements */
form {
  
}
label {
  display:block;
  font-weight:bold;
  margin:15px 0;
}
input {
  padding:2px;
  border:1px solid #eee;
  font: normal 1em Verdana, sans-serif;
  color:#777;
}
select
{
 padding:2px;
  border:1px solid #eee;
  font: normal 1em Verdana, sans-serif;
  color:#777;
  width:100%;
}
input.buttons { 
  font: bold 12px Arial, Sans-serif; 
  height: 50px;
  width: 150px;
  margin-top:20px;
  margin-left:200px;
  margin-bottom: 50px;
  cursor: pointer;  
  color: #333;
  background: #e7e6e6 url(MarketPlace-images/button.jpg) repeat-x;
  border: 1px solid #dadada;
}
.flex{
  display: flex;
}
</style>


<div class="wrap pbwp">
<h1 class="wp-heading-inline">Update Service</h1>
<a href="<?=admin_url() .'admin.php.?page=fenix-people-services'?>" class="page-title-action" style="padding:5px 25px;background-color: #2271b1;color:white">Back</a>

  <form action="" method='POST' enctype="multipart/form-data">
  <label for="">Service Name:</label>
    <input type="text" name="service_name" id="service_name" value="<?=$result->service_name?>" style="width:100%;" required>
    <br><br>
    <label for="">Service Price:</label>
    <input type="text" name="service_price" id="service_price" value="<?=$result->service_price?>" style="width:100%;" required>
    <br>
    <br>
    <label for="">Status:</label>
    <select name="service_active" id="service_active">
      <option value="1" <?=$result->is_active == 1 ? 'selected' :'' ?>>Active</option>
      <option value="0" <?=$result->is_active == 0 ? 'selected' :'' ?>>Inactive</option>
      </select>
    <br>
    <br>
    <button id="add_service" class="button" >Update Service</button>
  </form>
</div>


<script>
  jQuery(document).ready(function () {
    jQuery('#add_service').on('click',function(e){
      //alert();
      e.preventDefault();
      var formdata = new FormData();
      var service_price=jQuery('#service_price').val();
      var service_name=jQuery('#service_name').val();
      var service_id=<?php echo $result->id?>;
      var service_active=jQuery('#service_active').val();

      formdata.append('service_name',service_name);
      formdata.append('service_price',service_price);
      formdata.append('service_id',service_id);
      formdata.append('service_active',service_active);
      formdata.append('action','fenix_people_service_update_ajax_callback');
      formdata.append('nonce','<?php echo wp_create_nonce('fenix_people_service_update_ajax_callback') ?>')
      
      jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',
                    success: function(data) {
                    //console.log(data);
                    // const obj = JSON.parse(data)
                     if(data.success === "success")
                     {
                        Swal.fire({
                          text: data.message,
                          timer: 2000,
                          icon: 'success',
                          showConfirmButton: false,
                        });
                       
                     }else
                     {
                        Swal.fire({
                            text: data.message,
                            timer: 2000,
                            icon: 'warning',
                            showConfirmButton: false,
                          });
                     }
                       
                    

                    }
              });

    })

  });
</script>