<?php
#
# backup snippet codes
#

/* Metabox didattica */

# Aggiunta metabox
add_action( 'load-post.php', 'didattica_meta_box_setup' );
add_action( 'load-post-new.php', 'didattica_meta_box_setup' );

# Setup metabox
function didattica_meta_box_setup() {

# aggiunta del metabox
  add_action( 'add_meta_boxes', 'didattica_meta_box' );
}

function didattica_meta_box() {

  $intro = __( 'Reminder shortcode videorubriche', 'edu-inaf' );
	
	#$screens = get_post_types();
	
	$screens = array ( 'astrodidattica' );
	
	foreach ( $screens as $screen ) {

  add_meta_box(
    'didattica-post-class',      // ID unico
    esc_html__( $intro, 'example' ),    // Titolo
    'didattica_class_meta_box',   // funzione
    $screen,         // associato a
    'side',         // contesto
    'high'         // priorità
  );
}
	}

# mostra il metabox
function didattica_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'didattica_class_nonce' ); ?>

  <p>
    <label for="didattica-post-class"><?php _e( 'Shortcode per le introduzioni delle rubriche:<br/><strong>Astrofisica per curiosi</strong>: [curiosi]<br/><strong>Pillole di Martina Cardillo</strong>: [martina]<br/><strong>Pillole di realtà virtuale</strong>: [rv]<br/><strong>Pillole dallo spazio</strong>: [pillole_spazio]', 'edu-inaf' ); ?></label></p>
<?php }

/* personalizzazione css */

