<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//               -- Horizontal Navigation Bar Base Class --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtbasenavigation.inc.php" );

class JTHorzNavigationBar extends JTBaseNavigation
{
    protected $Selected = '';
    protected $_ShowSubNav = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 400;
        $this->Height = 43;
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'nav' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        $links = array();

        foreach( $this->_RootItem->SubItems as $item )
        {
            $name = $this->Name . '_' . $item->Name;

            if( $item->Link )
                $links[ $name ] = $item->Link;

            foreach( $item->SubItems as $subItem )
            {
                if( $subItem->Link )
                    $links[ $name . '_' . $subItem->Name ] = $subItem->Link;
            }
        }

        print( $this->Name . "Links = " . json_encode( $links ) );
        print( "\r\n" );

        print( "function $this->Name" . "ClickHandler( e, isSubNav )\r\n" );
        print( "{\r\n" );
        print( "  var event = e || window.event;\r\n" );
        print( "  var id = getEventTarget( event ).id;\r\n" );
        print( "  var pieces = id.split( \"_\" );\r\n" );
        print( "  id = pieces[ 0 ] + \"_\" + pieces[ 1 ];\r\n" );
        echo( "  if( isSubNav )\r\n" );
        echo( "    id += \"_\" + pieces[ 2 ];\r\n" );

        if( $this->JsOnClick != null )
        {
            print( "  if( " . $this->JsOnClick . "( e ) == false )\r\n" );
            print( "    return false;\r\n" );
        }

        print( "  if( " . $this->Name . "Links[ id ] )\r\n" );
        print( "  {\r\n");
        print( "    window.location = " . $this->Name . "Links[ id ];\r\n" );
        print( "    return false;\r\n" );
        print( "  }\r\n" );

        if( ( ( $this->ControlState & csDesigning ) != csDesigning ) && ( $this->_onclick ) )
        {
            $form = "document." . $this->owner->Name;

            print( "  $form." . $this->JSWrapperHiddenFieldName . ".value = id;\r\n" );
            print( "  if( ( $form.onsubmit ) && ( typeof( $form.onsubmit ) == 'function' ) )\r\n" );
            print( "    $form.onsubmit();\r\n" );
            print( "  $form.submit();\r\n" );
        }

