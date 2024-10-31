<?php

/*
Plugin Name: Quick SEO
Plugin URI: http://wordpress.org/plugins/quick-seo/
Description: This plugin allow you to upload search engine optimization activity which helps you to gain ranking
Author: Rupesh Dinkar Gharat
Version: 1.3
Author URI: https://plus.google.com/104308382382479297040
*/
include ('meta.php');
include ('button.php');
function jollyc() {
     $canonical = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
     $val = get_option( 'canonical' );
      echo "<!--<Quick seo by Rupesh Gharat>-->";
     if($val == 1)  {
       echo "<link rel='canonical' href='http://".$canonical."'>";
     } else
     {}


}
add_action( 'wp_head', 'jollyc' );
 function jollyw() {

 $author =  get_option('author');
  $publisher =  get_option('publisher');
  $canonical = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  $ga = get_option('ga');

$ga = esc_textarea ( $ga );

   $google_verification =  get_option('google-verification');
   $bing_verification =  get_option('bing-verification');
      $home_desc = get_option('home_desc');
   // global $wpdb;
   // $wpdb->insert( wp_seo , array( 'author' => $author, 'publisher' => $publisher )) ;


if(!empty($author)){
echo "<link rel='author' href='".$author."'>";
}
if(!empty($publisher)){

echo "<link rel='publisher' href='".$publisher."'>";
}
$options = get_option('ga');
// $options = esc_html( $options );
echo stripslashes ( "{$options}" );
if($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' || is_front_page() || is_home()  ){
if(!empty($google_verification)){

echo '<meta name="google-site-verification" content="'.$google_verification.'" />';
}if(!empty($bing_verification)){
echo '<meta name="msvalidate.01" content="'.$bing_verification.'" />';
}
if(!empty($home_desc)){

      echo '<meta name="description" content="' . $home_desc . '" />';
      }
}

}
add_action( 'wp_head', 'jollyw' );

$robots = get_option('robots');
$robo = fopen(ABSPATH . "robots.txt", 'w' );
fwrite($robo, $robots);
fclose($robo);

$xmlsitemap = get_option('xmlsitemap');
$xml = fopen(ABSPATH . "sitemap.xml", 'w' );
fwrite($xml, $xmlsitemap);
fclose($xml);


/** Step 2 (from text above).
add_action( 'admin_menu', 'my_plugin_menu' );

 Step 1.
function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

 Step 3.
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
?>
<?php   */
// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

	//create new top-level menu
	add_menu_page('Quick Seo Settings', 'Quick Seo', 'administrator', __FILE__, 'baw_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
     register_setting( 'baw-settings-group', 'home_title' );
    register_setting( 'baw-settings-group', 'home_desc' );
register_setting( 'baw-settings-group', 'xmlsitemap' );
register_setting( 'baw-settings-group', 'robots' );
	register_setting( 'baw-settings-group', 'canonical' );
	register_setting( 'baw-settings-group', 'publisher' );
	register_setting( 'baw-settings-group', 'author' );
    register_setting( 'baw-settings-group', 'ga' );
    register_setting( 'baw-settings-group', 'google-verification' );
    register_setting( 'baw-settings-group', 'bing-verification' );
register_setting( 'baw-settings-group', 'f-social' );
register_setting( 'baw-settings-group', 't-social' );
register_setting( 'baw-settings-group', 'y-social' );
register_setting( 'baw-settings-group', 'g-social' );
register_setting( 'baw-settings-group', 'googleplus-button' );

}

