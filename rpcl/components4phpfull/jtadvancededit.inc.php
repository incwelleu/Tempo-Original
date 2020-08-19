<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Advanced edit control --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTAdvancedEdit extends JTThemedGraphicControl
{
    protected $_Color = '';
    protected $_datafield = '';
    protected $_datasource = null;
    protected $_Enabled = true;
    protected $_IsPassword = 0;
    protected $_Mask = '';
    protected $_MaskChar = '_';
    protected $_MaskNum = '#';
    protected $_MaxLength = '';
    protected $_ReadOnly = 0;
    protected $_Text = '';
    protected $_ValidationMessage = '';
    protected $_ValidationRegExp = '';
    protected $_ondata;

    protected $_jsOnValidate = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
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
            $this->_Text = $submitted->asString();

            if( $this->Validate() )
                $this->updateDataField( $this->_Text );
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'advedit' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_jsOnValidate )
        {
            $event = $this->_jsOnValidate;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
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
                if( $this->_ondata )
                {
                    $value = $this->callEvent( 'ondata', array( $this->readDataFieldValue() ) );

                    if( empty( $value ) )
                        $value = $this->readDataFieldValue();
                }
                else
                    $value = $this->readDataFieldValue();


                $this->dumpHiddenKeyFields();
            }
            else
            {
                $value = '';
            }
        }
        else
        {
            $value = $this->_Text;
        }

        $styles = GetJTFontString( $this->StyleFont );

        if( strlen( $this->_Color ) )
            $styles .= ' background-color: ' . $this->_Color . ' ';

        $vars = array(
            'CONTENT'       => $value,
            'EVENTS'        => $this->JsEvents,
            'DISABLED'      => ( $this->_Enabled ? '' : ' disabled' ),
            'MAXLENGTH'     => ( strlen( $this->_MaxLength ) ? ( ' maxlength="' . $this->_MaxLength . '"' ) : '' ),
            'READONLY'      => ( $this->_ReadOnly ? ' readonly' : '' ),
            'STYLES'        => $styles,
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : '-1' ),
            'TYPE'          => ( $this->_IsPassword ? 'password' : 'text' ),
        );

        print( $this->generateComponentSectionCode( 'edit', $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        $validationMessage = $this->_ValidationMessage;
        if( !strlen( $validationMessage ) )
        {
            $validationMessage = $this->SiteThemeInstance->retrieveString( 'ValidateInvalidValueMessage' );
            if( !strlen( $validationMessage ) )
                $validationMessage = "You did not enter a valid value for this field. Please try again.";
        }

        print( "JTAdvEditInitialize( '" . $this->Name . "', '" . $this->_Mask . "', '" . $this->_MaskChar .
            "', '" . $this->_MaskNum . "', '" . addcslashes( $this->_ValidationRegExp, "\\\'\"" ) . "', " .
            GetJTJSEventToString( $this->_jsOnValidate ) . ", '" . addcslashes( $validationMessage, "\\\'\"" ) . "' );\r\n" );
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

    function Validate()
    {
        if( empty( $this->_ValidationRegExp ) )
            return true;

        return preg_match( $this->_ValidationRegExp, $this->Text );
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

    function getIsPassword()
    {
        return $this->_IsPassword;
    }

    function setIsPassword( $value )
    {
        $this->_IsPassword = $value;
    }

    function defaultIsPassword()
    {
        return 0;
    }

    function getMask()
    {
        return $this->_Mask;
    }

    function setMask( $value )
    {
        $this->_Mask = $value;
    }

    function defaultMask()
    {
        return '';
    }

    function getMaskChar()
    {
        return $this->_MaskChar;
    }

    function setMaskChar( $value )
    {
        $this->_MaskChar = substr( $value, 0, 1 );
    }

    function defaultMaskChar()
    {
        return '_';
    }

    function getMaskNum()
    {
        return $this->_MaskNum;
    }

    function setMaskNum( $value )
    {
        $this->_MaskNum = substr( $value, 0, 1 );
    }

    function defaultMaskNum()
    {
        return '#';
    }

    function getMaxLength()
    {
        return $this->_MaxLength;
    }

    function setMaxLength( $value )
    {
        $this->_MaxLength = $value;
    }

    function defaultMaxLength()
    {
        return '';
    }

    function getReadOnly()
    {
        return $this->_ReadOnly;
    }

    function setReadOnly( $value )
    {
        $this->_ReadOnly = $value;
    }

    function defaultReadOnly()
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

    function getText()
    {
        return $this->_Text;
    }

    function setText( $value )
    {
        $this->_Text = $value;
    }

    function defaultText()
    {
        return '';
    }

    function getValidationMessage()
    {
        return $this->_ValidationMessage;
    }

    function setValidationMessage( $value )
    {
        $this->_ValidationMessage = $value;
    }

    function defaultValidationMessage()
    {
        return '';
    }

    function getValidationRegExp()
    {
        return $this->_ValidationRegExp;
    }

    function setValidationRegExp( $value )
    {
        $this->_ValidationRegExp = $value;
    }

    function defaultValidationRegExp()
    {
        return '';
    }

    function getjsOnClick()
    {
        return $this->readjsOnClick();
    }

    function setjsOnClick( $value )
    {
        $this->writejsOnClick($value);
    }

    function getjsOnBlur()
    {
        return $this->readjsOnBlur();
    }

    function setjsOnBlur( $value )
    {
        $this->writejsOnBlur( $value );
    }

    function getjsOnFocus()
    {
        return $this->readjsOnFocus();
    }

    function setjsOnFocus( $value )
    {
        $this->writejsOnFocus( $value );
    }

    function getjsOnChange()
    {
        return $this->readjsOnChange();
    }

    function setjsOnChange( $value )
    {
        $this->writejsOnChange( $value );
    }

    function getjsOnKeyPress()
    {
        return $this->readjsOnKeyPress();
    }

    function setjsOnKeyPress( $value )
    {
        $this->writejsOnKeyPress( $value );
    }

    function getjsOnKeyUp()
    {
        return $this->readjsOnKeyUp();
    }

    function setjsOnKeyUp( $value )
    {
        $this->writejsOnKeyUp( $value );
    }

    function getjsOnValidate()
    {
        return $this->_jsOnValidate;
    }

    function setjsOnValidate( $value )
    {
        $this->_jsOnValidate = $value;
    }

    function defaultjsOnValidate()
    {
        return null;
    }

    function getOnData()
    {
        return $this->_ondata;
    }

    function setOnData( $value )
    {
        $this->_ondata = $value;
    }

    function defaultOnData()
    {
        return null;
    }
}
?>
