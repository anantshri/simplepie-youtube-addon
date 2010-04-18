<?php
include_once('simplepie.inc');
include_once('simplepie_youtube.inc');

$feed = new SimplePie(); // Create a new instance of SimplePie
$feed->set_feed_url('http://gdata.youtube.com/feeds/api/playlists/957F7A8A7B24D497');
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
<!--
<?php
//    $item->set_youtube_type();
?>
-->
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
    echo "<br />You Tube Title : " .  $item->get_youtube_title();
    echo "<br />Video By : " . $item->get_youtube_author() . "<br />";
    echo "<br />Video URL By : " . $item->get_youtube_player_url() . "<br />";
    
?>
Image Preview and embedded Player here<br />
<img src="<?php
echo $item->get_youtube_thumbnail_url(3);
?>">
<?php
//    echo $item->get_youtube_player();
?>
<br /> Description : <br />
<?php echo $item->get_description(); 
echo $item->get_content();
?>
<br />
Category : <?php
$cat_list = "";
foreach ($item->get_categories() as $cat)
{
    if ($cat_list != "")
    {
        $cat_list .= ",";        
    }
    $cat_list .= $cat->get_label();
}
echo $cat_list;
?>
<?php
    echo "<hr />";

    }

?>
<?php endforeach; ?>
</body>
</html>
