<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- Input validation component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( 'components4phpfull/jtsitetheme.inc.php' );

define( 'itAnything', 'itAnything' );
define( 'itNumeric', 'itNumeric' );

class JTInputValidator extends Component
{
    private $SiteTheme;
    protected $SiteThemeInstance;

    protected $_CanBeEmpty = true;
    protected $_Control = null;
    protected $_EscapeHTML = 0;
    protected $_RegularExpression = '';
    protected $_RemoveTags = 0;
    protected $_Type = itAnything;
    protected $_Valid = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function loaded()
    {
        parent::loaded();

        $this->_Valid = false;

        if( $this->_Control )
        {
            if( isset( $_POST[ $this->_Control->Name ] ) )
            {
                $str = $_POST[ $this->_Control->Name ];

                $this->_Valid = $this->Validate( $str );
            }
        }
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( !$this->initializeSkin( $error ) )
        {
            echo( "// $error\r\n" );
            return;
        }

        $jscode = 'JTInputValidatorInitialize( "' . $this->Name . '", ' . GetJTJSBoolean( $this->_CanBeEmpty ) . ', "' . ( $this->_Control ? $this->_Control->Name : '' ) . '", ' . GetJTJSBoolean( $this->_EscapeHTML ) . ', "' . $this->_RegularExpression . '", ' . GetJTJSBoolean( $this->_RemoveTags ) . ', "' . $this->_Type . "\" );\r\n";

        $this->SiteThemeInstance->addAfterSiteThemeJS( $jscode );
    }

    function Validate( $str )
    {
        if( strlen( $str ) == 0 )
            return ( $this->_CanBeEmpty );

        if( $this->_RemoveTags )
            $str = strip_tags( $str );

        if( $this->_EscapeHTML )
            $str = htmlentities( $str );

        if( $this->_RemoveTags || $this->_EscapeHTML )
            $this->updateInputValue( $str );

        if( $this->_Type == itNumeric && !is_numeric( $str ) )
            return false;

        if( $this->_RegularExpression && !preg_match( $this->_RegularExpression, $str ) )
            return false;

        return true;
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

    protected function updateInputValue( $str )
    {
        if( $this->_Control )
        {
            $name = $this->_Control->Name;

            if( isset( $_GET[ $name ] ) )
                $_GET[ $name ] = $str;

            if( isset( $_POST[ $name ] ) )
                $_POST[ $name ] = $str;

            if( isset( $_REQUEST[ $name ] ) )
                $_REQUEST[ $name ] = $str;
        }
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

    function getCanBeEmpty()
    {
        return $this->_CanBeEmpty;
    }

    function setCanBeEmpty( $value )
    {
        $this->_CanBeEmpty = $value;
    }

    function defaultCanBeEmpty()
    {
        return true;
    }

    function getControl()
    {
        return $this->_Control;
    }

    function setControl( $value )
    {
        $this->_Control = $this->fixupPropertyAndCheck( $value, 'Control' );
    }

    function defaultControl()
    {
        return null;
    }

    function getEscapeHTML()
    {
        return $this->_EscapeHTML;
    }

    function setEscapeHTML( $value )
    {
        $this->_EscapeHTML = $value;
    }

    function defaultEscapeHTML()
    {
        return 0;
    }

    function getRegularExpression()
    {
        return $this->_RegularExpression;
    }

    function setRegularExpression( $value )
    {
        $this->_RegularExpression = $value;
    }

    function defaultRegularExpression()
    {
        return '';
    }

    function getRemoveTags()
    {
        return $this->_RemoveTags;
    }

    function setRemoveTags( $value )
    {
        $this->_RemoveTags = $value;
    }

    function defaultRemoveTags()
    {
        return 0;
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
        return itAnything;
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

    function readValid()
    {
        return $this->_Valid;
    }
}
?>
