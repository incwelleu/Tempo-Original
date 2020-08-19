<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                         -- Bevel component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTBevel extends JTThemedCustomPanel
{
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
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'bevel' ) );
    }

    protected function dumpThemedContainerContents( $content )
    {
        $vars = array(
            'CONTENT'           => $content,
        );

        print( $this->generateComponentSectionCode( 'bevel', $vars ) );
    }

    function getInclude()
    {
        return $this->readInclude();
    }

    function setInclude( $value )
    {
        $this->writeInclude($value);
    }
}
?>
