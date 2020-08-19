/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/

function JTGridDoSelectCell( GridID, GridObject, Row, Col )
{
    JTGridSetGridSelectionState( GridID, GridObject, GridObject.SelectedRow, GridObject.SelectedCol, false );
    JTGridSetGridSelectionState( GridID, GridObject, Row, Col, true );

    GridObject.SelectedRow = Row;
    GridObject.SelectedCol = Col;

    JTGridScrollCellIntoView( GridID, GridObject, Row, Col );
}

function JTGridScrollCellIntoView( GridID, GridObject, Row, Col )
{
    var dataDiv = document.getElementById( GridID + "_data" );
    var headerDiv = document.getElementById( GridID + "_headerdiv" );
    var selectedCell = document.getElementById( GridID + "_cell_" + Row + "_" + Col );

    //if( GridObject.ShouldScroll )
    {
        if( ( dataDiv.scrollTop + headerDiv.offsetHeight ) > selectedCell.offsetTop )
            dataDiv.scrollTop = selectedCell.offsetTop - headerDiv.offsetHeight;
        else if( ( dataDiv.scrollTop + dataDiv.clientHeight ) < ( selectedCell.offsetTop + selectedCell.offsetHeight ) )
            dataDiv.scrollTop = selectedCell.offsetTop - ( dataDiv.clientHeight - selectedCell.offsetHeight - 1 );
    }
    //if( GridObject.ShouldHorzScroll )
    {
        if( dataDiv.scrollLeft > selectedCell.offsetLeft )
        {
            dataDiv.scrollLeft = selectedCell.offsetLeft - 1;
        }
        else if( ( dataDiv.scrollLeft + dataDiv.offsetWidth ) < ( selectedCell.offsetLeft + selectedCell.offsetWidth ) )
        {
            if( dataDiv.offsetWidth <= selectedCell.offsetWidth )
                dataDiv.scrollLeft = selectedCell.offsetLeft;
            else
                dataDiv.scrollLeft = ( selectedCell.offsetLeft + selectedCell.offsetWidth ) - dataDiv.clientWidth;
        }
    }
}

function JTGridSetGridSelectionState( GridID, GridObject, Row, Col, Selected )
{
    if( GridObject.RowSelect )
    {
        if( Row < 0 )
            return;

        var RowObject = document.getElementById( GridID + "_row_" + Row );
        var RowCells = RowObject.getElementsByTagName( "TD" );
        var RowClass;
        var RowColor;
        var i;

        if( Selected )
        {
            RowObject.lastBackColor = RowObject.style.backgroundColor;
            RowObject.lastClassName = RowObject.className;

            RowClass = "jtgrid_row_selected";
            RowColor = GridObject.SelectedColor;
        }
        else
        {
            RowClass = RowObject.lastClassName;
            RowColor = RowObject.lastBackColor;
        }

        RowObject.className = RowClass;
        RowObject.style.backgroundColor = RowColor;

        for( i = 0; i < RowCells.length; ++i )
        {
            JTGridSetGridCellSelectionState( GridID, GridObject, RowCells[ i ], Row, Col, Selected );
        }
    }
    else
    {
        if( Row < 0 || Col < 0 )
            return;

        JTGridSetGridCellSelectionState( GridID, GridObject, document.getElementById( GridID + "_cell_" + Row + "_" + Col ), Row, Col, Selected );
    }

    if( Selected )
    {
        document.getElementById( GridID + "_sr" ).value = Row;
        document.getElementById( GridID + "_sc" ).value = Col;
    }
}

function JTGridSetGridCellSelectionState( GridID, GridObject, CellObject, Row, Col, Selected )
{
    if( Selected )
    {
        CellObject.lastClassName = CellObject.className
        CellObject.lastStyle = CellObject.style.cssText;

        CellClass = "jtgrid_data_cell jtgrid_cell_selected";
        CellColor = GridObject.SelectedColor;
        CellFont = GridObject.SelectedFont;

        CellObject.style.backgroundColor = CellColor;
        CellFont.applyToObjectStyle( CellObject );
    }
    else
    {
        CellClass = CellObject.lastClassName;

        CellObject.style.cssText = CellObject.lastStyle;
    }

    CellObject.className = CellClass;
}

