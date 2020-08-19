<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- Larger image component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTLargerImage extends JTThemedGraphicControl
{
    protected $_datasource = null;
    protected $_LargeImageDataField = '';
    protected $_LargeImageSource = '';
    protected $_SmallImageDataField = '';
    protected $_SmallImageSource = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 100;
        $this->Height = 100;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    protected function dumpThemedContents()
    {
        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

        $smallsrc = $this->_SmallImageSource;
        $largesrc = $this->_LargeImageSource;

        if( $this->_datasource && ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( $this->_SmallImageDataField )
                $smallsrc = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_SmallImageDataField ];

            if( $this->_LargeImageDataField )
                $largesrc = $this->_datasource->DataSet->AssociativeFieldValues[ $this->_LargeImageDataField ];
        }

        $vars = array(
            'SMALLSRC'  => $smallsrc,
            'LARGESRC'  => $largesrc,
            'TABINDEX'  => $tabindex,
        );

        echo( $this->generateComponentSectionCode( 'image', $vars ) );
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getLargeImageDataField()
    {
        return $this->_LargeImageDataField;
    }

    function setLargeImageDataField( $value )
    {
        $this->_LargeImageDataField = $value;
    }

    function defaultLargeImageDataField()
    {
        return '';
    }

    function getLargeImageSource()
    {
        return $this->_LargeImageSource;
    }

    function setLargeImageSource( $value )
    {
        $this->_LargeImageSource = $value;
    }

    function defaultLargeImageSource()
    {
        return '';
    }

    function getSmallImageDataField()
    {
        return $this->_SmallImageDataField;
    }

    function setSmallImageDataField( $value )
    {
        $this->_SmallImageDataField = $value;
    }

    function defaultSmallImageDataField()
    {
        return '';
    }

    function getSmallImageSource()
    {
        return $this->_SmallImageSource;
    }

    function setSmallImageSource( $value )
    {
        $this->_SmallImageSource = $value;
    }

    function defaultSmallImageSource()
    {
        return '';
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
