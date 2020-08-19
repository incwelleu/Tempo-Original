var JTPlatinumGrids = [];
JTPlatinumGridTheme = { FilterHeightOffset: 5 };

addEvent( window, "load", JTPlatinumGridOnLoad );

function JTPlatinumGridInitialize( gridID, options, requestor, themePath )
{
	var gridObject = document.getElementById( gridID );

	gridObject.FAlwaysShowEditor = options[0];
	gridObject.FCanMoveCols = options[1];
	gridObject.FCanMultiColumnSort = options[2];
	gridObject.FCanRangeSelect = options[3];
	gridObject.FCanResizeCols = options[4];
	gridObject.FCanResizeRows = options[5];
	gridObject.FCanSelect = options[6];
	gridObject.FReadOnly = options[7];
	gridObject.FRowSelect = options[8];
	if( options[9] && options[9] != "null" )
		eval( "gridObject.FOnDataLoad = " + options[9] );
	gridObject.FColumnCount = options[10];
	if( options[11] && options[11] != "null" )
		eval( "gridObject.FOnRowEditing = " + options[11] );
	gridObject.FEditorStyle = options[12];
	gridObject.FEditableColumns = options[13];
	gridObject.FKeyField = options[14];
	gridObject.FGroupBy = options[15];
	gridObject.FSortBy = options[16];
	if( options[17] && options[17] != "null" )
		eval( "gridObject.FOnRowEdited = " + options[17] );
	gridObject.EditingRow = options[18];
	if( options[19] && options[19] != "null" )
		eval( "gridObject.FOnRowInserted = " + options[19] );
	gridObject.FParentField = options[20];
	gridObject.FRowCount = options[21];
	gridObject.FVisibleRowCount = options[22];
	gridObject.FCanDragSelect = options[23];
	gridObject.FAllowScrolling = options[24];
	if( options[25] && options[25] != "null" )
		eval( "gridObject.FOnSelect = " + options[25] );
	// gridObject.FAllowHorizontalScrolling = options[26];
	gridObject.FShowEditColumn = options[27];
	gridObject.FFilterDelay = options[28];
	if (options[29] && options[29] != "null")
		eval("gridObject.FOnCommand = " + options[29]);
	gridObject.FFilterDelayTimeout = options[30];
	if (options[31] && options[31] != "null")
		eval("gridObject.FOnRowDeleting = " + options[31]);
	gridObject.FFillWidth = options[32];
    if (options[33] && options[33] != "null")
		eval("gridObject.FOnCustomCommand = " + options[33]);
	gridObject.FRequestor = requestor;
	gridObject.FThemePath = themePath;

	gridObject.FCommand = document.getElementById( gridObject.id + "_Cmd" );
	gridObject.FScrollerDiv = document.getElementById( gridObject.id + "_ScrollerDiv" );
	gridObject.FGroupBar = document.getElementById( gridObject.id + "_GroupBar" );
	gridObject.FTBody = document.getElementById( gridObject.id + "_IntTableBody" );
	gridObject.FTable = document.getElementById( gridObject.id + "_IntTable" );
	gridObject.FHeaderDiv = document.getElementById( gridObject.id + "_Header" );
	gridObject.SelectedRow = -1;
	gridObject.SelectedCol = -1;
	gridObject.SelectedCells = new Array();
	gridObject.cancelCellClick = false;
	gridObject.FHasFixedCols = false;
	gridObject.FFixedCells = new Array();
	gridObject.SelStartRow = -1;
	gridObject.SelStartCol = -1;
	gridObject.FResizedCols = {};
	gridObject.FLoaded = false;

	gridObject.onkeydown = JTPlatinumGridKeyDown;

	if( gridObject.FCanDragSelect && gridObject.FCanSelect && gridObject.FCanRangeSelect )
		gridObject.FTBody.onmousedown = JTPlatinumGridTBodyMouseDown;

	// Preload wait animation.
	gridObject.FWaitAnimation = new Image();
	gridObject.FWaitAnimation.src = gridObject.FThemePath + "images/wait.gif";

	gridObject.Load = function () {
	    if (this.offsetWidth == 0) {
	        return;
	    }

	    this._updateGridHeight();

	    if (this.FFillWidth) {
	        var IntTable = document.getElementById(this.id + "_IntTable");
	        var HeaderTable = document.getElementById(this.id + "_HeaderTable");

	        IntTable.className = IntTable.className.replace(" fillwidth", "");
	        if (HeaderTable) {
	            HeaderTable.className = HeaderTable.className.replace(" fillwidth", "");
	        }
	    }

	    this._initFixedCols();
	    this._loadSelection();

	    if (this.EditingRow > -1) {
	        var r = this.EditingRow;
	        this.EditingRow = -1;
	        this.Edit(r);
	    }

	    var evalStr = "window." + gridID + ".onAnchorResize()";
	    if (!inArray(JTRegisteredOnResize, evalStr))
	        JTRegisteredOnResize.push(evalStr);

	    if (this.FOnDataLoad)
	        this.FOnDataLoad(this);

	    FLoaded = true;
	}

	gridObject.selectAll = function( select )
	{
		var tBody = document.getElementById( this.id + "_IntTableBody" );
		var rows = JTGetChildrenByTagName( tBody, "TR" );
		for( var i = 0; i < ( rows.length - 1 ); ++i )
		{
			if( rows[ i ].className.indexOf( "row " ) == -1 )
			{
				rows.splice( i, 1 );
				--i;
			}
		}

		for( var i = 0; i < rows.length; ++i )
			this.selectRow( i, select, false, true );
	}

	gridObject.selectRow = function(rowIndex, select, shiftSelect, ctrlSelect) {
		if (!this.FRowSelect) {
			for (var c = 0; c < this.FEditableColumns.length; ++c)
				this.selectCell(rowIndex, c, select, shiftSelect, ctrlSelect || (c > 0));

			return;
		}

		var row = document.getElementById(this.id + "_row_" + rowIndex);
		if (!row)
			return;

		if (select && this.SelectedRow > -1 && (!this.FCanRangeSelect || !ctrlSelect)) {
			if (this.FCanRangeSelect && shiftSelect)
				this.deselectAllExceptFor(this.SelStartRow, -1);
			else
				this.deselectAll();
		}

		if (this.FCanRangeSelect && shiftSelect && this.SelectedRow > -1) {
			var sr = this.SelStartRow;
			var er = Math.max(rowIndex, this.SelStartRow);
			for (var r = Math.min(sr, rowIndex); r <= er; ++r) {
				if (r != sr && r != rowIndex)
					this.selectRow(r, true, false, true);
			}
		}

		if (select) {
			if (!this._selFieldContainsAndAdd(rowIndex, -1)) {
				row.className += " rowselected";
				this._resetHeader();
			}

			this.SelectedRow = rowIndex;
			this.SelectedCells[rowIndex] = 1;
		}
		else {
			this._selFieldRemove(rowIndex, -1);
			row.className = row.className.replace(" rowselected", "");

			if (this.SelectedRow == rowIndex) {
				this.SelectedRow = -1;
			}

			this.SelectedCells[rowIndex] = null;
		}

		var selCheck = document.getElementById(this.id + "_rs_" + rowIndex);
		if (selCheck && selCheck.checked != select)
			selCheck.checked = select;

		if (!shiftSelect && !ctrlSelect && select) {
			this.SelStartCol = this.SelectedCol;
			this.SelStartRow = this.SelectedRow;
		}

		if (this.FOnSelect)
			this.FOnSelect(this, this.SelectedRow, this.SelectedCol, select);
	}

	gridObject.selectCell = function(rowIndex, colIndex, select, shiftSelect, ctrlSelect) {
		if (this.FRowSelect) {
			this.selectRow(rowIndex, select, shiftSelect, ctrlSelect);
			return;
		}

		if (!this.FEditableColumns[colIndex].CanSelect)
			return;

		var cell = document.getElementById(this.id + "_cell_" + rowIndex + "_" + colIndex);
		if (!cell)
			return;

		if (select && this.SelectedRow > -1 && this.SelectedCol > -1 && (!this.FCanRangeSelect || !ctrlSelect)) {
			if (this.FCanRangeSelect && shiftSelect)
				this.deselectAllExceptFor(this.SelStartRow, this.SelStartCol);
			else
				this.deselectAll();
		}

		if (this.FCanRangeSelect && shiftSelect && this.SelStartRow > -1 && this.SelStartCol > -1) {
			var sr = this.SelStartRow;
			var sc = this.SelStartCol;
			var er = Math.max(rowIndex, this.SelStartRow);
			var ec = Math.max(colIndex, this.SelStartCol);
			for (var r = Math.min(sr, rowIndex); r <= er; ++r) {
				for (var c = Math.min(sc, colIndex); c <= ec; ++c) {
					if ((r != sr || c != sc) && (r != rowIndex || c != colIndex))
						this.selectCell(r, c, true, false, true);
				}
			}
		}

		if (select) {
			if (!this._selFieldContainsAndAdd(rowIndex, colIndex)) {
				cell.className += " selected";
				this._resetHeader();
			}

			this.SelectedCol = colIndex;
			this.SelectedRow = rowIndex;

			if (typeof (this.SelectedCells[rowIndex]) == "undefined")
				this.SelectedCells[rowIndex] = [colIndex];
			else
				this.SelectedCells[rowIndex].push(colIndex);
		}
		else {
			this._selFieldRemove(rowIndex, colIndex);
			cell.className = cell.className.replace(" selected", "");
			//if( JTIEVer == 7 )
			//	cell.style.paddingBottom = "0px";

			if (this.SelectedRow == rowIndex && this.SelectedCol == colIndex) {
				this.SelectedCol = -1;
				this.SelectedRow = -1;
			}

			if (typeof (this.SelectedCells[rowIndex]) != "undefined")
				this.SelectedCells[rowIndex].removeItem(colIndex);
		}

		if (!ctrlSelect && !shiftSelect && select) {
			this.SelStartCol = this.SelectedCol;
			this.SelStartRow = this.SelectedRow;
		}

		if (this.FOnSelect)
			this.FOnSelect(this, rowIndex, colIndex, select);
	}

	gridObject.deselectAllExceptFor = function( rowIndex, colIndex )
	{
		var selectField = document.getElementById( this.id + "_Selection" );
		var rows = safeSplit( selectField.value, "|" );
		var i, j, cols;
		for( i = 0; i < rows.length; ++i )
		{
			cols = safeSplit( rows[ i ], "," );
			/*
			var selCheck = document.getElementById( this.id + "_rs_" + rowIndex );
			if( selCheck && ( colIndex > -1 || rowIndex != i ) )
				selCheck.checked = false;
			*/
			if( this.FRowSelect )
			{
				if( cols[ 0 ] != rowIndex )
					this.selectRow( cols[ 0 ], false, false, false );
			}
			else
			{

				for( j = 1; j < cols.length; ++j )
				{
					if( cols[ 0 ] != rowIndex || ( colIndex > -1 && cols[ j ] != colIndex ) )
						this.selectCell( cols[ 0 ], cols[ j ], false, false, false );
				}
			}
		}
		var selectAllCheck = document.getElementById( this.id + "_SelectAll" );
		if( selectAllCheck )
			selectAllCheck.checked = false;
	}

	gridObject.deselectAll = function()
	{
		this.deselectAllExceptFor( -1, -1 );
	}

	gridObject.Sort = function( fieldName, direction )
	{
		this._execRequestor( "sort," + fieldName + " " + direction );
		return false;
	}

	gridObject.SortCustom = function( sortList )
	{
		this._execRequestor( "sort," + sortList );
		return false;
	}

	gridObject.Group = function( fieldName, direction )
	{
	}

	gridObject.Edit = function(rowIndex) {
		if (this.FReadOnly)
			return;
		if (this.FOnRowEditing && this.FOnRowEditing(this, rowIndex) == false)
			return;
		if (rowIndex == this.EditingRow)
			return;
		if (this.EditingRow != -1)
			this.Cancel();
		this.deselectAll();
		var row = document.getElementById(this.id + "_row_" + rowIndex);

		for (var i = 0; i < this.FEditableColumns.length; ++i) {
			if (!this.FEditableColumns[i].CanEdit)
				continue;

			var cell = document.getElementById(this.id + "_cell_" + rowIndex + "_" + i);
			var span = cell.getElementsByTagName("span")[0];
			var editor = document.getElementById(this.id + "_" + this.FEditableColumns[i].Name + "_Editor");
			var value = document.getElementById(this.id + "_cell_" + rowIndex + "_" + i + "_value");

			value = (value) ? value.innerHTML : span.innerHTML;

            this.setEditorValue(this.FEditableColumns[i].Name, value);
		}

		if (this.FEditorStyle == "Inline") {
			for (var i = 0; i < this.FEditableColumns.length; ++i) {
				var cell = document.getElementById(this.id + "_cell_" + rowIndex + "_" + i);
				var span = cell.getElementsByTagName("span")[0];
				if (!this.FEditableColumns[i].CanEdit)
					continue;
				span.style.display = "none";
				var editor = document.getElementById(this.id + "_" + this.FEditableColumns[i].Name + "_Editor");
				if (!editor)
					continue;
				var editorNode = document.getElementById(this.id + "_" + this.FEditableColumns[i].Name + "_Editor_outerdiv");
				if (!editorNode)
					editorNode = editor;
				editorNode.parentNode.removeChild(editorNode);
				cell.appendChild(editorNode);
				// editorNode.style.MozUserSelect = "";
			}
			var editCol = document.getElementById(this.id + "_editcol_" + rowIndex);
			if (editCol) {
				var spans = editCol.getElementsByTagName("span");
				spans[0].style.display = "none";
				spans[1].style.display = "block";
			}
		}
		else {
			row.className += " hidden";
			var editorCont = document.getElementById(this.id + "_editorform");
			editorCont.parentNode.removeChild(editorCont);
			row.parentNode.insertBefore(editorCont, row);
			editorCont.className = editorCont.className.replace(" hidden", "");
			// editorCont.style.MozUserSelect = "";
			// this._updateEndCol();
			//this._resetColumns();
			// this._updateColHeader();
		}
		this.EditingRow = rowIndex;
	}

	gridObject.Insert = function(defaultValues) {
		if (this.FReadOnly)
			return;
		if (this.EditingRow != -1)
			this.Cancel();
		var scrollerDiv = document.getElementById(this.id + "_ScrollerDiv");
		var tBody = document.getElementById(this.id + "_IntTableBody");
		if (this.FEditorStyle == "Inline") {
			var row = document.getElementById(this.id + "_row_-2");

			row.className = row.className.replace(" hidden", "");

			if (JTIEVer > -1) {
				var cell = row.getElementsByTagName("TD")[0];
				if (cell) {
					cell.className += " nothing";
					cell.className = cell.className.replace(" nothing", "");
				}
			}

			scrollerDiv.scrollTop = scrollerDiv.scrollHeight;
			tBody.scrollTop = tBody.scrollHeight;

			this.Edit(-2);
		}
		else {
			var editorCont = document.getElementById(this.id + "_editorform");
			var parent = editorCont.parentNode;
			parent.removeChild(editorCont);
			parent.appendChild(editorCont);
			editorCont.className = editorCont.className.replace(" hidden", "");
			this._resetColumns();
			this.EditingRow = -2;
		}

		for (var i = 0; i < this.FEditableColumns.length; ++i) {
			if (!this.FEditableColumns[i].CanEdit)
				continue;

			var value = null;
			if (typeof (defaultValues) != "undefined" && typeof (defaultValues[this.FEditableColumns[i].Name]) != "undefined")
				value = defaultValues[this.FEditableColumns[i].Name];

			this.setEditorValue(this.FEditableColumns[i].Name, value);
		}

		scrollerDiv.scrollTop = scrollerDiv.scrollHeight;
		tBody.scrollTop = tBody.scrollHeight;
	}

	gridObject.Post = function()
	{
		if( this.EditingRow == -1 )
			return;
		var row = document.getElementById( this.id + "_row_" + this.EditingRow );
		var pk = document.getElementById( this.id + "_row_" + this.EditingRow + "_pk" );
		var fieldvalues = new Object();
		if( this.FKeyField && pk )
			fieldvalues[ this.FKeyField ] = pk.innerHTML;
		for( var i = 0; i < this.FEditableColumns.length; ++i )
		{
			if( !this.FEditableColumns[i].CanEdit )
				continue;

            var editorValue = this.getEditorValue(this.FEditableColumns[i].Name);
            if (editorValue != null) {
                fieldvalues[this.FEditableColumns[i].DataField] = editorValue;
            }
		}
		if( this.EditingRow > -1 && this.FOnRowEdited )
		{
			var r = this.FOnRowEdited( this, this.EditingRow, fieldvalues );
			if( typeof( r ) != "undefined" && !r )
				return;
		}
		else if( this.EditingRow == -2 && this.FOnRowInserted )
		{
			var r = this.FOnRowInserted( this, fieldvalues );
			if( typeof( r ) != "undefined" && !r )
				return;
		}
		this._execRequestor( (this.EditingRow > -1) ? ("update," + this.EditingRow + "," + JTObjectToJSON(fieldvalues)) : ("insert," + JTObjectToJSON(fieldvalues)) );
	}

	gridObject.Cancel = function()
	{
		if( this.EditingRow == -1 )
			return;
		var row = document.getElementById( this.id + "_row_" + this.EditingRow );
		if( this.FEditorStyle == "Inline" )
		{
			for( var i = 0; i < this.FEditableColumns.length; ++i )
			{
				var cell = document.getElementById( this.id + "_cell_" + this.EditingRow + "_" + i );
				if( this.FEditableColumns[i].CanEdit )
				{
				    var span = cell.getElementsByTagName("span")[0];
				    span.style.display = "block";
					var editor = document.getElementById( this.id + "_" + this.FEditableColumns[i].Name + "_Editor" );
					if( !editor )
						continue;
					var editorNode = document.getElementById( this.id + "_" + this.FEditableColumns[i].Name + "_Editor_outerdiv" );
					var editorContainer = document.getElementById( this.id + "_editorcontainer" );
					if( !editorNode )
						editorNode = editor;
					editorNode.parentNode.removeChild(editorNode);
					editorContainer.appendChild(editorNode);
				}
			}
			var editCol = document.getElementById( this.id + "_editcol_" + this.EditingRow );
			if( editCol )
			{
				var spans = editCol.getElementsByTagName("span");
				spans[0].style.display = "block";
				spans[1].style.display = "none";
			}

			if( this.EditingRow == -2 )
				row.className += " hidden";
		}
		else {
			if (row)
				row.className = row.className.replace( " hidden", "" );
			var editorCont = document.getElementById( this.id + "_editorform" );
			editorCont.className += " hidden";
			if( JTIEVer > -1 && JTIEVer < 7 )
			{
				var parent = editorCont.parentNode;
				editorCont.parentNode.removeChild(editorCont);
				parent.appendChild(editorCont);
			}
		}
		this.EditingRow = -1;
	}

	gridObject.Delete = function( rowIndex )
	{
		var pk = document.getElementById( this.id + "_row_" + rowIndex + "_pk" );
		if( !pk )
			return;
		if (this.FOnRowDeleting && !this.FOnRowDeleting(this, rowIndex, pk.innerHTML))
			return;
		this._execRequestor( "delete," + JTObjectToJSON([pk.innerHTML]) );
	}

	gridObject.Command = function(rowIndex, colIndex, commandIndex) {
		var pk = document.getElementById(this.id + "_row_" + rowIndex + "_pk");
		if (this.FOnCommand && !this.FOnCommand(this, rowIndex, colIndex, commandIndex, pk.innerHTML))
			return;
		this._execRequestor("command," + rowIndex + "," + colIndex + "," + commandIndex + "," + JTObjectToJSON([pk.innerHTML]));
	}

    gridObject.CustomCommand = function(command, data) {
        if (this.FOnCustomCommand && this.FOnCustomCommand(this, command, data) === false)
			return;
		this._execRequestor( "custom," + command + "," + JTObjectToJSON([data]) );
		return false;
	}

	gridObject.ToFirstPage = function()
	{
		return this.ToPage( 0 );
	}

	gridObject.ToPage = function( pageNum )
	{
		this._execRequestor( "page," + pageNum );
		return false;
	}

	gridObject.ScrollCellIntoView = function( row, col )
	{
		var scrollerDiv = document.getElementById( this.id + "_ScrollerDiv" );
		var tHead = document.getElementById( this.id + "_IntTableHead" );
		var tBody = document.getElementById( this.id + "_IntTableBody" );
		var row = document.getElementById( this.id + "_row_" + row );
		var scroller;

		scroller = scrollerDiv;

		if( row.offsetTop > ( scroller.scrollTop + ( scroller.clientHeight - 20 ) ) )
			scroller.scrollTop = row.offsetTop - ( scroller.clientHeight - 20 );
		else if( row.offsetTop < ( scroller.scrollTop + tHead.offsetHeight + 20 ) )
			scroller.scrollTop = row.offsetTop - tHead.offsetHeight - 20;
	}

	gridObject.Refresh = function() {
		this._execRequestor("");
	}

	gridObject.getRowLevel = function( row )
	{
		var level = row.className.substr( row.className.indexOf( "level" ) + 5 );
		return parseInt( level );
	}

	gridObject.getCellHTML = function(row, col) {
		return document.getElementById(this.id + "_cell_" + row + "_" + col + "_c").innerHTML;
	}

	gridObject.getCellText = function(row, col) {
		var cell = document.getElementById(this.id + "_cell_" + row + "_" + col + "_c");
		if (typeof (cell.innerText) != "undefined")
			return cell.innerText;
		else if (typeof (cell.textContent) != "undefined")
			return cell.textContent;
		else
			return cell.innerHTML.replace(/<[^>]+>/g, "");
	}

	gridObject.getPrimaryKey = function(rowIndex) {
		var cell = document.getElementById(this.id + "_row_" + rowIndex + "_pk");
		return cell ? cell.innerHTML : "";
	}

	gridObject.getSelectedPrimaryKey = function() {
		return this.getPrimaryKey(this.SelectedRow);
	}

	gridObject.getEditorValue = function(columnName) {
	    var editor = document.getElementById( this.id + "_" + columnName + "_Editor" );
		if (editor) {
		    if (typeof(editor.getValue) != "undefined")
			    return editor.getValue();
		    else if (editor.tagName == "INPUT" && editor.type == "checkbox")
			    return ( editor.checked ? "1" : "0" );
		    else
			    return editor.value;
        }

        return null;
	}

	gridObject.setEditorValue = function(columnName, value) {
	    var editor = document.getElementById(this.id + "_" + columnName + "_Editor");
		if (!editor)
			return;

		if (typeof (editor.setValue) != "undefined") {
			editor.setValue((value != null) ? value : "");
		}
		else if (editor.tagName == "SELECT") {
			if (value != null) {
				for (var j = 0; j < editor.length; ++j) {
					if (editor.options[j].value == value) {
						editor.selectedIndex = j;
						break;
					}
				}
			}
			else {
				editor.selectedIndex = -1;
			}
		}
		else if (editor.tagName == "INPUT" && editor.type == "checkbox") {
		    editor.checked = !(value == null || value == "" || value == "0" || value.toLowerCase() == "false");
		}
		else {
			editor.value = (value != null) ? value : "";
		}
	}

	// Begin internal functions, avoid calling these directly.
	gridObject._scr = function( e, colIndex )
	{
		var event = e || window.event;
		this.FResizingCol = document.getElementById( this.id + "_header_" + colIndex );
		this.FResizingIndex = colIndex;
		if( !this.FResizingCol )
			return;
		this.style.MozUserSelect = "none";
		this.ondragstart = function() { return false; };
		this.onselectstart = function() { return false; };
		JTPlatinumGridResizing = this;
		addEvent( this, "mousemove", JTPlatinumGridMouseMove );
		addEvent( document, "mouseup", JTPlatinumGridEndColResize );

		event.cancelBubble = true;
		if( event.stopPropagation )
			event.stopPropagation();
	}

	gridObject._EndColResize = function(e) {
		this.FResizedCols[this.FEditableColumns[this.FResizingIndex].Name] = parseInt(document.getElementById(this.id + "_colitem_hdr_" + this.FResizingIndex).width);
		this.FResizedCols.json = false;
		document.getElementById(this.id + "_ColSizes").value = JTObjectToJSON(this.FResizedCols);
		this.style.MozUserSelect = "";
		this.ondragstart = null;
		this.onselectstart = null;
		this.FResizingCol = null;
		deleteEvent(this, "mousemove", JTPlatinumGridMouseMove);
		deleteEvent(document, "mouseup", JTPlatinumGridEndColResize);
		// this._updateColHeader();
		this._initFixedCols();
	}

	gridObject._MouseMove = function( e )
	{
		var event = e || window.event;
		if( this.FResizingCol )
		{
			var w = Math.max((getEventPageX(event) - getObjectScreenX(this.FResizingCol)) - 3, 0);
			if( w > 20 )
			{
				document.getElementById( this.id + "_colitem_hdr_" + this.FResizingIndex ).width = w + "px";

				var col = document.getElementById( this.id + "_header_" + this.FResizingIndex );
				if( JTIsWebKit || JTFFVer == 2 )
					col.style.width = w + "px";

				this._updateColHeader( false );
			}
		}
		else if( this.FMovingCol )
		{
			var cm = document.getElementById( this.id + "_ColMover" );
			var cp = document.getElementById( this.id + "_ColPositioner" );
			cm.style.left = ( getEventPageX( event ) - this.FMouseOffsetX - getObjectScreenX( this.FScrollerDiv ) ) + "px";
			cm.style.top = this.FHeaderOffset + ( getEventPageY( event ) - this.FMouseOffsetY - getObjectScreenY( this.FScrollerDiv ) ) + "px";
			cm.style.width = this.FMovingCol.offsetWidth + "px";
			cm.style.display = "block";
			var np = ( getEventPageX( event ) - getObjectScreenX( this.FScrollerDiv ) );
			var tp = -1;
			if( this.FGroupBar )
				tp = ( getEventPageY( event ) - getObjectScreenY( this.FGroupBar ) );
			var i, hdr = null;
			if( this.FGroupBar && tp > -1 && tp < this.FGroupBar.offsetHeight )
			{
				var groupCols = JTGetChildrenByTagName( JTLocateFirstChildByTagName( JTLocateFirstChildByTagName( JTLocateFirstChildByTagName( this.FGroupBar, "TABLE" ), "TBODY" ), "TR" ), "TD" );
				for( i = 0; i < groupCols.length; ++i )
				{
					hdr = groupCols[ i ];
					if( hdr.className.indexOf( "nogroups" ) > -1 )
						break;
					if( np <= ( hdr.offsetLeft + hdr.offsetWidth ) )
						break;
				}
				if( hdr )
				{
					if( i < groupCols.length )
						cp.style.left = hdr.offsetLeft + "px";
					else
						cp.style.left = ( hdr.offsetLeft + hdr.offsetWidth ) + "px";
					cp.style.height = this.FMovingCol.offsetHeight + "px";
					cp.style.display = "block";
					cp.style.top = this.FGroupBar.offsetTop + "px";
				}
				return;
			}
			for( i = 0; i <= this.FEditableColumns.length; ++i )
			{
				if( i < this.FEditableColumns.length )
				{
					hdr = document.getElementById( this.id + "_header_" + i );
					if( np <= ( hdr.offsetLeft + hdr.offsetWidth ) )
						break;
				}
				else
				{
					hdr = document.getElementById( this.id + "_header_" + ( i - 1 ) );
					if( np > ( hdr.offsetLeft + hdr.offsetWidth ) )
						break;
				}
			}
			if( hdr )
			{
				if( i < this.FEditableColumns.length )
					cp.style.left = hdr.offsetLeft + "px";
				else
					cp.style.left = ( hdr.offsetLeft + hdr.offsetWidth ) + "px";
				cp.style.height = this.FMovingCol.offsetHeight + "px";
				cp.style.display = "block";
				cp.style.top = this.FHeaderTop + "px";
			}
		}
		else if( this.FMovingGroup )
		{
			var cm = document.getElementById( this.id + "_ColMover" );
			var cp = document.getElementById( this.id + "_ColPositioner" );
			cm.style.left = ( getEventPageX( event ) - this.FMouseOffsetX - getObjectScreenX( this.FScrollerDiv ) ) + "px";
			cm.style.top = this.FHeaderOffset + ( getEventPageY( event ) - this.FMouseOffsetY - getObjectScreenY( this.FScrollerDiv ) ) + "px";
			cm.style.width = this.FMovingGroup.offsetWidth + "px";
			cm.style.display = "block";
			var np = ( getEventPageX( event ) - getObjectScreenX( this.FScrollerDiv ) );
			var tp = ( getEventPageY( event ) - getObjectScreenY( this.FGroupBar ) );
			var i, hdr = null;
			var groupCols = JTGetChildrenByTagName( JTLocateFirstChildByTagName( JTLocateFirstChildByTagName( JTLocateFirstChildByTagName( this.FGroupBar, "TABLE" ), "TBODY" ), "TR" ), "TD" );
			for( i = 0; i < groupCols.length; ++i )
			{
				hdr = groupCols[ i ];
				if( hdr.className.indexOf( "nogroups" ) > -1 )
					break;
				if( np <= ( hdr.offsetLeft + hdr.offsetWidth ) )
					break;
			}
			if( hdr )
			{
				if( i < groupCols.length )
					cp.style.left = hdr.offsetLeft + "px";
				else
					cp.style.left = ( hdr.offsetLeft + hdr.offsetWidth ) + "px";
				cp.style.height = this.FGroupBar.offsetHeight + "px";
				cp.style.display = "block";
				cp.style.top = this.FGroupBar.offsetTop + "px";
			}
		}
	}

	gridObject._dtcc = function (e, tbody) {
	    var cell = getEventTarget(e || window.event);
	    while (cell && ((cell.className.indexOf("cell") == -1 && cell.className.indexOf("sc") == -1) || cell.tagName != "TD")) {
	        cell = cell.parentNode;
	    }
	    this._cc(e, cell);
	}

	gridObject._cc = function(e, cell) {
		if (!this.FCanSelect)
			return;
		if (this.cancelCellClick) {
			this.cancelCellClick = false;
			return;
		}
		this.cancelCellClick = false;

		var event = e || window.event;
		var cellInfo = safeSplit(cell.id, "_");
		var row = cellInfo[cellInfo.length - 2];
		var col = cellInfo[cellInfo.length - 1];
		if (row == this.EditingRow)
			return;
		if (this.FRowSelect)
			this.SelectedCol = col;
		if (this.FRowSelect)
			this.selectRow(row, true, e.shiftKey, e.ctrlKey);
		else
			this.selectCell(row, col, true, e.shiftKey, e.ctrlKey);
	}

	gridObject._dtcdc = function (e, tbody) {
	    var cell = getEventTarget(e || window.event);
	    while (cell && (cell.className.indexOf("cell") == -1 || cell.tagName != "TD")) {
	        cell = cell.parentNode;
	    }
	    var cellInfo = safeSplit(cell.id, "_");
	    var row = cellInfo[cellInfo.length - 2];

	    this._cdc(row);
	}

	gridObject._cdc = function( rowIndex )
	{
		if( rowIndex > -1 )
			this.Edit( rowIndex );
	}

	gridObject._selFieldContainsAndAdd = function(rowIndex, colIndex) {
		var selectField = document.getElementById(this.id + "_Selection");
		var pkField = document.getElementById(this.id + "_PrimaryKeys");

		var i, key = this.getPrimaryKey(rowIndex);
		if (key != "") {
			var keys = safeSplit(pkField.value, "|");
			if (!inArray(keys, key)) {
				keys.push(key);
				pkField.value = keys.join("|");
			}
		}

		var rows = safeSplit(selectField.value, "|");
		var j, cols;
		for (i = 0; i < rows.length; ++i) {
			cols = safeSplit(rows[i], ",");
			var selRowIndex = cols[0];
			if (selRowIndex == rowIndex)
				break;
		}

		if (i >= rows.length) {
			rows.push(rowIndex + "," + colIndex);
			selectField.value = rows.join("|");
			return false;
		}

		for (j = 1; j < cols.length; ++j) {
			if (cols[j] == colIndex)
				break;
		}

		if (j < cols.length)
			return true;

		cols.push(colIndex);
		rows[i] = cols.join(",");
		selectField.value = rows.join("|");
		return false;
	}

	gridObject._selFieldRemove = function(rowIndex, colIndex) {
		var selectField = document.getElementById(this.id + "_Selection");
		var pkField = document.getElementById(this.id + "_PrimaryKeys");

		var i, key = this.getPrimaryKey(rowIndex);
		if (key != "") {
			var keys = safeSplit(pkField.value, "|");
			keys.removeItem(key);
			pkField.value = keys.join("|");
		}

		var rows = safeSplit(selectField.value, "|");
		var i, j, cols;
		for (i = 0; i < rows.length; ++i) {
			cols = safeSplit(rows[i], ",");
			var selRowIndex = cols[0];
			if (selRowIndex == rowIndex) {
				for (j = 0; j < cols.length; ++j) {
					if (cols[j] == colIndex) {
						cols.splice(j, 1);
						if (cols.length == 1)
							rows.splice(i, 1);
						else
							rows[i] = cols.join(",");
						selectField.value = rows.join("|");
						return;
					}
				}
			}
		}
	}

	gridObject._loadSelection = function() {
		var oldOnSelect = this.FOnSelect;
		var selectField = document.getElementById(this.id + "_Selection");
		var rows = safeSplit(selectField.value, "|");
		var i, j, cols;

		this.FOnSelect = null;
		this.deselectAll();
		selectField.value = "";

		for (i = 0; i < rows.length; ++i) {
			cols = safeSplit(rows[i], ",");
			var selRowIndex = cols[0];
			if (this.FRowSelect) {
				this.selectRow(selRowIndex, true, false, true);
			}
			else {
				for (j = 1; j < cols.length; ++j)
					this.selectCell(selRowIndex, cols[j], true, false, true);
			}
		}
		this.FOnSelect = oldOnSelect;
	}

	gridObject._scm = function( e, cell )
	{
		if( !this.FCanMoveCols )
			return;

		var event = e || window.event;
		this.FHeaderOffset = getObjectScreenY( this.FScrollerDiv ) - getObjectScreenY( this );
		this.FHeaderTop = getObjectScreenY( this.FHeaderDiv ) - getObjectScreenY( this );
		this.FMouseOffsetX = getEventPageX( event ) - getObjectScreenX( cell );
		this.FMouseOffsetY = getEventPageY( event ) - getObjectScreenY( cell );
		this.FMovingCol = cell;
		this.style.MozUserSelect = "none";
		this.ondragstart = function() { return false; };
		this.onselectstart = function() { return false; };
		JTPlatinumGridResizing = this;
		document.getElementById( this.id + "_ColMover" ).innerHTML = document.getElementById( cell.id + "_caption" ).innerHTML;
		addEvent( this, "mousemove", JTPlatinumGridMouseMove );
		addEvent( document, "mouseup", JTPlatinumGridEndColMove );

		event.cancelBubble = true;
		if( event.stopPropagation )
			event.stopPropagation();
	}

	gridObject._EndColMove = function(e) {
		var event = e || window.event;
		var np = (getEventPageX(event) - getObjectScreenX(this.FScrollerDiv)) + this.FScrollerDiv.scrollLeft;
		var i, tp = -1, col = this.FMovingCol;
		if (this.FGroupBar)
			tp = (getEventPageY(event) - getObjectScreenY(this.FGroupBar));

		this.style.MozUserSelect = "";
		this.ondragstart = null;
		this.onselectstart = null;
		this.FMovingCol = null;
		deleteEvent(this, "mousemove", JTPlatinumGridMouseMove);
		deleteEvent(document, "mouseup", JTPlatinumGridEndColMove);
		document.getElementById(this.id + "_ColMover").style.display = "none";
		document.getElementById(this.id + "_ColPositioner").style.display = "none";

		if (this.FGroupBar && tp > -1 && tp < this.FGroupBar.offsetHeight) {
			var groupCols = JTGetChildrenByTagName(JTLocateFirstChildByTagName(JTLocateFirstChildByTagName(JTLocateFirstChildByTagName(this.FGroupBar, "TABLE"), "TBODY"), "TR"), "TD");
			for (i = 0; i < groupCols.length; ++i) {
				if (groupCols[i].className.indexOf("nogroups") > -1) {
					i = groupCols.length;
					break;
				}
				if (np <= (groupCols[i].offsetLeft + groupCols[i].offsetWidth))
					break;
			}
			var pcs = safeSplit(this.FGroupBy, ",");
			var cs = col.id.split("_");
			pcs.splice(i, 0, this.FEditableColumns[cs[cs.length - 1]].DataField);
			this.FGroupBy = pcs.join(",");
			this._execRequestor("group," + this.FGroupBy);

			return;
		}

		for (i = 0; i < this.FEditableColumns.length; ++i) {
			var hdr = document.getElementById(this.id + "_header_" + i);
			if (np <= (hdr.offsetLeft + hdr.offsetWidth))
				break;
		}
		var cs = col.id.split("_");
		cs = cs[cs.length - 1];
		if (cs != i)
			this._execRequestor("movecol," + this.FEditableColumns[cs].Name + "," + i);
	}

	gridObject._resetHeader = function()
	{
		if( JTIEVer > 0 )
		{
			var ScrollerDiv = document.getElementById( this.id + "_ScrollerDiv" );
			var IntTable = document.getElementById( this.id + "_IntTable" );
			var tHead = JTLocateFirstChildByTagName( IntTable, "THEAD" );
			var rows = JTGetChildrenByTagName( tHead, "TR" );
			for( var i = 0; i < rows.length; ++i )
				rows[ i ].style.top = ScrollerDiv.scrollTop + "px";
		}
	}

	gridObject._initFixedCols = function()
	{
		var hasFixedCols = false;
		var ScrollerDiv = document.getElementById( this.id + "_ScrollerDiv" );
		var IntTable = document.getElementById( this.id + "_IntTable" );
		var tBody = JTLocateFirstChildByTagName( IntTable, "TBODY" );
		var first = true;
		if( tBody )
		{
			var rows = JTGetChildrenByTagName( tBody, "TR" );
			for( var i = 0; i < rows.length; ++i )
			{
				var cols = JTGetChildrenByTagName( rows[ i ], "TD" );
				for( var j = 0; j < cols.length; ++j )
				{
					var col = cols[ j ];
					if( col.className.indexOf( "noscrollcell" ) > -1 )
					{
						var div = JTLocateFirstChildByTagName( col, "DIV" );
						div.origLeft = ( col.offsetLeft - 1 );
						// div.style.top = ( col.offsetTop + tBody.offsetTop + ( ( JTIEVer < 7 && JTIEVer > -1 ) ? 0 : 0 ) + this.FHeaderDiv.offsetHeight ) + "px"; // +1 because of tBody top border.
						div.style.top = ( col.offsetTop ) + "px";
						if( JTIEVer > -1 && tBody.clientWidth == 0 )
							div.style.width = ( col.offsetWidth - ( first ? 11 : 11 ) ) + "px";	// -10 for div padding
						else
							div.style.width = ( col.offsetWidth - ( tBody.offsetWidth - tBody.clientWidth ) - 11 ) + "px";	// -10 for div padding
						div.style.height = ( col.offsetHeight - 5 ) + "px";
						div.style.left = ( col.offsetLeft - 1 ) + "px";

						hasFixedCols = true;
					}
				}

				first = false;
			}
		}
		this.FHasFixedCols = hasFixedCols;
		if( !hasFixedCols )
			return;

		var headerColRow = document.getElementById( this.id + "_HeaderTableColumnHeader" );
		var filterColRow = document.getElementById( this.id + "_FilterBar" );
		if( headerColRow )
		{
			var cols = JTGetChildrenByTagName( headerColRow, "TD" );
			var filterCols = ( filterColRow ? JTGetChildrenByTagName( filterColRow, "TD" ) : null );
			for( var j = 0; j < cols.length; ++j )
			{
				var col = cols[ j ];
				var filterCol = filterCols ? filterCols[j] : null;
				if( col.className.indexOf( "noscrollhdr" ) > -1 )
				{
					var div = document.getElementById( col.id + "_fixedhdr" );
					if( !div )
					{
						var table = JTLocateFirstChildByTagName( col, "TABLE" );
						div = document.createElement( "div" );
						div.id = col.id + "_fixedhdr";
						div.className = "noscrollhdrdiv";
						div.style.position = "absolute";
						div.style.top = col.offsetTop + "px";
						div.style.left = col.offsetLeft + "px";
						div.style.width = ( col.offsetWidth - 4 ) + "px";
						div.style.height = ( col.offsetHeight - 6 ) + "px";
						// col.removeChild( table );
						div.appendChild( table.cloneNode( true ) );
						col.appendChild( div );

						if( filterCol )
						{
							var filterDiv = document.createElement( "div" );
							filterDiv.id = filterCol.id + "_fixedfilter";
							filterDiv.className = "noscrollfilterdiv";
							filterDiv.style.position = "absolute";
							filterDiv.style.top = ( filterCol.offsetTop ) + "px";
							filterDiv.style.left = filterCol.offsetLeft + "px";
							filterDiv.style.width = ( filterCol.offsetWidth - 3 ) + "px";
							filterDiv.style.height = ( filterCol.offsetHeight - JTPlatinumGridTheme.FilterHeightOffset ) + "px";
							filterDiv.innerHTML = filterCol.innerHTML;
							filterCol.innerHTML = "";
							filterCol.appendChild( filterDiv );
						}
					}
					else
					{
						div.style.width = ( col.offsetWidth - 4 ) + "px";
						div.style.height = ( col.offsetHeight - 6 ) + "px";
					}
				}
			}
		}

		if( JTIEVer < 0 )
			this._updateGridHeight();

		return ( hasFixedCols && JTIEVer < 0 );
	}

	gridObject._updateFixedColPositions = function()
	{
		if( this.FTBody && this.FHasFixedCols )
		{
			var rows = JTGetChildrenByTagName( this.FTBody, "TR" );
			for( var i = 0; i < rows.length; ++i )
			{
				var cols = JTGetChildrenByTagName( rows[ i ], "TD" );
				for( var j = 0; j < cols.length; ++j )
				{
					var col = cols[ j ];
					if( col.className.indexOf( "noscrollcell" ) > -1 )
					{
						var div = JTLocateFirstChildByTagName( col, "DIV" );
						div.style.left = ( div.origLeft + this.FScrollerDiv.scrollLeft ) + "px";
					}
				}
			}
		}
	}

	gridObject._updateGridHeight = function () {
	    var ScrollerDiv = document.getElementById(this.id + "_ScrollerDiv");
	    var IntTable = document.getElementById(this.id + "_IntTable");
	    var Header = document.getElementById(this.id + "_Header");
	    var summary = document.getElementById(this.id + "_SummaryCont");
	    var outerNode = getOuterNode(this);
	    if (this.offsetWidth == 0)
	        return;

	    if (this.FAllowScrolling) {
	        if (JTIEVer < 7 && JTIEVer > -1) {
	            this.style.width = "100%";
	            Header.style.width = "100%";
	            ScrollerDiv.parentNode.style.setExpression("width", "parentNode.clientWidth");
	            ScrollerDiv.parentNode.style.position = "relative";
	            ScrollerDiv.parentNode.style.overflow = "hidden";
	            ScrollerDiv.style.width = "100%";
	        }

	        this._setScrollerDivHeight(outerNode, Header, summary, ScrollerDiv);

	        this._updateColHeader(true);

	        this._setScrollerDivHeight(outerNode, Header, summary, ScrollerDiv);

	        IntTable.style.tableLayout = "fixed";
	    }
	    else {
	        this.style.height = "";
	    }
	}

    gridObject._setScrollerDivHeight = function (outerNode, Header, summary, ScrollerDiv) {
        if (outerNode) {
            var h = 0;
            var children = JTGetChildrenByTagName(this, "DIV");
            for (var i = 0; i < children.length; ++i) {
                if ((children[i].className == "toppager" && children[i].getElementsByTagName("DIV").length > 0) || children[i].className == "pager" || children[i].className == "groupbar" || children[i].className == "cmdbar") {
                    h += children[i].offsetHeight;
                }
            }
            if (summary) {
                h += summary.offsetHeight;
            }
            ScrollerDiv.style.height = (outerNode.offsetHeight - h - Header.offsetHeight) + "px";
            // FF bug.
            if (ScrollerDiv.className.indexOf("bugfixer") > -1)
                ScrollerDiv.className = ScrollerDiv.className.replace(" bugfixer", "");
            else
                ScrollerDiv.className += " bugfixer";
        }
    }

    gridObject._updateColHeader = function (updateHeader) {
        if (!this.FAllowScrolling)
            return;

        var ScrollerDiv = document.getElementById(this.id + "_ScrollerDiv");
        var IntTable = document.getElementById(this.id + "_IntTable");
        var Header = document.getElementById(this.id + "_Header");
        var HeaderTable = document.getElementById(this.id + "_HeaderTable");
        var HeaderTableColumnRow = document.getElementById(this.id + "_HeaderTableColumnHeader");
        var tHead = JTLocateFirstChildByTagName(IntTable, "THEAD");
        var tBody = JTLocateFirstChildByTagName(IntTable, "TBODY");
        var summary = document.getElementById(this.id + "_Summary");
        var outerNode = getOuterNode(this);
        var scrollerDivClientWidth;
        var intTableOffsetWidth;

        if (HeaderTableColumnRow) {
            var headerPaddingWidth = 0;
            var headerWidthAdjust = 0;
            var rowPaddingWidth = 0;
            if (JTIEVer > -1 && JTIEVer < 8) {
                headerPaddingWidth = (JTIEVer > 6) ? 3 : 4;
                headerWidthAdjust = 0;
                rowPaddingWidth = (JTIEVer > 6) ? 3 : 4;
            }

            var totalHeaderWidth = 0;
            var totalDataWidth = 0;
            var headerColPrefix = this.id + "_header_";
            var tw = 0;
            var cols = JTGetChildrenByTagName(HeaderTableColumnRow, "TD");

            this._readColWidths(updateHeader, headerColPrefix, headerPaddingWidth, rowPaddingWidth, cols);

            IntTable.style.tableLayout = "fixed";
            HeaderTable.style.tableLayout = "fixed";

            var headerCol = document.getElementById(this.id + "_SelectColHeader");
            if (headerCol) {
                var rowColDef = document.getElementById(this.id + "_colitem_body_select");
                var headerColDef = document.getElementById(this.id + "_colitem_hdr_select");
                if (rowColDef && headerColDef) {
                    w = 24;

                    if (updateHeader) {
                        headerColDef.width = w - headerWidthAdjust;
                    }

                    rowColDef.width = w;
                    totalHeaderWidth += w - headerWidthAdjust;
                    totalDataWidth += w;
                }
            }

            for (var i = 0; i < cols.length; ++i) {
                headerCol = cols[i];
                if (headerCol.id.substr(0, headerColPrefix.length) == headerColPrefix && headerCol.className.indexOf("novisible") == -1) {
                    var rowColID = headerCol.id.substr(headerColPrefix.length);
                    var rowCol = document.getElementById(this.id + "_cell_0_" + rowColID);
                    var rowColDef = document.getElementById(this.id + "_colitem_body_" + rowColID);
                    var headerColDef = document.getElementById(this.id + "_colitem_hdr_" + rowColID);
                    var summary = document.getElementById(this.id + "_ColAgg_" + rowColID);
                    if (rowColDef && headerColDef) {
                        // Added "padding" fix for IE, seems to need it.
                        w = headerCol.pgWidth;

                        if (updateHeader) {
                            var headerWidth = Math.max(w - headerWidthAdjust, 1);
                            headerColDef.width = headerWidth;
                            headerCol.style.width = (JTIsWebKit ? (headerWidth + "px") : "");

                            if (summary) {
                                summary.style.width = headerWidth + "px";
                            }
                        }

                        var rowWidth = Math.max(w, 1);
                        rowColDef.width = rowWidth;
                        if ((JTIsWebKit || JTFFVer == 2) && rowCol)
                            rowCol.style.width = rowWidth + "px";

                        totalHeaderWidth += Math.max(w - headerWidthAdjust, 1);
                        totalDataWidth += Math.max(w, 1);
                    }
                }
            }

            headerCol = document.getElementById(this.id + "_EditColHeader");
            if (headerCol) {
                var rowColDef = document.getElementById(this.id + "_colitem_body_edit");
                var headerColDef = document.getElementById(this.id + "_colitem_hdr_edit");
                if (rowColDef && headerColDef) {
                    if (updateHeader)
                        headerColDef.width = "126px";

                    rowColDef.width = "126px";

                    totalHeaderWidth += 126;
                    totalDataWidth += 126;
                }
            }

            HeaderTable.style.width = "";
            IntTable.style.width = totalDataWidth + "px";

            headerCol = document.getElementById(this.id + "_Phc");
            if (headerCol) {
                headerCol.style.width = "0";
                headerCol.style.display = "none";

                var width;

                if (JTIEVer > -1 && JTIEVer < 8)
                    width = Math.max(Header.offsetWidth - totalHeaderWidth, ScrollerDiv.offsetWidth - ScrollerDiv.clientWidth);
                else
                    width = Math.max(Header.offsetWidth - HeaderTable.offsetWidth, 0) + (ScrollerDiv.offsetWidth - ScrollerDiv.clientWidth);

                if (width > 0) {
                    headerCol.style.display = "";
                    headerCol.style.width = (width) + "px";

                    totalHeaderWidth += width;

                    // Force IE to re-evaluate the cell and make it appear.
                    if (JTIEVer > -1 && JTIEVer < 8) {
                        headerCol.style.display = "none";
                        headerCol.style.display = "block";

                        var filterSpacer = document.getElementById(this.id + "_phcfl");
                        if (filterSpacer) {
                            filterSpacer.style.display = "none";
                            filterSpacer.style.display = "block";
                        }
                    }
                }
            }

            HeaderTable.style.width = totalHeaderWidth + "px";
        }

        var row = document.getElementById(this.id + "_row_0");
        if (row) {
            var endCol = JTLocateFirstChildByClassName(row, "pcc");
            if (endCol) {
                endCol.style.width = "0";
                endCol.style.display = "none";

                var width = ScrollerDiv.clientWidth - IntTable.offsetWidth;
                if (width > 0) {
                    endCol.style.display = "";
                    endCol.style.width = width + "px";
                }
            }
        }
    }

    gridObject._readColWidths = function (updateHeader, headerColPrefix, headerPaddingWidth, rowPaddingWidth, cols) {
        document.getElementById(this.id + "_ScrollerDiv").offsetWidth;

        for (var i = 0; i < cols.length; ++i) {
            var headerCol = cols[i];
            if (headerCol.id.substr(0, headerColPrefix.length) == headerColPrefix && headerCol.className.indexOf("novisible") == -1) {
                var rowColID = headerCol.id.substr(headerColPrefix.length);
                var rowCol = document.getElementById(this.id + "_cell_0_" + rowColID);
                var rowColDef = document.getElementById(this.id + "_colitem_body_" + rowColID);
                var headerColDef = document.getElementById(this.id + "_colitem_hdr_" + rowColID);
                if (rowColDef && headerColDef) {
                    hw = headerCol.offsetWidth - headerPaddingWidth;
                    if (!updateHeader || !rowCol) {
                        w = hw;
                    }
                    else {
                        w = Math.max(rowCol.offsetWidth - rowPaddingWidth, hw);
                    }

                    headerCol.pgWidth = w;
                }
            }
        }
    }

	gridObject._resetColumns = function()
	{
		if( !this.FAllowScrolling )
			return;

		var HeaderTableColumnRow = document.getElementById( this.id + "_HeaderTableColumnHeader" );

		if( HeaderTableColumnRow )
		{
			var headerCol = document.getElementById( this.id + "_SelectColHeader" );
			if( headerCol )
			{
				var headerColDef = document.getElementById( this.id + "_colitem_hdr_select" );
				if( headerColDef )
					headerColDef.width = 25;
			}

			var headerColPrefix = this.id + "_header_";
			var cols = JTGetChildrenByTagName( HeaderTableColumnRow, "TD" );
			for( var i = 0; i < cols.length; ++i )
			{
				headerCol = cols[ i ];
				if( headerCol.id.substr( 0, headerColPrefix.length ) == headerColPrefix && headerCol.className.indexOf( "novisible" ) == -1 )
				{
					var rowColID = headerCol.id.substr( headerColPrefix.length );
					var headerColDef = document.getElementById( this.id + "_colitem_hdr_" + rowColID );
					if( headerColDef )
						headerColDef.width = "";
				}
			}

			headerCol = document.getElementById( this.id + "_EditColHeader" );
			if( headerCol )
			{
				var headerColDef = document.getElementById( this.id + "_colitem_hdr_edit" );
				if( headerColDef )
					headerColDef.width = "127";
			}
		}

		//this._updateEndCol();
		this._updateColHeader( true );
	}

	gridObject._HeaderClick = function( e, colFieldName, otherSortDirection )
	{
		var event = e || window.event;
		var i, curSort = safeSplit( this.FSortBy, "," );
		for( i = 0; i < curSort.length; ++i )
		{
			var colSort = curSort[ i ].trim();
			var pieces = colSort.split( /\s+/, 2 );
			if( pieces[ 0 ] == colFieldName )
				break;
		}
		if( i < curSort.length )
		{
			curSort[ i ] = colFieldName + " " + otherSortDirection;
			this.FSortBy = curSort.join( "," );
		}
		else
		{
			if( event.shiftKey )
			{
				if( this.FSortBy.length > 0 )
					this.FSortBy += ",";
				this.FSortBy += colFieldName + " " + otherSortDirection;
			}
			else
			{
				this.FSortBy = colFieldName + " " + otherSortDirection;
			}
		}
		this.SortCustom( this.FSortBy );
		return false;
	}

	gridObject._startGroupMove = function( e, cellSpan, cellID )
	{
		var event = e || window.event;
		var cell = document.getElementById( cellID );
		this.FHeaderOffset = getObjectScreenY( this.FScrollerDiv ) - getObjectScreenY( this );
		this.FMouseOffsetX = getEventPageX( event ) - getObjectScreenX( cell );
		this.FMouseOffsetY = getEventPageY( event ) - getObjectScreenY( cell );
		this.FMovingGroup = cell;
		this.style.MozUserSelect = "none";
		this.FGroupBar.style.MozUserSelect = "none";
		this.ondragstart = function() { return false; };
		this.onselectstart = function() { return false; };
		JTPlatinumGridResizing = this;
		document.getElementById( this.id + "_ColMover" ).innerHTML = cellSpan.innerHTML;
		addEvent( this, "mousemove", JTPlatinumGridMouseMove );
		addEvent( document, "mouseup", JTPlatinumGridEndGroupMove );

		event.cancelBubble = true;
		if( event.stopPropagation )
			event.stopPropagation();
		return false;
	}

	gridObject._endGroupMove = function( e )
	{
		var event = e || window.event;
		var np = ( getEventPageX( event ) - getObjectScreenX( this.FScrollerDiv ) );
		var i, colIndex, col = this.FMovingGroup;

		this.style.MozUserSelect = "";
		this.FGroupBar.style.MozUserSelect = "";
		this.ondragstart = null;
		this.onselectstart = null;
		this.FMovingGroup = null;
		deleteEvent( this, "mousemove", JTPlatinumGridMouseMove );
		deleteEvent( document, "mouseup", JTPlatinumGridEndGroupMove );
		document.getElementById( this.id + "_ColMover" ).style.display = "none";
		document.getElementById( this.id + "_ColPositioner" ).style.display = "none";

		var tp = ( getEventPageY( event ) - getObjectScreenY( this.FGroupBar ) );
		var groupCols = JTGetChildrenByTagName( JTLocateFirstChildByTagName( JTLocateFirstChildByTagName( JTLocateFirstChildByTagName( this.FGroupBar, "TABLE" ), "TBODY" ), "TR" ), "TD" );
		for( colIndex = 0; colIndex < groupCols.length; ++colIndex )
		{
			if( groupCols[ colIndex ].id == col.id )
				break;
		}
		if( colIndex >= groupCols.length )
			return;

		if( tp < 0 || tp > this.FGroupBar.offsetHeight )
		{
			var curSort = safeSplit( this.FGroupBy, "," );
			if( colIndex < curSort.length )
			{
				curSort.splice( colIndex, 1 );
				this._groupCommand( curSort.join( "," ) );
			}
		}
		else
		{
			var hdr = null;
			for( i = 0; i < groupCols.length; ++i )
			{
				hdr = groupCols[ i ];
				if( hdr.className.indexOf( "nogroups" ) > -1 )
					break;
				if( np <= ( hdr.offsetLeft + hdr.offsetWidth ) )
					break;
			}
			if( hdr )
			{
				var curSort = safeSplit( this.FGroupBy, "," );
				var groupData;
				if( colIndex < curSort.length && colIndex != i )
				{
					groupData = curSort.splice( colIndex, 1 );
					curSort.splice( i, 0, groupData[ 0 ] );
					this._groupCommand( curSort.join( "," ) );
				}
			}
		}
	}

	gridObject._groupCommand = function( groupBy )
	{
		document.getElementById( this.id + "_Selection" ).value = "";
		this._execRequestor( "group," + groupBy );
	}

	gridObject._groupClick = function( fieldName, direction )
	{
		var curSort = safeSplit( this.FGroupBy, "," );
		var i;
		for( i = 0; i < curSort.length; ++i )
		{
			var colSort = curSort[ i ].trim();
			var pieces = colSort.split( /\s+/, 2 );
			if( pieces[ 0 ] == fieldName )
				break;
		}
		if( i < curSort.length )
		{
			curSort[ i ] = fieldName + " " + direction;
			this._groupCommand( curSort.join( "," ) );
		}
		else
		{
			this._groupCommand( fieldName + " " + direction );
		}
	}

	gridObject._expCollapseGroup = function( cell, rowIndex )
	{
		var o, r = document.getElementById( this.id + "_grouprow_" + rowIndex );
		o = ( cell.className.indexOf( "expanded" ) > -1 );
		if( o )
			cell.className = "groupexpcolcell collapsed";
		else
			cell.className = "groupexpcolcell expanded";
		var i = r.className.indexOf( "grouplevel" );
		var curLevel = parseInt( r.className.substr( i + 10 ) );

		while( ( r = r.nextSibling ) )
		{
			if( r.nodeType == 1 )
			{
				if( r.className.indexOf( "grouprow" ) > -1 )
				{
					i = r.className.indexOf( "grouplevel" );
					var rowLevel = parseInt( r.className.substr( i + 10 ) );
					if( rowLevel <= curLevel )
						break;

					var cells = r.getElementsByTagName( "TD" );
					for( i = 0; i < cells.length; ++i )
					{
						cell = cells[ i ];
						if( cell.className.indexOf( "groupexpcolcell" ) == -1 )
							continue;

						if( o )
							cell.className = "groupexpcolcell collapsed";
						else
							cell.className = "groupexpcolcell expanded";
					}
				}

				if( o )
					r.style.display = "none";
				else
					r.style.display = "";
			}
		}
	}

	gridObject._delayFilterFire = function()
	{
		if( this.FFilterTimeout )
			clearTimeout( this.FFilterTimeout );

		this.FFilterTimeout = setTimeout(this.id + "._execRequestor('');", this.FFilterDelayTimeout);
	}

	gridObject._txtFilterKeyDown = function(input, e) {
		var event = e || window.event;
		var kc = event.charCode || event.keyCode;

		if (this.FFilterTimeout)
			clearTimeout(this.FFilterTimeout);

		if (kc == 0x0D) {
			this._execRequestor("");
			return false;
		}
		else if (this.FFilterDelay)
			this._delayFilterFire();
	}

	gridObject._txtFilterFocus = function( input )
	{
		input.lastValue = input.value;
	}

	gridObject._txtFilterBlur = function(input) {
		if (input.value != input.lastValue) {
			if (this.FFilterTimeout)
				clearTimeout(this.FFilterTimeout);
			if (this.FFilterDelay)
				this._execRequestor("");
		}
	}

	gridObject._txtFilterMethodChange = function( select, e, filterName )
	{
		if( this.FFilterTimeout )
			clearTimeout( this.FFilterTimeout );
		this._execRequestor( "" );
	}

	gridObject._boolFilterClick = function( input, e )
	{
		this._execRequestor( "" );
	}

	gridObject._cellExpand = function(e, span, cellID, rowIndex) {
		if (this.FParentField) {
			var collapse = (span.className.indexOf("collapsed") == -1);
			var row = document.getElementById(this.id + "_row_" + rowIndex);
			var rowLevel = this.getRowLevel(row);
			var nr = row;
			while ((nr = nr.nextSibling)) {
				if (nr.nodeType == 1 && nr.tagName == "TR") {
					if (this.getRowLevel(nr) > rowLevel) {
						if (collapse)
							nr.style.display = "none";
						else
							nr.style.display = "";
					}
					else {
						break;
					}
				}
			}
			if (collapse) {
				span.className = span.className.replace(" expanded", "");
				span.className += " collapsed";
			}
			else {
				span.className = span.className.replace(" collapsed", "");
				span.className += " expanded";
			}
		}
		else {
			var detailKey;

			if (span.className.indexOf("collapsed") > -1)
				detailKey = document.getElementById(this.id + "_row_" + rowIndex + "_dr").innerHTML;
			else
				detailKey = "";

			this._cc(e, document.getElementById(cellID));
			this._execRequestor("detail," + detailKey);
		}
	}

	gridObject._keyDown = function( e )
	{
		var event = e || window.event;
		var tagName = getEventTarget( event ).tagName;
		if( tagName == "INPUT" || tagName == "SELECT" || tagName == "TEXTAREA" )
			return;

		var kc = event.keyCode;

		this.SelectedCol = parseInt(this.SelectedCol);
		this.SelectedRow = parseInt(this.SelectedRow);

		if( this.SelectedRow < 0 )
			this.selectCell( 0, 0, true, false, false );
		else if( !this.FRowSelect && kc == 37 && this.SelectedCol > 0 )
			this.selectCell(this.SelectedRow, this.SelectedCol - 1, true, event.shiftKey, event.ctrlKey);
		else if( kc == 38 && this.SelectedRow > 0 )
			this.selectCell(this.SelectedRow - 1, this.SelectedCol, true, event.shiftKey, event.ctrlKey);
		else if( !this.FRowSelect && kc == 39 && this.SelectedCol < ( this.FEditableColumns.length - 1 ) )
			this.selectCell(this.SelectedRow, this.SelectedCol + 1, true, event.shiftKey, event.ctrlKey);
		else if( kc == 40 && this.SelectedRow < ( this.FVisibleRowCount - 1 ) )
			this.selectCell(this.SelectedRow + 1, this.SelectedCol, true, event.shiftKey, event.ctrlKey);
		else
			return false;

		this.ScrollCellIntoView( this.SelectedRow, this.SelectedCell );

		if( event.stopPropagation )
			event.stopPropagation();
		if( event.preventDefault )
			event.preventDefault();

		return false;
	}

	gridObject._tBodyMouseDown = function( e )
	{
		var event = e || window.event;
		var tagName = getEventTarget( event ).tagName;
		if( tagName == "INPUT" || tagName == "SELECT" || tagName == "TEXTAREA" )
			return;
		this.FMouseOffsetX = getEventPageX( event ) - getObjectScreenX( this ) + this.FScrollerDiv.scrollLeft;
		this.FMouseOffsetY = getEventPageY( event ) - getObjectScreenY( this );
		this.tBodyOffsetX = getObjectScreenX( this.FTBody ) - getObjectScreenX( this );
		this.tBodyOffsetY = getObjectScreenY( this.FTBody ) - getObjectScreenY( this );
		if( this.FMouseOffsetX > ( this.FTable.clientWidth - this.tBodyOffsetX ) )
			return;
		//this.style.MozUserSelect = "none";
		this.ondragstart = function() { return false; };
		this.onselectstart = function() { return false; };
		JTPlatinumGridResizing = this;
		addEvent( this.FTBody, "mousemove", JTPlatinumGridTBodyMouseMove );
		addEvent( document, "mouseup", JTPlatinumGridTBodyMouseUp );
		event.cancelBubble = true;
		if( event.stopPropagation )
			event.stopPropagation();
	}

	gridObject._tBodyMouseMove = function( e )
	{
		var event = e || window.event;
		var cm = document.getElementById( this.id + "_DragSelect" );
		var sx = this.FMouseOffsetX;
		var sy = this.FMouseOffsetY;
		var ex = getEventPageX( event ) - getObjectScreenX( this ) + this.FScrollerDiv.scrollLeft;
		var ey = getEventPageY( event ) - getObjectScreenY( this );
		var l = Math.min( sx, ex );
		var t = Math.min( sy, ey );
		var w = Math.abs( ex - sx );
		var h = Math.abs( ey - sy );
		l = Math.max( this.tBodyOffsetX, l );
		t = Math.max( this.tBodyOffsetY, t );
		w = Math.min( this.FTBody.offsetWidth - ( l - this.tBodyOffsetX ), w );
		h = Math.min( this.FTBody.offsetHeight - ( t - this.tBodyOffsetY ), h );
		cm.style.left = l - this.FScrollerDiv.scrollLeft + "px";
		cm.style.top = t + "px";
		cm.style.width = w + "px";
		cm.style.height = h + "px";
		cm.style.display = "block";
	}

	gridObject._tBodyMouseUp = function( e )
	{
		var event = e || window.event;
		var sx = this.FMouseOffsetX;
		var sy = this.FMouseOffsetY;
		var ex = getEventPageX( event ) - getObjectScreenX( this ) + this.FScrollerDiv.scrollLeft;
		var ey = getEventPageY( event ) - getObjectScreenY( this );
		//this.style.MozUserSelect = "";
		this.ondragstart = null;
		this.onselectstart = null;
		this.FMovingCol = null;
		deleteEvent( this.FTBody, "mousemove", JTPlatinumGridTBodyMouseMove );
		deleteEvent( document, "mouseup", JTPlatinumGridTBodyMouseUp );
		var ds = document.getElementById( this.id + "_DragSelect" );
		var l = ( ds.offsetLeft - this.tBodyOffsetX ) + this.FScrollerDiv.scrollLeft;
		var t = ds.offsetTop;
		if( this.FScrollerDiv )
			t -= getObjectScreenY( this.FScrollerDiv ) - getObjectScreenY( this );
		var r = l + ds.offsetWidth;
		var b = t + ds.offsetHeight;
		ds.style.display = "none";
		var rows = JTGetChildrenByTagName( this.FTBody, "TR" );
		var sct = this.FScrollerDiv.scrollTop;
		var inSelRow = false;
		var ctl = event.ctrlKey;
		var rowCount = Math.min( this.FVisibleRowCount, rows.length );
		if( Math.abs( ex - sx ) <= 10 && Math.abs( ey - sy ) <= 10 )
			return;
		if( !ctl )
			this.deselectAll();

		for( var i = 0; i < rowCount; ++i )
		{
			var row = document.getElementById( this.id + "_row_" + i );/*rows[ i ]*/;
			var rt = row.offsetTop;
			var rb = ( row.offsetTop + row.offsetHeight );
			if( rt <= t && rb >= t )
				inSelRow = true;

			if( inSelRow )
			{
				if( this.FRowSelect )
				{
					this.selectRow( i, true, false, true );
				}
				else
				{
					var inSelCell = false;
					for( var c = 0; c < this.FEditableColumns.length; ++c )
					{
						var cell = document.getElementById( this.id + "_cell_" + i + "_" + c );
						if( !cell )
							continue;
						if( cell.offsetLeft <= l && ( cell.offsetLeft + cell.offsetWidth ) >= l )
							inSelCell = true;

						if( inSelCell )
						{
							this.selectCell( i, c, true, false, ctl );
							ctl = true;
						}

						if( cell.offsetLeft <= r && ( cell.offsetLeft + cell.offsetWidth ) >= r )
						{
							inSelCell = false;
							break;
						}
					}
				}

				ctl = true;
			}

			if( rt <= b && rb >= b )
			{
				inSelRow = false;
				break;
			}
		}
		if( Math.abs( ex - sx ) > 10 || Math.abs( ey - sy ) > 10 )
			this.cancelCellClick = true;
	}

	gridObject._divScroll = function()
	{
		var hdr = document.getElementById( this.id + "_Header" );
		hdr.scrollLeft = this.FScrollerDiv.scrollLeft;
		if( this.FHasFixedCols && this.lastScrollLeft != this.FScrollerDiv.scrollLeft )
		{
			this._updateFixedColPositions();
			this.lastScrollLeft = this.FScrollerDiv.scrollLeft;
		}
	}

	gridObject._editorKeyPress = function(e)
	{
		var event = e || window.event;
		var kc = event.keyCode;
		if( kc == 27 )
			this.Cancel();
	}

	gridObject._showWaitWindow = function()
	{
		var ww = document.getElementById( this.id + "_wait" );
		if( ww )
			ww.style.display = "block";
	}

	gridObject._onResize = function () {
	    if (this.FLoaded) {
	        this._updateColHeader(true);
	    }
	}

	gridObject._execRequestor = function( action )
	{
		for( var c = 0; c < gridObject.FEditableColumns.length; ++c )
		{
			var txtField = document.getElementById( gridObject.id + "_" + gridObject.FEditableColumns[ c ].Name + "_Filter" );
			if( txtField )
				txtField.onblur = null;
		}
		this.FCommand.value = action;
		this.FRequestor();
		this.FCommand.value = "";
	}

	gridObject.onParentDisplayChange = function () {
	    this.Load();
	}

    gridObject.onAnchorResize = function () {
        if (typeof(event) == "undefined" || (event && event.type != "load")) {
            this._updateGridHeight();
        }
    }

    jQuery(".cmdbar a", gridObject).click(function (e) {
        var cmd = jQuery(this).attr("cmd");
        if (cmd == "insert") {
            gridObject.Insert();
        }
        else if (cmd == "refresh") {
            gridObject.Refresh();
        }
        else if (cmd == "exportcsv" || cmd == "exportpdf" || cmd == "exportxls" || cmd == "print") {
            gridObject._execRequestor(cmd);
        }
        else {
            gridObject.CustomCommand(cmd, "");
        }

        e.preventDefault();
        return false;
    });

    jQuery(".pager a", gridObject).click(function (e) {
        gridObject.ToPage(jQuery(this).attr("page"));

        e.preventDefault();
        return false;
    });

	addEvent( window, "resize", function() { gridObject._onResize(); } );

	/*if( JTPageLoaded )
		gridObject.Load();
	else
	 	JTPlatinumGrids.push( gridObject );*/

	registerForDisplayChange(gridObject);

	window[gridID]= gridObject;
}

