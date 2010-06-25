<?php
	
	include("xmlfunctions.php");

	getXML('flickr.xml', 'http://api.flickr.com/services/feeds/photos_public.gne?id=7373328@N05&lang=en-us&format=rss_200');
	getXML('googlereader', 'http://www.google.com/reader/shared/04765555122545352199');
	getXML('lastfm.xml', 'http://ws.audioscrobbler.com/1.0/user/mustardhamsters/recenttracks.rss');
	getXML('tweets.xml', 'http://search.twitter.com/search.atom?q=from%3Amustardhamsters');
	getXML('delicious.xml', 'http://feeds.delicious.com/v2/rss/mustardhamsters?count=15');
	getXML('mustardhamsters.xml', 'http://mustardhamsters.com/?feed=rss2');
	getXML('cultofmac.xml', 'http://cultofmac.com/author/mustardhamsters/feed');
	getXML('projects.xml', 'http://mustardhamsters.com/?feed=rss2&cat=4');
	
	
?>