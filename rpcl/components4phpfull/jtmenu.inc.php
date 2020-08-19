<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                         -- Menu component --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtbasenavigation.inc.php" );
use_unit( "components4phpfull/jtphp.inc.php" );

class JTMenu extends JTBaseNavigation
{
    protected $_Control;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 300;
        $this->_Control = null;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'menu' ) );

            if( ( $this->ControlState & csDesigning ) != csDesigning )
                $this->SiteThemeInstance->addComponentJSCode( 'JTMenu' );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        echo( $this->dumpMenu( $this->Name, $this->_RootItem ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
            print( "<input type=\"hidden\" id=\"" . $this->JSWrapperHiddenFieldName . "\" name=\"" .
                $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        if( $this->_Control )
        {
            list( $control_name, $control_button ) = explode( '.', $this->_Control );
        }
        else
        {
            $control_name = '';
            $control_button = '';
        }

        $jsOnClick = GetJTJSEventToString( $this->JsOnClick );
        $submitField = ( $this->_onclick ? $this->JSWrapperHiddenFieldName : '' );

        print( "JTInitializeMenu('{$this->Name}', $jsOnClick, '$control_name', '$control_button', 'mouseover', '$submitField');\r\n" );
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

    protected function itemsFromArray( $items )
    {
        if( count( $items ) > 0 )
        {
            $firstItem = $items[ 0 ];

            if( !isset( $firstItem[ 'Caption' ] ) )
            {
                // Old items format.
                $this->_RootItem->clearSubItems();

                foreach( $items as $item_data )
                {
                    if( count( $item_data ) < 4 )
                    {
                        list( $item_name, $item_text, $item_link ) = $item_data;
                        $item_imageindex = '';
                    }
                    else
                    {
                        list( $item_name, $item_text, $item_link, $item_imageindex ) = $item_data;
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

    protected function dumpMenu( $namePrefix, $item )
    {
        $content = '';

        foreach( $item->SubItems as $subItem )
        {
            if( !$subItem->Visible )
                continue;

            $item_text = $subItem->Caption;
            $item_link = $subItem->Link;
            $item_imageindex = $subItem->ImageIndex;
            $item_name = $namePrefix . '_' . $subItem->Name;
            $item_tag = $subItem->Tag;

            if( $item_text == '-' )
            {
                $content .= $this->GenerateMenuDivider();
            }
            else
            {
                if( count( $subItem->SubItems ) > 0 )
                    $subItems = $this->dumpMenu( $namePrefix . '_' . $subItem->Name . '_menu', $subItem );
                else
                    $subItems = '';

                $content .= $this->GenerateMenuItem( $item_name, $item_text, $item_link,
                    $item_imageindex, $item_tag, $subItems );
            }
        }

        return $this->GenerateMenuBackground( $namePrefix, $content );
    }

    protected function GenerateMenuDivider()
    {
        return $this->generateComponentSectionCode( 'divider', array() );
    }

    protected function GenerateMenuItem( $name, $content, $link, $imageindex, $item_tag, $subItems )
    {
        $vars = array(
            'CONTENT'       => $content,
            'ITEMNAME'      => $name,
            'IMAGE'         => $this->imageIndexToFile( $imageindex ),
            'LINK'          => $link,
            'SUBITEMS'      => $subItems,
            'TAG'           => $item_tag,
        );

        return $this->generateComponentSectionCode( 'item', $vars );
    }

    protected function GenerateMenuBackground( $menuname, $content )
    {
        $vars = array(
            'MENU'          => $menuname,
            'CONTENT'       => $content,
            'DISPLAY'       => ( ( $this->ControlState & csDesigning ) != csDesigning ? 'none' : 'block' ),
            'VISIBILITY'    => ( ( $this->ControlState & csDesigning ) != csDesigning ? 'hidden' : 'visible' ),
        );

        return $this->generateComponentSectionCode( 'menu', $vars );
    }

    function AddMenuItem( $name, $caption, $link = '', $image = '' )
    {
        $item = $this->addItem();
        $item->Caption = $caption;
        $item->Link = $link;
        $item->ImageIndex = $image;
        $item->Name = $name;

        return $item->index();
    }

    function InsertMenuItem( $index, $name, $caption, $link = '', $image = '' )
    {
        $item = $this->insertItem( $index );
        $item->Caption = $caption;
        $item->Link = $link;
        $item->ImageIndex = $image;
        $item->Name = $name;

        return $index;
    }

    function DeleteMenuItem( $index )
    {
        return $this->deleteItemByIndex( $index );
    }

    function ClearMenuItems()
    {
        $this->clearItems();
    }

    function LoadItemsFromFile( $filename )
    {
        $contents = file( $filename );

        $this->ClearItems();

        foreach( $contents as $line )
        {
            preg_match( '/^\"([\w]{1,})\"\,\"([\w]{1,})\"\,\"([a-zA-Z0-9\:\/\.]{0,})\"\r\n$/i', $line, $s );

            $name = $s[ 1 ];
            $caption = $s[ 2 ];
            $link = $s[ 3 ];

            $this->AddItem( stripslashes( $name ), stripslashes( $caption ), stripslashes( $link ) );
        }
    }

    function SaveItemsToFile( $filename )
    {
        $contents = array();

        foreach( $this->_RootItem->SubItems as $item )
        {
            $contents[] = '"' . addslashes( $item->Name ) . '","' . addslashes( $item->Caption ) .
                '","' . addslashes( $item->Link ) . "\"\r\n";
        }

        file_put_contents( $filename, $contents );
    }

    function getControl()
    {
        return $this->_Control;
    }

    function setControl( $value )
    {
        $this->_Control = $value;
    }

    function getItems()
    {
        return $this->readItems();
    }

    function setItems( $value )
    {
        $this->writeItems( $value );
    }
}
?>
