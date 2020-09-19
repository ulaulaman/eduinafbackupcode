<?php
#
# backup snippet codes
#
# astrodidattica
#
add_shortcode( 'header_didattica', function () {

	$header = '<header><div class="breadcrumb hidden-xs"><div class="vbreadcrumb" typeof="v:Breadcrumb"><a href="https://edu.inaf.it/" property="v:title" class="home">Home</a> / <a href="https://edu.inaf.it/astrodidattica/" property="v:title">Didattica</a></div></div>';
	$title = '<h1 class="entry-title" itemprop="name" style="color:black;">'.get_the_title().'</h1>';
	if ( has_excerpt ()) {
		$excerpt ='<div><em>'.get_the_excerpt().'</em></div>';
	} else {
		$excerpt = '';
	}
	$date = '<div class="breadcrumb hidden-xs"><time class="entry-date">'.get_the_date().'</time></div></header>';
	$out = $header.$title.$date.$excerpt;

	return $out;
} );

# Aggiunta metabox
add_action( 'load-post.php', 'didattica_meta_box_setup' );
add_action( 'load-post-new.php', 'didattica_meta_box_setup' );

# Setup metabox
function didattica_meta_box_setup() {

# aggiunta del metabox
  add_action( 'add_meta_boxes', 'didattica_meta_box' );
}

function didattica_meta_box() {

  $intro = __( 'Reminder shortcode header', 'edu-inaf' );

  add_meta_box(
    'didattica-post-class',      // ID unico
    esc_html__( $intro, 'example' ),    // Titolo
    'didattica_class_meta_box',   // funzione
    'astrodidattica',         // associato a
    'side',         // contesto
    'high'         // priorità
  );
}

# mostra il metabox
function didattica_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'didattica_class_nonce' ); ?>

  <p>
    <label for="didattica-post-class"><?php _e( 'Ricordarsi di inserire un box di testo in cima con lo shortcode [header_didattica]<br/>Per la spalla:<ul><li>Schede didattiche: [sc name="spalla_attivita" dimgruppo="numero studenti" costo="costo"]</li><li>Video lezioni: [sc name="spallavideo"]</li></ul>Shortcode per le introduzioni delle rubriche:<br/><strong>Astrofisica per curiosi</strong>: [curiosi]<br/><strong>Pillole di Martina Cardillo</strong>: [martina]<br/><strong>Pillole di realtà virtuale</strong>: [rv]<br/><strong>Pillole dallo spazio</strong>: [pillole_spazio]', 'edu-inaf' ); ?></label></p>
<?php }

# personalizzazione css font sezioni

add_action( 'wp_head', function () { ?>
	<style>
	
		.astrodidattica-template { font-size: 150%; }
		.astroschede-template { font-size: 150%; }
	
	</style>
	<?php } );

# pillole martina

add_shortcode( 'martina', function () {

	$martina = '<p><em>"Nei giorni del COVID-19 siamo tutti obbligati a stare in casa. Allora, perché non portare un po’ di Universo a casa vostra, direttamente da casa mia?" È quello che fa la romanissima Martina Cardillo, INAF-IAPS, con la sua rubrica didattica "<a href="https://edu.inaf.it/videorubriche/pillole-di-martina-cardillo/">Le pillole di Martina</a>". Dei brevi video in un linguaggio semplice e divertente che raccontano in modo scanzonato l’Universo, il Sistema Solare, la Stazione Spaziale Internazionale, le missioni spaziali e tanti altri argomenti. Per maggiori info sulle pillole potete contattare Martina a martina . cardillo [chiocciola] inaf.it</em></p>';
	$out = $martina;

	return $out;
} );

# pillole realtà virtuale

add_shortcode( 'rv', function () {

	$rv = '<p><em>Grazie all’uso della realtà virtuale è possibile raggiungere e tuffarsi all’interno dei fenomeni più affascinanti dell’universo! Le meravigliose simulazioni che vedrete in questi video divulgativi dell’INAF Osservatorio Astronomico di Palermo sono alla base di ricerche scientifiche che si avvalgono di modelli 3D che riproducono fedelmente gli oggetti astrofisici. Questo nuovo approccio è reso possibile grazie al progetto 3DMAP-VR che ha anche, fra i suoi  obiettivi, quello di rendere accessibile l’esplorazione di questi modelli sviluppati per la ricerca scientifica a scopi didattici e divulgativi.</p><p><a href="https://edu.inaf.it/videorubriche/astronomia-e-modelli-3d/" target="eduinaf">Vedi tutte le pillole della videorubrica</a></em></p>';
	$out = $rv;

	return $out;
} );