function JTGridDoCellDoubleClick( GridID, GridObject, Row, Col )
{
    JTGridDoSelectCell( GridID, GridObject, Row, Col );

    if( document.getElementById( GridID + "_cell_" + Row + "_" + Col + "_dataview" ) )
        return;

    var gridInput = document.getElementById( GridID + "Input" );
    var gridCell = document.getElementById( GridID + "_cell_" + Row + "_" + Col );
    var gridData = document.getElementById( GridID + "_data" );
    var gridRows = document.getElementById( GridID + "_data" );

    gridInput.value = JTGridGetCellText( GridID, Row, Col );
    gridInput.style.fontFamily = gridCell.style.fontFamily;
    gridInput.style.fontSize = gridCell.style.fontSize;
    gridInput.style.left = gridCell.offsetLeft - gridData.scrollLeft + gridData.offsetLeft + gridRows.offsetLeft + "px";
    gridInput.style.top = gridCell.offsetTop - gridData.scrollTop + gridData.offsetTop + gridRows.offsetTop + "px";
    gridInput.style.width = gridCell.offsetWidth + "px";
    gridInput.style.display = "block";
    gridInput.focus();
}

function JTGridDoInputBlur( GridID )
{
    var GridObject = document.getElementById( GridID );
    var gridInput = document.getElementById( GridID + "Input" );
    var oldText = JTGridGetCellText( GridID, GridObject.SelectedRow, GridObject.SelectedCol );

    gridInput.style.display = "none";
}

function JTGridDoInputKeyUp( e )
{
    var event = e || window.event;
    var kc = event.charCode || event.keyCode;

    if( kc != 13 && kc != 10 )
        return true;

    var gridInput = getEventTarget( event );
    var GridID = gridInput.id.substr( 0, gridInput.id.length - 5 );
    var GridObject = document.getElementById( GridID );
    var oldText = JTGridGetCellText( GridID, GridObject.SelectedRow, GridObject.SelectedCol );

    gridInput.style.display = "none";

    if( gridInput.value != oldText )
    {
        if( GridObject.OnCellEdited && GridObject.OnCellEdited( GridObject, GridObject.SelectedRow, GridObject.SelectedCol, oldText, gridInput.value ) == false )
            return false;

        JTGridSetCellText( GridID, GridObject.SelectedRow, GridObject.SelectedCol, gridInput.value );
    }

    return false;
}

function JTGridOnSelectChange( e )
{
    var event = e || window.event;
    var dataView = getEventTarget( event );
    var dataValue = document.getElementById( dataView.id.substr( 0, dataView.id.length - 9 ) + "_value" );
    var GridID = dataView.id.split( "_" )[ 0 ];
    var GridObject = document.getElementById( GridID );
    var newValue = dataView.options[ dataView.selectedIndex ].text;
    var oldValue = dataValue.value;

    if( newValue != oldValue )
    {
        if( GridObject.OnCellEdited && GridObject.OnCellEdited( GridObject, GridObject.SelectedRow, GridObject.SelectedCol, oldValue, newValue ) == false )
        {
            for( var i = 0; i < dataView.options.length; ++i )
            {
                if( dataView.options[ i ].text == oldValue )
                {
                    dataView.selectedIndex = i;
                    break;
                }
            }
        }
        else
        {
            dataValue.value = newValue;
        }
    }
}

function JTGridOnCheckChange( e )
{
    var event = e || window.event;
    var dataView = getEventTarget( event );
    var dataValue = document.getElementById( dataView.id.substr( 0, dataView.id.length - 9 ) + "_value" );
    var GridID = dataView.id.split( "_" )[ 0 ];
    var GridObject = document.getElementById( GridID );
    var newValue = ( dataView.checked ? "1" : "0" );
    var oldValue = dataValue.value;

    if( newValue != oldValue )
    {
        if( GridObject.OnCellEdited && GridObject.OnCellEdited( GridObject, GridObject.SelectedRow, GridObject.SelectedCol, oldValue, newValue ) == false )
        {
            dataView.checked = ( oldValue == "1" );
        }
        else
        {
            dataValue.value = newValue;
        }
    }
}

function JTGridGetCellText( GridID, Row, Col )
{
    var gridObject = document.getElementById( GridID );

    return gridObject.getCellValue( Row, Col );
}

function JTGridSetCellText( GridID, Row, Col, Value )
{
    var gridObject = document.getElementById( GridID );

    gridObject.setCellValue( Row, Col, Value );
}

