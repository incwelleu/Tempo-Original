<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- ATOM 1.0 Feed Component --
//
//            Copyright © JomiTech 2009. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( 'vcl/vcl.inc.php' );

use_unit( "components4phpfull/jtbasefeed.inc.php" );

class JTAtomFeed extends JTBaseFeed
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        echo( "<link href=\"" . $this->GenerateFeedLink() . "\" type=\"application/atom+xml\" rel=\"alternate\" title=\"" . $this->_FeedTitle . "\" />\r\n" );
    }

    protected function GenerateFeedItem( $title, $date, $content, $link )
    {
        $atomdate = strtotime( $date );
        $atomdate = date( 'c', $atomdate );

        $content = htmlspecialchars( $content );

        $asc2uni = array();
        for( $i = 128; $i < 256; ++$i )
            $asc2uni[ chr( $i ) ] = '&#x' . dechex( $i ) . ';';

        $content = strtr( $content, $asc2uni );

        return "  <entry>\r\n    <title>$title</title>\r\n    <link href=\"$link\" />\r\n    <id>$link</id>\r\n    <updated>$atomdate</updated>\r\n    <content type=\"html\">$content</content>\r\n  </entry>\r\n";
    }

    protected function GenerateFeed( $feedContents )
    {
        header( 'Content-type: application/atom+xml' );

        $atomdate = $this->_NewestItem;
        if( $atomdate != '' )
        {
            $atomdate = strtotime( $atomdate );
            $atomdate = date( 'c', $atomdate );
        }

        print( '<?xml version="1.0" encoding="utf-8"?>' . "\r\n" );
        print( '<feed xmlns="http://www.w3.org/2005/Atom">' . "\r\n" );
        print( '  <title>' . $this->_FeedTitle . "</title>\r\n" );

        if( $this->_FeedLink )
            print( '  <link href="' . $this->_FeedLink . "\" />\r\n" );

        if( $atomdate != '' )
            print( '   <updated>' . $atomdate . "</updated>\r\n" );

        if( $this->_FeedLink )
            print( '  <id>' . $this->_FeedLink . "</id>\r\n" );

        print( $feedContents );
        print( "</feed>\r\n" );
    }
}
?>
