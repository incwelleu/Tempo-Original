<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                       -- Toolbar component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTToolBar extends JTThemedGraphicControl
{
    protected $_Items;
    protected $_onclick;
    protected $_ImageList = null;

    protected $ImageListInst = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 400;
        $this->Height = 30;

        $this->_Items = array();

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
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'toolbar' ) );

        if( defined( 'JT_STANDALONE' ) )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );
            $this->dumpJavascript();
            print( "</script>\r\n" );
        }
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        print( "function $this->Name" . "ClickHandler( toolButtonID, e )\r\n" );
        print( "{\r\n" );

        if( $this->JsOnClick != null )
        {
            print( "  if( " . $this->JsOnClick . "( toolButtonID, e ) == false )\r\n" );
            print( "    return;\r\n" );
        }

        print( "  var event = e || window.event;\r\n" );
        print( "  var id = toolButtonID;\r\n" );

        if( ( ( $this->ControlState & csDesigning ) != csDesigning ) && ( $this->_onclick ) )
        {
            if( !defined( 'JT_STANDALONE' ) )
                $form = "document." . $this->owner->Name;
            else
                $form = "getParentForm(getEventTarget(e))";

            print( "  var f = $form;\r\n" );
            print( "  f." . $this->JSWrapperHiddenFieldName . ".value = id;\r\n" );
            print( "  if( ( f.onsubmit ) && ( typeof( f.onsubmit ) == 'function' ) )\r\n" );
            print( "    f.onsubmit();\r\n" );
            print( "  f.submit();\r\n" );
        }

        print( "}\r\n\r\n" );
    }

    function dumpJsEvents()
    {
        if( !defined( 'JT_STANDALONE' ) )
            parent::dumpJsEvents();
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

        if( ( $this->ControlState & csDesigning ) == csDesigning && $this->_ImageList )
            $this->ImageListInst = $this->propertyToObject( $this->_ImageList );
        else
            $this->ImageListInst = $this->_ImageList;

        if( $this->_Items && count( $this->_Items ) > 0 )
        {
            foreach( $this->_Items as $item_name => $itemData )
            {
                if( count( $itemData ) < 3 )
                {
                    list( $item_text, $enabled ) = $itemData;
                    $item_imageindex = '';
                }
                else
                {
                    list( $item_text, $enabled, $item_imageindex ) = $itemData;
                }

                $item_name = $this->Name . '_' . $item_name;

                $data = $this->GenerateToolBarItem( $item_name, $item_text, $enabled, $item_imageindex );

                $content .= $data;
            }
        }

        print( $this->GenerateToolBarBackground( $content ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\"><!--\r\n" );

            $this->dumpBodyJavaScript();

            print( "// -->\r\n" );
            print( "</script>\r\n" );
        }

        print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\" />\r\n" );
    }

    protected function GenerateToolBarBackground( $content )
    {
        $vars = array(
            'BARWIDTH'      => ( $this->Width - ( $this->retrieveSetting( 'LeftEdgeWidth' ) + $this->retrieveSetting( 'RightEdgeWidth' ) ) ),
            'CONTENT'       => $content,
        );

        return $this->generateComponentSectionCode( 'toolbar_back', $vars );
    }

    protected function GenerateToolBarItem( $name, $content, $enabled, $imageindex )
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        if( $enabled )
        {
            $events = " onmouseover=\"JTToolButtonOver( '$name' )\" onmouseout=\"JTToolButtonOut( '$name' )\" ";
            $events .= "onmousedown=\"JTToolButtonDown( '$name' )\" onmouseup=\"JTToolButtonUp( '$name' )\" ";
            $events .= "onclick=\"" . $this->Name . "ClickHandler('$name', event)\"";
        }
        else
        {
            $events = "";
        }

        $itemimage = $this->imageIndexToFile( $imageindex );

        $vars = array(
            'ITEMNAME'      => $name,
            'STYLE'         => $style,
            'EVENTS'        => $events,
            'CONTENT'       => $content,
            'ENABLED'       => ( $enabled ? '' : ' jttoolbutton_disabled' ),
            'IMAGE'         => $itemimage,
        );

        if( $this->_ImageList && strlen( $imageindex ) )
            return $this->generateComponentSectionCode( 'toolbar_item_img', $vars );
        else
            return $this->generateComponentSectionCode( 'toolbar_item', $vars );
    }

    protected function imageIndexToFile( $index )
    {
        $itemimage = '';

        if( $this->_ImageList && strlen( $index ) )
        {
            // $itemimage = $this->ImageListInst->Images[ $imageindex ];
            foreach( $this->ImageListInst->Images as $k => $v )
            {
                if( $k == $index )
                {
                    $itemimage = $v;
                    break;
                }
            }
        }

        return $itemimage;
    }

    protected function dumpBodyJavaScript()
    {
        /*
        if( $this->_Items && count( $this->_Items ) > 0 )
        {
            foreach( $this->_Items as $item_name => $itemData )
            {
                $item_name = $this->Name . '_' . $item_name;

                print( "document.getElementById( '$item_name' ).onclick = $this->Name" . "ClickHandler;\r\n" );
            }
        }
        */

        print( "JTToolBarInitialize( '$this->Name' );\r\n" );
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
            print( "function $event( toolButtonID, event )\r\n" );
            print( "{\r\n" );
            print( "    var event = event || window.event;\r\n" );
            print( "    var params = new Array( getEventTarget( event ).id );\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    function AddButton( $name, $caption, $enabled = true, $imageindex = '' )
    {
        $this->_Items[ $name ] = array( $caption, $enabled, $imageindex );
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

    function readMenuButtons()
    {
        $result = array_keys( $this->_Items );

        foreach( $result as &$v )
            $v = $this->Name . '.' . $v;

        return $result;
    }

    function getImageList()
    {
        return $this->_ImageList;
    }

    function setImageList( $value )
    {
        $this->_ImageList = $this->fixupPropertyAndCheck( $value, 'imagelist' );
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