function JTGridGetCellHTML( GridID, Row, Col )
{
    var gridObject = document.getElementById( GridID );

    return gridObject.getCellHTML( Row, Col );
}

function JTGridSetCellHTML( GridID, Row, Col, Value )
{
    var gridObject = document.getElementById( GridID );

    gridObject.setCellHTML( Row, Col, Value );
}

function JTGridInitColumns( GridID )
{
    var gridObject = document.getElementById( GridID );
    var gridHeader = document.getElementById( GridID + "_header" );
    var gridData = document.getElementById( GridID + "_rows" );
    var i;

    if( /*!gridHeader ||*/ !gridData )
        return;

    var gridBody, firstGridRow;

    gridBody = JTLocateFirstChildByTagName( gridData, "TBODY" );
    firstGridRow = JTLocateFirstChildByTagName( gridBody, "TR" );
    if( !firstGridRow )
        return;

    var dataColumnArray = firstGridRow.getElementsByTagName( "TD" );
    var dataDiv = document.getElementById( GridID + "_data" );

    // gridHeader = JTLocateFirstChildByTagName( gridHeader, "TBODY" );
    // gridHeader = JTLocateFirstChildByTagName( gridHeader, "TR" );
    gridHeader = document.getElementById( GridID + "_headerdiv" );
    if( gridHeader )
    {
        // var columnArray = gridHeader.getElementsByTagName( "TD" );
        var columnArray = gridHeader.getElementsByTagName( "DIV" );

        if( dataColumnArray.length > 0 && dataColumnArray[ 0 ].offsetWidth == 0 )
        {
            // setTimeout( "JTGridInitColumns( '" + GridID + "' )", 10 );
            registerForDisplayChange( gridObject );
            return;
        }

        var headerDiv = document.getElementById( GridID + "_headerdiv" );
        if( headerDiv )
        {
            headerDiv.style.width = ( dataDiv.clientWidth == 0 ? dataDiv.offsetWidth : dataDiv.clientWidth ) + "px";
            headerDiv.style.height = firstGridRow.offsetHeight + "px";
        }

        var s = 0;

        for( i = 0; i < columnArray.length; ++i )
        {
            if( dataColumnArray.length <= i )
                break;

            columnArray[ i ].style.left = s + "px";
            columnArray[ i ].style.width = ( dataColumnArray[ i ].offsetWidth - 0 ) + "px";
            columnArray[ i ].style.height = ( dataColumnArray[ i ].offsetHeight - 0 ) + "px";
            columnArray[ i ].style.zIndex = i + 1;

            s += dataColumnArray[ i ].offsetWidth;
        }

        // document.getElementById( GridID + "_header" ).style.width = ( s - 1 ) + "px";
        //document.getElementById( GridID + "_headerdiv" ).style.width = ( s + 1 ) + "px";
    }

    if( dataColumnArray )
        gridObject.ColCount = dataColumnArray.length;

    if( gridBody )
        gridObject.RowCount = gridBody.getElementsByTagName( "TR" ).length - 1;

    dataDiv.gridID = GridID;
    dataDiv.onscroll = JTGridGridScroll;
}

function JTGridSelectCellHandler( event, GridID, Row, Col )
{
	var e = event || window.event;
    var GridObject = document.getElementById( GridID );

    var OldSelRow = document.getElementById( GridID + "_sr" ).value;
    var OldSelCol = document.getElementById( GridID + "_sc" ).value;

    document.getElementById( GridID + "_sr" ).value = Row;
    document.getElementById( GridID + "_sc" ).value = Col;

    if( GridObject.OnSelectCell && GridObject.OnSelectCell( e, GridObject, Row, Col ) == false )
    {
        document.getElementById( GridID + "_sr" ).value = OldSelRow;
        document.getElementById( GridID + "_sc" ).value = OldSelCol;
        return;
    }

    JTGridDoSelectCell( GridID, GridObject, Row, Col );
}

function JTGridHeaderClickHandler( GridID, Col )
{
    var GridObject = document.getElementById( GridID );

    if( GridObject.OnHeaderClick )
        GridObject.OnHeaderClick( GridObject, Col );
}

