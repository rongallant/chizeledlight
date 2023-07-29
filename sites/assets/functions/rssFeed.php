<?php
// rssFeed("XML URL", "Number of entries to show", "Optional title")
function rssFeed($url,$count,$blocktitle='') {
	require_once ( dirname(__FILE__) . "/magpierss/rss_fetch.inc" );
	error_reporting(E_ERROR);
	$rss = fetch_rss($url);
	print '<div class="newsfeed">';
	if ( $rss ) {
		$i=1;
		print '<h1>';
		if( $blocktitle != '' ) print $blocktitle;
		else print $rss->channel['title'];
		print '</h1><ul>';
		foreach ($rss->items as $item ) {
			if ( $i <= $count ) {
				$title = $item[title];
				$url   = $item[link];
				$content = $item[description];
				print ('<li><a href="' . $url .'">' . $title . '</a></li>');
				$i++;
			}
		}
		print '</ul>';
	} else {
    	print "<p>News Unavailable</p>";
	}
	print '</div>';
}
// rssArticles("XML URL", "Number of entries to show", "Optional title")
function rssArticles($url,$count,$blocktitle='') {
	require_once ( dirname(__FILE__) . "/magpierss/rss_fetch.inc" );
	error_reporting(E_ERROR);
	$rss = fetch_rss($url);
	print '<div class="newsarticles">';
	if ( $rss ) {
		$i=1;
		print '<h1>';
		if( $blocktitle != '' ) print $blocktitle;
		else print $rss->channel['title'];
		print '</h1><ul>';
		foreach ($rss->items as $item ) {
			if ( $i <= $count ) {
				$title = $item[title];
				$url   = $item[link];
				$image   = $item[image];
				$content = $item[description];
				print ('<li><h2><a href="' . $url .'">' . $title . '</a></h2><div class="newsContent"><img src="'.$image.'" />'.$content.'</div></li>');
				$i++;
			}
		}
		print '</ul>';
	} else {
    	print "<p>News Unavailable</p>";
	}
	print '</div>';
}
?>