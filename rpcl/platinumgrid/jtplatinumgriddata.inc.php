<?php
class JTPlatinumGridArrayDataSet extends Object
{
    protected $_CellData = array();
    protected $_CursorPos = 0;
    protected $_Eof = 0;

    public $Database = null;
    public $Fields = array();
    public $LimitStart = -1;
    public $LimitCount = -1;
    public $Filter = '';
    public $OrderField = '';

    function __construct( $cellData )
    {
        $this->_CellData = $cellData;
    }

    function CalculateAggregates( $aggregateObjects, $conditions )
    {
        $result = array();
        $recordCount = count( $this->_CellData );

        foreach( $this->_CellData as $fields )
        {
            $skip = false;

            foreach( $conditions as $c )
            {
                list( $fieldName, $value ) = $c;

                if( $fields[ $fieldName ] != $value )
                {
                    $skip = true;
                    break;
                }
            }

            if( $skip )
                continue;

            foreach( $aggregateObjects as $o )
                $o->addValue( $fields[ $o->FieldName ] );
        }

        foreach( $aggregateObjects as $o )
            $result[ $o->OutputField ] = $o->getResult( $recordCount );

        return $result;
    }

    function First()
    {
        $this->_CursorPos = ( $this->LimitStart > -1 ) ? $this->LimitStart : 0;
        $this->update();
    }

    function Next()
    {
        $this->_CursorPos += 1;

        if( $this->_CursorPos < 0 )
        {
            $this->_CursorPos = 0;
        }
        else if( $this->LimitCount > -1 && $this->_CursorPos > ( $this->LimitCount + ( $this->LimitStart > -1 ? $this->LimitStart : 0 ) ) )
        {
            $this->_CursorPos = $this->LimitCount;
        }
        else if( $this->_CursorPos > count( $this->_CellData ) )
        {
            $this->_CursorPos = count( $this->_CellData );
        }

        $this->update();
    }

    function Open()
    {
        if( $this->Filter )
            $this->_CellData = array_values( array_filter( $this->_CellData, array( $this, 'filterRows' ) ) );

        if( $this->OrderField )
            usort( $this->_CellData, array( $this, 'sortRows' ) );
    }

    protected function filterRows( $fields )
    {
        $filters = explode( ' AND ', $this->Filter );

        foreach( $filters as $filter )
        {
            $result = true;

            if( preg_match( '/^((CAST\()?[a-z0-9_\. ]+\)?) (([=><]+)|(NOT )?LIKE) (.+)$/i', $filter, $matches ) )
            {
                $dataField = $matches[ 1 ];
                $filterMethod = $matches[ 3 ];
                $filterValue = $matches[ 6 ];

                $dataValue = $this->processFieldCast( $dataField, $fields );
                $filterValue = $this->processValueCast( $filterValue );

                if( $filterValue[ 0 ] == "'" )
                    $filterValue = stripslashes( substr( $filterValue, 1, strlen( $filterValue ) - 2 ) );

                switch( $filterMethod )
                {
                    case "=":
                        $result = ( strcasecmp( $dataValue, $filterValue ) == 0 );
                        break;

                    case "<>":
                        $result = ( strcasecmp( $dataValue, $filterValue ) != 0 );
                        break;

                    case "<":
                        $result = ( $dataValue < $filterValue );
                        break;

                    case ">":
                        $result = ( $dataValue > $filterValue );
                        break;

                    case "<=":
                        $result = ( $dataValue <= $filterValue );
                        break;

                    case ">=":
                        $result = ( $dataValue >= $filterValue );
                        break;

                    case "LIKE":
                        $result = $this->filterLike( $dataValue, $filterValue );
                        break;

                    case "NOT LIKE":
                        $result = !$this->filterLike( $dataValue, $filterValue );
                        break;
                }
            }

            if( !$result )
                return false;
        }

        return true;
    }

