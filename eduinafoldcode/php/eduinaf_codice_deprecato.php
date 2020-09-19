/* Deprecrato in attesa di capire come realizzare uno stile che eviti errori nella barra laterale */

#shortcode per mostrare in una tabella l'elenco degli articoli di uno speciale: da utilizzare in un widget di testo in attesa di creare un widget vero e proprio
function specialishort($atts) {
	
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
	$term_list = wp_get_post_terms($post->ID, 'speciali', array("fields" => "all"));
	#estrazione del nome dello speciale associato al post
	$nomespeciale = $term_list[0]->name;
	
	if ($nomespeciale <> $speciale) { $content = null; } else {
		$q = new WP_Query( array( 'speciali' => $speciale, 'posts_per_page'=>-1 ) );
		$header = '<div class="divTable paleBlueRows"><div class="divTableHeading"><div class="divTableRow"><div class="divTableHead"><strong>Speciale '.$speciale.'</strong></div></div></div>';
		
		if ( $q->have_posts() ) {
			while ( $q->have_posts() ) {
				$q->the_post();
				$titolo = get_the_title();
				if ( function_exists( 'get_coauthors' ) ) {
					$autori = coauthors_posts_links(", ", " e ", null, null, false);
				} else {
					$autori = the_author();
				}
				$estratto = get_the_excerpt();
				
				$content .= '<div class="divTableBody"><div class="divTableRow"><div class="divTableCell"><a href="'.get_the_permalink().'" style="color: #1d71b8;">'.$titolo.'</a></div></div></div>';
			}
			/* ripristino */
			wp_reset_postdata();
		}
	}
	
	$content = '<p>'.$header.$content.'</div></p>';
	
	return $content;
}
add_shortcode( 'specialishort', 'specialishort' );
