<?PHP
function RemoveArgFromURL($URL,$Arg) {
   $Pos = strpos($URL,"$Arg=");
   if ($Pos) {
     if ($URL[$Pos-1] == "&") {
       // If Pos-1 is pointing to a '&' knock Pos back 1 so its removed.
       $Pos--;
     }
     $nMax = strlen($URL);
     $nEndPos = strpos($URL,"&",$Pos+1);
     if ($nEndPos === false) {
       // $Arg is on the end of the URL
       $URL = substr($URL,0,$Pos);
     } else {
       // $Arg is in the URL
       $URL = str_replace(substr($URL,$Pos,$nEndPos-$Pos),'',$URL);
     }
   }
   return $URL;
  }
function pagination($url, $total_items, $per_page, $start, $range = 5, $pages = 'total', $prevnext = TRUE, $prevnext_always = FALSE, $firstlast = TRUE, $firstlast_always = FALSE) {
    // Here you can edit the looks of the pagination, make sure you keep all instances
    // of %s intact, they will be replaced by text by the script. Read
    // http://www.php.net/sprintf for more information on how to change the order of
    // these format 'tags'.
	
	/*
	- url : The links will refer to this url, don't include arguments
	- total_items : The total of items for the list
	- per_page : Number of items to show per page
	- start : Item to start at (start counting at 0, not 1!)
	- range : The range of pages to show, can be 1 to infinite
	- pages : The type for the page text to the left of the pagination:
		- total : Only shows total pages
		- page : Only shows current page
		- pageoftotal : Shows current page and total
		- FALSE (bool) : Shows nothing
	- prevnext_links : The type for the previous and next links:
		- num : Shows number for previous and next page
		- nump : Only shows number for previous page
		- numn : Only shows number for next page
		- TRUE (bool) : Show, but no numbers
		- FALSE (bool) : Shows nothing
		- prevnext_always : Always show previous and next links, depending on prevnext_links
	- firstlast_links : The type for the first and last links:
		- num : Shows number for first and last page
		- numf : Only shows number for first page
		- numl : Only shows number for last page
		- TRUE (bool) : Show, but no numbers
		- FALSE (bool) : Show nothing
		- firstlast_always : Always show first and last links, depending on firstlast_links
	*/

    // The links themselves, for these goes: first %s is the url, the second the text for the link
    $str_links = " <a href='%s'>%s</a> ";
    $str_selected = " <a href='%s'>[%s]</a> ";
    $str_prevnext = " <a href='%s'>%s</a> ";
    $str_firstlast = " <a href='%s'>%s</a> ";

    // The pages text, has only one %s: the text
    $str_pages = "%s ";

    // The text on previous, next, first, and last links. One %s: a (optional) number
    $prev_txt = '&lt;%s';
    $next_txt = '%s&gt;';
    $first_txt = '&laquo;%s';
    $last_txt = '%s&raquo;';

    // Pretty self explanatory now..
    $pages_txt_total = '%s Pages';
    $pages_txt_page = 'Page %s';
    $pages_txt_pageoftotal = 'Page %s of %s';

	/*******************************Start of the code**************************/
    $str = '';

	// First, check on a few parameters to see if they're ok, we don't want negatives
    $total_items = ($total_items < 0) ? 0 : $total_items;
    $per_page = ($per_page < 1) ? 1 : $per_page;
    $range = ($range < 1) ? 1 : $range;
    $sel_page = 1;

    // Remove the start argument from the url, if it's there, then add the arguments to the url
    //$args = (isset($_SERVER['argv'][0])) ? preg_replace('/(start=)(d+)(&|)/i', '', $_SERVER['argv'][0]) : '';
	if (isset($_SERVER['argv'][0])) $args = $_SERVER['argv'][0]; else $args = '';
	$args = RemoveArgFromURL($args,'start');
    $url .= '?' . $args . ((substr($args, -1) == '&') ? '' : '&') . 'start=';

    $total_pages = ceil($total_items / $per_page);

	// Are there more than one pages to show? If not, this section will be skipped,
    // and only the pages_text will be shown
	if ($total_pages > 1) {
	    // The page we are on
	    $sel_page = floor($start / $per_page) + 1;

		// The ranges indicate how many pages should be displayed before and after
        // the selected one. Here, it will check if the range is an even number,
        // and adjust the ranges appropriately. It will behave best on non-even numbers
	    $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
	    $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
	    $page_min = $sel_page - $range_min;
	    $page_max = $sel_page + $range_max;

		// This parts checks whether the ranges are 'out of bounds'. If we're at or near
        // the 'edge' of the pagination, we will start or end there, not at the range
        $page_min = ($page_min < 1) ? 1 : $page_min;
        $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
        if ($page_max > $total_pages) {
            	$page_min = ($page_min > 1) ? $total_pages - $range + 1 : 1;
            $page_max = $total_pages;
        }

        // Build the links
	    for ($i = $page_min;$i <= $page_max;$i++) {
            $str .= sprintf((($i == $sel_page) ? $str_selected : $str_links), $url . (($i - 1) * $per_page), $i);
	    }

		// Do we got previous and next links to display?
	    if (($prevnext) || (($prevnext) && ($prevnext_always))) {
			// Aye we do, set what they will look like
            $prev_num = (($prevnext === 'num') || ($prevnext === 'nump')) ? $sel_page - 1 : '';
            $next_num = (($prevnext === 'num') || ($prevnext === 'numn')) ? $sel_page + 1 : '';

            $prev_txt = sprintf($prev_txt, $prev_num);
            $next_txt = sprintf($next_txt, $next_num);

            // Display previous link?
	        if (($sel_page > 1) || ($prevnext_always)) {
	            $start_at = ($sel_page - 2) * $per_page;
	            $start_at = ($start_at < 0) ? 0 : $start_at;
	            $str = sprintf($str_prevnext, $url . $start_at, $prev_txt).$str;
	        }
			// Next link?
	        if (($sel_page < $total_pages) || ($prevnext_always)) {
	            $start_at = $sel_page * $per_page;
	            $start_at = ($start_at >= $total_items) ? $total_items - $per_page : $start_at;
	            $str .= sprintf($str_prevnext, $url . $start_at, $next_txt);
	        }
	    }

        // This part is just about identical to the prevnext links, just a few minor
        // value differences
	    if (($firstlast) || (($firstlast) && ($firstlast_always))) {
            $first_num = (($firstlast === 'num') || ($firstlast === 'numf')) ? 1 : '';
            $last_num = (($firstlast === 'num') || ($firstlast === 'numl')) ? $total_pages : '';

            $first_txt = sprintf($first_txt, $first_num);
            $last_txt = sprintf($last_txt, $last_num);

	        if ((($sel_page > ($range - $range_min)) && ($total_pages > $range)) || ($firstlast_always)) {
	            $str = sprintf($str_firstlast, $url . '0', $first_txt).$str;
	        }
	        if ((($sel_page < ($total_pages - $range_max)) && ($total_pages > $range)) || ($firstlast_always)) {
	            $str .= sprintf($str_firstlast, $url . ($total_items - $per_page), $last_txt);
	        }

	    }
    }

	// Display pages text?
	if ($pages) {
    	// Decide what to show
		switch ($pages) {
			case 'total':
	    	    $pages_txt = sprintf($pages_txt_total, $total_pages);
				break;
			case 'page':
				$pages_txt = sprintf($pages_txt_page, $sel_page);
        		break;
        	case 'pageoftotal':
        		$pages_txt = sprintf($pages_txt_pageoftotal, $sel_page, $total_pages);
           		break;
		}
		// Replace it
        $str = sprintf($str_pages, $pages_txt) . $str;
    }

	// Done, return the pagination
    return $str;
}
?>