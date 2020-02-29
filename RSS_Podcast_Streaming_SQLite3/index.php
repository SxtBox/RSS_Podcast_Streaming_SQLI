<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$root_url = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";
//echo $root_url;

//define('root_url', $root_url);

/*
// settings.json file

// START HERE
{
    "database_file_name": "podcast.db",
    "table_name": "rss_streaming",
    "root_url": "http://localhost",
    "page_title": "Podcast RSS Streaming"
}
// END HERE

*/
/*
// GET FRON JSON FILE
$json_data  = json_decode(file_get_contents("settings.json"), true);
$database_file_name = $json_data['database_file_name'];
$table_name  = $json_data['table_name'];
$root_url    = $json_data['root_url'];
$page_title  = $json_data['page_title'];
$db = new SQLite3($database_file_name);
*/

// LOCAL SETTINGS NON JSON

// DB SETTINGS
$database_file_name = "podcast.db"; // DB NAME
$table_name = "rss_streaming"; // DB TABLE
$db = new SQLite3($database_file_name); // CONNECTION
// END DB SETTINGS

    $page_title = "Podcast RSS Streaming";
    $feed_description = "Podcast RSS Streaming";
    $feed_copyright = "Your Copyright Name";
    $feed_ttl = 60 * 60 * 24;
    $feed_language = "en-us";
    $today = date("Y-m-d");
    $TimeZone = new DateTimeZone('Europe/Tirane');
    $feed_pub_date = new DateTime($today, $TimeZone);
    $feed_pub_date->modify('+8 hours');
    $feed_pub_date_formatted = $feed_pub_date->format("r");
    $feed_author = "TRC4";
    $feed_email = "trc4@usa.com";
    $feed_image = "https://png.kodi.al/tv/albdroid/black.png";
    $feed_explicit = "yes";
    $feed_category = "RSS Streaming";    
    $feed_subcategory = "Streams";
    $xml_encoding  = '<?xml version="1.0" encoding="utf-8"?>'."\n";
    //echo $xml_encoding;
	
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title>$page_title</title>
<link>$root_url</link>
<description>$feed_description</description>
<copyright>$feed_copyright</copyright>
<language>$feed_language</language>
<author>$feed_author</author>
<email>$feed_email</email>
<image>$feed_image</image>
<explicit>$feed_explicit</explicit>
<category>$feed_category</category>
\n";

$items_array = [];

$res = $db->query("SELECT * FROM $table_name");
while ($row = $res->fetchArray()) {
    $title       = htmlspecialchars($row["title"]);
    $link        = htmlspecialchars($row["stream_url"]);
    $thumbnail   = htmlspecialchars($row["thumbnail"]);
    $fanart      = htmlspecialchars($row["fanart"]);
    $category    = htmlspecialchars($row["category"]);
    $description = htmlspecialchars($row["description"]);
    $author      = htmlspecialchars($row["author"]);
    $pubDate     = htmlspecialchars($row["created_date"]);

$item_structure = "<item>
    <title>$title</title>
    <link>$link</link>
    <thumbnail>$thumbnail</thumbnail>
    <fanart>$fanart</fanart>
    <category>$category</category>
    <description>$description</description>
    <author>$author</author>
    <pubDate>$pubDate</pubDate>
</item>\n";
    array_unshift($items_array, $item_structure);
}
echo implode(" ",$items_array);
echo "</channel>\n</rss>";
