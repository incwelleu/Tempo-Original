<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- XML Data source component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );
use_unit( "db.inc.php" );

// Global XML data drivers array
global $JTXMLDataSourceDrivers;

$JTXMLDataSourceDrivers = array();

// Driver registration function
function JTXMLDataSourceRegisterDriver( $name, $class )
{
    global $JTXMLDataSourceDrivers;

    // Check that the class is correctly decelared.
    if( !is_subclass_of( $class, 'JTXMLDataSourceDriver' ) )
        throw new Exception( "JTXMLDataSource driver $class is not derived from JTXMLDataSourceDriver." );

    $JTXMLDataSourceDrivers[ $name ] = $class;
}

// Global property name cache for JTXMLDataSource
global $JTXMLDataSourcePropertyNames;

$JTXMLDataSourcePropertyNames = array();

class JTXMLDataSource extends DataSet
{
    protected $_Driver = '';
    protected $_DriverInst = null;
    protected $_FileName = '';
    protected $_rs = null;

    public $Field = null;

    function __construct( $aowner = null )
    {
        global $JTXMLDataSourceDrivers;

        parent::__construct( $aowner );

        if( count( $JTXMLDataSourceDrivers ) > 0 )
        {
            reset( $JTXMLDataSourceDrivers );

            $this->_Driver = key( $JTXMLDataSourceDrivers );
        }

        $this->Field = new JTXMLDataSourceFields( $this );

        $this->CacheProperties();
    }

    function MoveBy( $distance )
    {
        parent::MoveBy( $distance );

        $this->UpdateCursor();
    }

    function FieldByName( $fieldname )
    {
        if( $this->Active )
            return $this->_DriverInst->Fields[ $fieldname ];

        return '';
    }

    function SetFieldByName( $fieldname, $value )
    {
        if( $this->Active )
            $this->_DriverInst->Fields[ $fieldname ] = $value;
    }

    function InternalFirst()
    {
        $this->_recno = 0;
        $this->UpdateCursor();
    }

    function InternalLast()
    {
        $this->_recno = $this->RecordCount - 1;
        $this->UpdateCursor();
    }

    function InternalOpen()
    {
        global $JTXMLDataSourceDrivers;

        if( empty( $this->_Driver ) )
            throw Exception( $this->Name . "->Driver is empty, cannot instantiate driver." );

        $driver = $JTXMLDataSourceDrivers[ $this->_Driver ];

        if( empty( $driver ) )
            throw Exception( $this->_Driver . " not valid JTXMLDataSource driver." );

        if( empty( $this->_FileName ) )
            throw Exception( $this->Name . "->FileName is empty, cannot open DataSet." );

        if( !file_exists( $this->_FileName ) )
            throw Exception( $this->_FileName . " does not exists, cannot open DataSet." );

        $this->_DriverInst = new $driver( $this->_FileName );
        $this->_rs = 1;
    }

    function InternalClose()
    {
        $this->_rs = null;
        $this->_DriverInst = null;
    }

    function InternalDelete()
    {
        $this->_DriverInst->delete();
    }

    function InternalPost()
    {
        $this->_DriverInst->post( ( $this->State == dsInsert ) );
    }

    function InternalInsert()
    {
        $this->_DriverInst->clearFieldValues();
    }

    protected function UpdateCursor()
    {
        $this->_DriverInst->gotoRecord( $this->_recno );
    }

    protected function CacheProperties()
    {
        global $JTXMLDataSourcePropertyNames;

        if( empty( $JTXMLDataSourcePropertyNames ) )
        {
            $methods = get_class_methods( $this );

            foreach( $methods as $method )
            {
                if( $method[ 0 ] == 'g' && $method[ 1 ] == 'e' && $method[ 2 ] == 't' )
                {
                    $JTXMLDataSourcePropertyNames[] = substr( $method, 3 );
                }
                else if( $method[ 0 ] == 'r' && $method[ 1 ] == 'e' && $method[ 2 ] == 'a' && $method[ 3 ] == 'd' )
                {
                    $JTXMLDataSourcePropertyNames[] = substr( $method, 4 );
                }
            }
        }
    }