function JTGridGridScroll( e )
{
    var event = e || window.event;
    var target = getEventTarget( event );
    var headerObject = document.getElementById( target.gridID + "_headerdiv" );

    headerObject.scrollLeft = target.scrollLeft;
}

function JTGridOnKeyPress( e )
{
    var event = e || window.event;
    var target = getEventTarget( event );
    var kc = event.keyCode;
    var gridID = target.id.split( "_" )[ 0 ];
    var gridObject = document.getElementById( gridID );

    if( !gridObject.RowSelect && kc == 37 && gridObject.SelectedCol > 0 )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow, gridObject.SelectedCol - 1 );
    else if( kc == 38 && gridObject.SelectedRow > 0 )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow - 1, gridObject.SelectedCol );
    else if( !gridObject.RowSelect && kc == 39 && gridObject.SelectedCol < ( gridObject.ColCount - 1 ) )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow, gridObject.SelectedCol + 1 );
    else if( kc == 40 && gridObject.SelectedRow < ( gridObject.RowCount - 1 ) )
        JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow + 1, gridObject.SelectedCol );
	else if( kc == 33 )
	{
        if( gridObject.SelectedRow > 4 )
			JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow - 5, gridObject.SelectedCol );
		else
			JTGridSelectCellHandler( e, gridID, 0, gridObject.SelectedCol );
	}
    else if( kc == 34 )
	{
		if( gridObject.SelectedRow < ( gridObject.RowCount - 5 ) )
			JTGridSelectCellHandler( e, gridID, gridObject.SelectedRow + 5, gridObject.SelectedCol );
		else
			JTGridSelectCellHandler( e, gridID, gridObject.RowCount - 1, gridObject.SelectedCol );
	}
    else
        return;

    if( event.stopPropagation )
        event.stopPropagation();
    if( event.preventDefault )
        event.preventDefault();
    return false;
}

function JTGridInitialize( gridID )
{
    var gridObject = document.getElementById( gridID );

    gridObject.onParentDisplayChange = function()
    {
        JTGridInitColumns( this.id );
    }

    gridObject.getCellValue = function( row, col )
    {
        if( row < 0 || col < 0 )
            return "";

        var cellID = this.id + "_cell_" + row + "_" + col;
		var cell = document.getElementById( cellID );

        if( document.getElementById( cellID + "_value" ) )
            return document.getElementById( cellID + "_value" ).value;
		else if (typeof (cell.innerText) != "undefined")
			return cell.innerText;
		else if (typeof (cell.textContent) != "undefined")
			return cell.textContent;
		else
			return cell.innerHTML.replace(/<[^>]+>/g, "");
    }

    gridObject.setCellValue = function( row, col, value )
    {
        if( row < 0 || col < 0 )
            return;

        var cellID = this.id + "_cell_" + row + "_" + col;
        var cellValue = document.getElementById( cellID + "_value" );

        if( cellValue )
        {
            cellValue.value = value;
            var cellDataView = document.getElementById( cellID + "_dataview" );
            if( cellDataView.tagName == "SELECT" )
            {
                dataView.selectedIndex = -1;
                for( var i = 0; i < dataView.options.length; ++i )
                {
                    if( dataView.options[ i ].text == value )
                    {
                        dataView.selectedIndex = i;
                        break;
                    }
                }
            }
            else if( cellDataView.tagName == "INPUT" )
            {
                cellDataView.checked = !( value == "" || value == "0" );
            }
        }
        else
        {
			var cell = document.getElementById( cellID );
			
			if (typeof (cell.innerText) != "undefined")
				cell.innerText = value;
			else if (typeof (cell.textContent) != "undefined")
				cell.textContent = value;
			else
				cell.innerHTML = value;
        }

        JTGridInitColumns( this.id );
    }
	
	gridObject.getCellHTML = function( row, col )
	{
        if( row < 0 || col < 0 )
            return "";

        var cellID = this.id + "_cell_" + row + "_" + col;

        if( document.getElementById( cellID + "_value" ) )
            return document.getElementById( cellID + "_value" ).value;
        else
            return document.getElementById( cellID ).innerHTML;	
	}
	
    gridObject.setCellHTML = function( row, col, value )
    {
        if( row < 0 || col < 0 )
            return;

        var cellID = this.id + "_cell_" + row + "_" + col;
        var cellValue = document.getElementById( cellID + "_value" );

        if( cellValue )
        {
            cellValue.value = value;
            var cellDataView = document.getElementById( cellID + "_dataview" );
            if( cellDataView.tagName == "SELECT" )
            {
                dataView.selectedIndex = -1;
                for( var i = 0; i < dataView.options.length; ++i )
                {
                    if( dataView.options[ i ].text == value )
                    {
                        dataView.selectedIndex = i;
                        break;
                    }
                }
            }
            else if( cellDataView.tagName == "INPUT" )
            {
                cellDataView.checked = !( value == "" || value == "0" );
            }
        }
        else
        {
            document.getElementById( cellID ).innerHTML = value;
        }
    }

    gridObject.selectCell = function( row, col )
    {
        JTGridDoSelectCell( this.id, this, row, col );
    }

    gridObject.ColCount = 0;
    gridObject.RowCount = 0;

    JTGridInitColumns( gridID );

    if( !inArray( JTRegisteredOnResize, "JTGridInitColumns('" + gridID + "')" ) )
        JTRegisteredOnResize.push( "JTGridInitColumns('" + gridID + "')" );

    if( document.getElementById( gridID + "Input" ) )
        document.getElementById( gridID + "Input" ).onkeypress = JTGridDoInputKeyUp;

    gridObject.onkeydown = JTGridOnKeyPress;

    eval( "window." + gridID + " = gridObject;" );
}