function baw_settings_page() {
?>
<div class="wrap">
<h2>Quick SEO</h2>
<style>
.wide{ width:350px;}
</style>

<form method="post" action="options.php">
    <?php settings_fields( 'baw-settings-group' ); ?>
    <?php do_settings_sections( 'baw-settings-group' ); ?>
    <table class="form-table">
     <tr valign="top">
        <th scope="row">Homepage Title</th>
  <td><input class="wide" type="text" name="home_title" value="<?php echo get_option('home_title'); ?>" placeholder="Homepage Title" /></td>

        </tr>
        <tr valign="top">
        <th scope="row">Home Description</th>
  <td><input class="wide" type="text" name="home_desc" value="<?php echo get_option('home_desc'); ?>" placeholder="Homepage Desc" /></td>

        </tr>
  <tr valign="top">
        <th scope="row">Canonical</th>
        <!--<td><input id="remember" type="checkbox" name="b" checked onClick="validate(this);" ><br></td> -->
    <td><input name="canonical" type="checkbox" value="1" <?php checked( '1', get_option( 'canonical' ) ); ?> /></td>

        </tr>

        <tr valign="top">
        <th scope="row">PUBLISHER URL</th>
        <td><input class="wide" type="text" name="publisher" value="<?php echo get_option('publisher'); ?>" placeholder="https://plus.google.com/NNNNNNNNNNNNNNNNNNNNN" /></td>

        </tr>

        <tr valign="top">
        <th scope="row">Author URL</th>
        <td><input class="wide" type="text" name="author" value="<?php echo get_option('author'); ?>" placeholder="https://plus.google.com/NNNNNNNNNNNNNNNNNNNNN"/></td>
        </tr>

        <tr valign="top">
        <th scope="row">Google Analytic Code/Additional Header Code</th>
        <!--<td><input type="text" name="ga" value="<?php echo get_option('ga'); ?>" /></td>-->
        <td><textarea class="wide" name="ga" value="<?php // echo get_option('ga'); ?>" placeholder="you can put your google analytic script as well as additional header code,script,style" /><?php
$options = get_option('ga');
echo stripslashes ( "{$options}" );
?></textarea>    </td>
        </tr>

        <tr valign="top">
        <th scope="row">Google Verification Code</th>
        <td><input class="wide" type="text" name="google-verification" value="<?php echo get_option('google-verification');  ?>" placeholder="ex:- WcxUcjunkG6ZiTcKSYQEuc8MaWSCvmRSWfbIxfB0"/>  </td>
        </tr>

        <tr valign="top">
        <th scope="row">Bing Verification</th>
        <td><input class="wide" type="text" name="bing-verification" value="<?php echo get_option('bing-verification'); ?>" placeholder="ex:- WcxUcjunkG6ZiTcKSYQEuc8MaWSCvmRSWfbIxfB0"/><td>
        </tr>

<tr valign="top">
        <th scope="row">robots.txt</th>
               <td><textarea class="wide" name="robots" value="<?php // echo get_option('ga'); ?>" placeholder="robots.txt" /><?php
$robots = get_option('robots');
echo stripslashes ( "{$robots}" );
?></textarea>    </td>
        </tr>
<tr valign="top">
        <th scope="row">xml sitemap</th>
              <td><textarea class="wide" name="xmlsitemap" value="<?php // echo get_option('ga'); ?>" placeholder="xml sitemap code" /><?php
$xmlsitemap = get_option('xmlsitemap');
echo stripslashes ( "{$xmlsitemap}" );
?></textarea>    </td>
        </tr>

  <tr valign="top">
        <th scope="row"><h2>Social Icons</h2></th>
        <td></td>
        </tr>

        <tr valign="top">
        <th scope="row" style="width:400px ">put shortcode <span style="font-size:20px">[social]</span> to have social icons on webpage</th>
        <td></td>
        </tr>

        <tr valign="top">
        <th scope="row">facebook fan-page url</th>
        <td><input class="wide" type="text" name="f-social" value="<?php echo get_option('f-social'); ?>" placeholder="https://www.facebook.com/NNNNNNNNNNNNNNNNNNNNN"/></td>
        </tr>

        <tr valign="top">
        <th scope="row">twitter url</th>
        <td><input class="wide" type="text" name="t-social" value="<?php echo get_option('t-social'); ?>" placeholder="https://www.twitter.com/NNNNNNNNNNNNNNNNNNNNN"/></td>
        </tr>

        <tr valign="top">
        <th scope="row">google profile URL</th>
        <td><input class="wide" type="text" name="g-social" value="<?php echo get_option('g-social'); ?>" placeholder="https://plus.google.com/NNNNNNNNNNNNNNNNNNNNN"/></td>
        </tr>

        <tr valign="top">
        <th scope="row">youtube URL</th>
        <td><input class="wide" type="text" name="y-social" value="<?php echo get_option('y-social'); ?>" placeholder="https://www.youtube.com/NNNNNNNNNNNNNNNNNNNNN"/></td>
        </tr>

        <tr valign="top">
        <th scope="row">google plus button</th>
        <td><input class="wide" type="checkbox" name="googleplus-button" value="1" <?php checked( '1', get_option( 'googleplus-button' ) ); ?>/></td>
        </tr>


    </table>

    <?php submit_button(); ?>


</form>


</div>



<?php } ?>