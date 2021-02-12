<?php 

class JC_VIDEO_SHORTCODES{

    public static function video_gallery_create_shortcode( $atts ){

        $a = shortcode_atts( array(
            'header'              => 'Your Header',
            'sub_header'          => '',
            'video_gallery_id'    => '',
            'video_gallery_type'  => 'grid',
            'video_per_row'       => '3',
            'video_per_page'      => '-1',
            'no_list_msg'         => 'No Video Found',
            'class'               => 'video-gallery-container',
            'id'                  => '',
        ), $atts );

        $colClass = $this->get_column_class($a['video_per_row']);
        $v_query = new WP_Query( array(
                        'post_type'   => 'video-gallery', 
                        'p'           => $a['video_gallery_id']
                        ) );

        ob_start(); 
?>
        <section class="video-section <?php echo $a['class']; ?>" id="<?php echo $a['id']; ?>">
            <div class="container">
                <div class="jcvg-heading-subheading">
                    <div class="jcvg-heading"><h1><?php echo $a['header'] ?></h1></div>
                    <div class="jcvg-sub-heading"><h4><?php echo $a['sub_header'] ?></h4></div>
                </div>
                <div class="video-row row">
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

                                if ( !empty($youtube_video) ) {
                                    $yt_id = $youtube_video;
                                }

                                if ( $youtube_preview_image ) {
                                    $vid_preview_url = $upload_youtube_image;
                                } else if ( !empty($youtube_video_external_url) ) {
                                    $vid_preview_url = $youtube_video_external_url;
                                } else {
                                    $vid_preview_url = 'https://img.youtube.com/vi/'.$yt_id.'/mqdefault.jpg';
                                }
                                if ( $type_of_video == 'youtube_video'){
                                    $vid_url = 'https://www.youtube.com/watch?v='.$yt_id;
                                } else if ( $type_of_video == 'mp4_video' ) {
                                    $vid_url = $video_source;
                                }
                                

                        ?>
                            <div class="video-columns <?php echo $colClass; ?>">
                                <?php echo do_shortcode('[video_popup url="'.$vid_url.'" img="'.$vid_preview_url.'"]');?>
                            </div>
                        <?php endwhile; wp_reset_query();?>
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
        return $col_class;
    }

    public function __construct(){
        add_shortcode('jc_video_gallery', array($this, 'video_gallery_create_shortcode'));
    }

}

new JC_VIDEO_SHORTCODES();