function JTNavBarInitialize( navBarID, navItems, selected, clickHandler )
{
    var i;
    var navBarObject = document.getElementById( navBarID );

    for( i = 0; i < navItems.length; ++i )
    {
        var itemObject = document.getElementById( navItems[ i ] );

        itemObject.onclick = clickHandler;
        itemObject.navBar = navBarObject;
    }

    if( selected )
        navBarObject.activeSubBar = selected + "_subbar";
    else
        navBarObject.activeSubBar = "";
}

function JTNavBarButtonOver( NavButtonID, ButtonType )
{
    JTNavBarSetButtonState( NavButtonID, ButtonType, "over" );

    var itemObject = document.getElementById( NavButtonID );
    var barObject = document.getElementById( NavButtonID + "_subbar" );

    if( itemObject.navBar && itemObject.navBar.activeSubBar && document.getElementById( itemObject.navBar.activeSubBar ) )
        document.getElementById( itemObject.navBar.activeSubBar ).style.display = "none";

    if( barObject )
    {
        barObject.style.display = "block";

        if( typeof(itemObject.navBar) != "undefined")
			itemObject.navBar.activeSubBar = barObject.id;
    }
}

function JTNavBarButtonOut( NavButtonID, ButtonType, OrigState )
{
    JTNavBarSetButtonState( NavButtonID, ButtonType, OrigState );
}

function JTNavBarSetButtonState( NavButtonID, ButtonType, State )
{
    document.getElementById( NavButtonID ).className = "jtbb jtfont jt" + ButtonType + "navbar_button jt" + ButtonType + "navbar_button_" + State;

    if( document.getElementById( NavButtonID + "_inner" ) )
        document.getElementById( NavButtonID + "_inner" ).className = "jtbb jtfont jt" + ButtonType + "navbar_button_inner jt" + ButtonType + "navbar_button_inner_" + State;
}

function JTToolButtonOver( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "over" );
}

function JTToolButtonOut( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "" );
}

function JTToolButtonDown( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "down" );
}

function JTToolButtonUp( ToolButtonID )
{
    JTToolButtonSetStateClass( ToolButtonID, "over" );
}

function JTToolButtonSetStateClass( ToolButtonID, StateClass )
{
    var CenterStateClass;

    if( StateClass != "" )
        CenterStateClass = "jttoolbutton_" + StateClass;
    else
        CenterStateClass = "";

    document.getElementById( ToolButtonID ).className = "jtbb jtfont jttoolbutton " + CenterStateClass;
}

function JTInitializeSectionBar( id, sectionArray, sectionIndex, onChange )
{
    var sectionBarObject = document.getElementById( id );

    sectionBarObject.Sections = sectionArray;
    sectionBarObject.SectionIndex = sectionIndex;
    sectionBarObject.OnChange = onChange;
}

