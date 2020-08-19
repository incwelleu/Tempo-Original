<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- User login view component --
//
//            Copyright © JomiTech 2011. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTUserLoginView extends JTThemedGraphicControl
{
    protected $_LoginURL = '';
    protected $_LogoutURL = '';
    protected $_RegisterURL = '';
    protected $_ShowLogin = true;
    protected $_ShowLogout = true;
    protected $_ShowRegister = true;
    protected $_UserLogin = null;

    protected $_onloginclick;
    protected $_onlogoutclick;
    protected $_onregisterclick;
    protected $_ongetdisplayname;

    protected $_jsonloginclick;
    protected $_jsonlogoutclick;
    protected $_jsonregisterclick;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 240;
        $this->Height = 18;
    }

    function loaded()
    {
        parent::loaded();

        $this->setUserLogin( $this->UserLogin );
    }

    function init()
    {
        parent::init();

        $submitEventValue = $this->input->{$this->JSWrapperHiddenFieldName};
        if( is_object( $submitEventValue ) )
        {
            switch( $submitEventValue->asString() )
            {
                case "login":
                    $this->callEvent( 'onloginclick', array() );
                    break;

                case "logout":
                    $this->callEvent( 'onlogoutclick', array() );
                    break;

                case "register":
                    $this->callEvent( 'onregisterclick', array() );
                    break;
            }
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'userlogin' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        $this->dumpClickHandler( 'Login', $this->_jsonloginclick, $this->_onloginclick );
        $this->dumpClickHandler( 'Logout', $this->_jsonlogoutclick, $this->_onlogoutclick );
        $this->dumpClickHandler( 'Register', $this->_jsonregisterclick, $this->_onregisterclick );

        $this->dumpJSEvent( $this->_jsonloginclick );
        $this->dumpJSEvent( $this->_jsonlogoutclick );
        $this->dumpJSEvent( $this->_jsonregisterclick );
    }

    protected function dumpClickHandler( $eventName, $jsEvent, $phpEvent )
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "function {$this->Name}{$eventName}ClickHandler(e) {\r\n" );

            if( $jsEvent )
                print( "  if (" . $jsEvent . "(e) == false) { return false; }\r\n" );

            if( $phpEvent )
            {
                $form = "document." . $this->owner->Name;
                $value = strtolower( $eventName );

                print( "  $form.{$this->JSWrapperHiddenFieldName}.value = '$value';\r\n" );
                print( "  if ($form.onsubmit && typeof($form.onsubmit) == 'function') {\r\n" );
                print( "    $form.onsubmit();\r\n" );
                print( "  }\r\n" );
                print( "  $form.submit();\r\n" );
                print( "  return false;\r\n" );
            }

            print( "}\r\n" );
        }
    }

    protected function dumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " $style";

        if( $this->_UserLogin )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
                $user = $this->_UserLogin->LoggedInUser;
            else
                $user = false;

            $content = $this->dumpUserContents( $user, $style );
        }
        else
        {
            $content = "<span class=\"jtfont\" style=\"border: solid 1px red; color: red; font-size: 8pt; font-weight; bold; height: 100%; text-align: center; width: 100%;\">UserLogin property empty!</span>";
        }

        $vars = array
        (
            'CONTENT'   => $content,
            'STYLE'     => $style,
        );

        print( $this->generateComponentSectionCode( 'userloginview', $vars ) );

        print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
    }

    protected function dumpUserContents( $user, $style )
    {
        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;
        $content = '';

        if( $user !== false )
        {
            $displayName = $this->callEvent( 'ongetdisplayname', array( $user ) );

            if( empty( $displayName ) )
                $displayName = $user;

            $vars = array
            (
                'DISPLAYNAME'   => $displayName,
                'STYLE'         => $style,
                'USERNAME'      => $user,
                'TABINDEX'      => $tabindex,
            );

            $content .= $this->generateComponentSectionCode( 'loggedin', $vars );

            if( $this->_ShowLogout )
            {
                $vars[ 'TABINDEX' ] = $tabindex + 1;
                $vars[ 'URL' ] = ( $this->_LogoutURL ) ? $this->_LogoutURL : '#';

                $content .= $this->generateComponentSectionCode( 'logout', $vars );
            }
        }
        else
        {
            $vars = array
            (
                'STYLE'         => $style,
                'TABINDEX'      => $tabindex,
            );

            $content .= $this->generateComponentSectionCode( 'notloggedin', $vars );

            if( $this->_ShowLogin )
            {
                $vars[ 'URL' ] = ( $this->_LoginURL ) ? $this->_LoginURL : '#';

                $content .= $this->generateComponentSectionCode( 'login', $vars );
            }

            if( $this->_ShowRegister )
            {
                $vars[ 'TABINDEX' ] = $tabindex + 1;
                $vars[ 'URL' ] = ( $this->_RegisterURL ) ? $this->_RegisterURL : '#';

                $content .= $this->generateComponentSectionCode( 'register', $vars );
            }
        }

        return $content;
    }

    function getLoginURL()
    {
        return $this->_LoginURL;
    }

    function setLoginURL( $value )
    {
        $this->_LoginURL = $value;
    }

    function defaultLoginURL()
    {
        return '';
    }

    function getLogoutURL()
    {
        return $this->_LogoutURL;
    }

    function setLogoutURL( $value )
    {
        $this->_LogoutURL = $value;
    }

    function defaultLogoutURL()
    {
        return '';
    }

    function getRegisterURL()
    {
        return $this->_RegisterURL;
    }

    function setRegisterURL( $value )
    {
        $this->_RegisterURL = $value;
    }

    function defaultRegisterURL()
    {
        return '';
    }

    function getShowLogin()
    {
        return $this->_ShowLogin;
    }

    function setShowLogin( $value )
    {
        $this->_ShowLogin = $value;
    }

    function defaultShowLogin()
    {
        return true;
    }

    function getShowLogout()
    {
        return $this->_ShowLogout;
    }

    function setShowLogout( $value )
    {
        $this->_ShowLogout = $value;
    }

    function defaultShowLogout()
    {
        return true;
    }

    function getShowRegister()
    {
        return $this->_ShowRegister;
    }

    function setShowRegister( $value )
    {
        $this->_ShowRegister = $value;
    }

    function defaultShowRegister()
    {
        return true;
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getUserLogin()
    {
        return $this->_UserLogin;
    }

    function setUserLogin( $value )
    {
        $this->_UserLogin = $this->fixupPropertyAndCheck( $value, 'JTUserLogin' );
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

    function getOnGetDisplayName()
    {
        return $this->_ongetdisplayname;
    }

    function setOnGetDisplayName( $value )
    {
        $this->_ongetdisplayname = $value;
    }

    function defaultOnGetDisplayName()
    {
        return null;
    }

    function getOnLoginClick()
    {
        return $this->_onloginclick;
    }

    function setOnLoginClick( $value )
    {
        $this->_onloginclick = $value;
    }

    function defaultOnLoginClick()
    {
        return null;
    }

    function getOnLogoutClick()
    {
        return $this->_onlogoutclick;
    }

    function setOnLogoutClick( $value )
    {
        $this->_onlogoutclick = $value;
    }

    function defaultOnLogoutClick()
    {
        return null;
    }

    function getOnRegisterClick()
    {
        return $this->_onregisterclick;
    }

    function setOnRegisterClick( $value )
    {
        $this->_onregisterclick = $value;
    }

    function defaultOnRegisterClick()
    {
        return null;
    }

    function getjsOnLoginClick()
    {
        return $this->_jsonloginclick;
    }

    function setjsOnLoginClick( $value )
    {
        $this->_jsonloginclick = $value;
    }

    function defaultjsOnLoginClick()
    {
        return null;
    }

    function getjsOnLogoutClick()
    {
        return $this->_jsonlogoutclick;
    }

    function setjsOnLogoutClick( $value )
    {
        $this->_jsonlogoutclick = $value;
    }

    function defaultjsOnLogoutClick()
    {
        return null;
    }

    function getjsOnRegisterClick()
    {
        return $this->_jsonregisterclick;
    }

    function setjsOnRegisterClick( $value )
    {
        $this->_jsonregisterclick = $value;
    }

    function defaultjsOnRegisterClick()
    {
        return null;
    }
}
?>