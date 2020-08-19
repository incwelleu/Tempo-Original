<?php
//-----------------------------------------------------------------------
//                      - JomiTech PlatinumGrid -
//
//            Copyright © JomiTech 2010. All Rights Reserved.
//-----------------------------------------------------------------------
// require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );
use_unit( "components4phpfull/jtdatepicker.inc.php" );
use_unit( "components4phpfull/jtdatetimepicker.inc.php" );
use_unit( "components4phpfull/jttimepicker.inc.php" );
use_unit( "components4phpfull/jtcombobox.inc.php" );
//use_unit( "jtphplogger/jtphplogger.inc.php" );

if( !function_exists( 'json_encode' ) )
    use_unit( "platinumgrid/lib/JSON.php" );

use_unit( "platinumgrid/jtplatinumgriddata.inc.php" );

if( !defined( 'agTop' ) )
{
    define( 'agTop', 'agTop' );
    define( 'agMiddle', 'agMiddle' );
    define( 'agBottom', 'agBottom' );
}

class JTPlatinumGrid extends JTThemedGraphicControl
{
    // Editor styles.
    const Inline = 'Inline';
    const Form = 'Form';

    // Printing skin.
    const PrintSkin = 'PrintGrid';

    // Property variables.
    protected $_AllowInsert = true;
    protected $_AjaxRefreshAll = 0;
    protected $_EditorStyle = JTPlatinumGrid::Inline;
    protected $_MemoField = '';
    protected $_MergedCells = array();
    protected $_RowDataStyles = array();
    protected $_AllowDelete = true;
    protected $_AllowScrolling = true;
    protected $_AllowUpdate = true;
    protected $_AlwaysShowEditor = 0;
    protected $_CanDragSelect = true;
    protected $_CanMoveCols = true;
    protected $_CanMultiColumnSort = true;
    protected $_CanRangeSelect = true;
    protected $_CanResizeCols = true;
    // protected $_CanResizeRows = true;
    protected $_CanSelect = true;
    protected $_CellData = array();
    protected $_Columns = array();
    protected $_CommandBar = null;
    protected $_Datasource = null;
    protected $_DataEncoding = 'UTF-8';
    protected $_DetailValue = '';
    protected $_DetailView = null;
    protected $_EvenRowStyle = null;
    protected $_ExportFileName = '';
    protected $_ExportPDFFontName = 'Helvetica';
    protected $_FillWidth = true;
    protected $_GridLines = null;
    protected $_GroupBy = '';
    protected $_Header = null;
    protected $_HiddenRowsByIndex = array();
    protected $_HiddenRowsByField = array();
    protected $_KeyField = '';
    protected $_OddRowStyle = null;
    protected $_Pager = null;
    protected $_ParentField = '';
    protected $_ReadOnly = 0;
    protected $_RowSelect = 0;
    protected $_SelectedCells = array();
    protected $_SelectedCol = -1;
    protected $_SelectedPrimaryKeys = array();
    protected $_SelectedRow = -1;
    protected $_SelectedRowStyle = null;
    protected $_ShowEditColumn = 0;
    protected $_ShowSelectColumn = true;
    protected $_SortBy = '';
    protected $_UTF8 = true;

    // Event variables.
    protected $_jsOnDataLoad = null;
    protected $_onsort = null;
    protected $_ondelete = null;
    protected $_oninsert = null;
    protected $_onupdate = null;
    protected $_ongroup = null;
    protected $_onsql = null;
    protected $_oncustomeditorgenerate = null;
    protected $_oncustomfiltergenerate = null;
    protected $_oncustomfieldgenerate = null;
    protected $_oncommand = null;
    protected $_onrowedited = null;
    protected $_onrowinserted = null;
    protected $_jsOnCommand = null;
    protected $_jsOnRowDeleting = null;
    protected $_jsOnRowEditing = null;
    protected $_jsOnRowEdited = null;
    protected $_jsOnRowInserted = null;
    protected $_jsOnSelect = null;
    protected $_onrowdata = null;
    protected $_onsummarydata = null;
    protected $_ongetrecordcount = null;
    protected $_oncalculateaggregates = null;
    protected $_oncustomcommand = null;
    protected $_jsOnCustomCommand = null;
    protected $_onexport = null;
    protected $_onprint = null;

    protected $DataModified = false;
    protected $DataSet = null;
    protected $DbDriven = false;
    protected $DetailViewActive = false;
    protected $EditingRow = -1;
    protected $IndentFactor = 1;
    protected $FiltersChanged = false;
    protected $LastFieldValues = array();
    protected $NonGroupedColumns = array();
    protected $Serializing = false;
    protected $IsAjax = false;
    protected $HasUnserialized = false;
    protected $HasSerialized = false;

    // Needs to be public for renderer classes.
    public $GroupByFields = array();
    public $TotalRecordCount = 0;

    // For non-VCL applications that wish to use Ajax.
    public $ajaxJSMethod = '';

    // For non-VCL applications that want to disable automatic persistence.
    public $Persistent = true;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        if( defined( 'JT_STANDALONE' ) )
        {
            $this->Name = 'grid';
            $this->SiteTheme = new JTSiteTheme();
        }

        $this->Width = 450;
        $this->Height = 300;