add_action( 'wp_head', function () { ?>
<style>
	.astrodidattica .meta-category { display:none; }
	.astrodidattica .herald-post-thumbnail-single { display:none; }
	.astrodidattica #extras { display:none; }
	.astrodidattica .co-author { display:none; }
	
	.astrofoto .meta-category { display:none; }
	
	.costellazioni .meta-category { display:none; }
	
	.astroschede-template .entry-title { display:none; }
	.astroschede-template .entry-meta { display:none; }
	.astroschede-template .entry-headline { display:none; }
	.astroschede-template .meta-category { display:none; }
	.astroschede-template .herald-sidebar { display:none; }
	.astroschede-template .herald-post-thumbnail-single { display:none; }
	.astroschede-template #extras { display:none; }
	
	.page-id-16929 .entry-title { display:none; }
	.page-id-18718 .entry-title { display:none; }
	.page h1.entry-title { display:none; }
	
	.entry-headline { font-style: italic; }
	
	.twitter-tweet { margin:auto; }
	.fb-post { margin:auto;border:none;overflow:hidden }
	
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

# menu videorubriche

add_shortcode( 'videorubriche', function () {

	$pillole = '<h4>Le nostre videorubriche</h4><div class="btn-group"><button><a href="https://edu.inaf.it/videorubriche/">Tutte le videorubriche</button><button><a href="https://edu.inaf.it/videorubriche/astrofisica-per-curiosi/">Astrofisica per curiosi</a></button><button><a href="https://edu.inaf.it/videorubriche/pillole-di-martina-cardillo/">Le pillole di Martina</a></button><button><a href="https://edu.inaf.it/videorubriche/pillole-dallo-spazio/">Pillole dallo spazio</a></button><button><a href="https://edu.inaf.it/videorubriche/astronomia-e-modelli-3d/">Astronomia e modelli 3D</a></button></div>';
	$out = $pillole;

	return $out;
} );

# newsletter

add_shortcode( 'newsletter', function () {

	$inforv = '<p>Vuoi restare aggiornato sulle novità di Edu INAF? Iscriviti alla lista di distribuzione inviando un email a:  <strong>Newsletter.edu+subscribe [chiocciola] inaf.it</strong><br/>In qualasiasi momento potete cancellare l\'iscrizione semplicemente inviando un\'email a <strong>Newsletter.edu+unsubscribe [chiocciola] inaf</strong></p>';
	$privacy = '<p>La redazione garantisce che il trattamento dei dati personali (nome, cognome ed indirizzo email) avviene nel rispetto della normativa sulla privacy (Regolamento (UE) 2016/679 e Codice privacy, di cui al Decreto legislativo n. 196/2003) e dei principi di correttezza, liceità e trasparenza e di tutela della tua riservatezza e dei tuoi diritti e potrà essere svolto in via manuale o in via elettronica, o comunque con l\'ausilio di strumenti informatizzati o automatizzati, al solo fine di fornire il servizio richiesto e, per tale ragione, saranno conservati esclusivamente per il periodo in cui lo stesso sarà attivo. Il Titolare del trattamento è l\'INAF - Istituto Nazionale di Astrofisica, con sede legale in Roma, viale del Parco Mellini, 84 – 00136. I tuoi dati sono trattati dai personale e dai collaboratori dell\'INAF autorizzati dal Titolare al trattamento, in relazione alle loro funzioni e mansioni, o dalle imprese espressamente designate quali Responsabili delle attività di trattamento ai sensi dell\'art. 28 GDPR. Gli interessati hanno il diritto di chiedere al titolare del trattamento l\'accesso ai dati personali e la rettifica o la cancellazione degli stessi o la limitazione del trattamento che li riguarda o di opporsi al trattamento (artt. 15 e ss. del Regolamento (UE) 2016/679). L’apposita istanza all\'INAF è presentata contattando il Responsabile della Protezione dei Dati presso l\'Istituto (Istituto Nazionale di Astrofisica – Responsabile della protezione dei dati personali, viale del Parco Mellini, 84, 00136 Roma; email: rpd [chiocciola] inaf.it; PEC: rpd-inaf [chiocciola] legalmail.it). Gli interessati che ritengono che il trattamento dei dati personali a loro riferiti effettuato attraverso questo servizio avvenga in violazione di quanto previsto dal Regolamento hanno il diritto di proporre reclamo al Garante, come previsto dall\'art. 77 del Regolamento stesso, o di adire le opportune sedi giudiziarie (art. 79 del Regolamento).</p>';
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

# footnote

add_shortcode( 'footnotereg', function () {

	$footnote1 = '<p>EduINAF è il magazine di didattica e divulgazione dell\'INAF, <a href="http://www.inaf.it/" target="inaf">Istituto Nazionale di Astrofisica</a>.<br/>Registrazione n. 45/2020 in data 4 giugno 2020, Tribunale di Roma<br/>Direttore responsabile: Livia Giacomini<br/><a href="https://edu.inaf.it/edu-inaf/la-redazione/">Redazione</a></p>';
	
	$out = $footnote1;

	return $out;
} );

add_shortcode( 'footnotepriv', function () {

	$footnote2 = '<p>Vuoi usare i contenuti di EduINAF? <a href="https://edu.inaf.it/edu-inaf/copyright/">Leggi i Crediti</a>.</p><p><a href="https://edu.inaf.it/privacy-info/">Informativa sulla Privacy</a><br/><a href="https://edu.inaf.it/cookies-info/">Informatva sui Cookie</a></p>';
	
	$out = $footnote2;

	return $out;
} );

add_shortcode( 'footnoteform', function () {

	$footnote3 = '<p><a href="https://edu.inaf.it/contatti/">Inviaci i tuoi contributi</a></p><p>Per la rubrica de l\'Astronomo risponde, segui le istruzioni nella <a href="https://edu.inaf.it/astronomo-risponde/">colonna a destra della pagina</a> oppure <a href="https://edu.inaf.it/contatti/">compila il form</a></p>';
	
	$out = $footnote3;

	return $out;
} );

# olimpiadi

add_shortcode( 'menuolimpiadi', function () {
	
	$olimpiadi = '<button><a href="https://edu.inaf.it/olimpiadi-di-astronomia/">Cosa sono le Olimpiadi</a></button>';
	$dispense = '<button><a href="https://edu.inaf.it/olimpiadi-di-astronomia/risorse-didattiche-olimpiadi/">Dispense</a></button>';
	$esercizi = '<button><a href="http://www.olimpiadiastronomia.it/per-prepararsi/esercizi-e-problemi-di-gara/" target="oli">Esercizi delle passate edizioni</a></button>';
	$syllabus = '<button><a href="http://www.olimpiadiastronomia.it/syllabus/" target="oli">Syllabus</a></button>';
	$notizie = '<button><a href="https://edu.inaf.it/category/news/inaf-societa/olimpiadi-di-astronomia/" target="eduinaf">Archivio notizie</a></button>';
	$moodle = '<button><a href="http://moodle.olimpiadi.inaf.it/" target="inaf">Moodle</a></button>';
	
	$menu = '<div align="center" class="btn-group">'.$olimpiadi.$dispense.$esercizi.$syllabus.$notizie.'</div>';
	
	$out = $menu;

	return $out;
} );

# concorso rodari

add_shortcode( 'menurodari', function () {
	
	$home = '<button><a href="https://edu.inaf.it/concorso-gianni-rodari/">Home page del concorso</a></button>';
	$scatole = '<button><a href="https://edu.inaf.it/concorso-gianni-rodari/scatole-colorate/">Scatole colorate</a></button>';
	$bio = '<button><a href="https://edu.inaf.it/concorso-gianni-rodari/gianni-rodari/">Chi è Gianni Rodari</a></button>';
	
	$news = '<a href="https://edu.inaf.it/news/premi-e-concorsi/fate-largo-ai-sognatori/" target="eduinaf">Fate largo ai sognatori!</a>';
	$beni = '<a href="http://www.beniculturali.inaf.it/eventi/universi-da-ascoltare/" target="inaf">Universi da ascoltare</a>';
	
	$menu = '<div align="center" class="btn-group">'.$home.$scatole.$bio.'</div>';
	
	$pagine = '<div align="center" style="padding-top:40px;"><strong>Pagine correlate</strong><br/>'.$news.'<br/>'.$beni.'</div>';
	
	$out = $menu.$pagine;

	return $out;
} );

add_shortcode( 'rodaridoc', function () {
	
	$informativa = '<a href="https://edu.inaf.it/wp-content/uploads/2020/10/Informativa_concorso_Rodari2020.pdf" target="pdf">Informativa sul trattamento dei dati personali</a>';
	$bando = '<a href="https://edu.inaf.it/wp-content/uploads/2020/10/BANDO_Concorso_GianniRodari_2020.pdf" target="pdf">Bando del concorso</a></button>';
	$scheda = '<a href="https://edu.inaf.it/wp-content/uploads/2020/10/pubblicazione_contenuti_Rodari.pdf" target="pdf">Scheda di autorizzazione</a>';
	$locandine = 'Locandine: <a href="https://edu.inaf.it/wp-content/uploads/2020/10/A-Gianni-Rodari-A4-20201019.pdf" target="pdf">in nero</a>, <a href="https://edu.inaf.it/wp-content/uploads/2020/10/A-Gianni-Rodari-A4-20201019-QR.pdf" target="pdf">in bianco</a>';
	$form = '<a href="https://forms.gle/cBNmqLyitYCGUJJ79" target="form">Modulo di iscrizione</a>';
	
	$allegati = '<div align="center"><strong>Modulo e documentazione</strong><br/>'.$form.'<br/>'.$bando.'<br/>'.$scheda.'<br/>'.$informativa.'<br/>'.$locandine.'</div>';
	
	$out = $allegati;

	return $out;
} );

# PCTO

add_shortcode( 'menupcto', function () {
	
	$home = '<li><a href="https://edu.inaf.it/pcto/">Percorsi per le competenze trasversali e per l’orientamento</a></li>';
	$archivio = '<li><a href="https://edu.inaf.it/pcto/i-progetti-alternanza-scuola-lavoro/">Archivio progetti</a></li>';
	$doc = '<li><a href="https://edu.inaf.it/pcto/documentazione-utile/">Documentazione utile</a></li>';
	$gradimento = '<li><a href="https://edu.inaf.it/pcto/questionario-di-gradimento/">Questionario di gradimento</a></li>';
	
	$iaps = '<li><a href="https://edu.inaf.it/pcto/istituto-astrofisica-planetologia-spaziali/">Istituto di Astrofisica e Planetologia Spaziali</a></li>';
	$brera = '<li><a href="https://edu.inaf.it/pcto/osservatorio-astronomico-di-brera/">Osservatorio Astronomico di Brera</a></li>';
	$capodimonte = '<li><a href="https://edu.inaf.it/pcto/osservatorio-astronomico-di-capodimonte/">Osservatorio Astronomico di Capodimonte</a></li>';
	
	$attivi = '<div id="recent-posts-2" class="widget widget_recent_entries"><h4 class="widget-title h6"><span>PCTO Attivi</span></h4><ul>'.$iaps.$brera.$capodimonte.'</ul></div>';
	
	$menu = '<div id="recent-posts-2" class="widget widget_recent_entries"><h4 class="widget-title h6"><span>PCTO</span></h4><ul>'.$home.$archivio.$doc.'</ul></div>';
	
	$out = $menu.$attivi;

	return $out;
} );

/**
 * Adds Foo_Widget widget.
 */
class Widget_PCTO extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'widget_pcto', // Base ID
            'Menu PCTO', // Name
            array( 'description' => __( 'Widget per l\'inserimento del menu delle pagine PCTO', 'text_domain' ), ) // Args
        );
    }
 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
		$menu = do_shortcode('[menupcto]');
		$news = do_shortcode('[postlooptab tag="PCTO"]');
        echo $menu;
		echo $news;
        echo $after_widget;
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'text_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>
    <?php
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
 
        return $instance;
    }
 
} // class Widget_PCTO