function JTSectionBarButtonClick( sectionBarId, sectionId )
{
    var sectionBarObject = document.getElementById( sectionBarId );
    var sections = sectionBarObject.Sections;
    var i;
    var ActiveTab;

    if( document.getElementById( sectionId + "_caption" ).offsetHeight == 0 )
    {
        setTimeout( "JTSectionBarButtonClick( '" + sectionBarId + "', '" + sectionId + "' )", 10 );
        return;
    }

    for( i = 0; i < sections.length; ++i )
    {
        if( sections[ i ] == sectionId )
            break;
    }

    if( i < sections.length )
        ActiveTab = i;
    else
        ActiveTab = -1;

    for( i = 0; i < sections.length; ++i )
    {
        if( i != ActiveTab )
            JTSectionBarSetSectionState( sectionBarObject, sections[ i ], i, ActiveTab );
    }

    JTSectionBarSetSectionState( sectionBarObject, sections[ ActiveTab ], ActiveTab, ActiveTab );

    sectionBarObject.SectionIndex = ActiveTab;

    if( sectionBarObject.OnChange )
    {
        var pageControlEvent = new JTPageControlChangeEvent( sectionBarObject, ActiveTab );

        sectionBarObject.OnChange( pageControlEvent );
    }
}

function JTSectionBarSetSectionState( sectionBarObject, sectionId, index, activeindex )
{
    var sectionObject = document.getElementById( sectionId );
    var sectionObjectContainer = document.getElementById( sectionId + "_container" );
    var sectionObjectCaption = document.getElementById( sectionId + "_caption" );
    var sectionClosedHeight = sectionObjectCaption.offsetHeight;

    if( index <= activeindex )
    {
        sectionObject.style.bottom = "";
        sectionObject.style.top = ( sectionClosedHeight * index + ( index * 2 ) ) + "px";
    }
    else
    {
        sectionObject.style.top = "";
        sectionObject.style.bottom = ( sectionClosedHeight * ( sectionBarObject.Sections.length - index - 1 ) + ( ( sectionBarObject.Sections.length - index - 1 ) * 2 ) ) + "px";
    }

    sectionObjectContainer.style.display = ( index == activeindex ) ? "block" : "none";
    sectionObjectCaption.style.cursor = ( index == activeindex ) ? "default" : "pointer";

    if( sectionObjectContainer.style.display == "block" )
        ParentSendDisplayChanged( sectionObjectContainer );
}


function JTDatePickerInitialize( id, jsOnChange, jsOnBlur, jsOnFocus, dateFormat )
{
    var datePicker = document.getElementById( id );
    var inputHeight = datePicker.offsetHeight;

	if( datePicker.parentNode.parentNode.parentNode.className == "inputcontainer" )
		datePicker.inputContainer = datePicker.parentNode.parentNode.parentNode;
		
	if( datePicker.inputContainer )
		inputHeight = datePicker.inputContainer.offsetHeight + 2;

    if( JTIEVer > -1 && JTIEVer < 8 )
    {
        document.getElementById( id + "_dropdown" ).style.top = "1px";
        document.getElementById( id + "_calendar" ).onselectstart = function () { return false; };
    }

    var calendar = document.getElementById( id + "_calendar" );

    if( inputHeight > 0 )
        document.getElementById( id + "_dropdown" ).style.height = ( inputHeight - 2 ) + "px";

	JTDatePickerCleanup( id );

	var view = document.getElementById(id + "_view");

	if( !view.onblur )
		addEvent(view, "click", function() { JTDatePickerShowCalendar(id) });

	datePicker.setValue = function(value) {
		this.value = value;
		this.viewInput.value = phpDateToStr(this.dateFormat, parseDBDate(value));
	};

	datePicker.jsOnChange = jsOnChange;
	datePicker.jsOnBlur = jsOnBlur;
	datePicker.jsOnFocus = jsOnFocus;
	datePicker.dateFormat = dateFormat;
	datePicker.viewInput = view;

    if( !JTPageLoaded )
        JTDatePickerList.push( id );
    else
        JTDatePickerLoad( id );

    eval( "window." + id + " = datePicker;" );
}

function JTDatePickerOnBlur( id )
{
    var datePicker = document.getElementById( id );
	var view = document.getElementById(id + "_view");
	var selDate = parseDBDate( view.value );
	
	if( !selDate )
		return;
	
	var year = selDate.getFullYear();
	var month = selDate.getMonth();
	var day = selDate.getDate();
	var dStr = "";
	dStr += strPad( year, 4, "0", "left" ) + "-";
	dStr += strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-";
	dStr += strPad( day, 2, "0", "left" ) + " ";
	
	view.value = dStr;
 
	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );

	JTDatePickerSelectDate( id, year, month, day );
}

