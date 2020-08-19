<?php
//-----------------------------------------------------------------------
//                  - JomiTech Components For PHP 1.0 -
//                        -- Grid component --
//
//            Copyright © JomiTech 2007. All Rights Reserved.
//-----------------------------------------------------------------------
require_once("vcl/vcl.inc.php");

use_unit( "components4phpfull/jtsitetheme.inc.php" );

class JTGrid extends JTThemedGraphicControl
{
    protected $_Datasource = null;
    protected $_ShowHeader = true;
    protected $_ReadOnly = 0;
    protected $_Cells;
    protected $_SelectedRow = -1;
    protected $_SelectedCol = -1;
    protected $_Columns;
    protected $_HeaderColor = '';
    protected $_HeaderFont = null;
    protected $_EvenRowColor = '';
    protected $_EvenRowFont = null;
    protected $_OddRowColor = '';
    protected $_OddRowFont = null;
    protected $_SelectedColor = '';
    protected $_SelectedFont = null;
    protected $_CanSelect = true;
    protected $_RowSelect = 0;
    protected $_ColumnClick = true;
    protected $_ShouldScroll = true;
    protected $_ShouldHorzScroll = 0;
    protected $_RowDataStyles = array();

    protected $_jsOnSelectCell = null;
    protected $_jsOnCellEdited = null;
    protected $_jsOnCellDoubleClick = null;
    protected $_jsOnHeaderClick = null;
    protected $_jsOnLoad = null;

    protected $_oncelldata;

    private $HasDumpedOnResize = 0;

    function __construct( $aowner = null )
    {
        parent::__construct( $aowner );

        $this->Width = 450;
        $this->Height = 300;
        $this->_Cells = array();
        $this->_Columns = array();

        $this->_HeaderFont = new JTGridHeaderFont();
        $this->_HeaderFont->_control = $this;

        $this->_EvenRowFont = new JTGridEvenRowFont();
        $this->_EvenRowFont->_control = $this;

        $this->_OddRowFont = new JTGridOddRowFont();
        $this->_OddRowFont->_control = $this;

        $this->_SelectedFont = new JTGridSelectedRowFont();
        $this->_SelectedFont->_control = $this;
    }

    function loaded()
    {
        parent::loaded();

        $this->setDatasource( $this->Datasource );

        $sr = $this->input->{$this->Name . '_sr'};
        if( is_object( $sr ) )
        {
            $sr = $sr->asString();
            if( is_numeric( $sr ) )
                $this->SelectedRow = (int)$sr;
        }

        $sc = $this->input->{$this->Name . '_sc'};
        if( is_object( $sc ) )
        {
            $sc = $sc->asString();
            if( is_numeric( $sc ) )
                $this->SelectedCol = (int)$sc;
        }
    }

    function dumpHeaderCode()
    {
        parent::dumpHeaderCode();

        $this->resolveSiteThemeInstance();

        if( $this->SiteThemeInstance )
        {
            if( ( $this->ControlState & csDesigning ) == csDesigning )
                $this->SiteThemeInstance->dumpHeaderCode();

            print( $this->SiteThemeInstance->generateComponentCSSCode( 'grid' ) );
        }
    }