// Register Widget_PCTO widget
add_action( 'widgets_init', 'register_pcto' );
     
function register_pcto() { 
    register_widget( 'Widget_PCTO' ); 
}

#menu didattica
add_shortcode( 'menudidattica', function () {
	
	$astrodid = '<button><a href="https://edu.inaf.it/astrodidattica/">Risorse didattiche</a></button>';
	$corsi = '<button><a href="https://edu.inaf.it/corsi-di-formazione/">Corsi di formazione</a></button>';
	$schede = '<button><a href="https://edu.inaf.it/astroschede/">Schede astronomiche</a></button>';
	$corso = '<button><a href="https://edu.inaf.it/corso_base_brera/introduzione/">Corso base di astronomia</a></button>';
	$inclusione = '<button><a href="https://edu.inaf.it/inaf-didattica-inclusiva/">Didattica inclusiva</a></button>';
	$tink = '<button><a href="https://edu.inaf.it/didattica-innovativa/">Didattica innovativa</a></button>';
	
	$menu = '<div align="center" class="btn-group">'.$astrodid.$inclusione.$tink.$corso.$schede.$corsi.'</div>';
	
	$out = $menu;

	return $out;
} );

#ultimo aggiornamento
function wpb_last_updated_date( $content ) {
$u_time = get_the_time('U'); 
$u_modified_time = get_the_modified_time('U'); 
if ($u_modified_time >= $u_time + 86400) { 
$updated_date = get_the_modified_time('j F Y');
$updated_time = get_the_modified_time('h:i a'); 
$custom_content .= '<p class="last-updated">Ultimo aggiornamento il '. $updated_date . ' alle '. $updated_time .'</p>';  
} 
 
    $custom_content .= $content;
	
	if ( get_post_type() <> 'page' ){
		return $custom_content;
	} else {
		return $content;
	}    
}
add_filter( 'the_content', 'wpb_last_updated_date' );

