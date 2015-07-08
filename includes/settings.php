<?php
/**
 * Settings
 *
 * @package     EDD\Continue Shopping\Settings
 * @since       1.0.0
 */
function eddcs_continue_shopping_settings( $settings ) {
	$continue_shopping_settings = array(
		array(
			'id'   => 'edd_continue_shopping_settings',
			'name' => '<strong>' . __( 'Continue Shopping Settings', 'edd-continue-shopping' ) . '</strong>',
			'desc' => __( 'Configure Continue Shopping Settings', 'edd-continue-shopping' ),
			'type' => 'header',
		),
		array(
			'id'   => 'edd_continue_shopping',
			'name' => __( 'Disable Continue Shopping', 'edd-continue-shopping' ),
			'desc' => __( 'Disable the Continue Shopping link.', 'edd-continue-shopping' ),
			'type' => 'checkbox',
			'size' => 'regular',
		),
		array(
			'id'          => 'edd_continue_shopping_page',
			'name'        => __( 'Continue Shopping URL', 'edd-continue-shopping' ),
			'desc'        => __( 'This is the page you want to send customers to when they click the Continue Shopping link. If left blank, your default product archives will be used.', 'edd-continue-shopping' ),
			'type'        => 'select',
			'options'     => edd_get_pages(),
			'placeholder' => __( 'Select a page', 'edd-continue-shopping' )
		),
	);
	return array_merge( $settings, $continue_shopping_settings );
}
add_filter( 'edd_settings_extensions', 'eddcs_continue_shopping_settings', 999, 1 );