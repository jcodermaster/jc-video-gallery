<?php 

class JC_VIDEO_SHORTCODES{

    public static function video_gallery_create_shortcode( $atts ){

        $a = shortcode_atts( array(
            'header'              => 'Your Header',
            'video_gallery_id'    => '',
            'categories'          => '',
            'video_gallery_type'  => 'grid',
            'video_per_row'       => '3',
            'video_per_page'      => '-1',
            'no_list_msg'         => 'No Upcoming Events',
            'class'               => 'video-gallery-container'
        ), $atts );

        $colClass = get_column_class($a['video_per_row']);
        $v_query = new WP_Query( array(
                        'post_type'        => 'jc-video-gallery', 
                        'p'                => $a['video_gallery_id']
                        ) );

        ob_start(); 
?>
    <div class="<?php echo $a['class']; ?>">
        <section class="video-section">
            <div class="video-row">
                <?php if ( $v_query->have_posts() ) : $v_query->the_post(); ?>
                    <?php
                        while( have_rows('videos_settings') ) : the_row(); 
                            $type_of_video = get_sub_field('type_of_video');
                            $video_preview_image = get_sub_field('video_preview_image');
                            $video_upload_image = get_sub_field('video_upload_image');
                            $video_external_url = get_sub_field('video_external_url');
                            $video_source = get_sub_field('video_source');
                            $video_external_source_url = get_sub_field('video_external_source_url');
                            $youtube_preview_image = get_sub_field('youtube_preview_image');
                            $upload_youtube_image = get_sub_field('upload_youtube_image');
                            $youtube_video_external_url = get_sub_field('youtube_video_external_url');
                            $youtube_video = get_sub_field('youtube_video');
                    ?>
                        <div class="video-columns <?php echo $colClass; ?>">
                            <?php echo do_shortcode('[video_popup url="" img=""]');?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
        return ob_get_clean();

    }

    public function get_video_type( $vid_type){

    }

    public function get_column_class( $numCol ){
        if( $numCol == '4'){
            $col_class = 'col-md-3';
        } else if ( $numCol == '3'){
            $col_class = 'col-md-4';
        } else if ( $numCol == '2'){
            $col_class = 'col-md-6';
        } else if ( $numCol == '1'){
            $col_class = 'col-md-12';
        } else {
            $col_class = 'col-md-12';
        }
    }

    public function __construct(){
        add_shortcode('jc_video_gallery', array($this, 'video_gallery_create_shortcode'));
    }

}

new JC_VIDEO_SHORTCODES();