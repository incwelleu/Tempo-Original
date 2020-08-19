<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- RSS 2.0 Feed Component --
//
//            Copyright © JomiTech 2009. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( 'vcl/vcl.inc.php' );

use_unit( "components4phpfull/jtbasefeed.inc.php" );

class JTRSSFeed extends JTBaseFeed
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        echo( "<link href=\"" . $this->GenerateFeedLink() . "\" type=\"application/rss+xml\" rel=\"alternate\" title=\"" . $this->_FeedTitle . "\" />\r\n" );
    }

    protected function GenerateFeedItem( $title, $date, $content, $link )
    {
        $rssdate = strtotime( $date );
        $rssdate = date( 'r', $rssdate );

        $asc2uni = array();
        for( $i = 128; $i < 256; ++$i )
            $asc2uni[ chr( $i ) ] = '&#x' . dechex( $i ) . ';';

        $content = strtr( $content, $asc2uni );

        return
            "  <item>\r\n" .
            "    <title>$title</title>\r\n" .
            "    <link>$link</link>\r\n" .
            "    <pubDate>$rssdate</pubDate>\r\n" .
            "    <description><![CDATA[$content]]></description>\r\n" .
            "  </item>\r\n";
    }

    protected function GenerateFeed( $feedContents )
    {
        header( 'Content-type: application/rss+xml' );

        $rssdate = $this->_NewestItem;
        if( $rssdate != '' )
        {
            $rssdate = strtotime( $rssdate );
            $rssdate = date( 'r', $rssdate );
        }

        print( '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n" );
        print( '<rss version="2.0">' . "\r\n" );
        print( '<channel>' . "\r\n" );
        print( '  <title>' . $this->_FeedTitle . "</title>\r\n" );
        print( "  <description></description>\r\n" );

        if( $this->_FeedLink )
            print( '  <link>' . $this->_FeedLink . "</link>\r\n" );

        if( $rssdate != '' )
            print( '   <pubDate>' . $rssdate . "</pubDate>\r\n" );

        print( $feedContents );
        print( "</channel>\r\n" );
        print( "</rss>\r\n" );
    }
}
?>
