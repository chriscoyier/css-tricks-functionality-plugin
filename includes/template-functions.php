<?php
// Add CodePen to oEmbed Provider Whitelist
wp_oembed_add_provider( 'http://codepen.io/*/pen/*', 'http://codepen.io/api/oembed' );

/**
 * This returns given text with transformations of quotes to 
 * smart quotes, apostrophes, dashes, ellipses, the trademark 
 * symbol, and the multiplication symbol.
 * 
 * Text enclosed in the tags <pre>, <code>, <kbd>, <style>, <script>, and <tt> will be skipped.
 */
remove_filter( 'the_content', 'wptexturize' );

// Tumbler Post Titles
function tumblrPostTitles() {
	global $post;
	$permalink = get_permalink( get_post( $post->ID ) );
	$tumblr_keys = get_post_custom_keys( $post->ID );
	if( $tumblr_keys ) {
		foreach( $tumblr_keys as $tumblr_key ) {
			if( $tumblr_key == 'TumblrURL' ) {
				$tumblr_vals = get_post_custom_values( $tumblr_key) ;
			}
		}
		if( $tumblr_vals ) {
			echo $tumblr_vals[0];
		} else {
			echo $permalink;
		}
	} else {
		echo $permalink;
	}
}

add_filter('the_permalink_rss', 'tumblrFeedTitles');
function tumblrFeedTitles($permalink) {
	global $wp_query;
	if ($url = get_post_meta($wp_query->post->ID, 'TumblrURL', true)) {
		return $url;
	}
	return $permalink;
}

// link-back for Tumblr-like posts
function tumblrLinkBacks( $content ) {
	global $wp_query, $post;
	$post_id = get_post( $post->ID );
	$posttitle = $post_id->post_title;
	$permalink = get_permalink( get_post( $post->ID ) );
	$tumblr_keys = get_post_custom_keys( $post->ID );
	if( get_post_meta( $wp_query->post->ID, 'TumblrURL', true ) ) {
		if( $tumblr_keys ) {
			foreach( $tumblr_keys as $tumblr_key ) {
				if( $tumblr_key == 'TumblrURL' ) {
					$tumblr_vals = get_post_custom_values( $tumblr_key );
				}
			}
			if( $tumblr_vals ) {
				if( is_feed() ) {
					$content .= '<p><a href="'.$tumblr_vals[0].'" title="Direct link to featured article">Direct Link to Article</a> &#8212; ';
					$content .= '<a href="'.$permalink.'">Permalink</a></p>';
					return $content;
				} else {
					return $content;
				}
			}
		}
	} else {
		$content = $content;
		return $content;
	}
}
add_filter( 'the_content', 'tumblrLinkBacks' );

function put_my_url() {
	return ('/');
}
add_filter('login_headerurl', 'put_my_url');

function put_my_title() {
	return ('CSS-Tricks Lodge');
}
add_filter('login_headertitle', 'put_my_title');

// Tree function
function is_tree( $pid ) {
	global $post;

	if ( is_page( $pid ) )
		return true;
		$anc = get_post_ancestors( $post->ID );
		foreach ( $anc as $ancestor ) {
		if ( is_page() && $ancestor == $pid ) {
			return true;
		}
	}
	return false;
}

// Respect <!-- more --> better (being fixed?)
function always_the_excerpt() {
	global $more;
	$old_more = isset($more) ? $more : null;
	$more = 0;
	the_excerpt();
	$more = $old_more;
}