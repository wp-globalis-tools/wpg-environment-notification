<?php
/**
 * Plugin Name:         WPG Environment Warning
 * Plugin URI:          https://github.com/wp-globalis-tools/wpg-environment-notification
 * Description:         Adds a corner notification of your current environment
 * Author:              Pierre Dargham, Globalis Media Systems
 * Author URI:          https://github.com/wp-globalis-tools/
 *
 * Version:             1.0.0
 * Requires at least:   4.0.0
 * Tested up to:        4.4.2
 */

namespace WPG\EnvWarning;

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

function load_module() {
  global $_wp_theme_features;
  if(isset($_wp_theme_features['wpg-env-warning']) && isset($_wp_theme_features['wpg-env-warning'][0])) {
    add_action('wp_footer', __NAMESPACE__ . '\\add_environment_notification');
    add_action('admin_footer', __NAMESPACE__ . '\\add_environment_notification');
  }
}
add_action('after_setup_theme', __NAMESPACE__ . '\\load_module', 100);


function add_environment_notification() {
  global $_wp_theme_features;
  $wp_env = $_wp_theme_features['wpg-env-warning'][0];
  if(!is_admin() && 'production' == $wp_env && !current_user_can('manage_options')) {
    return;
  }
  $colors = ['default' => 'orange', 'development' => 'green', 'staging' => 'orange', 'pre-production' => 'orange', 'production' => 'red'];
  $color  = isset($colors[$wp_env]) ? $colors[$wp_env] : $colors['default'];
  print_inline_style($color);
  echo '<div id="wpg-env-info">'.$wp_env.'</div>';
}

function print_inline_style($color) {
?>
  <style>
    #wpg-env-info { top: 15px;  }
    body.admin-bar #wpg-env-info { top: 47px; }
    @media screen and ( max-width: 782px ) { body.admin-bar #wpg-env-info { top: 61px; } }
    #wpg-env-info {
      font-family: Arial, Verdana; font-size: 15px; color: #FFFFFF; text-transform: uppercase; font-weight: bold;
      position: fixed; z-index: 999; right: 0px; padding: 5px 10px; margin: 0;
      border: 2px solid #FFFFFF; border-right: 0px;
      -webkit-border-top-left-radius: 5px;
      -webkit-border-bottom-left-radius: 5px;
      -moz-border-radius-topleft: 5px;
      -moz-border-radius-bottomleft: 5px;
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
      background-color: <?= $color ?>;
    }
  </style>
<?php
}
