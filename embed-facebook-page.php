<?php 
/*
Plugin Name:SM Facebook Page Plugin
Plugin URI: https://wordpress.org/plugins/embed-facebook-page/
Author: Mahabubur Rahman
Author URI: http://mahabub.me/
Text Domain: embed_facebook_page
Description: The Facebook Page Plugin is a wordpress widget plugin. It lets you easily embed and promote any Facebook Page on your website. Just like on Facebook, your visitors can like and share the Page without leaving your site.
Version: 1.1.0
*/
class embed_facebook_page extends WP_Widget{

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'embed_facebook_page', 

		// Widget name will appear in UI
		__('SM Facebook Page Plugin', 'embed_facebook_page'), 

		// Widget description
		array( 'description' => __( 'SM Facebook Page Plugin is a wordpress widget Plugin to embed your facebook page into your wordpress site.', 'embed_facebook_page' ), ) 
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes

		$facebook_app_id				=	($instance['facebook_app_id'])? $instance['facebook_app_id']:'396134523823142';
		$facebook_url 					=	$instance['facebook_url'];
		$friend_faces 					=	$instance['friend_faces'];
		$show_page_posts 				=	$instance['show_page_posts'];
		$hide_cover_photo 				=	$instance['hide_cover_photo'];
		$use_small_header 				=	$instance['use_small_header'];
		$adapt_to_plugin_container_width=	$instance['adapt_to_plugin_container_width'];
		$hide_call_to_action 			=	$instance['hide_call_to_action'];
		$tabs 							=	$instance['tabs'];
		$width 							=	$instance['width'];
		$height 						=	$instance['height'];


		$the_query = new WP_Query( 'orderby=comment_count&cat='.$category.'&posts_per_page='.$par_page );

		echo $args['before_widget'];

		 if ( ! empty( $title ) )
		 	echo $args['before_title'] . $title . $args['after_title'];
		?>

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=<?php echo $facebook_app_id; ?>";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

			<div 
				class="fb-page" 
			  	data-href="<?php echo $facebook_url; ?>"
			  	data-height="<?php echo $height; ?>" 
			  	data-width="<?php echo $width; ?>" 
			  	data-tabs="<?php echo $tabs; ?>"
			  	data-small-header="<?php echo $use_small_header; ?>" 
			  	data-hide-cover="<?php echo $hide_cover_photo ?>"
			  	data-adapt-container-width="<?php echo $adapt_to_plugin_container_width; ?>" 
			  	data-show-facepile="<?php echo $friend_faces; ?>" 
			  	data-hide-cta="<?php echo $hide_call_to_action; ?>"
			  	data-show-posts="<?php echo $show_page_posts ?>">
  			</div>
		<?php

		/*$args = array(
			'orderby' => 'comment_count',
			'cat'=>'0',
			'posts_per_page'=>'5',
		);
		$the_query = new WP_Query( $args );*/

		

