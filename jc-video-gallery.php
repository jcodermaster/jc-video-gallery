<?php

/*
Plugin Name: Video Gallery W/ Lightbox
Plugin URI: www.jcoderchan.com
Description: Video Gallery with Lightbox
Version: 1.0
Author: Jerome Chan
Author URI: http://www.jcoderchan.com/
*/

require_once  dirname( __FILE__ ) . '/functions/functions.php';
require_once  dirname( __FILE__ ) . '/assets/vendors/tgm/tgm-config.php';
require_once  dirname( __FILE__ ) . '/acf-files/acf-video.php';
require_once  dirname( __FILE__ ) . '/acf-files/acf-page-video-settings.php';

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

        function add_jcvg_to_page( $content ) {

            global $post;

            $postID = get_the_ID();

            $jcvg_video_gallery_enable = get_field('jcvg_video_gallery_enable', $postID);
            $jcvg_videogal_heading = get_field('jcvg_videogal_heading', $postID);
            $jcvg_videogal_gallery_id = get_field('jcvg_videogal_gallery_id', $postID);
            $jcvg_videogal_sub_heading = get_field('jcvg_videogal_sub_heading', $postID);
            $jcvg_video_template = get_field('jcvg_video_template', $postID);
            $jcvg_video_per_row = get_field('jcvg_video_per_row', $postID);
            $jcvg_video_per_page = get_field('jcvg_video_per_page', $postID);
            $jcvg_class_optional = get_field('jcvg_class_optional', $postID);
            $jcvg_id_optional = get_field('jcvg_id_optional', $postID);


            
            if ( $jcvg_video_gallery_enable ){
                return $content . '[jc_video_gallery header="'.$jcvg_videogal_heading.'" sub_header="'.$jcvg_videogal_sub_heading.'" video_gallery_id='.$jcvg_videogal_gallery_id.' video_gallery_type="'.$jcvg_video_template.'" video_per_row="'.$jcvg_video_per_row.'" video_per_page="'.$jcvg_video_per_page.'" class="'.$jcvg_class_optional.'" id="'.$jcvg_id_optional.'"]';
            }
            
        }
        add_filter( 'the_content', 'add_jcvg_to_page' );

    }

    function script_style(){

        $plugin_dir = plugin_dir_path( __FILE__ );
        $plugin_url = plugins_url('jc-video-gallery');
    
        wp_enqueue_style( 'custom-css-course', $plugin_url . '/assets/css/video-gallery.css' );
        wp_enqueue_style( 'custom-css-course', $plugin_url . '/assets/css/bootstrap.min.css' );

    }


}
new JC_VIDEO_GALLERY();