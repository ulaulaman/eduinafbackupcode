<?php
# nuovo shortcode per listare nella barra gli articoli di uno speciale
function tabspeciali($atts) {
	global $post;
	
	extract(
		shortcode_atts(
			array(
				'speciale' => 'null',
			),
			$atts
		)
	);
	
	#tutti i termini associati all'eventuale speciale associato al post
	$terms = get_the_terms ( $post->ID, 'speciali' );

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term, 'speciali' );
		$toc = $term->slug;
		
		if ( $toc <> $speciale ) {
			$content = null;
		} else {
			$q = new WP_Query( array( 'speciali' => $speciale, 'posts_per_page'=>-1 ) );
			$header = '<h4 class="widget-title h6"><span>Gli articoli dello speciale '.$term->name.'</span></h4>';
		
			if ( $q->have_posts() ) {
				while ( $q->have_posts() ) {
					$q->the_post();
					$titolo = get_the_title();
				
					$content .= '<li><a href="'.get_the_permalink().'">'.$titolo.'</a></li>';
				}
			/* ripristino */
			wp_reset_postdata();
		}
			$content = '<div id="recent-posts-2" class="widget widget_recent_entries">'.$header.'<ul>'.$content.'</ul></div>';
		}
	}

	$content = $content.$after_widget;

	if ( get_post_type() == 'post' ) {
		$out = $content;
	} else {
		$out = null;
	}
	
	return $out;
}
add_shortcode( 'tabspeciali', 'tabspeciali' );
