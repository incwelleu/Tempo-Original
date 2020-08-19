/*********************************************************************************/
/*                  JomiTech Components For PHP Script File                      */
/*               Copyright © JomiTech 2009. All Rights Reserved.                 */
/*********************************************************************************/

function JTPageControlChangeEvent( pageControlObject, activeTab )
{
    this.PageControl = pageControlObject;
    this.ActiveTab = activeTab;
}


function JTPageControlSetTabState( pageControlObject, tabsheet, index, activeindex )
{
    var centerclasstype, tabclasstype;

    centerclasstype = ( index == activeindex ) ? 'active' : 'inactive';

    if( index == activeindex )
        tabclasstype = 'active';
    else if( index < activeindex )
        tabclasstype = 'before';
    else
        tabclasstype = 'after';

    document.getElementById( "jttabbutton_" + tabsheet ).className = "jtbb jtfont jttab jttab_" + centerclasstype;
    document.getElementById( "jttabinner_" + tabsheet ).className = "jtbb jtfont jttabinner jttabinner_" + tabclasstype;
    document.getElementById( "jttabbuttontop_" + tabsheet ).className = "jtbb jttabstop jttabstop_" + centerclasstype;
    document.getElementById( "jttabtl_" + tabsheet ).className = "jtbb jttabtl jttabtl_" + centerclasstype;
    document.getElementById( "jttabtr_" + tabsheet ).className = "jtbb jttabtr jttabtr_" + centerclasstype;
    document.getElementById( "jttabbr_" + tabsheet ).className = "jtbb jttabr jttabr_" + tabclasstype;
    document.getElementById( "jttabbl_" + tabsheet ).className = "jtbb jttabl jttabl_" + tabclasstype;

    if( document.getElementById( tabsheet ) )
    {
        if( index == activeindex )
        {
			document.getElementById( tabsheet ).style.zIndex = "3";
			document.getElementById( tabsheet ).style.display = "block";
			ParentSendDisplayChanged( document.getElementById( tabsheet ) );
        }
        else
        {
			document.getElementById( tabsheet ).style.zIndex = "1";
			document.getElementById( tabsheet ).style.display = "none";
		}
    }
}

function JTPageControlTabClick( pagecontrol, tabsheet )
{
    var pageControlObject = document.getElementById( pagecontrol );
    var tabs = pageControlObject.Tabs;
    var i;
    var ActiveTab;
	
	if( !tabs )
		return;

    for( i = 0; i < tabs.length; ++i )
    {
        if( tabs[ i ] == tabsheet )
            break;
    }

    if( i < tabs.length )
        ActiveTab = i;
    else
        ActiveTab = -1;

	JTPageControlSetTabState( pageControlObject, tabs[ ActiveTab ], ActiveTab, ActiveTab );

	for( i = 0; i < tabs.length; ++i )
	{
	    if( i != ActiveTab )
		    JTPageControlSetTabState( pageControlObject, tabs[ i ], i, ActiveTab );
	}

	if( pageControlObject.TabIndex != ActiveTab )
	{
		pageControlObject.TabIndex = ActiveTab;
    	JTBaseTabControlActiveTabState[pagecontrol] = ActiveTab;

    	document.getElementById(pagecontrol + "_Index").value = ActiveTab;    	

		if( pageControlObject.OnChange )
		{
			var pageControlEvent = new JTPageControlChangeEvent( pageControlObject, ActiveTab );

			pageControlObject.OnChange( pageControlEvent );
		}
	}
}

function JTAddPageControlTabs( pagecontrol, tabs )
{
    PageControlTabs[ pagecontrol ] = tabs;
}

function JTExpandPanelClick( id )
{
    var panelObject = document.getElementById( id );

    JTSetExpandPanelState( id, ( panelObject.PanelState == "psHidden" ) ? "psVisible" : "psHidden" );

    if( panelObject.OnChange )
        panelObject.OnChange( panelObject, panelObject.PanelState );
}

