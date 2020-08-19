<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                -- JavaScript pop-up window component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( 'components4phpfull/jtsitetheme.inc.php' );

class JTJSWindow extends Component
{
    private $SiteTheme;
    protected $SiteThemeInstance;

    protected $_Height = '200';
    protected $_Left = '';
    protected $_Resizeable = true;
    protected $_ShowAddressBar = true;
    protected $_ShowMenuBar = true;
    protected $_ShowScrollbars = true;
    protected $_ShowStatusbar = true;
    protected $_ShowToolbar = true;
    protected $_Top = '';
    protected $_URL = '';
    protected $_Width = '400';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( !$this->initializeSkin( $error ) )
        {
            echo( "// $error\r\n" );
            return;
        }

        $params = ( $this->_Height != '' ) ? 'height=' . $this->_Height . ',' : '';
        $params .= ( $this->_Left != '' ) ? 'left=' . $this->_Left . ',' : '';
        $params .= 'location=' . ( $this->_ShowAddressBar ? '1' : '0' ) . ',';
        $params .= 'menubar=' . ( $this->_ShowMenuBar ? '1' : '0' ) . ',';
        $params .= 'resizable=' . ( $this->_Resizeable ? '1' : '0' ) . ',';
        $params .= 'scrollbars=' . ( $this->_ShowScrollbars ? '1' : '0' ) . ',';
        $params .= 'status=' . ( $this->_ShowStatusbar ? '1' : '0' ) . ',';
        $params .= 'toolbar=' . ( $this->_ShowToolbar ? '1' : '0' ) . ',';
        $params .= ( $this->_Top != '' ) ? 'top=' . $this->_Top . ',' : '';
        $params .= ( $this->_Width != '' ) ? 'width=' . $this->_Width . ',' : '';

        $jscode = 'JTJSWindowInitialize( "' . $this->Name . '", "' . $this->_URL . '", "' . $params . "\" );\r\n";

        $this->SiteThemeInstance->addAfterSiteThemeJS( $jscode );
    }

    protected function resolveSiteThemeInstance()
    {
        global $JTSiteThemeGlobalInstance;

        if( !$this->SiteThemeInstance && isset( $JTSiteThemeGlobalInstance ) )
            $this->SiteThemeInstance = $JTSiteThemeGlobalInstance;

        if( !$this->SiteThemeInstance )
            $this->SiteThemeInstance = $this->propertyToObject( $this->SiteTheme );
    }

    protected function propertyToObject( $value )
    {
        if( !empty( $value ) )
        {
            if( !is_object( $value ) )
            {
                $form = $this->owner;

                if( strpos( $value, '.' ) )
                {
                    $pieces = explode( '.', $value );
                    $form = $pieces[0];

                    global $$form;

                    $form = $$form;

                    $value = $pieces[1];
                }

                if( is_object( $form->$value ) )
                {
                    $value = $form->$value;
                }
            }
        }

        return $value;
    }

    protected function initializeSkin( &$error )
    {
        $error = '';

        $this->resolveSiteThemeInstance();

        if( !$this->SiteThemeInstance )
        {
            $error = JT_NO_SITETHEME_MESSAGE;
            return false;
        }

        return true;
    }

    function fixupPropertyAndCheck( $value, $type )
    {
        $result = $this->fixupProperty( $value );

        if( ( $this->ControlState & csDesigning ) != csDesigning && is_object( $result ) )
        {
            if( !$result->inheritsFrom( $type ) )
                throw new Exception( $this->Name . ' property type mismatch, expected ' . $type . ', received ' . get_class( $result ) );
        }

        return $result;
    }

    function getWindowHeight()
    {
        return $this->_Height;
    }

    function setWindowHeight( $value )
    {
        $this->_Height = $value;
    }

    function defaultWindowHeight()
    {
        return '200';
    }

    function getLeft()
    {
        return $this->_Left;
    }

    function setLeft( $value )
    {
        $this->_Left = $value;
    }

    function defaultLeft()
    {
        return '';
    }

    function getResizeable()
    {
        return $this->_Resizeable;
    }

    function setResizeable( $value )
    {
        $this->_Resizeable = $value;
    }

    function defaultResizeable()
    {
        return true;
    }

    function getShowAddressBar()
    {
        return $this->_ShowAddressBar;
    }

    function setShowAddressBar( $value )
    {
        $this->_ShowAddressBar = $value;
    }

    function defaultShowAddressBar()
    {
        return true;
    }

    function getShowMenuBar()
    {
        return $this->_ShowMenuBar;
    }

    function setShowMenuBar( $value )
    {
        $this->_ShowMenuBar = $value;
    }

    function defaultShowMenuBar()
    {
        return true;
    }

    function getShowScrollbars()
    {
        return $this->_ShowScrollbars;
    }

    function setShowScrollbars( $value )
    {
        $this->_ShowScrollbars = $value;
    }

    function defaultShowScrollbars()
    {
        return true;
    }

    function getShowStatusbar()
    {
        return $this->_ShowStatusbar;
    }

    function setShowStatusbar( $value )
    {
        $this->_ShowStatusbar = $value;
    }

    function defaultShowStatusbar()
    {
        return true;
    }

    function getShowToolbar()
    {
        return $this->_ShowToolbar;
    }

    function setShowToolbar( $value )
    {
        $this->_ShowToolbar = $value;
    }

    function defaultShowToolbar()
    {
        return true;
    }

    function getTop()
    {
        return $this->_Top;
    }

    function setTop( $value )
    {
        $this->_Top = $value;
    }

    function defaultTop()
    {
        return '';
    }

    function getURL()
    {
        return $this->_URL;
    }

    function setURL( $value )
    {
        $this->_URL = $value;
    }

    function defaultURL()
    {
        return '';
    }

    function getWindowWidth()
    {
        return $this->_Width;
    }

    function setWindowWidth( $value )
    {
        $this->_Width = $value;
    }

    function defaultWindowWidth()
    {
        return '400';
    }

    function getSiteTheme()
    {
        return $this->SiteTheme;
    }

    function setSiteTheme( $value )
    {
        $this->SiteTheme = $value;
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
}
?>