		echo $args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Facebook Page', 'embed_facebook_page' );
		}

		if(isset($instance['facebook_app_id'])){
				$facebook_app_id=$instance['facebook_app_id'];
		}else{
			$facebook_app_id='';
		}
		if(isset($instance['facebook_url'])){
			$facebook_url=$instance['facebook_url'];
		}else{
			$facebook_url='';
		}

		if(isset($instance['friend_faces'])){
			$friend_faces=$instance['friend_faces'];
		}else{
			$friend_faces='true';
		}

		if(isset($instance['show_page_posts'])){
			$show_page_posts=$instance['show_page_posts'];
		}else{
			$show_page_posts='true';
		}

		if(isset($instance['hide_cover_photo'])){
			$hide_cover_photo=$instance['hide_cover_photo'];
		}else{
			$hide_cover_photo='false';
		}

		if(isset($instance['use_small_header'])){
			$use_small_header=$instance['use_small_header'];
		}else{
			$use_small_header='false';
		}

		if(isset($instance['adapt_to_plugin_container_width'])){
			$adapt_to_plugin_container_width=$instance['adapt_to_plugin_container_width'];
		}else{
			$adapt_to_plugin_container_width='true';
		}

		if(isset($instance['hide_call_to_action'])){
			$hide_call_to_action=$instance['hide_call_to_action'];
		}else{
			$hide_call_to_action='false';
		}

		if(isset($instance['timeline'])){
			$timeline=$instance['timeline'];
		}else{
			$timeline='false';
		}

		if(isset($instance['tabs'])){
			$tabs=$instance['tabs'];
		}else{
			$tabs='false';
		}

		if(isset($instance['messages'])){
			$messages=$instance['messages'];
		}else{
			$messages='false';
		}

		if(isset($instance['events'])){
			$events=$instance['events'];
		}else{
			$events='false';
		}



		if(isset($instance['width'])){
			$width=$instance['width'];
		}else{
			$width='';
		}

		if(isset($instance['height'])){
			$height=$instance['height'];
		}else{
			$height='';
		}
		

		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','embed_facebook_page' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'facebook_app_id' ); ?>"><?php _e( 'Facebook App ID:','embed_facebook_page' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebook_app_id' ); ?>" name="<?php echo $this->get_field_name( 'facebook_app_id' ); ?>" type="text" value="<?php echo esc_attr( $facebook_app_id ); ?>" >
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php _e( 'Facebook URL:','embed_facebook_page' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo esc_attr( $facebook_url ); ?>" >
		</p>
		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'friend_faces' ); ?>" 
				name="<?php echo $this->get_field_name( 'friend_faces' ); ?>" 
				type="checkbox" 
				value="true" 
				 <?php if ( isset( $friend_faces ) && $friend_faces=='true' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'friend_faces' ); ?>"><?php _e( 'Show Friend\'s Faces','embed_facebook_page' ); ?></label> 		
		</p>
		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'show_page_posts' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_page_posts' ); ?>" 
				type="checkbox" 
				value="true" 
				 <?php if ( isset( $show_page_posts ) && $show_page_posts=='true' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'show_page_posts' ); ?>"><?php _e( 'Show Page Posts','embed_facebook_page' ); ?></label> 		
		</p>
		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'hide_cover_photo' ); ?>" 
				name="<?php echo $this->get_field_name( 'hide_cover_photo' ); ?>" 
				type="checkbox" 
				value="true" 
				 <?php if ( isset( $hide_cover_photo ) && $hide_cover_photo=='true' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_cover_photo' ); ?>"><?php _e( 'Hide Cover Photo','embed_facebook_page' ); ?></label> 		
		</p>

		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'use_small_header' ); ?>" 
				name="<?php echo $this->get_field_name( 'use_small_header' ); ?>" 
				type="checkbox" 
				value="true" 
				 <?php if ( isset( $use_small_header ) && $use_small_header=='true' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'use_small_header' ); ?>"><?php _e( 'Use Small Header','embed_facebook_page' ); ?></label> 		
		</p>



		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'adapt_to_plugin_container_width' ); ?>" 
				name="<?php echo $this->get_field_name( 'adapt_to_plugin_container_width' ); ?>" 
				type="checkbox" 
				value="true" 
				 <?php if ( isset( $adapt_to_plugin_container_width ) && $adapt_to_plugin_container_width=='true' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'adapt_to_plugin_container_width' ); ?>"><?php _e( 'Adapt to plugin container width','embed_facebook_page' ); ?></label> 		
		</p>

		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'hide_call_to_action' ); ?>" 
				name="<?php echo $this->get_field_name( 'hide_call_to_action' ); ?>" 
				type="checkbox" 
				value="true" 
				 <?php if ( isset( $hide_call_to_action ) && $hide_call_to_action=='true' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'hide_call_to_action' ); ?>"><?php _e( 'Hide the custom call to action button','embed_facebook_page' ); ?></label> 		
		</p>
		<hr/>
			<strong>Tabs</strong>	
		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'timeline' ); ?>" 
				name="<?php echo $this->get_field_name( 'timeline' ); ?>" 
				type="checkbox" 
				value="timeline" 
				 <?php if ( isset( $timeline ) && $timeline=='timeline' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'timeline' ); ?>"><?php _e( 'Show Timeline Tab','embed_facebook_page' ); ?></label>
		</p>
		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'messages' ); ?>" 
				name="<?php echo $this->get_field_name( 'messages' ); ?>" 
				type="checkbox" 
				value="messages" 
				 <?php if ( isset( $messages ) && $messages=='messages' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'messages' ); ?>"><?php _e( 'Show Messages Tab','embed_facebook_page' ); ?></label>
		</p>
		<p>
			<input 
				class="checkbox"
				id="<?php echo $this->get_field_id( 'events' ); ?>" 
				name="<?php echo $this->get_field_name( 'events' ); ?>" 
				type="checkbox" 
				value="events" 
				 <?php if ( isset( $events ) && $events=='events' ) { echo 'checked="checked"'; } ?>/>
			<label for="<?php echo $this->get_field_id( 'events' ); ?>"><?php _e( 'Show Events Tab','embed_facebook_page' ); ?></label>
		</p>

		<hr/>
		<p>
			<label for="<?php echo $this->get_field_id('width') ?>"><?php _e('Width: ','embed_facebook_page'); ?></label>
			<input id="<?php echo $this->get_field_id('width') ?>" name="<?php echo $this->get_field_name('width') ?>" size="6" value="<?php echo $width; ?>">
			<br/>
			<span style="font-size: 80%;">The pixel width of the embed (Min. 180 to Max. 500)</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('height') ?>"><?php _e('Height: ','embed_facebook_page'); ?></label>
			<input id="<?php echo $this->get_field_id('height') ?>" name="<?php echo $this->get_field_name('height') ?>" size="6" value="<?php echo $height; ?>">
			<br/>
			<span style="font-size: 80%;">The pixel height of the embed (Min. 70)</span>
		</p>

		
		<?php 
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook_app_id'] = ( ! empty( $new_instance['facebook_app_id'] ) ) ? strip_tags( $new_instance['facebook_app_id'] ) : '';
		$instance['facebook_url'] = ( ! empty( $new_instance['facebook_url'] ) ) ? strip_tags( $new_instance['facebook_url'] ) : '';
		$instance['friend_faces'] = ( ! empty( $new_instance['friend_faces'] ) ) ? strip_tags( $new_instance['friend_faces'] ) : 'false';
		$instance['show_page_posts'] = ( ! empty( $new_instance['show_page_posts'] ) ) ? strip_tags( $new_instance['show_page_posts'] ) : 'false';
		$instance['hide_cover_photo'] = ( ! empty( $new_instance['hide_cover_photo'] ) ) ? strip_tags( $new_instance['hide_cover_photo'] ) : 'false';
		$instance['use_small_header'] = ( ! empty( $new_instance['use_small_header'] ) ) ? strip_tags( $new_instance['use_small_header'] ) : 'false';
		$instance['adapt_to_plugin_container_width'] = ( ! empty( $new_instance['adapt_to_plugin_container_width'] ) ) ? strip_tags( $new_instance['adapt_to_plugin_container_width'] ) : 'false';
		$instance['hide_call_to_action'] = ( ! empty( $new_instance['hide_call_to_action'] ) ) ? strip_tags( $new_instance['hide_call_to_action'] ) : 'false';
		$instance['timeline'] = ( ! empty( $new_instance['timeline'] ) ) ? strip_tags( $new_instance['timeline'] ) : 'false';
		$instance['messages'] = ( ! empty( $new_instance['messages'] ) ) ? strip_tags( $new_instance['messages'] ) : 'false';		
		$instance['events'] = ( ! empty( $new_instance['events'] ) ) ? strip_tags( $new_instance['events'] ) : 'false';		
		$instance['tabs'] = '';
		if($instance['timeline']=='timeline'){
			if($instance['tabs']){
				$instance['tabs'].=','.$instance['timeline'];
			}else{
				$instance['tabs'].=$instance['timeline'];
			}
		}

		if($instance['messages']=='messages'){
			if($instance['tabs']){
				$instance['tabs'].=','.$instance['messages'];
			}else{
				$instance['tabs'].=$instance['messages'];
			}
		}
		
		if($instance['events']=='events'){
			if($instance['tabs']){
				$instance['tabs'].=','.$instance['events'];
			}else{
				$instance['tabs'].=$instance['events'];
			}
		}


		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
		return $instance;
	}
	

}

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'embed_facebook_page');
}
add_action( 'widgets_init', 'wpb_load_widget' );