<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                       -- Expand panel component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );

define( 'psVisible', 'psVisible' );
define( 'psHidden', 'psHidden' );

class JTExpandPanel extends JTThemedCustomPanel
{
    protected $_PanelState = 'psVisible';
    protected $_ShowText = 'Show';
    protected $_HideText = 'Hide';
    protected $_BorderStyle = '';
    protected $_BorderSize = '';
    protected $_BorderColor = '';
    protected $_ControlBar = null;
    protected $_NextControl = null;

    protected $_jsOnChange = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
        $this->_ControlBar = new JTExpandPanelControlBar( $this );
        $this->ControlStyle = "csAcceptsControls=1";
    }

    function loaded()
    {
        parent::loaded();

        $this->setNextControl( $this->_NextControl );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_jsOnChange )
        {
            $event = $this->_jsOnChange;

            print( "function $event( Sender, PanelState )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'expandpanel' ) );
    }

    protected function dumpThemedContainerContents( $content )
    {
        if( $this->_PanelState == 'psHidden' )
        {
            $display = 'none';
            $ctrl_text = $this->_ShowText;

            if( $this->_ControlBar->Height )
                $startHeight = $this->_ControlBar->Height . 'px';
            else
                $startHeight = '';
        }
        else
        {
            $display = 'block';
            $ctrl_text = $this->_HideText;

            if( $this->_DumpDimensions )
            {
                $startHeight = $this->Height . 'px';
            }
            else
            {
                $startHeight = '100%';
            }
        }

        if( $this->Color )
            $color = ' background-color: ' . $this->Color . ';';
        else
            $color = '';

        $border = '';

        if( $this->_BorderStyle != '' && $this->_BorderSize != '' )
        {
            $border = ' border: ' . $this->_BorderStyle . ' ' . $this->_BorderSize;

            if( $this->_BorderColor )
                $border .= ' ' . $this->_BorderColor;

            $border .= '; border-bottom: none;';
        }

        $ctrlbar_style = $this->_ControlBar->CSS;
        $ctrlbar_font = GetJTFontString( $this->StyleFont );

        if( $ctrlbar_font )
        {
            if( $ctrlbar_style )
                $ctrlbar_style .= ' ';

            $ctrlbar_style .= $ctrlbar_font;
        }

        if( $ctrlbar_style )
            $ctrlbar_style = " style=\"$ctrlbar_style\"";

        $vars = array(
            'DISPLAY'       => $display,
            'STARTHEIGHT'   => $startHeight,
            'COLOR'         => $color,
            'BORDER'        => $border,
            'CTRLBAR_STYLE' => $ctrlbar_style,
            'CTRL_TEXT'     => $ctrl_text,
            'CONTENT'       => $content,
        );

        print( $this->generateComponentSectionCode( 'expandpanel', $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpJSProperties();

            print( "</script>\r\n" );
        }
    }
    /*
    function dumpForAjax()
    {
        $this->dumpJSProperties();

        print( "JTSetExpandPanelState( '" . $this->Name . "', '" . $this->_PanelState . "' );\r\n" );

        $this->dumpChildrenForAjax();
    }
    */
    protected function dumpJSProperties()
    {
        echo( "window." . $this->Name . " = document.getElementById( '" . $this->Name . "' );\r\n" );
        print( "document.getElementById( '" . $this->Name . "' ).ShowText = \"" . $this->_ShowText . "\";\r\n" );
        print( "document.getElementById( '" . $this->Name . "' ).HideText = \"" . $this->_HideText . "\";\r\n" );
        print( "document.getElementById( '" . $this->Name . "' ).PanelState = \"" . $this->_PanelState . "\";\r\n" );
        print( "document.getElementById( '" . $this->Name . "' ).OnChange = " . GetJTJSEventToString( $this->_jsOnChange ) . ";\r\n" );
        print( "document.getElementById( '" . $this->Name . "' ).NextControl = \"" . ( ( $this->_NextControl ) ? $this->_NextControl->Name : '' ) . "\";\r\n" );
        echo( $this->Name . ".origHeight = '" . ( ( $this->_DumpDimensions ) ? ( $this->Height . 'px' ) : '100%' ) . "';\r\n" );
    }

    function getInclude()
    {
        return $this->readInclude();
    }

    function setInclude( $value )
    {
        $this->writeInclude($value);
    }

    function getPanelState()
    {
        return $this->_PanelState;
    }

    function setPanelState( $value )
    {
        $this->_PanelState = $value;
    }

    function defaultPanelState()
    {
        return 'psVisible';
    }

    function getShowText()
    {
        return $this->_ShowText;
    }

    function setShowText( $value )
    {
        $this->_ShowText = $value;
    }

    function defaultShowText()
    {
        return 'Show';
    }

    function getHideText()
    {
        return $this->_HideText;
    }

    function setHideText( $value )
    {
        $this->_HideText = $value;
    }

    function defaultHideText()
    {
        return 'Hide';
    }

    function getColor()
    {
        return $this->readColor();
    }

    function setColor( $value )
    {
        $this->writeColor( $value );
    }

    function getControlBar()
    {
        return $this->_ControlBar;
    }

    function setControlBar( $value )
    {
        if( is_object( $value ) )
            $this->_ControlBar = $value;
    }

    function getBorderStyle()
    {
        return $this->_BorderStyle;
    }

    function setBorderStyle( $value )
    {
        $this->_BorderStyle = $value;
    }

    function defaultBorderStyle()
    {
        return '';
    }

    function getBorderSize()
    {
        return $this->_BorderSize;
    }

    function setBorderSize( $value )
    {
        $this->_BorderSize = $value;
    }

    function defaultBorderSize()
    {
        return '';
    }

    function getBorderColor()
    {
        return $this->_BorderColor;
    }

    function setBorderColor( $value )
    {
        $this->_BorderColor = $value;
    }

    function defaultBorderColor()
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

    function getNextControl()
    {
        return $this->_NextControl;
    }

    function setNextControl( $value )
    {
        $this->_NextControl = $this->fixupPropertyAndCheck( $value, 'Control' );
    }

    function defaultNextControl()
    {
        return null;
    }

    function getParentColor()
    {
        return $this->readParentColor();
    }

    function setParentColor( $value )
    {
        $this->writeParentColor( $value );
    }

    function getjsOnChange()
    {
        return $this->_jsOnChange;
    }

    function setjsOnChange( $value )
    {
        $this->_jsOnChange = $value;
    }

    function defaultjsOnChange()
    {
        return null;
    }
}

class JTExpandPanelControlBar extends Persistent
{
    protected $_BorderStyle = '';
    protected $_BorderSize = '';
    protected $_BorderColor = '';
    protected $_Color = '';
    protected $_Height = '';

    protected $_Owner = null;

    function __construct( $aowner )
    {
        parent::__construct();

        $this->_Owner = $aowner;
    }

    function readOwner()
    {
        return $this->_Owner;
    }

    function readCSS()
    {
        $style = '';

        if( $this->_BorderStyle && $this->_BorderSize )
        {
            $style .= ' border: ' . $this->_BorderStyle . ' ' . $this->_BorderSize;

            if( $this->_BorderColor )
                $style .= ' ' . $this->_BorderColor;

            $style .= ';';
        }

        if( $this->_Color )
            $style .= ' background-color: ' . $this->_Color . ';';

        if( strlen( $this->Height ) )
            $style .= ' height: ' . $this->Height . ';';

        $style = trim( $style );

        if( $style )
            return $style;
        else
            return '';
    }

    function getBorderStyle()
    {
        return $this->_BorderStyle;
    }

    function setBorderStyle( $value )
    {
        $this->_BorderStyle = $value;
    }

    function defaultBorderStyle()
    {
        return '';
    }

    function getBorderSize()
    {
        return $this->_BorderSize;
    }

    function setBorderSize( $value )
    {
        $this->_BorderSize = $value;
    }

    function defaultBorderSize()
    {
        return '';
    }

    function getBorderColor()
    {
        return $this->_BorderColor;
    }

    function setBorderColor( $value )
    {
        $this->_BorderColor = $value;
    }

    function defaultBorderColor()
    {
        return '';
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

    function getHeight()
    {
        return $this->_Height;
    }

    function setHeight( $value )
    {
        $this->_Height = $value;
    }

    function defaultHeight()
    {
        return '';
    }
}
?>