function JTSetExpandPanelState( id, state )
{
    var panelObject = document.getElementById( id );
    var panelContent = document.getElementById( id + "_content" );
    var panelControl = document.getElementById( id + "_control" );
    var panelControlSpan = document.getElementById( id + "_controltext" );
    var panelControlLine = document.getElementById( id + "_line" );
    var panelOuter = document.getElementById( id + "_outer" );
    var ncStartX = 0;
    var ncObject = null;

    if( panelObject.NextControl )
    {
        ncObject = document.getElementById( panelObject.NextControl + "_outer" );
        if( !ncObject )
            ncObject = document.getElementById( panelObject.NextControl );
    }

    if( ncObject )
        ncStartX = panelObject.offsetHeight;

    if( state == "psVisible" )
    {
        panelContent.style.display = "block";
        panelControlLine.style.display = "block";
        panelObject.style.height = panelObject.origHeight;

		if( panelOuter && typeof( panelOuter.originalHeight ) != "undefined" )
			panelOuter.style.height = panelOuter.originalHeight;

        setTimeout( "document.getElementById( '" + ( id + "_controltext" ) + "' ).innerHTML = '" + panelObject.HideText + "'", 1 );

        ParentSendDisplayChanged( panelContent );
    }
    else
    {
        panelContent.style.display = "none";
        panelControlLine.style.display = "none";
        panelObject.style.height = "";

		if( panelOuter )
		{
			panelOuter.originalHeight = panelOuter.style.height;
			panelOuter.style.height = panelObject.offsetHeight + "px";
		}

        setTimeout( "document.getElementById( '" + ( id + "_controltext" ) + "' ).innerHTML = '" + panelObject.ShowText + "'", 1 );
    }

    panelObject.PanelState = state;

    if( ncObject )
        setObjectScreenY( ncObject, getObjectScreenY( ncObject ) + ( panelObject.offsetHeight - ncStartX ) );
}

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
    gridInput.style.left = gridCell.offsetLeft - gridData.scrollLeft + gridData.offsetLeft + gridRows.offsetLeft + gridData.offsetParent.offsetLeft + "px";
    gridInput.style.top = gridCell.offsetTop - gridData.scrollTop + gridData.offsetTop + gridRows.offsetTop + gridData.offsetParent.offsetTop + "px";
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

		registerForDisplayChange( gridObject );

        if( dataColumnArray.length > 0 && dataColumnArray[ 0 ].offsetWidth == 0 )
        {
            // setTimeout( "JTGridInitColumns( '" + GridID + "' )", 10 );
            // registerForDisplayChange( gridObject );
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
			columnArray[ i ].style.width = ( dataColumnArray[ i ].offsetWidth - 1 ) + "px";
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

		if( JTIEVer == -1 )
		{
			var data = document.getElementById( this.id + "_data" );
			data.style.overflow = "hidden";
			//data.style.overflow = "auto";
			setTimeout( "document.getElementById('" + this.id + "_data').style.overflow='auto';", 1000);
		}
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

    if( document.getElementById( NavButtonID + "_inner_left" ) )
        document.getElementById( NavButtonID + "_inner_left" ).className = "jtbb jt" + ButtonType + "navbar_button_inner_left jt" + ButtonType + "navbar_button_inner_left_" + State;

    if( document.getElementById( NavButtonID + "_inner_right" ) )
        document.getElementById( NavButtonID + "_inner_right" ).className = "jtbb jt" + ButtonType + "navbar_button_inner_right jt" + ButtonType + "navbar_button_inner_right_" + State;
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
        CenterStateClass = "jttoolbarbutton_" + StateClass;
    else
        CenterStateClass = "";

    document.getElementById( ToolButtonID ).className = "jtbb jtfont jttoolbarbutton " + CenterStateClass;
}

function JTToolBarInitialize( id )
{
	if( JTPageLoaded )
		JTToolBarLoad( id );
	else
		JTToolBarList.push( id );
}

function JTToolBarOnLoad()
{
	var i;

	for( i = 0; i < JTToolBarList.length; ++i )
		JTToolBarLoad( JTToolBarList[ i ] );
}

function JTToolBarLoad( id )
{
	var scroller = document.getElementById( id + "_scroller" );
	var inner = document.getElementById( id + "_inner2" );

	if( scroller.scrollWidth > scroller.clientWidth )
	{
		inner.style.paddingLeft = "10px";
		inner.style.paddingRight = "10px";
	}
	else
	{
		inner.style.paddingLeft = "0";
		inner.style.paddingRight = "0";
	}

	document.getElementById( id + "_fwdscroller" ).style.display = ( scroller.scrollWidth > scroller.clientWidth ) ? "block" : "none";
	document.getElementById(id + "_revscroller").style.display = (scroller.scrollWidth > scroller.clientWidth) ? "block" : "none";
	document.getElementById(id + "_revscroller").style.visibility = ((scroller.scrollLeft + scroller.clientWidth) >= scroller.scrollWidth) ? "hidden" : "visible";
	document.getElementById(id + "_fwdscroller").style.visibility = (scroller.scrollLeft > 0) ? "visible" : "hidden";
}

