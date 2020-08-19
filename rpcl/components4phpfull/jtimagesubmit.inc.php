<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                      -- Image submit component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTImageSubmit extends JTThemedGraphicControl
{
    protected $_ImageSource = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 100;
        $this->Height = 100;
    }

    protected function dumpThemedContents()
    {
        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

        $vars = array(
            'EVENTS'    => $this->JsEvents,
            'SRC'       => $this->_ImageSource,
            'TABINDEX'  => $tabindex,
        );

        echo( $this->generateComponentSectionCode( 'imagesubmit', $vars ) );
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

    function getjsOnClick()
    {
        return $this->readjsOnClick();
    }

    function setjsOnClick( $value )
    {
        $this->writejsOnClick($value);
    }
}
?>