add_shortcode( 'inforv', function () {

	$inforv = '<p><a href="http://cerere.astropa.unipa.it/progetti_ricerca/HPC/3dmap_vr.htm" target="inaf">Info sul progetto</a>.</p><p>Orlando, S., Pillitteri, I., Bocchino, F., Daricello, L., &amp; Leonardi, L. (2019). 3DMAP-VR, A Project to Visualize Three-dimensional Models of Astrophysical Phenomena in Virtual Reality. RNAAS, 3(11), 176. doi:<a href="https://doi.org/10.3847/2515-5172/ab5966" target="doi">10.3847/2515-5172/ab5966</a> (<a href="https://arxiv.org/abs/1912.02649v1" target="arxiv">arXiv</a>)</p>Scopri tutte le collezioni 3D per la realtà virtuale</p><p><a href="https://sketchfab.com/sorlando/collections/universe-in-hands" target="3d"><em>Universe in hands</em></a>: contiene modelli fisici sviluppati usando sofisticati codici magnetoidrodinamici per l\'astrofisica largamente utilizzati in astrofisica, tra cui il codice PLUTO sviluppato presso l\'Università di Torino in collaborazione con INAF-OATO.</p><p><a href="https://sketchfab.com/sorlando/collections/the-art-of-astrophysical-phenomena" target="3d"><em>The art of astrophysical phenomena</em></a>: raccoglie i modelli che sono frutto di ricostruzioni artistiche di fenomeni astrofisici sulla base di ciò che sappiamo di questi oggetti.</p><p><a href="https://sketchfab.com/sorlando/collections/the-science-of-science-fiction" target="3d"><em>The Science of Science Fiction</em></a>: I modelli prendono spunto da scene di film di fantascienza, come <em>Star Wars</em>, <em>2001: Odissea nello spazio</em> o <em>Interstellar</em>, per evidenziare quali parti siano scientificamente vere e quali no, e per illustrare fenomeni e concetti di astrofisica.</p><p><a href="https://sketchfab.com/sorlando/collections/anatomy-of-astrophysical-objects" target="3d"><em>Anatomy of astrophysical objects</em></a>: dove i modelli sono dei <em>cartoon</em> che descrivono la struttura di oggetti astronomici.</p>';
	$out = $inforv;

	return $out;
} );

# astrofisica per curiosi

add_shortcode( 'curiosi', function () {

	$curiosi = '<p><em><strong>Gabriele Ghisellini</strong>, INAF Osservatorio Astronomico di Brera, ci regala una serie di interessanti video pillole ispirate dal suo libro, Astrofisica per curiosi (<a href="https://www.hoepli.it/libro/astrofisica-per-curiosi/9788820389420.html" target="hoepli">vedi la scheda del libro</a>). Guarda esperimenti, storie e racconti <a href="https://edu.inaf.it/videorubriche/astrofisica-per-curiosi/">nella rubrica Astrofisica per curiosi</a>, e se vuoi saperne di più, leggi anche il suo libro, di cui trovi la <a href="https://edu.inaf.it/rubriche/libri/astrofisica-per-curiosi/" target="eduinaf">nostra recensione su EduINAF</a>.</em></p>';
	$out = $curiosi;

	return $out;
} );

# pillole dallo spazio

add_shortcode( 'pillole_spazio', function () {

	$pillole = '<p><em>La ricerca astrofisica di oggi, spiegata in modo semplice e pratico, con le voci dei ricercatori che ci lavorano. <a href="https://edu.inaf.it/videorubriche/pillole-dallo-spazio/">Pillole dallo Spazio</a> è una rubrica mensile dedicata all’attualità scientifica e realizzata in collaborazione tra INAF Osservatorio di Astrofisica e Scienza dello Spazio di Bologna e SOFOS. A cura di Antonio de Blasi e Sandro Bardelli.</em></p>';
	$out = $pillole;

	return $out;
} );

# immagini livelli dida

add_shortcode( 'livelli_img', function () {
	
	$img = '<div align="center"><img src="https://edu.inaf.it/wp-content/plugins/eduinaf/images/avatar_eduinaf_blu.png" width="40%" /></div>';
	$terms = get_the_terms( $post->ID, 'livello_educativo' ); 
	$numcat=sizeof($terms);
 	foreach ( $terms as $term ) { 
		$term_link = get_term_link( $term, 'livello_educativo' );
		$img = $img.'<a rel="tag" href="'.$term_link.'" title="Vedi tutte le attività del livello: '.$term->name.'"><img src="https://edu.inaf.it/wp-content/plugins/eduinaf/images/'.$term->slug.'.png" width="25%" /></a>';
	}
	
	$out = $img;

	return $out;
} );

