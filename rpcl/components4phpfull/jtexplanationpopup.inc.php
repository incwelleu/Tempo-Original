<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- Explanation pop-up component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtthemedcomponent.inc.php" );

class JTExplanationPopup extends JTThemedComponent
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            echo( $this->SiteThemeInstance->generateComponentCSSCode( 'explanationpopup' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( !$this->initializeSkin( $error ) )
        {
            echo( "// $error\r\n" );
            return;
        }

        $code = $this->generateComponentSectionCode( 'popup', array() );
        $code = str_replace( "\r\n", ' ', $code );
        $code = str_replace( "\n", ' ', $code );
        $code = str_replace( "\r", ' ', $code );
        $code = str_replace( '  ', ' ', $code );
        $code = str_replace( '"', '\"', $code );

        $jscode = 'JTExplanationPopupInitialize( "' . $this->Name . '", "' . trim( $code ) . "\" );\r\n";

        $this->SiteThemeInstance->addAfterSiteThemeJS( $jscode );
    }
}
?>