        $this->_CommandBar = new JTPlatinumGridCommandBar( $this );
        $this->_DetailView = new JTPlatinumGridDetailView( $this );
        $this->_EvenRowStyle = new JTPlatinumGridEvenRowStyle( $this );
        $this->_GridLines = new JTPlatinumGridLines( $this );
        $this->_Header = new JTPlatinumGridHeader( $this );
        $this->_OddRowStyle = new JTPlatinumGridOddRowStyle( $this );
        $this->_Pager = new JTPlatinumGridPager( $this );
        $this->_SelectedRowStyle = new JTPlatinumGridSelectedRowStyle( $this );
    }

    function __destruct()
    {
        if( defined( 'JT_STANDALONE' ) && $this->Persistent )
            $this->serialize();
    }

    function loaded()
    {
        parent::loaded();

        foreach( $this->_Columns as $column )
            $column->loaded();

        $this->_DetailView->loaded();

        $this->setDatasource( $this->Datasource );

        if( isset( $_POST[ $this->Name . '_Selection' ] ) )
        {
            $selectedCellsInput = $_POST[ $this->Name . '_Selection' ];
            if( strlen( $selectedCellsInput ) )
                $this->processSelection( $selectedCellsInput );
        }

        if( isset( $_REQUEST[ $this->Name . '_Pager' ] ) )
        {
            $p = $_REQUEST[ $this->Name . '_Pager' ];
            if( is_numeric( $p ) )
                $this->_Pager->CurrentPage = $p;
        }

        if( isset( $_POST[ $this->Name . '_ColSizes' ] ) )
        {
            $colSizes = $_POST[ $this->Name . '_ColSizes' ];
            if( strlen( $colSizes ) )
            {
                $data = $colSizes;
                if( get_magic_quotes_gpc() )
                    $data = stripslashes( $data );

                $this->processColSizes( $data );
            }
        }

        if( isset( $_POST[ $this->Name . '_PrimaryKeys' ] ) )
        {
            $primaryKeysInput = $_POST[ $this->Name . '_PrimaryKeys' ];
            if( strlen( $primaryKeysInput ) )
                $this->processPrimaryKeys( $primaryKeysInput );
        }

        $this->processSortBy();
        // $this->initGroupByColumns();

        $this->DbDriven = (bool)$this->_Datasource;
    }

    function preinit()
    {
        parent::preinit();

        $this->processFilterSet();
    }

    function init()
    {
        parent::init();

        if( defined( 'JT_STANDALONE' ) )
        {
            if( $this->Persistent && !$this->HasUnserialized )
            {
                if( session_id() == '' )
                    session_start();

                if( isset( $_SESSION[ $this->readNamePath() . '.Sid' ] ) &&
                    ( !isset( $_GET[ 'restore_session' ] ) || $_GET[ 'restore_session' ] != '1' ) )
                {
                    $this->unserialize();
                }
            }

            $this->loaded();
            $this->processFilterSet();
        }

        if( isset( $_POST[ $this->Name . '_Cmd' ] ) )
        {
            $command = $_POST[ $this->Name . '_Cmd' ];
            if( strlen( $command ) )
            {
                $data = $command;
                if( get_magic_quotes_gpc() )
                    $data = stripslashes( $data );

                $this->executeCommand( $data );
            }
        }
    }

    function allowserialize( $propname )
    {
        if( $propname == 'Columns' || $propname == 'RowDataStyles' )
            return false;

        return parent::allowserialize( $propname );
    }

    function serialize()
    {
        if( $this->HasSerialized )
            return;

        $this->HasSerialized = true;

        if( !defined( 'JT_STANDALONE' ) )
        {
            $this->Serializing = true;

            parent::serialize();

            $this->Serializing = false;
        }

        $colTypes = array();
        foreach( $this->_Columns as $i => $column )
        {
            $colTypes[] = get_class( $column );
            $column->Index = $i;
            $column->serialize();
        }

        $_SESSION[ $this->readNamePath() . '.ColumnTypes' ] = $colTypes;
        $_SESSION[ $this->readNamePath() . '.Sid' ] = 1;

        if( defined( 'JT_STANDALONE' ) )
        {
            $result = array();
            $refclass = new ReflectionClass( get_class( $this ) );
            $methods=$refclass->getMethods();

            foreach( $methods as $k => $method )
            {
                $methodname=$method->name;
                if ($methodname[0] == 's' && $methodname[1] == 'e' && $methodname[2] == 't')   // fast check of: substr($methodname,0,3)=='set'
                {
                    $propname=substr($methodname, 3);

                    if($propname=='Name')
                        $propvalue = $this->_name;
                    else
                        $propvalue=$this->$propname;

                    if (is_object($propvalue))
                    {
                        if( $propvalue instanceof Component)
                        {
                            $apropvalue='';
                            $aowner=$propvalue->readOwner();
                            if ($aowner!=null) $apropvalue=$aowner->getName().'.';
                            $apropvalue.=$propvalue->getName();
                            $propvalue=$apropvalue;
                        }
                        else if( $propvalue instanceof JTPersistent )
                        {
                           $propvalue = $propvalue->toString();
                        }
                    }

                    if ((!is_object($propvalue))  && ($this->allowserialize($propname)))
                    {
                        $defmethod='default'.$propname;

                        if (method_exists($this,$defmethod))
                        {
                            $defvalue=$this->$defmethod();

                            if (typesafeequal($defvalue,$propvalue))
                                continue;
                        }

                        $result[$propname]=$propvalue;
                    }
                }
            }

            $_SESSION[ $this->readNamePath() . '.Data' ] = $result;
        }

        $rowDataStyles = array();
        foreach( $this->_RowDataStyles as $style )
            $rowDataStyles[] = $style->toString();

        $_SESSION[ $this->readNamePath() . '.SerializedRowDataStyles' ] = $rowDataStyles;

        // echo("<!-- serializing " . print_r( $rowDataStyles, true ) . " -->\r\n" );
    }

    function unserialize()
    {
        $this->HasUnserialized = true;

        if( !defined( 'JT_STANDALONE' ) )
            parent::unserialize();

        if( defined( 'JT_STANDALONE' ) || $this->inSession( '' ) )
        {
            //$this->_Columns = array();

            // echo( "<!-- unserializing cols from " . $_SESSION[ $this->readNamePath() . '.ColumnTypes' ] . " -->\r\n" );
            $colTypes = $_SESSION[ $this->readNamePath() . '.ColumnTypes' ];
            foreach( $colTypes as $i => $colType )
            {
                // echo( "<!-- col $i is $colType -->\r\n" );
                if( $i < count( $this->_Columns ) && get_class( $this->_Columns[ $i ] ) == $colType )
                {
                    $column = $this->_Columns[ $i ];
                }
                else
                {
                    $column = new $colType( $this );
                    $this->_Columns[ $i ] = $column;
                }

                $column->Index = $i;
                // echo( "<!-- col unserialize -->\r\n" );
                $column->unserialize();

                // $this->_Columns[] = $column;
            }

            $this->_RowDataStyles = array();

            $rowDataStyles = $_SESSION[ $this->readNamePath() . '.SerializedRowDataStyles' ];

            // echo("<!-- unserializing " . print_r( $rowDataStyles, true ) . " -->\r\n" );

            foreach( $rowDataStyles as $serializedStyle )
            {
                $style = new JTPlatinumGridRowDataStyle( $this );
                $style->fromString( $serializedStyle );

                // echo("<!-- unserialized {$style->DataField}, {$style->Operator}, {$style->Value} -->\r\n" );

                $this->_RowDataStyles[] = $style;
            }
        }

        if( defined( 'JT_STANDALONE' ) )
        {
            $data = $_SESSION[ $this->readNamePath() . '.Data' ];

            if( !is_array( $data ) )
                $data = unserialize( $data );

            foreach( $data as $k => $v )
            {
                $getter = 'get' . $k;
                $ob = $this->$getter();

                if( is_object( $ob ) )
                {
                    if( $ob instanceof JTPersistent && !( $ob instanceof Component ) )
                        $ob->fromString( $v );
                }
                else
                {
                    $setter = 'set' . $k;
                    $this->$setter( $v );
                }
            }
        }
    }

    function initAsDetail( $masterField, $masterValue )
    {
        $_SESSION[ $this->readNamePath() . '.DetailParams' ] = array( $masterField, $masterValue );
    }

    function callEvent( $event, $params )
    {
        if( defined( 'JT_STANDALONE' ) )
        {
            $ievent = '_' . $event;
            $event = $this->$ievent;
            if( $event )
            {
                if( $this->OwnerInstance )
                    return $this->OwnerInstance->$event( $this, $params );
                else
                    return call_user_func( $event, $this, $params );
            }
            else
            {
                return false;
            }
        }
        else
        {
            return parent::callEvent( $event, $params );
        }
    }

    function dumpJsEvents()
    {
        if( !defined( 'JT_STANDALONE' ) )
            parent::dumpJsEvents();
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        if( !$this->initializeSkin( $error ) )
            return;

        if( $this->SiteThemeInstance )
        {
            $this->SiteThemeInstance->addComponentJSCode( get_class( $this ) );
            // For date/time columns.
            $this->SiteThemeInstance->addComponentJSCode( 'JTDateTimePicker' );
            // For advanced filtering.
            $this->SiteThemeInstance->addComponentJSCode( 'JTComboBox' );

            if( defined( 'JT_STANDALONE' ) || ( $this->ControlState & csDesigning ) == csDesigning )
                $this->SiteThemeInstance->dumpHeaderCode();

            print( $this->SiteThemeInstance->generateComponentCSSCode( 'datepicker' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'datetimepicker' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'combobox' ) );
            print( $this->SiteThemeInstance->generateComponentCSSCode( 'advgrid' ) );
        }

        $this->dumpCSSCode();

        if( $this->_DetailView->Enabled )
            $this->_DetailView->dumpHeaderCode();

        if( defined( 'JT_STANDALONE' ) )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );
            $this->dumpJavascript();
            print( "</script>\r\n" );
        }
    }

    protected function dumpCSSCode()
    {
        $this->initRowStylesCss();

        $css = $this->_EvenRowStyle->dumpCSS( $this );
        $css .= $this->_OddRowStyle->dumpCSS( $this );
        $css .= $this->_SelectedRowStyle->dumpCSS( $this );

        foreach( $this->_RowDataStyles as $i => $rowDataStyle )
            $css .= $rowDataStyle->RowStyle->dumpCSS( $this );

        $css .= $this->_Header->dumpCSS( $this );

        print( $this->generateComponentSectionCode( 'css', array( 'CSS' => $css ) ) . "\r\n" );
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        print( "function " . $this->Name . "Requestor()\r\n{\r\n" );

        if( defined( 'JT_STANDALONE' ) )
            $useAjax = (bool)$this->ajaxJSMethod;
        else
            $useAjax = $this->owner->UseAjax;

        if( $useAjax )
        {
            print( $this->Name . "._showWaitWindow();\r\n" );

            if( defined( 'JT_STANDALONE' ) )
            {
                echo( $this->ajaxJSMethod . ";\r\n" );
            }
            else if( defined( 'JQUERY_MOBILE_FILE' ) )
            {
                echo( "jQuery({$this->Name}.FCommand.form).submit();\r\n" );
            }
            else
            {
                // Execute a dummy ajax call, enough to cause the grid to refresh.
                print( "var params = [];\r\n" );
                print( $this->ajaxCall( 'ClassName'
                    , array(), $this->_AjaxRefreshAll ? array() : array( $this->Name )
                     ) );

            }
        }
        else
        {
            print( "    var form = " . $this->Name . ".FCommand.form;\r\n" );
?>
    if( !form )
        form = document.forms[ 0 ];
    if( typeof( form ) != "undefined" && form )
    {
        if( form.onsubmit && typeof( form.onsubmit ) == "function" )
        {
            if( !form.onsubmit() )
                return;
        }

        form.submit();
    }
<?php
        }

        print( "}\r\n" );

        $this->dumpJavaScriptEvent( $this->_jsOnRowInserted, 'fieldValues' );
        $this->dumpJavaScriptEvent( $this->_jsOnRowDeleting, 'row, primaryKey' );
        $this->dumpJavaScriptEvent( $this->_jsOnRowEdited, 'rowIndex, fieldValues' );
        $this->dumpJavaScriptEvent( $this->_jsOnRowEditing, 'rowIndex' );
        $this->dumpJavaScriptEvent( $this->_jsOnDataLoad, '' );
        $this->dumpJavaScriptEvent( $this->_jsOnSelect, 'row, col, selected' );
        $this->dumpJavaScriptEvent( $this->_jsOnCommand, 'row, col, commandIndex, primaryKey' );
        $this->dumpJavaScriptEvent( $this->_jsOnCustomCommand, 'command, data' );

        if( $this->_DetailView->Enabled )
            $this->_DetailView->dumpJavascript();
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        $this->IndentFactor = $this->retrieveSetting( 'IndentFactor' );

        $this->initDataSet();

        if( count( $this->_Columns ) == 0 )
            $trimmedColumns = $this->generateColumns();
        else
            $trimmedColumns = $this->_Columns;

        $haveAllColumnsWidth = $this->calculateHaveAllColumnsWidth( $trimmedColumns );

        $this->initRowStylesCss();
        $this->initGroupByColumns();

        $this->trimOffGroupByColumns( $trimmedColumns );
        $this->NonGroupedColumns = $trimmedColumns;

        if( $this->_Header->ShowGroupBar )
            $groupBar = $this->dumpGroupBar( $this->_Columns );
        else
            $groupBar = '';

        if( $this->_Header->ShowColumnHeader )
            $columnHeader = $this->dumpColumnsHeader( $trimmedColumns, $haveAllColumnsWidth );
        else
            $columnHeader = '';

        if( $this->_Header->ShowFilterBar )
            $filterBar = $this->dumpFilterBar( $trimmedColumns, $haveAllColumnsWidth );
        else
            $filterBar = '';

        if( !$this->_ReadOnly && $this->_EditorStyle == self::Inline )
            $insertEditor = $this->dumpInsertRow( $trimmedColumns );
        else
            $insertEditor = '';

        $colgroupHeaderHTML = $this->dumpColGroup( $trimmedColumns, 'hdr' );
        $colgroupBodyHTML = $this->dumpColGroup( $trimmedColumns, 'body' );
        $dataHTML = $this->dumpGridData( $trimmedColumns, $haveAllColumnsWidth );
        $pagerHTML = $this->dumpPager();
        $summaryHTML = $this->dumpSummary( $trimmedColumns );
        $commandBarHTML = $this->dumpCommandBar();

        if( !$this->_ReadOnly )
            $editorHTML = $this->dumpEditor( $trimmedColumns );
        else
            $editorHTML = '';

        $tableClasses = '';
        if( $this->_GridLines->Horizontal )
            $tableClasses .= ' horzlines';

        if( $this->_GridLines->Vertical )
            $tableClasses .= ' vertlines';

        if( $this->_FillWidth )
            $tableClasses .= ' fillwidth';

        $vars = array
        (
            'GROUPBAR'	    => $groupBar,
            'COLUMNHEADER'  => $columnHeader,
            'FILTERBAR'     => $filterBar,
            'DATA'		    => $dataHTML,
            'SELECTION'     => $this->selectionString(),
            'INSERTROW'     => $insertEditor,
            'TABLECLASSES'  => $tableClasses,
            'TABINDEX'      => ( ( $this->_TabStop ) ? $this->_TabOrder : -1 ),
            'HDRCOLGROUP'   => $colgroupHeaderHTML,
            'BODYCOLGROUP'  => $colgroupBodyHTML,
            'SUMMARY'       => $summaryHTML,
            'SUMMARYCSS'    => ( $summaryHTML ? 'summary-container' : 'summary-container-hidden' )
        );

        if( $this->_EditorStyle == JTPlatinumGrid::Form )
        {
            $vars[ 'FORMEDITORS' ] = $editorHTML;
            $vars[ 'INLINEEDITORS' ] = '';
        }
        else
        {
            $vars[ 'INLINEEDITORS' ] = $editorHTML;
            $vars[ 'FORMEDITORS' ] = '';
        }

        if( $this->_Pager->ShowTopPager )
            $vars[ 'TOPPAGER' ] = $pagerHTML;
        else
            $vars[ 'TOPPAGER' ] = '';

        if( $this->_Pager->ShowBottomPager )
            $vars[ 'BOTTOMPAGER' ] = $pagerHTML;
        else
            $vars[ 'BOTTOMPAGER' ] = '';

        $vars[ 'TOPCMDBAR' ] = ( $this->_CommandBar->ShowTopCommandBar ? $commandBarHTML : '' );
        $vars[ 'BOTTOMCMDBAR' ] = ( $this->_CommandBar->ShowBottomCommandBar ? $commandBarHTML : '' );

        if( $this->_AllowScrolling )
            $template = 'GridScrolling';
        else
            $template = 'GridNoScroll';

        print( $this->generateComponentSectionCode( $template, $vars ) );
    }

    protected function dumpControlFooter()
    {
        $selection = '';

        if( isset( $_POST[ $this->Name . '_Selection' ] ) )
        {
            $selectedCellsInput = $_POST[ $this->Name . '_Selection' ];
            if( strlen( $selectedCellsInput ) )
                $selection = $selectedCellsInput;
        }

        print( "<input id=\"{$this->Name}_Selection\" name=\"{$this->Name}_Selection\" type=\"hidden\" value=\"$selection\" />\r\n" );
        print( "<input id=\"{$this->Name}_Cmd\" name=\"{$this->Name}_Cmd\" type=\"hidden\" value=\"\" />\r\n" );
        print( "<input id=\"{$this->Name}_Pager\" name=\"{$this->Name}_Pager\" type=\"hidden\" value=\"\" />\r\n" );
        print( "<input id=\"{$this->Name}_ColSizes\" name=\"{$this->Name}_ColSizes\" type=\"hidden\" value=\"\" />\r\n" );
        print( "<input id=\"{$this->Name}_PrimaryKeys\" name=\"{$this->Name}_PrimaryKeys\" type=\"hidden\" value=\"\" />\r\n" );
        print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

        $this->dumpBodyJavaScript();

        print( "</script>\r\n" );
    }

    protected function dumpBodyJavaScript()
    {
        $editableColumns = array();
        foreach( $this->NonGroupedColumns as $column )
        {
            $editableColumns[] = new JTPlatinumGridJSONColumn( $column->Name, $column->DataField,
                $column->CanEdit, $column->CanSelect );
        }

        $rowCount = ( ( $this->DataSet && $this->DataSet->Active ) ? $this->TotalRecordCount : 0 );
        if( $this->_Pager->Visible )
            $visibleRowCount = max( 0, min( $rowCount - ( $this->_Pager->CurrentPage * $this->_Pager->RowsPerPage ), $this->_Pager->RowsPerPage ) );
        else
            $visibleRowCount = $rowCount;

        $options = array
        (
            (bool)$this->_AlwaysShowEditor,
            (bool)$this->_CanMoveCols,
            (bool)$this->_CanMultiColumnSort,
            (bool)$this->_CanRangeSelect,
            (bool)$this->_CanResizeCols,
            false, // (bool)$this->_CanResizeRows,
            (bool)$this->_CanSelect,
            (bool)$this->_ReadOnly,
            (bool)$this->_RowSelect,
            GetJTJSEventToString( $this->_jsOnDataLoad ),
            count( $this->_Columns ),
            GetJTJSEventToString( $this->_jsOnRowEditing ),
            $this->_EditorStyle,
            $editableColumns,
            $this->_KeyField,
            $this->_GroupBy,
            $this->_SortBy,
            GetJTJSEventToString( $this->_jsOnRowEdited ),
            $this->EditingRow,
            GetJTJSEventToString( $this->_jsOnRowInserted ),
            $this->_ParentField,
            $rowCount,
            $visibleRowCount,
            (bool)$this->_CanDragSelect,
            (bool)$this->_AllowScrolling,
            GetJTJSEventToString( $this->_jsOnSelect ),
            false,
            (bool)$this->_ShowEditColumn,
            (bool)$this->_Header->FilterDelay,
            GetJTJSEventToString( $this->_jsOnCommand ),
            $this->_Header->FilterDelayTimeout,
            GetJTJSEventToString( $this->_jsOnRowDeleting ),
            (bool)$this->_FillWidth,
            GetJTJSEventToString( $this->_jsOnCustomCommand ),
            ( ( $this->_TabStop ) ? $this->_TabOrder : -1 )
        );

        $options = json_encode( $options );

        if( ( $this->ControlState & csDesigning ) == csDesigning )
            $requestor = 'null';
        else
            $requestor = $this->Name . 'Requestor';

        $themePath = $this->SiteThemeInstance->ThemeDir;

        print( "JTPlatinumGridInitialize( '{$this->Name}', $options, $requestor, '$themePath' );\r\n" );

        if( $this->_DetailView->Enabled && $this->DetailViewActive )
            $this->_DetailView->DetailGrid->dumpBodyJavaScript();

        foreach( $this->NonGroupedColumns as $column )
            $column->dumpBodyJavaScript( $this->IsAjax );

        if( ( $this->ControlState & csDesigning ) == csDesigning )
            print( $this->Name . ".Load();\r\n" );
    }

    function dumpForAjax()
    {
        global $ajaxResponse;

        $this->IsAjax = true;

        if( !$this->initializeSkin( $error ) )
            return;

        $this->callEvent( 'onshow', array() );

        ob_start();

        $this->internalDumpThemedContents();

        $contents = ob_get_clean();

        if( !defined( 'JT_STANDALONE' ) )
        {
            $ajaxResponse->assign( $this->Name . '_outerdiv', 'innerHTML', $contents );

            $this->dumpBodyJavaScript();
        }
        else
        {
            ob_start();

            $this->dumpBodyJavaScript();

            $jsCode = ob_get_clean();

            return array( $contents, $jsCode );
        }
    }

    protected function dumpGroupBar( $columns )
    {
        $result = '';

        if( count( $this->GroupByFields ) )
        {
            foreach( $this->GroupByFields as $groupColumn )
            {
                list( $columnName, $direction ) = $groupColumn;

                $i = $this->findColumnByFieldName( $columnName );
                if( $i < 0 )
                    throw new JTPlatinumGridException( "GroupBy referenced column '$columnName', which does not exist in " . get_class( $this ) . " instance " . $this->Name );

                $column = $this->_Columns[ $i ];

                $vars = array
                (
                    'COLUMNNAME'    => $columnName,
                    'COLUMNCAPTION' => $column->Caption,
                );

                if( $direction == 'DESC' )
                    $templateName = 'GroupColumnDesc';
                else
                    $templateName = 'GroupColumnAsc';

                $result .= $this->generateComponentSectionCode( $templateName, $vars );
            }
        }
        else
        {
            $result = $this->generateComponentSectionCode( 'NoGroupColumns', array() );
        }

        $vars = array
        (
            'COLUMNS'	=> $result
        );

        return $this->generateComponentSectionCode( 'GroupBar', $vars );
    }

    protected function dumpColumnsHeader( $columns, $haveAllColumnsWidth )
    {
        $result = '';

        if( $this->_ShowSelectColumn )
            $result .= $this->dumpSelectColumnHeader();

        foreach( $this->GroupByFields as $i => $groupByField )
            $result .= $this->dumpGroupByHeader( $i, $groupByField );

        $lastColIndex = count( $columns ) - 1;

		foreach( $columns as $i => $column )
			$result .= $column->dumpHeader( $this, $i, $lastColIndex );

        if( $this->_ShowEditColumn )
            $result .= $this->dumpEditColumnHeader();

        if( $haveAllColumnsWidth )
            $result .= '<td id="' . $this->Name . '_Phc" class="phc"></td>';

		$vars = array
		(
			'COLUMNS'	=> $result,
		);

		return $this->generateComponentSectionCode( 'ColumnsHeader', $vars );
    }

    protected function dumpSelectColumnHeader()
    {
        $vars = array
		(
		);

		return $this->generateComponentSectionCode( $this->_CanRangeSelect ? 'SelectColHeader' : 'SelectColHeaderBlank', $vars );
    }

    protected function dumpGroupByHeader( $groupIndex, $groupByField )
    {
        $vars = array
		(
		);

		return $this->generateComponentSectionCode( 'GroupByHeader', $vars );
    }

    protected function dumpEditColumnHeader()
    {
        $vars = array
		(
		);

		return $this->generateComponentSectionCode( 'EditColHeader', $vars );
    }

    protected function dumpFilterBar( $columns, $haveAllColumnsWidth )
    {
        $result = '';

        if( $this->_ShowSelectColumn )
            $result .= $this->generateComponentSectionCode( 'FilterBarEmptyCell', array() );

        foreach( $this->GroupByFields as $i => $groupByField )
            $result .= $this->generateComponentSectionCode( 'FilterBarEmptyCell', array() );

        foreach( $columns as $i => $column )
        {
            if( $column->CanFilter )
                $result .= $column->dumpFilter( $this, $this->_Header->SimpleFilter, $i );
            else
                $result .= $this->generateComponentSectionCode( 'FilterBarEmptyCell', array() );
        }

        if( $this->_ShowEditColumn )
            $result .= $this->generateComponentSectionCode( 'FilterBarEmptyCell', array() );

        if( $haveAllColumnsWidth )
            $result .= '<td id="' . $this->Name . '_phcfl" class="fl phcfl"></td>';

        $vars = array
		(
			'COLUMNS'	=> $result,
		);

		return $this->generateComponentSectionCode( 'FilterBar', $vars );
    }

    protected function dumpColGroup( $columns, $prefix )
    {
        $result = '';
        $vars = array( 'PREFIX' => $prefix );

        if( $this->_ShowSelectColumn )
            $result .= $this->generateComponentSectionCode( 'ColGroupSelectorItem', $vars );

        for( $i = 0; $i < count( $this->GroupByFields ); ++$i )
        {
            $vars[ 'INDEX' ] = $i;
            $result .= $this->generateComponentSectionCode( 'ColGroupGroupByItem', $vars );
        }

        for( $i = 0; $i < count( $columns ); ++$i )
        {
            $column = $columns[ $i ];

            if( $column->Visible )
            {
                $vars[ 'INDEX' ] = $i;
                $vars[ 'COLWIDTH' ] = $column->Width;
                $result .= $this->generateComponentSectionCode( 'ColGroupItem', $vars );
            }
        }

        if( $this->_ShowEditColumn )
            $result .= $this->generateComponentSectionCode( 'ColGroupEditorItem', $vars );

        return $result;
    }

    protected function dumpGridData( $columns, $haveAllColumnsWidth )
    {
        $result = '';

        if( $this->DataSet && $this->DataSet->Active )
        {
            if( $this->_ParentField && $this->_KeyField )
            {
                $result = $this->dumpGridTreeFromDataSet( $columns, $haveAllColumnsWidth );
            }
            else
            {
                $result = $this->dumpGridDataFromDataSet( $columns, $haveAllColumnsWidth );
            }
        }

        return $result;
    }

    protected function dumpGridTreeFromDataSet( $columns, $haveAllColumnsWidth )
    {
        $ds = $this->DataSet;

        if( $this->TotalRecordCount == 0 )
            return '';

        $i = 0;
        $idToObject = array();
        $possibleOrphans = array();
        $rootNode = new JTPlatinumGridTreeNode();

        for( $ds->First(); !$ds->Eof; $ds->Next() )
        {
            $row = $ds->Fields;
            if( isset( $row[ $this->_KeyField ] ) )
                $id = $row[ $this->_KeyField ];
            else
                $id = $i++;

            if( isset( $row[ $this->_ParentField ] ) )
                $parent = $row[ $this->_ParentField ];
            else
                $parent = '-1';

            if( $id == $parent )
                throw new JTPlatinumGridException( "Found self-referencing tree node in dataset. " . $this->_KeyField . " and " . $this->_ParentField . " = '$id'." );

            if( !isset( $idToObject[ $id ] ) )
            {
                $node = new JTPlatinumGridTreeNode();
                $idToObject[ $id ] = $node;
            }
            else
            {
                $node = $idToObject[ $id ];
            }

            $node->Fields = $row;

            if( $parent )
            {
                if( !isset( $idToObject[ $parent ] ) )
                {
                    $node->parent = $parent;
                    $possibleOrphans[] = $node;
                }
                else
                {
                    $parentNode = $idToObject[ $parent ];

                    if( $parentNode->isParent( $node ) )
                        throw new JTPlatinumGridException( "Found recursive parent in dataset. " . $this->_KeyField . " = '$id'." );

                    $parentNode->addChild( $node );
                }
            }
            else
            {
                $rootNode->addChild( $node );
            }
        }

        $oddEvenIndex = 0;
        $rowIndex = -1;
        $groupIndex = 0;

        foreach( $possibleOrphans as $node )
        {
            if( isset( $idToObject[ $node->parent ] ) )
            {
                $parentNode = $idToObject[ $node->parent ];

                if( $parentNode->isParent( $node ) )
                    throw new JTPlatinumGridException( "Found recursive parent in dataset. " . $this->_KeyField . " = '$id'." );

                $parentNode->addChild( $node );
            }
            else
            {
                $rootNode->addChild( $node );
            }
        }

        unset( $possibleOrphans );

        return $this->dumpTreeNode( $rootNode, $rowIndex, -1, true, $columns, $oddEvenIndex, $groupIndex, $haveAllColumnsWidth );
    }

    protected function dumpTreeNode( $node, &$rowIndex, $level, $isRoot, $columns, &$oddEvenIndex, &$groupIndex, $haveAllColumnsWidth )
    {
        if( !$node )
            return;

        $result = '';

        if( !$isRoot && $node->Fields )
            $result .= $this->dumpDataRow( $rowIndex, $columns, $node->Fields, $level, ( $node->firstChild != null ), $oddEvenIndex, $groupIndex, $haveAllColumnsWidth );

        for( $childNode = $node->firstChild; $childNode != null; $childNode = $childNode->nextSibling )
            $result .= $this->dumpTreeNode( $childNode, ++$rowIndex, $level + 1, false, $columns, ++$oddEvenIndex, ++$groupIndex, $haveAllColumnsWidth );

        return $result;
    }

    protected function dumpGridDataFromDataSet( $columns, $haveAllColumnsWidth )
    {
        $ds = $this->DataSet;
        $result = '';

        if( $this->TotalRecordCount == 0 )
            return '';

        // $ds->First();

        if( $this->_Pager->Visible )
        {
            // $startRow = $this->_Pager->CurrentPage * $this->_Pager->RowsPerPage;
            // if( $startRow )
            //     moveDataSetBy( $ds, $startRow );
            $rowsPerPage = $this->_Pager->getRowsPerPage();

            for( $i = 0, $oddEvenIndex = 0, $groupIndex = 0; !$ds->readEOF() && $i < $rowsPerPage; $ds->Next(), ++$i, ++$oddEvenIndex, ++$groupIndex )
                $result .= $this->dumpDataRow( $i, $columns, $ds->readFields(), 0, false, $oddEvenIndex, $groupIndex, $haveAllColumnsWidth );
        }
        else
        {
            for( $i = 0, $oddEvenIndex = 0, $groupIndex = 0; !$ds->readEOF(); $ds->Next(), ++$i, ++$oddEvenIndex, $groupIndex )
                $result .= $this->dumpDataRow( $i, $columns, $ds->readFields(), 0, false, $oddEvenIndex, $groupIndex, $haveAllColumnsWidth );
        }

        return $result;
    }

    protected function rowMatchesFilter( $columns, $fields )
    {
        foreach( $columns as $column )
        {
            if( !$column->matchesFilter( $fields ) )
                return false;
        }

        return true;
    }

    protected function dumpDataRow( $rowIndex, $columns, $fields, $level, $hasChildren, &$oddEvenIndex,
        &$groupIndex, $haveAllColumnsWidth )
    {
        if( $this->_onrowdata )
            $this->callEvent( 'onrowdata', array( $rowIndex, &$fields ) );

        $result = '';
        $detail = '';
        $groups = '';
        $memo = '';

        if( $this->_ShowSelectColumn )
            $result .= $this->dumpSelectColumn( $rowIndex, $fields );

        if( count( $this->GroupByFields ) > 0 )
        {
            $creatingGroup = false;
            foreach( $this->GroupByFields as $j => $groupColumn )
            {
                list( $groupField, $direction ) = $groupColumn;

                if( $fields[ $groupField ] != ( isset( $this->LastFieldValues[ $groupField ] ) ? $this->LastFieldValues[ $groupField ] : '' ) )
                    $creatingGroup = true;

                if( $creatingGroup )
                {
                    $groups .= $this->dumpGroupSection( $groupIndex, $j, $groupField, $fields, $columns );
                    ++$groupIndex;
                }

                $result .= $this->dumpGroupDataColumn( $rowIndex, $j, $groupField, $fields );
            }

            $this->LastFieldValues = $fields;
        }

        // $hasChildren = $hasChildren || $this->_DetailView->Enabled;

        if( $this->_RowSelect && isset( $this->_SelectedCells[ $rowIndex ] ) && $this->_SelectedCells[ $rowIndex ] )
        {
            $rowStyle = $this->_SelectedRowStyle;
            $defaultRowClass = 'selectedrow';
        }
        else
        {
            $rowStyle = null;

            foreach( $this->_RowDataStyles as $rowDataStyle )
            {
                if( $rowDataStyle->valueMatches( $this->_Columns, $fields ) )
                {
                    $rowStyle = $rowDataStyle->RowStyle;
                    break;
                }
            }

            if( ( $oddEvenIndex % 2 ) == 0 )
            {
                if( !$rowStyle )
                    $rowStyle = $this->_EvenRowStyle;

                $defaultRowClass = 'evenrow';
            }
            else
            {
                if( !$rowStyle )
                    $rowStyle = $this->_OddRowStyle;

                $defaultRowClass = 'oddrow';
            }
        }

        $rowClassCode = $defaultRowClass . ' ' . $rowStyle->CssCode;

        $curRange = null;
        $visibleIndex = 0;

        $detailViewEnabled = $this->_DetailView->getEnabled();
        $detailField = $this->_DetailView->getDetailField();
        $notDesigning = ( ( $this->ControlState & csDesigning ) == 0 );

        foreach( $columns as $i => $column )
        {
            $colspan = 1;
            $rowspan = 1;

            if( $curRange )
            {
                if( $curRange->StartCol != $i || $curRange->StartRow != $rowIndex )
                {
                    if( $i == $curRange->EndCol )
                        $curRange = null;

                    continue;
                }
                else
                {
                    $colspan = $range->EndCol - $range->StartCol + 1;
                    $rowspan = $range->EndRow - $range->StartRow + 1;
                }
            }

            $columnVisible = $column->getVisible();

            $selected = ( isset( $this->_SelectedCells[ $rowIndex ] ) && isset( $this->_SelectedCells[ $rowIndex ][ $i ] ) );
            $hs = ( $columnVisible && $visibleIndex == 0 && ( $hasChildren || $detailViewEnabled ) );

            $expanded = $hasChildren || ( $notDesigning && $detailViewEnabled && $fields[ $detailField ] == $this->_DetailValue );

            $c = $column->dumpDataCell( $this, $rowIndex, $i, $fields, $hs, $level, $colspan, $rowspan,
                $this->IndentFactor, $selected, (bool)$curRange, $expanded );

            $result .= $c;

            if( $columnVisible )
                ++$visibleIndex;
        }

        if( $this->_ShowEditColumn )
            $result .= $this->dumpEditColumn( $rowIndex, $fields );

        if( $haveAllColumnsWidth )
            $result .= '<td class="pcc"></td>';

        if( $this->_DetailView->Enabled )
        {
            if( isset( $fields[ $this->_DetailView->DetailField ] ) && $fields[ $this->_DetailView->DetailField ] == $this->_DetailValue )
            {
                $detail = $this->_DetailView->dumpDetailView( $this, $columns, $fields, $level, $this->IndentFactor );
                $this->DetailViewActive = true;
            }
        }

        if( $this->_MemoField )
            $memo = $this->dumpMemoRow( $rowIndex, $columns, $fields, $level, $rowClassCode, $groupIndex, $haveAllColumnsWidth );

        if( $this->_KeyField && !isset( $fields[ $this->_KeyField ] ) && ( $this->ControlState & csDesigning ) != csDesigning )
            throw new JTPlatinumGridException( "Failed to locate key field " . $this->_KeyField . " in data set." );

        if( $this->_KeyField && isset( $fields[ $this->_KeyField ] ) )
            $primaryKey = $fields[ $this->_KeyField ];
        else
            $primaryKey = '';

        if( $this->_DetailView->Enabled && $this->_DetailView->DetailField && isset( $fields[ $this->_DetailView->DetailField ] ) )
            $detailKey = $fields[ $this->_DetailView->DetailField ];
        else
            $detailKey = '';

        $visible = true;

        if( count( $this->_HiddenRowsByIndex ) > 0 )
            $visible = !in_array( $rowIndex, $this->_HiddenRowsByIndex );

        if( $visible && count( $this->_HiddenRowsByField ) > 0 )
        {
            foreach( $fields as $key => $value )
            {
                if( $this->_HiddenRowsByField[ $key ] == $value )
                {
                    $visible = false;
                    break;
                }
            }
        }

        if( !$visible )
            --$oddEvenIndex;

        $vars = array
        (
            'COLUMNS'       => $result,
            'DETAIL'        => $detail,
            'DETAILKEY'     => $detailKey,
            'EXTRACLASSES'  => ( !$visible ? 'novisible' : '' ),
            'GROUPROW'      => $groups,
            'LEVEL'         => $level,
            'MEMOROW'       => $memo,
            'PRIMARYKEY'    => $primaryKey,
            'ROWCLASS'      => $rowClassCode,
            'ROWINDEX'      => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'DataRow', $vars );
    }

    protected function dumpGroupSection( $rowIndex, $groupIndex, $groupField, $fields, $columns )
    {
        $prefixCols = '';
        $postfixCols = '';

        if( $this->_ShowSelectColumn /* && $groupIndex > 0 */ )
            $prefixCols .= $this->generateComponentSectionCode( 'GroupSelectCol', array() );

        for( $i = 0; $i < $groupIndex; ++$i )
            $prefixCols .= $this->dumpGroupPrefixColumn( $rowIndex, $i, $groupField );

        $prefixCols .= $this->dumpGroupExpandCollapseColumn( $rowIndex, $i, $groupField );

        $i = $this->findColumnByFieldName( $groupField );
        if( $i < 0 )
            throw new JTPlatinumGridException( "Failed to find column for field '$groupField'." );

        $groupColumn = $this->_Columns[ $i ];

        $groupColumnName = $groupColumn->Name;
        $groupColumnCaption = $groupColumn->Caption;

        $colCount = 0;

        foreach( $this->_Columns as $column )
        {
            if( $column->Visible )
                ++$colCount;
        }

        $colCount -= $groupIndex;

        if( $this->_ShowSelectColumn )
            --$colCount;

        if( $this->_ShowEditColumn )
            ++$colCount;

        /*if( $haveAllColumnsWidth )
            ++$colCount;*/

        $aggregateResult = $this->calculateGroupAggregates( $groupIndex, $fields, $columns );
        $aggregates = '';

        foreach( $columns as $column )
        {
            $columnAggregates = array();

            if( $column->GroupSummary->ShowAvg )
            {
                $outputField = $column->DataField . 'Avg';
                $columnAggregates[ 'Avg' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
            }

            if( $column->GroupSummary->ShowCount )
            {
                $outputField = $column->DataField . 'Count';
                $columnAggregates[ 'Count' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
            }

            if( $column->GroupSummary->ShowMin )
            {
                $outputField = $column->DataField . 'Min';
                $columnAggregates[ 'Min' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
            }

            if( $column->GroupSummary->ShowMax )
            {
                $outputField = $column->DataField . 'Max';
                $columnAggregates[ 'Max' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
            }

            if( $column->GroupSummary->ShowSum )
            {
                $outputField = $column->DataField . 'Sum';
                $columnAggregates[ $column->Caption ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
            }

            if( count( $columnAggregates ) > 0 )
            {
                if( $this->_onsummarydata )
                    $this->callEvent( 'onsummarydata', array( $i, $column, &$columnAggregates ) );

                $columnAggregateHtml = '';

                foreach( $columnAggregates as $name => $value )
                {
                    $columnAggregateHtml .= $this->generateComponentSectionCode( 'GroupAggregate', array(
                        'AGGREGATENAME'  => $this->SiteThemeInstance->retrieveString( $name ),
                        'AGGREGATEVALUE' => $value
                    ) );
                }

                $vars = array
                (
                    'COLCAPTION'    => $column->Caption,
                    'AGGREGATES'    => $columnAggregateHtml,
                );

                $aggregates .= $this->generateComponentSectionCode( 'GroupAggregateCol', $vars );
            }
        }

        if( $this->_ShowEditColumn )
            $postfixCols .= $this->dumpGroupPostfixColumn( $rowIndex, 0, $groupField );

        $groupValue = $fields[ $groupField ];
        $groupText = $groupColumn->dumpCellData( $this, $fields, $rowIndex, 0 );

        $vars = array
        (
            'AGGREGATES'        => $aggregates,
            'COLUMNINDEX'       => $i,
            'COLUMNNAME'        => $groupColumnName,
            'COLUMNCAPTION'     => $groupColumnCaption,
            'COLCOUNT'          => $colCount,
            'GROUPFIELD'        => $groupField,
            'GROUPINDEX'        => $groupIndex,
            'GROUPTEXT'         => $groupText,
            'GROUPVALUE'        => $this->dataValueToHTML( $groupValue ),
            'PREFIXCOLS'        => $prefixCols,
            'POSTFIXCOLS'       => $postfixCols,
            'ROWINDEX'          => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'GroupRow', $vars );
    }

    protected function dumpGroupPrefixColumn( $rowIndex, $groupIndex, $groupField )
    {
        $vars = array
        (
            'GROUPFIELD'    => $groupField,
            'GROUPINDEX'    => $groupIndex,
            'ROWINDEX'      => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'GroupPrefixCol', $vars );
    }

    protected function dumpGroupPostfixColumn( $rowIndex, $groupIndex, $groupField )
    {
        $vars = array
        (
            'GROUPFIELD'    => $groupField,
            'GROUPINDEX'    => $groupIndex,
            'ROWINDEX'      => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'GroupPostfixCol', $vars );
    }

    protected function dumpGroupExpandCollapseColumn( $rowIndex, $groupIndex, $groupField )
    {
        $vars = array
        (
            'GROUPFIELD'    => $groupField,
            'GROUPINDEX'    => $groupIndex,
            'ROWINDEX'      => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'GroupExpandCollapseCol', $vars );
    }

    protected function dumpGroupDataColumn( $rowIndex, $groupIndex, $groupField, $fields )
    {
        $vars = array
        (
            'GROUPFIELD'    => $groupField,
            'GROUPINDEX'    => $groupIndex,
            'ROWINDEX'      => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'DataGroupCol', $vars );
    }

    protected function dumpSelectColumn( $rowIndex, $fields )
    {
        $extraClasses = '';
        /*
        if( $rowIndex > 0 && $this->_GridLines->Horizontal )
            $extraClasses .= 'horzline ';

        if( $this->_GridLines->Vertical )
            $extraClasses .= 'vertline ';
        */

        $vars = array
        (
            'EXTRACLASSES'  => $extraClasses,
            'ROWINDEX'      => $rowIndex,
        );

        return $this->generateComponentSectionCode( 'SelectCol', $vars );
    }

    protected function dumpEditColumn( $rowIndex, $fields )
    {
        $extraClasses = '';
        /*
        if( $rowIndex > 0 && $this->_GridLines->Horizontal )
            $extraClasses .= 'horzline ';

        if( $this->_GridLines->Vertical )
            $extraClasses .= 'vertline ';
        */

        $vars = array
        (
            'EXTRACLASSES'  => $extraClasses,
            'ROWINDEX'      => $rowIndex,
        );

        if( $rowIndex > -1 )
        {
            if( $this->_AllowDelete && $this->_AllowUpdate )
                $template = 'EditCol';
            else if( $this->_AllowDelete )
                $template = 'EditColOnlyDelete';
            else if( $this->_AllowUpdate )
                $template = 'EditColOnlyEdit';
            else
                $template = 'EditColNothing';
        }
        else
        {
            if( $this->_AllowInsert )
                $template = 'EditColOnlyEdit';
            else
                $template = 'EditColNothing';
        }

        return $this->generateComponentSectionCode( $template, $vars );
    }

    protected function dumpMemoRow( $rowIndex, $columns, $fields, $level, $rowClassCode, $groupIndex, $haveAllColumnsWidth )
    {
        if( $this->_ShowSelectColumn )
            $prefixCols = $this->generateComponentSectionCode( 'BlankCell', array() );
        else
            $prefixCols = '';

        for( $i = 0; $i < count( $this->GroupByFields ); ++$i )
            $prefixCols .= $this->generateComponentSectionCode( 'DataGroupCol', array() );

        if( $this->_ShowEditColumn )
            $postfixCols = $this->generateComponentSectionCode( 'BlankCell', array() );
        else
            $postfixCols = '';

        $c = 0;
        foreach( $columns as $column )
        {
            if( $column->getVisible() )
                ++$c;
        }

        if( $this->_ShowEditColumn )
            ++$c;

        if( $haveAllColumnsWidth )
            ++$c;

        $value = isset( $fields[ $this->_MemoField ] ) ? $fields[ $this->_MemoField ] : '';

        $vars = array
        (
            'COLUMNCOUNT'   => $c,
            'INDENT'        => ( $level * $this->IndentFactor ),
            'PREFIXCOLS'    => $prefixCols,
            'POSTFIXCOLS'   => $postfixCols,
            'ROWINDEX'      => $rowIndex,
            'ROWCLASS'      => $rowClassCode,
            'VALUE'         => $this->dataValueToHTML( $value ),
        );

        return $this->generateComponentSectionCode( 'MemoRow', $vars );
    }

    protected function dumpPager()
    {
        if( $this->_Pager->RowsPerPage < 1 )
            throw new JTPlatinumGridException( get_class( $this ) . " instance " . $this->Name . "->Pager->RowsPerPage is less than 1." );

        if( !$this->_Pager->Visible )
            return '';

        if( $this->DataSet && $this->DataSet->Active )
            $recordCount = $this->TotalRecordCount;
        else
            $recordCount = 0;

        $totalPageCount = ceil( $recordCount / $this->_Pager->RowsPerPage );
        $firstVisiblePage = max( 0, min( $this->_Pager->CurrentPage - floor( $this->_Pager->VisiblePageCount / 2 ), $totalPageCount - $this->_Pager->VisiblePageCount ) );

        if( $recordCount > -1 )
            $pageCount = min( $totalPageCount, $this->_Pager->VisiblePageCount );
        else
            $pageCount = 1;

        $visiblePageCount = $pageCount - $firstVisiblePage;
        $currentPage = $this->_Pager->CurrentPage;

        $vars = array
        (
            'REQUESTOR' => $this->Name . 'Requestor'
        );

        if( $currentPage > 0 )
        {
            $result = $this->generateComponentSectionCode( 'PagerToFirstPage', $vars );

            $vars[ 'INDEX' ] = $currentPage - 1;
            $result .= $this->generateComponentSectionCode( 'PageToPreviousPage', $vars );
        }
        else
        {
            $result = $this->generateComponentSectionCode( 'PagerToFirstPageDisabled', $vars );

            $vars[ 'INDEX' ] = $currentPage - 1;
            $result .= $this->generateComponentSectionCode( 'PageToPreviousPageDisabled', $vars );
        }

        for( $i = 0; $i < $pageCount; ++$i )
        {
            $page = $firstVisiblePage + $i;

            $vars[ 'INDEX' ] = $page;
            $vars[ 'PAGENO' ] = ( $page + 1 );
            if( $page == $currentPage )
                $result .= $this->generateComponentSectionCode( 'PagerCurrentPage', $vars );
            else
                $result .= $this->generateComponentSectionCode( 'PagerToPage', $vars );
        }

        if( $currentPage < ( $totalPageCount - 1 ) )
        {
            $vars[ 'INDEX' ] = $currentPage + 1;
            $result .= $this->generateComponentSectionCode( 'PagerToNextPage', $vars );

            $vars[ 'INDEX' ] = $totalPageCount - 1;
            $result .= $this->generateComponentSectionCode( 'PagerToLastPage', $vars );
        }
        else
        {
            $vars[ 'INDEX' ] = $currentPage + 1;
            $result .= $this->generateComponentSectionCode( 'PagerToNextPageDisabled', $vars );

            $vars[ 'INDEX' ] = $totalPageCount - 1;
            $result .= $this->generateComponentSectionCode( 'PagerToLastPageDisabled', $vars );
        }

        if( $this->_Pager->ShowPageInfo )
            $pageInfo = sprintf( $this->SiteThemeInstance->retrieveString( 'PagerInfo' ), min( $currentPage + 1, $totalPageCount ), $totalPageCount ) . '&nbsp;';
        else
            $pageInfo = '';

        if( $this->_Pager->ShowRecordCount )
            $recordCountInfo = sprintf( $this->SiteThemeInstance->retrieveString( 'PagerRecordCount' ), $recordCount );
        else
            $recordCountInfo = '&nbsp;';

        $vars = array
        (
            'CONTENT'   => $result,
            'PAGEINFO'  => $pageInfo . $recordCountInfo,
        );

        return $this->generateComponentSectionCode( 'Pager', $vars );
    }

    protected function dumpEditor( $columns )
    {
        $result = '';

        if( $this->_EditorStyle == self::Inline )
            $columnEditorTemplate = 'ColumnEditorInline';
        else
            $columnEditorTemplate = 'ColumnEditorForm';

        foreach( $columns as $i => $column )
        {
            if( $column->CanEdit )
            {
                $vars = array
                (
                    'COLUMNINDEX'   => $i,
                    'COLUMNNAME'    => $column->Name,
                    'COLUMNCAPTION' => $column->Caption,
                    'COLUMNFIELD'   => $column->DataField,
                    'EDITOR'        => $column->dumpEditor( $this ),
                );

                $result .= $this->generateComponentSectionCode( $columnEditorTemplate, $vars );
            }
        }

        if( $this->_EditorStyle == self::Inline )
            $editorTemplate = 'EditorInline';
        else
            $editorTemplate = 'EditorForm';

        $colCount = count( $columns );

        if( $this->_ShowSelectColumn )
            ++$colCount;

        if( $this->_ShowEditColumn )
            ++$colCount;

        $vars = array
        (
            'COLUMNCOUNT'   => $colCount,
            'COLUMNEDITORS' => $result,
        );

        return $this->generateComponentSectionCode( $editorTemplate, $vars );
    }

    protected function dumpInsertRow( $columns )
    {
        $result = '';

        if( $this->_ShowSelectColumn )
            $result .= $this->generateComponentSectionCode( 'BlankCell', array() );

        if( $this->DataSet && $this->DataSet->Active )
            $rowCount = $this->TotalRecordCount;
        else
            $rowCount = 0;

        foreach( $this->GroupByFields as $groupColumn )
            $result .= $this->generateComponentSectionCode( 'BlankCell', array() );

        foreach( $columns as $i => $column )
            $result .= $column->dumpInsertCell( $this, $rowCount, $i );

        if( $this->_ShowEditColumn )
            $result .= $this->dumpEditColumn( '-2', array() );

        $vars = array
        (
            'COLUMNS'   => $result,
        );

        return $this->generateComponentSectionCode( 'InsertRow', $vars );
    }

    protected function dumpSummary( $columns )
    {
        $result = '';
        $aggregateResult = $this->calculateAggregates( $this->DataSet, $columns );
        if( count( $aggregateResult ) == 0 )
            return '';

        if( $this->ShowSelectColumn )
            $result .= $this->generateComponentSectionCode( 'SummarySelectCell', array( 'EXTRACLASSES' => 'sc' ) );

        foreach( $this->GroupByFields as $j => $groupColumn )
            $result .= $this->generateComponentSectionCode( 'SummaryGroupCell', array( 'EXTRACLASSES' => 'grpc' ) );

        foreach( $columns as $i => $column )
        {
            $columnAggregateHtml = '';

            if( $column->Summary->ShowAvg || $column->Summary->ShowCount || $column->Summary->ShowMax ||
                $column->Summary->ShowMin || $column->Summary->ShowSum )
            {
                $columnAggregates = array();

                if( $column->Summary->ShowAvg )
                {
                    $outputField = $column->DataField . 'Avg';
                    $columnAggregates[ 'Avg' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
                }

                if( $column->Summary->ShowCount )
                {
                    $outputField = $column->DataField . 'Count';
                    $columnAggregates[ 'Count' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
                }

                if( $column->Summary->ShowMin )
                {
                    $outputField = $column->DataField . 'Min';
                    $columnAggregates[ 'Min' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
                }

                if( $column->Summary->ShowMax )
                {
                    $outputField = $column->DataField . 'Max';
                    $columnAggregates[ 'Max' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';
                }

                if( $column->Summary->ShowSum )
                {
            		//SHIRALY
                //    $outputField = $column->DataField . 'Sum';
                //    $columnAggregates[ $column->Caption ] = isset( $aggregateResult[ $outputField ] ) ? number_format($aggregateResult[ $outputField ], 2, '.', '') : '';

                    $outputField = $column->DataField . 'Sum';
                    $columnAggregates[ 'Sum' ] = isset( $aggregateResult[ $outputField ] ) ? $aggregateResult[ $outputField ] : '';

                }

                if( $this->_onsummarydata )
                    $this->callEvent( 'onsummarydata', array( $i, $column, &$columnAggregates ) );

                foreach( $columnAggregates as $name => $value )
                {
                    $columnAggregateHtml .= $this->generateComponentSectionCode( 'ColumnAggregate', array(
                        'AGGREGATENAME'  => $this->SiteThemeInstance->retrieveString( $name ),
                        'AGGREGATEVALUE' => $value
                    ) );
                }
            }

            $vars = array
            (
                'COLUMNINDEX'   => $i,
                'COLUMNNAME'    => $column->Name,
                'COLUMNCAPTION' => $column->Caption,
                'COLUMNFIELD'   => $column->DataField,
                'AGGREGATES'    => $columnAggregateHtml,
            );

            $template = ( $column->Summary->ShowAvg || $column->Summary->ShowCount || $column->Summary->ShowMax ||
                $column->Summary->ShowMin || $column->Summary->ShowSum ) ? 'ColumnAggregates' : 'ColumnNoAggregates';

            $result .= $this->generateComponentSectionCode( $template, $vars );
        }

        if( $this->ShowEditColumn )
            $result .= $this->generateComponentSectionCode( 'SummaryEditCell', array( 'EXTRACLASSES' => 'edtc' ) );

        $vars = array(
            'COLUMNS'   => $result,
        );

        return $this->generateComponentSectionCode( 'Summary', $vars );
    }

    protected function dumpCommandBar()
    {
        $commands = array();

        if( $this->_CommandBar->ShowInsertRecord )
        {
            $commands[] = new JTPlatinumGridCommandBarItem( null,
                $this->retrieveString( 'InsertRecord' ), 'insert' );
        }

        if( $this->_CommandBar->ShowRefresh )
        {
            $commands[] = new JTPlatinumGridCommandBarItem( null,
                $this->retrieveString( 'Refresh' ), 'refresh' );
        }

        if( $this->_CommandBar->ShowExportCSV )
        {
            $commands[] = new JTPlatinumGridCommandBarItem( null,
                $this->retrieveString( 'ExportCSV' ), 'exportcsv' );
        }

        if( $this->_CommandBar->ShowExportPDF )
        {
            $commands[] = new JTPlatinumGridCommandBarItem( null,
                $this->retrieveString( 'ExportPDF' ), 'exportpdf' );
        }

        if( $this->_CommandBar->ShowExportXLS )
        {
            $commands[] = new JTPlatinumGridCommandBarItem( null,
                $this->retrieveString( 'ExportXLS' ), 'exportxls' );
        }

        if( $this->_CommandBar->ShowPrint )
        {
            $commands[] = new JTPlatinumGridCommandBarItem( null,
                $this->retrieveString( 'Print' ), 'print' );
        }

        $commands = array_merge( $commands, $this->_CommandBar->CustomCommands );
        $commandHTML = '';

        foreach( $commands as $command )
        {
            $commandHTML .= $this->generateComponentSectionCode( 'CommandBarItem', array(
                'CAPTION'       => $command->Caption,
                'COMMAND'       => $command->Command,
                'CMDCSSCLASS'   => 'cmd-' . preg_replace( '[^a-z0-9]', '', strtolower( $command->Command ) ),
            ) );
        }

        return $this->generateComponentSectionCode( 'CommandBar', array(
            'COMMANDS'  => $commandHTML
        ) );
    }

    protected function generateColumns()
    {
        $result = array();

        if( $this->DataSet /* && $this->_Datasource */ )
        {
            $ds = $this->DataSet;

            if( $ds->Active )
            {
                $ds->First();

                if( !$ds->Eof )
                {
                    foreach( $ds->Fields as $fieldName => $value )
                    {
                        $fieldProps = $ds->readFieldProperties( $fieldName );

                        if( $fieldProps && array_key_exists( 'displaywidth', $fieldProps ) )
                            $colWidth = $fieldProps[ 'displaywidth' ][ 0 ];
                        else
                            $colWidth = '';

                        if( $fieldProps && array_key_exists( 'displaylabel', $fieldProps ) )
                            $colDisplayName = $fieldProps[ 'displaylabel' ][ 0 ];
                        else
                            $colDisplayName = $fieldName;

                        $column = new JTPlatinumGridTextColumn( $this );
                        $column->Caption = $colDisplayName;
                        $column->DataField = $fieldName;
                        $column->Name = "JTPlatinumGridTextColumn" . count( $result );

                        if( $colWidth )
                            $column->Width = $colWidth;

                        $result[] = $column;
                    }
                }
            }
        }
        else
        {
            if( count( $this->_CellData ) > 0 )
            {
                $firstRow = $this->_CellData[ 0 ];

                $l = count( $firstRow );
                for( $i = 0; $i < $l; ++$i )
                {
                    $column = new JTPlatinumGridTextColumn( $this );
                    $column->Caption = "Column$i";
                    $column->DataField = $i;
                    $column->Name = "JTPlatinumGridTextColumn" . $i;

                    $result[] = $column;
                }
            }
        }

        return $result;
    }

    protected function executeCommand( $command )
    {
        list( $cmd, $params ) = explode( ',', $command, 2 );

        switch( $cmd )
        {
            case "sort":
                $this->executeSort( $params );
                break;

            case "delete":
                $this->executeDelete( $params );
                break;

            case "insert":
                $this->executeInsert( $params );
                break;

            case "update":
                $this->executeUpdate( $params );
                break;

            case "detail":
                $this->executeDetail( $params );
                break;

            case "group":
                $this->executeGroupBy( $params );
                break;

            case "movecol":
                $this->executeMoveColumn( $params );
                break;

            case "command":
                $this->executeColumnCommand( $params );
                break;

            case "page":
                $this->executePageCommand( $params );
                break;

            case "exportcsv":
                $this->exportGridToCSVDownload( '', ',', false, $this->_CommandBar->ExportAllRecords );
                break;

            case "exportpdf":
                $this->exportGridToPDFDownload( '', '', '', $this->_CommandBar->ExportAllRecords );
                break;

            case "exportxls":
                $this->exportGridToXLSDownload( '', 'Sheet1', $this->_CommandBar->ExportAllRecords );
                break;

            case "print":
                $this->printGrid( $this->_name, $this->_CommandBar->PrintAllRecords );
                break;

            case "custom":
                $this->executeCustomCommand( $params );
                break;
        }
    }

    protected function executeSort( $params )
    {
        $this->SortBy = $params;

        $this->callEvent( 'onsort', array() );
    }

    protected function executeDelete( $params )
    {
        if( !$this->_AllowDelete )
            throw new JTPlatinumGridException( "Delete operation is not allowed in " . $this->Name );

        if( !$this->_KeyField )
            throw new JTPlatinumGridException( "Delete operation cannot be performed. " . $this->Name . "->KeyField not set" );

        if( !$this->_Datasource && !$this->_ondelete )
            throw new JTPlatinumGridException( "Delete operation cannot be performed. " . $this->Name . "->Datasource not set" );

        $rowsToDelete = json_decode( $params );
        if( !is_array( $rowsToDelete ) )
            throw new JTPlatinumGridException( "Unexpected parameters sent to delete command. Expected JSON array, received " . gettype( $rowsToDelete ) );

        if( $this->_ondelete || !$this->DbDriven )
        {
            $this->callEvent( 'ondelete', array( $rowsToDelete ) );
        }
        else
        {
            if( $this->_Datasource && !$this->_Datasource->DataSet )
                throw new JTPlatinumGridException( "Delete operation cannot be performed. " . $this->_Datasource->Name . "->DataSet not set" );

            if( $this->_Datasource && !$this->_Datasource->DataSet->Database )
                throw new JTPlatinumGridException( "Delete operation cannot be performed. " . $this->_Datasource->DataSet->Name . "->Database not set" );

            if( !$this->_Datasource->DataSet->TableName )
                throw new JTPlatinumGridException( "Delete operation cannot be performed. " . $this->_Datasource->DataSet->Name . "->TableName not set" );

            $param = $this->_Datasource->DataSet->Database->Param( $this->_KeyField );
            $sql = "DELETE FROM " . $this->_Datasource->DataSet->TableName . " WHERE " . $this->_KeyField . " = " . $param;

            foreach( $rowsToDelete as $row )
            {
                $params = ( $param == "?" ) ? array( $row ) : array( $this->_KeyField => $row );

                $this->_Datasource->DataSet->Database->Execute( $sql, array( $this->_KeyField => $row ) );
            }
        }

        $this->DataModified = true;
    }

    protected function executeInsert( $params )
    {
        if( !$this->_AllowInsert )
            throw new JTPlatinumGridException( "Insert operation is not allowed in " . $this->Name );

        if( !$this->_Datasource && !$this->_oninsert )
            throw new JTPlatinumGridException( "Insert operation cannot be performed. " . $this->Name . "->Datasource not set" );

        if( !$this->_UTF8 )
            $params = utf8_encode( $params );

        $fieldValues = json_decode( $params, true );
        if( !is_array( $fieldValues ) )
            throw new JTPlatinumGridException( "Unexpected parameters sent to insert command. Expected JSON array, received " . gettype( $fieldValues ) );

        if( count( $fieldValues ) < 2 )
            throw new JTPlatinumGridException( "Unexpected parameters sent to update command. No values sent." );

        unset( $fieldValues[ 'json' ] );

        if( $this->_onrowinserted && $this->callEvent( 'onrowinserted', array( &$fieldValues ) ) === false )
            return;

        if( $this->_oninsert || !$this->DbDriven )
        {
            $this->callEvent( 'oninsert', array( $fieldValues ) );
        }
        else
        {
            if( $this->_Datasource && !$this->_Datasource->DataSet )
                throw new JTPlatinumGridException( "Insert operation cannot be performed. " . $this->_Datasource->Name . "->DataSet not set" );

            if( $this->_Datasource && !$this->_Datasource->DataSet->Database )
                throw new JTPlatinumGridException( "Insert operation cannot be performed. " . $this->_Datasource->DataSet->Name . "->Database not set" );

            if( !$this->_Datasource->DataSet->TableName )
                throw new JTPlatinumGridException( "Insert operation cannot be performed. " . $this->_Datasource->DataSet->Name . "->TableName not set" );

            $fields = array_keys( $fieldValues );
            $values = array();
            $parameters = array();

            foreach( $fieldValues as $fieldName => $fieldValue )
            {
                $i = $this->findColumnByFieldName( $fieldName );
                if( $i < 0 )
                    throw new JTPlatinumGridException( "Invalid data received for insert from client. '$fieldName' not found in " . $this->Name . "->Columns" );

                $param = $this->_Datasource->DataSet->Database->Param( $fieldName );
                $values[] = $param;

                $fieldValue = $this->_Columns[ $i ]->processFieldValue( $fieldValue );

                if( !$this->_UTF8 )
                    $fieldValue = utf8_decode( $fieldValue );

                if( $param == "?" )
                    $parameters[] = $fieldValue;
                else
                    $parameters[ $fieldName ] = $fieldValue;
            }

            $fields = implode( ',', $fields );
            $values = implode( ',', $values );

            $sql = "INSERT INTO " . $this->_Datasource->DataSet->TableName . " ($fields) VALUES($values)";
            if( !$this->_Datasource->DataSet->Database->Execute( $sql, $parameters ) )
                throw new JTPlatinumGridException( "Failed to insert record." );
        }

        $this->DataModified = true;
    }

    protected function executeUpdate( $params )
    {
        if( !$this->_AllowUpdate || $this->_ReadOnly )
            throw new JTPlatinumGridException( "Update operation is not allowed in " . $this->Name );

        if( !$this->_Datasource && !$this->_onupdate )
            throw new JTPlatinumGridException( "Update operation cannot be performed. " . $this->Name . "->Datasource not set" );

        if( !$this->_KeyField )
            throw new JTPlatinumGridException( "Update operation cannot be performed. " . $this->Name . "->KeyField not set" );

        list( $editingRow, $jsonFields ) = explode( ',', $params, 2 );

        if( !$this->_UTF8 )
            $jsonFields = utf8_encode( $jsonFields );

        $fieldValues = json_decode( $jsonFields, true );
        if( !is_array( $fieldValues ) )
            throw new JTPlatinumGridException( "Unexpected parameters sent to update command. Expected JSON array, received " . gettype( $fieldValues ) );

        if( count( $fieldValues ) < 2 )
            throw new JTPlatinumGridException( "Unexpected parameters sent to update command. No values sent." );

        unset( $fieldValues[ 'json' ] );

        if( $this->_onrowedited && $this->callEvent( 'onrowedited', array( &$fieldValues ) ) === false )
        {
            $this->EditingRow = $editingRow;
            return;
        }

        $oldKeyValue = array_shift( $fieldValues );

        if( $this->_onupdate || !$this->DbDriven )
        {
            $this->callEvent( 'onupdate', array( $oldKeyValue, $fieldValues ) );
        }
        else
        {
            if( $this->_Datasource && !$this->_Datasource->DataSet )
                throw new JTPlatinumGridException( "Update operation cannot be performed. " . $this->_Datasource->Name . "->DataSet not set" );

            if( $this->_Datasource && !$this->_Datasource->DataSet->Database )
                throw new JTPlatinumGridException( "Update operation cannot be performed. " . $this->_Datasource->DataSet->Name . "->Database not set" );

            if( !$this->_Datasource->DataSet->TableName )
                throw new JTPlatinumGridException( "Update operation cannot be performed. " . $this->_Datasource->DataSet->Name . "->TableName not set" );

            $setters = array();
            $parameters = array();

            foreach( $fieldValues as $fieldName => $fieldValue )
            {
                $i = $this->findColumnByFieldName( $fieldName );
                if( $i < 0 )
                    throw new JTPlatinumGridException( "Invalid data received for update from client. '$fieldName' not found in " . $this->Name . "->Columns" );

                $param = $this->_Datasource->DataSet->Database->Param( $fieldName );
                $setters[] = "$fieldName = " . $param;

                $fieldValue = $this->_Columns[ $i ]->processFieldValue( $fieldValue );

                if( !$this->_UTF8 )
                    $fieldValue = utf8_decode( $fieldValue );

                if( $param == "?" )
                    $parameters[] = $fieldValue;
                else
                    $parameters[ $fieldName ] = $fieldValue;
            }

            $setters = implode( ',', $setters );

            $param = $this->_Datasource->DataSet->Database->Param( $this->_KeyField );

            if( !$this->_UTF8 )
                $oldKeyValue = utf8_decode( $oldKeyValue );

            if( $param == "?" )
                $parameters[] = $oldKeyValue;
            else
                $parameters[ $this->_KeyField ] = $oldKeyValue;

            $sql = "UPDATE " . $this->_Datasource->DataSet->TableName . " SET $setters WHERE " . $this->_KeyField . " = " . $param;
            $this->_Datasource->DataSet->Database->Execute( $sql, $parameters );
        }

        $this->DataModified = true;
    }

    protected function executeDetail( $params )
    {
        if( $this->_DetailView->Enabled && $this->_DetailView->DetailField )
            $this->_DetailValue = $params;
    }

    protected function executeGroupBy( $params )
    {
        $this->GroupBy = $params;

        $this->callEvent( 'ongroup', array() );
    }

    protected function executeMoveColumn( $params )
    {
        list( $columnName, $newPosition ) = explode( ',', $params, 2 );

        $i = $this->findColumnByName( $columnName );
        if( $i < 0 )
            return;

        $srcColumn = $this->_Columns[ $i ];
        $j = 0;
        $fi = -1;

        foreach( $this->_Columns as $k => $column )
        {
            foreach( $this->GroupByFields as $groupColumn )
            {
                list( $fieldName, $direction ) = $groupColumn;

                if( $column->DataField == $fieldName )
                    continue 2;
            }

            if( $j == $newPosition )
            {
                $fi = $k;
                break;
            }

            ++$j;
        }

        array_splice( $this->_Columns, $i, 1 );
        if( $fi == -1 )
        {
            array_push( $this->_Columns, $srcColumn );
        }
        else
        {
            if( $fi >= $i )
                --$fi;
            array_splice( $this->_Columns, $fi, 0, array( $srcColumn ) );
        }
    }

    protected function executeColumnCommand( $params )
    {
        list( $rowIndex, $colIndex, $commandIndex, $primaryKey ) = explode( ',', $params, 4 );

        if( !is_numeric( $rowIndex ) || $rowIndex < 0 ||
            $colIndex < 0 || $colIndex >= count( $this->_Columns ) ||
            !is_numeric( $commandIndex ) || $commandIndex < 0 )
        {
            throw new JTPlatinumGridException( "Invalid data passed to " . $this->Name . ".Command." );
        }

        $primaryKey = json_decode( $primaryKey, true );
        if( !is_array( $primaryKey ) )
            throw new JTPlatinumGridException( "Unexpected parameters sent to column command. Expected JSON array, received " . gettype( $primaryKey ) );

        if( count( $primaryKey ) < 1 )
            throw new JTPlatinumGridException( "Unexpected parameters sent to column command. No values sent." );

        unset( $primaryKey[ 'json' ] );

        $primaryKey = reset( $primaryKey );

        $column = $this->_Columns[ $colIndex ];
        if( !( $column instanceof JTPlatinumGridCommandColumn ) )
            throw new JTPlatinumGridException( "Invalid column index passed to Command, specifed column not JTPlatinumGridCommandColumn type." );

        $command = $column->Commands[ $commandIndex ];

        $this->callEvent( 'oncommand', array( $rowIndex, $colIndex, $column, $commandIndex, $command, $command->Argument, $primaryKey ) );
    }

    protected function executePageCommand( $params )
    {
        if( is_numeric( $params ) )
        {
            $this->_Pager->CurrentPage = $params;
            $this->_SelectedCells = array();
            $_POST[ $this->Name . '_Selection' ] = '';
        }
    }

    protected function executeCustomCommand( $params )
    {
        list( $command, $data ) = explode( ',', $params, 4 );

        $data = json_decode( $data );
        if( $data && is_array( $data ) )
            $data = $data[ 0 ];

        $this->callEvent( 'oncustomcommand', array( $command, $data ) );
    }

    protected function initDataSet()
    {
        if( !$this->DataSet )
        {
            $this->initDetailView();

            if( ( $this->ControlState & csDesigning ) != csDesigning && $this->_Datasource )
            {
                $this->DataSet = new JTPlatinumGridSQLDataSet( $this->_Datasource );
            }
            else
            {
                if( ( $this->ControlState & csDesigning ) != csDesigning )
                    $data = $this->CellData;
                else
                    $data = $this->makeDummyData();

                $this->DataSet = new JTPlatinumGridArrayDataSet( $data );
            }

            $sortParams = $this->addSortToDataSet();
            $filterParams = $this->addFiltersToDataSet();

            $applyFilterSort = true;

            if( $this->_onsql && $this->_Datasource )
            {
                if( !defined( 'JT_STANDALONE' ) && $this->_Datasource->DataSet && $this->_Datasource->DataSet instanceof DBDataSet )
                    $this->_Datasource->DataSet->Order = '';

                if( $this->callEvent( 'onsql', array_merge( $sortParams, $filterParams ) ) !== false )
                    $applyFilterSort = false;
            }

            if( $applyFilterSort )
            {
                $this->DataSet->Filter = $filterParams[ 0 ];
                $this->DataSet->OrderField = $sortParams[ 0 ];
            }

            $shouldGetCount = true;
            $this->TotalRecordCount = null;

            if( $this->_ongetrecordcount )
                $this->TotalRecordCount = $this->callEvent( 'ongetrecordcount', $filterParams );

            if( $this->TotalRecordCount === null )
                $this->TotalRecordCount = $this->DataSet->RecordCount;

            if( $this->_Pager->Visible )
            {
                if( ( $this->_Pager->CurrentPage * $this->_Pager->RowsPerPage ) > $this->TotalRecordCount )
                    $this->_Pager->CurrentPage = (int)( $this->TotalRecordCount / $this->_Pager->RowsPerPage );

                $this->DataSet->LimitStart = $this->_Pager->CurrentPage * $this->_Pager->RowsPerPage;
                $this->DataSet->LimitCount = $this->_Pager->RowsPerPage;
            }
            else
            {
                $this->DataSet->LimitStart = '-1';
                $this->DataSet->LimitCount = '-1';
            }

            $this->DataSet->Open();
        }

        $this->DataSet->First();
    }

    protected function initDetailView()
    {
        if( isset( $_SESSION[ $this->readNamePath() . '.DetailParams' ] ) )
        {
            list( $masterField, $masterValue ) = $_SESSION[ $this->readNamePath() . '.DetailParams' ];

            if( $this->_Datasource && $this->_Datasource->DataSet && $this->_Datasource->DataSet->MasterSource &&
                $this->_Datasource->DataSet->MasterSource->DataSet )
            {
                $ms = $this->_Datasource->DataSet->MasterSource->DataSet;

                if( !defined( 'JT_STANDALONE' ) )
                {
                    $ms->Open();
                    $ms->Edit();
                    $ms->fieldbuffer[ $masterField ] = $masterValue;
                }
                else
                {
                    $ms->Fields[ $masterField ] = $masterValue;
                }

                $this->_Datasource->DataSet->Refresh();
            }
        }
    }

    protected function makeDummyData()
    {
        if( count( $this->_Columns ) == 0 )
        {
            $columns = array( 'Column1', 'Column2', 'Column3', 'Column4' );
        }
        else
        {
            $columns = array();

            foreach( $this->_Columns as $column )
                $columns[] = $column->DataField;
        }

        $data = array();

        for( $i = 0; $i < 5; ++$i )
        {
            $row = array();

            foreach( $columns as $j => $name )
                $row[ $name ] = 'Data' . $i . $j;

            $data[] = $row;
        }

        return $data;
    }

    protected function addSortToDataSet()
    {
        $columnSortArray = array();

        $sortColumns = array_filter( explode( ',', $this->_SortBy ) );
        $groupByColumns = array_filter( explode( ',', $this->_GroupBy ) );

        foreach( $groupByColumns as $sortColumn )
        {
            $sortBits = preg_split( '/\s+/', trim( $sortColumn ) );
            $columnName = $sortBits[ 0 ];
            $direction = ( count( $sortBits ) > 1 ) ? $sortBits[ 1 ] : '';

            $direction = strtoupper( $direction );
            if( !$direction )
                $direction = "ASC";

            if( !preg_match( '/^[a-z0-9\_\.]+$/i', $columnName ) || ( $direction && $direction != "ASC" && $direction != "DESC" ) )
                throw new JTPlatinumGridException( "Invalid grouping column specified in " . $this->Name . "->GroupBy. Found \"$sortColumn\", expected column name [ASC/DESC]" );

            if( count( $this->_Columns ) )
            {
                $i = $this->findColumnByFieldName( $columnName );
                if( $i < 0 )
                    throw new JTPlatinumGridException( "Cannot find column in " . $this->Name . " for group field \"$columnName\"." );

                $this->_Columns[ $i ]->SortDirection = $direction;
            }

            $columnSortArray[ $columnName ] = $direction;
        }

        foreach( $sortColumns as $sortColumn )
        {
            $sortBits = preg_split( '/\s+/', trim( $sortColumn ) );
            $columnName = $sortBits[ 0 ];
            $direction = ( count( $sortBits ) > 1 ) ? $sortBits[ 1 ] : '';

            $direction = strtoupper( $direction );
            if( !$direction )
                $direction = "ASC";

            $columnSortArray[ $columnName ] = $direction;
        }

        $sortStr = implode( ',', array_merge( $groupByColumns, $sortColumns ) );

        return array( $sortStr, $columnSortArray );
    }

    protected function addFiltersToDataSet()
    {
        $filterList = array();

        foreach( $this->_Columns as $column )
        {
            if( ( !$this->_Header->SimpleFilter && $column->FilterMethod == JTPlatinumGridColumn::FilterNoFilter ) || strlen( $column->DataField ) == 0 )
                continue;

            if( $column->Filter || $column->FilterMethod )
            {
                $this->sqlQuote( $column->Filter, $value, $valueQuoted );

                $sql = $column->generateFilterSQL( $this, $value, $valueQuoted, $this->_Header->SimpleFilter );
                if( $sql !== false )
                    $filterList[] = $sql;
            }
        }

        $filterStr = implode( ' AND ', $filterList );

        return array( $filterStr, $filterList );
    }

    protected function calculateGroupAggregates( $groupIndex, $fields, $columns )
    {
        $conditions = array();

        foreach( $this->GroupByFields as $j => $groupColumn )
        {
            if( $j > $groupIndex )
                break;

            list( $groupField, $direction ) = $groupColumn;

            $conditions[] = array( $groupField, $fields[ $groupField ] );
        }

        return $this->calculateAggregates( $this->DataSet, $columns, $conditions, true );
    }

    protected function calculateAggregates( $dataSet, $columns, $conditions = array(), $isGrouping = false )
    {
        $aggregateObjects = array();

        foreach( $columns as $i => $column )
        {
            if( ( $column->Summary->ShowAvg && !$isGrouping ) || ( $column->GroupSummary->ShowAvg && $isGrouping ) )
                $aggregateObjects[] = new JTPlatinumGridAvgAggregate( $column->DataField, $column->DataField . 'Avg' );

            if( ( $column->Summary->ShowCount && !$isGrouping ) || ( $column->GroupSummary->ShowCount && $isGrouping ) )
                $aggregateObjects[] = new JTPlatinumGridCountAggregate( $column->DataField, $column->DataField . 'Count' );

            if( ( $column->Summary->ShowMin && !$isGrouping ) || ( $column->GroupSummary->ShowMin && $isGrouping ) )
                $aggregateObjects[] = new JTPlatinumGridMinAggregate( $column->DataField, $column->DataField . 'Min' );

            if( ( $column->Summary->ShowMax && !$isGrouping ) || ( $column->GroupSummary->ShowMax && $isGrouping ) )
                $aggregateObjects[] = new JTPlatinumGridMaxAggregate( $column->DataField, $column->DataField . 'Max' );

            if( ( $column->Summary->ShowSum && !$isGrouping ) || ( $column->GroupSummary->ShowSum && $isGrouping ) )
                $aggregateObjects[] = new JTPlatinumGridSumAggregate( $column->DataField, $column->DataField . 'Sum' );
        }

        $result = null;

        if( $this->_oncalculateaggregates )
            $result = $this->callEvent( 'oncalculateaggregates', array( $aggregateObjects, $conditions ) );

        if( !$result )
            $result = $dataSet->calculateAggregates( $aggregateObjects, $conditions );

        return $result;
    }

    protected function processSelection( $selection )
    {
        $rows = explode( '|', $selection );
        foreach( $rows as $row )
        {
            if( $row === '' )
                continue;

            if( $this->_RowSelect )
            {
                $this->_SelectedCells[ $row ] = 1;

                if( $this->_SelectedRow == -1 )
                    $this->_SelectedRow = $row;

                if( !$this->_CanRangeSelect )
                    return;
            }
            else
            {
                $cols = explode( ',', $row );
                $row = array_shift( $cols );
                foreach( $cols as $col )
                {
                    if( $col === '' )
                        continue;

                    if( isset( $this->_SelectedCells[ $row ] ) )
                        $this->_SelectedCells[ $row ][ $col ] = 1;
                    else
                        $this->_SelectedCells[ $row ] = array( $col => 1 );

                    if( $this->_SelectedRow == -1 || $this->_SelectedCol == -1 )
                    {
                        $this->_SelectedRow = $row;
                        $this->_SelectedCol = $col;
                    }

                    if( !$this->_CanRangeSelect )
                        return;
                }
            }
        }
    }

    protected function selectionString()
    {
        if( $this->_RowSelect )
        {
            $rows = array_keys( $this->_SelectedCells );
        }
        else
        {
            $rows = array();

            foreach( $this->_SelectedCells as $row => $cols )
                $rows[] = $row . ',' . implode( ',', array_keys( $cols ) );
        }

        return implode( '|', $rows );
    }

    protected function processPrimaryKeys( $primaryKeys )
    {
        $keys = explode( '|', $primaryKeys );
        if( $keys )
            $this->_SelectedPrimaryKeys = $keys;
    }

    protected function initGroupByColumns()
    {
        $this->GroupByFields = array();

        if( $this->_GroupBy )
        {
            $groupColumns = explode( ',', $this->_GroupBy );
            foreach( $groupColumns as $sortColumn )
            {
                $sortBits = preg_split( '/\s+/', trim( $sortColumn ) );
                $columnName = $sortBits[ 0 ];
                $direction = ( count( $sortBits ) > 1 ) ? $sortBits[ 1 ] : '';

                if( $this->findColumnByFieldName( $columnName ) < 0 )
                    throw new JTPlatinumGridException( "Group By column '$columnName' does not exist in the " . $this->Name . "->Columns collection." );

                $direction = strtoupper( $direction );
                if( !$direction )
                    $direction = "ASC";

                if( $direction != "ASC" && $direction != "DESC" )
                    throw new JTPlatinumGridException( "Group By column '$columnName' sort direction not valid: \"$direction\"" );

                $this->GroupByFields[] = array( $columnName, $direction );
            }
        }
    }

    protected function trimOffGroupByColumns( &$columns )
    {
        foreach( $this->GroupByFields as $groupColumn )
        {
            list( $fieldName, $direction ) = $groupColumn;

            $foundIndex = -1;
            foreach( $columns as $i => $column )
            {
                if( $column->DataField == $fieldName )
                {
                    $foundIndex = $i;
                    break;
                }
            }

            if( $foundIndex > -1 )
                array_splice( $columns, $foundIndex, 1 );
        }
    }

    protected function initRowStylesCss()
    {
        foreach( $this->_RowDataStyles as $i => $rowDataStyle )
        {
            if( !$rowDataStyle->RowStyle->CssCode )
                $rowDataStyle->RowStyle->CssCode = "rowStyle$i";
        }
    }

    protected function dataValueToHTML( $value )
    {
        if( strlen( $value ) )
            return $value;
            // return str_replace( ' ', '&nbsp;', htmlspecialchars( $value, ENT_COMPAT, $this->_DataEncoding ) );
        else
            return '&nbsp;';
    }

    protected function processFilterSet()
    {
        if( !$this->initializeSkin( $error ) )
            return;

        foreach( $this->_Columns as $column )
        {
            if( $column->initFilter( $this ) )
                $this->FiltersChanged = true;
        }
    }

    protected function processSortBy()
    {
        foreach( $this->_Columns as $column )
            $column->SortDirection = '';

        $sortColumns = array_filter( explode( ',', $this->_SortBy ) );

        foreach( $sortColumns as $sortColumn )
        {
            $sortBits = preg_split( '/\s+/', trim( $sortColumn ) );
            $columnName = $sortBits[ 0 ];
            $direction = ( count( $sortBits ) > 1 ) ? $sortBits[ 1 ] : '';

            $direction = strtoupper( $direction );
            if( !$direction )
                $direction = "ASC";

            if( !preg_match( '/^[a-z0-9\_\.]+$/i', $columnName ) || ( $direction && $direction != "ASC" && $direction != "DESC" ) )
                throw new JTPlatinumGridException( "Invalid sort column specified in " . $this->Name . "->SortBy. Found \"$sortColumn\", expected [column name] [ASC/DESC]" );

            if( count( $this->_Columns ) )
            {
                $i = $this->findColumnByFieldName( $columnName );
                if( $i < 0 )
                    throw new JTPlatinumGridException( "Cannot find column in " . $this->Name . " for sort field \"$columnName\"" );

                $this->_Columns[ $i ]->SortDirection = $direction;
            }
        }
    }

    protected function processColSizes( $colSizesStr )
    {
        $columnSizes = json_decode( $colSizesStr, true );
        if( $columnSizes )
        {
            foreach( $columnSizes as $columnName => $width )
            {
                $i = $this->findColumnByName( $columnName );
                if( $i > -1 )
                    $this->_Columns[ $i ]->Width = $width;
            }
        }
    }

    function sqlQuote( $str, &$value, &$valueQuoted )
    {
        if( $this->DataSet->Database )
            $valueQuoted = $this->DataSet->Database->QuoteStr( $str );
        else
            $valueQuoted = "'" . str_replace( "\r", "\\\r", str_replace( "\n", "\\\n", addslashes( $str ) ) ) . "'";

        if( strlen( $valueQuoted ) > 0 && $valueQuoted[ 0 ] == '\'' )
            $value = substr( $valueQuoted, 1, strlen( $valueQuoted ) - 2 );
        else
            $value = $valueQuoted;

        if( is_numeric( $value ) )
            $valueQuoted = $value;
    }

    function colsToText()
    {
        $result = array();
        foreach( $this->_Columns as $column )
            $result[] = array( get_class( $column ), $column->toString() );

        return $result;
    }

    protected function colsFromText( $value )
    {
        // echo( "<!-- cols altered -->\r\n" );
        $this->_Columns = array();
        $i = 0;

        foreach( $value as $data )
        {
            if( !is_array( $data ) && substr( $data, 0, 2 ) == 'a:' )
                $data = unserialize( $data );

            if( is_array( $data ) )
                list( $className, $propertyInfo ) = $data;
            else
                list( $className, $propertyInfo ) = explode( ',', $data, 2 );

            $column = new $className( $this, $i );
            $column->fromString( $propertyInfo );

            $this->_Columns[] = $column;

            ++$i;
        }
    }

    protected function dumpJavaScriptEvent( $event, $params )
    {
        if( !defined( 'JT_STANDALONE' ) && $event && !defined( 'JTPlatinumGrid-' . $event ) )
        {
            define( 'JTPlatinumGrid-' . $event, 1 );

            if( $params )
                print( "function $event( sender, $params )\r\n{\r\n" );
            else
                print( "function $event( sender )\r\n{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function calculateHaveAllColumnsWidth( $trimmedColumns )
    {
        $haveAllColumnsWidth = true;
        return $haveAllColumnsWidth;
        if( $this->_FillWidth )
        {
            foreach( $trimmedColumns as $column )
            {
                if( $column->Visible && strlen( $column->Width ) == 0 )
                {
                   $haveAllColumnsWidth = false;
                   break;
                }
            }
        }

        return $haveAllColumnsWidth;
    }

    function findColumnByFieldName( $fieldName )
    {
        foreach( $this->_Columns as $i => $column )
        {
            if( $column->DataField == $fieldName )
                return $i;
        }

        return -1;
    }

    function findColumnByName( $name )
    {
        foreach( $this->_Columns as $i => $column )
        {
            if( $column->Name == $name )
                return $i;
        }

        return -1;
    }

    function printGrid( $title, $printAllRecords = false )
    {
        if( $this->_onprint )
            $this->callEvent( 'onprint', array( &$title, &$printAllRecords ) );

        if( !$this->initializeSkin( $error ) )
            return;

        if( !$this->SiteThemeInstance )
            throw new JTPlatinumGridException( "JTSiteTheme instance not located." );

        $oldPagerVisible = $this->Pager->Visible;
        if( $printAllRecords && $this->Pager->Visible )
            $this->Pager->Visible = false;
        $this->Skin = JTPlatinumGrid::PrintSkin;

        $dtd = '';
        $extra = '';

        $dtd='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';

        if( $dtd )
            print( "$dtd\r\n" );

        if( $extra )
            print( "<html $extra>\r\n" );
        else
            print( "<html>\r\n" );

        print( "  <head>\r\n    <title>$title</title>\r\n" );

        $this->SiteThemeInstance->dumpHeaderCode();
        $this->dumpHeaderCode();

        print( "    <script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

        $this->dumpJavascript();

        print( "    </script>\r\n  </head>\r\n  <body>\r\n" );
        $this->internalDumpThemedContents();
        print( "  </body>\r\n</html>\r\n" );

        $this->Pager->Visible = $oldPagerVisible;
        $this->Skin = '';

        die();
    }

    function exportGridToCSV( $fileName = '', $delimiter = ',', $useDataFieldNames = false, $exportAllRecords = false )
    {
        if( $this->_onexport )
            $this->callEvent( 'onexport', array( 'CSV', &$fileName, &$delimiter, &$exportAllRecords ) );

        $result = array();

        $oldPagerVisible = $this->Pager->Visible;
        if( $exportAllRecords && $this->Pager->Visible )
            $this->Pager->Visible = false;

        $this->initDataSet();

        if( $this->DataSet && $this->DataSet->Active )
        {
            $ds = $this->DataSet;

            if( count( $this->_Columns ) == 0 )
                $this->_Columns = $this->generateColumns();

            $temp = array();
            foreach( $this->_Columns as $column )
            {
                if( !$column->Visible )
                    continue;

                $value = $useDataFieldNames ? $column->DataField : $column->Caption;

                if( strpos( $value, $delimiter ) !== false )
                    $value = '"' . $value . '"';

                $temp[] = $value;
            }

            $result[] = implode( $delimiter, $temp );

            if( $this->_Pager->Visible )
            {
                $pagerVisible = true;
                $pagerRows = $this->_Pager->RowsPerPage;
            }
            else
            {
                $pagerVisible = false;
                $pagerRows = 0;
            }

            for( $i = 0; !$ds->Eof && ( !$pagerVisible || $i < $pagerRows ); $ds->Next(), ++$i )
            {
                $fields = $ds->Fields;

                if( $this->_onrowdata )
                    $this->callEvent( 'onrowdata', array( $i, &$fields ) );

                $temp = array();

                foreach( $this->_Columns as $colIndex => $column )
                {
                    if( !$column->Visible )
                        continue;

                    $value = $column->dumpExportData( $this, $fields, $i, $colIndex );

                    if( strpos( $value, $delimiter ) !== false )
                        $value = '"' . $value . '"';

                    $temp[] = $value;
                }

                $result[] = implode( $delimiter, $temp );
            }
        }

        $csv = implode( "\r\n", $result );
        if( $fileName )
            @file_put_contents( $fileName, ( ( $this->_UTF8 ) ? "\xEF\xBB\xBF" : '' ) . $csv );

        $this->Pager->Visible = $oldPagerVisible;

        return $csv;
    }

    function exportGridToCSVDownload( $fileName = '', $delimiter = ',', $useDataFieldNames = false, $exportAllRecords = false )
    {
        $csv = $this->exportGridToCSV( '', $delimiter, $useDataFieldNames, $exportAllRecords );

        if( $fileName )
            $fileName = basename( $fileName );
        else if( basename( $this->_ExportFileName ) )
            $fileName = basename( $this->_ExportFileName ) . '.csv';
        else
            $fileName = $this->Name . '.csv';

        ob_end_clean();

        if( isset( $_SERVER[ 'HTTPS' ] ) && 'on' == strtolower( $_SERVER[ 'HTTPS' ] ) && preg_match( '/MSIE/', $_SERVER[ 'HTTP_USER_AGENT' ] ) )
		    header( 'Pragma: public' );
	    else
		    header( 'Pragma: no-cache' );

        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=$fileName" );
        header( "Content-length: " . strlen( $csv ) );
        echo( $csv );
        die();
    }

    function exportGridToXLS( $fileName = '', $worksheetName = 'Sheet1', $exportAllRecords = false )
    {
        if( $this->_onexport )
            $this->callEvent( 'onexport', array( 'XLS', &$fileName, &$exportAllRecords ) );

        $oldPagerVisible = $this->Pager->Visible;
        if( $exportAllRecords && $this->Pager->Visible )
            $this->Pager->Visible = false;

        $this->initDataSet();

        if( count( $this->_Columns ) == 0 )
            $this->_Columns = $this->generateColumns();

        $trimmedColumns = $this->_Columns;
        $this->trimOffGroupByColumns( $trimmedColumns );

        $exporter = new JTPlatinumGridXLSRenderer( $fileName, $worksheetName );

        $result = $exporter->dumpGrid( $this, $this->DataSet, $trimmedColumns, $this->GroupByFields, '' );

        $this->Pager->Visible = $oldPagerVisible;

        return $result;
    }

    function exportGridToXLSDownload( $fileName = '', $worksheetName = 'Sheet1', $exportAllRecords = false )
    {
        $xls = $this->exportGridToXLS( '', $worksheetName, $exportAllRecords );

        if( $fileName )
            $fileName = basename( $fileName );
        else if( basename( $this->_ExportFileName ) )
            $fileName = basename( $this->_ExportFileName ) . '.xls';
        else
            $fileName = $this->Name . '.xls';

        ob_end_clean();

        if( isset( $_SERVER[ 'HTTPS' ] ) && 'on' == strtolower( $_SERVER[ 'HTTPS' ] ) && preg_match( '/MSIE/', $_SERVER[ 'HTTP_USER_AGENT' ] ) )
		    header( 'Pragma: public' );
	    else
		    header( 'Pragma: no-cache' );

        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=$fileName" );
        header( "Content-length: " . strlen( $xls ) );
        echo( $xls );
        die();
    }

    function exportGridToPDF( $fileName = '', $fontName = '', $title = '', $exportAllRecords = false )
    {
        if( $this->_onexport )
            $this->callEvent( 'onexport', array( 'PDF', &$fileName, &$fontName, &$title, &$exportAllRecords ) );

        $oldPagerVisible = $this->Pager->Visible;
        if( $exportAllRecords && $this->Pager->Visible )
            $this->Pager->Visible = false;

        if( $fontName == '' )
            $fontName = $this->_ExportPDFFontName;

        $this->initDataSet();

        if( count( $this->_Columns ) == 0 )
            $this->_Columns = $this->generateColumns();

        $trimmedColumns = $this->_Columns;
        $this->trimOffGroupByColumns( $trimmedColumns );

        $exporter = new JTPlatinumGridPDFRenderer( $fileName );
        $exporter->FontName = $fontName;

        $result = $exporter->dumpGrid( $this, $this->DataSet, $trimmedColumns, $this->GroupByFields, $title );

        $this->Pager->Visible = $oldPagerVisible;

        return $result;
    }

    function exportGridToPDFDownload( $fileName = '', $fontName = '', $title = '', $exportAllRecords = false )
    {
        $pdf = $this->exportGridToPDF( '', $fontName, $title, $exportAllRecords );

        if( $fileName )
            $fileName = basename( $fileName );
        else if( basename( $this->_ExportFileName ) )
            $fileName = basename( $this->_ExportFileName ) . '.pdf';
        else
            $fileName = $this->Name . '.pdf';

        ob_end_clean();

        if( isset( $_SERVER[ 'HTTPS' ] ) && 'on' == strtolower( $_SERVER[ 'HTTPS' ] ) && preg_match( '/MSIE/', $_SERVER[ 'HTTP_USER_AGENT' ] ) )
		    header( 'Pragma: public' );
	    else
		    header( 'Pragma: no-cache' );

        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=$fileName" );
        header( "Content-length: " . strlen( $pdf ) );
        echo( $pdf );
        die();
    }

    function readHiddenRowsByIndex()
    {
        return $this->_HiddenRowsByIndex;
    }

    function writeHiddenRowsByIndex( $value )
    {
        if( !is_array( $value ) )
            throw JTPlatinumGridException( "HiddenRowsByIndex property requires array, received " . gettype( $value ) );

        $this->_HiddenRowsByIndex = $value;
    }

    function readHiddenRowsByField()
    {
        return $this->_HiddenRowsByField;
    }

    function writeHiddenRowsByField( $value )
    {
        if( !is_array( $value ) )
            throw JTPlatinumGridException( "HiddenRowsByField property requires array, received " . gettype( $value ) );

        $this->_HiddenRowsByField = $value;
    }

    function readMergedCells()
    {
        return $this->_MergedCells;
    }

    function writeMergedCells( $value )
    {
        $this->_MergedCells = $value;
    }

    function readSelectedCells()
    {
        return $this->_SelectedCells;
    }

    function writeSelectedCells( $value )
    {
        if( is_array( $value ) )
        {
            $this->_SelectedCells = $value;

            if( count( $value ) == 0 )
            {
                $this->_SelectedCol = -1;
                $this->_SelectedRow = -1;
                $this->_SelectedPrimaryKeys = array();
                $_POST[ $this->Name . '_Selection' ] = '';
            }
        }
    }

    function readSelectedCol()
    {
        return $this->_SelectedCol;
    }

    function readSelectedRow()
    {
        return $this->_SelectedRow;
    }

    function readSelectedPrimaryKeys()
    {
        return $this->_SelectedPrimaryKeys;
    }

    function getAjaxRefreshAll()
    {
        return $this->_AjaxRefreshAll;
    }

    function setAjaxRefreshAll( $value )
    {
        $this->_AjaxRefreshAll = $value;
    }

    function defaultAjaxRefreshAll()
    {
        return 0;
    }

    function getAllowDelete()
    {
        return $this->_AllowDelete;
    }

    function setAllowDelete( $value )
    {
        $this->_AllowDelete = $value;
    }

    function defaultAllowDelete()
    {
        return true;
    }

    function getAllowInsert()
    {
        return $this->_AllowInsert;
    }

    function setAllowInsert( $value )
    {
        $this->_AllowInsert = $value;
    }

    function defaultAllowInsert()
    {
        return true;
    }

    function getAllowUpdate()
    {
        return $this->_AllowUpdate;
    }

    function setAllowUpdate( $value )
    {
        $this->_AllowUpdate = $value;
    }

    function defaultAllowUpdate()
    {
        return true;
    }

    function getAllowScrolling()
    {
        return $this->_AllowScrolling;
    }

    function setAllowScrolling( $value )
    {
        $this->_AllowScrolling = $value;
    }

    function defaultAllowScrolling()
    {
        return true;
    }
    /*
    function getAlwaysShowEditor()
    {
        return $this->_AlwaysShowEditor;
    }

    function setAlwaysShowEditor( $value )
    {
        $this->_AlwaysShowEditor = $value;
    }

    function defaultAlwaysShowEditor()
    {
        return 0;
    }
    */
    function getCanDragSelect()
    {
        return $this->_CanDragSelect;
    }

    function setCanDragSelect( $value )
    {
        $this->_CanDragSelect = $value;
    }

    function defaultCanDragSelect()
    {
        return true;
    }

    function getCanMoveCols()
    {
        return $this->_CanMoveCols;
    }

    function setCanMoveCols( $value )
    {
        $this->_CanMoveCols = $value;
    }

    function defaultCanMoveCols()
    {
        return true;
    }

    function getCanMultiColumnSort()
    {
        return $this->_CanMultiColumnSort;
    }

    function setCanMultiColumnSort( $value )
    {
        $this->_CanMultiColumnSort = $value;
    }

    function defaultCanMultiColumnSort()
    {
        return true;
    }

    function getCanRangeSelect()
    {
        return $this->_CanRangeSelect;
    }

    function setCanRangeSelect( $value )
    {
        $this->_CanRangeSelect = $value;
    }

    function defaultCanRangeSelect()
    {
        return true;
    }

    function getCanResizeCols()
    {
        return $this->_CanResizeCols;
    }

    function setCanResizeCols( $value )
    {
        $this->_CanResizeCols = $value;
    }

    function defaultCanResizeCols()
    {
        return true;
    }
    /*
    function getCanResizeRows()
    {
        return $this->_CanResizeRows;
    }

    function setCanResizeRows( $value )
    {
        $this->_CanResizeRows = $value;
    }

    function defaultCanResizeRows()
    {
        return true;
    }
    */
    function getCanSelect()
    {
        return $this->_CanSelect;
    }

    function setCanSelect( $value )
    {
        $this->_CanSelect = $value;
    }

    function defaultCanSelect()
    {
        return true;
    }

    function getCellData()
    {
        return $this->_CellData;
    }

    function setCellData( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        $this->_CellData = $value;
    }

    function getColumns()
    {
        if( ( $this->ControlState & csDesigning ) == csDesigning || $this->Serializing || ( $this->ControlState & csLoading ) == csLoading )
            return $this->colsToText();

        return $this->_Columns;
    }

    function setColumns( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        if( ( $this->ControlState & csDesigning ) == csDesigning ||
            ( $this->ControlState & csLoading ) == csLoading )
        {
            $this->colsFromText( $value );
        }
        else
        {
            $this->_Columns = $value;
        }

        foreach( $this->_Columns as $k => $v )
            $v->Index = $k;
    }

    /**
     * @return JTPlatinumGridCommandBar
    */
    function getCommandBar()
    {
        return $this->_CommandBar;
    }

    function setCommandBar( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridCommandBar )
            $this->_CommandBar = $value;
    }

    function getDatasource()
    {
        return $this->_Datasource;
    }

    function setDatasource( $value )
    {
        if( is_object( $value ) )
            $this->_Datasource = $value;
        else
            $this->_Datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function defaultDatasource()
    {
        return null;
    }

    function getDetailValue()
    {
        return $this->_DetailValue;
    }

    function setDetailValue( $value )
    {
        $this->_DetailValue = $value;
    }

    function defaultDetailValue()
    {
        return '';
    }

    function getDetailView()
    {
        return $this->_DetailView;
    }

    function setDetailView( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridDetailView )
            $this->_DetailView = $value;
    }

    function getEditorStyle()
    {
        return $this->_EditorStyle;
    }

    function setEditorStyle( $value )
    {
        $this->_EditorStyle = $value;
    }

    function defaultEditorStyle()
    {
        return self::Inline;
    }

    function getEvenRowStyle()
    {
        return $this->_EvenRowStyle;
    }

    function setEvenRowStyle( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridRowStyle )
            $this->_EvenRowStyle = $value;
    }

    function getExportFileName()
    {
        return $this->_ExportFileName;
    }

    function setExportFileName( $value )
    {
        $this->_ExportFileName = $value;
    }

    function defaultExportFileName()
    {
        return '';
    }

    function getExportPDFFontName()
    {
        return $this->_ExportPDFFontName;
    }

    function setExportPDFFontName( $value )
    {
        $this->_ExportPDFFontName = $value;
    }

    function defaultExportPDFFontName()
    {
        return 'Helvetica';
    }

    function getFillWidth()
    {
        return $this->_FillWidth;
    }

    function setFillWidth( $value )
    {
        $this->_FillWidth = $value;
    }

    function defaultFillWidth()
    {
        return true;
    }

    function getGridLines()
    {
        return $this->_GridLines;
    }

    function setGridLines( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridLines )
            $this->_GridLines = $value;
    }

    function defaultGridLines()
    {
        return null;
    }

    function getGroupBy()
    {
        return $this->_GroupBy;
    }

    function setGroupBy( $value )
    {
        $this->_GroupBy = $value;
    }

    function defaultGroupBy()
    {
        return '';
    }

    /**
     * @return JTPlatinumGridHeader
    */
    function getHeader()
    {
        return $this->_Header;
    }

    function setHeader( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridHeader )
            $this->_Header = $value;
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

    function getMemoField()
    {
        return $this->_MemoField;
    }

    function setMemoField( $value )
    {
        $this->_MemoField = $value;
    }

    function defaultMemoField()
    {
        return '';
    }

    function setName( $value )
    {
        if( defined( 'JT_STANDALONE' ) )
        {
            if( !preg_match( '/^[a-z0-9]+$/i', $value ) )
                throw new Exception( "Name must only contain alpha-numeric characters." );
        }

        parent::setName( $value );
    }

    function getOddRowStyle()
    {
        return $this->_OddRowStyle;
    }

    function setOddRowStyle( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridRowStyle )
            $this->_OddRowStyle = $value;
    }

    function getPager()
    {
        return $this->_Pager;
    }

    function setPager( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridPager )
            $this->_Pager = $value;
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

    function getReadOnly()
    {
        return $this->_ReadOnly;
    }

    function setReadOnly( $value )
    {
        $this->_ReadOnly = $value;
    }

    function defaultReadOnly()
    {
        return 0;
    }

    function getRowSelect()
    {
        return $this->_RowSelect;
    }

    function setRowSelect( $value )
    {
        $this->_RowSelect = $value;
    }

    function defaultRowSelect()
    {
        return 0;
    }

    function getRowDataStyles()
    {
        return $this->_RowDataStyles;
    }

    function setRowDataStyles( $value )
    {
        $this->_RowDataStyles = $value;
    }

    function defaultRowDataStyles()
    {
        return array();
    }

    function getSelectedRowStyle()
    {
        return $this->_SelectedRowStyle;
    }

    function setSelectedRowStyle( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridRowStyle )
            $this->_SelectedRowStyle = $value;
    }

    function getShowEditColumn()
    {
        return $this->_ShowEditColumn;
    }

    function setShowEditColumn( $value )
    {
        $this->_ShowEditColumn = $value;
    }

    function defaultShowEditColumn()
    {
        return 0;
    }

    function getShowSelectColumn()
    {
        return $this->_ShowSelectColumn;
    }

    function setShowSelectColumn( $value )
    {
        $this->_ShowSelectColumn = $value;
    }

    function defaultShowSelectColumn()
    {
        return true;
    }

    function getSortBy()
    {
        return $this->_SortBy;
    }

    function setSortBy( $value )
    {
        $this->_SortBy = $value;

        if( ( $this->ControlState & csLoading ) == 0 )
            $this->processSortBy();
    }

    function defaultSortBy()
    {
        return '';
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

    function getUTF8()
    {
        return $this->_UTF8;
    }

    function setUTF8( $value )
    {
        $this->_UTF8 = $value;
    }

    function defaultUTF8()
    {
        return true;
    }

    function getjsOnCommand()
    {
        return $this->_jsOnCommand;
    }

    function setjsOnCommand( $value )
    {
        $this->_jsOnCommand = $value;
    }

    function defaultjsOnCommand()
    {
        return null;
    }

    function getjsOnSelect()
    {
        return $this->_jsOnSelect;
    }

    function setjsOnSelect( $value )
    {
        $this->_jsOnSelect = $value;
    }

    function defaultjsOnSelect()
    {
        return null;
    }

    function getjsOnDataLoad()
    {
        return $this->_jsOnDataLoad;
    }

    function setjsOnDataLoad( $value )
    {
        $this->_jsOnDataLoad = $value;
    }

    function defaultjsOnDataLoad()
    {
        return null;
    }

    function getjsOnRowDeleting()
    {
        return $this->_jsOnRowDeleting;
    }

    function setjsOnRowDeleting( $value )
    {
        $this->_jsOnRowDeleting = $value;
    }

    function defaultjsOnRowDeleting()
    {
        return null;
    }

    function getjsOnRowEdited()
    {
        return $this->_jsOnRowEdited;
    }

    function setjsOnRowEdited( $value )
    {
        $this->_jsOnRowEdited = $value;
    }

    function defaultjsOnRowEdited()
    {
        return null;
    }

    function getjsOnRowEditing()
    {
        return $this->_jsOnRowEditing;
    }

    function setjsOnRowEditing( $value )
    {
        $this->_jsOnRowEditing = $value;
    }

    function defaultjsOnRowEditing()
    {
        return null;
    }

    function getOnSort()
    {
        return $this->_onsort;
    }

    function setOnSort( $value )
    {
        $this->_onsort = $value;
    }

    function defaultOnSort()
    {
        return null;
    }

    function getOnDelete()
    {
        return $this->_ondelete;
    }

    function setOnDelete( $value )
    {
        $this->_ondelete = $value;
    }

    function defaultOnDelete()
    {
        return null;
    }

    function getOnInsert()
    {
        return $this->_oninsert;
    }

    function setOnInsert( $value )
    {
        $this->_oninsert = $value;
    }

    function defaultOnInsert()
    {
        return null;
    }

    function getOnUpdate()
    {
        return $this->_onupdate;
    }

    function setOnUpdate( $value )
    {
        $this->_onupdate = $value;
    }

    function defaultOnUpdate()
    {
        return null;
    }

    function getOnGroup()
    {
        return $this->_ongroup;
    }

    function setOnGroup( $value )
    {
        $this->_ongroup = $value;
    }

    function defaultOnGroup()
    {
        return null;
    }

    function getOnSQL()
    {
        return $this->_onsql;
    }

    function setOnSQL( $value )
    {
        $this->_onsql = $value;
    }

    function defaultOnSQL()
    {
        return null;
    }

    function getOnCustomEditorGenerate()
    {
        return $this->_oncustomeditorgenerate;
    }

    function setOnCustomEditorGenerate( $value )
    {
        $this->_oncustomeditorgenerate = $value;
    }

    function defaultOnCustomEditorGenerate()
    {
        return null;
    }

    function getOnCustomFilterGenerate()
    {
        return $this->_oncustomfiltergenerate;
    }

    function setOnCustomFilterGenerate( $value )
    {
        $this->_oncustomfiltergenerate = $value;
    }

    function defaultOnCustomFilterGenerate()
    {
        return null;
    }

    function getOnCustomFieldGenerate()
    {
        return $this->_oncustomfieldgenerate;
    }

    function setOnCustomFieldGenerate( $value )
    {
        $this->_oncustomfieldgenerate = $value;
    }

    function defaultOnCustomFieldGenerate()
    {
        return null;
    }

    function getOnCommand()
    {
        return $this->_oncommand;
    }

    function setOnCommand( $value )
    {
        $this->_oncommand = $value;
    }

    function defaultOnCommand()
    {
        return null;
    }

    function getOnRowEdited()
    {
        return $this->_onrowedited;
    }

    function setOnRowEdited( $value )
    {
        $this->_onrowedited = $value;
    }

    function defaultOnRowEdited()
    {
        return null;
    }

    function getOnRowData()
    {
        return $this->_onrowdata;
    }

    function setOnRowData( $value )
    {
        $this->_onrowdata = $value;
    }

    function defaultOnRowData()
    {
        return null;
    }

    function getOnRowInserted()
    {
        return $this->_onrowinserted;
    }

    function setOnRowInserted( $value )
    {
        $this->_onrowinserted = $value;
    }

    function defaultOnRowInserted()
    {
        return null;
    }

    function getjsOnRowInserted()
    {
        return $this->_jsOnRowInserted;
    }

    function setjsOnRowInserted( $value )
    {
        $this->_jsOnRowInserted = $value;
    }

    function defaultjsOnRowInserted()
    {
        return null;
    }

    function getOnSummaryData()
    {
        return $this->_onsummarydata;
    }

    function setOnSummaryData( $value )
    {
        $this->_onsummarydata = $value;
    }

    function defaultOnSummaryData()
    {
        return null;
    }

    function getOnGetRecordCount()
    {
        return $this->_ongetrecordcount;
    }

    function setOnGetRecordCount( $value )
    {
        $this->_ongetrecordcount = $value;
    }

    function defaultOnGetRecordCount()
    {
        return null;
    }

    function getOnCalculateAggregates()
    {
        return $this->_oncalculateaggregates;
    }

    function setOnCalculateAggregates( $value )
    {
        $this->_oncalculateaggregates = $value;
    }

    function defaultOnCalculateAggregates()
    {
        return null;
    }

    function getOnCustomCommand()
    {
        return $this->_oncustomcommand;
    }

    function setOnCustomCommand( $value )
    {
        $this->_oncustomcommand = $value;
    }

    function defaultOnCustomCommand()
    {
        return null;
    }

    function getjsOnCustomCommand()
    {
        return $this->_jsOnCustomCommand;
    }

    function setjsOnCustomCommand( $value )
    {
        $this->_jsOnCustomCommand = $value;
    }

    function defaultjsOnCustomCommand()
    {
        return null;
    }

    function getOnExport()
    {
        return $this->_onexport;
    }

    function setOnExport( $value )
    {
        $this->_onexport = $value;
    }

    function defaultOnExport()
    {
        return null;
    }

    function getOnPrint()
    {
        return $this->_onprint;
    }

    function setOnPrint( $value )
    {
        $this->_onprint = $value;
    }

    function defaultOnPrint()
    {
        return null;
    }
}

class JTPersistent extends Persistent
{
    protected $_owner = null;

    function __construct( $aowner = null )
    {
        $this->_owner = $aowner;
    }

    function fixupPropertyAndCheck( $value, $type )
    {
        $result = $this->fixupProperty( $value );

        if( ( $this->ControlState & csDesigning ) != csDesigning && is_object( $result ) )
        {
            if( !( $result instanceof $type ) )
                throw new JTPlatinumGridException( $this->Name . ' property type mismatch, expected ' . $type . ', received ' . get_class( $result ) );
        }

        return $result;
    }

    function loaded()
    {
    }

    function toString()
    {
        $result = array();
        $refclass = new ReflectionClass( get_class( $this ) );
        $methods=$refclass->getMethods();

        reset($methods);

        while (list($k,$method)=each($methods))
        {
            $methodname=$method->name;
            if ($methodname[0] == 's' && $methodname[1] == 'e' && $methodname[2] == 't')   // fast check of: substr($methodname,0,3)=='set'
            {
                $propname=substr($methodname, 3);

                if($propname=='Name')
                    $propvalue = $this->_name;
                else
                    $propvalue=$this->$propname;

                if (is_object($propvalue))
                {
                    if ($propvalue instanceof Component)
                    {
                        $apropvalue='';
                        $aowner=$propvalue->readOwner();
                        if ($aowner!=null) $apropvalue=$aowner->getName().'.';
                        $apropvalue.=$propvalue->getName();
                        $propvalue=$apropvalue;
                    }
                    else if ($propvalue instanceof JTPersistent)
                    {
                       $propvalue = $propvalue->toString();
                    }
                }

                if ((!is_object($propvalue))  && ($this->allowserialize($propname)))
                {
                    $defmethod='default'.$propname;

                    if (method_exists($this,$defmethod))
                    {
                        $defvalue=$this->$defmethod();

                        if (typesafeequal($defvalue,$propvalue))
                            continue;
                    }

                    $result[$propname]=$propvalue;
                }
            }
        }

        return serialize( $result );
    }

    function fromString( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as $k => $v )
        {
            $getter = 'get' . $k;
            $ob = $this->$getter();

            if( is_object( $ob ) )
            {
                if ($ob instanceof JTPersistent && !( $ob instanceof Component ))
                    $ob->fromString( $v );
            }
            else
            {
                $setter = 'set' . $k;
                $this->$setter( $v );
            }
        }
    }

    function readOwner()
    {
        return $this->_owner;
    }
}

abstract class JTPlatinumGridColumn extends JTPersistent
{
    // filter methods.
    const FilterEquals = 'Equals';
    const FilterNotEqual = 'NotEqual';
    const FilterLessThan = 'LessThan';
    const FilterGreaterThan = 'GreaterThan';
    const FilterLessThanOrEqualTo = 'LessThanOrEqualTo';
    const FilterGreaterThanOrEqualTo = 'GreaterThanOrEqualTo';
    const FilterContains = 'Contains';
    const FilterNotContains = 'NotContains';
    const FilterEmpty = 'Empty';
    const FilterNotEmpty = 'NotEmpty';
    const FilterBeginsWith = 'BeginsWith';
    const FilterEndsWith = 'EndsWith';
    const FilterNoFilter = 'NoFilter';

    protected $_Alignment = agLeft;
    protected $_CanEdit = true;
    protected $_CanFilter = true;
    protected $_CanMove = true;
    protected $_CanResize = true;
    protected $_CanScroll = true;
    protected $_CanSelect = true;
    protected $_CanSort = true;
    protected $_ShowSortButton = true;
    protected $_TwoWaySort = true;
    protected $_VerticalAlignment = agMiddle;
    protected $_Visible = true;
    protected $_Caption = '';
    protected $_DataField = '';
    protected $_DefaultFilter = JTPlatinumGridColumn::FilterNoFilter;
    protected $_Filter = '';
    protected $_FilterMethod = JTPlatinumGridColumn::FilterNoFilter;
    protected $_Grid = null;
    protected $_GroupSummary = null;
    protected $_Index = -1;
    protected $_name = '';
    protected $_SortDirection = '';
    protected $_Summary = null;
    protected $_Width = '';

    public $DumpValue = false;
    protected $FilterMethodSelector = null;

    private $NamePathCache = '';

    function __construct( $agrid )
    {
        parent::__construct( $agrid );

        $this->_Grid = $agrid;
        $this->_GroupSummary = new JTPlatinumGridColumnGroupSummary( $this );
        $this->_Summary = new JTPlatinumGridColumnSummary( $this );
    }

    function dumpDataCell( $grid, $rowIndex, $colIndex, $fields, $hasChildren, $level, $colspan, $rowspan, $indentFactor, $selected, $mergedCells, $expanded )
    {
        if( $colIndex > 0 )
            $level = 0;

        $data = $this->dumpCellData( $grid, $fields, $rowIndex, $colIndex );
        if( $this->DumpValue )
        {
            if( isset( $fields[ $this->_DataField ] ) )
                $value = $fields[ $this->_DataField ];
            else
                $value = '';

            $valueHTML = '<span id="' . $grid->Name . '_cell_' . $rowIndex . '_' . $colIndex . '_value" class="hidden">' . $value . '</span>';
        }
        else
        {
            $valueHTML = '';
        }

        $extraClasses = array();

        if( $mergedCells )
            $extraClasses[] = 'merged';

        if( !$this->_CanScroll )
            $extraClasses[] = 'noscrollcell';

        if( !$this->Visible )
            $extraClasses[] = 'novisible';

        switch( $this->_VerticalAlignment )
        {
            case agTop:
                $extraClasses[] = 'vt';
                break;

            case agMiddle:
                $extraClasses[] = 'vm';
                break;

            case agBottom:
                $extraClasses[] = 'vb';
                break;
        }

        /*
        if( $rowIndex > 0 && $grid->GridLines->Horizontal )
            $extraClasses[] = 'horzline';

        if( $grid->GridLines->Vertical )
            $extraClasses[] = 'vertline';
        */

        // if( $this->_Alignment == agLeft )
        //     $align = 'left';
        if( $this->_Alignment == agCenter )
            $align = 'center';
        else if( $this->_Alignment == agRight )
            $align = 'right';
        else
            $align = '';

        // colspan="{$COLSPAN}" rowspan="{$ROWSPAN}"
        $attrs = '';

        if( $colspan > 1 )
            $attrs .= 'colspan="' . $colspan . '" ';

        if( $rowspan > 1 )
            $attrs .= 'rowspan="' . $rowspan . '" ';

        // style="text-align:{$ALIGN};padding-left:{$INDENT}px;"
        $style = '';
        if( $align )
            $style .= 'text-align:' . $align . ';';

        if( ( ( $level * $indentFactor ) + 1 ) > 1 )
            $style .= 'padding-left:' . ( ( $level * $indentFactor ) + 1 ) . 'px;';

        if( $style )
            $style = 'style="' . $style . '"';

        $vars = array
        (
            'ALIGN'             => $align,
            'ATTRS'             => $attrs,
            'COLINDEX'          => $colIndex,
            //'COLSPAN'           => $colspan,
            'DATA'              => $data,
            'INDENT'            => ( ( $level * $indentFactor ) + 1 ),
            //'ROWINDEX'          => $rowIndex,
            'ROWSPAN'           => $rowspan,
            'EXTRACLASSES'      => implode( ' ', $extraClasses ),
            'CELLSTATECLASS'    => ( $expanded ? 'expanded' : 'collapsed' ),
            'DIVCLASSES'        => ( $this->_CanScroll ? '' : 'noscrolldiv' ),
            'VALUE'             => $valueHTML,
            'STYLE'             => $style,
        );

        if( !$this->_CanScroll )
            $templateName = 'NoScrollCell';
        else
            $templateName = 'Cell';

        if( $hasChildren )
            $templateName .= 'WithChildren';

        return $grid->generateComponentSectionCode( $templateName, $vars );
    }

    function dumpInsertCell( $grid, $rowCount, $colIndex )
    {
        if( $colIndex > 0 )
            $level = 0;

        $extraClasses = array();

        /*
        if( $rowCount > 0 && $grid->GridLines->Horizontal )
            $extraClasses[] = 'horzline';

        if( $grid->GridLines->Vertical )
            $extraClasses[] = 'vertline';
        */

        if( !$this->Visible )
            $extraClasses[] = 'novisible';

        $vars = array
        (
            'ATTRS'             => '',
            'COLINDEX'          => $colIndex,
            //'COLSPAN'           => 1,
            'DATA'              => '',
            'INDENT'            => 0,
            'ROWINDEX'          => '-2',
            //'ROWSPAN'           => 1,
            'EXTRACLASSES'      => implode( ' ', $extraClasses ),
            'CELLSTATECLASS'    => '',
            'DIVCLASSES'        => '',
            'STYLE'             => '',
            'VALUE'             => '',
        );

        $templateName = 'Cell';

        return $grid->generateComponentSectionCode( $templateName, $vars );
    }

    function dumpHeader( $grid, $colIndex, $lastColIndex )
    {
        $sortBtn = '';
        if( $this->_CanSort && $this->_ShowSortButton && $this->_SortDirection )
        {
            if( $this->_SortDirection == 'DESC' )
                $sortBtnTemplateName = 'ColumnHeaderSortBtnDesc';
            else
                $sortBtnTemplateName = 'ColumnHeaderSortBtnAsc';

            $vars = array
            (
                'COLINDEX'      => $colIndex,
                'COLFIELD'      => $this->_DataField,
            );

            $sortBtn = $grid->generateComponentSectionCode( $sortBtnTemplateName, $vars );
        }

        if( $this->_Alignment == agLeft )
            $align = 'alignleft';
        else if( $this->_Alignment == agCenter )
            $align = 'aligncenter';
        else if( $this->_Alignment == agRight )
            $align = 'alignright';
        else
            $align = '';

        if( $this->_SortDirection == 'ASC' )
            $otherSortDir = 'DESC';
        else
            $otherSortDir = 'ASC';

        if( $grid->CanResizeCols /*&& $colIndex < $lastColIndex*/ )
            $resizeBorder = $grid->generateComponentSectionCode( 'ColumnResizeBorder', array( 'COLINDEX' => $colIndex ) );
        else
            $resizeBorder = '';

        $extraClasses = array();

        if( !$this->_Visible )
            $extraClasses[] = 'novisible';

        if( !$this->_CanScroll )
            $extraClasses[] = 'noscrollhdr';

        $vars = array
        (
            'ALIGN'         => $align,
            'CAPTION'       => $this->_Caption,
            'COLINDEX'      => $colIndex,
            'SORTBTN'       => $sortBtn,
            'COLWIDTH'      => $this->_Width,
            'COLFIELD'      => $this->_DataField,
            'EXTRACLASSES'  => implode( ' ', $extraClasses ),
            'OTHERSORTDIR'  => $otherSortDir,
            'RESIZEBORDER'  => $resizeBorder,
        );

        if( $this->_CanSort )
            $templateName = 'ColumnHeaderWithSortLink';
        else
            $templateName = 'ColumnHeader';

        return $grid->generateComponentSectionCode( $templateName, $vars );
    }

    function dumpBodyJavaScript( $isAjax )
    {
        if( $this->FilterMethodSelector )
            $this->FilterMethodSelector->dumpBodyJavaScript();
    }

    function initFilter( $grid )
    {
        $filterChanged = ( $this->_Filter || $this->_FilterMethod != self::FilterNoFilter );

        // $this->_Filter = '';
        $this->_FilterMethod = $this->_DefaultFilter;

        if( isset( $_POST[ $grid->Name . '_' . $this->Name . '_Filter' ] ) )
        {
            $filterObj = $_POST[ $grid->Name . '_' . $this->Name . '_Filter' ];
            // if( strlen( $filterObj ) )
            $this->_Filter = $filterObj;
        }

        $this->initFilterMethod( $grid );

        return ( $this->_Filter || $this->_FilterMethod || $filterChanged );
    }

    function matchesFilter( $fields )
    {
        if( strlen( $this->_Filter ) )
        {
            $value = $fields[ $this->_DataField ];

            return ( strcasecmp( substr( $value, 0, strlen( $this->_Filter ) ), $this->_Filter ) == 0 );
        }
        else
        {
            return true;
        }
    }

    function generateFilterSQL( $grid, $value, $valueQuoted, $simpleFilter )
    {
        if( $simpleFilter && strlen( $this->_Filter ) == 0 )
            return false;

        switch( $this->_FilterMethod )
        {
            case JTPlatinumGridColumn::FilterEquals:
                $o = "= $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterNotEqual:
                $o = "<> $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterLessThan:
                $o = "< $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterGreaterThan:
                $o = "> $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterLessThanOrEqualTo:
                $o = "<= $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterGreaterThanOrEqualTo:
                $o = ">= $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterContains:
                $o = "LIKE '%$value%'";
                break;

            case JTPlatinumGridColumn::FilterNotContains:
                $o = "NOT LIKE '%$value%'";
                break;

            case JTPlatinumGridColumn::FilterEmpty:
                $o = "= ''";
                break;

            case JTPlatinumGridColumn::FilterNotEmpty:
                $o = "<> ''";
                break;

            case JTPlatinumGridColumn::FilterEndsWith:
                $o = "LIKE '%$value'";
                break;

            case JTPlatinumGridColumn::FilterBeginsWith:
            default:
                if( !strlen( $this->_Filter ) )
                    return false;

                $o = "LIKE '$value%'";
                break;
        }

        return $this->_DataField . ' ' . $o;
    }

    function serialize()
    {
        $this->NamePathCache = '';

        parent::serialize();
    }

    function clearGrid()
    {
        $this->_Grid = null;
    }

    function processFieldValue( $value )
    {
        return $value;
    }

    protected function dumpFilterSelector( $grid, $onChange )
    {
        $possibleMethods = array
        (
            self::FilterNoFilter                => '(' . $grid->SiteThemeInstance->retrieveString( 'DontFilter' ) . ')',
            self::FilterEquals                  => $grid->SiteThemeInstance->retrieveString( 'Equals' ),
            self::FilterNotEqual                => $grid->SiteThemeInstance->retrieveString( 'DoesNotEqual' ),
            self::FilterLessThan                => $grid->SiteThemeInstance->retrieveString( 'LessThan' ),
            self::FilterGreaterThan             => $grid->SiteThemeInstance->retrieveString( 'GreaterThan' ),
            self::FilterLessThanOrEqualTo       => $grid->SiteThemeInstance->retrieveString( 'LessThanOrEqualTo' ),
            self::FilterGreaterThanOrEqualTo    => $grid->SiteThemeInstance->retrieveString( 'GreaterThanOrEqualTo' ),
            self::FilterContains                => $grid->SiteThemeInstance->retrieveString( 'Contains' ),
            self::FilterNotContains             => $grid->SiteThemeInstance->retrieveString( 'DoesNotContain' ),
            self::FilterBeginsWith              => $grid->SiteThemeInstance->retrieveString( 'BeginsWith' ),
            self::FilterEndsWith                => $grid->SiteThemeInstance->retrieveString( 'EndsWith' ),
            self::FilterEmpty                   => $grid->SiteThemeInstance->retrieveString( 'IsEmpty' ),
            self::FilterNotEmpty                => $grid->SiteThemeInstance->retrieveString( 'IsNotEmpty' ),
        );

        $selectedIndex = array_search( $this->_FilterMethod, array_keys( $possibleMethods ) );
        if( $selectedIndex === false )
            $selectedIndex = 0;

        if( !$this->FilterMethodSelector )
        {
            $this->FilterMethodSelector = new JTComboBox( null );
            $this->FilterMethodSelector->Items = $possibleMethods;
            $this->FilterMethodSelector->ItemIndex = $selectedIndex;
            $this->FilterMethodSelector->Name = $grid->Name . '_' . $this->Name . '_FilterMethod';
            $this->FilterMethodSelector->getStyleFont()->Size = '8pt';
            $this->FilterMethodSelector->TabOrder = '';
            $this->FilterMethodSelector->Width = '';
            $this->FilterMethodSelector->jsOnChange = $onChange;
        }

        ob_start();

        $this->FilterMethodSelector->dumpContents( false );

        return ob_get_clean();
    }

    protected function initFilterMethod( $grid )
    {
        if( isset( $_POST[ $grid->Name . '_' . $this->Name . '_FilterMethod' ] ) )
        {
            $filterObj = $_POST[ $grid->Name . '_' . $this->Name . '_FilterMethod' ];
            if( strlen( $filterObj ) )
                $this->_FilterMethod = $filterObj;
        }
    }

    abstract function dumpEditor( $grid );
    abstract function dumpFilter( $grid, $simpleFilter, $colIndex );
    abstract function dumpExportData( $grid, $fields, $rowIndex, $colIndex );
    abstract function dumpCellData( $grid, $fields, $rowIndex, $colIndex );

    function readIndex()
    {
        return $this->_Index;
    }

    function writeIndex( $value )
    {
        $this->_Index = $value;
    }

    function readNamePath()
    {
        $result = 'Column' . $this->_Index;

        if( $this->_owner )
        {
            $s = $this->_owner->readNamePath();

            if( strlen( $s ) )
                $result = $s . '.' . $result;
        }

        return $result;
    }

    function getAlignment()
    {
        return $this->_Alignment;
    }

    function setAlignment( $value )
    {
        $this->_Alignment = $value;
    }

    function defaultAlignment()
    {
        return agLeft;
    }

    function getCanEdit()
    {
        return $this->_CanEdit;
    }

    function setCanEdit( $value )
    {
        $this->_CanEdit = $value;
    }

    function defaultCanEdit()
    {
        return true;
    }

    function getCanFilter()
    {
        return $this->_CanFilter;
    }

    function setCanFilter( $value )
    {
        $this->_CanFilter = $value;
    }

    function defaultCanFilter()
    {
        return true;
    }

    function getCanMove()
    {
        return $this->_CanMove;
    }

    function setCanMove( $value )
    {
        $this->_CanMove = $value;
    }

    function defaultCanMove()
    {
        return true;
    }

    function getCanResize()
    {
        return $this->_CanResize;
    }

    function setCanResize( $value )
    {
        $this->_CanResize = $value;
    }

    function defaultCanResize()
    {
        return true;
    }

    function getCanScroll()
    {
        return $this->_CanScroll;
    }

    function setCanScroll( $value )
    {
        $this->_CanScroll = $value;
    }

    function defaultCanScroll()
    {
        return true;
    }

    function getCanSelect()
    {
        return $this->_CanSelect;
    }

    function setCanSelect( $value )
    {
        $this->_CanSelect = $value;
    }

    function defaultCanSelect()
    {
        return true;
    }

    function getCanSort()
    {
        return $this->_CanSort;
    }

    function setCanSort( $value )
    {
        $this->_CanSort = $value;
    }

    function defaultCanSort()
    {
        return true;
    }

    function getCaption()
    {
        return $this->_Caption;
    }

    function setCaption( $value )
    {
        // echo( "<!-- setting caption to '$value' -->\r\n" );
        $this->_Caption = $value;
    }

    function defaultCaption()
    {
        return '';
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

    function getDefaultFilter()
    {
        return $this->_DefaultFilter;
    }

    function setDefaultFilter( $value )
    {
        if( is_scalar( $value ) )
            $this->_DefaultFilter = $value;
    }

    function defaultDefaultFilter()
    {
        return self::FilterNoFilter;
    }

    function getFilter()
    {
        return $this->_Filter;
    }

    function setFilter( $value )
    {
        if( is_scalar( $value ) )
            $this->_Filter = $value;
    }

    function defaultFilter()
    {
        return '';
    }

    function getFilterMethod()
    {
        return $this->_FilterMethod;
    }

    function setFilterMethod( $value )
    {
        if( is_scalar( $value ) )
            $this->_FilterMethod = $value;
    }

    function defaultFilterMethod()
    {
        return self::FilterNoFilter;
    }

    function getGrid()
    {
        return $this->_Grid;
    }

    function getGroupSummary()
    {
        return $this->_GroupSummary;
    }

    function setGroupSummary( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridColumnGroupSummary )
            $this->_GroupSummary = $value;
    }

    function getName()
    {
        return $this->_name;
    }

    function setName( $value )
    {
        if( empty( $value ) )
            throw new JTPlatinumGridException( "Cannot set " . get_class( $this ) . "->Name to an empty string." );

        $this->_name = $value;
    }

    function defaultName()
    {
        return '';
    }

    function getShowSortButton()
    {
        return $this->_ShowSortButton;
    }

    function setShowSortButton( $value )
    {
        $this->_ShowSortButton = $value;
    }

    function defaultShowSortButton()
    {
        return true;
    }

    function getSortDirection()
    {
        return $this->_SortDirection;
    }

    function setSortDirection( $value )
    {
        $this->_SortDirection = $value;
    }

    function defaultSortDirection()
    {
        return '';
    }
    /*
    function getTwoWaySort()
    {
        return $this->_TwoWaySort;
    }

    function setTwoWaySort( $value )
    {
        $this->_TwoWaySort = $value;
    }

    function defaultTwoWaySort()
    {
        return true;
    }
    */
    function getSummary()
    {
        return $this->_Summary;
    }

    function setSummary( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridColumnSummary )
            $this->_Summary = $value;
    }

    function getVerticalAlignment()
    {
        return $this->_VerticalAlignment;
    }

    function setVerticalAlignment( $value )
    {
        $this->_VerticalAlignment = $value;
    }

    function defaultVerticalAlignment()
    {
        return agMiddle;
    }

    function getVisible()
    {
        return $this->_Visible;
    }

    function setVisible( $value )
    {
        $this->_Visible = $value;
    }

    function defaultVisible()
    {
        return true;
    }

    function getWidth()
    {
        return $this->_Width;
    }

    function setWidth( $value )
    {
        $this->_Width = $value;
    }

    function defaultWidth()
    {
        return '';
    }
}

class JTPlatinumGridBooleanColumn extends JTPlatinumGridColumn
{
    const CheckBox = 'CheckBox';
    const Numeric = 'Numeric';
    const Text = 'Text';

    protected $_DisplayFormat = JTPlatinumGridBooleanColumn::Text;
    protected $_FalseText = 'False';
    protected $_TrueText = 'True';

    function dumpEditor( $grid )
    {
        $vars = array
        (
            'EDITORNAME'    => $grid->Name . '_' . $this->Name . '_Editor',
            'EDITORFIELD'   => $this->_DataField,
        );

        return $grid->generateComponentSectionCode( 'BooleanEditor', $vars );
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        if( isset( $fields[ $this->_DataField ] ) )
            $value = $fields[ $this->_DataField ];
        else
            $value = '';

        if( $this->_DisplayFormat == self::CheckBox )
        {
            return ( ( $value ) ? 'X' : ' ' );
        }
        else if( $this->_DisplayFormat == self::Numeric )
        {
            return ( ( $value ) ? '1' : '0' );
        }
        else
        {
            return ( ( $value ) ? $this->_TrueText : $this->_FalseText );
        }
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        $options =
            '<option value="1"' . ( $this->_Filter ? ' selected' : '' ) . '>' . $this->_TrueText . '</option>' .
            '<option value="0"' . ( ( $this->_Filter && $this->_Filter != '' ) ? '' : ' selected' ) . '>' . $this->_FalseText . '</option>' .
            '<option value=""' . ( ( $this->_Filter == '' ) ? ' selected' : '' ) . '></option>';

        $vars = array
        (
            'INDEX'         => $colIndex,
            'EXTRACLASSES'  => ( !$this->_Visible ? 'novisible' : '' ),
            'FILTERNAME'    => $grid->Name . '_' . $this->Name . '_Filter',
            'FILTERFIELD'   => $this->_DataField,
            'FILTEROPTIONS' => $options,
        );

        return $grid->generateComponentSectionCode( 'BooleanFilter', $vars );
    }

    function matchesFilter( $fields )
    {
        if( strlen( $this->_Filter ) )
        {
            $value = $fields[ $this->_DataField ];

            return ( (bool)( $value ) == (bool)( $this->_Filter ) );
        }
        else
        {
            return true;
        }
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        $this->DumpValue = true;

        if( isset( $fields[ $this->_DataField ] ) )
            $value = $fields[ $this->_DataField ];
        else
            $value = '';

        if( $this->_DisplayFormat == self::CheckBox )
        {
            if( $value )
                $checked = ' checked="checked"';
            else
                $checked = '';

            return '<input type="checkbox" disabled="disabled"' . $checked . ' />';
        }
        else if( $this->_DisplayFormat == self::Numeric )
        {
            return ( ( $value ) ? '1' : '0' );
        }
        else
        {
            return ( ( $value ) ? $this->_TrueText : $this->_FalseText );
        }
    }

    protected function initFilterMethod( $grid )
    {
        $this->_FilterMethod = ( strlen( $this->_Filter ) ? JTPlatinumGridColumn::FilterEquals : JTPlatinumGridColumn::FilterNoFilter );
    }

    function getDisplayFormat()
    {
        return $this->_DisplayFormat;
    }

    function setDisplayFormat( $value )
    {
        $this->_DisplayFormat = $value;
    }

    function defaultDisplayFormat()
    {
        return self::Text;
    }

    function getFalseText()
    {
        return $this->_FalseText;
    }

    function setFalseText( $value )
    {
        $this->_FalseText = $value;
    }

    function defaultFalseText()
    {
        return 'false';
    }

    function getTrueText()
    {
        return $this->_TrueText;
    }

    function setTrueText( $value )
    {
        $this->_TrueText = $value;
    }

    function defaultTrueText()
    {
        return 'true';
    }
}

class JTPlatinumGridCommandColumn extends JTPlatinumGridColumn
{
    protected $_Commands = array();

    function __construct( $agrid )
    {
        parent::__construct( $agrid );

        $this->CanSelect = false;
    }

    function dumpEditor( $grid )
    {
        return '';
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        return '';
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        return $grid->generateComponentSectionCode( 'BlankFilter', array( 'EXTRACLASSES'  => ( !$this->_Visible ? 'novisible' : '' ) ) );
    }

    function allowserialize( $propname )
    {
        if( $propname == 'Commands' )
            return false;

        return parent::allowserialize( $propname );
    }

    function serialize()
    {
        parent::serialize();

        $serializedCommands = array();
        foreach( $this->_Commands as $command )
            $serializedCommands[] = $command->toString();

        $_SESSION[ $this->readNamePath() . '.SerializedCommands' ] = $serializedCommands;
    }

    function unserialize()
    {
        parent::unserialize();

        if( $this->inSession( '' ) )
        {
            $this->_Commands = array();

            $serializedCommands = $_SESSION[ $this->readNamePath() . '.SerializedCommands' ];
            foreach( $serializedCommands as $serializedCommand )
            {
                $command = new JTPlatinumGridCommand();
                $command->fromString( $serializedCommand );

                $this->_Commands[] = $command;
            }
        }
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        $result = '';
        foreach( $this->_Commands as $i => $command )
        {
            $vars = array
            (
                'CAPTION'       => $command->getCaption(),
                'INDEX'         => $i,
                'COLUMN'        => $this->_name,
                'COLUMNINDEX'   => $this->_Index,
                'ROWINDEX'      => $rowIndex,
            );

            $result .= $grid->generateComponentSectionCode( 'CommandColCommand', $vars );
        }

        $vars = array
        (
            'COLUMN'    => $this->_name,
            'COMMANDS'  => $result,
        );

        return $grid->generateComponentSectionCode( 'CommandCol', $vars );
    }

    function Add( $caption, $argument = null )
    {
        $command = new JTPlatinumGridCommand();
        $command->Argument = $argument;
        $command->Caption = $caption;

        $this->_Commands[] = $command;
    }

    function Clear()
    {
        $this->_Commands = array();
    }

    function getCommands()
    {
        return $this->_Commands;
    }

    function setCommands( $value )
    {
        $this->_Commands = $value;
    }
}

class JTPlatinumGridCommand extends JTPersistent
{
    protected $_Argument;
    protected $_Caption = '';

    function getArgument()
    {
        return $this->_Argument;
    }

    function setArgument( $value )
    {
        $this->_Argument = $value;
    }

    function defaultArgument()
    {
        return '';
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
}

class JTPlatinumGridCustomColumn extends JTPlatinumGridColumn
{
    function dumpEditor( $grid )
    {
        if( $grid->OnCustomEditorGenerate )
            return $grid->callEvent( 'oncustomeditorgenerate', array( $grid, $this ) );
        else
            return '';
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        return $grid->callEvent( 'oncustomfieldgenerate', array( $grid, $this, $fields, true ) );
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        if( $grid->OnCustomFilterGenerate )
        {
            $code = $grid->callEvent( 'oncustomfiltergenerate', array( $grid, $this ) );

            $vars = array
            (
                'CODE'          => $code,
                'EXTRACLASSES'  => ( !$this->_Visible ? 'novisible' : '' ),
                'INDEX'         => $colIndex,
                'FILTERNAME'    => $grid->Name . '_' . $this->Name . '_Filter',
                'FILTERVALUE'   => $this->_Filter,
            );

            return $grid->generateComponentSectionCode( 'CustomFilter', $vars );
        }
        else
        {
            return $grid->generateComponentSectionCode( 'BlankFilter', array( 'EXTRACLASSES'  => ( !$this->_Visible ? 'novisible' : '' ) ) );
        }
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        return $grid->callEvent( 'oncustomfieldgenerate', array( $grid, $this, $fields, false ) );
    }
}

class JTPlatinumGridDateTimeColumn extends JTPlatinumGridColumn
{
    const DateOnly = 'DateOnly';
    const DateAndTime = 'DateAndTime';
    const TimeOnly = 'TimeOnly';

    protected $_Display = JTPlatinumGridDateTimeColumn::DateAndTime;
    protected $_Format = '';
    protected $_TimeFormat = tt12Hour;

    protected $EditorPicker = null;
    protected $FilterPicker = null;

    function dumpEditor( $grid )
    {
        switch( $this->_Display )
        {
            case self::DateOnly:
                $this->EditorPicker = new JTDatePicker( null );
                break;

            case self::DateAndTime:
                $this->EditorPicker = new JTDateTimePicker( null );
                break;

            case self::TimeOnly:
                $this->EditorPicker = new JTTimePicker( null );
                break;
        }

        $this->EditorPicker->Name = $grid->Name . '_' . $this->_name . '_Editor';
        $this->EditorPicker->Width = '';

        ob_start();

        $this->EditorPicker->dumpContents();

        return ob_get_clean();
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        return $this->dumpCellData( $grid, $fields, $rowIndex, $colIndex );
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        $bits = explode( '|', $this->_Filter, 2 );

        switch( $this->_Display )
        {
            case self::DateOnly:
                $this->FilterPicker = new JTDatePicker( null );
                $this->FilterPicker->Date = $bits[ 0 ];
                $this->FilterPicker->jsOnChange = 'function() { ' . $grid->Name . '.FRequestor(); }';
                break;

            case self::DateAndTime:
                $this->FilterPicker = new JTDateTimePicker( null );
                $this->FilterPicker->DateTime = $bits[ 0 ];
                $this->FilterPicker->jsOnChange = 'function() { ' . $grid->Name . '.FRequestor(); }';
                break;

            case self::TimeOnly:
                $this->FilterPicker = new JTTimePicker( null );
                $this->FilterPicker->Time = $bits[ 0 ];
                $this->FilterPicker->TimeType = $this->_TimeFormat;
                $this->FilterPicker->jsOnChange = 'function() { ' . $grid->Name . '._delayFilterFire(); }';
                break;
        }

        $this->FilterPicker->Name = $grid->Name . '_' . $this->Name . '_Filter';
        $this->FilterPicker->getStyleFont()->Size = '8pt';
        $this->FilterPicker->Width = '';

        ob_start();

        $this->FilterPicker->dumpContents();

        $vars = array
        (
            'CONTROL'   => ob_get_clean(),
            'INDEX'     => $colIndex,
        );

        if( !$simpleFilter )
        {
            if( $this->_Display != self::TimeOnly )
            {
                $toFilter = ( isset( $bits[ 1 ] ) ? $bits[ 1 ] : '' );

                if( $this->_Display == self::DateOnly )
                {
                    $this->FilterPicker = new JTDatePicker( null );
                    $this->FilterPicker->Date = $toFilter;
                }
                else
                {
                    $this->FilterPicker = new JTDateTimePicker( null );
                    $this->FilterPicker->DateTime = $toFilter;
                }

                $this->FilterPicker->jsOnChange = 'function() { ' . $grid->Name . '.FRequestor(); }';
                $this->FilterPicker->Name = $grid->Name . '_' . $this->Name . '_ToFilter';
                $this->FilterPicker->getStyleFont()->Size = '8pt';
                $this->FilterPicker->Width = '';

                ob_start();

                $this->FilterPicker->dumpContents();

                $vars[ 'FILTERMETHODCONTROL' ] = ob_get_clean();
            }
            else
            {
                $vars[ 'FILTERMETHODCONTROL' ] = $this->dumpFilterSelector( $grid, "function() { " . $grid->Name . "._txtFilterMethodChange('" . $grid->Name . '_' . $this->Name . '_Filter' . "'); }" );
            }
        }

        if( $this->_Display != self::TimeOnly )
            return $grid->generateComponentSectionCode( $simpleFilter ? 'DateTimeFilter' : 'DateTimeFilterComplex', $vars );
        else
            return $grid->generateComponentSectionCode( $simpleFilter ? 'TimeFilter' : 'TimeFilterComplex', $vars );
    }

    function dumpBodyJavaScript( $isAjax )
    {
        parent::dumpBodyJavaScript( $isAjax );

        if( $isAjax )
        {
            if( $this->EditorPicker )
                $this->EditorPicker->dumpBodyJavaScript();

            if( $this->FilterPicker )
                $this->FilterPicker->dumpBodyJavaScript();
        }
    }

    function initFilter( $grid )
    {
        $filterChanged = ( $this->_Filter || $this->_FilterMethod != self::FilterNoFilter );

        // $this->_Filter = '';
        $this->_FilterMethod = self::FilterNoFilter;

        if( $this->_Display == self::TimeOnly )
        {
            $this->retrieveTimeFilter( $grid );
            $this->initFilterMethod( $grid );
        }
        else
        {
            $bits = explode( '|', $this->_Filter, 2 );

            if( isset( $_POST[ $grid->Name . '_' . $this->Name . '_Filter' ] ) )
            {
                $filterObj = $_POST[ $grid->Name . '_' . $this->Name . '_Filter' ];
                $bits[ 0 ] = $filterObj;
            }

            if( isset( $_POST[ $grid->Name . '_' . $this->Name . '_ToFilter' ] ) )
            {
                $filterObj = $_POST[ $grid->Name . '_' . $this->Name . '_ToFilter' ];
                $bits[ 1 ] = $filterObj;
            }

            $this->_Filter = implode( '|', $bits );
            $this->_FilterMethod = self::FilterEquals;
            //Shiraly
            if ($this->_Display == self::DateOnly && ($this->_Filter)) $this->_FilterMethod = self::FilterContains;
        }

        return ( $this->_Filter || $this->_FilterMethod || $filterChanged );
    }

    function generateFilterSQL( $grid, $value, $valueQuoted, $simpleFilter )
    {
        if( !$simpleFilter && $this->_Display != self::TimeOnly )
        {
            $bits = explode( '|', $this->_Filter, 2 );
            $filters = array();

            if( $bits[ 0 ] )
            {
                $grid->sqlQuote( $bits[ 0 ], $value, $valueQuoted );
                $filters[] = "$valueQuoted <= $this->_DataField";
            }

            if( isset( $bits[ 1 ] ) && $bits[ 1 ] )
            {
                $grid->sqlQuote( $bits[ 1 ], $value, $valueQuoted );
                $filters[] = "$valueQuoted >= $this->_DataField";
            }

            return ( count( $filters ) ? implode( ' AND ', $filters ) : false );
        }
        else
        {
            switch( $this->_FilterMethod )
            {
                case JTPlatinumGridColumn::FilterNotEqual:
                    $o = "<> $valueQuoted";
                    break;

                case JTPlatinumGridColumn::FilterLessThan:
                    $o = "< $valueQuoted";
                    break;

                case JTPlatinumGridColumn::FilterGreaterThan:
                    $o = "> $valueQuoted";
                    break;

                case JTPlatinumGridColumn::FilterLessThanOrEqualTo:
                    $o = "<= $valueQuoted";
                    break;

                case JTPlatinumGridColumn::FilterGreaterThanOrEqualTo:
                    $o = ">= $valueQuoted";
                    break;

                //Shiraly
                case JTPlatinumGridColumn::FilterContains:
                    $o = "LIKE '%$value%'";
                    break;

                case JTPlatinumGridColumn::FilterNotContains:
                case JTPlatinumGridColumn::FilterEndsWith:
                case JTPlatinumGridColumn::FilterBeginsWith:
                    return false;

                case JTPlatinumGridColumn::FilterEmpty:
                    $o = "= ''";
                    break;

                case JTPlatinumGridColumn::FilterNotEmpty:
                    $o = "<> ''";
                    break;

                case JTPlatinumGridColumn::FilterEquals:
                default:
                    if( !$this->_Filter )
                        return false;

                    $o = "= $valueQuoted";
                    break;
            }

            return "$this->_DataField $o";
        }
    }

    function processFieldValue( $value )
    {
        if( strlen( $value ) == 0 )
            return null;
        else
            return $value;
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        $this->DumpValue = true;

        // 1 Date
        // 2 Year
        // 3 Month
        // 4 Day
        // 5 Time
        // 6 Hour
        // 7 Minute
        // 8 Second.
        if( isset( $fields[ $this->_DataField ] ) )
            $fieldValue = $fields[ $this->_DataField ];
        else
            $fieldValue = '';
        $value = '';

        if( $fieldValue )
        {
            $timestamp = false;

            if( preg_match( '/^(([0-9]{4})\-([0-9]{2})\-([0-9]{2}))?(\s+)?(([0-9]+)\:([0-9]+)\:([0-9]+))?$/', $fieldValue, $matches ) )
            {
                if( isset( $matches[ 1 ] ) && isset( $matches[ 6 ] ) )
                    $timestamp = mktime( $matches[ 7 ], $matches[ 8 ], $matches[ 9 ], $matches[ 3 ], $matches[ 4 ], $matches[ 2 ] );
                else if( isset( $matches[ 1 ] ) )
                    $timestamp = mktime( 0, 0, 0, $matches[ 3 ], $matches[ 4 ], $matches[ 2 ] );
                else if( isset( $matches[ 6 ] ) )
                    $timestamp = mktime( $matches[ 7 ], $matches[ 8 ], $matches[ 9 ] );
            }

            if( $timestamp !== false )
            {
                if( !$this->_Format )
                {
                    if( $this->_Display == self::DateAndTime || $this->_Display == self::DateOnly )
                        $format = 'Y-m-d';

                    if( $this->_Display == self::DateAndTime || $this->_Display == self::TimeOnly )
                    {
                        if( $format )
                            $format .= ' ';

                        $format .= 'H:i:s';
                    }
                }
                else
                {
                    $format = $this->_Format;
                }

                $value = date( $format, $timestamp );
            }
        }

        return $value;
    }

    protected function retrieveTimeFilter( $grid )
    {
        $filterName = $grid->Name . '_' . $this->Name . '_Filter';

        $hInput = $filterName . '_h';
        $mInput = $filterName . '_m';
        $sInput = $filterName . '_s';
        $aInput = $filterName . '_a';

        $hInput = isset( $_POST[ $hInput ] ) ? $_POST[ $hInput ] : '';
        $mInput = isset( $_POST[ $mInput ] ) ? $_POST[ $mInput ] : '';
        $sInput = isset( $_POST[ $sInput ] ) ? $_POST[ $sInput ] : '';
        $aInput = isset( $_POST[ $aInput ] ) ? $_POST[ $aInput ] : '';

        if( strlen( $hInput ) && strlen( $mInput ) && strlen( $sInput ) && ( $this->_TimeFormat != tt12Hour || strlen( $aInput ) ) )
        {
            $h = $hInput;
            $m = $mInput;
            $s = $sInput;
            $a = $aInput;

            if( $h == '' )
                $h = '0';

            if( $m == '' )
                $m = '0';

            if( $s == '' )
                $s = '0';

            if( is_numeric( $h ) && is_numeric( $m ) && is_numeric( $s ) && ( $this->_TimeFormat != tt12Hour || $a == 'AM' || $a == 'PM' ) )
            {
                if( $this->_TimeFormat == tt12Hour )
                {
                    if( $h == 12 )
                        $h = 0;

                    if( $a == 'PM' )
                        $h += 12;
                }

                $this->_Filter = date( 'H:i:s', mktime( $h, $m, $s ) );
            }
        }
    }

    function getDisplay()
    {
        return $this->_Display;
    }

    function setDisplay( $value )
    {
        $this->_Display = $value;
    }

    function defaultDisplay()
    {
        return self::DateAndTime;
    }

    function getFormat()
    {
        return $this->_Format;
    }

    function setFormat( $value )
    {
        $this->_Format = $value;
    }

    function defaultFormat()
    {
        return '';
    }

    function getTimeFormat()
    {
        return $this->_TimeFormat;
    }

    function setTimeFormat( $value )
    {
        $this->_TimeFormat = $value;
    }

    function defaultTimeFormat()
    {
        return tt12Hour;
    }
}

class JTPlatinumGridImageColumn extends JTPlatinumGridColumn
{
    const BinaryData = 'BinaryData';
    const FileName = 'FileName';

    protected $_DataType = JTPlatinumGridImageColumn::BinaryData;
    protected $_FileNameFormat = '';

    function __construct( $agrid )
    {
        parent::__construct( $agrid );

        $this->_CanSort = false;
    }

    function dumpEditor( $grid )
    {
        // Should we make this an upload field, or what?
        return '';
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        return '';
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        return $grid->generateComponentSectionCode( 'BlankFilter', array( 'EXTRACLASSES'  => ( !$this->_Visible ? 'novisible' : '' ) ) );
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        if( $this->_DataType == self::BinaryData )
        {
            if( ( $grid->ControlState & csDesigning ) == 0 && !$grid->KeyField )
                throw new JTPlatinumGridException( 'Binary image column can not be shown because ' . $grid->Name . '->KeyField is empty.' );

            if( ( $grid->ControlState & csDesigning ) == 0 )
                $fileName = '?GridImage=1&GridCol=' . $this->Name . '&' . $grid->KeyField . '=' . urlencode( $fields[ $grid->KeyField ] );
            else
                $fileName = '?GridImage=1&GridCol=' . $this->Name . '&' . $grid->KeyField . '=<value>';
        }
        else
        {
            if( ( $grid->ControlState & csDesigning ) == 0 )
                $value = $fields[ $this->_DataField ];
            else
                $value = '<file>';

            if( $this->_FileNameFormat )
                $fileName = str_replace( '{FILENAME}', $value, $this->_FileNameFormat );
            else
                $fileName = $fields[ $this->_DataField ];
        }

        $vars = array
        (
            'FILENAME'  => $fileName,
        );

        return $grid->generateComponentSectionCode( 'ImageCell', $vars );
    }

    function getDataType()
    {
        return $this->_DataType;
    }

    function setDataType( $value )
    {
        $this->_DataType = $value;
    }

    function defaultDataType()
    {
        return self::BinaryData;
    }

    function getFileNameFormat()
    {
        return $this->_FileNameFormat;
    }

    function setFileNameFormat( $value )
    {
        $this->_FileNameFormat = $value;
    }

    function defaultFileNameFormat()
    {
        return '';
    }
}

class JTPlatinumGridMemoColumn extends JTPlatinumGridColumn
{
    const Characters = 'Characters';
    const Words = 'Words';

    protected $_CharacterLimit = 0;
    protected $_Limit = JTPlatinumGridMemoColumn::Words;
    protected $_WordLimit = 5;

    function dumpEditor( $grid )
    {
        $vars = array
        (
            'EDITORNAME'    => $grid->Name . '_' . $this->Name . '_Editor',
            'EDITORFIELD'   => $this->_DataField,
        );

        return $grid->generateComponentSectionCode( 'MemoEditor', $vars );
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        return $this->dumpCellData( $grid, $fields, $rowIndex, $colIndex );
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        // Can memo fields be filtered?
        return $grid->generateComponentSectionCode( 'BlankFilter', array( 'EXTRACLASSES'  => ( !$this->_Visible ? 'novisible' : '' ) ) );
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        $this->DumpValue = true;

        $value = $fields[ $this->_DataField ];

        if( $this->_Limit == self::Characters && $this->_CharacterLimit > 0 )
        {
            $value = substr( $value, 0, $this->_CharacterLimit ) . '...';
        }
        else if( $this->_Limit == self::Words && $this->_WordLimit > 0 )
        {
            $words = preg_split( '/\W+/', $value, $this->_WordLimit + 1, PREG_SPLIT_OFFSET_CAPTURE );
            if( count( $words ) == ( $this->_WordLimit + 1 ) )
            {
                $offset = strlen( $words[ $this->_WordLimit - 1 ][ 0 ] ) + $words[ $this->_WordLimit - 1 ][ 1 ];

                $value = substr( $value, 0, $offset ) . '...';
            }
        }

        return $value;
    }

    function getCharacterLimit()
    {
        return $this->_CharacterLimit;
    }

    function setCharacterLimit( $value )
    {
        $this->_CharacterLimit = $value;
    }

    function defaultCharacterLimit()
    {
        return 0;
    }

    function getLimit()
    {
        return $this->_Limit;
    }

    function setLimit( $value )
    {
        $this->_Limit = $value;
    }

    function defaultLimit()
    {
        return self::Words;
    }

    function getWordLimit()
    {
        return $this->_WordLimit;
    }

    function setWordLimit( $value )
    {
        $this->_WordLimit = $value;
    }

    function defaultWordLimit()
    {
        return 5;
    }
}

class JTPlatinumGridTextColumn extends JTPlatinumGridColumn
{
    // edit, combo, lookup-combo, checkbox, custom
    const ComboBox = 'ComboBox';
    const Custom = 'Custom';
    const Edit = 'Edit';
    const LookupComboBox = 'LookupComboBox';

    protected $_ComboBoxEditor = null;
    protected $_DataFormat = '';
    protected $_EditEditor = null;
    protected $_EditorType = JTPlatinumGridTextColumn::Edit;
    protected $_FilterOptions = array();
    protected $_HyperlinkField = '';
    protected $_HyperlinkFormat = '';
    protected $_LookupComboBoxEditor = null;
    protected $_TextField = '';

    protected $FilterOptionComboBox = null;

    function __construct( $agrid )
    {
        parent::__construct( $agrid );

        $this->_ComboBoxEditor = new JTPlatinumGridTextColumnComboBoxEditor( $this );
        $this->_EditEditor = new JTPlatinumGridTextColumnEditEditor( $this );
        $this->_LookupComboBoxEditor = new JTPlatinumGridTextColumnLookupComboBoxEditor( $this );
    }

    function dumpEditor( $grid )
    {
        switch( $this->_EditorType )
        {
            case self::ComboBox:
                return $this->_ComboBoxEditor->dumpEditor( $grid, $this );

            case self::Custom:
                return $grid->callEvent( 'oncustomeditorgenerate', array( $grid, $this ) );

            case self::Edit:
                return $this->_EditEditor->dumpEditor( $grid, $this );

            case self::LookupComboBox:
                return $this->_LookupComboBoxEditor->dumpEditor( $grid, $this );
        }

        return '';
    }

    function dumpExportData( $grid, $fields, $rowIndex, $colIndex )
    {
        if( $this->_TextField )
            $value = isset( $fields[ $this->_TextField ] ) ? $fields[ $this->_TextField ] : '';
        else if( isset( $fields[ $this->_DataField ] ) )
            $value = $fields[ $this->_DataField ];
        else
            $value = '';

        if( $this->_DataFormat )
            $value = sprintf( $this->_DataFormat, $value );

        return $value;
    }

    function dumpFilter( $grid, $simpleFilter, $colIndex )
    {
        $filterMethodOptions = '';
        $filterMethodControl = '';

        $filterOnChange = "function() { " . $grid->Name . "._txtFilterMethodChange('" . $grid->Name . '_' . $this->Name . '_Filter' . "'); }";

        if( !$simpleFilter )
            $filterMethodControl = $this->dumpFilterSelector( $grid, $filterOnChange );

        $filterOptionControl = $this->dumpFilterOptionComboBox( $grid, $filterOnChange );

        $vars = array
        (
            'INDEX'                 => $colIndex,
            'EXTRACLASSES'          => ( !$this->_Visible ? 'novisible' : '' ),
            'FILTERNAME'            => $grid->Name . '_' . $this->Name . '_Filter',
            'FILTERVALUE'           => $this->_Filter,
            'FILTERMETHODNAME'      => $grid->Name . '_' . $this->Name . '_FilterMethod',
            'FILTERMETHODCONTROL'   => $filterMethodControl,
            'FILTEROPTIONCONTROL'   => $filterOptionControl,
        );

        if( $filterOptionControl )
            $templateName = ( $simpleFilter ) ? 'TextFilterCombo' : 'TextFilterComboComplex';
        else
            $templateName = ( $simpleFilter ) ? 'TextFilter' : 'TextFilterComplex';

        return $grid->generateComponentSectionCode( $templateName, $vars );
    }

    function dumpBodyJavaScript( $isAjax )
    {
        parent::dumpBodyJavaScript( $isAjax );

        if( $isAjax )
        {
            if( $this->FilterOptionComboBox )
                $this->FilterOptionComboBox->dumpBodyJavaScript();
        }
    }

    function loaded()
    {
        parent::loaded();

        $this->_LookupComboBoxEditor->loaded();
    }

    function generateFilterSQL( $grid, $value, $valueQuoted, $simpleFilter )
    {
        if( $simpleFilter && strlen( $this->_Filter ) == 0 )
            return false;

        switch( $this->_FilterMethod )
        {
            case JTPlatinumGridColumn::FilterEquals:
                $o = "= $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterNotEqual:
                $o = "<> $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterLessThan:
                $o = "< $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterGreaterThan:
                $o = "> $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterLessThanOrEqualTo:
                $o = "<= $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterGreaterThanOrEqualTo:
                $o = ">= $valueQuoted";
                break;

            case JTPlatinumGridColumn::FilterContains:
                $o = "LIKE '%$value%'";
                break;

            case JTPlatinumGridColumn::FilterNotContains:
                $o = "NOT LIKE '%$value%'";
                break;

            case JTPlatinumGridColumn::FilterEmpty:
                $o = "= ''";
                break;

            case JTPlatinumGridColumn::FilterNotEmpty:
                $o = "<> ''";
                break;

            case JTPlatinumGridColumn::FilterEndsWith:
                $o = "LIKE '%$value'";
                break;

            case JTPlatinumGridColumn::FilterBeginsWith:
            default:
                if( !strlen( $this->_Filter ) )
                    return false;

                $o = "LIKE '$value%'";
                break;
        }

        return ( $this->_TextField ? $this->_TextField : $this->_DataField ) . ' ' . $o;
    }

    function dumpCellData( $grid, $fields, $rowIndex, $colIndex )
    {
        if( isset( $fields[ $this->_DataField ] ) )
            $value = $fields[ $this->_DataField ];
        else
            $value = '';

        if( $this->_TextField )
        {
            $this->DumpValue = true;

            if( isset( $fields[ $this->_TextField ] ) )
                $text = $fields[ $this->_TextField ];
            else
                $text = '';
        }
        else
        {
            $text = $value;
        }

        if( $this->_DataFormat )
            $text = sprintf( $this->_DataFormat, $text );

        if( $this->_HyperlinkField || $this->_HyperlinkFormat )
        {
            $this->DumpValue = true;

            $hyperlink = $fields[ $this->_HyperlinkField ];
            if( $this->_HyperlinkFormat )
            {
                $hyperlink = sprintf( $this->_HyperlinkFormat, $hyperlink );
                $hyperlink = preg_replace( "/(?<!\\\\)\\[([^\\]]+)\\]/e", "(isset(\$fields['\\2']) ? \$fields['\\2'] : '')", $hyperlink);
                $hyperlink = str_replace( "\\[", "[", $hyperlink );
            }

            $vars = array
            (
                'DATA'      => $text,
                'HYPERLINK' => $hyperlink,
            );

            $text = $grid->generateComponentSectionCode( 'TextHyperlink', $vars );
        }

        return $text;
    }

    protected function dumpFilterOptionComboBox( $grid, $onChange )
    {
        if( count( $this->_FilterOptions ) > 0 )
        {
            $options = $this->_FilterOptions;

            reset( $options );

            $isNumeric = is_int( key( $options ) );
            if( !$isNumeric )
                $options = array_values( $options );

            $i = 0;
            $selectedIndex = -1;
            foreach( $this->_FilterOptions as $k => $v )
            {
                if( ( $isNumeric && $v == $this->_Filter ) || ( !$isNumeric && $k == $this->_Filter ) )
                {
                    $selectedIndex = $i;
                    break;
                }

                ++$i;
            }
        }
        else if( $this->_LookupComboBoxEditor->Datasource && $this->_LookupComboBoxEditor->PopulateFilter )
        {
            $options = $this->_LookupComboBoxEditor->asArray();
        }
        else
        {
            return '';
        }

        if( count( $options ) == 0 )
            return '';

        if( !$this->FilterOptionComboBox )
        {
            $this->FilterOptionComboBox = new JTComboBox( null );
            $this->FilterOptionComboBox->Items = $options;
            $this->FilterOptionComboBox->ItemIndex = $selectedIndex;
            $this->FilterOptionComboBox->Name = $grid->Name . '_' . $this->Name . '_FilterCombo';
            $this->FilterOptionComboBox->getStyleFont()->Size = '8pt';
            $this->FilterOptionComboBox->TabOrder = '';
            $this->FilterOptionComboBox->Width = '';
            $this->FilterOptionComboBox->jsOnChange = $onChange;
        }

        ob_start();

        $this->FilterOptionComboBox->dumpContents();

        return ob_get_clean();
    }

    protected function initFilterMethod( $grid )
    {
        parent::initFilterMethod( $grid );

        if( isset( $_POST[ $grid->Name . '_' . $this->Name . '_FilterCombo_view' ] ) )
        {
            $filterObj = $_POST[ $grid->Name . '_' . $this->Name . '_FilterCombo_view' ];

            if( count( $this->_FilterOptions ) > 0 )
            {
                reset( $this->_FilterOptions );

                $isNumeric = is_int( key( $this->_FilterOptions ) );
                if( $isNumeric )
                {
                    $this->_Filter = $filterObj;
                }
                else
                {
                    $result = array_search( $filterObj, $this->_FilterOptions );
                    if( $result !== false )
                        $this->_Filter = $result;
                }
            }
            else if( $this->_LookupComboBoxEditor->PopulateFilter )
            {
                $this->_Filter = $filterObj;
            }
        }
    }

    function getComboBoxEditor()
    {
        return $this->_ComboBoxEditor;
    }

    function setComboBoxEditor( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridTextColumnComboBoxEditor )
            $this->_ComboBoxEditor = $value;
    }

    function getDataFormat()
    {
        return $this->_DataFormat;
    }

    function setDataFormat( $value )
    {
        $this->_DataFormat = $value;
    }

    function defaultDataFormat()
    {
        return '';
    }

    function getEditEditor()
    {
        return $this->_EditEditor;
    }

    function setEditEditor( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridTextColumnEditEditor )
            $this->_EditEditor = $value;
    }

    function getEditorType()
    {
        return $this->_EditorType;
    }

    function setEditorType( $value )
    {
        $this->_EditorType = $value;
    }

    function defaultEditorType()
    {
        return self::Edit;
    }

    function getFilterOptions()
    {
        return $this->_FilterOptions;
    }

    function setFilterOptions( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        $this->_FilterOptions = $value;
    }

    function defaultFilterOptions()
    {
        return array();
    }

    function getHyperlinkField()
    {
        return $this->_HyperlinkField;
    }

    function setHyperlinkField( $value )
    {
        $this->_HyperlinkField = $value;
    }

    function defaultHyperlinkField()
    {
        return '';
    }

    function getHyperlinkFormat()
    {
        return $this->_HyperlinkFormat;
    }

    function setHyperlinkFormat( $value )
    {
        $this->_HyperlinkFormat = $value;
    }

    function defaultHyperlinkFormat()
    {
        return '';
    }

    function getLookupComboBoxEditor()
    {
        return $this->_LookupComboBoxEditor;
    }

    function setLookupComboBoxEditor( $value )
    {
        if( is_object( $value ) && $value instanceof JTPlatinumGridTextColumnLookupComboBoxEditor )
            $this->_LookupComboBoxEditor = $value;
    }

    function getTextField()
    {
        return $this->_TextField;
    }

    function setTextField( $value )
    {
        $this->_TextField = $value;
    }

    function defaultTextField()
    {
        return '';
    }
}

class JTPlatinumGridTextColumnEditor extends JTPersistent
{
    protected $_Column = null;

    function __construct( $acolumn )
    {
        parent::__construct( $acolumn );

        $this->_Column = $acolumn;
    }

    function fromString( $value )
    {
        parent::fromString( $value );
    }
}

class JTPlatinumGridTextColumnComboBoxEditor extends JTPlatinumGridTextColumnEditor
{
    protected $_Values = array();

    function dumpEditor( $grid, $column )
    {
        $result = '';
        $vars = array();

        foreach( $this->_Values as $value => $text )
        {
            $vars[ 'VALUE' ] = $value;
            $vars[ 'CAPTION' ] = $text;

            $result .= $grid->generateComponentSectionCode( 'TextColComboBoxEditorValue', $vars );
        }

        $vars = array
        (
            'EDITORNAME'    => $grid->Name . '_' . $column->Name . '_Editor',
            'EDITORFIELD'   => $column->DataField,
            'COLUMNNAME'    => $column->Name,
            'VALUES'        => $result,
        );

        return $grid->generateComponentSectionCode( 'TextColComboBoxEditor', $vars );
    }

    function getValues()
    {
        return $this->_Values;
    }

    function setValues( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        $this->_Values = $value;
    }

    function defaultValues()
    {
        return array();
    }
}

class JTPlatinumGridTextColumnEditEditor extends JTPlatinumGridTextColumnEditor
{
    protected $_IsPassword = 0;
    protected $_MaxLength = '';

    function dumpEditor( $grid, $column )
    {
        $vars = array
        (
            'EDITORNAME'    => $grid->Name . '_' . $column->Name . '_Editor',
            'COLUMNNAME'    => $column->Name,
            'MAXLENGTH'     => $this->_MaxLength,
            'TYPE'          => ( $this->_IsPassword ? 'password' : 'text' ),
        );

        return $grid->generateComponentSectionCode( 'TextColEditEditor', $vars );
    }

    function getIsPassword()
    {
        return $this->_IsPassword;
    }

    function setIsPassword( $value )
    {
        $this->_IsPassword = $value;
    }

    function defaultIsPassword()
    {
        return 0;
    }

    function getMaxLength()
    {
        return $this->_MaxLength;
    }

    function setMaxLength( $value )
    {
        $this->_MaxLength = $value;
    }

    function defaultMaxLength()
    {
        return '';
    }
}

class JTPlatinumGridTextColumnLookupComboBoxEditor extends JTPlatinumGridTextColumnEditor
{
    protected $_Datasource = null;
    protected $_PopulateFilter = 0;
    protected $_TextField = '';
    protected $_ValueField = '';

    function dumpEditor( $grid, $column )
    {
        $result = '';
        $vars = array();

        if( ( $grid->ControlState & csDesigning ) != csDesigning )
        {
            if( $this->_Datasource && $this->_Datasource->DataSet && $this->_ValueField )
            {
                $ds = $this->_Datasource->DataSet;

                //SHIRALY
                // Asigno un item al ComboBox con value CERO
                $vars[ 'VALUE' ] = '0';
                $vars[ 'CAPTION' ] = '';
                $result .= $grid->generateComponentSectionCode( 'TextColComboBoxEditorValue', $vars );

                if( !$ds->Active )
                    $ds->Open();

                for( $ds->First(); !$ds->Eof; $ds->Next() )
                {
                    $values = $ds->Fields;

                    $vars[ 'VALUE' ] = $values[ $this->_ValueField ];
                    $vars[ 'CAPTION' ] = $values[ ( ( $this->_TextField ) ? $this->_TextField : $this->_ValueField ) ];

                    $result .= $grid->generateComponentSectionCode( 'TextColComboBoxEditorValue', $vars );
                }
            }
        }

        $vars = array
        (
            'EDITORNAME'    => $grid->Name . '_' . $column->Name . '_Editor',
            'COLUMNNAME'    => $column->Name,
            'VALUES'        => $result,
        );

        return $grid->generateComponentSectionCode( 'TextColComboBoxEditor', $vars );
    }

    function asArray()
    {
        $result = array();

        if( ( $grid->ControlState & csDesigning ) != csDesigning &&
            $this->_Datasource &&
            $this->_Datasource->DataSet &&
            $this->_ValueField )
        {
            $ds = $this->_Datasource->DataSet;

            if( !$ds->Active )
                $ds->Open();

            for( $ds->First(); !$ds->Eof; $ds->Next() )
            {
                $values = $ds->Fields;

                if( $this->_TextField )
                    $result[ $values[ $this->_ValueField ] ] = $values[ $this->_TextField ];
                else
                    $result[] = $values[ $this->_ValueField ];
            }
        }

        return $result;
    }

    function loaded()
    {
        parent::loaded();

        if( !defined( 'JT_STANDALONE' ) )
            $this->setDatasource( $this->_Datasource );
    }

    function allowserialize( $propname )
    {
        if( defined( 'JT_STANDALONE' ) && $propname == 'Datasource' )
            return false;

        return parent::allowserialize( $propname );
    }

    function serialize()
    {
        if( defined( 'JT_STANDALONE' ) )
            $this->_Datasource = null;

        parent::serialize();
    }

    function getDatasource()
    {
        return $this->_Datasource;
    }

    function setDatasource( $value )
    {
        if( !$this->_Column || !$this->_Column->Grid )
            throw new JTPlatinumGridException( "Column not initialized." );

        if( is_object( $value ) )
        {
            $this->_Datasource = $value;
        }
        else
        {
            if( !$value || $value == 'NULL' )
                $this->_Datasource = null;
            else
                $this->_Datasource = JTObjectPropertyFixupAndCheck( $this->_Column->Grid, $value, 'Datasource' );
        }
    }

    function defaultDataSet()
    {
        return null;
    }

    function getPopulateFilter()
    {
        return $this->_PopulateFilter;
    }

    function setPopulateFilter( $value )
    {
        $this->_PopulateFilter = $value;
    }

    function defaultPopulateFilter()
    {
        return 0;
    }

    function getTextField()
    {
        return $this->_TextField;
    }

    function setTextField( $value )
    {
        $this->_TextField = $value;
    }

    function defaultTextField()
    {
        return '';
    }

    function getValueField()
    {
        return $this->_ValueField;
    }

    function setValueField( $value )
    {
        $this->_ValueField = $value;
    }

    function defaultValueField()
    {
        return '';
    }
}

class JTPlatinumGridColumnSummary extends JTPersistent
{
    protected $_Column = null;
    protected $_ShowAvg = 0;
    protected $_ShowCount = 0;
    protected $_ShowMax = 0;
    protected $_ShowMin = 0;
    protected $_ShowSum = 0;

    function __construct( $acolumn )
    {
        parent::__construct( $acolumn );

        $this->_Column = $acolumn;
    }

    function getShowAvg()
    {
        return $this->_ShowAvg;
    }

    function setShowAvg( $value )
    {
        $this->_ShowAvg = $value;
    }

    function getShowCount()
    {
        return $this->_ShowCount;
    }

    function setShowCount( $value )
    {
        $this->_ShowCount = $value;
    }

    function getShowMax()
    {
        return $this->_ShowMax;
    }

    function setShowMax( $value )
    {
        $this->_ShowMax = $value;
    }

    function getShowMin()
    {
        return $this->_ShowMin;
    }

    function setShowMin( $value )
    {
        $this->_ShowMin = $value;
    }

    function getShowSum()
    {
        return $this->_ShowSum;
    }

    function setShowSum( $value )
    {
        $this->_ShowSum = $value;
    }
}

class JTPlatinumGridColumnGroupSummary extends JTPlatinumGridColumnSummary
{
}

class JTPlatinumGridCommandBar extends JTPersistent
{
    protected $_ShowTopCommandBar = true;
    protected $_ShowBottomCommandBar = true;
    protected $_ShowRefresh = true;
    protected $_ShowInsertRecord = true;
    protected $_ShowExportCSV = true;
    protected $_ShowExportPDF = true;
    protected $_ShowExportXLS = true;
    protected $_ShowPrint = true;
    protected $_CustomCommands = array();
    protected $_PrintAllRecords = false;
    protected $_ExportAllRecords = false;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );
    }

    function addCustomCommand( $command, $caption )
    {
        $this->_CustomCommands[] = new JTPlatinumGridCommandBarItem( null, $caption, $command );
    }

    function clearCustomCommands()
    {
        $this->_CustomCommands = array();
    }

    function getShowTopCommandBar()
    {
        return $this->_ShowTopCommandBar;
    }

    function setShowTopCommandBar( $value )
    {
        $this->_ShowTopCommandBar = $value;
    }

    function defaultShowTopCommandBar()
    {
        return true;
    }

    function getShowBottomCommandBar()
    {
        return $this->_ShowBottomCommandBar;
    }

    function setShowBottomCommandBar( $value )
    {
        $this->_ShowBottomCommandBar = $value;
    }

    function defaultShowBottomCommandBar()
    {
        return true;
    }

    function getShowRefresh()
    {
        return $this->_ShowRefresh;
    }

    function setShowRefresh( $value )
    {
        $this->_ShowRefresh = $value;
    }

    function defaultShowRefresh()
    {
        return true;
    }

    function getShowInsertRecord()
    {
        return $this->_ShowInsertRecord;
    }

    function setShowInsertRecord( $value )
    {
        $this->_ShowInsertRecord = $value;
    }

    function defaultShowInsertRecord()
    {
        return true;
    }

    function getShowExportCSV()
    {
        return $this->_ShowExportCSV;
    }

    function setShowExportCSV( $value )
    {
        $this->_ShowExportCSV = $value;
    }

    function defaultShowExportCSV()
    {
        return true;
    }

    function getShowExportPDF()
    {
        return $this->_ShowExportPDF;
    }

    function setShowExportPDF( $value )
    {
        $this->_ShowExportPDF = $value;
    }

    function defaultShowExportPDF()
    {
        return true;
    }

    function getShowExportXLS()
    {
        return $this->_ShowExportXLS;
    }

    function setShowExportXLS( $value )
    {
        $this->_ShowExportXLS = $value;
    }

    function defaultShowExportXLS()
    {
        return true;
    }

    function getShowPrint()
    {
        return $this->_ShowPrint;
    }

    function setShowPrint( $value )
    {
        $this->_ShowPrint = $value;
    }

    function defaultShowPrint()
    {
        return true;
    }

    function readCustomCommands()
    {
        return $this->_CustomCommands;
    }

    function writeCustomCommands( $value )
    {
        $this->_CustomCommands = $value;
    }

    function getExportAllRecords()
    {
        return $this->_ExportAllRecords;
    }

    function setExportAllRecords( $value )
    {
        $this->_ExportAllRecords = $value;
    }

    function defaultExportAllRecords()
    {
        return false;
    }

    function getPrintAllRecords()
    {
        return $this->_PrintAllRecords;
    }

    function setPrintAllRecords( $value )
    {
        $this->_PrintAllRecords = $value;
    }

    function defaultPrintAllRecords()
    {
        return false;
    }
}

class JTPlatinumGridCommandBarItem extends JTPersistent
{
    protected $_Caption;
    protected $_Command;

    function __construct( $aowner = null, $caption = '', $command = '' )
    {
        parent::__construct( $aowner );

        $this->_Caption = $caption;
        $this->_Command = $command;
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

    function getCommand()
    {
        return $this->_Command;
    }

    function setCommand( $value )
    {
        $this->_Command = $value;
    }

    function defaultCommand()
    {
        return '';
    }
}

class JTPlatinumGridHeader extends JTPersistent
{
    protected $_FilterDelay = true;
    protected $_FilterDelayTimeout = 1000;
    protected $_Font = null;
    protected $_SimpleFilter = true;
    protected $_ShowFilterBar = true;
    protected $_ShowGroupBar = true;
    protected $_ShowColumnHeader = true;
    protected $_Visible = true;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_Font = new JTFont();
        $this->_Font->_control = $aowner;
    }

    function dumpCSS( $grid )
    {
        $result[] = "#{$grid->Name} .columnheader td\r\n{\r\n";

        $fontStyles = GetJTFontString( $this->_Font );
        if( $fontStyles )
            $result[] = "    $fontStyles;\r\n";

        $result[] = "}\r\n";

        return implode( '', $result );
    }

    function getFilterDelay()
    {
        return $this->_FilterDelay;
    }

    function setFilterDelay( $value )
    {
        $this->_FilterDelay = $value;
    }

    function defaultFilterDelay()
    {
        return true;
    }

    function getFilterDelayTimeout()
    {
        return $this->_FilterDelayTimeout;
    }

    function setFilterDelayTimeout( $value )
    {
        if( $value > 0 && $value < 60000 )
            $this->_FilterDelayTimeout = $value;
    }

    function defaultFilterDelayTimeout()
    {
        return 1000;
    }

    function getFont()
    {
        if( ( $this->_owner->ControlState & csDesigning ) == csDesigning )
            return $this->_Font->serializeProperties();

        return $this->_Font;
    }

    function setFont( $value )
    {
        if( ( $this->_owner->ControlState & csDesigning ) == csDesigning || ( $this->_owner->ControlState & csLoading ) == csLoading )
        {
            $this->_Font->unserializeProperties( $value );
        }
        else
        {
            if( is_object( $value ) )
                $this->_Font = $value;
        }
    }

    function defaultFont()
    {
        return null;
    }

    function getSimpleFilter()
    {
        return $this->_SimpleFilter;
    }

    function setSimpleFilter( $value )
    {
        $this->_SimpleFilter = $value;
    }

    function defaultSimpleFilter()
    {
        return true;
    }

    function getShowFilterBar()
    {
        return $this->_ShowFilterBar;
    }

    function setShowFilterBar( $value )
    {
        $this->_ShowFilterBar = $value;
    }

    function defaultShowFilterBar()
    {
        return true;
    }

    function getShowGroupBar()
    {
        return $this->_ShowGroupBar;
    }

    function setShowGroupBar( $value )
    {
        $this->_ShowGroupBar = $value;
    }

    function defaultShowGroupBar()
    {
        return true;
    }

    function getShowColumnHeader()
    {
        return $this->_ShowColumnHeader;
    }

    function setShowColumnHeader( $value )
    {
        $this->_ShowColumnHeader = $value;
    }

    function defaultShowColumnHeader()
    {
        return true;
    }

    function getVisible()
    {
        return $this->_Visible;
    }

    function setVisible( $value )
    {
        $this->_Visible = $value;
    }

    function defaultVisible()
    {
        return true;
    }
}

class JTPlatinumGridDetailView extends JTPersistent
{
    protected $_DetailField = '';
    protected $_DetailGrid = null;
    protected $_Enabled = 0;

    function loaded()
    {
        parent::loaded();

        $this->setDetailGrid( $this->_DetailGrid );
    }

    function dumpHeaderCode()
    {
        if( ( $this->_owner->ControlState & csDesigning ) == 0 )
            $this->_DetailGrid->dumpHeaderCode();
    }

    function dumpJavascript()
    {
        if( ( $this->_owner->ControlState & csDesigning ) == 0 )
            $this->_DetailGrid->dumpJavascript();
    }

    function dumpDetailView( $grid, $columns, $fields, $level, $indentFactor )
    {
        if( ( $this->_owner->ControlState & csDesigning ) == 0 )
        {
            $this->_DetailGrid->initAsDetail( $this->_DetailField, $grid->DetailValue );

            ob_start();
            $this->_DetailGrid->dumpContents();
            $result = ob_get_clean();

            if( $grid->ShowSelectColumn )
                $prefixCols = $grid->generateComponentSectionCode( 'BlankCell', array() );
            else
                $prefixCols = '';

            for( $i = 0; $i < count( $grid->GroupByFields ); ++$i )
                $prefixCols .= $grid->generateComponentSectionCode( 'DataGroupCol', array() );

            $c = 0;
            foreach( $columns as $column )
            {
                if( $column->getVisible() )
                    ++$c;
            }

            if( $grid->ShowEditColumn )
                ++$c;

            if( $this->_DetailGrid->Height != '' )
                $result = "<div id=\"{$this->_DetailGrid->Name}_outer\" style=\"height: {$this->_DetailGrid->Height}px;\">\r\n$result\r\n</div>";

            $vars = array
            (
                'COLUMNCOUNT'   => $c,
                'INDENT'        => ( $level * $indentFactor ),
                'GRID'          => $result,
                'PREFIXCOLS'    => $prefixCols,
            );

            return $grid->generateComponentSectionCode( 'DetailViewContainer', $vars );
        }
        else
        {
            return '';
        }
    }

    function getDetailField()
    {
        return $this->_DetailField;
    }

    function setDetailField( $value )
    {
        $this->_DetailField = $value;
    }

    function defaultDetailField()
    {
        return '';
    }

    function getDetailGrid()
    {
        return $this->_DetailGrid;
    }

    function setDetailGrid( $value )
    {
        if( !$this->_owner )
            throw new JTPlatinumGridException( "Detail view not initialized." );

        $this->_DetailGrid = JTObjectPropertyFixupAndCheck( $this->_owner, $value, 'JTPlatinumGrid' );
    }

    function defaultDetailGrid()
    {
        return null;
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
        return 0;
    }
}

class JTPlatinumGridPager extends JTPersistent
{
    protected $_CurrentPage = 0;
    protected $_RowsPerPage = 20;
    protected $_ShowBottomPager = true;
    protected $_ShowPageInfo = true;
    protected $_ShowRecordCount = true;
    protected $_ShowTopPager = true;
    protected $_Visible = true;
    protected $_VisiblePageCount = 11;

    function getCurrentPage()
    {
        return $this->_CurrentPage;
    }

    function setCurrentPage( $value )
    {
        $this->_CurrentPage = $value;
    }

    function defaultCurrentPage()
    {
        return 0;
    }

    function getRowsPerPage()
    {
        return $this->_RowsPerPage;
    }

    function setRowsPerPage( $value )
    {
        $this->_RowsPerPage = $value;
    }

    function defaultRowsPerPage()
    {
        return 20;
    }

    function getShowBottomPager()
    {
        return $this->_ShowBottomPager;
    }

    function setShowBottomPager( $value )
    {
        $this->_ShowBottomPager = $value;
    }

    function defaultShowBottomPager()
    {
        return true;
    }

    function getShowPageInfo()
    {
        return $this->_ShowPageInfo;
    }

    function setShowPageInfo( $value )
    {
        $this->_ShowPageInfo = $value;
    }

    function defaultShowPageInfo()
    {
        return true;
    }

    function getShowRecordCount()
    {
        return $this->_ShowRecordCount;
    }

    function setShowRecordCount( $value )
    {
        $this->_ShowRecordCount = $value;
    }

    function defaultShowRecordCount()
    {
        return true;
    }

    function getShowTopPager()
    {
        return $this->_ShowTopPager;
    }

    function setShowTopPager( $value )
    {
        $this->_ShowTopPager = $value;
    }

    function defaultShowTopPager()
    {
        return true;
    }

    function getVisible()
    {
        return $this->_Visible;
    }

    function setVisible( $value )
    {
        $this->_Visible = $value;
    }

    function defaultVisible()
    {
        return true;
    }

    function getVisiblePageCount()
    {
        return $this->_VisiblePageCount;
    }

    function setVisiblePageCount( $value )
    {
        $this->_VisiblePageCount = $value;
    }

    function defaultVisiblePageCount()
    {
        return 11;
    }
}

class JTPlatinumGridRowStyle extends JTPersistent
{
    protected $_Font = null;
    protected $_Color = '';
    protected $_CssCode = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_Font = new JTFont();
        $this->_Font->_control = $aowner;
    }

    function dumpCSS( $grid )
    {
        $result[] = "#{$grid->Name} .{$this->_CssCode} td\r\n{\r\n";

        if( $this->_Color )
            $result[] = "    background: {$this->_Color};\r\n";

        $fontStyles = GetJTFontString( $this->_Font );
        if( $fontStyles )
            $result[] = "    $fontStyles;\r\n";

        $result[] = "}\r\n";

        $result[] = "#{$grid->Name} .{$this->_CssCode} td a\r\n{\r\n";

        if( $fontStyles )
            $result[] = "    $fontStyles;\r\n";

        $result[] = "}\r\n";

        return implode( '', $result );
    }

    function readCssCode()
    {
        return $this->_CssCode;
    }

    function writeCssCode( $value )
    {
        $this->_CssCode = $value;
    }

    function getFont()
    {
        if( ( $this->_owner->ControlState & csDesigning ) == csDesigning )
            return $this->_Font->serializeProperties();

        return $this->_Font;
    }

    function setFont( $value )
    {
        if( ( $this->_owner->ControlState & csDesigning ) == csDesigning || ( $this->_owner->ControlState & csLoading ) == csLoading )
        {
            $this->_Font->unserializeProperties( $value );
        }
        else
        {
            if( is_object( $value ) )
                $this->_Font = $value;
        }
    }

    function defaultFont()
    {
        return null;
    }

    function getColor()
    {
        return $this->_Color;
    }

    function setColor( $value )
    {
        $this->_Color = $value;
    }

    function defaultColor()
    {
        return '';
    }
}

class JTPlatinumGridEvenRowStyle extends JTPlatinumGridRowStyle
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_CssCode = 'EvenRowStyle';
    }
}