function JTDatePickerShowCalendar( id, hideIfVisible )
{
	var curDate = parseDBDate( document.getElementById( id ).value );
	if( curDate == null )
		curDate = new Date();

    var picker = document.getElementById( id );
    var calendar = document.getElementById( id + "_calendar" );
	if( picker.disabled )
		return;
		
	if (typeof(hideIfVisible) != "undefined" && calendar.style.display == "block") {
	    calendar.style.display = "none";
	    return;
	}

    JTDatePickerLoadCalendarForDate( id, curDate );

    calendar.style.left = getObjectScreenX( picker.viewInput ) + "px";
    calendar.style.top = getObjectScreenY( picker.viewInput ) + picker.viewInput.offsetHeight + "px";
    calendar.style.display = "block";
    calendar.focus();
	
	var screenEdgeX = getBrowserScrollX() + getBrowserWidth();
	var screenEdgeY = getBrowserScrollY() + getBrowserHeight();
	var objectDiffX = getObjectScreenX( calendar ) + calendar.offsetWidth - screenEdgeX;
	var objectDiffY = getObjectScreenY( calendar ) + picker.viewInput.offsetHeight + calendar.offsetHeight - screenEdgeY;
	
	if( objectDiffX > 0 )
		setBrowserScrollX( getBrowserScrollX() + objectDiffX );
	if( objectDiffY > 0 )
		setBrowserScrollY( getBrowserScrollY() + objectDiffY );
	
    if( JTIEVer > -1 )
		calendar.onfocusout = JTDatePickerCalendarFocusOut;
	else
		calendar.onblur = JTDatePickerCalendarBlur;

    JTDatePickerActive = picker;
    JTDatePickerSkipClick = true;

    if( picker.jsOnFocus )
		picker.jsOnFocus( picker );
}

function JTDatePickerLoadCalendarForDate( id, curDate )
{
    var i, d, l, month, year;
    var selDate = parseDBDate( document.getElementById( id ).value );
    var todayDate = new Date();
    var html = "";
    var className;

    html = "<table class=\"jtbb jtfont jtdatepickercalendartable\" cellpadding=\"0\" cellspacing=\"0\"><tr class=\"jtdatepickercalendarheader\">";

    for( i = 0; i < 7; ++i )
        html += "<td>" + getDayName( i ).substring( 0, 1 ) + "</td>";

    html += "</tr><tr>";

    year = curDate.getFullYear();
    month = curDate.getMonth();

    l = getFirstDayInMonth( year, month );
    for( i = 0, d = 0; i < l; ++i, ++d )
        html += "<td>&nbsp;</td>";

    l = getDaysInMonth( year, month );
    for( i = 0; i < l; ++i, ++d )
    {
        if( ( d % 7 ) == 0 )
            html += "</tr><tr>";

        if( selDate && selDate.getFullYear() == curDate.getFullYear() && selDate.getMonth() == curDate.getMonth() && selDate.getDate() == ( i + 1 ) )
            className = " jtdatepickerselected";
        else if( todayDate.getFullYear() == curDate.getFullYear() && todayDate.getMonth() == curDate.getMonth() && todayDate.getDate() == ( i + 1 ) )
            className = " jtdatepickertoday";
        else
            className= "";

        html += "<td class=\"jtdatepickercalendarcell" + className + "\" onclick=\"JTDatePickerSelectDate( '" + id + "', '" + year + "', '" + month + "', '" + ( i + 1 ) + "' )\">" + ( i + 1 ) + "</td>";
    }

    html += "</tr></table>";

    document.getElementById( id + "_calendartable" ).innerHTML = html;
    document.getElementById( id + "_calendartitle" ).innerHTML = getMonthByName( month ) + " " + year;
    document.getElementById( id ).curDate = curDate;
}

