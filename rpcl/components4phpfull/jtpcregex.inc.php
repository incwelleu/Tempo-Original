<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//            -- Perl-compatible regular expression component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "classes.inc.php" );

class JTPCRegEx extends Component
{
    protected $_Expression = '';
    protected $_InputString = '';
    protected $_Matches = array();

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function Match()
    {
        return preg_match( $this->_Expression, $this->_InputString, $this->_Matches );
    }

    function MatchAll()
    {
        return preg_match_all( $this->_Expression, $this->_InputString, $this->_Matches, PREG_SET_ORDER );
    }

    function Replace( $replaceString )
    {
        return preg_replace( $this->_Expression, $replaceString, $this->_InputString );
    }

    function Split()
    {
        $this->_Matches = preg_split( $this->_Expression, $this->_InputString );

        return $this->_Matches;
    }

    function getExpression()
    {
        return $this->_Expression;
    }

    function setExpression( $value )
    {
        $this->_Expression = $value;
    }

    function defaultExpression()
    {
        return '';
    }

    function getInputString()
    {
        return $this->_InputString;
    }

    function setInputString( $value )
    {
        $this->_InputString = $value;
    }

    function defaultInputString()
    {
        return '';
    }

    function readMatches()
    {
        return $this->_Matches;
    }

    function writeMatches( $value )
    {
        $this->_Matches = $value;
    }
}
?>