class JTPlatinumGridOddRowStyle extends JTPlatinumGridRowStyle
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_CssCode = 'OddRowStyle';
    }
}

class JTPlatinumGridSelectedRowStyle extends JTPlatinumGridRowStyle
{
    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_CssCode = 'SelectedRowStyle';
    }

    function dumpCSS( $grid )
    {
        $result[] = "#{$grid->Name} .inttable tbody tr .selected, #{$grid->Name} .inttable tbody .rowselected td\r\n{\r\n";

        if( $this->_Color )
            $result[] = "    background-color: {$this->_Color};\r\n";

        $fontStyles = GetJTFontString( $this->_Font );
        if( $fontStyles )
            $result[] = "    $fontStyles;\r\n";

        $result[] = "}\r\n";

        return implode( '', $result );
    }
}

class JTPlatinumGridLines extends JTPersistent
{
    protected $_Horizontal = true;
    protected $_Vertical = true;

    function getHorizontal()
    {
        return $this->_Horizontal;
    }

    function setHorizontal( $value )
    {
        $this->_Horizontal = $value;
    }

    function defaultHorizontal()
    {
        return true;
    }

    function getVertical()
    {
        return $this->_Vertical;
    }

    function setVertical( $value )
    {
        $this->_Vertical = $value;
    }