function JTDatePickerSelectDate( id, year, month, day )
{
	var datePicker = document.getElementById( id );
	
	datePicker.value = strPad( year, 4, "0", "left" ) + "-" + strPad( parseInt( month ) + 1, 2, "0", "left" ) + "-" + strPad( day, 2, "0", "left" );
	datePicker.viewInput.value = phpDateToStr( datePicker.dateFormat, new Date(	year, month, day ) );
	document.getElementById( id + "_calendar" ).style.display = "none";
	JTDatePickerActive = null;

	if( datePicker.jsOnChange )
		datePicker.jsOnChange( new JTEvent( datePicker, "change" ) );
		
	if( datePicker.jsOnBlur )
		datePicker.jsOnBlur( datePicker );
}

function JTDatePickerOnLoad()
{
    var i;

    for( i = 0; i < JTDatePickerList.length; ++i )
        JTDatePickerLoad( JTDatePickerList[ i ] );

    JTDatePickerList = new Array();
}

function JTDatePickerLoad( id )
{
	var datePicker = document.getElementById( id );
    var inputHeight = datePicker.offsetHeight;
    
    if( datePicker.inputContainer )
		inputHeight = datePicker.inputContainer.offsetHeight + 2;

    if( inputHeight > 0 )
        document.getElementById( id + "_dropdown" ).style.height = ( inputHeight - 2 ) + "px";

    var calendar = document.getElementById( id + "_calendar" );

    calendar.parentNode.removeChild( calendar );
    document.body.appendChild( calendar );
    calendar.style.zIndex = 1900;
}

function JTDatePickerDocumentClick()
{
    if( JTDatePickerSkipClick )
    {
        JTDatePickerSkipClick = false;
    }
    else if( JTDatePickerActive )
    {
        //document.getElementById( JTDatePickerActive.id + "_calendar" ).style.display = "none";
        //JTDatePickerActive = null;
    }
}

function JTDatePickerCalendarBlur( e )
{
	if( JTDatePickerActive && JTIEVer == -1 )
    {
		var event = e || window.event;
		var calendar = document.getElementById( JTDatePickerActive.id + "_calendar" );
		var target = getEventTarget( event );
		
		JTSetOnFocusOut( JTDatePickerCalendarFocusOut );
    }
}

function JTDatePickerCalendarFocusOut( e )
{
	if( JTDatePickerActive )
    {
		var calendar = document.getElementById( JTDatePickerActive.id + "_calendar" );
		
		if( isChild( document.activeElement, calendar ) )
		{
			if( JTIEVer > -1 )
				document.activeElement.onfocusout = JTDatePickerCalendarFocusOut;
			else
				document.activeElement.onblur = JTDatePickerCalendarBlur;
			return;
		}
		
		calendar.style.display = "none";
        JTDatePickerActive = null;
    }
}

function JTDatePickerPrevYear( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        curDate.setYear( curDate.getFullYear() - 1 );

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerPrevMonth( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        var month = curDate.getMonth();
        if( ( month - 1 ) < 0 )
        {
            curDate.setYear( curDate.getFullYear() - 1 );
            curDate.setMonth( 11 );
        }
        else
        {
            curDate.setMonth( month - 1 );
        }

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerNextYear( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        curDate.setYear( curDate.getFullYear() + 1 );

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerNextMonth( id )
{
    var curDate = document.getElementById( id ).curDate;
    if( curDate )
    {
        var month = curDate.getMonth();
        if( ( month + 1 ) > 11 )
        {
            curDate.setYear( curDate.getFullYear() + 1 );
            curDate.setMonth( 0 );
        }
        else
        {
            curDate.setMonth( month + 1 );
        }

        JTDatePickerLoadCalendarForDate( id, curDate );
    }

    JTDatePickerSkipClick = true;
}

function JTDatePickerToday( id )
{
    JTDatePickerLoadCalendarForDate( id, new Date() );
	JTDatePickerSkipClick = true;
}

function JTDatePickerCleanup( id )
{
	var node;
	var children = ( document.body.childNodes ) ? document.body.childNodes : document.documentElement.childNodes;

	id += "_calendar";

	for( var i = 0; i < children.length; ++i )
	{
		node = children[ i ];
		if( node.id == id )
		{
			document.body.removeChild( node );
			break;
		}
	}
}

function JTDatePickerClear( id )
{
	var datePicker = document.getElementById( id );
	datePicker.value = "";
	datePicker.viewInput.value = "";	
	if( datePicker.jsOnBlur )
		datePicker.jsOnBlur( datePicker );
}