    protected function processFieldCast( $dataField, $fields )
    {
        if( preg_match( '/^CAST\(([a-z0-9_\.]+) AS ([a-z0-9_]+)\)/i', $dataField, $matches ) )
        {
            $dataField = $matches[ 1 ];
            $castAs = $matches[ 2 ];

            $dataValue = $this->processCast( $fields[ $dataField ], $castAs );
        }
        else
        {
            $dataValue = $fields[ $dataField ];
        }

        return $dataValue;
    }

    protected function processValueCast( $value )
    {
        if( preg_match( '/^CAST\(\'([^\']*)\' AS ([a-z0-9_]+)\)/i', $value, $matches ) )
        {
            $value = $matches[ 1 ];
            $castAs = $matches[ 2 ];

            $value = $this->processCast( $value, $castAs );
        }

        return $value;
    }

    protected function processCast( $value, $castAs )
    {
        if( $castAs == 'DATE' || $castAs == 'DATETIME' || $castAs == 'TIME' )
        {
            $value = strtotime( $value );

            if( $castAs == 'DATE' )
                $value = date( 'Y-m-d', $value );
            else if( $castAs == 'DATETIME' )
                $value = date( 'Y-m-d H:n:s', $value );
            else if( $castAs == 'TIME' )
                $value = date( 'H:n:s', $value );
        }

        return $value;
    }

    protected function filterLike( $dataValue, $filterValue )
    {
        $result = true;
        $filterLen = strlen( $filterValue );

        if( $filterLen )
        {
            if( $filterLen > 2 && $filterValue[ 0 ] == '%' && $filterValue[ $filterLen - 1 ] == '%' )
            {
                $result = stripos( $dataValue, substr( $filterValue, 1, -1 ) );
            }
            else if( $filterValue[ 0 ] == '%' )
            {
                $result = ( strcasecmp( substr( $dataValue, -$filterLen + 1 ),
                    substr( $filterValue, 1 ) ) == 0 );
            }
            else if( $filterValue[ $filterLen - 1 ] == '%' )
            {
                $result = ( strcasecmp( substr( $dataValue, 0, $filterLen - 1 ),
                    substr( $filterValue, 0, -1 ) ) == 0 );
            }
            else
            {
                $result = ( strcasecmp( $dataValue, $filterValue ) == 0 );
            }
        }

        return $result;
    }

    protected function sortRows( $fields1, $fields2 )
    {
        $sortFields = explode( ',', $this->OrderField );

        foreach( $sortFields as $sortField )
        {
            $sortBits = preg_split( '/\s+/', trim( $sortField ) );
            $fieldName = $sortBits[ 0 ];
            $direction = ( count( $sortBits ) > 1 ) ? $sortBits[ 1 ] : '';

            $direction = strtoupper( $direction );
            if( !$direction )
                $direction = "ASC";

            $result = strcasecmp( $fields1[ $fieldName ], $fields2[ $fieldName ] );

            if( strcasecmp( $direction, 'DESC' ) == 0 )
                $result *= -1;

            if( $result != 0 )
                return $result;
        }

        return 0;
    }

    protected function update()
    {
        $this->_Eof =
            ( count( $this->_CellData ) <= $this->_CursorPos ||
              ( $this->LimitCount > -1 && $this->_CursorPos >= ( $this->LimitCount + ( $this->LimitStart > -1 ? $this->LimitStart : 0 ) ) ) );

        if( !$this->_Eof )
            $this->Fields = $this->_CellData[ $this->_CursorPos ];
        else
            $this->Fields = array();
    }

    function readActive()
    {
        return true;
    }

    function readEOF()
    {
        return $this->_Eof;
    }

    function readRecordCount()
    {
        return count( $this->_CellData );
    }

    function readFieldProperties( $fieldName )
    {
        return false;
    }

    function readFields()
    {
        return $this->Fields;
    }
}

class JTPlatinumGridSQLDataSet extends Object
{
    protected $_Datasource;
    protected $_DataSet;

    public $Database = null;
    public $Filter = '';
    public $LimitStart = -1;
    public $LimitCount = -1;
    public $OrderField = '';

