<?php

function icon($attr){

ob_start ();
 $fb = get_option('f-social');
  if(!empty($fb)){
    echo '<a href="'.$fb.'"><img src="' . plugins_url('quick-seo/images/facebook.png' ,  dirname(__FILE__) ) .'"></a>&nbsp;';
  }
   $twitter = get_option('t-social');
     if(!empty($twitter)){
    echo '<a href="'.$twitter.'"><img src="'.plugins_url('quick-seo/images/twitter.png' , dirname(__FILE__) ) .'"></a>&nbsp;';

  }
   $google = get_option('g-social');
  if(!empty($google)){
    echo '<a href="'.$google.'"><img src="'.plugins_url('quick-seo/images/google.png' ,dirname(__FILE__) ).'"></a>&nbsp;';

  }
   $youtube = get_option('y-social');
  if(!empty($youtube)){
    echo '<a href="'.$youtube.'"><img src="'.plugins_url('quick-seo/images/youtube.png' , dirname(__FILE__) ) .'"></a>&nbsp;';
  }
   $plus_button = get_option('googleplus-button');
     if($plus_button == 1)  {
    echo '<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script><div style="display:inline;position:relative;"><div class="g-plusone" data-size="medium"></div></div>';
}
 return ob_get_clean();

  }
add_shortcode('social' , 'icon');

ob_end_clean();

?>