    function defaultVertical()
    {
        return true;
    }
}

class JTPlatinumGridTreeNode
{
    public $firstChild = null;
    public $lastChild = null;
    public $nextSibling = null;
    public $parentNode = null;

    public $data = null;

    function addChild( $node )
    {
        if( $node->parentNode === $this )
            return;

        if( !$this->firstChild )
            $this->firstChild = $node;

        if( $this->lastChild )
            $this->lastChild->nextSibling = $node;

        $this->lastChild = $node;
        $node->parentNode = $this;
    }

    function isParent( $parent )
    {
        $parentNode = $this;

        while( $parentNode )
        {
            if( $parent === $parentNode )
                return true;

            $parentNode = $parentNode->parentNode;
        }

        return false;
    }
}

class JTPlatinumGridRowDataStyle extends JTPersistent
{
    const Equals = '=';
    const GreaterThan = '>';
    const GreaterThanOrEqualTo = '>=';
    const LesserThan = '<';
    const LesserThanOrEqualTo = '<=';
    const NotEqual = '!=';

    protected $_ColumnIndex = -1;
    protected $_DataField = '';
    protected $_Operator = JTPlatinumGridRowDataStyle::Equals;
    protected $_RowStyle = null;
    protected $_Value = '';

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->_RowStyle = new JTPlatinumGridRowStyle( $aowner );
    }

    function valueMatches( $columns, $fields )
    {
        if( $this->_DataField )
        {
            $fieldValue = $fields[ $this->_DataField ];
        }
        else
        {
            if( $this->_ColumnIndex < 0 || $this->_ColumnIndex >= count( $columns ) )
                throw new JTPlatinumGridException( "RowDataStyle column index is out of range, or DataField not specified." );

            $fieldValue = $fields[ $columns[ $this->_ColumnIndex ]->DataField ];
        }

        switch( $this->_Operator )
        {
            case self::Equals:
                $result = ( $fieldValue == $this->_Value );
                break;

            case self::GreaterThan:
                $result = ( $fieldValue > $this->_Value );
                break;

            case self::GreaterThanOrEqualTo:
                $result = ( $fieldValue >= $this->_Value );
                break;

            case self::LesserThan:
                $result = ( $fieldValue < $this->_Value );
                break;

            case self::LesserThanOrEqualTo:
                $result = ( $fieldValue <= $this->_Value );
                break;

            case self::NotEqual:
                $result = ( $fieldValue != $this->_Value );
                break;

            default:
                throw new JTPlatinumGridException( "RowDataStyle->Operator is not valid." );
        }

        return $result;
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

    function getOperator()
    {
        return $this->_Operator;
    }

    function setOperator( $value )
    {
        $this->_Operator = $value;
    }

    function defaultOperator()
    {
        return self::Equals;
    }

    function getRowStyle()
    {
        return $this->_RowStyle;
    }

    function setRowStyle( $value )
    {
        if( is_object( $value ) )
            $this->_RowStyle = $value;
    }

    function defaultRowStyle()
    {
        return null;
    }

    function getValue()
    {
        return $this->_Value;
    }

    function setValue( $value )
    {
        $this->_Value = $value;
    }

    function defaultValue()
    {
        return '';
    }
}