function JTToolBarScrollLeftStart( id )
{
	JTToolBarScrollTimer = setInterval( "JTToolBarScrollTick('" + id + "',-20)", 50 );
}

function JTToolBarScrollLeftStop( id )
{
	clearInterval( JTToolBarScrollTimer );
}

function JTToolBarScrollRightStart( id )
{
	JTToolBarScrollTimer = setInterval( "JTToolBarScrollTick('" + id + "',20)", 50 );
}

function JTToolBarScrollRightStop( id )
{
	clearInterval( JTToolBarScrollTimer );
}

function JTToolBarScrollTick( id, direction )
{
	var scroller = document.getElementById( id + "_scroller" );

	scroller.scrollLeft += direction;

	document.getElementById(id + "_revscroller").style.visibility = ((scroller.scrollLeft + scroller.clientWidth) >= scroller.scrollWidth) ? "hidden" : "visible";
	document.getElementById(id + "_fwdscroller").style.visibility = (scroller.scrollLeft > 0) ? "visible" : "hidden";
}

function JTInitializeMenu( id, jsOnClick, controlName, controlButton, controlAttachType )
{
    var menuObject = document.getElementById( id );

    menuObject.Popup = function( x, y )
    {
		var menuFrame = document.getElementById( "JTMenuFrame" );

        if( JTMenuActive )
            JTMenuActive.Hide();

        /* if( getOuterNode( this ) )
        {
            getOuterNode( this ).style.left = x + "px";
            getOuterNode( this ).style.top = y + "px";
        }
        else
        */
        // {
            this.style.left = x + "px";
            this.style.top = y + "px";
        // }

		this.style.display = "block";
        this.style.visibility = "visible";

		if( menuFrame )
		{
			menuFrame.style.left = this.style.left;
			menuFrame.style.top = this.style.top;
			menuFrame.style.width = this.offsetWidth;
			menuFrame.style.height = this.offsetHeight;
			menuFrame.style.display = "block";
			menuFrame.style.zIndex = this.style.zIndex - 1;
		}

        JTMenuActive = this;
        JTMenuSkipClick = true;
    }

    menuObject.Hide = function()
    {
		var menuFrame = document.getElementById( "JTMenuFrame" );

		if( menuFrame )
			menuFrame.style.display = "none";

        this.style.visibility = "hidden";
		this.style.display = "none";

        JTMenuActive = null;
    }

    menuObject.OnLoad = function() {
    	if (this.controlName && this.controlButton) {
    		var controlObject = document.getElementById(this.controlName + "_" + this.controlButton);

    		if (controlObject) {
    			controlObject.menuObject = this;

    			if (this.controlAttachType)
    				addEvent(controlObject, this.controlAttachType, JTMenuControlMouseOver);
    		}
    	}

    	this.parentNode.removeChild(this);
    	document.body.appendChild(this);

    	this.style.zIndex = getTotalDocumentTagCount() + 2;

    	var outer = getOuterNode(this);
    	if (outer)
    		outer.style.display = "none";
    	// outer.parentNode.removeChild( outer );
    }

    menuObject.controlName = controlName;
    menuObject.controlButton = controlButton;
    menuObject.controlAttachType = controlAttachType;
    menuObject.jsOnClick = jsOnClick;
    menuObject.onclick = JTMenuClick;

    if( !document.all )
    {
        var items = menuObject.getElementsByTagName( "LI" );
        var i;

        for( i = 0; i < items.length; ++i )
        {
            items[ i ].style.MozUserSelect = "none";
            items[ i ].onmousedown = function() { return false; }
        }
    }

    eval( "window." + menuObject.id + " = document.getElementById( '" + menuObject.id + "' );" );

	if( !JTPageLoaded )
		JTMenuList.push( menuObject );
	else
		menuObject.OnLoad();
}

