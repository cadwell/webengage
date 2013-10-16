<?php
// adding hook for the webengage admin menu page
add_action('admin_menu', 'admin_menu_webengage');
// adding admin menu page for the webengage plugin
function admin_menu_webengage () {
  add_options_page('WebEngage', 'WebEngage', 'manage_options', 'webengage', 'webengage_options');
}
// options page handler
function webengage_options () {
  ?><div class="wrap"><h2>WebEngage Configuration</h2><?php
  if($_REQUEST['submit']) {
    update_webengage_options();
  }
  print_webengage_form();
  ?></div><?php
}
// updating webengage option
function update_webengage_options () {
  $wlc = $_REQUEST['webengage_license_code'];
  $wlc = trim($wlc);
  $ok = false;
	if($wlc && $wlc !== '') {
	  update_option('webengage_license_code', $wlc);
		$ok = true;
	}

  // displaying the message
  if ($ok) {
    ?><div id="message" class="updated fade">
          <p>Thanks, your license code is updated. Your widget is now active.</p>
      </div><?php
  } else {
    ?><div id="message" class="error fade">
          <p>Please add a license code. See the instructions below to get it.</p>
      </div><?php
  }
}
// printing the webengage options form
function print_webengage_form () {
  $old_value = get_option('webengage_license_code');
  ?>
  <style type="text/css">
  	.webengage-container{
  		margin-top:20px;
  	}

		.webengage-logo-container{
			padding-top:5px;
			padding-left:10px;
			border:1px solid #482E1A;
			background-color:#482E1A;
			-moz-border-radius-topright:5px;
			-moz-border-radius-topleft:5px;
			-webkit-border-top-right-radius:5px;
			-webkit-border-top-left-radius:5px;
			border-top-left-radius:5px;
			border-top-right-radius:5px;
		}

		.webengage-form-container{
			border:1px solid #eee;
			border-bottom-color:#ddd;
			border-right-color:#ddd;
			background-color:#f9f9f9;
			padding:10px;
			padding-top:20px;
			padding-bottom:20px;
			-moz-border-radius-bottomright:5px;
			-moz-border-radius-bottomleft:5px;
			-webkit-border-bottom-right-radius:5px;
			-webkit-border-bottom-left-radius:5px;
			border-bottom-left-radius:5px;
			border-bottom-right-radius:5px;
		}
		
  	.webengage-instructions{
  		margin-top:20px;
  		padding:10px;
			border-radius:5px;
			-moz-border-radius:5px;
			-webkit-border-radius:5px;
			border:1px solid #eee;
			border-bottom-color:#ddd;
			border-right-color:#ddd;
			background-color:#f9f9f9;
  	}
  </style>
	<div class="webengage-container">
		<div class="webengage-logo-container">
			<img src="//staticz-webengage.s3-ap-southeast-1.amazonaws.com/images/webengage/webengage-logo-header.png"/>
		</div>
		<div class="webengage-form-container">
			<form method="post">
				<label for="webengage_license_code"><b>Your WebEngage License Code</b></label>
				<input id="webengage_license_code" type="text" name="webengage_license_code" placeholder="License Code" value="<?php echo $old_value ?>"/>
				<input type="hidden" value="submit" name="submit"/>
				<button type="submit">Save</button>
			</form>
		</div>
	</div>
	<div class="webengage-instructions">
		How to get your WebEngage license code?
		<ol>
			<li><a href="https://webengage.com/signup.html?action=viewRegister">Sign-up</a> for WebEngage. You can opt for the FREE forever plan or choose from amongst the <a href="http://webengage.com/pricing">paid plans</a>.</li>
			<li>Add a widget in your WebEngage Dashboard. Use <b><?php 
				$siteUrl = get_option('siteurl');  
				$urlArr = parse_url($siteUrl);
				$domainName = $urlArr['host'];
				echo $domainName;
				?></b> as the domain name while adding your widget.</li>
			<li>Copy your license code from the integration code tab. Paste it above and save. Make sure that the WebEngage plugin is activated.</li>
			<li>Congratulations! Your website is now WebEngage ready. Create/configure your feedback and survey options from the <a href="http://webengage.com/publisher/dashboard">WebEngage Dashboard</a>.</li>
		</ol>
	</div>
  <?php
}
?>