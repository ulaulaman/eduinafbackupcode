<?php
#
# widget per le sidebar
#

# didattica
class Widget_Didattica extends WP_Widget {
 
	/** Registrazione del widget */
    public function __construct() {
        parent::__construct(
            'widget_dida', // Base ID
            'Widget Didattica', // Name
            array( 'description' => __( 'Widget per l\'inserimento della sidebar dei contenuti didattici', 'text_domain' ), ) // Args
        );
    }
 
    /** Front-end del widget */
    public function widget( $args, $instance ) {
        extract( $args );
		$shortcode = do_shortcode('[sbdidattica]');
        echo $shortcode;
        echo $after_widget;
    }
 
    /** Back-end del widget */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Titolo', 'text_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Titolo:' ); ?></label>
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
 
} // class Widget_Didattica

// Registra Widget_Didattica
add_action( 'widgets_init', 'register_dida' );
     
function register_dida() { 
    register_widget( 'Widget_Didattica' ); 
}

# costellazioni
class Widget_Stars extends WP_Widget {
 
	/** Registrazione del widget */
    public function __construct() {
        parent::__construct(
            'widget_stars', // Base ID
            'Widget Stars', // Name
            array( 'description' => __( 'Widget per l\'inserimento della sidebar delle costellazioni', 'text_domain' ), ) // Args
        );
    }
 
    /** Front-end del widget */
    public function widget( $args, $instance ) {
        extract( $args );
        $shortcode = do_shortcode('[sbcostellazioni]');
        $menu = do_shortcode('[menucostellazioni]');
        echo $shortcode;
        echo $menu;
        echo $after_widget;
    }
 
    /** Back-end del widget */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Titolo', 'text_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Titolo:' ); ?></label>
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
 
} // class Widget_Stars

// Registra Widget_Stars
add_action( 'widgets_init', 'register_stars' );
     
function register_stars() { 
    register_widget( 'Widget_Stars' ); 
}

# corso base
class Widget_Brera extends WP_Widget {
 
	/** Registrazione del widget */
    public function __construct() {
        parent::__construct(
            'widget_brera', // Base ID
            'Widget Brera', // Name
            array( 'description' => __( 'Widget per l\'inserimento della sidebar del corso base di astronomia', 'text_domain' ), ) // Args
        );
    }
 
    /** Front-end del widget */
    public function widget( $args, $instance ) {
        extract( $args );
        $shortcode = do_shortcode('[sbcorsobase]');
        echo $shortcode;
        echo $after_widget;
    }
 
    /** Back-end del widget */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Titolo', 'text_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Titolo:' ); ?></label>
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
 
} // class Widget_Brera

// Registra Widget_Brera
add_action( 'widgets_init', 'register_brera' );
     
function register_brera() { 
    register_widget( 'Widget_Brera' ); 
}

# astrofoto
class Widget_AstroFoto extends WP_Widget {
 
	/** Registrazione del widget */
    public function __construct() {
        parent::__construct(
            'widget_astrofoto', // Base ID
            'Widget Astro Foto', // Name
            array( 'description' => __( 'Widget per l\'inserimento della sidebar delle fotografie astronomiche', 'text_domain' ), ) // Args
        );
    }
 
    /** Front-end del widget */
    public function widget( $args, $instance ) {
        extract( $args );
        $shortcode = do_shortcode('[sbastrofoto]');
        echo $shortcode;
        echo $after_widget;
    }
 
    /** Back-end del widget */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Titolo', 'text_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Titolo:' ); ?></label>
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
 
} // class Widget_AstroFoto

// Registra Widget_AstroFoto
add_action( 'widgets_init', 'register_astrofoto' );
     
function register_astrofoto() { 
    register_widget( 'Widget_AstroFoto' ); 
}