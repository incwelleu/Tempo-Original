<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Combo box component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTComboBox extends JTThemedGraphicControl
{
    const DropDown = 'DropDown';
    const DropDownList = 'DropDownList';

    protected $_AutoDropDown = 0;
    protected $_datasource = null;
    protected $_datafield = '';
    protected $_DropDownCount = 8;
    protected $_Enabled = true;
    protected $_Items = array();
    protected $_ItemIndex = false;
    protected $_lookupdatasource = null;
    protected $_LookupTextField = '';
    protected $_LookupValueField = '';
    protected $_SelectedText = false;
    protected $_SelectedValue = false;
    protected $_Style = JTComboBox::DropDownList;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 24;
    }

    function loaded()
    {
        $this->setDatasource( $this->_datasource );
        $this->setLookupDatasource( $this->_lookupdatasource );
    }

    function preinit()
    {
        $submitted = $this->input->{$this->Name};
        $itemIndexInput = $this->input->{$this->Name . '_Index'};
        $viewInput = $this->input->{$this->Name . '_view'};

        if( is_object( $submitted ) )
        {
            $this->_SelectedValue = $submitted->asUnsafeRaw();
            $this->_ItemIndex = (int)$itemIndexInput->asUnsafeRaw();
            $this->_SelectedText = $viewInput->asUnsafeRaw();

            if( !$this->isKeyValue() )
                $this->_SelectedValue = $this->_SelectedText;

            $this->updateDataField( $this->_SelectedValue );
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            $this->SiteThemeInstance->addComponentJSCode( get_class( $this ) );

            if( ( $this->ControlState & csDesigning ) == csDesigning )
                $this->SiteThemeInstance->dumpHeaderCode();

            print( $this->SiteThemeInstance->generateComponentCSSCode( 'combobox' ) );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\" class=\"jtcomboboxouter\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $contents = '';
        $i = 0;
        $selectedText = $this->_SelectedText;
        $selectedValue = $this->_SelectedValue;
        $selectedIndex = $this->_ItemIndex;

        if( $selectedText === false && $this->_ItemIndex === false && $this->_datasource )
        {
            if( ( $this->ControlState & csDesigning ) == 0 )
            {
                $selectedValue = $this->_datasource->DataSet->Fields[ $this->_datafield ];
                $selectedText = $selectedValue;
            }
        }

        $isKeyValue = $this->isKeyValue();

        if( $this->_lookupdatasource )
        {
            if( ( $this->ControlState & csDesigning ) == 0 )
            {
                $ds = $this->_lookupdatasource->DataSet;

                for( $ds->First(); !$ds->Eof; $ds->Next() )
                {
                    $key = $ds->Fields[ $this->_LookupValueField ];
                    $value = $ds->Fields[ ( $this->_LookupTextField ) ? $this->_LookupTextField : $this->_LookupValueField ];

                    $contents .= $this->dumpItem( $i, $key, $value, $isKeyValue, $selectedText );

                    if( $selectedValue === false && $this->_ItemIndex !== false && $this->_ItemIndex == $i )
                    {
                        $selectedValue = $key;
                        $selectedText = $value;
                    }
                    else if( $selectedIndex === false && $selectedValue !== false && strcmp( $key, $selectedValue ) == 0 )
                    {
                        $selectedIndex = $i;
                        $selectedText = $value;
                    }

                    ++$i;
                }
            }
        }
        else
        {
            foreach( $this->_Items as $k => $v )
            {
                $contents .= $this->dumpItem( $i, ( $isKeyValue ? $k : $v ), $v, $isKeyValue, $selectedText );

                if( $selectedValue === false && $this->_ItemIndex !== false && $this->_ItemIndex == $i )
                {
                    $selectedValue = $k;
                    $selectedText = $v;
                    $selectedIndex = $i;
                }
                else if( $selectedIndex === false && $selectedValue !== false && strcmp( ( $isKeyValue ? $k : $v ), $selectedValue ) == 0 )
                {
                    $selectedIndex = $i;
                    $selectedValue = $k;
                    $selectedText = $v;
                }

                ++$i;
            }
        }

        $styles = GetJTFontString( $this->StyleFont );

        $vars = array(
            'CONTENT'       => $contents,
            'EVENTS'        => $this->JsEvents,
            'DISABLED'      => ( $this->_Enabled ? '' : ' disabled="disabled"' ),
            'SELECTEDINDEX' => ( $selectedIndex !== false ? $selectedIndex : -1 ),
            'STYLES'        => $styles,
            'TABINDEX'      => ( $this->_TabStop ? $this->_TabOrder : -1 ),
            'TEXT'          => ( $selectedText !== false ? $selectedText : '' ),
            'VALUE'         => ( $selectedValue !== false ? $selectedValue : '' ),
        );

        print( $this->generateComponentSectionCode( 'combobox', $vars ) );
    }

    protected function dumpItem( $i, $key, $text, $isKeyValue )
    {
        $vars = array(
            'CONTENT'   => $text,
            'VALUE'     => $key
        );

        return $this->generateComponentSectionCode( $isKeyValue ? 'item-with-key' : 'item', $vars );
    }

    protected function dumpControlFooter()
    {
        print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

        $this->dumpBodyJavaScript();

        print( "</script>\r\n" );
    }

    function dumpBodyJavaScript()
    {
        $params = array
        (
            'AutoDropDown'  => (bool)$this->_AutoDropDown,
            'DropDownCount' => $this->_DropDownCount,
            'IsKeyValue'    => $this->isKeyValue(),
            'Name'          => $this->Name,
            'Style'         => $this->_Style,
            'OnChange'      => $this->jsOnChange,
            'OnBlur'        => $this->jsOnBlur,
            'OnFocus'       => $this->jsOnFocus,
        );

        print( "JTComboBoxInitialize(" . json_encode( $params ) . ");\r\n" );
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
            $ajaxResponse->script( "JTComboBoxCleanup( '" . $this->Name . "' );\r\n" );
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            print( "JTComboBoxCleanup( '" . $this->Name . "' );\r\n" );
            print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }

        $this->dumpBodyJavaScript();
    }

    protected function isKeyValue()
    {
        if( $this->_lookupdatasource )
        {
            return (bool)$this->_LookupTextField;
        }
        else
        {
            reset( $this->_Items );

            return !is_int( key( $this->_Items ) );
        }
    }

    function addItem( $item, $value = null )
    {
        if( $value === null )
            $this->_Items[] = $item;
        else
            $this->_Items[ $value ] = $item;

        return count( $this->_Items ) - 1;
    }

    function deleteItem( $index )
    {
        array_splice( $this->_Items, $index, 1 );
    }

    function insertItem( $index, $item, $value = null )
    {
        if( $value !== null )
            $index = array_search( $value, array_keys( $this->_Items ) );

        array_splice( $this->_Items, $index, 0, array( $item ) );
    }

    function removeItem( $item )
    {
        $this->deleteItem( array_search( $item, array_values( $this->_Items ) ) );
    }

    function removeItemByKey( $item )
    {
        unset( $this->_Items[ $item ] );
    }

    function replaceItem( $index, $newItem )
    {
        $this->_Items[ $index ] = $newItem;
    }

    function readText()
    {
        return $this->getSelectedText();
    }

    function getAutoDropDown()
    {
        return $this->_AutoDropDown;
    }

    function setAutoDropDown( $value )
    {
        $this->_AutoDropDown = $value;
    }

    function defaultAutoDropDown()
    {
        return 0;
    }

    function getDatasource()
    {
        return $this->_datasource;
    }

    function setDatasource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getDataField()
    {
        return $this->_datafield;
    }

    function setDataField( $value )
    {
        $this->_datafield = $value;
    }

    function getDropDownCount()
    {
        return $this->_DropDownCount;
    }

    function setDropDownCount( $value )
    {
        $this->_DropDownCount = $value;
    }

    function defaultDropDownCount()
    {
        return 8;
    }

    function getEnabled()
    {
        return $this->_Enabled;
    }

    function setEnabled( $value )
    {
        $this->_Enabled = $value;
    }

    function defaultEnabled()
    {
        return true;
    }

    function getItems()
    {
        return $this->_Items;
    }

    function setItems( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        $this->_Items = $value;
    }

    function getItemIndex()
    {
        return ( $this->_ItemIndex !== false ? $this->_ItemIndex : -1 );
    }

    function setItemIndex( $value )
    {
        $value = (int)$value;
        if( $value < -1 )
            $value = -1;

        $this->_ItemIndex = $value;

        if( ( $this->ControlState & csLoading ) == 0 )
        {
            $this->_SelectedText = false;
            $this->_SelectedValue = false;
        }
    }

    function defaultItemIndex()
    {
        return -1;
    }

    function getLookupDatasource()
    {
        return $this->_lookupdatasource;
    }

    function setLookupDatasource( $value )
    {
        $this->_lookupdatasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getLookupTextField()
    {
        return $this->_LookupTextField;
    }

    function setLookupTextField( $value )
    {
        $this->_LookupTextField = $value;
    }

    function getLookupValueField()
    {
        return $this->_LookupValueField;
    }

    function setLookupValueField( $value )
    {
        $this->_LookupValueField = $value;
    }

    function getSelectedText()
    {
        return ( $this->_SelectedText !== false ? $this->_SelectedText : '' );
    }

    function setSelectedText( $value )
    {
        $this->_SelectedText = $value;

        if( ( $this->ControlState & csLoading ) == 0 )
        {
            $this->_SelectedValue = false;
            $this->_ItemIndex = false;
        }
    }

    function defaultSelectedText()
    {
        return '';
    }

    function getSelectedValue()
    {
        return ( $this->_SelectedValue !== false ? $this->_SelectedValue : '' );
    }

    function setSelectedValue( $value )
    {
        $this->_SelectedValue = $value;

        if( ( $this->ControlState & csLoading ) == 0 )
        {
            $this->_SelectedText = false;
            $this->_ItemIndex = false;
        }
    }

    function defaultSelectedValue()
    {
        return '';
    }

    function getStyle()
    {
        return $this->_Style;
    }

    function setStyle( $value )
    {
        $this->_Style = $value;
    }

    function defaultStyle()
    {
        return JTComboBox::DropDownList;
    }

    function getStyleFont()
    {
        return $this->readStyleFont();
    }

    function setStyleFont( $value )
    {
        $this->writeStyleFont( $value );
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

    function getjsOnBlur()
    {
        return $this->readjsOnBlur();
    }

    function setjsOnBlur( $value )
    {
        $this->writejsOnBlur( $value );
    }

    function getjsOnFocus()
    {
        return $this->readjsOnFocus();
    }

    function setjsOnFocus( $value )
    {
        $this->writejsOnFocus( $value );
    }

    function getjsOnChange()
    {
        return $this->readjsOnChange();
    }

    function setjsOnChange( $value )
    {
        $this->writejsOnChange( $value );
    }
}
?>
