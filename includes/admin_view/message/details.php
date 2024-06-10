<?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';
  $user_id=$_GET['id'];
  if(empty($user_id))
  {
     echo "404 not allowed";
     exit;
  }
  $user_id=filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
  if(!get_user_by('ID',$user_id))
  {
    echo "404 not allowed";
    exit;
  }

  $sql="SELECT * FROM " . $table_name . "
          where  sender_id=$user_id or receiver_id=$user_id";
     
  $messages=$wpdb->get_results($sql);
  ?>
  <div class="message_div">
   <?php
        if(!empty($messages))
        {
        foreach($messages as $key=>$val)
        {
            if($val->sender_id == $user_id)
            {
                ?>
                <div  style="margin-left:auto;text-align: right;"><p class="enc-white">User Message : <?=$val->message?> </p></div>
                <?php
            }else
            {
                ?>
                <div style="margin-left:auto;text-align: left;"><p class="enc-aquamarine">Admin Message : <?=$val->message?> </p></p></div>
                <?php
            }
        }
        }
   ?>
  </div>
  <?php

         
?>
<label for="">Send Message</label>
<input type="text" id="send_message_by_admin">
<br>
<button id="send_message_by_admin_btn">Send Message</button>

<?php
$user_message_css=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/admin_message_css.php';
$user_message_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/admin_message_js.php';
include_once($user_message_css);
include_once($user_message_js);