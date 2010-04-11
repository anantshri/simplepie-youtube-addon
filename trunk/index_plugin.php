<?php
include_once('simplepie.inc');
include_once('simplepie_youtube.inc');
$feed = new SimplePie(); // Create a new instance of SimplePie
$feed->set_feed_url('http://gdata.youtube.com/feeds/base/videos/-/ubuntu?client=ytapi-youtube-browse&v=2');
$feed->set_cache_duration (600); //The cache duration
$feed->set_item_class('SimplePie_Item_YouTube');
$feed->enable_xml_dump(isset($_GET['xmldump']) ? true : false);
$success = $feed->init(); // Initialize SimplePie
$feed->handle_content_type(); // Take care of the character encoding
?>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>YouTube + Simple Pie Sample</title>
</head>
<body>
<h1><a href="<?php echo $feed->get_permalink(); ?>"><?php echo $feed->get_title(); ?></a></h1>
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
          $ar = $item->get_item_tags(SIMPLEPIE_NAMESPACE_YOUTUBE, 'feed');
//        $ar = $ar[0]['child'][SIMPLEPIE_NAMESPACE_YOUTUBE_MEDIA]['category'];
      echo print_r($ar);
        print_r($item->get_categories());
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


?>
<?php
    echo "<hr />";

    }

?>
<?php endforeach; ?>
</body>
</html>
