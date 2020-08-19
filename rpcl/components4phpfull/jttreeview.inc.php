<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                       -- Tree view component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTTreeView extends JTThemedGraphicControl
{
    protected $_CaptionField;
    protected $_Datasource = null;
    protected $_KeyField;
    protected $_Items = array();
    protected $_LinkField;
    protected $_ParentField;
    protected $_SelectedNode = null;

    protected $_onclick = null;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 200;
        $this->Height = 350;

        if( ( $this->ControlState & csDesigning ) != csDesigning )
            $this->_Items = new JTTreeNodes( $this );
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatasource( $this->Datasource );
    }

    function init()
    {
        parent::init();

        $this->initSelectedNode();

        $submitEventValue = $this->input->{$this->JSWrapperHiddenFieldName};
        if( is_object( $submitEventValue ) )
        {
            if( $this->_onclick )
                $this->callEvent( 'onclick', array( $submitEventValue->asString() ) );
        }
    }

    function unserialize()
    {
        parent::unserialize();

        if( ( $this->ControlState & csDesigning ) != csDesigning && is_array( $this->_Items ) )
            $this->_Items = $this->arrayItemsToTreeNodes( $this->_Items );
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'tree' ) );
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\"" . ( ( !$this->_DumpDimensions ) ? ' style="height: 100%; width: 100%;"' : '' ) . ">\r\n" );

        $this->internalDumpThemedContents();

        echo( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $style = GetJTFontString( $this->StyleFont );
        if( $style )
            $style = " $style";

        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

        $content = $this->renderTree( $style, $tabindex );

        $vars = array(
            'CONTENT'       => $content,
            'TABINDEX'      => $tabindex,
        );

        echo( $this->generateComponentSectionCode( 'tree', $vars ) );
    }

    protected function renderTree( $fontStyle )
    {
        $result = '';
        $nodeName = $this->Name;

        if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_Datasource && $this->_KeyField )
            $this->_Items = $this->dataSetToTreeNodes();

        if( is_object( $this->_Items ) )
            $items = $this->_Items;
        else
            $items = $this->arrayItemsToTreeNodes( $this->_Items );

        foreach( $items->ChildNodes as $i => $childNode )
            $result .= $this->renderNodeAndChildren( $i, $childNode, $nodeName . '_' . $i, $fontStyle );

        return $result;
    }

    protected function renderNodeAndChildren( $i, $node, $nodeName, $fontStyle )
    {
        $children = '';

        foreach( $node->ChildNodes as $i => $childNode )
            $children .= $this->renderNodeAndChildren( $i, $childNode, $nodeName . '_' . $i, $fontStyle );

        $vars = array(
            'CHILDREN'      => $children,
            'INDEX'         => $i,
            'NODENAME'      => $nodeName,
            'CAPTION'       => $node->Caption,
            'LINK'          => $node->Link,
            'STYLE'         => $fontStyle,
        );

        $codeID = ( $node->Count > 0 ) ? 'node_with_children' : 'node_without_children';

        if( $node->Link )
            $codeID .= '_link';

        return $this->generateComponentSectionCode( $codeID, $vars );
    }

    protected function dumpControlFooter()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            echo( "<input type=\"hidden\" name=\"" . $this->JSWrapperHiddenFieldName . "\" value=\"\" />\r\n" );
            echo( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            echo( "</script>\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        if( $this->_SelectedNode )
        {
            $node = $this->_SelectedNode;
            $nl = array();

            while( $node )
            {
                $nl[] = $node->Index;
                $node = $node->ParentNode;
            }

            $nl = array_reverse( $nl );
            $selectedNode = $this->Name . '_' . implode( '_', $nl );
        }
        else
        {
            $selectedNode = '';
        }

        $d = $this->input->{ $this->Name . '_cn' };
        if( is_object( $d ) )
            $collapsedNodes = $d->asString();
        else
            $collapsedNodes = '';

        echo( "JTTreeViewInitialize( '" . $this->Name . "', '$selectedNode', '$collapsedNodes', " . GetJTJSEventToString( $this->_jsonclick ) . ', ' . GetJTJSBoolean( $this->_onclick ) . ', document.' . $this->owner->Name . ', document.' . $this->owner->Name . '.' . $this->JSWrapperHiddenFieldName . " );\r\n" );
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

    function dumpJSEvent( $event )
    {
        if( $event )
        {
            print( "function $event( event, params )\r\n" );
            print( "{\r\n" );
            print( "    var event = event || window.event;\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function unserializeNode( &$node )
    {
        if( !is_array( $node ) )
            $node = unserialize( $node );

        if( $node[ 'Items' ] )
        {
            if( !is_array( $node[ 'Items' ] ) )
                $node[ 'Items' ] = unserialize( $node[ 'Items' ] );

            foreach( $node[ 'Items' ] as &$childNode )
                $this->unserializeNode( $childNode );
        }
        else
        {
            $node[ 'Items' ] = array();
        }
    }

    protected function arrayItemsToTreeNodes( $itemsArray )
    {
        $result = new JTTreeNodes( null );
        $result->initializeFromItemArray( $itemsArray );

        $result = new JTTreeNodes( $this );
        $result->initializeFromItemArray( $itemsArray );

        return $result;
    }

    protected function dataSetToTreeNodes()
    {
        $result = new JTTreeNodes( $this );
        $result->initializeFromDataSet( $this->_Datasource->DataSet, $this->_KeyField, $this->_ParentField,
            $this->_CaptionField, $this->_LinkField );

        return $result;
    }

    protected function initSelectedNode()
    {
        $this->_SelectedNode = null;

        $d = $this->input->{ $this->Name . '_sn' };
        if( !is_object( $d ) || $d->asString() == '' )
            return;

        $nl = explode( '_', $d->asString() );

        array_shift( $nl );

        $node = $this->_Items;

        foreach( $nl as $nodeIndex )
        {
            if( isset( $node->ChildNodes[ $nodeIndex ] ) )
            {
                $node = $node->ChildNodes[ $nodeIndex ];
            }
            else
            {
                $node = null;
                break;
            }
        }

        $this->_SelectedNode = $node;
    }

    function getCaptionField()
    {
        return $this->_CaptionField;
    }

    function setCaptionField( $value )
    {
        $this->_CaptionField = $value;
    }

    function defaultCaptionField()
    {
        return '';
    }

    function getDatasource()
    {
        return $this->_Datasource;
    }

    function setDatasource( $value )
    {
        $this->_Datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getKeyField()
    {
        return $this->_KeyField;
    }

    function setKeyField( $value )
    {
        $this->_KeyField = $value;
    }

    function defaultKeyField()
    {
        return '';
    }

    function getItems()
    {
        return $this->_Items;
    }

    function setItems( $value )
    {
        if( !is_object( $value ) )
        {
            if( !is_array( $value ) )
                $value = unserialize( $value );

            foreach( $value as &$node )
                $this->unserializeNode( $node );
        }

        $this->_Items = $value;
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

    function getParentField()
    {
        return $this->_ParentField;
    }

    function setParentField( $value )
    {
        $this->_ParentField = $value;
    }

    function defaultParentField()
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

    function readSelectedNode()
    {
        return $this->_SelectedNode;
    }

    function writeSelectedNode( $value )
    {
        if( is_object( $value ) )
            $this->_SelectedNode = $value;
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

class JTTreeNodes extends Persistent
{
    protected $_Owner;
    protected $_ChildNodes = array();

    function __construct( $owner )
    {
        $this->_Owner = $owner;
    }

    function serialize()
    {
        parent::serialize();

        $_SESSION[ $this->readNamePath() . '.ChildNodes' ] = serialize( $this->_ChildNodes );
    }

    function unserialize()
    {
        parent::unserialize();

        if( $this->inSession( '' ) )
            $this->_ChildNodes = unserialize( $_SESSION[ $this->readNamePath() . '.ChildNodes' ] );
    }

    function initializeFromItemArray( $itemsArray )
    {
        foreach( $itemsArray as $item )
        {
            $node = new JTTreeNode( count( $this->_ChildNodes ) );
            $node->initializeFromArrayItem( $item );

            $this->_ChildNodes[] = $node;
        }
    }

    function initializeFromDataSet( $dataSet, $keyField, $parentField, $captionField, $linkField )
    {
        $i = 0;
        $idToObject = array();
        $possibleOrphans = array();

        for( $dataSet->First(); !$dataSet->Eof; $dataSet->Next() )
        {
            $row = $dataSet->Fields;
            $id = $row[ $keyField ];
            $parent = $row[ $parentField ];

            if( $id == $parent )
                throw new Exception( "Found self-referencing tree node in dataset. " . $this->_KeyField . " and " . $this->_ParentField . " = '$id'." );

            if( !isset( $idToObject[ $id ] ) )
            {
                $node = new JTTreeNode();
                $idToObject[ $id ] = $node;
            }
            else
            {
                $node = $idToObject[ $id ];
            }

            $node->Caption = $row[ $captionField ];
            $node->Key = $id;
            $node->Link = $row[ $linkField ];

            if( $parent )
            {
                if( !isset( $idToObject[ $parent ] ) )
                {
                    $node->ParentID = $parent;
                    $possibleOrphans[] = $node;
                }
                else
                {
                    $parentNode = $idToObject[ $parent ];

                    if( $parentNode->IsParent( $node ) )
                        throw new Exception( "Found recursive parent in dataset. $keyField = '$id'." );

                    $parentNode->AddChild( $node );
                }
            }
            else
            {
                $this->AddChild( $node );
            }
        }

        $oddEvenIndex = 0;
        $rowIndex = -1;
        $groupIndex = 0;

        foreach( $possibleOrphans as $node )
        {
            if( isset( $idToObject[ $node->ParentID ] ) )
            {
                $parentNode = $idToObject[ $node->ParentID ];

                if( $parentNode->IsParent( $node ) )
                    throw new Exception( "Found recursive parent in dataset. " . $this->_KeyField . " = '$id'." );

                $parentNode->AddChild( $node );
            }
            else
            {
                $this->AddChild( $node );
            }
        }

        unset( $possibleOrphans );
    }

    function AddChild( $node = null )
    {
        if( !$node )
            $node = new JTTreeNode( count( $this->_ChildNodes ) );
        else
            $node->SetIndex( count( $this->_ChildNodes ) );

        $this->_ChildNodes[] = $node;

        $node->SetParentNode( null );

        return $node;
    }

    function Clear()
    {
        $this->_ChildNodes = array();
    }

    function InsertChild( $indexOrNode )
    {
        if( is_object( $indexOrNode ) )
        {
            $indexOrNode = array_search( $indexOrNode, $this->_ChildNodes, true );
            if( $indexOrNode === false )
                return;
        }

        $node = new JTTreeNode( $indexOrNode );

        array_splice( $this->_ChildNodes, $indexOrNode, 0, array( $node ) );

        for( $i = $indexOrNode + 1; $i < count( $this->_ChildNodes ); ++$i )
            $this->_ChildNodes[ $i ]->SetIndex( $i );

        $node->SetParentNode( null );

        return $node;
    }

    function RemoveChild( $indexOrNode )
    {
        if( is_object( $indexOrNode ) )
        {
            $indexOrNode = array_search( $indexOrNode, $this->_ChildNodes, true );
            if( $indexOrNode === false )
                return;
        }

        array_splice( $this->_ChildNodes, $indexOrNode, 1 );
    }

    function readCount()
    {
        return count( $this->_ChildNodes );
    }

    function readChildNodes()
    {
        return $this->_ChildNodes;
    }

    function writeChildNodes( $value )
    {
        if( is_array( $value ) )
            $this->_ChildNodes = $value;
    }

    function readOwner()
    {
        return $this->_Owner;
    }
}

class JTTreeNode extends Object
{
    protected $_Caption = '';
    protected $_ChildNodes = array();
    protected $_Index = -1;
    protected $_Key;
    protected $_Link = '';
    protected $_ParentNode = null;

    public $ParentID;

    function __construct( $index = -1, $parentNode = null )
    {
        $this->_Index = $index;
        $this->_ParentNode = $parentNode;
    }

    function initializeFromArrayItem( $arrayItem )
    {
        $this->Caption = $arrayItem[ 'Caption' ];

        if( isset( $arrayItem[ 'Link' ] ) )
            $this->_Link = $arrayItem[ 'Link' ];

        if( is_array( $arrayItem[ 'Items' ] ) )
        {
            foreach( $arrayItem[ 'Items' ] as $item )
            {
                $node = new JTTreeNode( count( $this->_ChildNodes ), $this );
                $node->initializeFromArrayItem( $item );

                $this->_ChildNodes[] = $node;
            }
        }
    }

    function AddChild( $node = null )
    {
        if( !$node )
        {
            $node = new JTTreeNode( count( $this->_ChildNodes ), $this );
        }
        else
        {
            $node->SetIndex( count( $this->_ChildNodes ) );
            $node->SetParentNode( $this );
        }

        $this->_ChildNodes[] = $node;

        return $node;
    }

    function InsertChild( $indexOrNode )
    {
        if( is_object( $indexOrNode ) )
        {
            $indexOrNode = array_search( $indexOrNode, $this->_ChildNodes, true );
            if( $indexOrNode === false )
                return;
        }

        $node = new JTTreeNode( $indexOrNode, $this );

        array_splice( $this->_ChildNodes, $indexOrNode, 0, array( $node ) );

        for( $i = $indexOrNode + 1; $i < count( $this->_ChildNodes ); ++$i )
            $this->_ChildNodes[ $i ]->SetIndex( $i );

        return $node;
    }

    function IsParent( $parent )
    {
        $parentNode = $this;

        while( $parentNode )
        {
            if( $parent === $parentNode )
                return true;

            $parentNode = $parentNode->ParentNode;
        }

        return false;
    }

    function RemoveChild( $indexOrNode )
    {
        if( is_object( $indexOrNode ) )
        {
            $indexOrNode = array_search( $indexOrNode, $this->_ChildNodes, true );
            if( $indexOrNode === false )
                return;
        }

        array_splice( $this->_ChildNodes, $indexOrNode, 1 );
    }

    function SetIndex( $index )
    {
        $this->_Index = $index;
    }

    function SetParentNode( $parent )
    {
        $this->_ParentNode = $parent;
    }

    function getCaption()
    {
        return $this->_Caption;
    }

    function setCaption( $value )
    {
        $this->_Caption = $value;
    }

    function getChildNodes()
    {
        return $this->_ChildNodes;
    }

    function getCount()
    {
        return count( $this->_ChildNodes );
    }

    function getIndex()
    {
        return $this->_Index;
    }

    function getKey()
    {
        return $this->_Key;
    }

    function setKey( $value )
    {
        $this->_Key = $value;
    }

    function getLink()
    {
        return $this->_Link;
    }

    function setLink( $value )
    {
        $this->_Link = $value;
    }

    function getParentNode()
    {
        return $this->_ParentNode;
    }
}
?>
