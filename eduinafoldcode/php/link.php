<?php

# creazione link esterni con shortcode
# astroEdu
add_shortcode('astroedu', 'astroedu');

 function astroedu ($atts, $content = null) {

   extract(
      shortcode_atts(
         array( 
		'lang' => null,
		'code' => null,
	 ),
         $atts
      )
   );

   if ( $lang <> null ) {
      $link = '<a href="http://astroedu.iau.org/'.$lang.'/activities/'.$code.'/" target="astroedu" style="color: #faaf3f;">'.$content.'</a>';
   } else {
      $link = '<a href="http://astroedu.iau.org/it/activities/'.$code.'/" target="astroedu" style="color: #faaf3f;">'.$content.'</a>';
   }   

   return $link;
}

# Spacescoop
add_shortcode('spacescoop', 'spacescoop');

 function spacescoop ($atts, $content = null) {

   extract(
      shortcode_atts(
         array( 
		'lang' => null,
		'code' => null,
	 ),
         $atts
      )
   );

   if ( $lang <> null ) {
      $link = '<a href="http://www.spacescoop.org/'.$lang.'/scoops/'.$code.'/" target="spacescoop" style="color: #03709c">'.$content.'</a>';
   } else {
      $link = '<a href="http://www.spacescoop.org/it/scoops/'.$code.'/" target="spacescoop" style="color: #03709c">'.$content.'</a>';
   }

   return $link;
}

# Sapere
add_shortcode('sapere', 'sapere');

 function sapere ($atts, $content = null) {

   extract(
      shortcode_atts(
         array( 
		'url' => null,
                'num' => null,
                'data' => null,
		'doi' => null,
	 ),
         $atts
      )
   );

   if ( $doi <> null )
     {$link = '<p><em>Estratto dall\'articolo "<a href="'.$url.' target="sapere">'.$content.'</a>" uscito su Sapere n.'.$num.' di '.$data.'. doi:<a href="https://dx.doi.org/'.$doi.'" target="doi">'.$doi.'</a></em></p>';}
   else
     {$link = '<p><em>Estratto dall\'articolo "<a href="'.$url.' target="sapere">'.$content.'</a>" uscito su Sapere n.'.$num.' di '.$data.'</em></p>';}

   return $link;
}