function JTMenuOnLoad()
{
	if( JTIEVer <= 6 && JTIEVer > -1 )
	{
		var menuFrame = document.createElement( "IFRAME" );

		document.body.appendChild( menuFrame );

		menuFrame.id = "JTMenuFrame";
		menuFrame.scrolling = "no";
		menuFrame.frameBorder = 0;
		menuFrame.style.display = "none";
		menuFrame.style.position = "absolute";
		menuFrame.style.zIndex = 199;
	}

	for( var i = 0; i < JTMenuList.length; ++i )
        JTMenuList[ i ].OnLoad();
}

function JTMenuDocumentClick( e )
{
    if( JTMenuSkipClick )
    {
        JTMenuSkipClick = false;
        return;
    }

    if( JTMenuActive )
        JTMenuActive.Hide();
}

function JTMenuClick( e )
{
    var event = e || window.event;

    event.cancelBubble = true;

    if( event.stopPropagation )
        event.stopPropagation();

    return false;
}

function JTMenuItemOver( MenuItemID )
{
    var itemObject = document.getElementById( MenuItemID );

    itemObject.className = "jtbb jtfont jtmenuitem jtmenuitem_over";
}

function JTMenuItemOut( MenuItemID )
{
    var itemObject = document.getElementById( MenuItemID );

    itemObject.className = "jtbb jtfont jtmenuitem";
}

function JTMenuHide( MenuItemID )
{
    var objNames = MenuItemID.split( "_" );
    var menuObjectName = objNames[ 0 ];
    var menuItemName = objNames[ 1 ];

    document.getElementById( menuObjectName ).Hide();
}

function JTMenuHideActive()
{
    if( JTMenuActive )
        JTMenuActive.Hide();
}

function JTMenuControlMouseOver( e )
{
    var event = e || window.event;
    var eventObj = getEventTarget( event );

    JTMenuShowForControl( eventObj );

    if( event.type != "click" )
        JTMenuSkipClick = false;
}

function JTMenuShowForControl( controlObject, heightOffset )
{
    if( controlObject && controlObject.menuObject )
    {
        var x, y;

        x = getObjectScreenX( controlObject ) - getObjectScreenX( getSizedParentNode( controlObject.menuObject ) );
        y = getObjectScreenY( controlObject ) - getObjectScreenY( getSizedParentNode( controlObject.menuObject ) ) + controlObject.offsetHeight;

        if( controlObject.clientWidth > 0 )
            x += ( controlObject.offsetWidth - controlObject.clientWidth ) / 2;

        if( typeof( heightOffset ) == "undefined" )
            heightOffset = 0;

        controlObject.menuObject.Popup( x, y + heightOffset );
    }
}

function JTMenuCleanup( id )
{
	var menu = document.getElementById( id );

	document.body.removeChild( menu );
}

function JTMenuBarButtonOver( menuButtonID )
{
    var itemObject = document.getElementById( menuButtonID );
    var objNames = menuButtonID.split( "_" );
    var menuBarObjectName = objNames[ 0 ];
    var menuBarItemName = objNames[ 1 ];

    itemObject.className = "jtbb jtfont jtmenubarbutton jtmenubarbutton_over";

    if( JTMenuActive && JTMenuActive.controlName == menuBarObjectName )
    {
        JTMenuShowForControl( itemObject, 5 );
        JTMenuSkipClick = false;
    }
}

function JTMenuBarButtonOut( menuButtonID )
{
    var itemObject = document.getElementById( menuButtonID );

    itemObject.className = "jtbb jtfont jtmenubarbutton";
}

function JTMenuBarButtonClick( menuButtonID )
{
    JTMenuShowForControl( document.getElementById( menuButtonID ), 5 );

    JTMenuSkipClick = true;
}

function JTCategoryButtonsInitialize( id )
{
    var stateObject = document.getElementById( id + "_state" );

    if( stateObject )
    {
        var curState = stateObject.value;
        var categories = document.getElementById( id );
        var i;

        for( i = 0; i < categories.childNodes.length; ++i )
        {
            if( curState.indexOf( categories.childNodes[ i ].id ) > -1 )
            {
                if( JTIEVer <= 7 )
                    JTCategoryButtonsUpdateList.push( new Array( id, categories.childNodes[ i ].id ) );
                else
                    JTCategoryButtonCatClick( id, categories.childNodes[ i ].id );
            }
        }
    }
}

