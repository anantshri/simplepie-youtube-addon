<?php
include_once('simplepie.inc');
include_once('simplepie_youtube.inc');

$feed = new SimplePie(); // Create a new instance of SimplePie
$feed->set_feed_url(array(
	'http://gdata.youtube.com/feeds/api/playlists/957F7A8A7B24D497'
));
$feed->set_cache_duration (600); //The cache duration
$feed->set_item_class('SimplePie_Item_YouTube');
$feed->enable_xml_dump(isset($_GET['xmldump']) ? true : false);

$success = $feed->init(); // Initialize SimplePie

$feed->handle_content_type(); // Take care of the character encoding
?>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>YouTube + Simple Pie</title>
</head>
<body>
<h1><a href="<?php $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
<?php foreach($feed->get_items() as $item): ?>
<?php

    if ($item->get_link()=="")
    {
        echo "<br />";
    }
    else
    {
?>
<h3><?php echo $item->get_title(); ?></h3>

<?php
    echo "<pre>";
//        echo print_r($item->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE_MEDIA, 'group'));
    echo "</pre>";

    echo "<br />You Tube Title : " .  $item->get_youtube_title();
    echo "<br />Video By : " . $item->get_youtube_author() . "<br />";
    echo "<br />Video URL By : " . $item->get_youtube_player_url() . "<br />";
    
?>
<img src="<?php
echo $item->get_youtube_thumbnail_url(3);
?>">
<?php

//    echo $item->get_youtube_player();

?>
<?php echo $item->get_description(); ?>
<br />
<?php

    echo $item->get_categories();

?>
<?php //echo urldecode($item->get_link(0)); ?></br>
<?php
//    $video_id = substr(urldecode($item->get_link(0)),strpos(urldecode($item->get_link(0)),"=")+1,strpos(urldecode($item->get_link(0)),"&")-strpos(urldecode($item->get_link(0)),"=")-1);
?>
<!--
<br />
<img src="http://img.youtube.com/vi/<?php echo $video_id; ?>/1.jpg" width='130' height='97' border='0'>
<img src="http://img.youtube.com/vi/<?php echo $video_id; ?>/2.jpg" width='130' height='97' border='0'>
<img src="http://img.youtube.com/vi/<?php echo $video_id; ?>/3.jpg" width='130' height='97' border='0'>
<br />
<object width="480" height="385">
    <param name="movie" value="http://www.youtube.com/v/<?php echo $video_id; ?>&hl=en_US&fs=1&rel=0"></param>
    <param name="allowFullScreen" value="true"></param>
    <param name="allowscriptaccess" value="always"></param>
    <embed src="http://www.youtube.com/v/<?php echo $video_id; ?>&hl=en_US&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed>
</object><br />

<br />
http://gdata.youtube.com/feeds/api/videos/<?php echo $video_id; ?>
-->
<?php
    echo "<hr />";

    }

?>
<?php endforeach; ?>
</body>
</html>
