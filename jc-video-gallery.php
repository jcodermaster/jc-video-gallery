<?php

/*
Plugin Name: Video Gallery W/ Lightbox
Plugin URI: www.jcoderchan.com
Description: Video Gallery with Lightbox
Version: 1.0
Author: Jerome Chan
Author URI: http://www.jcoderchan.com/
*/

require_once  dirname( __FILE__ ) . '/functions/jc-video-gallery-cpt.php';
require_once  dirname( __FILE__ ) . '/functions/functions.php';
require_once  dirname( __FILE__ ) . '/assets/vendors/tgm/tgm-config.php';
require_once  dirname( __FILE__ ) . '/acf-files/acf-video.php';

class JC_VIDEO_GALLERY{

    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, 'script_style' ), 1001 );

        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page( array( 
                'page_title' 	=> 'Video Settings',
                'parent'     => 'edit.php?post_type=video-gallery',
                'capability'	=> 'edit_theme_options'
            ));    
        }

    }

    function script_style(){

        $plugin_dir = plugin_dir_path( __FILE__ );
        $plugin_url = plugins_url('jc-video-gallery');
    
        wp_enqueue_style( 'custom-css-course', $plugin_url . '/assets/css/video-gallery.css' );
        wp_enqueue_style( 'custom-css-course', $plugin_url . '/assets/css/bootstrap.min.css' );

    }

    public function get_video_lightbox( $colPerRow, $videoPerpage){

        

        $output = NULL;
        $output .='<div class="jc-video-gal-container">';
            $output .='<div class="container">';
                $output .='<div class="row">';

                    
                    
                $output .='</div>';
            $output .='</div>';
        $output.='</div>';

    }

    

}
new JC_VIDEO_GALLERY();