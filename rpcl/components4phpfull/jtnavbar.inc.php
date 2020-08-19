<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- Navigation Bar Base Class --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTNavigationBar extends JTThemedGraphicControl
{
    protected $Selected = '';
    protected $_ShowSubNav = 0;
    protected $_Items;
    protected $_Orientation = 'noHorizontal';
    protected $_ImageList = null;
    protected $_onclick;

    protected $ImageListInst = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_Items = array();

        $this->Width = 400;
        $this->Height = 43;

        if( !defined( 'NO_VCL' ) )
        {
            $this->ControlStyle = 'csRenderOwner=1';
            $this->ControlStyle = 'csRenderAlso=JTSiteTheme,ImageList';
        }
    }

    function init()
    {
        parent::init();

        $submitEventValue = $this->input->{$this->JSWrapperHiddenFieldName};
        if( is_object( $submitEventValue ) && $submitEventValue->asString() )
        {
            if( $this->_onclick )
                $this->callEvent( 'onclick', array( $submitEventValue->asString() ) );
        }
    }

    function loaded()
    {
        parent::loaded();

        $this->setImageList( $this->_ImageList );
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

        print( "var $this->Name" . "Links = new Array();\r\n" );

        if( count( $this->_Items ) > 0 )
        {
            foreach( $this->_Items as $item_name => $item_data )
            {
                list( $item_text, $item_link, $subitems ) = $item_data;

                $item_name = $this->Name . "_" . $item_name;

                print( $this->Name . "Links[ '$item_name' ] = \"" . addslashes( $item_link ) . "\";\r\n" );

                foreach( $subitems as $subname => $subdata )
                {
                    list( $item_text, $item_link ) = $subdata;

                    $subname = $item_name . '_' . $subname;

                    print( $this->Name . "Links[ '$subname' ] = \"" . addslashes( $item_link ) . "\";\r\n" );
                }
            }
        }

        print( "\r\n" );

        print( "function $this->Name" . "ClickHandler( e )\r\n" );
        print( "{\r\n" );
        print( "  var event = e || window.event;\r\n" );
        print( "  var id = getEventTarget( event ).id;\r\n" );
        print( "  var pieces = id.split( \"_\" );\r\n" );
        print( "  id = pieces[ 0 ] + \"_\" + pieces[ 1 ];\r\n" );
        print( "  if( pieces.length > 2 && pieces[ 2 ] != \"link\" )\r\n" );
        print( "    id += \"_\" + pieces[ 2 ];\r\n" );
        // print( "  if( document.getElementById( id ).tagName == 'A' )\r\n" );
        // print( "    id = id.substr( 0, id.length - 5 );\r\n" );

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

    protected function dumpThemedContents()
    {
        // print( "<div id=\"" . $this->Name . "_outerdiv\" style=\"width: 100%; height: 100%;\">\r\n" );
        // print( "<span id=\"" . $this->Name . "_outerdiv\">\r\n" );
        print( "<div id=\"" . $this->Name . "_outerdiv\"" . ( ( !$this->_DumpDimensions ) ? ' style="height: 100%; width: 100%;"' : '' ) . ">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
        // print( "</span>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $content = '';
        $subitems = '';
        $first = true;
        $tabindex = $this->_TabStop ? $this->_TabOrder : -1;

        if( ( $this->ControlState & csDesigning ) == csDesigning && $this->_ImageList )
            $this->ImageListInst = $this->propertyToObject( $this->_ImageList );
        else
            $this->ImageListInst = $this->_ImageList;

        foreach( $this->_Items as $item_name => $item_data )
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
            print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
        }
    }

    protected function GenerateNavBarDivider()
    {
        return $this->generateComponentSectionCode( ( $this->_Orientation == 'noHorizontal' ) ? 'horz_divider' : 'vert_divider', array() );
    }

    protected function GenerateNavBarItem( $name, $content, $state, $link, $tabindex, $imageindex )
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $buttontype = ( $this->_Orientation == 'noHorizontal' ) ? 'h' : 'v';

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

        $itemimage = '';

        if( $this->_ImageList && strlen( $imageindex ) )
        {
            // $itemimage = $this->ImageListInst->Images[ $imageindex ];
            foreach( $this->ImageListInst->Images as $k => $v )
            {
                if( $k == $imageindex )
                {
                    $itemimage = $v;
                    break;
                }
            }
        }

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
            return $this->generateComponentSectionCode( ( $this->_Orientation == 'noHorizontal' ) ? 'horz_item_img' : 'vert_item_img', $vars );
        else
            return $this->generateComponentSectionCode( ( $this->_Orientation == 'noHorizontal' ) ? 'horz_item' : 'vert_item', $vars );
    }

    protected function GenerateNavBarBackground( $content, $subitems )
    {
        $state = ( $this->_ShowSubNav ) ? 'block' : 'none';

        $vars = array(
            'CONTENT'       => $content,
            'SUBITEMS'      => $subitems,
            'STATE'         => $state,
        );

        return $this->generateComponentSectionCode( ( $this->_Orientation == 'noHorizontal' ) ? 'horz_back' : 'vert_back', $vars );
    }

    protected function GenerateNavBarSubItems( $name, $items, $state )
    {
        if( count( $items ) < 1 )
            return '';

        $contents = '';

        foreach( $items as $item_name => $item )
        {
            if( count( $item ) < 3 )
            {
                list ( $item_caption, $item_link ) = $item;
                $item_imageindex = '';
            }
            else
            list( $item_caption, $item_link, $item_imageindex ) = $item;

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

        $itemimage = '';
        if( $this->_ImageList && strlen( $item_imageindex ) )
            $itemimage = $this->ImageListInst->Images[ $item_imageindex ];

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
        $item_array = '';
        $first = true;

        foreach( $this->_Items as $item_name => $item_data )
        {
            $name = $this->Name . '_' . $item_name;

            if( $first )
                $first = false;
            else
                $item_array .= ', ';

            $item_array .= '"' . $name . '"';
        }

        if( $this->Selected )
            $selected = $this->Name . '_' . $this->Selected;
        else
            $selected = '';

        print( 'JTNavBarInitialize("' . $this->Name . '", [' . $item_array . '], "' . $selected . '", ' . $this->Name . "ClickHandler);\r\n" );
    }

    function dumpForAjax()
    {
        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_contents();

        ob_end_clean();

        $contents = str_replace( "\r\n", " ", $contents );
        $contents = str_replace( "\n", " ", $contents );
        $contents = str_replace( '"', '\"', $contents );

        print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );

        $this->dumpBodyJavaScript();
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

    function AddButton( $name, $caption, $link = '', $imageIndex = '' )
    {
        $this->_Items[ $name ] = array( $caption, $link, array(), $imageIndex );
    }

    function DeleteButton( $name )
    {
        if( array_key_exists( $name, $this->_Items ) )
            unset( $this->_Items[ $name ] );
    }

    function ClearButtons()
    {
        $this->_Items = array();
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

    function getItems()
    {
        return $this->_Items;
    }

    function setItems( $value )
    {
        foreach( $value as &$v )
        {
            if( !is_array( $v ) )
                $v = unserialize( $v );

            if( count( $v ) < 3 )
            {
                $v[] = array();
            }
            else if( !is_array( $v[ 2 ] ) )
            {
                if( strlen( $v[ 2 ] ) == 0 )
                {
                    $v[ 2 ] = array();
                }
                else
                {
                    $v[ 2 ] = unserialize( $v[ 2 ] );

                    $arr = $v[ 2 ];

                    foreach( $arr as &$a )
                    {
                        if( !is_array( $a ) )
                            $a = unserialize( $a );
                    }

                    $v[ 2 ] = $arr;
                }
            }
        }

        $this->_Items = $value;
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

    function getOrientation()
    {
        return $this->_Orientation;
    }

    function setOrientation( $value )
    {
        $this->_Orientation = $value;
    }

    function defaultOrientation()
    {
        return 'noHorizontal';
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function readMenuButtons()
    {
        $result = array_keys( $this->_Items );

        foreach( $result as &$v )
            $v = $this->Name . '.' . $v;

        return $result;
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

    function getImageList()
    {
        return $this->_ImageList;
    }

    function setImageList( $value )
    {
        $this->_ImageList = $this->fixupPropertyAndCheck( $value, 'ImageList' );
    }

    function getOnClick()
    {
        return $this->_onclick;
    }

    function setOnClick( $value )
    {
        $this->_onclick = $value;
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