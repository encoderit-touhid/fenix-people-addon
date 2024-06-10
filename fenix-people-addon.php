<?php
/*
 * Plugin Name:       Fenix people add on
 * Plugin URI:        https://fenix_people.net/
 * Description:       Handle customized form with the plugin.
 * Version:           1.0.0
 */

 define('PLUGIN_VERSION', time());
 
 $ENCODER_IT_STRIPE_PK=get_option('ENCODER_IT_STRIPE_PK') ? get_option('ENCODER_IT_STRIPE_PK'): "pk_test_51OD1o3HXs2mM51TXR04wpLYzxxWNpOQWZr8Y84oV0Bp5aP1sB0gVic7JqBdrOgQmqYAwT7a9TOfq4UBG5ioifu9F00VwcHhkCb";
 //  define('ENCODER_IT_STRIPE_SK";
 $ENCODER_IT_STRIPE_SK=get_option('ENCODER_IT_STRIPE_SK') ? get_option('ENCODER_IT_STRIPE_SK') : "sk_test_51OD1o3HXs2mM51TXAPMu48pbSpxilR2QjxiXEipq60TE8y96wg51zs9qPSDZomhDtYGcmwIFPboEgFaHi1SINsNZ00FZ8b7i8R";
 $ENCODER_IT_PAYPAL_CLIENT=get_option('ENCODER_IT_PAYPAL_CLIENT') ? get_option('ENCODER_IT_PAYPAL_CLIENT') : "AVT1TGV_xT-FR1XRXZdKgsyoXIhHf_N4-j26F0W6bYXgLcv4r2jJLu7Bsa1aabiU-0pVGrDFUIdOpvrQ";


 define('ENCODER_IT_STRIPE_PK',$ENCODER_IT_STRIPE_PK);
 define('ENCODER_IT_STRIPE_SK',$ENCODER_IT_STRIPE_SK);
 define('ENCODER_IT_PAYPAL_CLIENT',$ENCODER_IT_PAYPAL_CLIENT);

 require_once( dirname( __FILE__ ).'/includes/create_custom_tables.php' );
 require_once( dirname( __FILE__ ).'/includes/admin_functionalities.php' );
 require_once( dirname( __FILE__ ).'/includes/ajax_hook.php' );
 require_once( dirname( __FILE__ ).'/includes/admin_pages.php' );
 require_once( dirname( __FILE__ ).'/includes/helpers.php' );
 require_once( dirname( __FILE__ ).'/includes/woocommer-hooks.php');
 require_once( dirname( __FILE__ ).'/includes/service_request_customer.php');
 require_once( dirname( __FILE__ ).'/includes/custom_routes.php');
 require_once( dirname( __FILE__ ).'/includes/user_functionalities.php');
 
 register_activation_hook(__FILE__, array( 'fenix_people_create_custom_table', 'create_custom_tables' ));
 //register_deactivation_hook(__FILE__, array( 'fenix_people_create_custom_table', 'drop_custom_tables' ));






 function admin_enqueue_scripts_load()
 {
//enqueue js
   

  wp_register_script('fenix_people_custom_form_sweet_alert_admin', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array(), PLUGIN_VERSION, true);
   
   wp_register_script('fenix_people_custom_form_stripe_admin', 'https://js.stripe.com/v3/', array(), PLUGIN_VERSION);

   //$paymal_url="https://www.paypal.com/sdk/js?client-id=".ENCODER_IT_PAYPAL_CLIENT;

   wp_register_script('fenix_people_custom_form_js_admin', plugins_url('assets/js/main.js',__FILE__ ), array(), PLUGIN_VERSION);

   wp_register_script('fenix_people_custom_form_js_zs_zip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',array(),PLUGIN_VERSION);

   wp_register_script('fenix_people_select_2_js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',array(),PLUGIN_VERSION);

   wp_enqueue_style('fenix_people_select_2_css','https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), PLUGIN_VERSION);

   wp_enqueue_style( 'fenix_people_datatable_css', plugins_url('assets/css/datatable.css',__FILE__ ), array(), PLUGIN_VERSION);

   wp_register_script( 'fenix_people_datatable_js', plugins_url('assets/js/datatable.js',__FILE__ ), array(), PLUGIN_VERSION );

  wp_localize_script('fenix_people_custom_form_js_admin', 'action_url_ajax', array(
   'ajax_url' => admin_url('admin-ajax.php'),
   'nonce' => wp_create_nonce('fenix_people_custom_form_js_admin')
  ));

   wp_enqueue_script('fenix_people_custom_form_stripe_admin');
   wp_enqueue_script('fenix_people_custom_form_sweet_alert_admin');
   wp_enqueue_script('fenix_people_custom_form_js_zs_zip');
   wp_enqueue_script('fenix_people_custom_form_js_admin');
   wp_enqueue_script('fenix_people_select_2_js');
   wp_enqueue_script('fenix_people_datatable_js');

	wp_enqueue_media();
 }

 add_action('admin_enqueue_scripts', 'admin_enqueue_scripts_load');