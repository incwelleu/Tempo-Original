<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      --  Raw output component --
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );
use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );

class JTRawOutput extends GraphicControl
{
    protected $_value = '';

    function __construct($aowner=null)
    {
        parent::__construct($aowner);

        $this->Width = 75;
        $this->Height = 25;
    }

    function dumpContents()
    {
        print( $this->_value );
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

    function getValue()
    {
        return $this->_value;
    }

    function setValue( $value )
    {
        $this->_value = $value;
    }

    function defaultValue()
    {
        return '';
    }
}
?>