function JTCategoryButtonsOnLoad()
{
    var i;

    for( i = 0; i < JTCategoryButtonsUpdateList.length; ++i )
    {
        var cbUpdate = JTCategoryButtonsUpdateList[ i ];

        JTCategoryButtonCatClick( cbUpdate[ 0 ], cbUpdate[ 1 ] );
    }
}

function JTCategoryButtonCatClick( id, categoryId )
{
    var catObject = document.getElementById( categoryId );
    var catCaptionObject = document.getElementById( categoryId + "_caption" );

    if( typeof( catObject.catState ) == "undefined" || catObject.catState == "expanded" )
    {
        JTHeightAnimate( catObject, catCaptionObject.offsetHeight + 5 );
        catObject.style.overflow = "hidden";
        catObject.catState = "shrunk";
    }
    else
    {
        JTHeightRestore( catObject );
        catObject.style.overflow = "visible";
        catObject.catState = "expanded";
    }

    var stateObject = document.getElementById( id + "_state" );
    var categories = document.getElementById( id ).getElementsByTagName( "DIV" );
    var i, newState = "";

    for( i = 0; i < categories.length; ++i )
    {
        if( typeof( categories[ i ].catState ) != "undefined" && categories[ i ].catState == "shrunk" )
            newState += categories[ i ].id + ";";
    }

    stateObject.value = newState;
}

function JTCategoryButtonsMouseOver( id )
{
    document.getElementById( id ).className = "jtbb jtfont jtcatbutton jtcatbuttonover";
}

function JTCategoryButtonsMouseOut( id )
{
    document.getElementById( id ).className = "jtbb jtfont jtcatbutton";
}

function JTExplanationPopupInitialize( id, htmlCode )
{
    JTExplanationPopups.push( new Array( id, htmlCode ) );
}

function JTExpPopupOnLoad()
{
    var i;

    for( i = 0; i < JTExplanationPopups.length; ++i )
    {
        var expPopDiv = document.createElement( "DIV" );

        document.body.appendChild( expPopDiv );

        expPopDiv.innerHTML = JTExplanationPopups[ i ][ 1 ];

        var expPopObject = document.getElementById( JTExplanationPopups[ i ][ 0 ] );
        if( expPopObject )
        {
            expPopObject.Hint = function( id, message )
            {
                this.internalShow( id, message, true );
            }

            expPopObject.Popup = function( id, message )
            {
                this.internalShow( id, message, false );
            }

            expPopObject.Hide = function()
            {
                this.style.visibility = "hidden";
                JTExplanationPopupActive = null;
            }

            expPopObject.setText = function( str )
            {
                document.getElementById( this.id + "_inner" ).innerHTML = str;
            }

            expPopObject.internalShow = function( id, message, hint )
            {
                if( JTExplanationPopupActive )
                    JTExplanationPopupActive.Hide();

                this.setText( message );

                var object = document.getElementById( id );
                if( object )
                {
                    var x = ( getBrowserScrollX() > getObjectScreenX( object ) ) ? getBrowserScrollX() : getObjectScreenX( object );
                    var y;
                    
                    if( getBrowserScrollY() > ( getObjectScreenY( object ) - this.offsetHeight - 29 ) )
                    {
                        y = getObjectScreenY( object ) + object.offsetHeight - 5;
                    }
                    else
                    {
                        y = ( getObjectScreenY( object ) - this.offsetHeight ) - 15;
                    }

                    if( JTIEVer > -1 && JTIEVer < 8 )
                        document.getElementById( this.id + "_shadbl" ).style.bottom = ( ( this.offsetHeight % 2 ) != 0 ? -6 : -5 ) + "px";

                    this.style.left = ( x ) + "px";
                    this.style.top = y + "px";
                    this.style.visibility = "visible";

                    JTExplanationPopupActive = this;
                    
                    JTExplanationSkipClick = !hint;

                    if( hint )
                        addEvent( object, "mouseout", JTExpPopupOnOut );
                }
            }

            if( JTIEVer > -1 && JTIEVer < 7 )
            {
                document.getElementById( JTExplanationPopups[ i ][ 0 ] + "_shadow" ).style.visibility = "hidden";
                document.getElementById( JTExplanationPopups[ i ][ 0 ] + "_tl" ).style.background = "url(" + JTThemeWebDir + "images/ep_tl.gif)";
                document.getElementById( JTExplanationPopups[ i ][ 0 ] + "_tr" ).style.background = "url(" + JTThemeWebDir + "images/ep_tr.gif)";
                document.getElementById( JTExplanationPopups[ i ][ 0 ] + "_bl" ).style.background = "url(" + JTThemeWebDir + "images/ep_bl.gif)"
                document.getElementById( JTExplanationPopups[ i ][ 0 ] + "_br" ).style.background = "url(" + JTThemeWebDir + "images/ep_br.gif)";
            }

            eval( "window." + JTExplanationPopups[ i ][ 0 ] + " = document.getElementById( '" + JTExplanationPopups[ i ][ 0 ] + "' );" );
        }
    }
}