class JTPlatinumGridCellRange
{
    public $StartCol = -1;
    public $StartRow = -1;
    public $EndCol = -1;
    public $EndRow = -1;

    function __construct( $startCol = -1, $startRow = -1, $endCol = -1, $endRow = -1 )
    {
        $this->StartCol = $startCol;
        $this->StartRow = $startRow;
        $this->EndCol = $endCol;
        $this->EndRow = $endRow;
    }
}

class JTPlatinumGridJSONColumn
{
    public $Name;
    public $DataField;
    public $CanEdit;
    public $CanSelect;

    function __construct( $name, $dataField, $canEdit, $canSelect )
    {
        $this->Name = $name;
        $this->DataField = $dataField;
        $this->CanEdit = $canEdit;
        $this->CanSelect = $canSelect;
    }
}

abstract class JTPlatinumGridRenderer extends Object
{
    protected $LastFieldValues = array();

    function dumpGrid( $grid, $ds, $trimmedColumns, $groupByFields, $title )
    {
        if( $ds && $ds->Active )
        {
            $this->dumpColumns( $grid, $ds, $trimmedColumns );

            if( $grid->TotalRecordCount > 0 )
            {
                // $ds->First();

                if( $grid->Pager->Visible )
                {
                    // $startRow = $grid->Pager->CurrentPage * $grid->Pager->RowsPerPage;
                    // if( $startRow )
                    //     moveDataSetBy( $ds, $startRow );

                    $pagerVisible = true;
                    $pagerRows = $grid->Pager->RowsPerPage;
                }
                else
                {
                    $pagerVisible = false;
                    $pagerRows = 0;
                }

                $this->dumpRows( $grid, $ds, $trimmedColumns, $groupByFields, $pagerVisible, $pagerRows );
            }
        }
    }

