<?php
/**
 * Appcasting component class
 */
class AppcastComponent extends Object {
	var $nodes;
	var $feed = 'http://feeds.feedburner.com/pandionupdates';
	var $appName = 'Pandion';
	var $appTrack = 'stable';
	
	function get_appcast_feed() {
	  $dom = new DOMDocument();
	  $result = $dom->load('http://feeds.feedburner.com/pandionupdates');
		 
	  if ($result) {
		  $xpath = new DOMXPath($dom);
	    $ns = array(
	      'appcast' => 'http://pandion.im/protocol/appcast/1.0',
	      'atom' => 'http://www.w3.org/2005/Atom'
	    );
	
	    $xpath->registerNamespace('appcast', $ns['appcast']);
	    $xpath->registerNamespace('atom', $ns['atom']);

	    $nodes = $xpath->query(
	      '/atom:feed' .
	      '/atom:entry' .
	      '[atom:updated]' .
	      '[@appcast:name="' . $this->appName . '"]' . // TODO escape chars
	      '[@appcast:track="' . $this->appTrack . '"]' . // TODO escape chars
	      '[@appcast:version]' .
	      '[atom:link[@href and @length and @rel="enclosure"]]'
	    );
	
	    $items = array();
	    foreach ($nodes as $key => $node) {
		    $items[$key]['title'] = $xpath->query('atom:link[@href and @rel="enclosure"]/@title', $node)->item(0)->value;
     	}

      return $items;
	  }
	
	  return FALSE;
	}
}