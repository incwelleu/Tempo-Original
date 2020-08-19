<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- User login component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );
use_unit( "dbtables.inc.php" );

class JTUserLogin extends Component
{
    const Cookie = 'Cookie';
    const Form = 'Form';

    const HashCustom = 'Custom';
    const HashMD5 = 'MD5';
    const HashNone = 'None';
    const HashSHA256 = 'SHA256';
    const HashSHA512 = 'SHA512';

    protected $_Database;
    protected $_UserTable = '';
    protected $_UserNameField = 'UserName';
    protected $_PasswordField = 'Password';
    protected $_LoginIDField = 'LoginID';
    protected $_Hash = self::HashNone;
    protected $_CookieName = 'loginid';
    protected $_CookieExpirySeconds = 0;
    protected $_LoginType = self::Cookie;
    protected $_oncustomhash = null;
    protected $_onlogin = null;
    protected $_onloggedout = null;

    protected $_LoggedInUser = false;
    protected $_HasCheckedLogin = false;
    protected $_CookieValue = false;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatabase( $this->_Database );
    }

    function init()
    {
        $this->checkIfLoggedIn();
    }

    function dumpFormItems()
    {
        if( $this->_LoginType == self::Form )
        {
            $cookieValue = $this->loadCookieValue();

            echo( "<input type=\"hidden\" name=\"{$this->Name}Login\" value=\"$cookieValue\" />\r\n" );
        }
    }

    // User called functions.
    function LoginUser( $username, $password )
    {
        $this->validateProperties();

        $password = $this->hashPassword( $password );

        if( !$this->attemptLogin( $username, $password ) )
            return false;

        $this->createLoginID( $username, $password );

        return true;
    }

    function LogoutUser()
    {
        $this->validateProperties();

        $loginid = $this->loadCookieValue();
        $loginIDParam = $this->_Database->Param( $this->_LoginIDField );

        if( $loginIDParam == '?' )
            $params = array( $loginid );
        else
            $params = array( $this->_LoginIDField => $loginid );

        $this->Database->execute(
            "UPDATE {$this->_UserTable}
                SET
                    {$this->_LoginIDField} = ''
                WHERE
                    {$this->_LoginIDField} = $loginIDParam", $params );

        if( $this->_LoginType == self::Cookie )
        {
            setcookie( $this->_CookieName, '', time() - 3600 );
            unset( $_SESSION[ "JTUserLogin_{$this->_CookieName}" ] );
        }

        $userName = $this->_LoggedInUser;

        $this->_CookieValue = false;
        $this->_LoggedInUser = false;

        if( $this->_onloggedout )
            $this->callEvent( 'onloggedout', array( $username ) );

        return true;
    }

    protected function attemptLogin( $username, $password )
    {
        if( $this->_onlogin )
            return $this->callEvent( 'onlogin', array( $username, $password ) );

        $query = new Query();
        $query->Database = $this->_Database;
        $query->LimitStart = '-1';
        $query->LimitCount = '-1';

        $userParam = $this->_Database->Param( $this->_UserNameField );
        $passwordParam = $this->_Database->Param( $this->_PasswordField );

        $query->SQL =
            "SELECT *
                FROM {$this->_UserTable}
                WHERE
                    {$this->_UserNameField} = $userParam AND
                    {$this->_PasswordField} = $passwordParam";

        if( $userParam == '?' )
        {
            $query->Params = array(
                $username,
                $password
            );
        }
        else
        {
            $query->Params = array(
                $userParam => $username,
                $passwordParam => $password
            );
        }

        $query->Open();

        $result = ( $query->RecordCount > 0 );

        $query->Close();

        return $result;
    }

    protected function checkIfLoggedIn()
    {
        if( $this->_HasCheckedLogin )
            return;

        $this->_HasCheckedLogin = true;
        $this->_LoggedInUser = false;

        if( ( $this->ControlState & csDesigning ) == csLoading || ( $this->ControlState & csDesigning ) == csDesigning )
            return;

        $loginid = $this->loadCookieValue();

        if( empty( $loginid ) )
            return;

        $this->validateProperties();

        $loginIDParam = $this->_Database->Param( $this->_LoginIDField );

        $query = new Query();
        $query->Database = $this->_Database;
        $query->LimitStart = -1;
        $query->LimitCount = -1;

        $query->SQL =
            "SELECT {$this->_UserNameField}
                FROM {$this->_UserTable}
                WHERE
                    {$this->_LoginIDField} = $loginIDParam";

        if( $loginIDParam == '?' )
            $query->Params = array( $loginid );
        else
            $query->Params = array( $this->_LoginIDField => $loginid );

        $query->Open();
        $query->First();

        if( !$query->EOF )
            $this->_LoggedInUser = $query->Fields[ $this->_UserNameField ];

        $query->Close();
    }

    protected function createLoginID( $username, $password )
    {
        $loginid = md5( uniqid( rand(), true ) . time() );

        $loginIDParam = $this->_Database->Param( $this->_LoginIDField );
        $userParam = $this->_Database->Param( $this->_UserNameField );
        $passwordParam = $this->_Database->Param( $this->_PasswordField );

        if( $userParam == '?' )
        {
            $parameters = array(
                $loginid,
                $username,
                $password
            );
        }
        else
        {
            $parameters = array(
                $loginIDParam => $loginid,
                $userParam => $username,
                $passwordParam => $password
            );
        }

        $this->Database->execute(
            "UPDATE {$this->_UserTable}
                SET
                    {$this->_LoginIDField} = $loginIDParam
                WHERE
                    {$this->_UserNameField} = $userParam AND
                    {$this->_PasswordField} = $passwordParam",
            $parameters );

        if( $this->_LoginType == self::Cookie )
        {
            if( $this->_CookieExpirySeconds == 0 )
                $cookietime = 0;
            else
                $cookietime = time() + $this->_CookieExpirySeconds;

            setcookie( $this->_CookieName, $loginid, $cookietime );

            $_SESSION[ "JTUserLogin_{$this->_CookieName}" ] = $loginid;
        }

        $this->_CookieValue = $loginid;
    }

    protected function hashPassword( $password )
    {
        switch( $this->_Hash )
        {
            case self::HashCustom:
                return $this->callEvent( 'oncustomhash', array( $password ) );

            case self::HashMD5:
                return md5( $password );

            case self::HashNone:
                return $password;

            case self::HashSHA256:
                return hash( "sha256", $password );

            case self::HashSHA512:
                return hash( "sha512", $password );

            default:
                throw new Exception( "Hash type '{$this->_Hash}' is not supported." );
        }
    }

    protected function loadCookieValue()
    {
        if( $this->_CookieValue === false )
        {
            if( $this->_LoginType == self::Cookie )
            {
                if( array_key_exists( $this->_CookieName, $_COOKIE ) )
                {
                    $this->_CookieValue = $_COOKIE[ $this->_CookieName ];
                }
                else if( array_key_exists( "JTUserLogin_{$this->_CookieName}", $_SESSION ) )
                {
                    $this->_CookieValue = $_SESSION[ "JTUserLogin_{$this->_CookieName}" ];
                }
                else
                {
                    $this->_CookieValue = '';
                }
            }
            else
            {
                $obj = $this->input->{$this->_name . 'Login'};
                if( is_object( $obj ) )
                    $this->_CookieValue = $obj->asString();
                else
                    $this->_CookieValue = '';
            }
        }

        return $this->_CookieValue;
    }

    protected function validateProperties()
    {
        if( !$this->_Database )
            throw new Exception( 'Database property not assigned for ' . $this->Name );

        if( !strlen( $this->_UserTable ) || !preg_match( '/^[a-z0-9_]{1,}$/i', $this->_UserTable ) )
            throw new Exception( 'UserTable property not assigned for '  . $this->Name );

        if( !strlen( $this->_UserNameField ) || !preg_match( '/^[a-z0-9_]{1,}$/i', $this->_UserNameField )  )
            throw new Exception( 'UserNameField property not assigned for '  . $this->Name );

        if( !strlen( $this->_PasswordField ) || !preg_match( '/^[a-z0-9_]{1,}$/i', $this->_PasswordField )  )
            throw new Exception( 'PasswordField property not assigned for '  . $this->Name );

        if( !strlen( $this->_LoginIDField ) || !preg_match( '/^[a-z0-9_]{1,}$/i', $this->_LoginIDField )  )
            throw new Exception( 'LoginID property not assigned for '  . $this->Name );
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

    function getCookieExpirySeconds()
    {
        return $this->_CookieExpirySeconds;
    }

    function setCookieExpirySeconds( $value )
    {
        $this->_CookieExpirySeconds = $value;
    }

    function defaultCookieExpirySeconds()
    {
        return '0';
    }

    function getCookieName()
    {
        return $this->_CookieName;
    }

    function setCookieName( $value )
    {
        $this->_CookieName = $value;
    }

    function defaultCookieName()
    {
        return 'loginid';
    }

    function getDatabase()
    {
        return $this->_Database;
    }

    function setDatabase( $value )
    {
        $this->_Database = $this->fixupPropertyAndCheck( $value, 'Database' );
    }

    function getHash()
    {
        return $this->_Hash;
    }

    function setHash( $value )
    {
        $this->_Hash = $value;
    }

    function defaultHash()
    {
        return self::HashNone;
    }

    function getLoginIDField()
    {
        return $this->_LoginIDField;
    }

    function setLoginIDField( $value )
    {
        $this->_LoginIDField = $value;
    }

    function defaultLoginIDField()
    {
        return 'LoginID';
    }

    function getLoginType()
    {
        return $this->_LoginType;
    }

    function setLoginType( $value )
    {
        if( $value == self::Cookie || $value == self::Form )
            $this->_LoginType = $value;
    }

    function defaultLoginType()
    {
        return self::Cookie;
    }

    function getLoggedInUser()
    {
        $this->checkIfLoggedIn();

        return $this->_LoggedInUser;
    }

    function getPasswordField()
    {
        return $this->_PasswordField;
    }

    function setPasswordField( $value )
    {
        $this->_PasswordField = $value;
    }

    function defaultPasswordField()
    {
        return 'Password';
    }

    function getUserNameField()
    {
        return $this->_UserNameField;
    }

    function setUserNameField( $value )
    {
        $this->_UserNameField = $value;
    }

    function defaultUserNameField()
    {
        return 'UserName';
    }

    function getUserTable()
    {
        return $this->_UserTable;
    }

    function setUserTable( $value )
    {
        $this->_UserTable = $value;
    }

    function defaultUserTable()
    {
        return '';
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

    function getOnCustomHash()
    {
        return $this->_oncustomhash;
    }

    function setOnCustomHash( $value )
    {
        $this->_oncustomhash = $value;
    }

    function getOnLogin()
    {
        return $this->_onlogin;
    }

    function setOnLogin( $value )
    {
        $this->_onlogin = $value;
    }

    function getOnLoggedOut()
    {
        return $this->_onloggedout;
    }

    function setOnLoggedOut( $value )
    {
        $this->_onloggedout = $value;
    }
}
?>