    function getActive()
    {
        return $this->readactive();
    }

    function setActive( $value )
    {
        $this->writeactive( $value );
    }

    function getDriver()
    {
        return $this->_Driver;
    }

    function setDriver( $value )
    {
        global $JTXMLDataSourceDrivers;

        if( isset( $JTXMLDataSourceDrivers[ $value ] ) )
            $this->_Driver = $value;
    }

    function getFileName()
    {
        return $this->_FileName;
    }

    function setFileName( $value )
    {
        if( $this->Active )
            $this->Close();

        $this->_FileName = $value;
    }

    function readAssociativeFieldValues()
    {
        if( $this->Active )
            return $this->_DriverInst->Fields;

        return array();
    }

    function readBOF()
    {
        if( $this->Active )
            return $this->_DriverInst->getBOF();

        return 0;
    }

    function readEOF()
    {
        if( $this->Active )
            return $this->_DriverInst->getEOF();

        return 0;
    }

    function readRecordCount()
    {
        if( $this->Active )
            return $this->_DriverInst->getRecordCount();

        return 0;
    }

    function readFields()
    {
        if( $this->Active )
            return $this->_DriverInst->Fields;

        return array();
    }

    function readFieldCount()
    {
        if( $this->Active )
            return count( $this->_DriverInst->Fields );

        return 0;
    }

    function readFieldProperties( $fieldname )
    {
        return false;
    }

    function getHelp()
    {
        return get_class( $this );
    }

    function setHelp( $value )
    {
    }

    function defaultHelp()
    {
        return get_class( $this );
    }

    function __get( $nm )
    {
        global $JTXMLDataSourcePropertyNames;

        if( !in_array( $nm, $JTXMLDataSourcePropertyNames ) && $this->Active && in_array( $nm, $this->_DriverInst->Fields ) )
            return $this->_DriverInst->Fields[ $nm ];

        return parent::__get( $nm );
    }

    function __set( $nm, $val )
    {
        global $JTXMLDataSourcePropertyNames;

        if( !in_array( $nm, $JTXMLDataSourcePropertyNames ) && $this->Active && in_array( $nm, $this->_DriverInst->Fields ) )
            $this->_DriverInst->Fields[ $nm ] = $val;
        else
            parent::__set( $nm, $val );
    }
}
//-----------------------------------------------------------------------
// Class to handle JTXMLDataSource->Fields->FieldName
//-----------------------------------------------------------------------
class JTXMLDataSourceFields
{
    protected $_DataSource;

    function __construct( $datasource )
    {
        $this->_DataSource = $datasource;
    }

    function __get( $nm )
    {
        return $this->_DataSource->FieldByName( $nm );
    }

    function __set( $nm, $val )
    {
        $this->_DataSource->SetFieldByName( $nm, $val );
    }
}
//-----------------------------------------------------------------------
// Base class for all XML data source drivers.
//-----------------------------------------------------------------------
abstract class JTXMLDataSourceDriver
{
    public $Fields = array();

    protected $FieldDefs = array();

    protected $_DOMDocument = null;
    protected $_FileName = '';

    function __construct( $filename )
    {
        $this->_FileName = realpath( $filename );

        $this->_DOMDocument = new DOMDocument();
        $this->_DOMDocument->substituteEntities = true;

        $this->loadDocument( $this->_FileName );

        $this->loadFieldDefs();
        $this->gotoRecord( 0 );
    }

    function __destruct()
    {
        $this->_DOMDocument->save( $this->_FileName );
        $this->_DOMDocument = null;
    }

    protected function loadDocument( $filename )
    {
        if( !$this->_DOMDocument->load( $filename ) )
            throw new Exception( 'XML Error: ' . get_class( $this ) . " failed to load " . basename( $filename ) );
    }

    abstract function delete();
    abstract protected function loadFieldDefs();
    abstract protected function loadFieldValues();
    abstract function gotoRecord( $recno );
    abstract function getBOF();
    abstract function getEOF();
    abstract function getRecordCount();
    abstract function post( $isInsert );

