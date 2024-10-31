<?php
    /*
    Plugin Name:QuarkCoin Donation Button
    Plugin URI: 
    Description:Plugin for displaying a Quark Coin donation button.
    Author:John M.
    Version:1.0
    Author URI: 
    */
	function quarkcoindonation_admin() {
	    include('qrkdonation_admin.php');
	}
	function quarkcoindonation_admin_actions() {
		add_options_page("QuarkCoin Donation Button", "QuarkCoin Donation Button", 'manage_options', "QuarkCoin-Donation-Button", "quarkcoindonation_admin");

	}	 
	add_action('admin_menu', 'quarkcoindonation_admin_actions');
	function quarkcoindonation_addscripts()
	{
	    wp_enqueue_script( 'jquery' );

		// Register the script like this for a plugin:
	    wp_register_script( 'quarkcoindonation-script', plugins_url( '/coin.js', __FILE__ ) );

	    // For either a plugin or a theme, you can then enqueue the script:
    	wp_enqueue_script( 'quarkcoindonation-script' );

    	// Register the style like this for a plugin:
	    wp_register_style( 'quarkcoindonation-style', plugins_url( '/coin.css', __FILE__ ), array(), '20120208', 'all' );
	 
	    // For either a plugin or a theme, you can then enqueue the style:
	    wp_enqueue_style( 'quarkcoindonation-style' );
	}
	add_action( 'wp_enqueue_scripts', 'quarkcoindonation_addscripts' );
	function quarkcoindonation_getdonationbutton() {
		$address = get_option('qrkdon_donationaddress');

		$httpaddress =  plugins_url( '/', __FILE__);

		$retval = '<script>CoinWidgetCom.go({wallet_address: "' . $address . '", sourceurl: "' . $httpaddress . '", currency: "quarkcoin", counter: "count", alignment: "bl", qrcode: true, auto_show: false, lbl_button: "Donate", lbl_address: "Donate Quarkcoin to this Address:", lbl_count: "donations", lbl_amount: "QRK"});</script>';

	 	return $retval;
	}
	class qrkdonation_widget extends WP_Widget {

		function qrkdonation_widget() {
	        $widget_ops = array( 'classname' => 'qrkdonationwidget', 'description' => __('Displays a quarkcoin donation button.') );
	        $this->WP_Widget( 'qrkdonationwidget-widget', __('QuarkCoin Donation Widget', 'qrkdonationwidget'), $widget_ops );
	    }

	    function widget($args, $instance)
		{
			extract($args, EXTR_SKIP);

			echo $before_widget;

			// WIDGET CODE GOES HERE
			echo quarkcoindonation_getdonationbutton();

			echo $after_widget;
		}

	}
	add_action( 'widgets_init', create_function('', 'return register_widget("qrkdonation_widget");') );?>