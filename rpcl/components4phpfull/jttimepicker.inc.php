<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Time picker component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

define( 'tt24Hour', 'tt24Hour' );
define( 'tt12Hour', 'tt12Hour' );

class JTTimePicker extends JTThemedGraphicControl
{
    protected $_datasource = null;
    protected $_datafield = '';
    protected $_Time = '';
    protected $_TimeType = tt12Hour;

    protected $_onclick;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 250;
        $this->Height = 24;
    }

    function preinit()
    {
        $hInput = $this->Name . '_h';
        $mInput = $this->Name . '_m';
        $sInput = $this->Name . '_s';
        $aInput = $this->Name . '_a';

        $hInput = $this->input->{$hInput};
        $mInput = $this->input->{$mInput};
        $sInput = $this->input->{$sInput};
        $aInput = $this->input->{$aInput};

        if( is_object( $hInput ) && is_object( $mInput ) && is_object( $sInput ) && ( $this->_TimeType != tt12Hour || is_object( $aInput ) ) )
        {
            $newtime = $hInput->asString() . ':' . $mInput->asString() . ':' . $sInput->asString();

            if( $this->_TimeType == tt12Hour )
                $newtime .= ' ' . $aInput->asString();

            if( preg_match( '/^[0-9]{1,2}\:[0-9]{1,2}\:[0-9]{1,2}(( AM)|( PM)){0,1}$/', $newtime ) )
            {
                $this->updateDataField( $newtime );

                $this->_Time = $newtime;
            }
        }
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'dtpicker' ) );
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " $style";

        if( $this->_datasource && strlen( $this->_datafield ) )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $datafield = $this->_datafield;

                $time = $this->_datasource->DataSet->AssociativeFieldValues[ $datafield ];
            }
        }
        else if( $this->_Time )
        {
            $time = $this->_Time;
        }

        if( !empty( $time ) )
        {
            $timestamp = strtotime( $time );

            $h = date( ( $this->_TimeType == tt24Hour ) ? 'H' : 'h', $timestamp );
            $m = date( 'i', $timestamp );
            $s = date( 's', $timestamp );

            if( $this->_TimeType != tt24Hour )
                $ap = date( 'A', $timestamp );
            else
                $ap = false;
        }
        else
        {
            $h = '';
            $m = '';
            $s = '';
            $ap = 'AM';
        }

        $vars = array(
            'HOUR'      => $h,
            'MINUTE'    => $m,
            'SECOND'    => $s,
            'ISAM'      => ( $ap == 'AM' ) ? ' selected' : '',
            'ISPM'      => ( $ap == 'PM' ) ? ' selected' : '',
            '12HOUR'    => ( $this->_TimeType == tt12Hour ) ? 'inline' : 'none',
        );

        print( $this->generateComponentSectionCode( 'datetime', $vars ) );

        if( ( $this->ControlState & csDesigning ) != csDesigning )
            $this->dumpHiddenKeyFields();
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
        }

        if( $this->_onclick )
            print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
    }

    function dumpBodyJavaScript()
    {
        $params = array
        (
            "'" . $this->Name . "'",
            "'" . $this->_TimeType . "'",
            GetJTJSEventToString( $this->jsOnChange ),
        );

        print( "JTTimePickerInitialize( " . implode( ',', $params ) . " );\r\n" );
    }

    function dumpForAjax()
    {
        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_contents();

        ob_end_clean();

        $contents = str_replace( "\r\n", " ", $contents );
        $contents = str_replace( "\n", " ", $contents );
        $contents = str_replace( '"', '\"', $contents );

        print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );

        $this->dumpBodyJavaScript();
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getDataField()
    {
        return $this->_datafield;
    }

    function setDataField( $value )
    {
        $this->_datafield = $value;
    }

    function defaultDataField()
    {
        return '';
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getTime()
    {
        return $this->_Time;
    }

    function setTime( $value )
    {
        $this->_Time = $value;
    }

    function defaultTime()
    {
        return '';
    }

    function getTimeType()
    {
        return $this->_TimeType;
    }

    function setTimeType( $value )
    {
        if( $value != tt12Hour && $value != tt24Hour )
            return;

        $this->_TimeType = $value;
    }

    function defaultTimeType()
    {
        return tt12Hour;
    }

    function getjsOnChange()
    {
        return $this->readjsOnChange();
    }

    function setjsOnChange( $value )
    {
        $this->writejsOnChange( $value );
    }
}
?>