<?php



function main_func() {
	global $post;
	global $meta_options;
	global $options;




	$Title = get_post_meta( $post->ID, 'Title', true );
	$Desc = get_post_meta( $post->ID, 'Desc', true );
	$tags = get_post_meta( $post->ID, 'tags', true );





	 ?>
<style type="text/css">
.textareaxxx {
   font-size: 12pt;
   font-family: Arial;
}
</style>




<script>

function maxLength (e) {
    if (!document.createElement('textarea').maxLength) {
        var max = e.attributes.maxLength.value;
        e.onkeypress = function () {
            if(this.value.length >= max) return false;
        };
    }
}

maxLength(
    document.getElementById("text")
);

var maxAmount = 156;
function textCounter(textField, showCountField) {
    if (textField.value.length > maxAmount) {
        textField.value = textField.value.substring(0, maxAmount);
} else {
        showCountField.value = maxAmount - textField.value.length;
}
}
var maxTitle = 70;
function textCounter2(textField2, showCountField2) {
    if (textField2.value.length > maxTitle) {
        textField2.value = textField2.value.substring(0, maxAmount);
} else {
        showCountField2.value = maxTitle - textField2.value.length;
}
}


</script>



<p><label for="Title"><b>Page Title    </b>:
		<input id="Title" name="Title" size="70" maxlength="70" value="<?php if ($Title) {echo $Title;} else {echo get_the_title();}?>" onKeyDown="textCounter2(this.form.Title,this.form.countDisplay2);" onKeyUp="textCounter2(this.form.Title,this.form.countDisplay2);" ></input></label></p><input readonly type="text" name="countDisplay2" size="3" maxlength="3" value="70"> Characters Remaining

	<p><label for="Desc"><b>Page Description</b>:(text limit=156)<br />
	<textarea class="textareaxxx" id="Desc" name="Desc"  font size="2" maxlength="156" rows="02" cols="75" value="Desc" onKeyDown="textCounter(this.form.Desc,this.form.countDisplay);" onKeyUp="textCounter(this.form.Desc,this.form.countDisplay);" ><?php if ($Desc) { echo $Desc;} elseif (!isset($options['auto'])) {
	$description = $post->post_content;
	$string = trim(strip_tags($description));
$newString = substr($string, 0, 156);
echo $newString;
	} ?></textarea></label><b></b></p><br />

	<input readonly type="text" name="countDisplay" size="3" maxlength="3" value="156"> Characters Remaining





	<?php
	global $post; if ($tags) {
    $metatags=get_post_meta( $post->ID, 'tags', true ); } else {$metatags=strip_tags(get_the_tag_list('',', ',''));}
	if($options['seo'] == "yes") { echo '<p><label for="tags"><b>Meta tags</b>:(separated by coma)
		<input id="tags" name="tags" size="100" value="' . $metatags . '" /></label></p>'; } ?>







<?php
}

function custom_url10( $post_id ) {
	global $post;
global $meta_options;

	if( $_POST ) {


		update_post_meta( $post->ID, 'Title', $_POST['Title'] );
		update_post_meta( $post->ID, 'Desc', $_POST['Desc'] );
		update_post_meta( $post->ID, 'tags', $_POST['tags'] );

	}
}
global $post;
$currentposttype=get_post_type( $post->ID );


function meta_title() {
	global $post;
  if ('page' == $post->post_type || 'post' == $post->post_type || $currentposttype = $post->post_type)
  {
	  $Title = get_post_meta($post->ID, 'Title', true);
      $home_title = get_option('home_title');
      if($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' || is_front_page() || is_home()  ){
    // echo only if not empty
    if(!empty($home_title)){
      return  $home_title;
      }  }
    elseif(!empty($Title)){

      return $Title;
    }

  }

}
add_filter( 'wp_title', 'meta_title' );

function meta_description() {
	global $post;
  if ('page' == $post->post_type || 'post' == $post->post_type || $currentposttype = $post->post_type)
  {   	$description2 = $post->post_content;
	$string2 = trim(strip_tags($description2));
$newString2 = substr($string2, 0, 156);


	  $seodescription = get_post_meta($post->ID, 'Desc', true);
    // echo only if not empty
    if(!empty($seodescription)){
      echo '<meta name="description" content="' . $seodescription . '" />';
    } else {echo ''; }
  }
}




add_action( 'admin_init', 'add_custom_metabox10' );
add_action( 'save_post', 'custom_url10' );
add_action( 'wp_head' ,  'meta_title');
add_action( 'wp_head' ,  'meta_description');

/**
 * Add meta box
 */

function add_custom_metabox10() {

foreach ( get_post_types( array( 'public' => true ) ) as $posttype ) {

			add_meta_box( 'custom-metabox10', __( 'Quick SEO ' ), 'main_func', $posttype, 'normal', 'high' );
		}







}

function register_meta_settings() {
	   register_setting('meta_settings_group','meta_settings');
	 }

	 add_action ('admin_init','register_meta_settings');

?>