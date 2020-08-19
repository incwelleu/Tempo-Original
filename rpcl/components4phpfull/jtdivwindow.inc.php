<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                  -- Div layer-based window component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once( "vcl/vcl.inc.php" );

use_unit( "rtl.inc.php" );
use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTDivWindow extends JTThemedCustomPanel
{
    protected $_AutoScroll = 0;
    protected $_BorderIcons;
    protected $_BorderStyle = 'bsSizeable';
    protected $_Position = 'poDesigned';
    protected $_Visible = 0;
    protected $_Modal = 0;

    protected $_jsOnShow = null;
    protected $_jsOnHide = null;
    protected $_jsOnResize = null;
    protected $_jsOnHelp = null;
    protected $_jsOnMove = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 320;
        $this->Height = 240;
        $this->ControlStyle = "csAcceptsControls=1";
        $this->_Anchors->Relative = false;

        $this->_BorderIcons = new JTDivWindowBorderIcons( $this );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'divwindow' ) );

            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                if( $this->SiteThemeInstance->owner )
                    $oname = $this->SiteThemeInstance->owner->Name;

                $this->SiteThemeInstance->addComponentJSCode( get_class( $this ) );
            }
        }
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_jsOnShow )
        {
            $event = $this->_jsOnShow;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnHide )
        {
            $event = $this->_jsOnHide;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnResize )
        {
            $event = $this->_jsOnResize;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnHelp )
        {
            $event = $this->_jsOnHelp;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnMove )
        {
            $event = $this->_jsOnMove;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function dumpThemedContainerContents( $content )
    {
        // Build window titlebar.
        $titlebar = '';

        if( $this->_BorderStyle != 'bsNone' )
        {
            if( $this->_BorderIcons->Close )
                $titlebar .= $this->generateComponentSectionCode( 'titlebar_button', array( 'BORDERSTYLE' => $this->_BorderStyle, 'BUTTON' => 'close', 'BUTTONTEXT' => 'X' ) );

            if( $this->_BorderIcons->Maximize )
                $titlebar .= $this->generateComponentSectionCode( 'titlebar_button', array( 'BORDERSTYLE' => $this->_BorderStyle, 'BUTTON' => 'maximize', 'BUTTONTEXT' => '+' ) );

            if( $this->_BorderIcons->Minimize )
                $titlebar .= $this->generateComponentSectionCode( 'titlebar_button', array( 'BORDERSTYLE' => $this->_BorderStyle, 'BUTTON' => 'minimize', 'BUTTONTEXT' => '_' ) );

            if( $this->_BorderIcons->Help )
                $titlebar .= $this->generateComponentSectionCode( 'titlebar_button', array( 'BORDERSTYLE' => $this->_BorderStyle, 'BUTTON' => 'help', 'BUTTONTEXT' => '?' ) );

            $vars = array(
                'BORDERSTYLE'   => $this->_BorderStyle,
                'BUTTONS'       => $titlebar,
                'CAPTION'       => $this->Caption,
            );

            $titlebar = $this->generateComponentSectionCode( 'titlebar', $vars );
        }

        $vars = array(
            'BORDERSTYLE'       => $this->_BorderStyle,
            'CONTENT'           => $content,
            'DESIGNDISPLAY'     => ( ( $this->ControlState & csDesigning ) == csDesigning ? 'block' : 'none' ),
            'DESIGNVISIBLE'     => ( ( $this->ControlState & csDesigning ) == csDesigning ? 'visible' : 'hidden' ),
            'SCROLL'            => ( $this->_AutoScroll ? 'auto' : 'hidden' ),
            'TITLEBAR'          => $titlebar,
        );

        $this->_DumpDimensions = true;

        print( $this->generateComponentSectionCode( 'window', $vars ) );
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
        print( 'JTDivWindowInitialize( "' . $this->Name . '", "' . $this->_Position . '", "' . $this->_BorderStyle . '", ' . GetJTJSBoolean( $this->_Visible ) . ', ' . GetJTJSBoolean( $this->_Modal ) . " );\r\n" );

        print( 'document.getElementById( "' . $this->Name . '" ).OnShow = ' . GetJTJSEventToString( $this->_jsOnShow ) . ";\r\n" );
        print( 'document.getElementById( "' . $this->Name . '" ).OnHide = ' . GetJTJSEventToString( $this->_jsOnHide ) . ";\r\n" );
        print( 'document.getElementById( "' . $this->Name . '" ).OnResize = ' . GetJTJSEventToString( $this->_jsOnResize ) . ";\r\n" );
        print( 'document.getElementById( "' . $this->Name . '" ).OnHelp = ' . GetJTJSEventToString( $this->_jsOnHelp ) . ";\r\n" );
        print( 'document.getElementById( "' . $this->Name . '" ).OnMove = ' . GetJTJSEventToString( $this->_jsOnMove ) . ";\r\n" );
    }

    function dumpForAjax()
    {
        // $this->dumpBodyJavaScript();
        /*
        if( $this->_Visible )
        {
            if( $this->_Modal )
                print( 'document.getElementById( "' . $this->Name . "\" ).ShowModal();\r\n" );
            else
                print( 'document.getElementById( "' . $this->Name . "\" ).Show();\r\n" );
        }
        else
        {
            print( 'document.getElementById( "' . $this->Name . "\" ).Hide();\r\n" );
        }
        */

        if( !defined( 'JT_STANDALONE' ) )
        {
            $this->dumpChildrenForAjax();
        }
        else
        {
            if( !$this->initializeSkin( $error ) )
                return;

            $this->callEvent( 'onshow', array() );

            ob_start();

            $this->internalDumpThemedContents();

            $contents = ob_get_clean();

            ob_start();

            $this->dumpBodyJavaScript();

            $jsCode = ob_get_clean();

            $jsCodeArray = extractjscript( $contents );
            $jsCode .= $jsCodeArray[ 0 ];

            return array( $contents, $jsCode );
        }
    }

    function readDropZone()
    {
        if( $this->_BorderStyle == 'bsNone' )
            return explode( ',', $this->retrieveSetting( 'BorderLessDropZone' ), 2 );
        else
            return parent::readDropZone();
    }

    function ShowWindow()
    {
        $this->_Visible = true;
        $this->_Modal = false;
    }

    function ShowModal()
    {
        $this->_Visible = true;
        $this->_Modal = true;
    }

    function Hide()
    {
        $this->_Visible = false;
        $this->_Modal = false;
    }

    function getAutoScroll()
    {
        return $this->_AutoScroll;
    }

    function setAutoScroll( $value )
    {
        $this->_AutoScroll = $value;
    }

    function defaultAutoScroll()
    {
        return 0;
    }

    function getBorderIcons()
    {
        return $this->_BorderIcons;
    }

    function setBorderIcons( $value )
    {
        if( is_object( $value ) )
            $this->_BorderIcons = $value;
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
        return 'bsSizeable';
    }

    function getCaption()
    {
        return $this->readCaption();
    }

    function setCaption( $value )
    {
        $this->writeCaption( $value );
    }

    function getInclude()
    {
        return $this->readInclude();
    }

    function setInclude( $value )
    {
        $this->writeInclude($value);
    }

    function getPosition()
    {
        return $this->_Position;
    }

    function setPosition( $value )
    {
        $this->_Position = $value;
    }

    function defaultPosition()
    {
        return 'poDesigned';
    }

    function getStartVisible()
    {
        return $this->_Visible;
    }

    function setStartVisible( $value )
    {
        $this->_Visible = $value;
    }

    function defaultStartVisible()
    {
        return 0;
    }

    function getjsOnShow()
    {
        return $this->_jsOnShow;
    }

    function setjsOnShow( $value )
    {
        $this->_jsOnShow = $value;
    }

    function defaultjsOnShow()
    {
        return null;
    }

    function getjsOnHide()
    {
        return $this->_jsOnHide;
    }

    function setjsOnHide( $value )
    {
        $this->_jsOnHide = $value;
    }

    function defaultjsOnHide()
    {
        return null;
    }

    function getjsOnResize()
    {
        return $this->_jsOnResize;
    }

    function setjsOnResize( $value )
    {
        $this->_jsOnResize = $value;
    }

    function defaultjsOnResize()
    {
        return null;
    }

    function getjsOnHelp()
    {
        return $this->_jsOnHelp;
    }

    function setjsOnHelp( $value )
    {
        $this->_jsOnHelp = $value;
    }

    function defaultjsOnHelp()
    {
        return null;
    }

    function getjsOnMove()
    {
        return $this->_jsOnMove;
    }

    function setjsOnMove( $value )
    {
        $this->_jsOnMove = $value;
    }

    function defaultjsOnMove()
    {
        return null;
    }
}

class JTDivWindowBorderIcons extends Persistent
{
    protected $_Minimize = true;
    protected $_Maximize = true;
    protected $_Close = true;
    protected $_Help = true;

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

    function getMinimize()
    {
        return $this->_Minimize;
    }

    function setMinimize( $value )
    {
        $this->_Minimize = $value;
    }

    function defaultMinimize()
    {
        return true;
    }

    function getMaximize()
    {
        return $this->_Maximize;
    }

    function setMaximize( $value )
    {
        $this->_Maximize = $value;
    }

    function defaultMaximize()
    {
        return true;
    }

    function getClose()
    {
        return $this->_Close;
    }

    function setClose( $value )
    {
        $this->_Close = $value;
    }

    function defaultClose()
    {
        return true;
    }

    function getHelp()
    {
        return $this->_Help;
    }

    function setHelp( $value )
    {
        $this->_Help = $value;
    }

    function defaultHelp()
    {
        return true;
    }
}
?>