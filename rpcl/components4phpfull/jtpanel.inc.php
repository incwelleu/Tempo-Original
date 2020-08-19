<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                         -- Panel component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTPanel extends JTThemedCustomPanel
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 300;
        $this->ControlStyle = "csAcceptsControls=1";
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'panel' ) );
    }

    protected function dumpThemedContainerContents( $content )
    {
        $vars = array(
            'BACKGROUND'        => ( $this->_color ? ( ' background: ' . $this->_color . ';' ) : '' ),
            'CONTENT'           => $content,
        );

        print( $this->generateComponentSectionCode( 'panel', $vars ) );
    }

    function getColor()
    {
        return $this->readColor();
    }

    function setColor( $value )
    {
        $this->writeColor( $value );
    }

    function getInclude()
    {
        return $this->readInclude();
    }

    function setInclude( $value )
    {
        $this->writeInclude( $value );
    }

    function getParentColor()
    {
        return $this->readParentColor();
    }

    function setParentColor( $value )
    {
        $this->writeParentColor( $value );
    }
}
?>