    function dumpJavascript()
    {
        parent::dumpJavascript();

        if( $this->_jsOnSelectCell && !defined( 'gridevent' . $this->_jsOnSelectCell ) )
        {
            define( 'gridevent' . $this->_jsOnSelectCell, 1 );

            $event = $this->_jsOnSelectCell;

            print( "function $event( event, Sender, Row, Col )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnCellDoubleClick && !defined( 'gridevent' . $this->_jsOnCellDoubleClick ) )
        {
            define( 'gridevent' . $this->_jsOnCellDoubleClick, 1 );

            $event = $this->_jsOnCellDoubleClick;

            print( "function $event( Sender, Row, Col )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnCellEdited && !defined( 'gridevent' . $this->_jsOnCellEdited ) )
        {
            define( 'gridevent' . $this->_jsOnCellEdited, 1 );

            $event = $this->_jsOnCellEdited;

            print( "function $event( Sender, Row, Col, OldText, NewText )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        print( "function " . $this->Name . "DoubleClickCellHandler( GridID, Row, Col )\r\n" );
        print( "{\r\n" );
        print( "  var GridObject = document.getElementById( GridID );\r\n" );
        print( "\r\n" );

        if( $this->_jsOnCellDoubleClick )
        {
            print( "  if( " . $this->_jsOnCellDoubleClick . "( GridObject, Row, Col ) == false )\r\n" );
            print( "    return;\r\n" );
        }

        if( $this->_CanSelect && !$this->_ReadOnly )
            print( "  JTGridDoCellDoubleClick( GridID, GridObject, Row, Col );\r\n" );

        print( "}\r\n\r\n" );

        if( $this->_jsOnHeaderClick && !defined( 'gridevent' . $this->_jsOnHeaderClick ) )
        {
            define( 'gridevent' . $this->_jsOnHeaderClick, 1 );

            $event = $this->_jsOnHeaderClick;

            print( "function $event( Sender, Col )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }

        if( $this->_jsOnLoad && !defined( 'gridevent' . $this->_jsOnLoad ) )
        {
            define( 'gridevent' . $this->_jsOnLoad, 1 );

            $event = $this->_jsOnLoad;

            print( "function $event( Sender )\r\n" );
            print( "{\r\n" );

            if( $this->owner )
                $this->owner->$event( $this, array() );

            print( "\r\n}\r\n\r\n" );
        }
    }

    protected function dumpThemedContents()
    {
        print( "<div id=\"" . $this->Name . "_outerdiv\" style=\"width: 100%; height: 100%;\">\r\n" );

        $this->internalDumpThemedContents();

        print( "</div>\r\n" );
    }

    protected function internalDumpThemedContents()
    {
        if( $this->_Datasource && count( $this->_Columns ) == 0 )
        {
            $fields = array();

            if( ( $this->ControlState & csDesigning ) != csDesigning &&
                $this->_Datasource->DataSet &&
                $this->_Datasource->DataSet->Active &&
                $this->_Datasource->DataSet->Fields )
            {
                $this->_Datasource->DataSet->First();

                foreach( $this->_Datasource->DataSet->Fields as $field => $value )
                {
                    $fields[] = array( $field, $field, '', '', '%s' );
                }
            }
        }
        else
        {
            $fields = $this->_Columns;
        }

        if( $this->_color )
            $color = ' background-color: ' . $this->_color . ';';
        else
            $color = '';

        $header = $this->GenerateHeader( $fields );
        $headerRow = $this->GenerateHeader( $fields, 'table_' );

        if( $this->_EvenRowColor )
            $evenrow_style = " style=\"background-color: " . $this->_EvenRowColor . ";\"";
        else
            $evenrow_style = '';

        $evencell_style = GetJTFontString( $this->_EvenRowFont );

        if( $this->_OddRowColor )
            $oddrow_style = " style=\"background-color: " . $this->_OddRowColor . ";\"";
        else
            $oddrow_style = '';

        $oddcell_style = GetJTFontString( $this->_OddRowFont );

        if( $this->_SelectedColor )
        {
            $selectedrow_style = "background-color: " . $this->_SelectedColor . ";";
            $selectedcell_style = $selectedrow_style . ' ';
        }
        else
        {
            $selectedrow_style = '';
            $selectedcell_style = '';
        }

        $selectedcell_style = GetJTFontString( $this->_SelectedFont );

        $row_data = '';
        $rowCount = 0;

        if( $this->_Datasource )
        {
            if( ( $this->ControlState & csDesigning ) != csDesigning &&
                $this->_Datasource->DataSet &&
                $this->_Datasource->DataSet->Active &&
                $this->_Datasource->DataSet->Fields )
            {
                $i = 0;

                for( $this->_Datasource->DataSet->First(); !$this->_Datasource->DataSet->EOF; $this->_Datasource->DataSet->Next(), ++$i )
                    $row_data .= $this->GenerateRow( $fields, $i, true, $evenrow_style, $evencell_style, $oddrow_style, $oddcell_style, $selectedrow_style, $selectedcell_style );

                $rowCount = $i;
            }
        }
        else
        {
            $i = 0;

            foreach( $this->_Cells as $i => $row )
                $row_data .= $this->GenerateRow( $fields, $i, false, $evenrow_style, $evencell_style, $oddrow_style, $oddcell_style, $selectedrow_style, $selectedcell_style );

            $rowCount = $i;
        }

        if( $this->_SelectedRow >= $rowCount )
            $this->_SelectedRow = -1;

        if( $this->_SelectedCol >= count( $fields ) )
            $this->_SelectedCol = -1;

        $tw = 0;

        foreach( $fields as $column )
        {
            $width = $column[ 2 ];

            if( strlen( $width ) )
                $tw += $width;
        }

        $themepart = ( $this->_ShouldScroll ) ? 'grid_scrolling' : 'grid_no_scroll';

        $tabindex = ( $this->_TabStop ) ? $this->_TabOrder : -1;

        $vars = array(
            'COLOR'         => $color,
            'HEADER'        => $header,
            'HEADERROW'     => $headerRow,
            'ROWDATA'       => $row_data,
            'INPUTFIELD'    => ( $this->_ReadOnly ) ? '' : "<input type=\"text\" name=\"" . $this->Name . "Input\" id=\"" . $this->Name . "Input\" class=\"jtgridinput\" onblur=\"JTGridDoInputBlur('" . $this->Name . "')\">\r\n",
            'SHOWHEADER'    => ( $this->_ShowHeader ? 'block' : 'none' ),
            'STYLES'        => ( false && $this->_ShouldHorzScroll ) ? ( 'width: ' . $tw . 'px;' ) : ( ' width: 100%;' ),
            'TABINDEX'      => $tabindex,
        );

        print( $this->generateComponentSectionCode( $themepart, $vars ) );
    }

    protected function GenerateHeader( $fields, $partPrefix = '' )
    {
        $result = '';

        if( count( $fields ) > 0 && $this->_ShowHeader )
        {
            $row_contents = '';

            $cellstyle = GetJTFontString( $this->_HeaderFont );

            if( $this->_HeaderColor )
                $cellstyle .= 'background-color: ' . $this->_HeaderColor . ';';

            if( $this->_ColumnClick )
                $cellstyle .= ' cursor: pointer;';
            else
                $cellstyle .= ' cursor: default;';

            foreach( $fields as $i => $column )
            {
                list( $caption, $datafield, $width, $alignment, $format ) = $column;

                if( strlen( $alignment ) )
                    $attrs = ' align="' . $alignment . '"';
                else
                    $attrs = '';

                if( strlen( $width ) )
                    $attrs .= ' width="' . $width . '"';

                $style = '';

                if( strlen( $width ) || $cellstyle )
                {
                    if( strlen( $width ) )
                        $style .= 'width: ' . $width . 'px; ';

                    $style .= $cellstyle;
                }

                if( $this->_jsOnHeaderClick && $this->_ColumnClick )
                    $onclick = 'JTGridHeaderClickHandler( ' . "'" . $this->Name . "', $i )";
                else
                    $onclick = '';

                if( $i == 0 )
                    $classext = 'jtgrid_header_first';
                else if( $i == ( count( $fields ) - 1 ) )
                    $classext = 'jtgrid_header_last';
                else
                    $classext = '';

                $vars = array(
                    'COLNAME'   => $this->Name . '_hdr_' . $i,
                    'ATTRS'     => $attrs,
                    'STYLE'     => $style,
                    'CAPTION'   => $caption,
                    'ONCLICK'   => $onclick,
                    'CLASSEXT'  => $classext,
                    'CELLWIDTH' => $width,
                );

                $row_contents .= $this->generateComponentSectionCode( $partPrefix . 'header_col', $vars );
            }

            if( $this->_HeaderColor )
                $style = 'background-color: ' . $this->_HeaderColor . ';';
            else
                $style = '';

            $vars = array(
                'STYLE'     => $style,
                'CONTENT'   => $row_contents,
            );

            $result = $this->generateComponentSectionCode( $partPrefix . 'header_row', $vars );
        }

        return $result;
    }

    protected function GenerateRow( $fields, $i, $use_database, $evenrow_style, $evencell_style, $oddrow_style, $oddcell_style, $selectedrow_style, $selectedcell_style )
    {
        $result = '';
        $evenrow = !( $i % 2 );
        $row_font = '';

        /* if( $i == $this->_SelectedRow && $this->_CanSelect && $this->_RowSelect )
        {
            $rowclass = '_selected';
            $rowstyle = $selectedrow_style;
        }
        else */ if( $evenrow )
        {
            $rowclass = '_even';
            $rowstyle = $evenrow_style;
        }
        else
        {
            $rowclass = '_odd';
            $rowstyle = $oddrow_style;
        }

        // if( $i != $this->_SelectedRow || !$this->_CanSelect || !$this->_RowSelect )
        {
            foreach( $this->_RowDataStyles as $item )
            {
                list( $column, $expression, $value, $backcolor, $fontstyle ) = $item;

                if( $use_database )
                {
                    $col_value = $data = $this->_Datasource->DataSet->AssociativeFieldValues[ $column ];
                }
                else
                {
                    $col_value = '';

                    if( count( $this->_Cells ) > $i )
                    {
                        $row = $this->_Cells[ $i ];

                        if( count( $row ) > $j )
                            $col_value = $row[ $column ];
                    }
                }

                switch( $expression )
                {
                    case '=':
                    case '==':
                        $comp = ( $col_value == $value );
                        break;

                    case '<>':
                    case '!=':
                        $comp = ( $col_value != $value );
                        break;

                    case '<':
                        $comp = ( $col_value < $value );
                        break;

                    case '>':
                        $comp = ( $col_value > $value );
                        break;

                    case '>=':
                        $comp = ( $col_value >= $value );
                        break;

                    case '<=':
                        $comp = ( $col_value <= $value );
                        break;

                    default:
                        $comp = false;
                }

                if( $comp )
                {
                    if( !empty( $backcolor ) )
                        $rowstyle = ' style="background-color: ' . $backcolor . ';"';

                    if( !empty( $fontstyle ) )
                        $row_font = $fontstyle;

                    break;
                }
            }
        }

        $result .= '      <tr id="' . $this->Name . '_row_' . $i . '" class="jtbb jtgrid_row' . $rowclass . '"' . $rowstyle . ">\r\n";

        foreach( $fields as $j => $column )
        {
            list( $caption, $datafield, $width, $alignment, $format, $type, $params ) = $column;

            if( strlen( $alignment ) )
                $attrs = ' align="' . $alignment . '"';
            else
                $attrs = '';

            if( strlen( $width ) )
                $attrs .= ' width="' . $width . '"';

            /* if( $i == $this->_SelectedRow && $this->_CanSelect && ( $j == $this->_SelectedCol || $this->_RowSelect ) )
            {
                $cellclass = '_selected';
                $cellstyle = $selectedcell_style;
            }
            else
            */
            {
                if( $row_font )
                    $cellstyle = $row_font;
                else if( $evenrow )
                    $cellstyle = $evencell_style;
                else
                    $cellstyle = $oddcell_style;

                if( $evenrow )
                    $cellclass = '_even';
                else
                    $cellclass = '_odd';
            }

            $attrs .= ' style="';

            if( strlen( $width ) )
                $attrs .= 'width: ' . $width . 'px; ';

            $attrs .= $cellstyle;

            if( $this->_CanSelect )
                $attrs .= 'cursor: pointer;';
            else
                $attrs .= 'cursor: default;';

            $attrs .= '"';

            if( $use_database && $datafield )
            {
                $data = $this->_Datasource->DataSet->AssociativeFieldValues[ $datafield ];
            }
            else
            {
                $data = '';

                if( count( $this->_Cells ) > $i )
                {
                    $row = $this->_Cells[ $i ];

                    if( count( $row ) > $j )
                        $data = $row[ $j ];
                }
            }

            if( strlen( $format ) )
            {
                if( strpos( $format, '%' ) !== false )
                {
                    $data = sprintf( $format, $data );
                }
                else
                {
                    if( method_exists( $this->owner, $format ) )
                        $data = call_user_func( array( $this->owner, $format ), $data );
                    else
                        $data = call_user_func( $format, $data );
                }
            }

            if( $this->_oncelldata )
            {
                $data = $this->callEvent( 'oncelldata', array($i, $j, $data ) );
            }

            if( $this->_CanSelect )
                $events = " onclick=\"JTGridSelectCellHandler( event, '" . $this->Name . "', $i, $j )\"";
            else
                $events = '';

            if( $this->_jsOnCellDoubleClick || $this->_jsOnCellEdited )
                $events .= ' ondblclick="' . $this->Name . "DoubleClickCellHandler( '" . $this->Name . "', $i, $j )\"";

            $cellID = $this->Name . '_cell_' . $i . '_' . $j;
            $cellDataViewID = $cellID . '_dataview';
            $cellDataViewValueID = $cellID . '_value';

            if( ( $type == 'combobox' || $type == 'lookupcombobox' ) && !$this->_ReadOnly && $this->_jsOnCellEdited )
            {
                $dataview = '<select id="' . $cellDataViewID . '" name="' . $cellDataViewID . '" size="1" onchange="JTGridOnSelectChange(event)">';

                if( $type == 'combobox' )
                {
                    foreach( $params as $possibleValue )
                    {
                        $state = ( $possibleValue == $data ) ? ' selected' : '';

                        $dataview .= "<option$state>" . htmlspecialchars( $possibleValue ) . "</option>";
                    }
                }
                else
                {
                    list( $dataSourceName, $dataField ) = $params;

                    if( $this->Owner && $this->Owner->$dataSourceName && $this->Owner->$dataSourceName->DataSet && $this->Owner->$dataSourceName->DataSet->Active )
                    {
                        $dataSource = $this->Owner->$dataSourceName->DataSet;

                        for( $dataSource->First(); !$dataSource->EOF; $dataSource->Next() )
                        {
                            $value = htmlspecialchars( $dataSource->AssociativeFieldValues[ $dataField ] );
                            $state = ( $value == $data ) ? ' selected' : '';

                            $dataview .= "<option$state>$value</option>";
                        }
                    }
                }

                $dataview .= '</select>';
                $dataViewValue = '<input id="' . $cellDataViewValueID . '" name="' . $cellDataViewValueID . '" type="hidden" value="' . htmlspecialchars( $data ) . '" />';
                $dataViewClass = 'combo';
            }
            else if( $type == 'checkbox' )
            {
                $value = ( $data ) ? '1' : '0';
                $state = ( $data ) ? ' checked' : '';
                if( $this->_ReadOnly || !$this->_jsOnCellEdited )
                    $state .= ' disabled';

                $dataview = '<input id="' . $cellDataViewID . '" name="' . $cellDataViewID . '" type="checkbox"' . $state . ' value="1" onclick="JTGridOnCheckChange(event)" />';
                $dataViewValue = '<input id="' . $cellDataViewValueID . '" name="' . $cellDataViewValueID . '" type="hidden" value="' . $value . '" />';
                $dataViewClass = 'checkbox';
            }
            else
            {
                if( $this->_oncelldata || strpos( $format, '%' ) === false )
                    $dataview = $data;
                else
                    $dataview = htmlspecialchars( $data );

                $dataViewClass = 'text';
                $dataViewValue = '';
            }

            if( strlen( $dataview ) == 0 )
                $dataview = '&nbsp;';

            $result .= '        <td id="' . $cellID . '" class="jtbb jtgrid_data_cell jtgrid_cell' . $cellclass . ' jtgrid_cell_col' . $j . ' jtgrid_cell_dataview_' . $dataViewClass . '"' . $attrs . $events . ">$dataview$dataViewValue</td>\r\n";
        }

        $result .= "      </tr>\r\n";

        return $result;
    }

    protected function dumpControlFooter()
    {
        // if( ( $this->ControlState & csDesigning ) != csDesigning )
        {
            print( "<script language=\"JavaScript\" type=\"text/javascript\">\r\n" );

            $this->dumpBodyJavaScript();

            // print( "// -->\r\n" );
            print( "</script>\r\n" );
        }
    }

    protected function dumpBodyJavaScript()
    {
        print( "var " . $this->Name . " = document.getElementById( '" . $this->Name . "' );\r\n" );
        print( $this->Name . ".SelectedRow = " . $this->_SelectedRow . ";\r\n" );
        print( $this->Name . ".SelectedCol = " . $this->_SelectedCol . ";\r\n" );
        print( $this->Name . ".SelectedColor = '" . $this->_SelectedColor . "';\r\n" );
        print( $this->Name . ".SelectedFont = " . GetJTJSFontString( $this->_SelectedFont ) . ";\r\n" );
        print( $this->Name . ".EvenColor = '" . $this->_EvenRowColor . "';\r\n" );
        print( $this->Name . ".EvenFont = " . GetJTJSFontString( $this->_EvenRowFont ) . ";\r\n" );
        print( $this->Name . ".OddColor = '" . $this->_OddRowColor . "';\r\n" );
        print( $this->Name . ".OddFont = " . GetJTJSFontString( $this->_OddRowFont ) . ";\r\n" );
        print( $this->Name . ".RowSelect = " . GetJTJSBoolean( $this->_RowSelect ) . ";\r\n" );
        print( $this->Name . ".ShouldScroll = " . GetJTJSBoolean( $this->_ShouldScroll ) . ";\r\n" );
        print( $this->Name . ".ShouldHorzScroll = " . GetJTJSBoolean( $this->_ShouldHorzScroll ) . ";\r\n" );
        print( $this->Name . ".OnCellEdited = " . GetJTJSEventToString( $this->_jsOnCellEdited ) . ";\r\n" );
        print( $this->Name . ".OnSelectCell = " . GetJTJSEventToString( $this->_jsOnSelectCell ) . ";\r\n" );
        print( $this->Name . ".OnHeaderClick = " .  GetJTJSEventToString( $this->_jsOnHeaderClick ) . ";\r\n" );
        print( "JTGridInitialize( '" . $this->Name . "' );\r\n" );

        if( $this->_SelectedRow > -1 && ( $this->_RowSelect || $this->_SelectedCol > -1 ) )
            echo( 'JTGridSetGridSelectionState( "' . $this->Name . '", ' . $this->Name . ', ' . $this->_SelectedRow . ', ' . $this->_SelectedCol . ", true );\r\n" );

        print( "JTUpdateAnchors();\r\n" );

        if( $this->_jsOnLoad )
            print( $this->_jsOnLoad . "( " . $this->Name . " );\r\n" );
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

            print( "document.getElementById( '" . $this->Name . "_outerdiv' ).innerHTML = \"$contents\";\r\n" );
        }

        $this->dumpBodyJavaScript();
    }

    function getDatasource()
    {
        return $this->_Datasource;
    }

    function setDatasource( $value )
    {
        $this->_Datasource = $this->fixupPropertyAndCheck( $value, 'Datasource' );
    }

    function getShowHeader()
    {
        return $this->_ShowHeader;
    }

    function setShowHeader( $value )
    {
        $this->_ShowHeader = $value;
    }

    function defaultShowHeader()
    {
        return true;
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

    function readCells()
    {
        return $this->_Cells;
    }

    function writeCells( $value )
    {
        $this->_Cells = $value;
    }

    function readSelectedRow()
    {
        return $this->_SelectedRow;
    }

    function writeSelectedRow( $value )
    {
        $this->_SelectedRow = $value;
    }

    function defaultSelectedRow()
    {
        return -1;
    }

    function readSelectedCol()
    {
        return $this->_SelectedCol;
    }

    function writeSelectedCol( $value )
    {
        $this->_SelectedCol = $value;
    }

    function defaultSelectedCol()
    {
        return -1;
    }

    function getColumns()
    {
        return $this->_Columns;
    }

    function setColumns( $value )
    {
        if( !is_array( $value ) )
            $value = unserialize( $value );

        foreach( $value as &$v )
        {
            if( !is_array( $v ) )
                $v = unserialize( $v );
        }

        $this->_Columns = $value;
    }

    function getColor()
    {
        return $this->readColor();
    }

    function setColor( $value )
    {
        $this->writeColor( $value );
    }

    function getHeaderColor()
    {
        return $this->_HeaderColor;
    }

    function setHeaderColor( $value )
    {
        $this->_HeaderColor = $value;
    }

    function defaultHeaderColor()
    {
        return '';
    }

    function getHeaderFont()
    {
        return $this->_HeaderFont;
    }

    function setHeaderFont( $value )
    {
        if( is_object( $value ) )
            $this->_HeaderFont = $value;
    }

    function getEvenRowColor()
    {
        return $this->_EvenRowColor;
    }

    function setEvenRowColor( $value )
    {
        $this->_EvenRowColor = $value;
    }

    function defaultEvenRowColor()
    {
        return '';
    }

    function getEvenRowFont()
    {
        return $this->_EvenRowFont;
    }

    function setEvenRowFont( $value )
    {
        if( is_object( $value ) )
            $this->_EvenRowFont = $value;
    }

    function getOddRowColor()
    {
        return $this->_OddRowColor;
    }

    function setOddRowColor( $value )
    {
        $this->_OddRowColor = $value;
    }

    function defaultOddRowColor()
    {
        return '';
    }

    function getOddRowFont()
    {
        return $this->_OddRowFont;
    }

    function setOddRowFont( $value )
    {
        if( is_object( $value ) )
            $this->_OddRowFont = $value;
    }

    function getSelectedColor()
    {
        return $this->_SelectedColor;
    }

    function setSelectedColor( $value )
    {
        $this->_SelectedColor = $value;
    }

    function defaultSelectedColor()
    {
        return '';
    }

    function getSelectedFont()
    {
        return $this->_SelectedFont;
    }

    function setSelectedFont( $value )
    {
        if( is_object( $value ) )
            $this->_SelectedFont = $value;
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

    function getColumnClick()
    {
        return $this->_ColumnClick;
    }

    function setColumnClick( $value )
    {
        $this->_ColumnClick = $value;
    }

    function defaultColumnClick()
    {
        return true;
    }

    function getShouldScroll()
    {
        return $this->_ShouldScroll;
    }

    function setShouldScroll( $value )
    {
        $this->_ShouldScroll = $value;
    }

    function defaultShouldScroll()
    {
        return true;
    }

    function getShouldHorzScroll()
    {
        return $this->_ShouldHorzScroll;
    }

    function setShouldHorzScroll( $value )
    {
        $this->_ShouldHorzScroll = $value;
    }

    function defaultShouldHorzScroll()
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

    function readRowDataStyles()
    {
        return $this->_RowDataStyles;
    }

    function writeRowDataStyles( $value )
    {
        $this->_RowDataStyles = $value;
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

    function getParentColor()
    {
        return $this->readParentColor();
    }

    function setParentColor( $value )
    {
        $this->writeParentColor( $value );
    }

    function getjsOnSelectCell()
    {
        return $this->_jsOnSelectCell;
    }

    function setjsOnSelectCell( $value )
    {
        $this->_jsOnSelectCell = $value;
    }

    function defaultjsOnSelectCell()
    {
        return null;
    }

    function getjsOnCellEdited()
    {
        return $this->_jsOnCellEdited;
    }

    function setjsOnCellEdited( $value )
    {
        $this->_jsOnCellEdited = $value;
    }

    function defaultjsOnCellEdited()
    {
        return null;
    }

    function getjsOnCellDoubleClick()
    {
        return $this->_jsOnCellDoubleClick;
    }

    function setjsOnCellDoubleClick( $value )
    {
        $this->_jsOnCellDoubleClick = $value;
    }

    function defaultjsOnCellDoubleClick()
    {
        return null;
    }

    function getjsOnHeaderClick()
    {
        return $this->_jsOnHeaderClick;
    }

    function setjsOnHeaderClick( $value )
    {
        $this->_jsOnHeaderClick = $value;
    }

    function defaultjsOnHeaderClick()
    {
        return null;
    }

    function getjsOnLoad()
    {
        return $this->_jsOnLoad;
    }

    function setjsOnLoad( $value )
    {
        $this->_jsOnLoad = $value;
    }

    function defaultjsOnLoad()
    {
        return null;
    }

    function getOnCellData()
    {
        return $this->_oncelldata;
    }

    function setOnCellData( $value )
    {
        $this->_oncelldata = $value;
    }

    function defaultOnCellData()
    {
        return null;
    }
}

class JTGridHeaderFont extends JTFont
{
}

class JTGridEvenRowFont extends JTFont
{
}

class JTGridOddRowFont extends JTFont
{
}

class JTGridSelectedRowFont extends JTFont
{
}
?>
