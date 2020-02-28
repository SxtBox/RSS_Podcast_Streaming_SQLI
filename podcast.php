<?php
// RSS STREAMING COMBINED FOR KODI PLAYER
    header('Content-Type: application/xml; charset=utf-8');
    $site_url = "https://kodi.al";
    $feed_title = "Podcast";
    $feed_link = "https://kodi.al/podcast/";
    $feed_description = "RSS Streaming";
    $feed_copyright = "Your Copyright Name";
    $feed_keywords = "RSS, Streams";
    $feed_subtitle = "RSS Streaming";
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
	echo $xml_encoding;
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        <title><?php echo $feed_title; ?></title>
        <link><?php echo $site_url; ?></link>
        <image>
            <url><?php echo $feed_image; ?></url>
            <title><?php echo $feed_title; ?></title>
            <link><?php echo $site_url; ?></link>
        </image>
        <description><?php echo $feed_description; ?></description>
        <language><?php echo $feed_language; ?></language>
        <copyright><?php echo $feed_copyright; ?></copyright>
        <atom:link href="<?php echo $feed_link; ?>" rel="self" type="application/rss+xml"/>
        <lastBuildDate><?php echo $feed_pub_date_formatted; ?></lastBuildDate>
        <itunes:author><?php echo $feed_author; ?></itunes:author>
        <itunes:summary><?php echo $feed_description; ?></itunes:summary>
        <itunes:subtitle><?php echo $feed_subtitle; ?></itunes:subtitle>
        <itunes:owner>
        <itunes:name><?php echo $feed_author; ?></itunes:name>
        <itunes:email><?php echo $feed_email; ?></itunes:email>
        </itunes:owner>
        <itunes:explicit><?php echo $feed_explicit; ?></itunes:explicit>
        <itunes:keywords><?php echo $feed_keywords; ?></itunes:keywords>
        <itunes:image href="<?php echo $feed_image; ?>" />                
        <itunes:category text="<?php echo $feed_category; ?>"/>
        <pubDate><?php echo "Fri, 28 Apr 2017 12:34:00 GMT+1"; ?></pubDate>               
        <category><?php echo $feed_category; ?></category>
        <ttl><?php echo $feed_ttl; ?></ttl>
<?php
        date_default_timezone_set('Europe/Tirane');
        include("db_connection.php");
        $sql = "SELECT title, stream_url, thumbnail, fanart, description, category, author, created_date
                FROM rss_streaming
                WHERE created_date < Now()
                ORDER BY created_date DESC";

        $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {                    
                    $stream_title = htmlentities($row["title"]);
                    $stream_url = $row["stream_url"];
                    // ITUNES DOES NOT SUPPORT ALL HTTPS CERTIFICATES
                    $stream_url = str_replace('https','http',$stream_url);
                    // $stream_author = $feed_author; // AUTHOR FROM MAIN
					$stream_author = $row["author"]; // AUTHOR FROM SQL
					$stream_thumbnail = $row["thumbnail"];
					$stream_fanart = $row["fanart"]; 
                    $stream_description = htmlentities($row["description"]);  
                    $stream_category = $row["category"]; 					
                    $pub_date = date("r", strtotime($row["created_date"]));
?>
    <!-- COMBINED FOR KODI PLAYER -->
        <item>
        <title><![CDATA[<?php echo $stream_title; ?>]]></title>
        <link><?php echo $stream_url; ?></link>
        <thumbnail><?php echo $stream_thumbnail; ?></thumbnail>
        <fanart><?php echo $stream_fanart; ?></fanart>
        <description><![CDATA[<?php echo $stream_description; ?>]]></description>
        <category><?php echo $stream_category; ?></category>
        <pubDate><?php echo $pub_date; ?></pubDate>
        <enclosure url="<?php echo $stream_url; ?>" type="audio/mpeg"/>
        <guid><?php echo $stream_url; ?></guid>
        <itunes:author><?php echo $stream_author; ?></itunes:author>
        <itunes:summary><![CDATA[<?php echo $stream_description; ?>]]></itunes:summary>
        <itunes:image href="<?php echo $feed_image; ?>"/>
        <itunes:keywords><?php echo $feed_keywords; ?> </itunes:keywords>
        <itunes:explicit><?php echo $feed_explicit; ?></itunes:explicit>                        
        </item>
    <?php
    }
}        
?>

    </channel>
</rss>