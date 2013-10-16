<?php
/*
Plugin Name: WebEngage
Plugin URI: http://webengage.com
Description: WebEngage lets you collect feedback from your website visitors. With WebEngage, you can also conduct in-site surveys from your website visitors in realtime. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="https://webengage.com/signup.html?action=viewRegister">Sign up for a WebEngage license code</a>, 3) Go to your <a href="options-general.php?page=webengage">WebEngage configuration</a> page, and save your license code.
Version: 1.0.0
Author: WebEngage
Author URI: http://webengage.com/about-us
*/
// rendring the webengage widget code
function render_webengage() {
  $webengage_license_code = get_option('webengage_license_code');
  // render the widget if license code is present
  if ($webengage_license_code && $webengage_license_code !== '') {
    ?><!-- Added via WebEngage Wordpress Plugin 1.0.0 --><webengage license="<?php echo $webengage_license_code; ?>"><script id="_webengage_script_tag" type="text/javascript">(function(){var _we = document.createElement('script');_we.type = 'text/javascript';_we.async = true;var _weWidgetJs = "/js/widget/webengage-min-v-2.0.js";if(document.location.protocol == 'https:'){_we.src="//ssl.widgets.webengage.com" +_weWidgetJs;}else{_we.src="//cdn.widgets.webengage.com" +_weWidgetJs;} var _sNode = document.getElementById('_webengage_script_tag');_sNode.parentNode.insertBefore(_we, _sNode);})();</script></webengage><?php
  }
}
// calling render_webengage while rendering wp_footer
add_action('wp_footer', 'render_webengage');
// initialising option
function set_webengage_options () {
  update_option('webengage_redirect_on_first_activation', 'true');
}
// deleting option
function unset_webengage_options () {
  delete_option('webengage_license_code');
}
// activation/deactivation hooks
register_activation_hook(WP_PLUGIN_DIR . '/webengage/webengage.php', 'set_webengage_options' );
register_uninstall_hook(WP_PLUGIN_DIR . '/webengage/webengage.php', 'unset_webengage_options' );
// including the options page
require_once(WP_PLUGIN_DIR . '/webengage/options.php');
add_action('admin_init', 'webengage_redirect');
// redirect to webengage settings page on activation of plugin
function webengage_redirect () {
  if (get_option('webengage_redirect_on_first_activation') == 'true') {
    update_option('webengage_redirect_on_first_activation', 'false');
    wp_redirect(get_option('siteurl'). '/wp-admin/options-general.php?page=webengage');
  }
}
?>