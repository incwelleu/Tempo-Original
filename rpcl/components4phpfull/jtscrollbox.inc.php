<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Scroll box component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTScrollBox extends JTThemedCustomPanel
{
    protected $_AlwaysShowScrollbars = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;

        $this->ControlStyle = "csAcceptsControls=1";
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'scrollbox' ) );
    }

    protected function dumpThemedContainerContents( $content )
    {
        $vars = array(
            'CONTENT'           => $content,
            'SCROLLBARS'        => ( $this->_AlwaysShowScrollbars ? 'scroll' : 'auto' ),
            'TABINDEX'          => ( $this->_TabStop ? $this->_TabOrder : '' ),
        );

        print( $this->generateComponentSectionCode( 'scrollbox', $vars ) );
    }

    function getInclude()
    {
        return $this->readInclude();
    }

    function setInclude( $value )
    {
        $this->writeInclude($value);
    }

    function getAlwaysShowScrollbars()
    {
        return $this->_AlwaysShowScrollbars;
    }

    function setAlwaysShowScrollbars( $value )
    {
        $this->_AlwaysShowScrollbars = $value;
    }

    function defaultAlwaysShowScrollbars()
    {
        return 0;
    }

    function getTabOrder()
    {
        return $this->readTabOrder();
    }

    function setTabOrder( $value )
    {
        $this->writeTabOrder( $value );
    }

    function getTabStop()
    {
        return $this->readTabStop();
    }

    function setTabStop( $value )
    {
        $this->writeTabStop( $value );
    }
}
?>
