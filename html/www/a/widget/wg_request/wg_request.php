<?php
header ('Content-type: text/xml; charset=iso-8859-1');
require_once("../../php/class.ezSQL.php");
$lastBuildDate = date("Y-m-d H:i:s");
?>
<?php echo '<?xml version="1.0" encoding="iso-8859-1"?>'; ?>

<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/"	xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/"	xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" >

<channel>
	<title>AlSuave Links Share</title>
	<atom:link href="http://www.alsuave.info/xml/sharelinks/" rel="self" type="application/rss+xml" />
	<link>http://www.alsuave.info/</link>
	<description>Enlaces de nuestras web amigas</description>
	<lastBuildDate><?php echo date("D, d M Y H:i:s O",strtotime($lastBuildDate)); ?></lastBuildDate>

	<generator>http://alsuave.info</generator>
	<language>es</language>
	<sy:updatePeriod>hourly</sy:updatePeriod>
	<sy:updateFrequency>1</sy:updateFrequency>
    <?php $items = $db->get_results("SELECT W.webTitle as title,W.webUrl as link,W.webDateTime as pubDate, U.userName as creator FROM web W, user U WHERE W.webStatus = 1 AND W.userId = U.userId ORDER BY RAND() LIMIT 5"); ?>
    <?php if($db->num_rows > 0) { ?>
    <?php foreach($items as $item) { ?>
    <item>
		<title><?php echo @html_entity_decode(utf8_decode($item->title)); ?></title>
		<link><?php echo $item->link; ?></link>
		<pubDate><?php echo date("D, d M Y H:i:s O",strtotime($item->pubDate)); ?></pubDate>
		<dc:creator><?php echo $item->creator; ?></dc:creator>
		<category><![CDATA[alsuave]]></category>
		<guid isPermaLink="false"><?php echo $item->link; ?></guid>
		<description><![CDATA[Visita: <?php echo $item->link; ?>]]></description>
		<content:encoded><![CDATA[Visita: <?php echo $item->link; ?>]]></content:encoded>
		<slash:comments>1</slash:comments>
	</item>
	<?php 		} ?>
    <?php 	} ?>
	</channel>
</rss>