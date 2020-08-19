<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    --  Object control component --
//
//              Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTObjectControl extends JTThemedGraphicControl
{
    protected $_ClassID = '';
    protected $_CodeBase = '';
    protected $_Data = '';
    protected $_Parameters = array();
    protected $_Type = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 300;
        $this->Height = 300;
    }

    protected function dumpThemedContents()
    {
        $params = '';

        foreach( $this->_Parameters as $n => $v )
            $params .= "<param name=\"$n\" value=\"$v\" />\r\n";

        $vars = array(
            'CLASSID'       => ( !empty( $this->_ClassID ) ) ? 'clsid:' . $this->_ClassID : '',
            'CODEBASE'      => $this->_CodeBase,
            'DATA'          => $this->_Data,
            'PARAMETERS'    => $params,
            'TYPE'          => $this->_Type,
        );

        print( $this->generateComponentSectionCode( 'object', $vars ) );
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

    function getClassID()
    {
        return $this->_ClassID;
    }

    function setClassID( $value )
    {
        $this->_ClassID = $value;
    }

    function defaultClassID()
    {
        return '';
    }

    function getCodeBase()
    {
        return $this->_CodeBase;
    }

    function setCodeBase( $value )
    {
        $this->_CodeBase = $value;
    }

    function defaultCodeBase()
    {
        return '';
    }

    function getData()
    {
        return $this->_Data;
    }

    function setData( $value )
    {
        $this->_Data = $value;
    }

    function defaultData()
    {
        return '';
    }

    function getParameters()
    {
        return $this->_Parameters;
    }

    function setParameters( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        $this->_Parameters = $value;
    }

    function defaultParameters()
    {
        return array();
    }

    function getType()
    {
        return $this->_Type;
    }

    function setType( $value )
    {
        $this->_Type = $value;
    }

    function defaultType()
    {
        return '';
    }
}
?>
