<?php
#
# widget per gli shortcode
#
class Widget_Shortcode extends WP_Widget {
 
	/** Registrazione del widget */
    public function __construct() {
        parent::__construct(
            'widget_shortcode', // Base ID
            'Widget Shortcode', // Name
            array( 'description' => __( 'Widget per l\'inserimento degli shortcode nelle sidebar', 'text_domain' ), ) // Args
        );
    }

    /** Back-end del widget */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'blog-post-coauthors', 'text_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Codice shortcode:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>
    <?php
    }
 
    /** Ripulisce i valori del widget man mano che vengono salvati */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
 
        return $instance;
    }
	
	/** Front-end del widget */
    public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
        extract( $args );
        $shortcode = do_shortcode('['.$title.']');
        echo $shortcode;
        echo $after_widget;
    }
 
}

// class Widget_Shortcode

// Registra Widget_Shortcode
add_action( 'widgets_init', 'register_wdshortcode' );
     
function register_wdshortcode() { 
    register_widget( 'Widget_Shortcode' );
}