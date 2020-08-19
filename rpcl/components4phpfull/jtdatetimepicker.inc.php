<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Date picker control --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTDateTimePicker extends JTThemedGraphicControl
{
    const TimeType12Hour = '12Hour';
    const TimeType24Hour = '24Hour';

    protected $_Color = '';
    protected $_datafield = '';
    protected $_datasource = null;
    protected $_DateTime = '';
    protected $_AllowTyping = 0;
    protected $_TimeType = self::TimeType12Hour;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 224;
        $this->Height = 24;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function preinit()
    {
        $submitted = $this->input->{$this->Name};

        if( is_object( $submitted ) )
        {
            $dt = $submitted->asString();

            if( preg_match( '/^([\d]{4})\-([\d]{2})\-([\d]{2}) ([\d]{2})\:([\d]{2})\:([\d]{2})/', $dt, $matches ) )
            {
                $dt = date( 'Y-m-d H:i:s', mktime( $matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1] ) );

                $this->_DateTime = $dt;

                $this->updateDataField( $dt );
            }
        }
    }

    function init()
    {
        if( defined( 'JT_STANDALONE' ) )
            $this->preinit();
        else
            parent::init();
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            $this->SiteThemeInstance->addComponentJSCode( get_class( $this ) );

            if( ( $this->ControlState & csDesigning ) == csDesigning )
                $this->SiteThemeInstance->dumpHeaderCode();

            print( $this->SiteThemeInstance->generateComponentCSSCode( 'datepicker' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'datetimepicker' ) );
        }
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        $this->dumpDateLocalization();
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        if( $this->_datafield && $this->_datasource )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $value = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_datafield ];
                if( $value == 0 || $value == '0000-00-00 00:00:00' )
                    $value = '';
            }
            else
            {
                $value = '';
            }
        }
        else
        {
            $value = $this->_DateTime;
        }

        $styles = GetJTFontString( $this->StyleFont );

        if( strlen( $this->_Color ) )
            $styles .= ' background-color: ' . $this->_Color . ' ';

        $vars = array(
            '12HOUR'        => ( $this->_TimeType == self::TimeType12Hour ) ? 'inline' : 'none',
            'DATETIME'      => $value,
            'DISABLED'      => ( $this->Enabled ? '' : ' disabled' ),
            'ALLOWTYPING'   => ( $this->_AllowTyping ) ? ' onkeyup="JTDateTimePickerOnKeyUp( \'{$NAME}\' )" onblur="JTDateTimePickerOnBlur( \'{$NAME}\' )"' : ' readonly="readonly"',
            'EVENTS'        => $this->JsEvents,
            'STYLES'        => $styles,
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : '-1' ),
            'VISIBILITY'    => ( ( ( $this->ControlState & csDesigning ) == csDesigning ) ? 'visible' : 'hidden' ),
        );

        print( $this->generateComponentSectionCode( 'datetimepicker', $vars ) );
    }

    protected function dumpControlFooter()
    {
        print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

        $this->dumpBodyJavaScript();

        print( "</script>\r\n" );
    }

    function dumpBodyJavaScript()
    {
        $params = array
        (
            "'" . $this->Name . "'",
            GetJTJSEventToString( $this->jsOnChange ),
            "'" . $this->_TimeType . "'",
            GetJTJSEventToString( $this->jsOnBlur ),
            GetJTJSEventToString( $this->jsOnFocus ),
        );

        print( "JTDateTimePickerInitialize( " . implode( ',', $params ) . " );\r\n" );

        if( $this->_AllowTyping && ( $this->ControlState & csDesigning ) != csDesigning )
            print( "JTAdvEditInitialize( '" . $this->Name . "', '####-##-## ##:##:##', '_', ' ', '', '' );\r\n" );
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

        print( "JTDateTimePickerCleanup( '" . $this->Name . "' );\r\n" );
        print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );

        $this->dumpBodyJavaScript();
    }

    function getColor()
    {
        return $this->_Color;
    }

    function setColor( $value )
    {
        $this->_Color = $value;
    }

    function defaultColor()
    {
        return '';
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

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getDateTime()
    {
        return $this->_DateTime;
    }

    function setDateTime( $value )
    {
        if( $value == '' || preg_match( '/^[\d]{4}\-[\d]{2}\-[\d]{2} [\d]{2}\:[\d]{2}\:[\d]{2}$/', $value ) )
            $this->_DateTime = $value;
    }

    function defaultDateTime()
    {
        return '';
    }

    function getAllowTyping()
    {
        return $this->_AllowTyping;
    }

    function setAllowTyping( $value )
    {
        $this->_AllowTyping = $value;
    }

    function defaultAllowTyping()
    {
        return 0;
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getTabOrder()
    {
        return $this->readTabOrder();
    }

    function setTabOrder( $value )
    {
        $this->writeTabOrder( $value );
    }

    function getTabStop()
    {
        return $this->readTabStop();
    }

    function setTabStop( $value )
    {
        $this->writeTabStop( $value );
    }

    function getTimeType()
    {
        return $this->_TimeType;
    }

    function setTimeType( $value )
    {
        if( $value != self::TimeType12Hour && $value != self::TimeType24Hour )
            return;

        $this->_TimeType = $value;
    }

    function defaultTimeType()
    {
        return self::TimeType12Hour;
    }

    function getjsOnBlur                    () { return $this->readjsOnBlur(); }
    function setjsOnBlur                    ($value) { $this->writejsOnBlur($value); }

    function getjsOnChange()
    {
        return $this->readjsOnChange();
    }

    function setjsOnChange( $value )
    {
        $this->writejsOnChange( $value );
    }

    function getjsOnFocus                   () { return $this->readjsOnFocus(); }
    function setjsOnFocus                   ($value) { $this->writejsOnFocus($value); }
}
?>
