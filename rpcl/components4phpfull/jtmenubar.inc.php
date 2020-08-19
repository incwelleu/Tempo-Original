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

class JTMenuBar extends JTBaseNavigation
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 400;
        $this->Height = 24;
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
        print( "<div id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $content = '';

        foreach( $this->_RootItem->SubItems as $i => $item )
        {
            if( !$item->Visible )
                continue;

            $content .= $this->GenerateMenuBarButton( $this->Name . '_' . $i . '_button', $item );
        }

        print( $this->GenerateMenuBarBackground( $content ) );

        foreach( $this->_RootItem->SubItems as $i => $item )
        {
            if( !$item->Visible )
                continue;

            echo( $this->dumpSubItems( $this->Name . '_', $item ) );
        }
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

    protected function dumpBodyJavaScript()
    {
        $settings = new stdClass();
        $settings->Id = $this->Name;
        $settings->Items = array();
        $settings->SubmitFieldId = ($this->_onclick ? $this->JSWrapperHiddenFieldName : '');

        foreach( $this->_RootItem->SubItems as $i => $item )
        {
            $obj = new stdClass();
            $obj->ButtonId = $this->Name . '_' . $i . '_button';
            $obj->MenuId = $this->Name . '_' . $item->Name . '_menu';

            $settings->Items[] = $obj;
        }

        echo( "JTMenuBarInitialize(" . json_encode( $settings ) . ", " .
            GetJTJSEventToString( $this->JsOnClick ) . ");\r\n" );
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

                foreach( $items as $i => $item )
                {
                    list( $caption, $menu ) = $item;

                    $item = $this->_RootItem->addSubItem();
                    $item->Caption = $caption;
                    $item->Enabled = true;
                    $item->Name = 'Menu' . $i;
                    $item->Visible = true;

                    foreach( $menu as $item_data )
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

                        $subItem = $item->addSubItem();
                        $subItem->Caption = $item_text;
                        $subItem->Enabled = true;
                        $subItem->ImageIndex = $item_imageindex;
                        $subItem->Link = $item_link;
                        $subItem->Name = $item_name;
                        $subItem->Visible = true;
                    }
                }

                return;
            }
        }

        parent::itemsFromArray( $items );
    }

    protected function dumpSubItems( $namePrefix, $item )
    {
        if( count( $item->SubItems ) == 0 )
            return '';

        $namePrefix .= $item->Name . '_';
        $content = '';

        foreach( $item->SubItems as $subItem )
        {
            if( !$subItem->Visible )
                continue;

            $item_text = $subItem->Caption;
            $item_link = $subItem->Link;
            $item_imageindex = $subItem->ImageIndex;
            $item_name = $namePrefix . $subItem->Name;
            $item_tag = $subItem->Tag;

            if( $item_text == '-' )
            {
                $content .= $this->GenerateMenuDivider();
            }
            else
            {
                $subItems = $this->dumpSubItems( $namePrefix, $subItem );

                $content .= $this->GenerateMenuItem( $item_name, $item_text, $item_link,
                    $item_imageindex, $item_tag, $subItems );
            }
        }

        return $this->GenerateMenuBackground( $namePrefix . 'menu', $content );
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
            'DISPLAY'       => 'none',
            'VISIBILITY'    => 'hidden',
        );

        return $this->generateComponentSectionCode( 'menu', $vars );
    }

    protected function GenerateMenuBarButton( $name, $item )
    {
        $vars = array(
            'ITEMNAME'      => $name,
            'CAPTION'       => $item->Caption,
            'IMAGE'         => $this->imageIndexToFile( $item->ImageIndex ),
            'LINK'          => $item->Link,
            'TAG'           => $item->Tag,
        );

        return $this->generateComponentSectionCode( 'menubarbutton', $vars );
    }

    protected function GenerateMenuBarBackground( $content )
    {
        return $this->generateComponentSectionCode( 'menubar', array( 'CONTENT' => $content ) );
    }

    //
    // Deprecated methods
    //
    function AddButton( $caption )
    {
        $item = $this->addItem();
        $item->Caption = $caption;

        return $item->index();
    }

    function InsertButton( $index, $caption )
    {
        $this->insertItem( $index )->Caption = $caption;

        return $index;
    }

    function DeleteButton( $index )
    {
        if( $index < 0 || $index >= count( $this->Items ) )
            return false;

        $this->deleteItemByIndex( $index );

        return true;
    }

    function ClearButtons()
    {
        $this->clearItems();
    }

    function AddButtonItem( $button_index, $name, $caption, $link = '', $imageindex = '', $tag = '' )
    {
        if( $button_index < 0 || $button_index >= count( $this->Items ) )
            return -1;

        $parent = $this->Items[ $button_index ];

        $item = $parent->addSubItem();
        $item->Name = $name;
        $item->Caption = $caption;
        $item->Link = $link;
        $item->ImageIndex = $imageindex;
        $item->Tag = $tag;

        return $item->index();
    }

    function InsertItem( $button_index, $index, $name, $caption, $link = '', $imageindex = '', $tag = '' )
    {
        if( $button_index < 0 || $button_index >= count( $this->Items ) )
            return -1;

        $parent = $this->Items[ $button_index ];

        $item = $parent->insertSubItem( $index );
        $item->Name = $name;
        $item->Caption = $caption;
        $item->Link = $link;
        $item->ImageIndex = $imageindex;
        $item->Tag = $tag;

        return $index;
    }

    function DeleteItem( $button_index, $index )
    {
        if( $button_index < 0 || $button_index >= count( $this->Items ) )
            return false;

        $parent = $this->Items[ $button_index ];

        if( $index < 0 || $index >= count( $parent->SubItems ) )
            return false;

        $parent->deleteSubItemByIndex( $index );

        return true;
    }
    //
    // End Deprecated methods
    //

    function LoadItemsFromFile( $button_index, $filename )
    {
        $contents = file( $filename );

        $this->Items[ $button_index ]->clearSubItems();

        foreach( $contents as $line )
        {
            preg_match( '/^\"([\w]+)\"\,\"([\w ,\?\-]+)\"\,\"([a-zA-Z0-9\:\/\.]*)\"\r\n$/i', $line, $s );

            $newSubItem = $this->Items[ $button_index ]->addSubItem();
            $newSubItem->Name = stripslashes( $s[ 1 ] );
            $newSubItem->Caption = stripslashes( $s[ 2 ] );
            $newSubItem->Link = stripslashes( $s[ 3 ] );
            $newSubItem->Visibility = true;
        }
    }

    function SaveItemsToFile( $button_index, $filename )
    {
        $contents = array();

        foreach( $this->Items[ $button_index ]->SubItems as $item )
        {
            $contents[] = '"' . addslashes( $item->Name ) . '","' . addslashes( $item->Caption ) . '","' . addslashes( $item->Link ) . "\"\r\n";
        }

        file_put_contents( $filename, $contents );
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
