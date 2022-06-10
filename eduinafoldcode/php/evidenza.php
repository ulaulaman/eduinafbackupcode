<?php
#griglia per la home page
add_shortcode ( 'grigliaevidenza', 'grigliaevidenza');

 function grigliaevidenza () {
   

   $qtax = array(
        array (
            'taxonomy' => 'collezioni',
            'field' => 'slug',
            'terms' => 'evidenza',
        )
    );

   $q0 = new WP_Query( array( 'posts_per_page' => 1,
        'tax_query' => $qtax,
   ));
   $q = new WP_Query( array( 'posts_per_page' => 4, 'offset' => 1,
        'tax_query' => $qtax,
   ));

   $gridup = '<div class="evidenza">';

   if ( $q0->have_posts() ) {
	while ( $q0->have_posts() ) {
		$q0->the_post();
                $thumb = get_the_post_thumbnail($post->ID, 'full');
		$gridup = $gridup.'<div class="up"><span class="grid-border"><a href="'.get_the_permalink().'">'.$thumb.'</a><h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4></span></div>';
	}
	$gridup = $gridup.'</div><p></p>';
	/* ripristino */
	wp_reset_postdata();
   } else {
	$gridup = '<p><strong>Nessun articolo trovato</strong></p>';
   }

   $grid = $gridup.'<div class="evidenza">';

   if ( $q->have_posts() ) {
	while ( $q->have_posts() ) {
		$q->the_post();
                $thumb = get_the_post_thumbnail($post->ID, 'thumbnail');
		$grid = $grid.'<div><span class="grid-border"><a href="'.get_the_permalink().'">'.$thumb.'</a><h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4></span><div class="entry-meta" style="padding: 10px;"><time class="entry-date">'.get_the_date().'</time></div></div>';
	}
	$grid = $grid.'</div>';
	/* ripristino */
	wp_reset_postdata();
   } else {
	$grid = '<p><strong>Nessun articolo trovato</strong></p>';
   }

   return $grid;

 }
