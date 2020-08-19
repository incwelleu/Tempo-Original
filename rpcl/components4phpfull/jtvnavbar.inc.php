<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//               -- Vertical Navigation Bar Class --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtbasenavigation.inc.php" );

class JTVertNavigationBar extends JTBaseNavigation
{
    protected $_Caption = '';
    protected $Selected = '';
    protected $_ShowCaption = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 400;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'nav' ) );
    }

    function dumpJSEvent( $event )
    {
        if( $event )
        {
            print( "function $event (event, id, tag) {\r\n" );
            print( "    var params = [id, tag];\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\" style=\"width: 100%; height: 100%;\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        if( $this->_ShowCaption )
            $header = $this->generateComponentSectionCode( 'header', array( 'CAPTION' => $this->_Caption ) );
        else
            $header = '';

        $content = $this->dumpSubItems( $this->Name . '_', $this->_RootItem );

        $vars = array(
            'CONTENT'       => $content,
            'HEADER'        => $header,
            'IMGCLASS'      => ( $this->_ImageList ? 'jtvnavbar_images' : '' ),
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : '' )
        );

        echo( $this->generateComponentSectionCode( 'vert_back', $vars ) );
    }

    protected function dumpSubItems( $namePrefix, $item )
    {
        $content = '';

        foreach( $item->SubItems as $subItem )
        {
            if( !$subItem->Visible )
                continue;

            if( $subItem->Caption == '-' )
            {
                $content .= $this->GenerateNavBarDivider();
            }
            else
            {
                $subItemContent = $this->dumpSubItems( $namePrefix . $subItem->Name . '_', $subItem );

                $content .= $this->GenerateNavBarItem( $namePrefix . $subItem->Name, $subItem,
                    $subItemContent );
            }
        }

        return $content;
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
            print( "<input type=\"hidden\" id=\"{$this->JSWrapperHiddenFieldName}\" name=\"{$this->JSWrapperHiddenFieldName}\" value=\"\">\r\n" );
        }
    }

    protected function GenerateNavBarDivider()
    {
        return $this->generateComponentSectionCode( 'vert_divider', array() );
    }

    protected function GenerateNavBarItem( $itemID, $item, $subItemContent )
    {
        $state = ( $item->Name == $this->Selected ) ? 'active' : 'default';

        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $vars = array(
            'ITEMNAME'      => $itemID,
            'CONTENT'       => $item->Caption,
            'IMAGE'         => $this->imageIndexToFile( $item->ImageIndex ),
            'LINK'          => $item->Link,
            'STATE'         => $state,
            'STYLE'         => $style,
            'SUBITEMS'      => $subItemContent,
            'TAG'           => $item->Tag
        );

        return $this->generateComponentSectionCode( 'vert_item', $vars );
    }

    protected function dumpBodyJavaScript()
    {
        $onClick = GetJTJSEventToString( $this->JsOnClick );
        $submitField = ( $this->_onclick ? $this->JSWrapperHiddenFieldName : '' );

        echo( "JTVNavBarInitialize('{$this->Name}', $onClick, '$submitField');\r\n" );
    }

    protected function itemsFromArray( $items )
    {
        if( count( $items ) > 0 )
        {
            reset( $items );

            if( !is_int( key( $items ) ) )
            {
                // Old items format.
                $this->_RootItem->clearSubItems();

                foreach( $items as $item_name => $item_data )
                {
                    if( count( $item_data ) < 3 )
                    {
                        list( $item_text, $item_link ) = $item_data;
                        $item_imageindex = '';
                    }
                    else
                    {
                        list( $item_text, $item_link, $item_imageindex ) = $item_data;
                    }

                    $item = $this->_RootItem->addSubItem();
                    $item->Caption = $item_text;
                    $item->Enabled = true;
                    $item->ImageIndex = $item_imageindex;
                    $item->Link = $item_link;
                    $item->Name = $item_name;
                    $item->Visible = true;
                }

                return;
            }
        }

        parent::itemsFromArray( $items );
    }

    function getCaption()
    {
        return $this->_Caption;
    }

    function setCaption( $value )
    {
        $this->_Caption = $value;
    }

    function defaultCaption()
    {
        return '';
    }

    function getItems()
    {
        return $this->readItems();
    }

    function setItems( $value )
    {
        $this->writeItems( $value );
    }

    function getSelected()
    {
        return $this->Selected;
    }

    function setSelected( $value )
    {
        $this->Selected = $value;
    }

    function defaultSelected()
    {
        return '';
    }

    function getShowCaption()
    {
        return $this->_ShowCaption;
    }

    function setShowCaption( $value )
    {
        $this->_ShowCaption = $value;
    }

    function defaultShowCaption()
    {
        return 0;
    }
}
?>