    function __construct( $dataSource )
    {
        $this->_Datasource = $dataSource;
        $this->Database = $dataSource->DataSet->Database;
    }

    function CalculateAggregates( $aggregateObjects, $conditions )
    {
        if( !count( $aggregateObjects ) )
            return array();

        $aggregateSQL = array();

        foreach( $aggregateObjects as $agObj )
        {
            $fieldName = $agObj->FieldName;
            $outputField = $agObj->OutputField;

            if( defined( 'JT_QUOTEFIELDS' ) )
            {
                $fieldName = '"' . $fieldName . '"';
                $outputField = '"' . $outputField . '"';
            }

            $aggregateSQL[] = $agObj->getSQLFunction() . '(' . $fieldName . ') AS ' . $outputField;
        }

        $dataSet = $this->makeDataSet( false );
        $sql = $dataSet->SQL;

        $aggregateSQLText = implode( ', ', $aggregateSQL );
        $params = array();

        if( count( $conditions ) )
        {
            $clauses = array();

            foreach( $conditions as $i => $c )
            {
                list( $fieldName, $value ) = $c;

                $paramName = $dataSet->Database->Param( 'Agg' . $i );

                $clauses[] = $fieldName . ' = ' . $paramName;

                if( $paramName == '?' )
                    $params[] = $value;
                else
                    $params[ $paramName ] = $value;
            }

            if( !$this->Filter )
                $sql .= ' WHERE ';
            else
                $sql .= ' AND ';

            $sql .= implode( ' AND ', $clauses );
        }

        $sql = "
            SELECT $aggregateSQLText
                FROM (
                    $sql
                ) JTPlatinumGridQueryAggregates";

        $dataSet->Params = array_merge( $params, $dataSet->Params );
        $dataSet->SQL = $sql;
        $dataSet->Open();
        $dataSet->First();

        return ( !$dataSet->Eof ) ? $dataSet->Fields : array();
    }

    function First()
    {
        $this->_DataSet->First();
    }

    function Next()
    {
        $this->_DataSet->Next();
    }

    function Open()
    {
        $this->_DataSet = $this->makeDataSet( true );

        $this->_DataSet->LimitStart = $this->LimitStart;
        $this->_DataSet->LimitCount = $this->LimitCount;

        $this->_DataSet->Open();
    }

    protected function makeDataSet( $includeSorting )
    {
        if( defined( 'JT_STANDALONE' ) )
        {
            $classType = new ReflectionClass( $this->_Datasource->DataSet );

            $dataSet = $classType->newInstance();
        }
        else if( class_exists( 'MySQLDatabase' ) && $this->_Datasource->DataSet->Database instanceof MySQLDatabase )
        {
            $dataSet = new MySQLQuery();
            $dataSet->Order = '';
        }
        else
        {
            $dataSet = new Query();
            $dataSet->Order = '';
        }

        $dataSet->Database = $this->_Datasource->DataSet->Database;

        $dataSet->SQL = $this->makeSQL( $this->_Datasource->DataSet->buildQuery(), $includeSorting );

        if( method_exists( $this->_Datasource->DataSet, 'getParams' ) )
            $dataSet->Params = $this->_Datasource->DataSet->Params;

        return $dataSet;
    }

    protected function makeSQL( $sql, $includeSorting )
    {
        $filter = $this->Filter;
        $sort = $this->OrderField;

        if( !defined( 'JT_USESUBQUERIES' ) && preg_match( '/^(.+?)(\s+WHERE\s+(.+?))?(ORDER BY\s+([a-z0-9\._]+))?$/i', $sql, $matches ) )
        {
            $sql = $matches[1];
            $sqlWhere = $matches[3];
            $sqlOrder = $matches[5];

            if( $sqlWhere )
            {
                if( $filter )
                    $filter = '(' . $sqlWhere . ') AND (' . $filter . ')';
                else
                    $filter = $sqlWhere;
            }

            if( $sqlOrder )
            {
                if( $sort )
                    $sort = $sqlOrder . ',' . $sort;
                else
                    $sort = $sqlOrder;
            }
        }
        else
        {
            $sql = 'SELECT * FROM (' . $sql . ') JTPlatinumGridQuery';
        }

        if( $filter )
            $sql .= ' WHERE ' . $filter;

        if( $sort && $includeSorting )
            $sql .= ' ORDER BY ' . $sort;

        return $sql;
    }

