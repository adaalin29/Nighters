<?php
if (!function_exists('thumb')) {
    function thumb($query, $file)
    {
        if ($query == 'thumb') {
            $query = $file[0];
            $file = $file[1];
        }
        if (request()->accepts('image/webp')) $file .= '.webp';
		return route('thumb', [$query, $file]);
      
      
        
		$queryArray = [];
		foreach (explode(';', $query) as $item) {
			if (strpos($item, ':') === false) continue;
			$item = explode(':', $item);
			$queryArray[$item[0]] = $item[1];
		}
		$imageWidth = null;
		if (isset($queryArray['width']) && $queryArray['width'] !== 'auto') {
			$imageWidth = intval($queryArray['width'], 10);
		}
		$imageHeight = null;
		if (isset($queryArray['height']) && $queryArray['height'] !== 'auto') {
			$imageHeight = intval($queryArray['height'], 10);
		}
		$image = '/storage/'.$file;
		
		//  CDN method - statically.io
		$staticallyUrl = 'https://cdn.statically.io/img/'.str_replace(array('http://', 'https://'), '', env('APP_URL').$image).'?k';
		if ($imageWidth && $imageHeight) {
			$staticallyUrl .= "&resize=$imageWidth,$imageHeight";
		} else {
			if ($imageWidth) $staticallyUrl .= "&w=$imageWidth";
			if ($imageHeight) $staticallyUrl .= "&w=$imageHeight";
		}
		return $staticallyUrl;
		
		// CDN method - images.weserv.nl
// 		$cdnurl = 'https://images.weserv.nl/?';
// 		if ($imageWidth) $cdnurl .= "w=$imageWidth&";
// 		if ($imageHeight) $cdnurl .= "h=$imageHeight&";
// 		$cdnurl .= 'url='.urlencode(env('APP_URL') . $image);
// 		$cdnurl .= '&errorredirect='.urlencode(env('APP_URL') . $image);
// 		return $cdnurl;
		
		// CDN method - local thumb script
      
      
      
    }
}