        print( "  return false;\r\n" );
        print( "}\r\n\r\n" );
    }

    function dumpJSEvent($event)
    {
        if( $event )
        {
            print( "function $event( event )\r\n" );
            print( "{\r\n" );
            print( "    var event = event || window.event;\r\n" );
            print( "    var params = [ getEventTarget( event ).id ];\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<span id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</span>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $content = '';
        $subitems = '';
        $first = true;
        $tabindex = $this->_TabStop ? $this->_TabOrder : -1;

        foreach( $this->_RootItem->SubItems as $item )
        {
            if( !$item->Visible )
                continue;

            $item_text = $item->Caption;
            $item_link = $item->Link;
            $item_name = $item->Name;
            $item_subitems = $item->SubItems;
            $item_imageindex = $item->ImageIndex;

            if( $item_name == $this->Selected )
            {
                $state = 'active';
                $barstate = 'block';
            }
            else
            {
                $state = 'default';
                $barstate = 'none';
            }

            $name = $this->Name . '_' . $item_name;

            if( $first )
                $first = false;
            else
                $content .= $this->GenerateNavBarDivider();

            $content .= $this->GenerateNavBarItem( $name, $item_text, $state, $item_link, $tabindex, $item_imageindex );

            $subitems .= $this->GenerateNavBarSubItems( $name, $item_subitems, $barstate );

            if( $tabindex > 0 )
                ++$tabindex;
        }

        print( $this->GenerateNavBarBackground( $content, $subitems ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
            print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\" />\r\n" );
        }
    }

    protected function GenerateNavBarDivider()
    {
        return $this->generateComponentSectionCode( 'horz_divider', array() );
    }

    protected function GenerateNavBarItem( $name, $content, $state, $link, $tabindex, $imageindex )
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $buttontype = 'h';

        $events = " onmouseover=\"JTNavBarButtonOver( '" . $name . "', '$buttontype' )\" onmouseout=\"JTNavBarButtonOut( '" . $name . "', '$buttontype', '$state' )\"";

        if( $link )
        {
            $vars = array(
                'ITEMNAME'      => $name,
                'LINK'          => $link,
                'CONTENT'       => $content,
                'TABINDEX'      => $tabindex,
            );

            $content = $this->generateComponentSectionCode( 'link', $vars );

            $tabindex = -1;
        }

        $itemimage = $this->imageIndexToFile( $imageindex );

        $vars = array(
            'ITEMNAME'      => $name,
            'STATE'         => $state,
            'STYLE'         => $style,
            'EVENTS'        => $events,
            'CONTENT'       => $content,
            'TABINDEX'      => $tabindex,
            'IMAGE'         => $itemimage,
        );

        if( $this->_ImageList && strlen( $imageindex ) )
            return $this->generateComponentSectionCode( 'horz_item_img', $vars );
        else
            return $this->generateComponentSectionCode( 'horz_item', $vars );
    }

    protected function GenerateNavBarBackground( $content, $subitems )
    {
        $state = ( $this->_ShowSubNav ) ? 'block' : 'none';

        $vars = array(
            'CONTENT'       => $content,
            'SUBITEMS'      => $subitems,
            'STATE'         => $state,
        );

        return $this->generateComponentSectionCode( 'horz_back', $vars );
    }

    protected function GenerateNavBarSubItems( $name, $items, $state )
    {
        if( count( $items ) < 1 )
            return '';

        $contents = '';

        foreach( $items as $item )
        {
            if( !$item->Visible )
                continue;

            $item_name = $item->Name;
            $item_caption = $item->Caption;
            $item_link = $item->Link;
            $item_imageindex = $item->ImageIndex;

            $item_name = $name . '_' . $item_name;

            $contents .= $this->GenerateNavBarSubItem( $item_name, $item_caption, $item_link, $item_imageindex );
        }

        $vars = array(
            'SUBNAME'       => $name . '_subbar',
            'CONTENT'       => $contents,
            'STATE'         => $state,
        );

        return $this->generateComponentSectionCode( 'subbar', $vars );
    }

    function GenerateNavBarSubItem( $item_name, $item_caption, $item_link, $item_imageindex )
    {
        $content = $item_caption;

        if( $item_link )
        {
            $vars = array(
                'ITEMNAME'      => $item_name,
                'LINK'          => $item_link,
                'CONTENT'       => $content,
            );

            $content = $this->generateComponentSectionCode( 'sublink', $vars );
        }

        $itemimage = $this->imageIndexToFile( $item_imageindex );

        $vars = array(
            'SUBITEMNAME'       => $item_name,
            'SUBITEMCONTENT'    => $content,
            'SUBITEMIMAGE'      => $itemimage,
        );

        if( $this->_ImageList && strlen( $item_imageindex ) )
            return $this->generateComponentSectionCode( 'subitem_img', $vars );
        else
            return $this->generateComponentSectionCode( 'subitem', $vars );
    }

    protected function dumpBodyJavaScript()
    {
        $item_array = array();
        $first = true;

        foreach( $this->_RootItem->SubItems as $item )
            $item_array[] = $this->Name . '_' . $item->Name;

        if( $this->Selected )
            $selected = $this->Name . '_' . $this->Selected;
        else
            $selected = '';

        print( 'JTNavBarInitialize( "' . $this->Name . '", ' . json_encode( $item_array ) . ', "' . $selected . '", ' . $this->Name . "ClickHandler );\r\n" );
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
                    if( count( $item_data ) < 4 )
                    {
                        list( $item_text, $item_link, $item_subitems ) = $item_data;
                        $item_imageindex = '';
                    }
                    else
                    {
                        list( $item_text, $item_link, $item_subitems, $item_imageindex ) = $item_data;
                    }

                    $item = $this->_RootItem->addSubItem();
                    $item->Caption = $item_text;
                    $item->Enabled = true;
                    $item->ImageIndex = $item_imageindex;
                    $item->Link = $item_link;
                    $item->Name = $item_name;
                    $item->Visible = true;

                    foreach( $item_subitems as $subitem_name => $subitem_data )
                    {
                        if( count( $subitem_data ) > 2 )
                        {
                            list( $item_caption, $item_link, $item_imageindex ) = $subitem_data;
                        }
                        else
                        {
                            list( $item_caption, $item_link ) = $subitem_data;
                            $item_imageindex = '';
                        }

                        $subItem = $item->addSubItem();
                        $subItem->Caption = $item_caption;
                        $subItem->Enabled = true;
                        $subItem->ImageIndex = $item_imageindex;
                        $subItem->Link = $item_link;
                        $subItem->Name = $subitem_name;
                        $subItem->Visible = true;
                    }
                }

                return;
            }
        }

        parent::itemsFromArray( $items );
    }

    function getItems()
    {
        return $this->readItems();
    }

    function setItems( $value )
    {
        $this->writeItems( $value );
    }

    function getShowSubNav()
    {
        return $this->_ShowSubNav;
    }

    function setShowSubNav( $value )
    {
        $this->_ShowSubNav = $value;
    }

    function defaultShowSubNav()
    {
        return 0;
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

    function readMenuButtons()
    {
        $result = array();

        foreach( $this->_RootItem->SubItems as $item )
            $result[] = $this->Name . '.' . $item->Name;

        return $result;
    }
}