    protected function dumpColumns( $grid, $ds, $trimmedColumns )
    {
        $i = 0;
        foreach( $trimmedColumns as $c => $column )
        {
            if( $column->Visible )
            {
                $this->dumpColumn( $grid, $ds, $c, $i, $column, $column->Caption );
                ++$i;
            }
        }
    }

    abstract protected function dumpColumn( $grid, $ds, $colIndex, $actualIndex, $column, $value );

    protected function dumpRows( $grid, $ds, $trimmedColumns, $groupByFields, $pagerVisible, $pagerRows )
    {
        $this->LastFieldValues = array();

        $onRowData = $grid->OnRowData;

        for( $i = 0; !$ds->Eof && ( !$pagerVisible || $i < $pagerRows ); $ds->Next(), ++$i )
        {
            $fields = $ds->Fields;

            if( $onRowData )
                $grid->callEvent( 'onrowdata', array( $i, &$fields ) );

            $this->dumpRow( $grid, $ds, $trimmedColumns, $groupByFields, $i, $fields );
        }
    }

    protected function dumpRow( $grid, $ds, $trimmedColumns, $groupByFields, $rowIndex, $fields )
    {
        $result = '';
        $detail = '';
        $groups = '';
        $memo = '';

        if( count( $groupByFields ) > 0 )
        {
            $creatingGroup = false;
            foreach( $groupByFields as $j => $groupColumn )
            {
                list( $groupField, $direction ) = $groupColumn;

                if( $fields[ $groupField ] != $this->LastFieldValues[ $groupField ] )
                    $creatingGroup = true;

                $colIndex = $grid->findColumnByFieldName( $groupField );
                if( $colIndex > -1 )
                    $groupColumnObj = $grid->Columns[ $colIndex ];
                else
                    $groupColumnObj = null;

                if( $creatingGroup )
                    $this->dumpGroupRow( $grid, $ds, $rowIndex, $j, $groupColumnObj, $groupField, $fields );
            }

            $this->LastFieldValues = $fields;
        }

        $curRange = null;
        $colIndex = 0;
        foreach( $trimmedColumns as $i => $column )
        {
            if( !$column->Visible )
                continue;

            $colspan = 1;
            $rowspan = 1;

            if( !$curRange )
            {
                foreach( $grid->MergedCells as $range )
                {
                    if( $i >= $range->StartCol && $i <= $range->EndCol && $rowIndex >= $range->StartRow && $rowIndex <= $range->EndRow )
                    {
                        $curRange = $range;
                        break;
                    }
                }
            }

            if( $curRange )
            {
                if( $curRange->StartCol != $i || $curRange->StartRow != $rowIndex )
                {
                    if( $i == $curRange->EndCol )
                        $curRange = null;

                    continue;
                }
                else
                {
                    $colspan = $range->EndCol - $range->StartCol + 1;
                    $rowspan = $range->EndRow - $range->StartRow + 1;
                }
            }

            $this->dumpCell( $grid, $ds, $rowIndex, $i, $colIndex, $column, $fields, $colspan, $rowspan, (bool)$curRange );
            ++$colIndex;
        }
    }

