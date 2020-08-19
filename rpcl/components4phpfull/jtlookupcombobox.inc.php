<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Lookup combo box component --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");
use_unit( "classes.inc.php" );
use_unit( "controls.inc.php" );

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtbaselookupbox.inc.php" );

class JTLookupComboBox extends JTBaseLookupBox
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 24;
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
            'DISABLED'      => ( $this->_Enabled ? '' : ' disabled' ),
            /*'READONLY'      => ( $this->_ReadOnly ? ' readonly' : '' ),*/
            'STYLES'        => $styles,
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : -1 ),
        );

        return $this->generateComponentSectionCode( 'combobox', $vars );
    }
}
?>
