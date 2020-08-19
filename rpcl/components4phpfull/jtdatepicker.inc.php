<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Date picker control --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTDatePicker extends JTThemedGraphicControl
{
    protected $_Color = '';
    protected $_datafield = '';
    protected $_datasource = null;
    protected $_Date = '';
    protected $_DateFormat = 'Y-m-d';
    protected $_Enabled = true;
    protected $_AllowTyping = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 224;
        $this->Height = 24;

        // $this->_Date = date( 'Y-m-d' );
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

            if( preg_match( '/^[\d]{4}\-[\d]{2}\-[\d]{2}/', $dt ) )
            {
                $this->_Date = $dt;
                $this->updateDataField( $dt );
            }
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            if( ( $this->ControlState & csDesigning ) == csDesigning )
                $this->SiteThemeInstance->dumpHeaderCode();

            print( $this->SiteThemeInstance->generateComponentCSSCode( 'datepicker' ) );
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
                if( $value == 0 || $value == '0000-00-00' )
                    $value = '';
            }
            else
            {
                $value = '';
            }
        }
        else
        {
            $value = $this->_Date;
        }

        $styles = GetJTFontString( $this->StyleFont );

        if( strlen( $this->_Color ) )
            $styles .= ' background-color: ' . $this->_Color . ' ';

        $valueView = $value;
        if( $value && $this->_DateFormat && !$this->_AllowTyping )
            $valueView = date( $this->_DateFormat, strtotime( $value ) );

        $vars = array(
            'DATE'          => $value,
            'DATEVIEW'      => $valueView,
            'DISABLED'      => ( $this->Enabled ? '' : ' disabled="disabled"' ),
            'ALLOWTYPING'   => ( $this->_AllowTyping ) ? ' onblur="JTDatePickerOnBlur( \'{$NAME}\' )"' : ' readonly="readonly"',
            'EVENTS'        => $this->JsEvents,
            'STYLES'        => $styles,
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : '-1' ),
            'VISIBILITY'    => ( ( ( $this->ControlState & csDesigning ) == csDesigning ) ? 'visible' : 'hidden' ),
        );

        print( $this->generateComponentSectionCode( 'datepicker', $vars ) );
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
            GetJTJSEventToString( $this->jsOnBlur ),
            GetJTJSEventToString( $this->jsOnFocus ),
            "'" . ( $this->_AllowTyping ? 'Y-m-d' : $this->_DateFormat ) . "'",
        );

        print( "JTDatePickerInitialize( " . implode( ',', $params ) . " );\r\n" );

        if( $this->_AllowTyping && ( $this->ControlState & csDesigning ) != csDesigning )
            print( "JTAdvEditInitialize( '" . $this->Name . "_view', '####-##-##', '_', ' ', '', '' );\r\n" );
    }

    function dumpForAjax()
    {
        global $ajaxResponse;

        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_clean();

        if( $ajaxResponse )
        {
            $ajaxResponse->script( "JTDatePickerCleanup('{$this->Name}');" );
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            print( "JTDatePickerCleanup( '" . $this->Name . "' );\r\n" );
            print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }

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

    function getDate()
    {
        return $this->_Date;
    }

    function setDate( $value )
    {
        if( $value == '' || preg_match( '/^[\d]{4}\-[\d]{2}\-[\d]{2}$/', $value ) )
            $this->_Date = $value;
    }

    function defaultDate()
    {
        return '999';
    }

    function getDateFormat()
    {
        return $this->_DateFormat;
    }

    function setDateFormat( $value )
    {
        $this->_DateFormat = $value;
    }

    function defaultDateFormat()
    {
        return 'Y-m-d';
    }

    function getEnabled()
    {
        return $this->_Enabled;
    }

    function setEnabled( $value )
    {
        $this->_Enabled = $value;
    }

    function defaultEnabled()
    {
        return true;
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
