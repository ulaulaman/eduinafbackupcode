<?php
# tassonomia per gli speciali
function speciali_tax() {
	$labels = array(
		'name' => _x('Speciali', 'taxonomy general name'),
		'singular_name' => _x('Speciale', 'taxonomy singular name'),
		'all_items' => __('Tutti gli speciali'),
		'edit_item' => __('Modifica speciale'), 
		'update_item' => __('Aggiorna speciale'),
		'add_new_item' => __('Aggiungi un nuovo speciale'),
		'new_item_name' => __('Nuovo speciale'),
		'menu_name' => __('Speciali'),
	);

	register_taxonomy(
		'speciali',
		array('post','astrodidattica'), /* per estendere array('post','page','custom-post-type') */
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'speciali'),
		)
	);
}
add_action('init', 'speciali_tax', 0);

# shortcode per la creazione della griglia per la pagina degli speciali
function grigliaspeciali($atts) {
	global $post;
	
	extract(
		shortcode_atts(
			array(
				'speciale' => null,
				'tipo' => null,
			),
			$atts
		)
	);
	
	if ( $tipo == null ) {
		$tipo = 'post';
	}

	$q = new WP_Query( array( 'speciali' => $speciale, 'post_type'=> $tipo, 'posts_per_page'=>-1 ) );
	$contentblu ='<div class="divTable paleBlueRows">';
	
	if ( $q->have_posts() ) {
		while ( $q->have_posts() ) {
			$q->the_post();
			$titolo = get_the_title();

			if ( $tipo == 'post' ) {
				if ( function_exists( 'get_coauthors' ) ) {
					$autori = coauthors_posts_links(", ", " e ", null, null, false);
				} else {
					$autori = the_author();
				}
			} else {
				$autori = null;
			}

			if ( $autori <> null ) {
				$auth = '<em>di <strong>'.$autori.'</strong></em><br/>';
			} else {
				$auth = null;
			}
			
			$estratto = get_the_excerpt();

			/* griglia con titolo ed estratto: stilizzazione minimale */
			$header = '<h4 style="color: #ecb252;">'.$titolo.'</h4>';

			/* griglia con titolo ed estratto: formato tabella */
			$headerblu = '<div class="divTableHeading"><div class="divTableRow"><div class="divTableHead">'.$titolo.'</div></div></div>';
			$contentblu .= $headerblu.'<div class="divTableBody"><div class="divTableRow"><div class="divTableCell">'.$auth.$estratto.'<br/>(<a href="'.get_the_permalink().'" style="color: #1d71b8;">continua</a>)</div></div></div>';
		}
		
		$contentblu = $contentblu.'</div>';
		
		/* ripristino */
		wp_reset_postdata();
	} else  {
		$contentblu = null;
	}
	
	return $contentblu;
}
add_shortcode( 'grigliaspeciali', 'grigliaspeciali' );

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
