<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                    -- Base navigation component --
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtphp.inc.php" );
//use_unit( "jtphplogger/jtphplogger.inc.php" );

abstract class JTBaseNavigation extends JTThemedGraphicControl
{
    protected $_onclick;
    protected $_ImageList = null;
    protected $_RootItem;

    protected $ImageListInst = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_RootItem = new JTNavigationItem();

        if( !defined( 'NO_VCL' ) )
        {
            $this->ControlStyle = 'csRenderOwner=1';
            $this->ControlStyle = 'csRenderAlso=JTSiteTheme,ImageList';
        }
    }

    function loaded()
    {
        parent::loaded();

        $this->setImageList( $this->_ImageList );
    }

    function init()
    {
        parent::init();

        $submitEventValue = $this->input->{$this->JSWrapperHiddenFieldName};
        if( is_object( $submitEventValue ) && $submitEventValue->asString() )
        {
            if( $this->_onclick )
            {
                $submit = $submitEventValue->asString();
                $i = strrpos( $submit, '_' );
                if( $i !== false )
                    $submit = substr( $submit, $i + 1 );

                $item = $this->findItemByName( $submit );

                if( $item )
                {
                    $this->callEvent( 'onclick', array( $submitEventValue->asString(), $item->index(), $item->Name,
                        $item, $item->Tag ) );
                }
            }
        }
    }

    function allowserialize( $propname )
    {
        if( $propname == 'Items' )
            return false;

        return parent::allowserialize( $propname );
    }

    function serialize()
    {
        parent::serialize();

        $_SESSION[ $this->readNamePath() . '._Items' ] = $this->itemsToArray();
    }

    function unserialize()
    {
        parent::unserialize();

        if( isset( $_SESSION[ $this->readNamePath() . '._Items' ] ) )
            $this->itemsFromArray( $_SESSION[ $this->readNamePath() . '._Items' ] );
    }

    function dumpContents()
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning && $this->_ImageList )
            $this->ImageListInst = $this->propertyToObject( $this->_ImageList );
        else
            $this->ImageListInst = $this->_ImageList;

        parent::dumpContents();
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
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );
        }
        else
        {
            $contents = str_replace( "\r\n", " ", $contents );
            $contents = str_replace( "\n", " ", $contents );
            $contents = str_replace( '"', '\"', $contents );

            echo( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }

        $this->dumpBodyJavaScript();
    }

    /**
    * @return JTNavigationItem The item added to the list.
    */
    function addItem()
    {
        return $this->_RootItem->addSubItem();
    }

    function clearItems()
    {
        $this->_RootItem->clearSubItems();
    }

    function deleteItem( $item )
    {
        return $this->_RootItem->deleteSubItem( $item );
    }

    function deleteItemByIndex( $index )
    {
        return $this->_RootItem->deleteSubItemByIndex( $index );
    }

    function deleteItemByName( $name )
    {
        return $this->_RootItem->deleteSubItemByName( $name );
    }

    function findItemByName( $name )
    {
        return $this->_RootItem->findSubItemByName( $name );
    }

    function insertItem( $index )
    {
        return $this->_RootItem->insertSubItem( $index );
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

    protected function itemsFromArray( $items )
    {
        $this->_RootItem->subItemsFromArray( $items );
    }

    private function itemsToArray()
    {
        return $this->_RootItem->subItemsToArray();
    }

    function readItems()
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning || ( $this->ControlState & csLoading ) == csLoading )
            return $this->itemsToArray();

        return $this->_RootItem->SubItems;
    }

    function writeItems( $value )
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning ||
            ( $this->ControlState & csLoading ) == csLoading )
        {
            $this->itemsFromArray( $value );
        }
        else
        {
            $this->_RootItem->SubItems = $value;
        }
    }

    function getImageList()
    {
        return $this->_ImageList;
    }

    function setImageList( $value )
    {
        $this->_ImageList = $this->fixupPropertyAndCheck( $value, 'ImageList' );
    }

    function readRootItem()
    {
        return $this->_RootItem;
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

class JTNavigationItem
{
    /**
    * @return JTNavigationItem The item that was added to the collection
    */
    function addSubItem()
    {
        $item = new JTNavigationItem();
        $item->Parent = $this;

        $this->SubItems[] = $item;

        return $item;
    }

    function clearSubItems()
    {
        $this->SubItems = array();
    }

    function deleteSubItem( $item )
    {
        $item->Parent = null;

        $i = array_search( $item, $this->SubItems, true );
        if( $i > -1 )
            array_splice( $this->SubItems, $i, 1 );
    }

    function deleteSubItemByIndex( $index )
    {
        $this->SubItems[ $index ]->Parent = null;

        array_splice( $this->SubItems, $index, 1 );
    }

    function deleteSubItemByName( $name )
    {
        $this->deleteSubItem( $this->findSubItemByName( $name ) );
    }

    function findSubItemByName( $name )
    {
        foreach( $this->SubItems as $item )
        {
            if( $item->Name == $name )
                return $item;

            $found = $item->findSubItemByName( $name );
            if( $found )
                return $found;
        }

        return null;
    }

    function index()
    {
        return array_search( $this, $this->Parent->SubItems, true );
    }

    function insertSubItem( $index )
    {
        $item = new JTNavigationItem();
        $item->Parent = $this;

        array_splice( $this->SubItems, $index, 0, $item );

        return $item;
    }

    function subItemsToArray()
    {
        $result = array();

        foreach( $this->SubItems as $item )
        {
            $result[] = array(
                'Caption'       => $item->Caption,
                'Enabled'       => $item->Enabled,
                'ImageIndex'    => $item->ImageIndex,
                'Link'          => $item->Link,
                'Name'          => $item->Name,
                'SubItems'      => $item->subItemsToArray(),
                'Tag'           => $item->Tag,
                'Visible'       => $item->Visible
            );
        }

        return $result;
    }

    function subItemsFromArray( $items )
    {
        $this->SubItems = array();

        if( !is_array( $items ) )
            $items = unserialize( $items );

        foreach( $items as $itemData )
        {
            if( !is_array( $itemData ) )
                $itemData = unserialize( $itemData );

            $item = $this->addSubItem();
            $item->Caption = $itemData[ 'Caption' ];
            $item->Enabled = $itemData[ 'Enabled' ];
            $item->Name = $itemData[ 'Name' ];
            $item->Visible = $itemData[ 'Visible' ];

            if( isset( $itemData[ 'ImageIndex' ] ) )
                $item->ImageIndex = $itemData[ 'ImageIndex' ];

            if( isset( $itemData[ 'Link' ] ) )
                $item->Link = $itemData[ 'Link' ];

            if( isset( $itemData[ 'Tag' ] ) )
                $item->Tag = $itemData[ 'Tag' ];

            $item->subItemsFromArray( $itemData[ 'SubItems' ] );
        }
    }

    public $Caption = '';
    public $Enabled = true;
    public $ImageIndex = '';
    public $Link = '';
    public $Name = '';
    public $Parent = null;
    public $SubItems = array();
    public $Tag = '';
    public $Visible = true;
}