# videorubriche

add_shortcode( 'videorubriche', function () {

	$pillole = '<h3>Le nostre videorubriche</h3><p>Tutte le <a href="https://edu.inaf.it/videorubriche/">Videorubriche</a></p>
	<ul><li><a href="https://edu.inaf.it/videorubriche/astrofisica-per-curiosi/">Astrofisica per curiosi</a></li><li><a href="https://edu.inaf.it/videorubriche/pillole-di-martina-cardillo/">Le pillole di Martina</a></li><li><a href="https://edu.inaf.it/videorubriche/astronomia-e-modelli-3d/">Astronomia e modelli 3D</a></li><li><a href="https://edu.inaf.it/videorubriche/pillole-dallo-spazio/">Pillole dallo spazio</a></li></ul>';
	$out = $pillole;

	return $out;
} );

# newsletter

add_shortcode( 'newsletter', function () {

	$inforv = '<p>Vuoi restare aggiornato sulle novità di Edu INAF? Iscriviti alla lista di distribuzione inviando un email a:  Newsletter.edu+subscribe [chiocciola] inaf.it<br/>In qualasiasi momento potete cancellare l\'iscrizione semplicemente inviando un\'email a Newsletter.edu+unsubscribe [chiocciola] inaf</p>';
	$privacy = '<p>La redazione garantisce che il trattamento dei dati personali (nome, cognome ed indirizzo email) avviene nel rispetto della normativa sulla privacy (Regolamento (UE) 2016/679 e Codice privacy, di cui al Decreto legislativo n. 196/2003) e dei principi di correttezza, liceità e trasparenza e di tutela della tua riservatezza e dei tuoi diritti e potrà essere svolto in via manuale o in via elettronica, o comunque con l’ausilio di strumenti informatizzati o automatizzati, al solo fine di fornire il servizio richiesto e, per tale ragione, saranno conservati esclusivamente per il periodo in cui lo stesso sarà attivo. Il Titolare del trattamento è l’INAF - Istituto Nazionale di Astrofisica, con sede legale in Roma, viale del Parco Mellini, 84 – 00136. I tuoi dati sono trattati dai personale e dai collaboratori dell’INAF autorizzati dal Titolare al trattamento, in relazione alle loro funzioni e mansioni, o dalle imprese espressamente designate quali Responsabili delle attività di trattamento ai sensi dell’art. 28 GDPR. Gli interessati hanno il diritto di chiedere al titolare del trattamento l’accesso ai dati personali e la rettifica o la cancellazione degli stessi o la limitazione del trattamento che li riguarda o di opporsi al trattamento (artt. 15 e ss. del Regolamento (UE) 2016/679). L’apposita istanza all’INAF è presentata contattando il Responsabile della Protezione dei Dati presso l’Istituto (Istituto Nazionale di Astrofisica – Responsabile della protezione dei dati personali, viale del Parco Mellini, 84, 00136 Roma; email: rpd@inaf.it; PEC: rpd-inaf@legalmail.it). Gli interessati che ritengono che il trattamento dei dati personali a loro riferiti effettuato attraverso questo servizio avvenga in violazione di quanto previsto dal Regolamento hanno il diritto di proporre reclamo al Garante, come previsto dall\'art. 77 del Regolamento stesso, o di adire le opportune sedi giudiziarie (art. 79 del Regolamento).</p>';
	$out = $inforv.$privacy;

	return $out;
} );

# header astroschede

add_shortcode( 'header_astroschede', function () {

	$header = '<div class="divTable paleBlueRows">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead" align="center"><a href="https://edu.inaf.it/astroschede/" target="eduinaf" style="color:white;">Schede astronomiche</a></div>
<div class="divTableHead" align="center"><a href="http://edu.inaf.it/index.php/category/rubriche/il-cielo-del-mese/" target="eduinaf" style="color:white;">Il cielo del mese</a></div>
<div class="divTableHead" align="center"><a href="https://edu.inaf.it/index.php/costellazioni/costellazioni/" target="eduinaf" style="color:white;">Le costellazioni</a></div>
</div>
</div>
</div>';
	$title = '<h1 class="entry-title" itemprop="name" style="color:black;">'.get_the_title().'</h1>';
	$out = $header.$title;

	return $out;
} );
