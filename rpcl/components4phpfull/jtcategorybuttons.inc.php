<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Category Button Component --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtbasenavigation.inc.php" );

class JTCategoryButtons extends JTBaseNavigation
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    function allowserialize( $propname )
    {
        if( $propname == 'Categories' )
            return false;

        return parent::allowserialize( $propname );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'catbtn' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        $this->dumpLinksArray();

        print( "function $this->Name" . "ClickHandler( e )\r\n" );
        print( "{\r\n" );
        print( "  var event = e || window.event;\r\n" );
        print( "  var id = getEventTarget( event ).id;\r\n" );
        print( "  if( document.getElementById( id ).tagName == 'A' )\r\n" );
        print( "    id = id.substr( 0, id.length - 5 );\r\n" );

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
            print( "    var params = new Array( getEventTarget( event ).id );\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    function dumpForAjax()
    {
        parent::dumpForAjax();

        $this->dumpLinksArray();
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\" style=\"width: 100%; height: 100%;\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = ' style="' . $style . '"';

        $contents = '';

        if( $this->_TabStop )
            $tabindex = $this->_TabOrder;
        else
            $tabindex = -1;

        foreach( $this->_RootItem->SubItems as $cat_index => $category )
        {
            if( !$category->Visible )
                continue;

            $item_text = $category->Caption;
            $item_link = $category->Link;
            $item_name = $category->Name;
            $item_subitems = $category->SubItems;
            $item_imageindex = $category->ImageIndex;

            $cat_contents = '';
            $cat_tab_index = $tabindex;

            if( $tabindex > 0 )
                ++$tabindex;

            foreach( $item_subitems as $btn_index => $button )
            {
                $subItem_text = $button->Caption;
                $subItem_link = $button->Link;
                $subItem_name = $button->Name;
                $subItem_subitems = $button->SubItems;
                $subItem_imageindex = $button->ImageIndex;

                $caption = $subItem_text;

                $itemname = $this->Name . '_' . $item_name . '_' . $subItem_name;
                $item_tabindex = $tabindex;

                if( $subItem_link )
                {
                    $vars = array(
                        'CATEGORYINDEX'     => $cat_index,
                        'BUTTONINDEX'       => $btn_index,
                        'CONTENT'           => $caption,
                        'LINK'              => $subItem_link,
                        'ITEMNAME'          => $itemname,
                        'TABINDEX'          => $item_tabindex,
                    );

                    $caption = $this->generateComponentSectionCode( 'link', $vars );

                    $item_tabindex = -1;
                }

                $vars = array(
                    'CATEGORYINDEX'     => $cat_index,
                    'BUTTONINDEX'       => $btn_index,
                    'CONTENT'           => $caption,
                    'ITEMNAME'          => $itemname,
                    'STYLE'             => $style,
                    'TABINDEX'          => $item_tabindex,
                );

                $cat_contents .= $this->generateComponentSectionCode( 'button', $vars );
            }

            $vars = array(
                'CATEGORYINDEX'     => $cat_index,
                'CAPTION'           => $item_text,
                'CONTENT'           => $cat_contents,
                'STYLE'             => $style,
                'ITEMNAME'          => $this->Name . '_' . $cat_index,
                'TABINDEX'          => $cat_tab_index,
            );

            $contents .= $this->generateComponentSectionCode( 'category', $vars );
        }

        $vars = array(
            'CONTENT'       => $contents,
        );

        print( $this->generateComponentSectionCode( 'categorybuttons', $vars ) );

        $this->dumpStateInput();
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "// -->\r\n" );
            print( "</script>\r\n" );
            print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        print( "JTCategoryButtonsInitialize( \"" . $this->Name . "\" );\r\n" );
    }

    protected function dumpStateInput()
    {
        $state = '';
        $stateInput = $this->input->{$this->Name . '_state'};
        if( is_object( $stateInput ) )
            $state = $stateInput->asString();

        print( '<input id="' . $this->Name . '_state" name="' . $this->Name . '_state" value="' . $state . '" type="hidden">' . "\r\n" );
    }

    protected function dumpLinksArray()
    {
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

        print( "{$this->Name}Links = " . json_encode( $links ) . "\r\n" );
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

                foreach( $items as $cat_index => $category )
                {
                    $cat_contents = '';

                    $item = $this->_RootItem->addSubItem();
                    $item->Caption = $category[ 0 ];
                    $item->Enabled = true;
                    $item->Name = $cat_index;
                    $item->Visible = true;

                    foreach( $category[ 1 ] as $btn_index => $button )
                    {
                        $caption = $button[ 0 ];

                        $itemname = $btn_index;

                        $subItem = $item->addSubItem();
                        $subItem->Caption = $caption;
                        $subItem->Enabled = true;
                        $subItem->Link = $button[ 1 ];
                        $subItem->Name = $itemname;
                        $subItem->Visible = true;
                    }
                }

                return;
            }
        }

        parent::itemsFromArray( $items );
    }

    function getCategories()
    {
        return $this->readItems();
    }

    function setCategories( $value )
    {
        $this->writeItems( $value );
    }
}
?>