    abstract protected function dumpGroupRow( $grid, $ds, $rowIndex, $groupColIndex, $groupColumn, $groupField, $fields );
    abstract protected function dumpCell( $grid, $ds, $rowIndex, $colIndex, $actualColIndex, $column, $fields, $colspan, $rowspan, $isMerged );
}

class JTPlatinumGridXLSRenderer extends JTPlatinumGridRenderer
{
    protected $GroupFormat = null;
    protected $HeaderFormat = null;
    protected $FileName = '';
    protected $Workbook = null;
    protected $WorkSheet = null;
    protected $WorkSheetName = 'Sheet1';

    function __construct( $fileName, $worksheetName )
    {
        if( !class_exists( 'Spreadsheet_Excel_Writer' ) )
            throw new JTPlatinumGridException( 'Include the PEAR Spreadsheet_Excel_Writer unit to enable XLS export. (http://pear.php.net/Spreadsheet_Excel_Writer)' );

        $this->FileName = $fileName;
        $this->WorkSheetName = $worksheetName;
    }

    function dumpGrid( $grid, $ds, $trimmedColumns, $groupByFields, $title )
    {
        $this->Workbook = new Spreadsheet_Excel_Writer( $this->FileName );
        $this->Workbook->setVersion( 8 );

        $this->HeaderFormat =& $this->Workbook->addFormat();
        $this->HeaderFormat->setBold();

        $this->GroupFormat =& $this->Workbook->addFormat();
        $this->GroupFormat->setBold();
        $this->GroupFormat->setFgColor( 14 );

        $this->WorkSheet =& $this->Workbook->addWorksheet( $this->WorkSheetName );

        if( $grid->UTF8 )
            $this->WorkSheet->setInputEncoding( 'utf-8' );
        else
            $this->WorkSheet->setInputEncoding( 'iso-8859-1' );

        parent::dumpGrid( $grid, $ds, $trimmedColumns, $groupByFields, $title );

        if( $this->FileName == '' )
            ob_start();

        $this->Workbook->close();

        if( $this->FileName == '' )
            return ob_get_clean();
    }

