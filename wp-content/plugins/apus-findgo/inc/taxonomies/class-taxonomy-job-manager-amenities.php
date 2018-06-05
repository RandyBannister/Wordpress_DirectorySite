<?php
/**
 * Amenities
 *
 * @package    apus-findgo
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ApusFindgo_Taxonomy_Amenities{

	/**
	 *
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ), 1 );
		add_action( 'cmb2_init', array( __CLASS__, 'metaboxes' ) );
	}

	/**
	 *
	 */
	public static function definition() {
		$labels = array(
			'name'              => __( 'Amenities', 'apus-findgo' ),
			'singular_name'     => __( 'Amenity', 'apus-findgo' ),
			'search_items'      => __( 'Search Amenities', 'apus-findgo' ),
			'all_items'         => __( 'All Amenities', 'apus-findgo' ),
			'parent_item'       => __( 'Parent Amenity', 'apus-findgo' ),
			'parent_item_colon' => __( 'Parent Amenity:', 'apus-findgo' ),
			'edit_item'         => __( 'Edit', 'apus-findgo' ),
			'update_item'       => __( 'Update', 'apus-findgo' ),
			'add_new_item'      => __( 'Add New', 'apus-findgo' ),
			'new_item_name'     => __( 'New Amenity', 'apus-findgo' ),
			'menu_name'         => __( 'Amenities', 'apus-findgo' ),
		);

		register_taxonomy( 'job_listing_amenity', 'job_listing', array(
			'labels'            => apply_filters( 'apus_findgo_taxomony_booking_amenities_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'amenity',
			'rewrite'           => array( 'slug' => __( 'amenity', 'apus-findgo' ) ),
			'public'            => true,
			'show_ui'           => true,
		) );
	}

	public static function metaboxes() {
	    $metabox_id = 'apus_findgo_amenities_options';

	    $cmb = new_cmb2_box( array(
			'id'           => $metabox_id,
			'title'        => '',
			'object_types' => array( 'page' ),
		) );

	    $cmb->add_field( array(
		    'name'    => __( 'Image Icon', 'apus-findgo' ),
		    'id'      => 'icon_image',
		    'type'    => 'file',
		    'options' => array(
		        'url' => false,
		    ),
		    'text'    => array(
		        'add_upload_file_text' => __( 'Add Icon', 'apus-findgo' )
		    )
		) );

	    $cmb->add_field( array(
	        'name'    => __( 'Font Icon', 'apus-findgo' ),
	        'desc' => __( 'You can choose a Font Icon instead using Image Icon. You can using fontawesome icon: http://fontawesome.io/', 'apus-findgo' ),
		    'id'      => 'icon_font',
		    'type'    => 'text'
	    ) );
	    
	    $cats = new Taxonomy_MetaData_CMB2( 'job_listing_amenity', $metabox_id );
	}
}

ApusFindgo_Taxonomy_Amenities::init();