function JTExpPopupDocumentClick()
{
    if( JTExplanationSkipClick )
        JTExplanationSkipClick = false;
    else if( JTExplanationPopupActive )
        JTExplanationPopupActive.Hide();
}

function JTExpPopupOnOut()
{
    if( JTExplanationPopupActive )
        JTExplanationPopupActive.Hide();
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
    var sectionClosedHeight = sectionObjectCaption.offsetHeight + 4;

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
        document.getElementById( id + "_dropdown" ).style.top = "2px";
        document.getElementById( id + "_calendar" ).onselectstart = function () { return false; };
    }

    var calendar = document.getElementById( id + "_calendar" );

    if( inputHeight > 0 )
        document.getElementById( id + "_dropdown" ).style.height = ( inputHeight - 2 ) + "px";

	JTDatePickerCleanup( id );

	var view = document.getElementById( id + "_view" );

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

function JTTreeViewInitialize( treeName, selectedNodeName, collapsedNodeNames, jsClickEvent, hasServerOnClick, pageForm, submitInputElement )
{
	var treeObject = document.getElementById( treeName );

    treeObject.getSelectedCaption = function () {
        if (!this.selectedNode)
            return null;

        return document.getElementById(this.selectedNode.id + "_title").innerHTML;
    }

	treeObject.setSelectedNode = function( node )
	{
		if( this.selectedNode )
			document.getElementById( this.selectedNode.id + "_title" ).className = "jtfont jttreenodetitle";

		this.selectedNode = node;

		if( node )
		{
			document.getElementById( this.id + "_sn" ).value = node.id;
			document.getElementById( node.id + "_title" ).className = "jtfont jttreenodetitle jttreenodetitleselected";
		}
	}

	treeObject.setNodeState = function( node, collapsed )
	{
		if( !node )
			return;
		var plusNode = document.getElementById( node.id + "_plus" );
		var childNodesList = node.getElementsByTagName( "UL" )[ 0 ];
		if( childNodesList )
		{
			var cnList = this.collapsedNodeInput.value.split( " " );
			if( !collapsed )
			{
				childNodesList.style.display = "block";
				plusNode.innerHTML = "-";
				node.collapsed = false;
				cnList.removeItem( node.id );
			}
			else
			{
				childNodesList.style.display = "none";
				plusNode.innerHTML = "+";
				node.collapsed = true;
				if( cnList.indexOf( node.id ) == -1 )
					cnList.push( node.id );
			}
			this.collapsedNodeInput.value = cnList.join( " " );
		}
	}

	treeObject.toggleNodeState = function( node )
	{
		if( !node )
			return;
		if( node.collapsed )
			this.setNodeState( node, false );
		else
			this.setNodeState( node, true );
	}

	treeObject.form = pageForm;
	treeObject.submitInputElement = submitInputElement;
	treeObject.jsOnClick = jsClickEvent;
	treeObject.hasServerOnClick = hasServerOnClick;
	treeObject.selectedNode = null;
	treeObject.collapsedNodeInput = document.getElementById( treeObject.id + "_cn" );

	if( selectedNodeName )
	{
		var selectedNode = document.getElementById( selectedNodeName );
		treeObject.setSelectedNode( selectedNode );
	}

	var cnList = collapsedNodeNames.split( " " );
	for( var i = 0; i < cnList.length; ++i )
		treeObject.setNodeState( document.getElementById( cnList[ i ] ), true );

    eval("window." + treeName + " = treeObject;");
}
