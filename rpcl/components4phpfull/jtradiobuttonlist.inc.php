<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                   -- Radio button list component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTRadioButtonList extends JTThemedGraphicControl
{
    protected $_datafield = '';
    protected $_datasource = null;
    protected $_TextClass = 'fsDefault';
    protected $_Items = array();
    protected $_SelectedItem = '';
    protected $_ItemIndex = -1;
    protected $_Columns = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 200;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDataSource( $this->_datasource );
    }

    function preinit()
    {
        parent::preinit();

        $v = $this->input->{ $this->Name };
        if( is_object( $v ) )
        {
            $this->SelectedItem = $v->asString();

            if( !$this->_datasource || !$this->_datafield )
            {
                foreach( $this->_Items as $i => $item )
                {
                    if( $i == $this->SelectedItem )
                    {
                        $this->ItemIndex = $i;
                        break;
                    }
                }
            }
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'radiobuttonlist' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'label' ) );
        }
    }

    protected function dumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " style=\"$style\"";

        $contents = '';

        $events = ( $this->jsOnClick ? ' onclick="' . $this->jsOnClick . '(event)"' : '' );
        $events .= ( $this->jsOnClick ? ' onblur="' . $this->jsOnBlur . '(event)"' : '' );
        $events .= ( $this->jsOnClick ? ' onfocus="' . $this->jsOnClick . '(event)"' : '' );

        $vars = array(
            'EVENTS'        => $events,
            'TEXTCLASS'     => $this->_TextClass,
            'STYLE'         => $style,
        );

        $tabindex = $this->_TabStop ? $this->_TabOrder : -1;

        if( $this->_datasource && $this->_datafield )
        {
            $items = array();

            if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_datasource->DataSet )
            {
                $field = $this->_datafield;

                for( $this->_datasource->DataSet->First(); !$this->_datasource->DataSet->EOF; $this->_datasource->DataSet->Next() )
                    $items[] = $this->_datasource->DataSet->Fields[ $field ];
            }
        }
        else
        {
            $items = $this->_Items;
        }

        $rowContents = '';
        $j = 0;

        foreach( $items as $i => $item )
        {
            if( $this->SelectedItem != '' )
                $checked = ( $this->SelectedItem == $item );
            else
                $checked = ( $i == $this->_ItemIndex );

            $vars[ 'INDEX' ] = $i;
            $vars[ 'CONTENT' ] = $item;
            $vars[ 'STATE' ] = ( $checked ? 'checked' : '' );
            $vars[ 'TABINDEX' ] = $tabindex;

            $rowContents .= $this->generateComponentSectionCode( 'radiobutton', $vars );

            if( ++$j >= $this->_Columns )
            {
                $vars[ 'CONTENT' ] = $rowContents;

                $contents .= $this->generateComponentSectionCode( 'radiobuttonrow', $vars );
                $j = 0;
                $rowContents = '';
            }

            if( $tabindex > 0 )
                ++$tabindex;
        }

        if( $j > 0 )
        {
            $vars[ 'CONTENT' ] = $rowContents;

            $contents .= $this->generateComponentSectionCode( 'radiobuttonrow', $vars );
        }

        $vars = array(
            'CONTENT'       => $contents,
        );

        print( $this->generateComponentSectionCode( 'radiobuttonlist', $vars ) );
    }

    function getDataField()
    {
        return $this->_datafield;
    }

    function setDataField( $value )
    {
        $this->_datafield = $value;
    }

    function defaultDataField()
    {
        return '';
    }

    function getDataSource()
    {
        return $this->_datasource;
    }

    function setDataSource( $value )
    {
        $this->_datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDataSource()
    {
        return null;
    }

    function getItemIndex()
    {
        return $this->_ItemIndex;
    }

    function setItemIndex( $value )
    {
        if( $value < -1 || $value >= count( $this->Items ) )
            return;

        $this->_SelectedItem = ( $value == -1 ) ? '' : $this->_Items[ $value ];

        $this->_ItemIndex = $value;
    }

    function defaultItemIndex()
    {
        return -1;
    }

    function getColumns()
    {
        return $this->_Columns;
    }

    function setColumns( $value )
    {
        $this->_Columns = max( $value, 1 );
    }

    function defaultColumns()
    {
        return 1;
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

    function getSelectedItem()
    {
        return $this->_SelectedItem;
    }

    function setSelectedItem( $value )
    {
        if( $value == '' )
            $this->_ItemIndex = -1;
        else
            $this->_ItemIndex = array_search( $value, $this->_Items );

        $this->_SelectedItem = $value;
    }

    function defaultSelectedItem()
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

    function getjsOnClick()
    {
        return $this->readjsOnClick();
    }

    function setjsOnClick( $value )
    {
        $this->writejsOnClick($value);
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
}
?>