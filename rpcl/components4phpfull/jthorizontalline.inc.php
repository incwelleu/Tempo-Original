<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Horizontal line component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTHorizontalLine extends JTThemedGraphicControl
{
    protected $_LineSize = '';
    protected $_LineColor = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 500;
        $this->Height = 10;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'horzline' ) );
    }

    protected function dumpThemedContents()
    {
        $style = '';

        if( strlen( $this->_LineSize ) )
            $style .= ' height: ' . $this->_LineSize . ';';

        if( strlen( $this->_LineColor ) )
            $style .= ' background-color: ' . $this->_LineColor . ';';

        $vars = array(
            'STYLE'     => $style
        );

        print( $this->generateComponentSectionCode( 'horizontalline', $vars ) );
    }

    function getLineSize()
    {
        return $this->_LineSize;
    }

    function setLineSize( $value )
    {
        $this->_LineSize = $value;
    }

    function defaultLineSize()
    {
        return '';
    }

    function getLineColor()
    {
        return $this->_LineColor;
    }

    function setLineColor( $value )
    {
        $this->_LineColor = $value;
    }

    function defaultLineColor()
    {
        return '';
    }
}
?>