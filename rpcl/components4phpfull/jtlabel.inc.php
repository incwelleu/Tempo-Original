<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                        -- Label component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTLabel extends JTThemedGraphicControl
{
    protected $_TextClass = 'fsDefault';
    protected $_Caption = '';
    protected $_Link = '';
    protected $_Datasource = null;
    protected $_DataField = '';
    protected $_LinkField = '';
    protected $_ondata;

    protected $_onclick;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 100;
        $this->Height = 18;
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

        $this->setDatasource( $this->Datasource );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'label' ) );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_onclick || $this->JsOnClick )
        {
            print( "function $this->Name" . "ClickHandler( e )\r\n" );
            print( "{\r\n" );

            if( $this->JsOnClick != null )
            {
                print( "  if( " . $this->JsOnClick . "( e ) == false )\r\n" );
                print( "    return false;\r\n" );
            }

            if( empty( $this->_Link ) )
            {
                print( "  var event = e || window.event;\r\n" );
                print( "  var id = getEventTarget( event ).id;\r\n" );

                if( ( ( $this->ControlState & csDesigning ) != csDesigning ) && ( $this->_onclick ) )
                {
                    $form = "document." . $this->owner->Name;

                    print( "  $form." . $this->JSWrapperHiddenFieldName . ".value = id;\r\n" );
                    print( "  if( ( $form.onsubmit ) && ( typeof( $form.onsubmit ) == 'function' ) )\r\n" );
                    print( "    $form.onsubmit();\r\n" );
                    print( "  $form.submit();\r\n" );
                }
            }

            print( "}\r\n\r\n" );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\"" . ( ( !$this->_DumpDimensions ) ? ' style="height: 100%; width: 100%;"' : '' ) . ">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " $style";

        if( $this->_Datasource && strlen( $this->_DataField ) )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $datafield = $this->_DataField;

                if( $this->_ondata )
                {
                    $content = $this->callEvent( 'ondata', array( $this->_Datasource->DataSet->Fields[ $datafield ] ) );

                    if( empty( $content ) )
                        $content = $this->_Datasource->Dataset->Fields[ $datafield ];
                }
                else
                {
                    $content = $this->_Datasource->DataSet->Fields[ $datafield ];
                }
            }
            else
            {
                $content = '';
            }
        }
        else
        {
            $content = $this->_Caption;
        }

        if( $this->_Datasource && strlen( $this->_LinkField ) )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning )
            {
                $linkfield = $this->_LinkField;

                $link = $this->_Datasource->DataSet->Fields[ $linkfield ];
            }
            else
            {
                $link = '';
            }
        }
        else if( $this->_Link )
        {
            $link = $this->_Link;
        }
        else
        {
            $link = '';
        }

        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

        if( strlen( $link ) )
        {
            $vars = array(
                'LINK'      => $link,
                'CONTENT'   => $content,
                'TABINDEX'  => $tabindex,
            );

            $content = $this->generateComponentSectionCode( 'link', $vars );

            $tabindex = -1;
        }

        if( $this->_color )
            $style .= ' background: ' . $this->_color . ';';

        $vars = array(
            'TEXTCLASS' => $this->_TextClass,
            'STYLE'     => $style,
            'CONTENT'   => $content,
            'TABINDEX'  => $tabindex,
        );

        print( $this->generateComponentSectionCode( 'label', $vars ) );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning && ( $this->_onclick || $this->JsOnClick ) )
        {
            if( $this->_Link )
                $id = $this->Name . "_link";
            else
                $id = $this->Name;

            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            print( "</script>\r\n" );
        }

        if( $this->_onclick )
            print( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\">\r\n" );
    }

    protected function dumpBodyJavaScript()
    {
        if( $this->_onclick || $this->JsOnClick )
            print( "document.getElementById('" . $this->Name . "').onclick = $this->Name" . "ClickHandler;\r\n" );
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
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', utf8_encode( $contents ) );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }

        $this->dumpBodyJavaScript();
    }

    function getTextClass()
    {
        return $this->_TextClass;
    }

    function setTextClass( $value )
    {
        $this->_TextClass = $value;
    }

    function defaultTextClass()
    {
        return 'fsDefault';
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

    function getColor()
    {
        return $this->readColor();
    }

    function setColor( $value )
    {
        $this->writeColor( $value );
    }

    function getLink()
    {
        return $this->_Link;
    }

    function setLink( $value )
    {
        $this->_Link = $value;
    }

    function defaultLink()
    {
        return '';
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
    }

    function getDatasource()
    {
        return $this->_Datasource;
    }

    function setDatasource( $value )
    {
        $this->_Datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getDataField()
    {
        return $this->_DataField;
    }

    function setDataField( $value )
    {
        $this->_DataField = $value;
    }

    function defaultDataField()
    {
        return '';
    }

    function getLinkField()
    {
        return $this->_LinkField;
    }

    function setLinkField( $value )
    {
        $this->_LinkField = $value;
    }

    function defaultLinkField()
    {
        return '';
    }

    function getParentColor()
    {
        return $this->readParentColor();
    }

    function setParentColor( $value )
    {
        $this->writeParentColor( $value );
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

    function getOnData()
    {
        return $this->_ondata;
    }

    function setOnData( $value )
    {
        $this->_ondata = $value;
    }

    function defaultOnData()
    {
        return null;
    }
}
?>