function JTPlatinumGridOnLoad()
{
	while( JTPlatinumGrids.length > 0 )
	{
		JTPlatinumGrids[ 0 ].Load();
		JTPlatinumGrids.shift();
	}
}

function JTPlatinumGridMouseMove( e )
{
	JTPlatinumGridResizing._MouseMove( e );
}

function JTPlatinumGridEndColResize( e )
{
	JTPlatinumGridResizing._EndColResize( e );
}

function JTPlatinumGridEndColMove( e )
{
	JTPlatinumGridResizing._EndColMove( e );
}

function JTPlatinumGridEndGroupMove( e )
{
	JTPlatinumGridResizing._endGroupMove( e );
}

function JTPlatinumGridKeyDown( e )
{
	var event = e || window.event;
    var target = getEventTarget( event );
    var gridID = target.id.split( "_" )[ 0 ];
    var gridObject = document.getElementById( gridID );

    if( gridObject )
		return gridObject._keyDown( e );
	else
		return true;
}

function JTPlatinumGridTBodyMouseDown( e )
{
	var event = e || window.event;
	var target = getEventTarget(event);
	while (target.id == "")
		target = target.parentNode;
    var gridID = target.id.split( "_" )[ 0 ];
    var gridObject = document.getElementById( gridID );

    if( gridObject )
		gridObject._tBodyMouseDown( e );
}

function JTPlatinumGridTBodyMouseMove( e )
{
	JTPlatinumGridResizing._tBodyMouseMove( e );
}

function JTPlatinumGridTBodyMouseUp( e )
{
	return JTPlatinumGridResizing._tBodyMouseUp( e );
}

function JTPlatinumGridResize( id )
{
	document.getElementById( id )._onResize();
}