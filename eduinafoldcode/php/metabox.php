<?php
# metabox per il caricamento di informazioni aggiuntive da utilizzare nella griglia personalizzata di eduinaf relativamente ai libri
# guida: http://themefoundation.com/wordpress-meta-boxes-guide/

# aggiunta del metabox
function eduinaf_book_meta() {
    add_meta_box( 'eduinaf_book', __( 'Informazioni aggiuntive', 'eduinaf-textdomain' ), 'eduinaf_book_callback', 'post', 'side' );
}
add_action( 'add_meta_boxes', 'eduinaf_book_meta' );

# costruzione del metabox
function eduinaf_book_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'eduinaf__nonce' );
    $eduinaf_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-titolo" class="eduinaf-row-title"><?php _e( 'Inserisci il titolo del libro', 'eduinaf-textdomain' )?></label>
        <input type="text" name="meta-titolo" id="meta-titolo" value="<?php if ( isset ( $eduinaf_stored_meta['meta-titolo'] ) ) echo $eduinaf_stored_meta['meta-titolo'][0]; ?>" />
    </p>
 
    <?php
}

# salvataggio campi
function eduinaf_book_meta_save( $post_id ) {

    # controlla lo stato del post
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'eduinaf_nonce' ] ) && wp_verify_nonce( $_POST[ 'eduinaf_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    # uscita in funzione dello stato
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    # controllo dell'input e sanitizza/salva se necessario
    if( isset( $_POST[ 'meta-titolo' ] ) ) {
        update_post_meta( $post_id, 'meta-titolo', sanitize_text_field( $_POST[ 'meta-titolo' ] ) );
    }
 
}
add_action( 'save_post', 'eduinaf_book_meta_save' );