#sidebar corso brera
add_shortcode( 'sbcorsobase', function () {
	
	$logo = '<p align="center"><img src="https://edu.inaf.it/wp-content/plugins/eduinaf/images/loghi/corso_base_astro.png" /></p>';
	
	$autore = do_shortcode('[blog-post-coauthors]');
	
	$intro = '<button><a href="https://edu.inaf.it/corso_base_brera/introduzione/">L\'Universo in fiore – corso base di astronomia</a></button>';
	$cap1 = '<button><a href="https://edu.inaf.it/corso_base_brera/introduzione-astronomia/">Introduzione all\'astronomia</a></button>';
	$cap2 = '<button><a href="https://edu.inaf.it/corso_base_brera/il-sistema-solare/">Il sistema solare: origini e caratteristiche</a></button>';
	$cap3 = '<button><a href="https://edu.inaf.it/corso_base_brera/i-pianeti-extrasolari/">I pianeti extrasolari</a></button>';
	$cap4 = '<button><a href="https://edu.inaf.it/corso_base_brera/evoluzione-stellare/">Evoluzione stellare</a></button>';
	$cap5 = '<button><a href="https://edu.inaf.it/corso_base_brera/le-piu-grandi-esplosioni/">Le più grandi esplosioni dell\'Universo</a></button>';
	$cap6 = '<button><a href="https://edu.inaf.it/corso_base_brera/relitti-stellari-nane-bianche-stelle-di-neutroni-buchi-neri/">Relitti stellari: nane bianche, stelle di neutroni e buchi neri</a></button>';
	$cap7 = '<button><a href="https://edu.inaf.it/corso_base_brera/nel-regno-delle-galassie/">Nel regno delle galassie</a></button>';
	$cap8 = '<button><a href="https://edu.inaf.it/corso_base_brera/i-giganti-del-cosmo-gli-ammassi-di-galassie/">I giganti del cosmo: gli ammassi di galassie</a></button>';
	$cap9 = '<button><a href="https://edu.inaf.it/corso_base_brera/il-modello-cosmologico-standard-e-lenigma-dellespansione/">Il modello cosmologico standard e l\'enigma dell\'espansione</a></button>';
	
	$menu = '<div align="center" class="btn-group">'.$intro.$cap1.$cap2.$cap3.$cap4.$cap5.$cap6.$cap7.$cap8.$cap9.'</div>';
	
	$custom = get_post_custom();
	foreach( $custom as $key => $value ) {
		$key_name = get_post_custom_values( $key = 'pdfcap' );
		if ( $key_name[0] <> null ) {
			$capitolo = '<p><a href="'.$key_name[0].'" target="pdf">Scarica la lezione in pdf</a></p>';
		} else {
			$capitolo = null;
		}
	}
	
	$cap = '<p><strong>Lezione a cura di</strong>: '.$autore.'</p>';
	
	$sidebar = $logo.$cap.$capitolo.$menu;
	
	$out = $sidebar;

	return $out;
} );
