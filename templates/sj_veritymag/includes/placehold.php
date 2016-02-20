<?php
/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/
// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
global $is_placehold;
global $placehold_size;

// Array param for cookie
$placehold_size = array (
	'listing' => '370x260',
	'article' => '870x610',
    'leading' => '870x610',
	'related_items'=>'70x70',
	'slideshow' => '1150x450',
	'latest_news' => '270x270',
	'popular' => '70x70',
	'featured_posts' => '230x180',
	'hot_stories' => '270x250',
	'video_box' => '270x190',
                         'k2_content' => '170x120',
                         'k2_content_featured' => '100x70',
                         'k2_content_top_news4' => '270x190',
                         'k2_content_avatar' => '30x30',

);

$is_placehold = 1;

if (!function_exists ('yt_placehold') ) {
	function yt_placehold ($size = '100x100',$icon='0xe942', $alt = '', $title = '' ) {
		return '<img src="http://placehold.it/'.$size.'" alt = "'. $alt .'" title = "'. $title .'"/>';
	}
}
?>