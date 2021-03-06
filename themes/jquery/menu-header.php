<?php
/*
 * The main header navigation menu for each project site.
 *
 * If a function exists for a subdomain (such as projects_jquery_com) it will
 * be used instead of the jquery_com function.
 */

function menu_header_jquery_com() {
	return array(
		'http://jquery.com/download/' => 'Download',
		'http://api.jquery.com/' => 'API Documentation',
		'http://blog.jquery.com/' => 'Blog',
		'http://plugins.jquery.com/' => 'Plugins',
		'http://jquery.com/browser-support/' => 'Browser Support',
	);
}

function menu_header_plugins_jquery_com() {
	return array(
		'http://plugins.jquery.com/docs/names/' => 'Naming Your Plugin',
		'http://plugins.jquery.com/docs/publish/' => 'Publishing Your Plugin',
		'http://plugins.jquery.com/docs/package-manifest/' => 'Package Manifest',
	);
}

function menu_header_learn_jquery_com() {
	return array(
		'http://learn.jquery.com' => 'Home',
		'http://learn.jquery.com/about' => 'About',
		'http://learn.jquery.com/contributing' => 'Contributing',
		'http://learn.jquery.com/style-guide' => 'Style Guide',
	);
}
function menu_header_qunitjs_com() {
	return array(
		'http://qunitjs.com/' => 'Home',
		'http://qunitjs.com/intro/' => 'Intro to Unit Testing',
		'http://api.qunitjs.com/' => 'API Documentation',
		'http://qunitjs.com/cookbook/' => 'Cookbook',
		'http://qunitjs.com/addons/' => 'Add-ons',
	);
}

function menu_header_jquerymobile_com() {
	return array(
		'http://api.jquerymobile.com/' => 'API Documentation',
		'http://jquerymobile.com/download/' => 'Download',
		'http://jquerymobile.com/gbs/' => 'Platforms',
		'http://jquerymobile.com/themeroller/' => 'Themes',
		'http://jquerymobile.com/resources/' => 'Resources',
		'http://forum.jquery.com/jquery-mobile' => 'Forum',
		'http://blog.jquerymobile.com/' => 'Blog',
	);
}

function menu_header_jqueryui_com() {
	return array(
		'http://jqueryui.com/demos/' => 'Demos',
		'http://jqueryui.com/download' => 'Download',
		'http://api.jqueryui.com/' => 'API Documentation',
		'http://jqueryui.com/themeroller' => 'Themes',
		'http://jqueryui.com/development' => 'Development',
		'http://jqueryui.com/support' => 'Support',
		'http://blog.jqueryui.com/' => 'Blog',
		'http://jqueryui.com/about' => 'About',
	);
}

function menu_header_sizzlejs_com() {
	return array(
		'http://sizzlejs.com/' => 'Home',
		'http://github.com/jquery/sizzle' => 'Source Code',
	);
}

function menu_header_jquery_org() {
	return array(
		'http://jquery.org/' => 'Home',
		'http://jquery.org/credit-card/' => 'Credit Card',
		'http://jquery.org/donate/' => 'Donate',
		'http://jquery.org/history/' => 'History',
		'http://jquery.org/join/' => 'Join',
		'http://jquery.org/members/' => 'Members',
		'http://jquery.org/meeting/' => 'Meetings',
		'http://jquery.org/team/' => 'Team',
	);
}

function menu_header_brand_jquery_org() {
	return array(
		'http://brand.jquery.org/logos' => 'Logos',
		'http://brand.jquery.org/colors/' => 'Colors',
		'http://brand.jquery.org/typography/' => 'Typography',
		'http://brand.jquery.org/naming-conventions/' => 'Naming Conventions',
		'http://brand.jquery.org/events-conferences/' => 'Events &amp; Conferences',
		'http://brand.jquery.org/press-contact/' => 'Press &amp; Contact'
	);
}

function menu_header_contribute_jquery_org() {
	return array(
		'http://contribute.jquery.org/CLA/' => 'CLA',
		'http://contribute.jquery.org/style-guide/js/' => 'JS Style Guide',
		'http://contribute.jquery.org/style-guide/html/' => 'HTML Style Guide',
		'http://contribute.jquery.org/markup-conventions/' => 'Markup Conventions',
		'http://contribute.jquery.org/commits-and-pull-requests/' => 'Commits &amp; Pull Requests'
	);
}

function menu_header_irc_jquery_org() {
	return array(
		'http://irc.jquery.org/irc-help' => 'IRC Help',
		'http://jquery.org/meeting/' => 'Meetings',
	);
}

/*
 * Avert your eyes.
 */

$site = explode( '/', JQUERY_LIVE_SITE, 2 );
$domain = explode( '.', $site[0] );
$path = count( $site ) === 2 ? explode( '/', str_replace( '.', '_', $site[1] ) ) : array();
$func = 'menu_header_' . implode( '_', $domain ) .
	(count( $path ) ? '_' . implode ( '_', $path ) : '');
while ( !function_exists( $func ) && count( $path ) > 1 ) {
	array_pop( $path );
	$func = 'menu_header_' . implode( '_', $domain ) . '_' . implode( '_', $path );
}

while ( !function_exists( $func ) && count( $domain ) > 1 ) {
	array_shift( $domain );
	$func = 'menu_header_' . implode( '_', $domain );
}
if ( function_exists( $func ) )
	jquery_render_menu( call_user_func( $func ) );
unset( $site, $domain, $path, $func );

function jquery_render_menu( $items ) {
	$current = trailingslashit( set_url_scheme( 'http://' . JQUERY_LIVE_SITE . $_SERVER['REQUEST_URI'] ) );
	?>
<div class="menu-top-container">
	<ul id="menu-top" class="menu">
<?php
	foreach ( $items as $url => $anchor ) {
		$class = 'menu-item';
		$url = set_url_scheme( $url );
		if ( $anchor === 'Home' ) {
			if ( $current === $url ) {
				$class .= ' current';
			}
		} else {
			if ( 0 === strpos( $current, $url ) ) {
				$class .= ' current';
			}
		}
		echo '<li class="' . $class . '"><a href="' . $url . '">' . $anchor . "</a></li>\n";
	}
?>
	</ul>
</div>
<?php
}
