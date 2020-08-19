<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                  -- JavaScript output component --
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );
use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );

define( 'jsBody', 'jsBody' );
define( 'jsHead', 'jsHead' );

class JTJavaScript extends GraphicControl
{
    protected $_Code = '';
    protected $_FileName = '';
    protected $_Location = jsBody;

    function __construct($aowner=null)
    {
        parent::__construct($aowner);

        $this->Width = 180;
        $this->Height = 20;
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_Location == jsHead && $this->_Code != '' && ( $this->ControlState & csDesigning ) != csDesigning )
        {
            echo( '// Begin code emitted by ' . $this->Name . ".\r\n" );
            echo( $this->_Code . "\r\n" );
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        if( $this->_Location == jsHead && $this->_FileName != '' && ( $this->ControlState & csDesigning ) != csDesigning )
            print( "<script language=\"JavaScript\" type=\"text/javascript\" src=\"" . $this->_FileName . "\"></script>\r\n" );
    }

    function dumpContents()
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning )
        {
            echo( "<!-- Design-time code only -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: solid 1px #000090; background: #E5EDFF; width: " . $this->Width . "px; height: " . $this->Height . "px;\">\r\n  <tr>\r\n    <td align=\"center\" valign=\"middle\" style=\"font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 8pt;\">" . $this->Name . ': ' . get_class( $this ) . "</td>\r\n  </tr>\r\n</table>\r\n" );
            return;
        }

        if( $this->_Location == jsBody )
        {
            if( $this->_FileName != '' )
                echo( '<script language="JavaScript" type="text/javascript" src="' . $this->_FileName . "\"></script>\r\n" );

            if( $this->_Code != '' )
            {
                echo( "<script language=\"JavaScript\" type=\"text/javascript\"><!--\r\n" );
                echo( $this->_Code . "\r\n" );
                echo( "// -->\r\n" );
                echo( "</script>\r\n" );
            }
        }
    }

    function dumpForAjax()
    {
        echo( $this->_Code );
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

    function getCode()
    {
        return $this->_Code;
    }

    function setCode( $Code )
    {
        $this->_Code = $Code;
    }

    function defaultCode()
    {
        return '';
    }

    function getFileName()
    {
        return $this->_FileName;
    }

    function setFileName( $FileName )
    {
        $this->_FileName = $FileName;
    }

    function defaultFileName()
    {
        return '';
    }

    function getLocation()
    {
        return $this->_Location;
    }

    function setLocation( $value )
    {
        if( $value != jsBody && $value != jsHead )
            return;

        $this->_Location = $value;
    }

    function defaultLocation()
    {
        return jsBody;
    }
}
?>
