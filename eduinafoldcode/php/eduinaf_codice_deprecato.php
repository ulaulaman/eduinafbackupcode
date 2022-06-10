/* Momentaneamente escluso */

$auth = null;
	$custom = get_post_custom();
	foreach( $custom as $key => $value ) {
		$key_name = get_post_custom_values( $key = 'autore_attivita' );
		if ( $key_name[0] <> null ) {
			$auth1 = '<strong>'.$key_name[0].'</strong>';
		} else {
			$auth1 = null;
		}
		if ( $key_name[1] <> null ) {
			$auth2 = ', <strong>'.$key_name[1].'</strong>';
		} else {
			$auth2 = null;
		}
		if ( $key_name[2] <> null ) {
			$auth3 = ', <strong>'.$key_name[2].'</strong>';
		} else {
			$auth3 = null;
		}
		if ( $key_name[3] <> null ) {
			$auth4 = ', <strong>'.$key_name[3].'</strong>';
		} else {
			$auth4 = null;
		}
		
		$auth = $auth1.$auth2.$auth3.$auth4;
	}

/* Non più utilizzato */

# inclusione di grid.css
# function edu_inaf_to_the_head () {
#   wp_register_style( 'grid', plugins_url( 'eduinaf/incl/grid.css' ) );
#   wp_enqueue_style( 'grid' );
# }
#
#add_action( 'wp_enqueue_scripts', 'edu_inaf_to_the_head' );

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

/* snippet cancellati */

# header didattica

add_shortcode( 'header_didattica', function () {

	$header = '<header><div class="breadcrumb hidden-xs"><div class="vbreadcrumb" typeof="v:Breadcrumb"><a href="https://edu.inaf.it/" property="v:title" class="home">Home</a> / <a href="https://edu.inaf.it/astrodidattica/" property="v:title">Didattica</a></div></div>';
	$title = '<h1 itemprop="name" style="color:black;">'.get_the_title().'</h1>';
	if ( has_excerpt ()) {
		$excerpt ='<div><em>'.get_the_excerpt().'</em></div>';
	} else {
		$excerpt = '';
	}
	$date = '<div class="breadcrumb hidden-xs"><time class="entry-date">'.get_the_date().'</time></div></header>';
	$out = $header.$title.$date.$excerpt;

	return $out;
} );

# griglia per loop generico per categoria ed etichetta
add_shortcode ( 'grigliaeduinaf', 'grigliaeduinaf');

 function grigliaeduinaf ($atts) {
   
   extract(
      shortcode_atts(
         array(
           'categoria' => 'null',
           'etichetta' => 'null',
          ),
         $atts
      )
   );

   if ( $categoria <> 'null' ) {
     if ( $etichetta <> 'null' ) {
       $q = new WP_Query( array( 'category_name' => $categoria, 'tag' => $etichetta, 'posts_per_page'=>-1 ) );
     }
     else {
       $q = new WP_Query( array( 'category_name' => $categoria, 'posts_per_page'=>-1 ) );
     }
   }
   else {
     if ( $etichetta <> 'null' ) {
       $q = new WP_Query( array( 'tag' => $etichetta, 'posts_per_page'=>-1 ) );
     }
     else { $q = new WP_Query( array( 'categoria' => 'beta', 'posts_per_page'=>0 ) );}
   }

   $grid = '<ul class="grid-wrap">';

   if ( $q->have_posts() ) {
	while ( $q->have_posts() ) {
		$q->the_post();
                $thumb = get_the_post_thumbnail($post->ID, 'thumbnail');
		$grid = $grid.'<li class="grid-item"><span class="grid-border"><a href="'.get_the_permalink().'">'.$thumb.'</a><h4>'.get_the_title().'</h4></span></li>';
	}
	$grid = $grid.'</ul>';
	# ripristino ricerca
	wp_reset_postdata();
   } else {
	$grid = '<p><strong>Nessun articolo trovato</strong></p>';
   }

   return $grid;

 }
 
 # creazione della griglia per il loop dei libri: pesca il campo del titolo del libro
add_shortcode( 'griglialibri', 'griglialibri' );

 function griglialibri ($atts) {

   global $post; #https://wordpress.stackexchange.com/questions/43315/use-a-shortcode-to-display-custom-meta-box-contents

   extract(
      shortcode_atts(
         array( 
                'etichetta' => 'libri-per-bambini-e-ragazzi',
	 ),
         $atts
      )
   );

   $q = new WP_Query( array( 'category_name' => 'libri', 'tag' => $etichetta, 'posts_per_page'=>-1 ) );
   $grid = '<ul class="grid-wrap">';

   if ( $q->have_posts() ) {
	while ( $q->have_posts() ) {
		$q->the_post();
		
		# recupero dei valori dei campi personalizzati definiti in metabox.php
                $customtitlevalue = get_post_meta($post->ID, "meta-titolo", true);
                $thumb = get_the_post_thumbnail($post->ID, 'thumbnail');
		
		# ciclo if che sostituisce, se presente, il titolo del post con il titolo del libro
                if ( $customtitlevalue <> 'null') {
                  $titolo = $customtitlevalue;
                }
                else
                {
                  $titolo = get_the_title();
                }
		$grid = $grid.'<li class="grid-item"><a href="'.get_the_permalink().'">'.$thumb.'</a><h4>'.$titolo.'</h4></li>';
	}
	$grid = $grid.'</ul>';
	# ripristino ricerca
	wp_reset_postdata();
   } else {
	$grid = '<p><strong>Nessun articolo trovato</strong></p>';
   }

   return $grid;

 }
