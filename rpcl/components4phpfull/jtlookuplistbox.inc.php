<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Lookup list box component --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");
use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtbaselookupbox.inc.php" );

class JTLookupListBox extends JTBaseLookupBox
{
    protected $_ReadOnly = 0;
    protected $_Size = 10;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'lookup' ) );
    }

    protected function GenerateItemContents( $content, $value, $selected )
    {
        $vars = array(
            'CONTENT'       => $content,
            'VALUE'         => $value,
        );

        if( $selected )
            $vars[ 'SELECTED' ] = ' selected="selected"';
        else
            $vars[ 'SELECTED' ] = '';

        return $this->generateComponentSectionCode( 'item', $vars );
    }

    protected function GenerateBoxContents( $items )
    {
        $styles = GetJTFontString( $this->StyleFont );

        $vars = array(
            'CONTENT'       => $items,
            'EVENTS'        => $this->JsEvents,
            'SIZE'          => $this->_Size,
            'DISABLED'      => ( $this->_Enabled ? '' : ' disabled' ),
            'READONLY'      => ( $this->_ReadOnly ? ' readonly' : '' ),
            'STYLES'        => $styles,
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : -1 ),
        );

        return $this->generateComponentSectionCode( 'listbox', $vars );
    }

    function getSize()
    {
        return $this->_Size;
    }

    function setSize( $value )
    {
        $this->_Size = $value;
    }

    function defaultSize()
    {
        return 10;
    }

    function getReadOnly()
    {
        return $this->_ReadOnly;
    }

    function setReadOnly( $value )
    {
        $this->_ReadOnly = $value;
    }

    function defaultReadOnly()
    {
        return 0;
    }
}
?>