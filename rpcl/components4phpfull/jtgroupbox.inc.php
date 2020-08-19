<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                         -- Groupbox component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTGroupBox extends JTThemedCustomPanel
{
    protected $_Caption;

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
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'groupbox' ) );
    }

    protected function dumpThemedContainerContents( $content )
    {
        $vars = array(
            'CAPTION'           => $this->_Caption,
            'CONTENT'           => $content,
        );

        print( $this->generateComponentSectionCode( 'groupbox', $vars ) );
    }

    function getInclude()
    {
        return $this->readInclude();
    }

    function setInclude( $value )
    {
        $this->writeInclude($value);
    }

    function getCaption()
    {
        return $this->_Caption;
    }

    function setCaption( $value )
    {
        $this->_Caption = $value;
    }

    function defaultCaption()
    {
        return '';
    }
}
?>
