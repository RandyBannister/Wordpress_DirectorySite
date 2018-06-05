<?php
/**
 * functions
 *
 * @package    apus-findgo
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function apusfindgo_includes( $path, $ifiles=array() ){

    if( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    }else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

function apusfindgo_get_config($name, $default = '') {
    global $apus_options;
    if ( isset($apus_options[$name]) ) {
        return $apus_options[$name];
    }
    return $default;
}

function apusfindgo_get_global_config($name, $default = '') {
    $options = get_option( 'findgo_theme_options', array() );
    if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function apusfindgo_removefilter($tag, $args) {
    remove_filter( $tag, $args );
}

function apusfindgo_addmetaboxes($fnc) {
    add_action( 'add_meta_boxes', $fnc );
}

function apusfindgo_addmetabox_hours($title, $fnc, $textdomain, $position, $priority){
    add_meta_box( 'apusfindgo_hours', $title, $fnc, $textdomain, $position, $priority );
}

function apusfindgo_image_srcset($size_array, $src, $image_meta, $attachment_id) {
    return wp_calculate_image_srcset($size_array, $src, $image_meta, $attachment_id);
}