    protected function dumpColumn( $grid, $ds, $colIndex, $actualIndex, $column, $value )
    {
        $this->WorkSheet->write( 0, $actualIndex, $value, $this->HeaderFormat );
    }

    protected function dumpGroupRow( $grid, $ds, $rowIndex, $groupColIndex, $groupColumn, $groupField, $fields )
    {
        $value = $groupColumn->Caption . ': ' . $fields[ $groupField ];
        $this->WorkSheet->write( $rowIndex + 1, $colIndex, $value, $this->GroupFormat );
    }

    protected function dumpCell( $grid, $ds, $rowIndex, $colIndex, $actualColIndex, $column, $fields, $colspan, $rowspan, $isMerged )
    {
        $value = $column->dumpExportData( $grid, $fields, $rowIndex, $colIndex );

        $this->WorkSheet->writeString( $rowIndex + 1, $actualColIndex, $value );
    }
}

class JTPlatinumGridPDFRenderer extends JTPlatinumGridRenderer
{
    const PageMargin = 10;
    const DataIndent = 5;

    private $_RowCellHeight;

    protected $_FontName = 'vera';

    protected $FileName = '';
    protected $LineHeight;
    protected $DataWidth;
    protected $PDF = null;
    protected $PDFColumns = array();
    protected $TopMargin = JTPlatinumGridPDFRenderer::PageMargin;

    function __construct( $fileName )
    {
        if( !class_exists( 'TCPDF' ) )
            throw new JTPlatinumGridException( 'Include the TCPDF unit to enable PDF export. (http://tcpdf.sf.net)' );

        if( !class_exists( 'JTPlatinumGridCustomTCPDF' ) )
            throw new JTPlatinumGridException( 'Place the TCPDF unit include/require above the include/require for jtplatinumgrid.inc.php.' );

        $this->FileName = $fileName;
    }

    function dumpGrid( $grid, $ds, $trimmedColumns, $groupByFields, $title )
    {
        $this->PDF = new JTPlatinumGridCustomTCPDF();
        $this->PDF->SetFont( $this->FontName, '', 10 );
        $this->LineHeight = ( 10 / $this->PDF->getScaleFactor() ) + 1;
        $this->PDF->SetMargins( JTPlatinumGridPDFRenderer::PageMargin,
            JTPlatinumGridPDFRenderer::PageMargin, JTPlatinumGridPDFRenderer::PageMargin );

        if( strlen( $title ) )
        {
            $this->TopMargin = JTPlatinumGridPDFRenderer::PageMargin + $this->LineHeight;
            $this->PDF->SetTopMargin( $this->TopMargin );
        }

        $this->PDF->SetFooterMargin( JTPlatinumGridPDFRenderer::PageMargin );
        $this->PDF->SetAutoPageBreak( true, JTPlatinumGridPDFRenderer::PageMargin * 2 );

        if( !defined( 'JT_STANDALONE' ) && $grid->owner->Directionality == 'ddRightToLeft' )
            $this->PDF->setRTL( true );

        $this->PDF->SetPagerTemplate( $grid->SiteThemeInstance->retrieveString( 'PageNum' ) );

        // DataWidth is page width, minus margins and data indent.
        $this->DataWidth = $this->PDF->getPageWidth() - ( JTPlatinumGridPDFRenderer::PageMargin * 2 ) - ( JTPlatinumGridPDFRenderer::DataIndent * 2 );

        $this->generatePDFCols( $grid, $trimmedColumns );

        $colData = array();
        foreach( $this->PDFColumns as $i => $colWidth )
            $colData[] = array( $trimmedColumns[ $i ]->Caption, $colWidth );

        $this->PDF->SetColumnData( $colData );
        $this->PDF->SetDataMargin( JTPlatinumGridPDFRenderer::DataIndent );
        $this->PDF->SetTitle( $title );
        $this->PDF->SetUTF8( $grid->UTF8 );
        $this->PDF->AliasNbPages();
        $this->PDF->AddPage();

        parent::dumpGrid( $grid, $ds, $trimmedColumns, $groupByFields, $title );

        if( $this->FileName == '' )
            return $this->PDF->Output( '', 'S' );
        else
            $this->PDF->Output( $this->FileName, 'F' );
    }

    protected function generatePDFCols( $grid, $trimmedColumns )
    {
        foreach( $trimmedColumns as $i => $column )
        {
            if( !$column->Visible )
                continue;

            $w = '';

            if( $column->Width )
            {
                if( preg_match( '/^([0-9\.]+)([a-z%]+)?$/i', $column->Width, $matches ) )
                {
                    switch( $matches[ 2 ] )
                    {
                        case "%":
                            $w = ( $this->DataWidth * $matches[ 1 ] ) / 100;
                            break;

                        case "px":
                        case "":
                            $w = $this->PDF->pixelsToUnits( $matches[ 1 ] );
                            break;
                    }
                }
            }

            $this->PDFColumns[ $i ] = $w;
        }

        $currentWidth = 0;
        $unsizedColCount = 0;
        foreach( $this->PDFColumns as $colWidth )
        {
            if( $colWidth != '' )
                $currentWidth += $colWidth;
            else
                ++$unsizedColCount;
        }

        $remainingWidth = $this->DataWidth - $currentWidth;
        if( $unsizedColCount > 0 )
        {
            if( $remainingWidth > 0 )
                $w = $remainingWidth / $unsizedColCount;

            foreach( $this->PDFColumns as $i => &$colWidth )
            {
                if( $colWidth == '' )
                {
                    if( $remainingWidth > 0 )
                    {
                        $colWidth = $w;
                    }
                    else
                    {
                        $str = $trimmedColumns[ $i ]->Caption;
                        $colWidth = $this->PDF->GetStringWidth( $str );
                    }
                }
            }
        }

        $w = 0;
        foreach( $this->PDFColumns as $colWidth )
            $w += $colWidth;

        $scale = $this->DataWidth / $w;

        foreach( $this->PDFColumns as &$colWidth )
            $colWidth *= $scale;
    }

    protected function dumpColumn( $grid, $ds, $colIndex, $actualIndex, $column, $value )
    {
    }

    protected function dumpRows( $grid, $ds, $trimmedColumns, $groupByFields, $pagerVisible, $pagerRows )
    {
        $this->PDF->SetFillColor( 255 );
        $this->PDF->SetFont( $this->FontName, '', 10 );

        parent::dumpRows( $grid, $ds, $trimmedColumns, $groupByFields, $pagerVisible, $pagerRows );
    }

    protected function dumpGroupRow( $grid, $ds, $rowIndex, $groupColIndex, $groupColumn, $groupField, $fields )
    {
        $this->PDF->SetFillColor( 239 );

        $value = $groupColumn->Caption . ': ' . $fields[ $groupField ];

        if( !$grid->UTF8 )
            $value = utf8_encode( $value );

        $this->PDF->Cell( 0, $this->LineHeight, $value, 0, 0, 'L', 1 );
        $this->PDF->Ln();

        $this->PDF->SetFillColor( 255 );
    }

    protected function dumpRow( $grid, $ds, $trimmedColumns, $groupByFields, $rowIndex, $fields )
    {
        $colIndex = 0;
        $maxLines = 0;
        foreach( $trimmedColumns as $i => $column )
        {
            if( !$column->Visible )
                continue;

            if( !$grid->UTF8 )
                $value = utf8_encode( $fields[ $column->DataField ] );
            else
                $value = $fields[ $column->DataField ];

            $lineCount = $this->PDF->GetNumLines( $value, $this->PDFColumns[ $colIndex ] );
            if( $lineCount > $maxLines )
                $maxLines = $lineCount;

            ++$colIndex;
        }

        $y = $this->PDF->GetY() + ( $maxLines * $this->LineHeight );
        if( $y > ( $this->PDF->getPageHeight() - $this->PDF->getBreakMargin() ) )
            $this->PDF->AddPage();

        $this->_RowCellHeight = 1;
        $this->PDF->Cell( JTPlatinumGridPDFRenderer::DataIndent, $this->LineHeight, '' );

        parent::dumpRow( $grid, $ds, $trimmedColumns, $groupByFields, $rowIndex, $fields );

        $this->PDF->Ln( $this->_RowCellHeight );
    }

    protected function dumpCell( $grid, $ds, $rowIndex, $colIndex, $actualColIndex, $column, $fields, $colspan, $rowspan, $isMerged )
    {
        $value = $column->dumpExportData( $grid, $fields, $rowIndex, $colIndex );

        if( !$grid->UTF8 )
            $value = utf8_encode( $value );

        $w = $this->PDFColumns[ $colIndex ];

        $cells = $this->PDF->MultiCell( $w, $this->LineHeight, $value, 0, 'L', 0, 0 );

        $cellHeight = $this->PDF->getLastH();
        if( $cellHeight > $this->_RowCellHeight )
            $this->_RowCellHeight = $cellHeight;
    }

    function getFontName()
    {
        return $this->_FontName;
    }

    function setFontName( $value )
    {
        $this->_FontName = $value;
    }
}

if( class_exists( 'TCPDF' ) )
{
    class JTPlatinumGridCustomTCPDF extends TCPDF
    {
        protected $_ColumnData;
        protected $_DataMargin;
        protected $_PagerTemplate = "Page %d";
        protected $_Title;
        protected $_UTF8;

        public function Header()
        {
            $lineHeight = ( 14 / $this->getScaleFactor() );

            if( $this->_Title )
            {
                if( !$this->_UTF8 )
                    $title = utf8_encode( $this->_Title );
                else
                    $title = $this->_Title;

                $this->Ln( $lineHeight );
                $this->Cell( 0, $lineHeight, $title, 0, 0, 'C' );
            }

            $this->Ln( $lineHeight );

            $this->SetFillColor( 239 );
            $this->SetFont( '', 'B', 10 );

            $this->Cell( $this->_DataMargin, $lineHeight, '', 0, 0, '', 1 );

            foreach( $this->_ColumnData as $column )
            {
                list( $caption, $width ) = $column;

                if( !$this->_UTF8 )
                    $caption = utf8_encode( $caption );

                $this->Cell( $width, $lineHeight, $caption, 0, 0, '', 1 );
            }

            $this->Cell( 0, $lineHeight, '', 0, 0, 'L', 1 );
            $this->Ln( $lineHeight + 2 );
        }

        public function Footer()
        {
            $this->SetFillColor( 239 );
            $this->SetFont( '', 'B', 10 );

            $lineHeight = ( 14 / $this->getScaleFactor() );

            $this->SetY( -15 );
            $this->Cell( 0, $lineHeight, sprintf( $this->_PagerTemplate, $this->PageNo() ), 0, 0, 'C', 1 );
        }

        public function MultiCell( $w, $h, $txt, $border = 0, $align = 'J', $fill = 0, $ln = 1, $x = '',
            $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0 )
        {
            $scw = $this->GetStringWidth( "Q" ) + ( 2 * $this->cMargin );

            if( $w > $scw )
            {
                return parent::MultiCell( $w, $h, $txt, $border, $align, $fill, $ln, $x, $y, $reseth,
                    $stretch, $ishtml, $autopadding, $maxh );
            }
            else
            {
                $this->Cell( $w, $h, '', $border, $ln, $align, $fill, '', $stretch );
                return null;
            }
        }

        public function SetColumnData( $value )
        {
            $this->_ColumnData = $value;
        }

        public function SetDataMargin( $value )
        {
            $this->_DataMargin = $value;
        }

        public function SetPagerTemplate( $value )
        {
            $this->_PagerTemplate = $value;
        }

        public function SetTitle( $value )
        {
            $this->_Title = $value;
        }

        public function SetUTF8( $value )
        {
            $this->_UTF8 = $value;
        }

        public function pixelsToUnits( $px )
        {
            return $px * 25.4 / 72;
        }
    }
}

class JTPlatinumGridException extends Exception
{
    function __construct( $message )
    {
       parent::__construct( $message );
   }
}

if( !function_exists( 'typesafeequal' ) )
{
    function typesafeequal( $default, $value )
    {
        if( $default === $value )
            return true;

        if( $default == $value )
        {
                if ((is_scalar($default)) && ($default==0) && (((is_string($value)) && ($value=="0")) || ((is_bool($value)) && ($value==false)))) return(true);
                else
                if ((is_scalar($default)) && ($default!=0) && (is_string($value))) return(true);
                else
                if ((is_scalar($default)) && ($default==1) && (is_bool($value)) && ($value==true)) return(true);
                else
                {
                        $temp=$default;
                        $default=$value;
                        $value=$temp;

                        if ((is_scalar($default)) && ($default==0) && (((is_string($value)) && ($value=="0")) || ((is_bool($value)) && ($value==false)))) return(true);
                        else
                        if ((is_scalar($default)) && ($default!=0) && (is_string($value))) return(true);
                        else
                        if ((is_scalar($default)) && ($default==1) && (is_bool($value)) && ($value==true)) return(true);
                }
        }

        return false;
    }
}