    function readActive()
    {
        return ( $this->_DataSet && $this->_DataSet->Active );
    }

    function readEOF()
    {
        return $this->_DataSet->EOF;
    }

    function readRecordCount()
    {
        $dataSet = $this->makeDataSet( false );

        $sql = $dataSet->SQL;

        if( preg_match( '/^\s*SELECT/i', $sql ) )
        {
            if( preg_match( '/^\s*SELECT\s+.+?\s+(FROM\s+.+?)(\s+ORDER BY.+)?$/i', $sql, $matches ) )
            {
                $sql = 'SELECT COUNT(*) ' . $matches[ 1 ];
            }
            else
            {
                $sql = 'SELECT COUNT(*) FROM (' . $sql . ') JTPlatinumGridQueryCount';
            }

            $dataSet->SQL = $sql;
            $dataSet->Open();
            $dataSet->First();

            if( !$dataSet->EOF )
                return reset( $dataSet->Fields );
        }

        $dataSet->Open();

        return $dataSet->RecordCount;
    }

    function readFieldProperties( $fieldName )
    {
        return false;
    }

    function readFields()
    {
        return $this->_DataSet->Fields;
    }
}

abstract class JTPlatinumGridAggregate
{
    function __construct( $fieldName, $outputField )
    {
        $this->FieldName = $fieldName;
        $this->OutputField = $outputField;
    }

    abstract function addValue( $value );
    abstract function getResult( $rowCount );
    abstract function getSQLFunction();

    public $FieldName;
    public $OutputField;
}

class JTPlatinumGridCountAggregate extends JTPlatinumGridAggregate
{
    protected $_Count = 0;

    function addValue( $value )
    {
        ++$this->_Count;
    }

    function getResult( $rowCount )
    {
        return $this->_Count;
    }

    function getSQLFunction()
    {
        return 'COUNT';
    }
}

class JTPlatinumGridMaxAggregate extends JTPlatinumGridAggregate
{
    protected $_Max = 0;

    function addValue( $value )
    {
        if( $value > $this->_Max )
            $this->_Max = $value;
    }

    function getResult( $rowCount )
    {
        return $this->_Max;
    }

    function getSQLFunction()
    {
        return 'MAX';
    }
}

class JTPlatinumGridMinAggregate extends JTPlatinumGridAggregate
{
    protected $_Min = 0;

    function addValue( $value )
    {
        if( $value < $this->_Min )
            $this->_Min = $value;
    }

    function getResult( $rowCount )
    {
        return $this->_Min;
    }

    function getSQLFunction()
    {
        return 'MIN';
    }
}

class JTPlatinumGridSumAggregate extends JTPlatinumGridAggregate
{
    protected $_Sum = 0;

    function addValue( $value )
    {
        $this->_Sum += $value;
    }

    function getResult( $rowCount )
    {
        return $this->_Sum;
    }

    function getSQLFunction()
    {
        return 'SUM';
    }
}

class JTPlatinumGridAvgAggregate extends JTPlatinumGridSumAggregate
{
    function getResult( $rowCount )
    {
        return parent::getResult( $rowCount ) / $rowCount;
    }

    function getSQLFunction()
    {
        return 'AVG';
    }
}

/*
function moveDataSetBy( $dataSet, $distance )
{
    if( !defined( 'JT_STANDALONE' ) && defined( 'VCL_VERSION' ) && $dataSet instanceof DBDataSet )
    {
        if( $distance > 1 )
            $dataSet->_rs->Move( $dataSet->_rs->CurrentRow() + ( $distance - 1 ) );

        $dataSet->_rs->MoveNext();
    }
    else
    {
        $dataSet->MoveBy( $distance );
    }
}
*/