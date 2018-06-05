<?php
/**
 * claim
 *
 * @package    apus-findgo
 * @author     Apusthemes <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  2015-2016 Apus Framework
 */
 
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class ApusFindgo_Post_Type_Claim {

  	public static function init() {
  		if ( !apusfindgo_get_global_config('listing_products_enable', true) ) {
            return;
        }
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );

    	add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );
    	add_filter( 'manage_edit-job_claim_columns', array( __CLASS__, 'custom_columns' ) );
		add_action( 'manage_job_claim_posts_custom_column', array( __CLASS__, 'custom_columns_manage' ) );

  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => esc_html__( 'Claim', 'apus-findgo' ),
			'singular_name'         => esc_html__( 'Claim', 'apus-findgo' ),
			'add_new'               => esc_html__( 'Add New Claim', 'apus-findgo' ),
			'add_new_item'          => esc_html__( 'Add New Claim', 'apus-findgo' ),
			'edit_item'             => esc_html__( 'Edit Claim', 'apus-findgo' ),
			'new_item'              => esc_html__( 'New Claim', 'apus-findgo' ),
			'all_items'             => esc_html__( 'Claims', 'apus-findgo' ),
			'view_item'             => esc_html__( 'View Claim', 'apus-findgo' ),
			'search_items'          => esc_html__( 'Search Claim', 'apus-findgo' ),
			'not_found'             => esc_html__( 'No Claims found', 'apus-findgo' ),
			'not_found_in_trash'    => esc_html__( 'No Claims found in Trash', 'apus-findgo' ),
			'parent_item_colon'     => '',
			'menu_name'             => esc_html__( 'Claims', 'apus-findgo' ),
	    );

	    register_post_type( 'job_claim',
	      	array(
		        'labels'            => apply_filters( 'apus_findgo_postype_fields_labels' , $labels ),
		        'supports'          => array( 'title' ),
		        'public'            => true,
		        'has_archive'       => false,
		        'publicly_queryable' => false,
		        'menu_position'     => 52,
		        'show_in_menu'		=> 'edit.php?post_type=job_listing',
	      	)
	    );

  	}
  	
  	public static function metaboxes(array $metaboxes){
		$prefix = 'findgo_claim_';
	    
	    $metaboxes[ $prefix . 'settings' ] = array(
			'id'                        => $prefix . 'settings',
			'title'                     => esc_html__( 'Claim Information', 'apus-findgo' ),
			'object_types'              => array( 'job_claim' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => self::metaboxes_fields()
		);

	    return $metaboxes;
	}

	public static function metaboxes_fields() {
		
		$prefix = 'findgo_claim_';
		$listings = array();
		if ( is_admin() ) {
			$args = array(
				'post_type' => 'job_listing',
				'posts_per_page' => -1,
				'status' => 'public'
			);
			$loop = new WP_Query($args);

			if ( $loop->have_posts() ) {
				foreach ($loop->posts as $listing) {
					$listings[$listing->ID] = $listing->post_title;
				}
			}
		}
		$fields =  array(
			array(
				'name' => esc_html__( 'Claim For', 'apus-findgo' ),
				'id'   => $prefix."claim_for",
				'type' => 'select',
				'options' => $listings
			),
			array(
				'name' => esc_html__( 'Status', 'apus-findgo' ),
				'id'   => $prefix."status",
				'type' => 'select',
				'options' => array(
					'pending' => esc_html__( 'Pending', 'apus-findgo' ),
					'approved' => esc_html__( 'Approved', 'apus-findgo' ),
					'decline' => esc_html__( 'Decline', 'apus-findgo' ),
				)
			),
			array(
				'name' => esc_html__( 'Claim Detail', 'apus-findgo' ),
				'id'   => $prefix."detail",
				'type' => 'textarea',
			),
			
		);  
		
		return apply_filters( 'apus_findgo_postype_fields_metaboxes_fields' , $fields );
	}

	public static function custom_columns($fields) {
		$fields = array(
			'cb' 				=> '<input type="checkbox" />',
			'title' 			=> esc_html__( 'Title', 'apus-findgo' ),
			'author' 			=> esc_html__( 'Author', 'apus-findgo' ),
			'status' 		=> esc_html__( 'Status', 'apus-findgo' ),
			'date' 		=> esc_html__( 'Date', 'apus-findgo' ),
		);
		
		return $fields;
	}

	public static function custom_columns_manage( $column ) {
		global $post;
		switch ( $column ) {
			case 'status':
				$status = get_post_meta( get_the_ID(), 'findgo_claim_status', true );
				$statuses = array(
					'pending' => esc_html__( 'pending', 'apus-findgo' ),
					'approved' => esc_html__( 'Approved', 'apus-findgo' ),
					'decline' => esc_html__( 'Decline', 'apus-findgo' ),
				);
				echo isset($statuses[$status]) ? $statuses[$status] : '';
				break;
		}
	}
}

ApusFindgo_Post_Type_Claim::init();