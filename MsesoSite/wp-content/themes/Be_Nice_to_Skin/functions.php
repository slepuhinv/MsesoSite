<?php

//regster multiple sidebar
if (function_exists('register_sidebar'))
{
	register_sidebar(
		array(
			'name'          => 'Sidebar',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
}

//remove html tag when saving comments
function preprocess_comment_striptags($commentdata) {
    $commentdata['comment_content'] = strip_tags($commentdata['comment_content']);
    return $commentdata;
}
add_filter('preprocess_comment', 'preprocess_comment_striptags');

// remove html tag when showing comments
function comment_text_striptags($string) {
    return strip_tags($string);
}
add_filter('comment_text', 'comment_text_striptags');

// recent comments
function get_recent_comments($args) {
	global $wpdb, $comments, $comment;
	extract($args, EXTR_SKIP);

	$themePath = get_bloginfo('template_url');
	$imageLink = '<h2>Недавние комментарии</h2>';

	$options = get_option('widget_recent_comments');
	$title = empty($options['title']) ? __($imageLink) : apply_filters('widget_title', $options['title']);
	if ( !$number = (int) $options['number'] )
		$number = 5;
	else if ( $number < 1 )
		$number = 1;
	else if ( $number > 15 )
		$number = 15;

	if ( !$comments = wp_cache_get( 'recent_comments', 'widget' ) ) {
		$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT $number");
		wp_cache_add( 'recent_comments', $comments, 'widget' );
	}

		 echo $before_widget;
			echo $before_title . $title . $after_title;
			echo '<ul id="recentcomments">';
			if ( $comments ) : foreach ( (array) $comments as $comment) :
			echo  '<li class="recentcomments">' . sprintf(__('%2$s'), get_comment_author_link(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
			endforeach; endif;
		echo '</ul>';
		echo $after_widget; 

}

// links list
function get_friend_links($args) {
	extract($args, EXTR_SKIP);

	$themePath = get_bloginfo('template_url');
	$imageLink = '<h2>Links<span style="display:none">';

	$before_widget = preg_replace('/id="[^"]*"/','id="%id"', $before_widget);
	wp_list_bookmarks(apply_filters('widget_links_args', array(
		'title_before' => $imageLink, 'title_after' => '</span></h2>',
		'category_before' => $before_widget, 'category_after' => $after_widget,
		'show_images' => true, 'class' => 'linkcat widget'
	)));
}

### Function: Page Navigation Options
function wpthemes_post_class( $class = '', $post_id = null ) {
	$post = get_post($post_id);
	$classes = array();
	$classes[] = $post->post_type;
	if ( is_sticky($post->ID) && is_home())
		$classes[] = 'sticky';
	$classes[] = 'hentry';
	foreach ( (array) get_the_category($post->ID) as $cat ) {
		if ( empty($cat->slug ) )
			continue;
		$classes[] = 'category-' . $cat->slug;
	}
	foreach ( (array) get_the_tags($post->ID) as $tag ) {
		if ( empty($tag->slug ) )
			continue;
		$classes[] = 'tag-' . $tag->slug;
	}
	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}
	return apply_filters('post_class', $classes, $class, $post_id);
}

if(!function_exists('get_sidebars')) {function get_sidebars(){get_sidebar();}}
### Function: Page Navigation: Boxed Style Paging
function wpthemes_page_menu( $args = array() ) {
	$defaults = array('sort_column' => 'post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );
	$menu = '';
	$list_args = $args;
	if ( isset($args['show_home']) && ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' . get_option('home') . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
	if ( $menu )
		$menu = '<ul>' . $menu . '</ul>';
	$menu = '<div class="' . $args['menu_class'] . '">' . $menu . "</div>\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
} ?>