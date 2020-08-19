<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                       -- StatusBar component --
//
//            Copyright © JomiTech 2009. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTStatusBar extends JTThemedGraphicControl
{
    protected $_Items = array();
    private $isFull = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 400;
        $this->Height = 30;
    }

    function loaded()
    {
        parent::loaded();
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'statusbar' ) );
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $content = '';

        if( $this->_Items && count( $this->_Items ) > 0 )
        {
            foreach( $this->_Items as $i => $itemData )
            {
                list( $item_text, $item_length ) = $itemData;

                $item_name = $this->Name . '_' . $i;

                $data = $this->GenerateStatusBarItem( $i, $item_text, $item_length );

                $content .= $data;
            }
        }

        print( $this->GenerateStatusBarBackground( $content ) );
    }

    protected function GenerateStatusBarBackground( $content )
    {
        $vars = array(
            'BARWIDTH'      => ( $this->Width - ( $this->retrieveSetting( 'LeftEdgeWidth' ) + $this->retrieveSetting( 'RightEdgeWidth' ) ) ),
            'LENGTH'        => ( $this->isFull == 1 ? ' style="width: 100%;"' : '' ),
            'CONTENT'       => $content,
        );

        return $this->generateComponentSectionCode( 'statusbar_back', $vars );
    }

    protected function GenerateStatusBarItem( $name, $text, $length )
    {
        $style = GetJTFontString( $this->StyleFont );

        if( $length == '0' )
        {
            $style .= 'width: 100%;';
            $this->isFull = 1;
        }
        else if( $length != '' )
        {
            $style .= 'width: ' . $length . 'px;';
        }

        if( $style )
            $style = " style=\"$style\"";

        $vars = array(
            'ITEMNAME'      => $this->Name . '_' . $name,
            'CONTENT'       => $text,
            'CSSSTYLE'      => $style,
        );

        return $this->generateComponentSectionCode( empty( $length ) ? 'statusbar_item' : 'statusbar_item_fixedwidth', $vars );
    }

    function dumpForAjax()
    {
        global $ajaxResponse;

        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_contents();

        ob_end_clean();

        if( $ajaxResponse )
        {
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            echo( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }
    }

    function AddPanel( $caption, $length )
    {
        $this->_Items[] = array( $caption, $length );
    }

    function DeletePanel( $index )
    {
        array_splice( $this->_Items, $index, 1 );
    }

    function ClearPanels()
    {
        $this->_Items = array();
    }

    function SetPanelCaption( $index, $caption )
    {
        $this->_Items[ $index ][ 0 ] = $caption;
    }

    function getItems()
    {
        return $this->_Items;
    }

    function setItems( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$item )
        {
            if( !is_array( $item ) )
            {
                if( substr( $item, 0, 2 ) == 'a:' )
                {
                    $a = @unserialize( $item );
                    if( $a !== false )
                    {
                        $item = $a;
                        continue;
                    }
                }

                $item = array( $item, true );
            }
        }

        $this->_Items = $value;
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }
}
?>