    function clearFieldValues()
    {
        $this->Fields = array();

        foreach( $this->FieldDefs as $fieldName )
            $this->Fields[ $fieldName ] = '';
    }
}
//-----------------------------------------------------------------------
// XML data source driver to read/write VCL For Win32 TClientDataSet XML Files
//-----------------------------------------------------------------------
class JTVCLClientDataSetDriver extends JTXMLDataSourceDriver
{
    protected $_CurrentRecordNode;
    protected $_RowDataNode;

    function __construct( $filename )
    {
        parent::__construct( $filename );

        $this->_RowDataNode = $this->_DOMDocument->documentElement->getElementsByTagName( "ROWDATA" )->item( 0 );
    }

    function delete()
    {
        $node = $this->_CurrentRecordNode;

        if( $this->_RowDataNode->childNodes->length > 1 )
        {
            if( $this->_CurrentRecordNode == ( $this->_RowDataNode->childNodes->length - 1 ) )
                --$this->_CurrentRecordNode;
        }
        else
        {
            $this->_CurrentRecordNode = -1;
        }

        $this->_RowDataNode->removeChild( $this->_RowDataNode->childNodes->item( $node ) );

        $this->loadFieldValues();
    }

    protected function loadFieldDefs()
    {
        $fieldsnode = $this->_DOMDocument->documentElement->getElementsByTagName( "FIELDS" )->item( 0 );

        foreach( $fieldsnode->childNodes as $field )
        {
            $fieldname = $field->getAttribute( 'attrname' );
            $this->FieldDefs[] = $fieldname;
            $this->Fields[ $fieldname ] = '';
        }
    }

    protected function loadFieldValues()
    {
        if( $this->_CurrentRecordNode > -1 && $this->_CurrentRecordNode < $this->_RowDataNode->childNodes->length )
        {
            $row = $this->_RowDataNode->childNodes->item( $this->_CurrentRecordNode );

            foreach( $this->FieldDefs as $fieldname )
                $this->Fields[ $fieldname ] = $row->getAttribute( $fieldname );
        }
        else
        {
            foreach( $this->FieldDefs as $fieldname )
                $this->Fields[ $fieldname ] = '';
        }
    }

    function gotoRecord( $recno )
    {
        if( $recno < 0 || $recno > $this->_RowDataNode->childNodes->length )
            return;

        $this->_CurrentRecordNode = $recno;

        $this->loadFieldValues();
    }

    function getBOF()
    {
        return ( $this->_CurrentRecordNode == 0 );
    }

    function getEOF()
    {
        return ( $this->_CurrentRecordNode >= ( $this->_RowDataNode->childNodes->length ) );
    }

    function getRecordCount()
    {
        return $this->_RowDataNode->childNodes->length;
    }

    function post( $isInsert )
    {
        if( $isInsert )
        {
            $node = $this->_DOMDocument->createElement( 'ROW' );
            $node->setAttribute( 'RowState', '4' );

            $this->_RowDataNode->appendChild( $node );

            $this->_CurrentRecordNode = $this->_RowDataNode->childNodes->length - 1;
        }
        else
        {
            $node = $this->_RowDataNode->childNodes->item( $this->_CurrentRecordNode );
        }

        foreach( $this->Fields as $k => $v )
            $node->setAttribute( $k, $v );
    }
}
//-----------------------------------------------------------------------
// XML data source driver to read/write .NET DataSet XML Files
//-----------------------------------------------------------------------
class JTDotNETDataSetDriver extends JTXMLDataSourceDriver
{
    protected $_CurrentRecordNode;
    protected $_FirstNode;
    protected $_NodeList;
    protected $_TableName;

    function __construct( $filename )
    {
        parent::__construct( $filename );

        if( $this->_NodeList->length == 0 )
            throw Exception( basename( $filename ) . " contains no data." );
    }

    function delete()
    {
        $node = $this->_CurrentRecordNode;

        if( $this->_NodeList->length > 1 )
        {
            if( $this->_CurrentRecordNode == ( $this->_NodeList->length - 1 ) )
                --$this->_CurrentRecordNode;
        }
        else
        {
            $this->_CurrentRecordNode = -1;
        }

        $this->_DOMDocument->documentElement->removeChild( $this->_NodeList->item( $node ) );

        $this->loadNodeList();
        $this->loadFieldValues();
    }

