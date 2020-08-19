<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                  --  Header code output component --
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );
use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );

class JTHeaderCode extends GraphicControl
{
    protected $_Code = '';

    function __construct($aowner=null)
    {
        parent::__construct($aowner);

        $this->Width = 180;
        $this->Height = 20;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        if( ( $this->ControlState & csDesigning ) != csDesigning )
            echo( $this->_Code . "\r\n" );
    }

    function dumpContents()
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning )
            echo( "<!-- Design-time code only -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: solid 1px #000090; background: #E5EDFF; width: " . $this->Width . "px; height: " . $this->Height . "px;\">\r\n  <tr>\r\n    <td align=\"center\" valign=\"middle\" style=\"font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 8pt;\">" . $this->Name . ': ' . get_class( $this ) . "</td>\r\n  </tr>\r\n</table>\r\n" );
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
}
?>
