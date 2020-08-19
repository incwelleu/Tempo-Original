<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- User registration component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTAuthRegistration extends JTThemedGraphicControl
{
    protected $_datasource = null;
    protected $_Fields = array();
    protected $_FieldValues = array();
    protected $_Registered = false;
    protected $_RegistrationAttempted = false;
    protected $_RequiredText = 'Required';

    protected $_ontryregistration = null;
    protected $_onregistered = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 700;
        $this->Height = 500;
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
            $this->populateFieldValues();
            $this->attemptUserRegistration();
        }
    }

    function init()
    {
        parent::init();

        if( $this->_onregistered && $this->_Registered )
            $this->callEvent( 'onregistered', array( $this->_FieldValues ) );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'authreg' ) );
    }

    protected function dumpThemedContents()
    {
        if( !$this->_Registered )
        {
            $required_string = $this->_RequiredText;

            $contents = '';

            if( $this->_RegistrationAttempted && !$this->_Registered )
                $contents .= $this->generateComponentSectionCode( 'regfailed', array() );

            foreach( $this->_Fields as $field )
            {
                list( $name, $caption, $type, $required, $validation, $data, $settings ) = $field;

                if( count( $field ) > 7 )
                    $msg = $field[ 7 ];
                else
                    $msg = '';

                if( isset( $this->_FieldValues[ $name ] ) )
                    $value = $this->_FieldValues[ $name ];
                else
                    $value = '';

                if( $type == 'Select' )
                {
                    $options = $data;
                    $item_contents = '';

                    foreach( $options as $option )
                    {
                        if( $option == $value )
                            $item_contents .= "<option selected=\"selected\">$option</option>\r\n";
                        else
                            $item_contents .= "<option>$option</option>\r\n";
                    }
                }
                else
                {
                    $item_contents = $data;
                    if( strlen( $value ) )
                        $item_contents = $value;
                }

                $vars = array(
                    'FIELDNAME'     => $this->Name . '_' . $name,
                    'CAPTION'       => $caption,
                    'REQUIRED'      => ( $required ? $required_string : '' ),
                    'CONTENT'       => $item_contents,
                    'MESSAGE'       => $msg,
                );

                if( $type == 'Edit' || $type == 'Password' )
                {
                    $vars[ 'SIZE' ] = $settings[ 0 ];
                    $vars[ 'MAXLENGTH' ] = $settings[ 1 ];
                }

                $contents .= $this->generateComponentSectionCode( $type, $vars );
            }

            $vars = array(
                'CONTENT'      => $contents,
            );

            print( $this->generateComponentSectionCode( 'authform', $vars ) );
        }
        else
        {
            print( $this->generateComponentSectionCode( 'regsuccess', array() ) );
        }
    }

    protected function populateFieldValues()
    {
        foreach( $this->_Fields as $field )
        {
            $name = $field[ 0 ];

            $fieldname = $this->Name . '_' . $name;

            $submitted = $this->input->{$fieldname};
            if( is_object( $submitted ) )
                $this->_FieldValues[ $name ] = $submitted->asString();
        }
    }

    protected function attemptUserRegistration()
    {
        if( $this->_RegistrationAttempted || !$this->_datasource )
            return;

        $this->_RegistrationAttempted = true;

        if( !$this->verifyFields() )
            return;

        if( $this->_ontryregistration && !$this->callEvent( 'ontryregistration', array( $this->_FieldValues ) ) )
            return;

        $this->_datasource->DataSet->Append();

        foreach( $this->_FieldValues as $n => $v )
            $this->_datasource->DataSet->$n = $v;

        $this->_datasource->DataSet->Post();

        $this->_Registered = true;
    }

    protected function verifyFields()
    {
        $this->resolveSiteThemeInstance();

        $ok = true;

        foreach( $this->_Fields as &$field )
        {
            list( $name, $caption, $type, $required, $validation, $data, $settings ) = $field;

            $fieldname = $this->Name . '_' . $name;
            $msg = '';

            $submitted = $this->input->{$fieldname};
            if( is_object( $submitted ) )
            {
                $value = $submitted->asString();

                // print( "<!-- $fieldname submitted, value = '$value' -->\r\n" );

                if( $type == 'Select' )
                {
                    $options = $data;
                    $tok = false;
                    $msg = $this->SiteThemeInstance->retrieveString( 'ValueNotAvailable' );

                    // print( "<!-- type is select -->\r\n" );

                    foreach( $options as $option )
                    {
                        if( $value == $option )
                        {
                            $tok = true;
                            break;
                        }
                    }

                    if( $ok && !$tok )
                        $ok = false;

                    // print( "<!-- tok = $tok -->\r\n" );
                }
                else
                {
                    if( strlen( $value ) || !$required )
                    {
                        // print( "<!-- validating against '$validation' -->\r\n" );

                        if( $validation && !preg_match( $validation, $value ) )
                        {
                           $ok = false;
                           $msg = $this->SiteThemeInstance->retrieveString( 'ValueDoesNotMatchRequired' );
                        }
                    }
                    else
                    {
                        $ok = false;
                        $msg = $this->SiteThemeInstance->retrieveString( 'ValueRequired' );
                    }
                }
            }
            else if( $required )
            {
                $ok = false;
                $msg = $this->SiteThemeInstance->retrieveString( 'RequiredField' );
            }

            if( !$ok )
            {
                if( count( $field ) < 8 )
                    array_push( $field, $msg );
                else
                    $field[ 7 ] = $msg;

                // print( "<!-- $fieldname is not a valid field - reason: $msg -->\r\n" );
            }
        }

        return $ok;
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getFields()
    {
        return $this->_Fields;
    }

    function setFields( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$field )
        {
            if( !is_array( $field ) )
                $field = unserialize( $field );

            $type = $field[ 2 ];

            if( $type == 'Edit' || $type == 'Password' )
            {
                if( !is_array( $field[ 6 ] ) )
                    $field[ 6 ] = unserialize( $field[ 6 ] );
            }
            else if( $type == 'Select' )
            {
                if( !is_array( $field[ 5 ] ) )
                    $field[ 5 ] = unserialize( $field[ 5 ] );
            }
        }

        $this->_Fields = $value;
    }

    function readFieldValues()
    {
        return $this->_FieldValues;
    }

    function readRegistered()
    {
        return $this->_Registered;
    }

    function getRequiredText()
    {
        return $this->_RequiredText;
    }

    function setRequiredText( $value )
    {
        $this->_RequiredText = $value;
    }

    function defaultRequiredText()
    {
        return 'Required';
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

    function getOnTryRegistration()
    {
        return $this->_ontryregistration;
    }

    function setOnTryRegistration( $value )
    {
        $this->_ontryregistration = $value;
    }

    function getOnRegistered()
    {
        return $this->_onregistered;
    }

    function setOnRegistered( $value )
    {
        $this->_onregistered = $value;
    }
}
?>
