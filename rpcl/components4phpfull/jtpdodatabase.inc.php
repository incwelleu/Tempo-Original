<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                     -- PDO Database component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once( "vcl/vcl.inc.php" );
use_unit( "dbtables.inc.php" );

class JTPDODatabase extends Database
{
    protected $_CurQuery = null;
    protected $_drivername = "MySQL";
    protected $_OdbcConnectionString = null;
    protected $_Port = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_connected = 0;
    }

    function loaded()
    {
        parent::loaded();

        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            if( !class_exists( 'PDOStatement' ) )
                throw new Exception( 'PHP PDO library not loaded, alter your php.ini.template file to load this extension.' );
        }
    }

    function BeginTrans()
    {
        $this->_connection->beginTransaction();
    }

    function CompleteTrans( $autocomplete = true )
    {
        if( $autocomplete )
            $this->_connection->commit();
        else
            $this->_connection->rollBack();
    }

    function DBDate( $input )
    {
        return $input;
    }

    function MetaFields( $tablename )
    {
        return array();
    }

    function Param( $input )
    {
        return '?';
    }

    function Prepare( $query )
    {
        $this->_CurQuery = $this->_connection->prepare( $query, array( PDO::ATTR_CURSOR, PDO::CURSOR_SCROLL ) );
    }

    function PrepareSP( $query )
    {
        $this->_CurQuery = $this->Prepare( $query );
    }

    function QuoteStr( $input )
    {
        return $this->_connection->quote( $input );
    }

    function execute( $query, $params = array() )
    {
        $this->open();

        if( strlen( $query ) )
        {
            if( $this->IsSelectQuery( $query ) )
            {
                $rs = $this->_connection->query( $query );

                if( $rs !== false )
                    $this->retrieveResultCount( $query, $rs );
            }
            else
            {
                $rs = $this->_connection->exec( $query );
            }
        }
        else if( $this->_CurQuery )
        {
            $this->_CurQuery->execute( $params );

            $rs = $this->_CurQuery;
        }
        else
        {
            DatabaseError( 'No query to execute', $this );
        }

        if( $rs === false )
        {
            if( strlen( $query ) )
                $err = $this->_connection->errorInfo();
            else if( $this->_CurQuery )
                $err = $this->_CurQuery->errorInfo();

            $err = $err[ 2 ];

            DatabaseError( "Error executing query: $query [" . $err . "]" );
        }

        return $rs;
    }

    function executelimit( $query, $numrows, $offset, $params = array() )
    {
        $this->open();

        if( strlen( $query ) == 0 )
            DatabaseError( 'No query to execute', $this );

        if( $this->_drivername == 'MySQL' )
            $query .= ' LIMIT ' . $offset . ',' . $numrows;

        return $this->execute( $query, $params );
    }

    function DoConnect()
    {
        if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            try
            {
                $driver = $this->DriverName;

                switch( $driver )
                {
                    case 'DB_LIB':
                        $data = 'dblib:host=' . $this->Host . ( $this->_Port != '' ? ':' . $this->_Port : '' ) . ';dbname=' . $this->DatabaseName;
                        break;

                    case 'Firebird':
                        $data = 'firebird:Database=' . $this->DatabaseName . ';DataSource=' . $this->Host;

                        if( $this->_Port != '' )
                            $data .= ';Port=' . $this->_Port;

                        break;

                    case 'IBM DB2':
                        $data = 'ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=' . $this->DatabaseName . ';HOSTNAME=' . $this->Host . ';PROTOCOL=TCPIP';

                        if( $this->_Port != '' )
                            $data .= ';PORT=' . $this->_Port;

                        break;

                    case 'Informix':
                        $data = 'informix:host=' . $this->Host . ';service=9800;database=' . $this->DatabaseName . ';protocol=onsoctcp';
                        break;

                    case 'MySQL':
                        $data = 'mysql:host=' . $this->Host . ( $this->_Port != '' ? ';port=' . $this->_Port : '' ) . ';dbname=' . $this->DatabaseName;
                        break;

                    case 'Oracle':
                        $data = 'oci:dbname=//' . $this->Host . ( $this->_Port != '' ? ':' . $this->_Port : '' ) . '/' . $this->DatabaseName;
                        break;

                    case 'ODBC':
                        if( empty( $this->_OdbcConnectionString ) )
                            DatabaseError( 'OdbcConnectionString is empty!', $this );

                        $data = 'odbc:' . $this->_OdbcConnectionString;
                        break;

                    case 'PostgreSQL':
                        $data = 'pgsql:host=' . $this->Host . ( $this->_Port != '' ? ' port=' . $this->_Port : '' ) . ' dbname=' . $this->DatabaseName;
                        break;

                    case 'SQLite':
                        $data = 'sqlite:' . $this->DatabaseName;
                        break;

                    default:
                        DatabaseError( 'Unrecognized database driver.', $this );
                }

                $this->_connection = new PDO( $data, $this->UserName, $this->UserPassword );
                $this->_connection->setAttribute( PDO::ATTR_STATEMENT_CLASS, array( 'JTPDOResult', array() ) );
            }
            catch( PDOException $e )
            {
                DatabaseError( 'Cannot connect to database server! ' . $e->getMessage(), $this );
            }
        }
    }

    function DoDisconnect()
    {
        if( $this->_connection )
        {
            $this->_CurQuery = null;
            $this->_connection = null;
        }
    }

    function &extractIndexes( $table, $primary = false )
    {
        return false;
    }

    function createDictionaryTable()
    {
        $result = false;

        if( $this->_connection )
        {
            if( $this->_dictionary )
            {
                if( $this->_drivername == 'Firebird' )
                {
                    $q = "CREATE TABLE $this->_dictionary (\n";
                    $q .= "  DICT_ID INTEGER NOT NULL,\n";
                    $q .= "  DICT_TABLENAME VARCHAR(60) CHARACTER SET NONE COLLATE NONE,\n";
                    $q .= "  DICT_FIELDNAME VARCHAR(60) CHARACTER SET NONE COLLATE NONE,\n";
                    $q .= "  DICT_PROPERTY VARCHAR(60) CHARACTER SET NONE COLLATE NONE,\n";
                    $q .= "  DICT_VALUE1 VARCHAR(60) CHARACTER SET NONE COLLATE NONE,\n";
                    $q .= "  DICT_VALUE2 VARCHAR(200) CHARACTER SET NONE COLLATE NONE);\n";

                    $this->execute( $q );

                    $q = "ALTER TABLE $this->_dictionary ADD PRIMARY KEY (DICT_ID)";

                    $this->execute($q);

                    $result = true;
                }
                else
                {
                    $q = "CREATE TABLE $this->_dictionary (";
                    $q .= "  `dict_id` int(11) unsigned NOT NULL auto_increment,";
                    $q .= "  `dict_tablename` varchar(60) NULL,";
                    $q .= "  `dict_fieldname` varchar(60) NULL,";
                    $q .= "  `dict_property` varchar(60) NULL,";
                    $q .= "  `dict_value1` varchar(60) NULL,";
                    $q .= "  `dict_value2` text NULL,";
                    $q .= "  PRIMARY KEY (`dict_id`)";
                    $q .= ");";

                    $this->execute( $q );

                    $result = true;
                }
            }
        }

        return $result;
    }

    function tables()
    {
        return array();
    }

    protected function IsSelectQuery( $query )
    {
        $query = strtolower( ltrim( $query ) );

        return ( substr( $query, 0, 6 ) == 'select' );
    }

    function readFieldDictionaryProperties( $table, $field )
    {
        $table = trim( $table );
        $field = trim( $field );
        $result = false;

        if( $this->_connection )
        {
            if( $this->_dictionary )
            {
                $q = 'SELECT * FROM ' . $this->_dictionary . " WHERE dict_tablename = '$table' AND dict_fieldname = '$field'";
                $query_result = $this->execute( $q );
                $props = array();

                while( $arow = $query_result->FetchRow() )
                {
                    $row = array_change_key_case( $arow, CASE_LOWER );

                    $props[ $row[ 'dict_property' ]  ] = array( $row[ 'dict_value1' ], $row[ 'dict_value2' ] );
                }

                $query_result = null;

                if( !empty( $props ) )
                    $result = $props;
            }
            else
            {
                if( $this->_dictionaryproperties )
                    $result = $this->_dictionaryproperties[ $table ][ $field ];
            }
        }

        return $result;
    }

    protected function retrieveResultCount( $query, $rs )
    {
        $rs->setRecordCount( -1 );

        if( preg_match( '/^SELECT ([a-z0-9_\-\,\. \*]+) FROM (.*)$/i', $query, $matches ) )
        {
            // Remove the ORDER BY clause.
            $s = preg_replace( '/\sORDER BY\s*([a-z0-9_\-]+)(\s*\,\s*[a-z0-9_\-]+)*/i', '', $matches[ 2 ] );

            $newQuery = 'SELECT COUNT(*) FROM ' . $s;

            $newQueryResult = $this->_connection->query( $newQuery );
            if( $newQueryResult )
            {
                $count = reset( $newQueryResult->fields );

                if( is_numeric( $count ) )
                    $rs->setRecordCount( $count );
            }
        }
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

    function setDriverName( $value )
    {
        parent::setDriverName( $value );

        switch( $this->_drivername )
        {
            case 'DB_LIB':
                $this->_Port = '';
                break;

            case 'Firebird':
                $this->_Port = '';
                break;

            case 'IBM DB2':
                $this->_Port = '';
                break;

            case 'Informix':
                $this->_Port = '';
                break;

            case 'MySQL':
                $this->_Port = '';
                break;

            case 'Oracle':
                $this->_Port = '1521';
                break;

            case 'ODBC':
                $this->_Port = '';
                break;

            case 'PostgreSQL':
                $this->_Port = '5432';
                break;

            case 'SQLite':
                $this->_Port = '';
                break;
        }
    }

    function getOdbcConnectionString()
    {
        return $this->_OdbcConnectionString;
    }

    function setOdbcConnectionString( $value )
    {
        $this->_OdbcConnectionString = $value;
    }

    function getPort()
    {
        return $this->_Port;
    }

    function setPort( $value )
    {
        $this->_Port = $value;
    }

    function defaultPort()
    {
        return '';
    }
}