    protected function loadFieldDefs()
    {
        $node = $this->_FirstNode;

        foreach( $node->childNodes as $childnode )
        {
            if( $childnode->nodeType == XML_ELEMENT_NODE )
            {
                $this->FieldDefs[] = $childnode->nodeName;
                $this->Fields[ $childnode->nodeName ] = '';
            }
        }
    }

    protected function loadFieldValues()
    {
        if( $this->_CurrentRecordNode > -1 && $this->_CurrentRecordNode < $this->_NodeList->length )
        {
            $node = $this->_NodeList->item( $this->_CurrentRecordNode );

            foreach( $node->childNodes as $childnode )
            {
                $value = '';

                if( $childnode->nodeType == XML_ELEMENT_NODE )
                {
                    if( $childnode->childNodes->length > 0 )
                        $value = $childnode->childNodes->item( 0 )->nodeValue;

                    $this->Fields[ $childnode->nodeName ] = $value;
                }
            }
        }
        else
        {
            foreach( $this->FieldDefs as $fieldname )
                $this->Fields[ $fieldname ] = '';
        }
    }

    function gotoRecord( $recno )
    {
        if( $recno < 0 || $recno > $this->_NodeList->length )
            return;

        $this->_CurrentRecordNode = $recno;

        $this->loadFieldValues();
    }

    function getBOF()
    {
        return ( $this->_CurrentRecordNode == 0 );
    }

    function getEOF()
    {
        return ( $this->_CurrentRecordNode >= ( $this->_NodeList->length ) );
    }

    function getRecordCount()
    {
        return $this->_NodeList->length;
    }

    function post( $isInsert )
    {
        if( $isInsert )
        {
            $node = $this->_DOMDocument->createElement( $this->_TableName );

            foreach( $this->FieldDefs as $fieldname )
            {
                $fnode = $this->_DOMDocument->createElement( $fieldname );

                $tnode = $this->_DOMDocument->createTextNode( $this->Fields[ $fieldname ] );

                $fnode->appendChild( $tnode );

                $node->appendChild( $fnode );
            }

            $this->_DOMDocument->documentElement->appendChild( $node );

            $this->loadNodeList();

            $this->_CurrentRecordNode = $this->_NodeList->length - 1;
        }
        else
        {
            $node = $this->_NodeList->item( $this->_CurrentRecordNode );

            foreach( $node->childNodes as $childnode )
            {
                if( $childnode->nodeType == XML_ELEMENT_NODE )
                {
                    if( isset( $this->Fields[ $childnode->nodeName ] ) )
                    {
                        $childnode->childNodes->item( 0 )->nodeValue = $this->Fields[ $childnode->nodeName ];
                    }
                }
            }
        }
    }

    protected function loadDocument( $filename )
    {
        $file = file_get_contents( $filename );

        // Strip all &#x0; entities, as they are not valid XML.
        $file = str_replace( '&#x0;', '', $file );

        if( !$this->_DOMDocument->loadXML( $file ) )
            throw new Exception( 'XML Error: ' . get_class( $this ) . " failed to load " . basename( $filename ) );

        $this->_FirstNode = $this->getFirstNode();

        $this->loadNodeList();
    }

    protected function getFirstNode()
    {
        foreach( $this->_DOMDocument->documentElement->childNodes as $node )
        {
            if( $node->nodeType == XML_ELEMENT_NODE )
                return $node;
        }

        return null;
    }

    protected function loadNodeList()
    {
        $this->_TableName = $this->_FirstNode->nodeName;

        $this->_NodeList = $this->_DOMDocument->documentElement->getElementsByTagName( $this->_TableName );
    }
}

// Register built-in drivers
JTXMLDataSourceRegisterDriver( 'TClientDataSet', 'JTVCLClientDataSetDriver' );
JTXMLDataSourceRegisterDriver( '.NET DataSource', 'JTDotNETDataSetDriver' );
?>