<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Send email component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "classes.inc.php" );

class JTSendEmail extends Component
{
    protected $_To = '';
    protected $_Cc = '';
    protected $_Bcc = '';
    protected $_From = '';
    protected $_Subject = '';
    protected $_Message = '';
    protected $_AdditionalHeaders = array();

    protected $_LastError;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function Send()
    {
        if( empty( $this->_To ) || empty( $this->_From ) || empty( $this->_Subject ) || empty( $this->_Message ) )
        {
            $this->_LastError = 'To, From, Subject or Message properties empty.';
            return false;
        }

        $headers = "From: " . $this->_From . "\r\n";

        if( $this->_Cc )
            $headers .= "Cc: " . $this->_Cc . "\r\n";

        if( $this->_Bcc )
            $headers .= "Bcc: " . $this->_Bcc . "\r\n";

        $headers .= implode( "\r\n", $this->_AdditionalHeaders ) . "\r\n";

        return mail( $this->_To, $this->_Subject, $this->_Message, $headers );
    }

    function getTo()
    {
        return $this->_To;
    }

    function setTo( $value )
    {
        $this->_To = $value;
    }

    function defaultTo()
    {
        return '';
    }

    function getCc()
    {
        return $this->_Cc;
    }

    function setCc( $value )
    {
        $this->_Cc = $value;
    }

    function defaultCc()
    {
        return '';
    }

    function getBcc()
    {
        return $this->_Bcc;
    }

    function setBcc( $value )
    {
        $this->_Bcc = $value;
    }

    function defaultBcc()
    {
        return '';
    }

    function getFrom()
    {
        return $this->_From;
    }

    function setFrom( $value )
    {
        $this->_From = $value;
    }

    function defaultFrom()
    {
        return '';
    }

    function getSubject()
    {
        return $this->_Subject;
    }

    function setSubject( $value )
    {
        $this->_Subject = $value;
    }

    function defaultSubject()
    {
        return '';
    }

    function getMessage()
    {
        return $this->_Message;
    }

    function setMessage( $value )
    {
        $this->_Message = $value;
    }

    function defaultMessage()
    {
        return '';
    }

    function getAdditionalHeaders()
    {
        return $this->_AdditionalHeaders;
    }

    function setAdditionalHeaders( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        $this->_AdditionalHeaders = $value;
    }

    function defaultAdditionalHeaders()
    {
        return array();
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

    function readLastError()
    {
        return $this->_LastError;
    }
}
?>