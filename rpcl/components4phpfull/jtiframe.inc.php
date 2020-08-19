<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     --  Inline-frame component --
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTIFrame extends JTThemedGraphicControl
{
    protected $_URL = '';
    protected $_ScrollBars = 'auto';
    protected $_ShowBorder = true;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 300;
    }

    protected function dumpThemedContents()
    {
        $url = ( ( $this->ControlState & csDesigning ) != csDesigning ) ? $this->_URL : '';

        $vars = array(
            'URL'           => $url,
            'SCROLLING'     => $this->_ScrollBars,
            'BORDER'        => ( $this->_ShowBorder ? '1' : '0' ),
        );

        print( $this->generateComponentSectionCode( 'iframe', $vars ) );
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

    function getURL()
    {
        return $this->_URL;
    }

    function setURL( $value )
    {
        $this->_URL = $value;
    }

    function defaultURL()
    {
        return '';
    }

    function getScrollBars()
    {
        return $this->_ScrollBars;
    }

    function setScrollBars( $value )
    {
        $this->_ScrollBars = $value;
    }

    function defaultScrollBars()
    {
        return 'auto';
    }

    function getShowBorder()
    {
        return $this->_ShowBorder;
    }

    function setShowBorder( $value )
    {
        $this->_ShowBorder = $value;
    }

    function defaultShowBorder()
    {
        return true;
    }
}
?>
