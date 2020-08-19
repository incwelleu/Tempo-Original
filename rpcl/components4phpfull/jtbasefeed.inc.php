<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- Base class for feed delivery --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( 'vcl/vcl.inc.php' );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

abstract class JTBaseFeed extends JTThemedGraphicControl
{
    protected $_ContentField = '';
    protected $_datasource = null;
    protected $_DateField = '';
    protected $_FeedLink = '';
    protected $_FeedTitle = '';
    protected $_LinkField = '';
    protected $_MaxFeedItems = 30;
    protected $_TitleField = '';

    protected $_ongetfeeditem = null;

    protected $_NewestItem = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 20;
        $this->Height = 20;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function init()
    {
        parent::init();

        $classname = get_class( $this );
        $v = $this->input->{ $classname };

        $key = md5( $this->owner->Name . '.' . $this->Name );

        if( is_object( $v ) && $v->asString() == $key )
            $this->dumpFeed();
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'feed' ) );
    }

    protected function dumpThemedContents()
    {
        $vars = array(
            'FEEDTITLE'     => $this->_FeedTitle,
        );

        $vars[ 'FEEDLINK' ] = $this->GenerateFeedLink();

        print( $this->generateComponentSectionCode( 'feedimg', $vars ) );
    }

    protected function dumpFeed()
    {
        $feedContents = '';

        if( $this->_datasource && $this->_TitleField && $this->_DateField && $this->_ContentField && $this->_datasource->DataSet )
        {
            for( $this->_datasource->DataSet->First(), $i = 0; !$this->_datasource->DataSet->EOF && ( $i < $this->_MaxFeedItems ); $this->_datasource->DataSet->Next(), ++$i )
            {
                $title = $this->_datasource->DataSet->Fields[ $this->_TitleField ];
                $date = $this->_datasource->DataSet->Fields[ $this->_DateField ];
                $content = $this->_datasource->DataSet->Fields[ $this->_ContentField ];
                $link = $this->_datasource->DataSet->Fields[ $this->_LinkField ];

                if( $this->_NewestItem == '' )
                    $this->_NewestItem = $date;

                $this->ValidateLink( $link );

                $feedContents .= $this->GenerateFeedItem( $title, $date, $content, $link );
            }
        }
        else if( $this->_ongetfeeditem )
        {
            for( $i = 0; $i < $this->MaxFeedItems; ++$i )
            {
                $result = $this->callEvent( 'ongetfeeditem', array( $i ) );
                if( !$result )
                    break;

                list( $title, $date, $link, $content ) = $result;

                if( $this->_NewestItem == '' )
                    $this->_NewestItem = $date;

                $this->ValidateLink( $link );

                $feedContents .= $this->GenerateFeedItem( $title, $date, $content, $link );
            }
        }

        $this->GenerateFeed( $feedContents );
        exit;
    }

    protected function GenerateFeedLink()
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning )
            return 'url.php?' . get_class( $this ) . '=' . md5( $this->owner->Name . '.' . $this->Name );
        else
            return $_SERVER[ 'PHP_SELF' ] . '?' . get_class( $this ) . '=' . md5( $this->owner->Name . '.' . $this->Name );
    }

    protected function ValidateLink( &$link )
    {
        if( !preg_match( '/^[a-z]+:\/\//', $link ) )
        {
            if( substr( $link, 0, 1 ) != '/' )
                $link = rtrim( dirname( $_SERVER[ 'PHP_SELF' ] ), '/\\' ) . '/' . $link;

            $link = 'http://' . $_SERVER[ 'HTTP_HOST' ] . $link;
        }
    }

    abstract protected function GenerateFeedItem( $title, $date, $content, $link );

    abstract protected function GenerateFeed( $feedContents );

    function getContentField()
    {
        return $this->_ContentField;
    }

    function setContentField( $value )
    {
        $this->_ContentField = $value;
    }

    function defaultContentField()
    {
        return '';
    }

    function getDateField()
    {
        return $this->_DateField;
    }

    function setDateField( $value )
    {
        $this->_DateField = $value;
    }

    function defaultDateField()
    {
        return '';
    }

    function getLinkField()
    {
        return $this->_LinkField;
    }

    function setLinkField( $value )
    {
        $this->_LinkField = $value;
    }

    function defaultLinkField()
    {
        return '';
    }

    function getTitleField()
    {
        return $this->_TitleField;
    }

    function setTitleField( $value )
    {
        $this->_TitleField = $value;
    }

    function defaultTitleField()
    {
        return '';
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getFeedLink()
    {
        return $this->_FeedLink;
    }

    function setFeedLink( $value )
    {
        $this->_FeedLink = $value;
    }

    function defaultFeedLink()
    {
        return '';
    }

    function getFeedTitle()
    {
        return $this->_FeedTitle;
    }

    function setFeedTitle( $value )
    {
        $this->_FeedTitle = $value;
    }

    function defaultFeedTitle()
    {
        return '';
    }

    function getMaxFeedItems()
    {
        return $this->_MaxFeedItems;
    }

    function setMaxFeedItems( $value )
    {
        if( !is_numeric( $value ) )
            return;

        $this->_MaxFeedItems = $value;
    }

    function defaultMaxFeedItems()
    {
        return 30;
    }

    function getHelp()
    {
        return get_class( $this );
    }

    function setHelp( $value )
    {
    }

    function defaultHelp()
    {
        return get_class( $this );
    }

    function getOnGetFeedItem()
    {
        return $this->_ongetfeeditem;
    }

    function setOnGetFeedItem( $value )
    {
        $this->_ongetfeeditem = $value;
    }
}
?>
