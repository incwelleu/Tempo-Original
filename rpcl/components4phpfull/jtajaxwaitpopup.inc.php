<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Ajax wait popup component --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtthemedcomponent.inc.php" );

class JTAjaxWaitPopup extends JTThemedComponent
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
            echo( $this->SiteThemeInstance->generateComponentCSSCode( 'ajaxwaitpopup' ) );
    }

    function dumpJavascript()
    {
        global $ajaxResponse;

        parent::dumpJavascript();

        // Don't need to emit the component again.
        if( $ajaxResponse )
            return;

        if( !$this->initializeSkin( $error ) )
        {
            echo( "// $error\r\n" );
            return;
        }

        $code = $this->generateComponentSectionCode( 'popup', array() );

        $jscode = 'JTAjaxWaitPopupInitialize("' . $this->Name . '", ' . json_encode( $code ) . ");\r\n";

        $this->SiteThemeInstance->addAfterSiteThemeJS( $jscode );
    }
}
?>