if( class_exists( 'PDOStatement' ) )
{
    class JTPDOResult extends PDOStatement
    {
        private $cursor = 0;
        private $data = array();
        private $_recordCount = -1;
        public $fields = array();
        public $_numOfFields = 0;
        public $EOF = false;

        protected function __construct()
        {
            $this->MoveFirst();
            $this->_numOfFields = $this->columnCount();
        }

        function fetch( $fetch_style = PDO::FETCH_BOTH, $cursor_orientation = PDO::FETCH_ORI_NEXT, $offset = 0 )
        {
            $r = parent::fetch( $fetch_style, $cursor_orientation, $offset );

            if( $r && $fetch_style == PDO::FETCH_ASSOC )
                $this->data[] = $r;

            return $r;
        }

        function fetchAll( $fetch_style = PDO::FETCH_BOTH, $column_index = 0 )
        {
            $r = parent::fetchAll( $fetch_style, $column_index );

            if( $fetch_style == PDO::FETCH_ASSOC )
                $this->data = $r;

            return $r;
        }

        function getRow( $cursor_orientation = PDO::FETCH_ORI_NEXT )
        {
            if( $cursor_orientation == PDO::FETCH_ORI_FIRST )
            {
                $this->cursor = 0;

                if( $this->cursor >= count( $this->data ) )
                    $this->fetch( PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT );
            }
            else if( $cursor_orientation == PDO::FETCH_ORI_NEXT )
            {
                ++$this->cursor;

                if( $this->cursor >= count( $this->data ) )
                    $this->fetch( PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT );
            }
            else if( $cursor_orientation == PDO::FETCH_ORI_LAST )
            {
                $this->fetchAll( PDO::FETCH_ASSOC );

                $this->cursor = max( count( $this->data ) - 1, 0 );
            }
            else
            {
                DatabaseError( 'Cursor orientation ' . $cursor_orientation . ' not supported.' );
            }

            if( $this->cursor > -1 && $this->cursor < count( $this->data ) )
                $this->fields = $this->data[ $this->cursor ];
            else
                $this->fields = false;

            $this->EOF = !$this->fields;

            return $this->fields;
        }

        function FetchInto( &$row )
        {
            $row = $this->getRow();
        }

        function first()
        {
            $this->MoveFirst();
        }

        function next()
        {
            $this->MoveNext();
        }

        function MoveFirst()
        {
            $this->getRow( PDO::FETCH_ORI_FIRST );
        }

        function MoveLast()
        {
            $this->getRow( PDO::FETCH_ORI_LAST );
        }

        function MoveNext()
        {
            $this->getRow();
        }

        function RecordCount()
        {
            return $this->_recordCount;
        }

        function setRecordCount( $count )
        {
            $this->_recordCount = $count;
        }
    }
}
?>
