<?php

# menu plugin

/** Creazione del menu come sottovoce della dashboard */
function eduinaf_menu() {
	add_dashboard_page( 'Edu INAF Tools: pagina di documentazione', 'Edu INAF', 'manage_options', 'eduinaf-top-level-handle', 'eduinaf_toplevel_page' );
}

/** Creazione della pagina di documentazione */
function eduinaf_toplevel_page() {
        echo '<h2>Edu INAF Tools</h2>';
	echo '<div class="wrap">';
        echo '<p>Il plugin aggiunge vari <em>shortcode</em> e codici.</p>';
        echo '<h3><em>Shortcode</em> editoriali</h3>';
	echo '<p>[astroedu code="..." lang="..."]</p>';
        echo '<p>[spacescoop code="..." lang="..."]</p>';
        echo '<p>Nel parametro <em>code</em> va inserito il codice numerico relativo all\'attività. Nel parametro <em>lang</em> il codice di localizzazione (it, en, ecc.). Nel caso di assenza di quest\'ultimo parametro, it è inserito di <em>default</em>. Il parametro <em>code</em> è invece necessario per il corretto funzionamento dello <em>shortcode</em>.</p>';
        echo '<h3><em>Loop</em> come elenco</h3>';
        echo '<p>[postlooptab intro="testo di introduzione al <em>loop</em>" categoria="categoria" tag="tag" pag="numero post"]</p>';
        echo '<p>Lo <em>shortcode</em> funziona anche senza specificare alcuno dei parametri richiesti.</p>';
        echo '<h3><em>Shortcode</em> delle <em>sidebar</em></h3>';
        echo '<ul><li><strong>Didattica</strong>: [sbdidattica]</li>';
        echo '<li><strong>Astrofoto</strong>: [sbastrofoto]</li>';
        echo '<li><strong>Costellazioni</strong>: [sbcostellazioni]</li>';
        echo '<li><strong>Menu costellazioni</strong>: [menucostellazioni]</li>';
        echo '<li><strong>Corso base di astronomia</strong>: [sbcorsobase]</li>';
        echo '</ul>';
	echo '<h3>Griglia di libri</h3>';
        echo '<p>Il <em>plugin</em> aggiunge anche uno <em>shortcode</em> che genera una griglia. Esistono due distinte versioni: lo <em>shortcode</em> generico:</p>';
        echo '<p>[grigliaeduinaf categoria="..." etichetta="..."]</p>';
        echo '<p>in cui almeno uno dei due parametri deve essere specificato.</p>';
        echo '<p>Il secondo <em>shortcode</em>, invece, genera una griglia appositamente per i libri:</p>';
        echo '<p>[griglialibri etichetta="..."]</p>';
        echo '<p>dove il parametro etichetta è, al momento, settato di <em>default</em> sul valore "libri-per-bambini-e-ragazzi" e va utilizzato per distinguere tra le tre differenti sottosezioni delle recensioni</p>';
        echo '<h3><em>Loop</em> personalizzati</h3>';
        echo '<p>Per realizzare dei <em>loop</em> personalizzati si può utilizzare lo <em>shortcode</em></p>';
        echo '<p>[postlooptab intro="Ultimi articoli" pag="5" categoria="..." tag="..." stile="1"]</p>';
        echo '<p>Nell\'esempio sono inseriti, laddove presenti, i valori di <em>default</em>.<br/>Per gli stili, è possibile indicare 1 per un elenco in linea con quello del tema, 2 per un elenco con nome dell\'autore e data di pubblicazione, 3 per una griglia di quadrati.</p>';
	echo '<h3><em>Shortcode</em> per gli speciali</h3>';
	echo '<p>Per la creazione del <em>loop</em> nella pagina di uno speciale:</p>';
	echo '<p>[grigliaspeciali speciale="slug speciale" tipologia post"]</p>';
	echo '</div>';
}

/** Aggiunta del menu */
add_action( 'admin_menu', 'eduinaf_menu' );
