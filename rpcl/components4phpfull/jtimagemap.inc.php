<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                       -- Image map component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTImageMap extends JTThemedGraphicControl
{
    protected $_Areas = array();
    protected $_ImageSource = '';
    protected $_Stretch = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    protected function dumpThemedContents()
    {
        if( file_exists( $this->_ImageSource ) && !$this->_Stretch )
        {
            $imageInfo = getimagesize( $this->_ImageSource );

            $imageWidth = $imageInfo[ 0 ];
            $imageHeight = $imageInfo[ 1 ];
        }
        else
        {
            $imageWidth = $this->Width;
            $imageHeight = $this->Height;
        }

        $vars = array(
            'IMAGEWIDTH'        => $imageWidth,
            'IMAGEHEIGHT'       => $imageHeight,
            'IMAGESOURCE'       => $this->_ImageSource,
        );

        echo( $this->generateComponentSectionCode( 'image', $vars ) );

        if( count( $this->_Areas ) > 0 )
        {
            $contents = '';

            $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

            foreach( $this->_Areas as $area )
            {
                list( $href, $alt, $type, $coords ) = $area;

                $vars = array(
                    'HREF'      => $href,
                    'ALT'       => $alt,
                    'TYPE'      => $type,
                    'COORDS'    => $coords,
                    'TABINDEX'  => $tabindex,
                );

                $contents .= $this->generateComponentSectionCode( 'area', $vars );

                if( $tabindex > 0 )
                    ++$tabindex;
            }

            $vars = array(
                'CONTENT'       => $contents,
            );

            echo( $this->generateComponentSectionCode( 'map', $vars ) );
        }
    }

    function getAreas()
    {
        return $this->_Areas;
    }

    function setAreas( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$a )
        {
            if( !is_array( $a ) )
                $a = unserialize( $a );
        }

        $this->_Areas = $value;
    }

    function getEditor()
    {
        if( !empty( $this->_ImageSource ) )
            $imagesrc = realpath( $this->_ImageSource );
        else
            $imagesrc = '';

        $arr = serialize( array( 'EDITOR', $imagesrc, $this->_Areas ) );

        return $arr;
    }

    function setEditor( $value )
    {
        if( strpos( $value, 's:6:"EDITOR"' ) !== false )
            return;

        if( !is_array( $value ) )
            $value = unserialize( $value );

        if( count( $value ) > 0 && $value[ 0 ] == 'EDITOR' )
            return;

        $this->Areas = $value;
    }

    function getImageSource()
    {
        return $this->_ImageSource;
    }

    function setImageSource( $value )
    {
        $this->_ImageSource = $value;
    }

    function defaultImageSource()
    {
        return '';
    }

    function getStretch()
    {
        return $this->_Stretch;
    }

    function setStretch( $value )
    {
        $this->_Stretch = ( $value ) ? true : 0;
    }

    function defaultStretch()
    {
        return 0;
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
}
?>