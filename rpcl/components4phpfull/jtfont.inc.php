<?php
//-----------------------------------------------------------------------
//                   - JomiTech Components For PHP 1.0 -
//                       -- Extended Font Class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once( "vcl/vcl.inc.php" );

use_unit( "graphics.inc.php" );

class JTFont extends Font
{
    protected $_family = '';
    protected $_size = '';

    function serializeProperties()
    {
        $properties = array();
        $myclassName = $this->ClassName();

        if( isset( $methodCache[ $myclassName ] ) )
        {
            $methods = $methodCache[ $myclassName ];
        }
        else
        {
            $refclass=new ReflectionClass( $myclassName );
            $methods=$refclass->getMethods();

            $methods = array_filter( $methods, 'filterSet' );

            array_walk( $methods, 'processMethods' );

            $methodCache[ $myclassName ] = $methods;
        }

        foreach( $methods as $methodname )
        {
            $methodname[0] = 'g';
            $propValue = $this->$methodname();

            $properties[ substr( $methodname, 3 ) ] = $propValue;
        }

        if( defined( 'VCL_VERSION_MAJOR' ) && VCL_VERSION_MAJOR < 2 )
            return bin2hex( serialize( $properties ) );
        else
            return serialize( $properties );
    }

    function unserializeProperties( $value )
    {
        if( !is_array( $value ) )
        {
            if( defined( 'VCL_VERSION_MAJOR' ) && preg_match( '/^[a-h0-9]*$/i', $value ) )
                $value = pack( 'H*', $value );

            $value = unserialize( $value );
        }

        $myclassName = $this->ClassName();

        if( isset( $methodCache[ $myclassName ] ) )
        {
            $methods = $methodCache[ $myclassName ];
        }
        else
        {
            $refclass=new ReflectionClass( $myclassName );
            $methods=$refclass->getMethods();

            $methods = array_filter( $methods, 'filterSet' );

            array_walk( $methods, 'processMethods' );

            $methodCache[ $myclassName ] = $methods;
        }

        foreach( $methods as $methodName )
        {
            $propName = substr( $methodName, 3 );

            if( isset( $value[ $propName ] ) )
                $this->$methodName( $value[ $propName ] );
        }
    }

    function getFamily()
    {
        return $this->_family;
    }

    function setFamily( $value )
    {
        $this->_family = $value;
        $this->modified();
    }

    function defaultFamily()
    {
        return '';
    }

    function getSize()
    {
        return $this->_size;
    }

    function setSize( $value )
    {
        $this->_size = $value;
        $this->modified();
    }

    function defaultSize()
    {
        return '';
    }
}
?>
